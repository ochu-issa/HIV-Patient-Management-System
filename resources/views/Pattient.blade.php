@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register Pattients</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Pattient</li>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Pattients</h3>
                    @can('Create-Pattient')
                        <button type="button" class="btn btn-small btn-primary float-right" data-toggle="modal"
                            data-target="#modal-lg"><i class="fa fa-plus"></i> Register new
                            Pattient</button>
                    @endcan
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Pattent Number</th>
                                {{-- <th>View Process</th> --}}
                                @if (!Auth::user()->hasRole('Receptionist'))
                                    <th>Action</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pattients as $pattient)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $pattient->f_name }} {{ $pattient->l_name }}</td>
                                    <td>{{ $pattient->gender }} </td>
                                    <td>{{ $pattient->address }} </td>
                                    <td>{{ $pattient->phone_number }} </td>
                                    <td>{{ $pattient->pattient_number }}</td>
                                    {{-- <td><button class="btn btn-success btn-sm"><span class="fa fa-eye"></span> view</button> --}}
                                    </td>
                                    @if (!Auth::user()->hasRole('Receptionist'))
                                        <td>
                                            <button class="btn btn-secondary btn-sm"><span
                                                    class="fa fa-edit"></span></button>
                                            <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                                        </td>
                                    @endif
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
                        <h4 class="modal-title">Register new Pattient</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addpattient') }}" method="POST">
                            @csrf
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
                                        <option value="">--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col col-md-6">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" id=""
                                        placeholder="Enter address here ..." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id=""
                                        placeholder="255626560698" required>
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
