@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-procedures"></span> Patients Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @elseif (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('../../dist/img/profile-1.png') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $patientData->f_name }} {{ $patientData->l_name }}
                            </h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="float-right">{{ $patientData->gender }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{ $patientData->address }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Registered At</b> <a class="float-right">{{ $patientData->Branch->branch_name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Patient Number</b> <a class="float-right">{{ $patientData->pattient_number }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone Number</b> <a class="float-right">{{ $patientData->phone_number }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Patient
                                        Records</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Add Medics</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Chat Room</a>

                                </li>
                                {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <form action="{{ route('generatereport') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="patientNumber"
                                            value="{{ $patientData->pattient_number }}" id="">
                                        <button type="submit" class="btn btn-success float-right"><span
                                                class="fa fa-download"></span> Export</button>
                                    </form>
                                </li> --}}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#close-session"><span
                                            class="fa fa-power-off"></span> Close Session</button>
                                </li>
                            </ul>

                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane" id="activity">
                                    <!-- Post -->

                                    <form class="form-horizontal" action="{{ route('sendmessage') }}" method="post">
                                        @csrf
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" name="message"
                                                placeholder="Enter your comment...">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form> <br>
                                    @foreach ($messages as $message)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('../../dist/img/profile-1.png') }}" alt="user image">
                                                <span class="username">
                                                    <a href="#">
                                                        {{ $message->user->member->f_name }}
                                                        {{ $message->user->member->l_name }}.
                                                    </a>

                                                </span>
                                                <span class="description">Shared publicly -
                                                    {{ \Carbon\Carbon::parse($message->created_at)->format('d F Y H:i') }},
                                                </span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                {{ $message->message }}
                                            </p>

                                            <p>
                                                <a href="#" class="link-black text-sm"><i
                                                        class="far fa-thumbs-up mr-1"></i> Like</a>

                                                <span class="float-right">
                                                    @if ($message->doctor_id == Auth::user()->id or Auth::user()->hasRole('Super-Admin'))
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete-message{{ $message->id }}">Delete</button>
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                        <!-- /.post -->
                                        {{-- //delete modal --}}
                                        <div class="modal fade" id="delete-message{{ $message->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Response</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>

                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete Response&hellip;?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form action="{{ route('deletemessage') }}" method="POST">
                                                            @csrf
                                                            <button type="button" class="btn btn-outline-light"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="messageid"
                                                                value="{{ $message->id }}" id="">
                                                            <button type="delete"
                                                                class="btn btn-outline-light ">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    @endforeach
                                    <!-- Post line-->
                                    <div class="post clearfix">
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    @foreach ($patientData->medicsData as $medic)
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-primary">
                                                    {{ \Carbon\Carbon::parse($medic->created_at)->format('d F Y') }}
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-heartbeat bg-primary"></i>

                                                <div class="timeline-item">

                                                    <span class="time"><i class="fa fas fa-location-arrow"
                                                            aria-hidden="true"></i>
                                                        {{ $medic->branch->branch_name }}
                                                        <i class="far fa-clock"></i>
                                                        {{ \Carbon\Carbon::parse($medic->created_at)->format('H:i') }}</span>

                                                    <h3 class="timeline-header"><a href="#">Dkt,
                                                            {{ $medic->doctor->member->f_name }}
                                                            {{ $medic->doctor->member->l_name }}</a>
                                                    </h3>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="timeline-body">
                                                                    <h4 class="card-title text-bold">Medical Type:</h4>
                                                                    <p class="card-text">{{ $medic->medics_type }}</p>

                                                                    <h4 class="card-title text-bold">HIV Level:</h4>
                                                                    <p class="card-text">{{ $medic->HIV_level }}</p>

                                                                    <h4 class="card-title text-bold">CD4 Count:</h4>
                                                                    <p class="card-text">{{ $medic->cd4_count }}</p>

                                                                    <h4 class="card-title text-bold">Viral Load:</h4>
                                                                    <p class="card-text">{{ $medic->viral_load }}</p>

                                                                    <h4 class="card-title text-bold">Allergies:</h4>
                                                                    <p class="card-text">{{ $medic->allergies }}</p>

                                                                    <h4 class="card-title text-bold">Blood Pressure:</h4>
                                                                    <p class="card-text">{{ $medic->blood_pressure }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="timeline-body">
                                                                    <h4 class="card-title text-bold">Medication Adherence:
                                                                    </h4>
                                                                    <p class="card-text">
                                                                        {{ $medic->medication_adherence ? 'Adherent' : 'Non-Adherent' }}
                                                                    </p>

                                                                    <h4 class="card-title text-bold">Diagnosis Date:</h4>
                                                                    <p class="card-text">
                                                                        {{ Carbon\Carbon::parse($medic->diagnosis_date)->format('M d, Y') }}
                                                                    </p>

                                                                    <h4 class="card-title text-bold">Weight:</h4>
                                                                    <p class="card-text">{{ $medic->weight }} kg</p>

                                                                    <h4 class="card-title text-bold">ART Regimen:</h4>
                                                                    <p class="card-text">{{ $medic->art_regimen }}</p>

                                                                    <h4 class="card-title text-bold">Next Appointment Date:
                                                                    </h4>
                                                                    <p class="card-text">
                                                                        {{ $medic->next_appointment_date }}</p>

                                                                    <h4 class="card-title text-bold">Description:</h4>
                                                                    <p class="card-text">{{ $medic->description }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="timeline-footer">
                                                        {{-- <a href="#" class="btn btn-primary btn-sm">Read more</a> --}}
                                                        @if ($medic->doctor_id == Auth::user()->id or Auth::user()->hasRole('Super-Admin'))
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#delete-medic{{ $medic->id }}">Delete</button>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        </div>

                                        {{-- //delete modal --}}
                                        <div class="modal fade" id="delete-medic{{ $medic->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Medical Record</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>

                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete the medical record&hellip;?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form action="{{ route('deletemedicalrecord') }}" method="POST">
                                                            @csrf
                                                            <button type="button" class="btn btn-outline-light"
                                                                data-dismiss="modal">Close</button>
                                                            <input type="hidden" name="medicid"
                                                                value="{{ $medic->id }}" id="">
                                                            <button type="delete"
                                                                class="btn btn-outline-light ">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    @endforeach

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form action="{{ route('addpatientrecord') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputMedicsType" class="col-sm-2 col-form-label">Medics
                                                Type</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="medics_type" class="form-control"
                                                    id="inputMedicsType" placeholder="Enter medical type" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputHIVLevel" class="col-sm-2 col-form-label">HIV Levels</label>
                                            <div class="col-sm-10">
                                                <select name="hiv_level" id="inputHIVLevel" class="form-control"
                                                    required>
                                                    <option selected disabled>--select HIV level</option>
                                                    <option value="Level 1">Level 1</option>
                                                    <option value="Level 2">Level 2</option>
                                                    <option value="Level 3">Level 3</option>
                                                    <option value="Level 4">Level 4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputCD4Count" class="col-sm-2 col-form-label">CD4 Count
                                                (%)</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="cd4_count"
                                                    id="inputCD4Count" placeholder="Enter CD4 Count" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputViralLoad" class="col-sm-2 col-form-label">Viral Load</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="viral_load"
                                                    id="inputViralLoad" placeholder="Enter Viral Load" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputAllergies" class="col-sm-2 col-form-label">Allergies</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="allergies"
                                                    id="inputAllergies" placeholder="Enter Allergies" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputBloodPressure" class="col-sm-2 col-form-label">Blood
                                                Pressure</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="blood_pressure"
                                                    id="inputBloodPressure" placeholder="Enter Blood Pressure" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputMedicationAdherence"
                                                class="col-sm-2 col-form-label">Medication Adherence</label>
                                            <div class="col-sm-10">
                                                <select name="medication_adherence" id="inputMedicationAdherence"
                                                    class="form-control" required>
                                                    <option value="1" selected>Adherent</option>
                                                    <option value="0">Non-Adherent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputWeight" class="col-sm-2 col-form-label">Weight</label>
                                            <div class="col-sm-10">
                                                <input type="number" step="0.01" class="form-control" name="weight"
                                                    id="inputWeight" placeholder="Enter Weight (kg)" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputARTRegimen" class="col-sm-2 col-form-label">ART
                                                Regimen</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="art_regimen"
                                                    id="inputARTRegimen" placeholder="Enter ART Regimen" required>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <label for="inputNextAppointmentDate" class="col-sm-2 col-form-label">Next
                                                Appointment Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="next_appointment_date"
                                                    id="inputNextAppointmentDate" required>
                                            </div>
                                        </div> --}}
                                        <div class="form-group row">
                                            <label for="inputMedicalDescription" class="col-sm-2 col-form-label">Medical
                                                Descriptions</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="medical_description" id="inputMedicalDescription"
                                                    placeholder="Enter Medical Descriptions" required></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ $patientData->id }}" name="patient_id">
                                        <input type="hidden" value="{{ $patientData->pattient_number }}"
                                            name="pattient_number">
                                        <input type="hidden" value="{{ $session_id }}" name="session_id">
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

        {{-- close session modal --}}
        <div class="modal fade" id="close-session">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Close Session</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>

                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to close the session &hellip;?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <form action="{{ route('patient-sessions.close') }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">No, exist</button>
                            <input type="hidden" name="session_id" value="{{ $session_id }}" id="">
                            <button type="delete" class="btn btn-outline-light ">Yes! Close it</button>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
    <!-- /.content -->
@endsection
