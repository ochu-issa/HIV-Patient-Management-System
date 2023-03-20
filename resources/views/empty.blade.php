@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><span class="fa fa-users"></span> Manage users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage users</li>
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
                    <h3 class="card-title">All Meters</h3>
                    <button type="button" class="btn btn-small btn-primary float-right" data-toggle="modal"
                        data-target="#modal-lg"><i class="fa fa-plus"></i> Register new Meter</button>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Meter Number</th>
                                <th>Units balance</th>
                                {{-- <th>Action</th> --}}
                                {{-- <th>MemberName</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meters as $meter)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$meter->meter_number}}</td>
                                    <td><span class="badge badge-success">{{$meter->unit}}</span></td>
                                    {{-- <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-sm btn-success">active</button>
                                            <button class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
                                        </div>
                                    </td> --}}
                                    {{-- <td>Ansi Space</td> --}}
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
