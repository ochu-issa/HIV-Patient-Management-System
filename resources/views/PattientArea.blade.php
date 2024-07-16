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
                <div class="col col-md-3.5"> </div>
                <div class="col col-md-5 ">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Patient Area</h3>
                        </div> <!-- /.card-body -->
                        <form action="{{route("searchpatient")}}" method="GET">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="text-center col col-md-12">
                                        <label for="">Enter Patient Number</label><br><br>
                                        <select  name="pattient_number" class="form-control select2">
                                            <option value="" selected disabled></option>
                                            @foreach ($patients as $patient)
                                                <option value="{{$patient->pattient_number}}">{{$patient->pattient_number}}</option>
                                            @endforeach
                                        </select> <br>
                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary"><span class="fa fa-search"></span> Search here</button>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </form>
                    </div>
                </div>
                <div class="col col-md-3.5"> </div>
            </div>
            <!-- /.content -->
        </div>
    </section>
@endsection
