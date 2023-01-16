@extends('layout/app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register Branch</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Branches</li>
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
                    <h3 class="card-title">All Branches</h3>
                    <button type="button" class="btn btn-small btn-primary float-right" data-toggle="modal"
                        data-target="#modal-lg">
                        <i class="fa fa-plus"></i> Add new branch</button>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Branch Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- data comes here --}}
                            @foreach ($branches as $branch)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $branch->branch_name }}</td>
                                    <td>
                                        @if ($branch->status == 1)
                                            <span class="right badge badge-success" data-toggle="modal"
                                                data-target="#update-status{{ $branch->id }}">Active</span>
                                        @endif
                                        @if ($branch->status == 0)
                                            <span class="right badge badge-danger" data-toggle="modal"
                                                data-target="#update-status-to-one{{ $branch->id }}">Unactive</span>
                                        @endif

                                    </td>
                                    <td>

                                        <button class="btn btn-secondary btn-sm" value="{{ $branch->id }}" id="edit-branch-btn"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete-branch{{ $branch->id }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                {{-- delete modal --}}
                                <div class="modal fade" id="delete-branch{{ $branch->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-danger">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Danger Modal</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    {{-- <input type="hidden" name="branchid" id=""> --}}
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the branch&hellip;</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{ route('deleteBranch', $branch->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-outline-light"
                                                        data-dismiss="modal">Close</button>
                                                    {{-- image.png <input type="hidden" name="branchid" id=""> --}}
                                                    <button type="delete" class="btn btn-outline-light">Delete</button>
                                                </form>
                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                {{-- update status modal --}}
                                <div class="modal fade" id="update-status{{ $branch->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-warning">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>You are about to Deactivate the branch status&hellip;</p>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-dismiss="modal">Close</button>
                                                <form action="{{ route('updateStatus', $branch->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-outline-dark">Deactivate</button>
                                                </form>
                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                {{-- update status modal to zero --}}
                                <div class="modal fade" id="update-status-to-one{{ $branch->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-warning">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>You are about to Activate the branch status&hellip;</p>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-dismiss="modal">Close</button>
                                                <form action="{{ route('updateStatusToOne', $branch->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button class="btn btn-outline-dark">Activate</button>
                                                </form>
                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->


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

        <!-- Register Branch Modal -->
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add new Branch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('Addbranches') }}" method="">
                        <div class="modal-body">
                            <p>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label for="">Branch Name</label>
                                    <input type="text" name="branchname" class="form-control" id=""
                                        placeholder="Enter branch name here ...">
                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Add branch</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.end of register branch modal -->


        <!-- Edit  Branch Modal -->
        <div class="modal fade" id="edit-branch">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Branch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('updateBranch')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label for="">Branch Name</label>

                                    <input type="text" name="branch_name" class="form-control" id="input">
                                    <input type="hidden" name="branch_id" class="form-control" id="inputId">

                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.end of register branch modal -->

    </section>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit-branch-btn', function() {
                $('#edit-branch').modal('show');

                var branch_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/testing-response/" + branch_id,
                    success: function(response) {
                        branch_name = response.name;
                        status = response.status;
                        id = response.id;

                        $("#input").val(branch_name);
                        $("#inputId").val(id);
                    }
                });
            });
        });
    </script>
@endsection
