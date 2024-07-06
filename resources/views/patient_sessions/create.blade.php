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
                <div class="col col-md-4"> </div>
                <div class="col col-md-4">
                    @if (session('alert-info'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-info"></i> Alert!</h5>
                            {{ session('alert-info') }}
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-titler" style="text-align: center;"> Verify OTP</h3>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-2">
                                    <input type="text" name="num1" class="form-control otp-input" maxlength="1"
                                        oninput="validateInput(this)">
                                </div>
                                <div class="col col-md-2">
                                    <input type="text" name="num1" class="form-control otp-input" maxlength="1"
                                        oninput="validateInput(this)">
                                </div>
                                <div class="col col-md-2">
                                    <input type="text" name="num1" class="form-control otp-input" maxlength="1"
                                        oninput="validateInput(this)">
                                </div>
                                <div class="col col-md-2">
                                    <input type="text" name="num1" class="form-control otp-input" maxlength="1"
                                        oninput="validateInput(this)">
                                </div>
                                <div class="col col-md-2">
                                    <input type="text" name="num1" class="form-control otp-input" maxlength="1"
                                        oninput="validateInput(this)">
                                </div>
                                <div class="col col-md-2">
                                    <input type="text" name="num1" class="form-control otp-input" maxlength="1"
                                        oninput="validateInput(this)">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <span id="verifyMessage"></span>
                            </div>
                        </div>


                    </div>
                    <!-- /.card -->
                </div>

                <div class="col col-md-4"> </div>
            </div>
            <!-- /.content -->
        </div>
    </section>

    <script>
        function validateInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');

            if (input.value.length === 1) {
                let nextInput = input.nextElementSibling;
                while (nextInput && nextInput.tagName !== 'INPUT') {
                    nextInput = nextInput.nextElementSibling;
                }
                if (nextInput) {
                    nextInput.focus();
                } else {
                    checkAllInputs();
                }
            }
        }

        function checkAllInputs() {
            let inputs = document.querySelectorAll('.otp-input');
            let allFilled = true;
            let otpCode = '';

            inputs.forEach(input => {
                if (input.value.length !== 1) {
                    allFilled = false;
                } else {
                    otpCode += input.value;
                }
            });

            if (allFilled) {
                let verifyMessageElement = document.getElementById('verifyMessage');
                verifyMessageElement.innerText = 'Verifying...';
                verifyMessageElement.className = 'text-info';
                verifyOtp(otpCode);
            }
        }

        function verifyOtp(otpCode) {
            fetch('/patient-sessions/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        otp_code: otpCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let verifyMessageElement = document.getElementById('verifyMessage');
                    if (data.success) {
                        verifyMessageElement.innerText = 'Verifying successfully...';
                        verifyMessageElement.className = 'text-success';
                        setTimeout(() => {
                            window.location.href = data.redirect_url;
                        }, 1000); // delay to show the success message
                    } else {
                        verifyMessageElement.innerText = 'Invalid OTP. Please try again.';
                        verifyMessageElement.className = 'text-danger';
                    }
                })
                .catch(error => {
                    let verifyMessageElement = document.getElementById('verifyMessage');
                    verifyMessageElement.innerText = 'An error occurred. Please try again.';
                    verifyMessageElement.className = 'text-danger';
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
