@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @can('Edit')
                    <h1 class="m-0">System Settings</h1>
                    @endcan

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Role and Permission configuration</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    In this section, you can configure the role and permission settings for your system. This allows you to
                    assign specific permissions to different roles, such as admin, doctors, or receptionist, and control
                    what actions
                    they can perform within the system. This can include tasks such as accessing certain pages, creating or
                    editing content, and managing user
                    accounts. By configuring roles and permissions, you can ensure that only authorized users have access to
                    sensitive information and can perform specific actions within the system.
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                @foreach ($roles as $role)
                <div class="card card-outline card-primary col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">{{$role->name}}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('AddPermission') }}">
                        <div class="card-body">
                            <div class="row text-center">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3 text-left">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <div class="role-container">
                                                    <input class="form-check-input permission-checkbox" type="checkbox"
                                                    {{$role->hasPermissionTo($permission) ? 'checked': ''}}
                                                        name="{{ $permission->id }}" id="{{ $permission->name }}"
                                                        value="{{ $permission->id }}">
                                                    <div class="checkmark"></div>
                                                    <label class="form-check-label"
                                                        for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-success">Submit</button>
                    </form>
                </div>

                <!-- /.card-body -->


        </div>
        <!-- /.card -->
        @endforeach
        </div>
    </div>
    </section>
    <!-- /.content-header -->
@endsection
