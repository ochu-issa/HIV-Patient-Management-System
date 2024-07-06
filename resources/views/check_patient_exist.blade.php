@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Register Receptionist(s)</h1> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pattients Area</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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


            <div class="row">
                <div class="col col-md-3"> </div>
                <div class="col col-md-6">
                    @if (session('alert-info'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-info"></i> Alert!</h5>
                            {{ session('alert-info') }}
                        </div>
                    @endif
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-primary">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="../../dist/img/profile-1.png" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{ $patient->f_name . ' ' . $patient->l_name }}</h3>
                            <h5 class="widget-user-desc">{{ $patient->pattient_number }}</h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Gender <span class="float-right badge bg-primary">{{ $patient->gender }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Age <span
                                            class="float-right badge bg-primary">{{ Carbon\Carbon::parse($patient->dob)->age }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Phone Number <span
                                            class="float-right badge bg-primary">{{ $patient->phone_number }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Branch Registered <span
                                            class="float-right badge bg-primary">{{ $patient->Branch->branch_name }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">



                        <div class="col col-md-6">
                            <form action="{{ route('otp-codes.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <button type="submit" class="btn btn-success"><span class="fa fa-paper-plane"></span>
                                    Send OTP</button>
                            </form>
                        </div>

                        <div class="col col-md-6">
                            <a href="{{ route('pattientarea') }}" class="btn btn-danger float-right"><span
                                    class="fa fa-ban"></span> Just Check</a>
                        </div>
                    </div>
                </div>

                <div class="col col-md-3"> </div>
            </div>
            <!-- /.content -->
        </div>
    </section>
@endsection
