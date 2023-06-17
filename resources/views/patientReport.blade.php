<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testing</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .profile-user-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        margin: 20px auto;
    }

    .profile-username {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    .timeline-table {
        width: 100%;
        border-collapse: collapse;
    }

    .timeline-table th,
    .timeline-table td {
        padding: 10px;
        border: 1px solid #e0e0e0;
    }

    .timeline-table thead {
        background-color: #f8f8f8;
    }

    .timeline-table tbody tr:nth-child(even) {
        background-color: #f8f8f8;
    }

    .timeline-table tbody tr:hover {
        background-color: #f2f2f2;
    }
</style>

<body>



    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <center><h2>Ministry of Health and Social Welfare (Tanzania)</h2>
                <h3>HIV Patient Progress Report</h3></center>
            </div>
            <H4>Patient Personal Information</H4>
            <table>
                <tr>
                    <td>Patient Name</td>
                    <td>{{ $patientData->f_name }} {{ $patientData->l_name }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $patientData->gender }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $patientData->address }}</td>
                </tr>
                <tr>
                    <td>Registered At</td>
                    <td>{{ $branch->where('id', $patientData->branch_id)->first()->branch_name }}</td>
                </tr>
                <tr>
                    <td>Patient Number</td>
                    <td>{{ $patientData->pattient_number }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $patientData->phone_number }}</td>
                </tr>
            </table>

            <H4>Patient Medical Progress</H4>
            {{-- <div class="active tab-pane" id="timeline">
                @foreach ($patientData->medicsData as $medic)
                    <div class="timeline timeline-inverse">
                        <div class="time-label">
                            <span class="bg-primary">
                                {{ \Carbon\Carbon::parse($medic->created_at)->format('d F Y') }}
                            </span>
                        </div>
                        <div>
                            <i class="fa fa-heartbeat bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fa fas fa-location-arrow" aria-hidden="true"></i>
                                    {{ $branch->where('id', $medic->branch_id)->first()->branch_name }}
                                    <i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($medic->created_at)->format('H:i') }}
                                </span>
                                <h3 class="timeline-header">
                                    <a href="#">
                                        Dkt, {{ $member->where('id', $medic->doctor_id)->first()->f_name }}
                                        {{ $member->where('id', $medic->doctor_id)->first()->l_name }}
                                    </a>
                                </h3>
                                <div class="timeline-body">
                                    <h4 class="card-title text-bold">Medical Type:</h4>
                                    <p class="card-text">{{ $medic->medics_type }}</p>
                                    <h4 class="card-title text-bold">HIV Level:</h4>
                                    <p class="card-text">{{ $medic->HIV_level }}</p>
                                    <h4 class="card-title text-bold">Description:</h4>
                                    <p class="card-text">{{ $medic->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->el. --}}
            <table class="timeline-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Medical Type</th>
                        <th>HIV Level</th>
                        <th>Description</th>
                        <th>Hospital</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patientData->medicsData as $medic)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($medic->created_at)->format('d F Y H:i') }}</td>
                        <td>
                            Dkt,
                            {{ $member->where('id', $medic->doctor_id)->first()->f_name }}
                            {{ $member->where('id', $medic->doctor_id)->first()->l_name }}
                        </td>
                        <td>{{ $medic->medics_type }}</td>
                        <td>{{ $medic->HIV_level }}</td>
                        <td>{{ $medic->description }}</td>
                        <td>{{ $branch->where('id', $medic->branch_id)->first()->branch_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="report-footer">
        Report generated by: Dkt {{ $fullName }}
    </div>


</html>
