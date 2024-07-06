@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-key"></span>OTP Codes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User OTP Codes</li>
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
                    <h3 class="card-title">All OTP Codes</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Number</th>
                                <th>Created By</th>
                                <th>OTP Code</th>
                                <th>Status</th>
                                <th>Resend SMS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($otp_codes as $code)
                                <tr>
                                    <td>{{ $code->patient->full_name }}</td>
                                    <td>{{ $code->patient->pattient_number }}</td>
                                    <td>{{ $code->user->full_name }}</td>
                                    <td>{{ $code->otp_code }}</td>
                                    <td>
                                        @if ($code->is_active == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($code->is_active == 1)
                                            <button class="btn btn-primary btn-sm">
                                                <span class="fa fa-sync"></span>
                                            </button>
                                        @else
                                            <button class="btn btn-primary btn-sm btn-disabled" disabled>
                                                <span class="fa fa-sync"></span>
                                            </button>
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
