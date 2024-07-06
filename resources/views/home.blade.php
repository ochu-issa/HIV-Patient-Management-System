@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">HMS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard 1.1</li>
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

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-wheelchair"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Patient</span>
                            <span class="info-box-number">{{ $patient }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-code-branch"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Branch</span>
                            <span class="info-box-number">{{ $branch }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa  fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Doctors</span>
                            <span class="info-box-number">{{ $doctor }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-bell-slash"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">System Condition</span>
                            <span class="info-box-number"><span class="badge badge-success"> Good</span></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><span class="badge badge-success">Active</span> Sessions at
                        <b>{{ $branch_name }}</b>
                    </h3>
                    <a href="{{ route('pattientarea') }}" class="btn btn-primary float-right"> <span class="fa fa-th"></span> Patient Area</a>
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
                                        @if (Auth::user()->hasRole(['Super-Admin', 'Branch-Admin', 'Doctor']))
                                            <a href="{{ route('patient-sessions.show', ['id' => $session->patient->id, 'session_id' => $session->id]) }}"
                                                class="btn btn-success btn-sm">
                                                <span class="fa fa-eye"></span> Attend
                                            </a>
                                        @else
                                            <span class="badge badge-success">Active</span>
                                        @endif
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
