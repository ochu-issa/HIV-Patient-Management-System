<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientDetails;
use App\Models\Pattient;
use App\Traits\HttpResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientDetailApiController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {
        $id = $request->query('patient_id');

        $patient = Pattient::with(['PatientDetails' => function ($query) {
            $query->orderBy('id', 'desc')
                ->where('status', 1);
        }])->where('id', $id)
            ->first();

        if (!$patient) {
            return $this->error('', 'Patient not found!', 404);
        }

        $medics = [];

        foreach ($patient->PatientDetails as $detail) {
            $medics[] = [
                'detail_id' => $detail->id,
                'medics_type' => $detail->medics_type,
                'hiv_level' => $detail->HIV_level,
                'attended_doctor' => $detail->doctor->member->f_name . ' ' . $detail->doctor->member->l_name, // Corrected to f_name and l_name
                'branch_attended' => $detail->branch->branch_name,
                'attended_date' => Carbon::parse($detail->created_at)->format('M d, Y'),
                'attended_time' => Carbon::parse($detail->created_at)->format('H:i'),
            ];
        }

        return $this->success(['medics' => $medics], 'Data Retrieved');
    }

    public function show(Request $request)
    {
        $id = $request->query('patient_id');
        $detail_id = $request->query('detail_id');

        $detail = PatientDetails::with('patientDetailItem')
            ->orderBy('id', 'desc')
            ->where('patient_id', $id)
            ->where('id', $detail_id)
            ->first();

        if (!$detail) {
            return $this->error('', 'No Data Found!', 404);
        }

        $medics[] = [
            'detail_id' => $detail->id,
            'medics_type' => $detail->medics_type,
            'hiv_level' => $detail->HIV_level,
            'attended_doctor' => $detail->doctor->member->f_name . ' ' . $detail->doctor->member->l_name, // Corrected to f_name and l_name
            'branch_attended' => $detail->branch->branch_name,
            'attended_date' => Carbon::parse($detail->created_at)->format('M d, Y'),
            'attended_time' => Carbon::parse($detail->created_at)->format('H:i'),
        ];

        $medics_item = [
            'cd4_count' => $detail->patientDetailItem->cd4_count,
            'viral_load' => $detail->patientDetailItem->viral_load,
            'allergies' => $detail->patientDetailItem->allergies,
            'blood_pressure' => $detail->patientDetailItem->blood_pressure,
            'medication_adherence' => $detail->patientDetailItem->medication_adherence ? "Adherent" : "Non-Adherent",
            'diagnosis_date' => Carbon::parse($detail->patientDetailItem->diagnosis_date)->format('M d, Y'),
            'weight' => $detail->patientDetailItem->weight,
            'art_regimen' => $detail->patientDetailItem->art_regimen,
            'next_appointment_date' => $detail->patientDetailItem->next_appointment_date ?? 'No appointment set',
            'appoitment_by' => $detail->patientDetailItem->appointment_with,
            'description' => $detail->description,
        ];

        return $this->success([
            'medics' => $medics,
            'medics_item' => $medics_item
        ], 'Data Retrieved');
    }
}
