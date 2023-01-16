@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register Branch Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Branch Admin(s)</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Branch Admin(s)</h3>
                    <button type="button" class="btn btn-small btn-primary float-right" data-toggle="modal"
                        data-target="#modal-lg"><i class="fa fa-plus"></i> Register new
                        Admin</button>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Branch Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branchAdmins as $branchAdmin)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $branchAdmin->f_name }} {{ $branchAdmin->l_name }}</td>
                                    <td>{{ $branchAdmin->gender }} </td>
                                    <td>{{ $branchAdmin->email }} </td>
                                    <td>{{ $branchAdmin->phone_number }} </td>
                                    <td>{{$branches->where('id', $branchAdmin->branch_id)->first()->branch_name}}</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm"><span class="fa fa-edit"></span></button>
                                        <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <!-- Add Pattients Modal -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Register new Branch Admin</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('addbranchadmin')}}">
                        @csrf
                        <div class="modal-body">
                            <p>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" name="f_name" class="form-control" id=""
                                        placeholder="Enter first name here ..." required>
                                </div>
                                <div class="col col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" name="l_name" class="form-control" id=""
                                        placeholder="Enter last name here ..." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="">Gender</label>
                                    <select name="gender" class="form-control" id="">
                                        <option selected disabled>--</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col col-md-6">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" id=""
                                        placeholder="Enter active email here ..." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id=""
                                        placeholder="255626560698" required>
                                </div>
                                <div class="col col-md-6">
                                    <label for="">branch Name</label>
                                    <select name="branchname" class="form-control" id="">
                                        <option value="" selected disabled>--</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            </p>
                        </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register </button>
                    </div>
                </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
@endsection
