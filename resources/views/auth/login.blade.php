@extends('layouts.auth')
@section('content')
<!-- Login form -->
<div class="row">
    <div class="col-12 col-md-6 mr-0">
        <form class="login-form" method="post" action="{{url('/login')}}">
            @csrf
            <div class="card border-0 mb-0" style="background-color: #005C78;">
                <div class="card-body mb-1">
                    <div class="text-center mb-4">
                        <img src="{{asset('assets/images/logo.png')}}" alt="brand-logo" style="height: 1rem; object-fit: contain;">
                    </div>
                    <label for="login" class="text-white">Masukan informasi anda</label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="text" name="login" class="form-control" placeholder="Username">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <label for="login" class="text-white">Masukan password</label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn mt-1 bg-teal-400 btn-labeled btn-labeled-left rounded-round w-100"><b><i class="icon-circle-right2"></i></b><span class="mr-4">Sign In</span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 ml-0 pl-0 d-none d-md-block">
        <img src="{{asset('assets/images/image.png')}}" alt="brand-logo" class="img-fluid" style="display: block; margin: 0 auto;">
    </div>
</div>

<!-- /login form -->
@endsection

@push('script')
<script>
    $(document).ready(function() {

        $('.login-form').submit(function(event) {
            event.preventDefault();

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showClass: {
                    popup: `
                animate__animated
                animate__fadeInDown
                animate__faster
                `
                },
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            // Get form data
            let formData = $(this).serialize();

            let token = $('meta[name="csrf-token"]').attr('content');

            // Send AJAX request
            $.ajax({
                url: "/login",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: formData,
                success: function(response) {
                    if (response.code === 200) {
                        Toast.fire({
                            icon: "success",
                            title: response.message
                        }).then(function() {
                            window.location = '{{route("dashboard")}}'
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: 'Unexpected Errors'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred';
                    Toast.fire({
                        icon: "error",
                        title: errorMessage
                    });
                }
            });
        });
    });
</script>
@endpush