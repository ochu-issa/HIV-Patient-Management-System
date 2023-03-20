@extends('layout/app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Modal -->
            <div class="modal fade" id="testing-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="input">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-left">
                <button class="btn btn-success" id="fire-modal">Fire Modal</button>
            </div>
            <div class="float-right">
                <button class="btn btn-success" id="response" value="1">Test Response</button>
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            // $(document).on('click', '#fire-modal', function() {
            //     $('#testing-modal').modal('show');
            // });

            $(document).on('click', '#response', function() {
                $('#testing-modal').modal('show');

                var branch_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/testing-response/" + branch_id,
                    success: function(response) {
                        branch_name = response.name;
                        status = response.status;

                        $("#input").html(branch_name);
                    }
                });
            });

        });
    </script>
@endsection
