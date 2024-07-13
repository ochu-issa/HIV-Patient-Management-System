@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-users"></span> Patients Sessions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Patients Sessions</li>
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
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><span class="badge badge-success">Active</span> Sessions at
                        <b>{{ $branch_name }}</b>
                    </h3>
                    @if (Auth::user()->hasRole(['Super-Admin', 'Receptionist', 'Branch-Admin']))
                        <a href="{{ route('patient-sessions.create') }}" class="btn btn-small btn-primary float-right"><i
                                class="fa fa-plus"></i> Create Session</a>
                    @endif
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patient_sessions as $index => $session)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $session->patient->f_name . ' ' . $session->patient->l_name }}</td>
                                    <td>{{ $session->patient->gender }}</td>
                                    <td>{{ $session->patient->pattient_number }}</td>
                                    <td>
                                        <a href="{{ route('patient-sessions.show', ['id' => $session->patient->id, 'session_id' => $session->id]) }}"
                                            class="btn btn-success btn-sm">
                                            <span class="fa fa-eye"></span> Attend
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
