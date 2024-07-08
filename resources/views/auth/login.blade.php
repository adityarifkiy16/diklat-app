@extends('layouts.auth')
@section('content')
<!-- Login form -->
<form class="login-form" method="post" action="{{url('/login')}}">
    @csrf
    <div class="card mb-0" style="background-color:#80C4E9;">
        <div class="card-body">
            <div class="text-center mb-3">
                <img src="#" alt="" style="height:80px;object-fit: contain;">

                <h5 class="mb-0">Login to your account</h5>
                <span class="d-block">Your credentials</span>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" name="login" class="form-control" placeholder="Username">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password">
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary-500 btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
            </div>
        </div>
    </div>
</form>
<!-- /login form -->
@endsection

@push('script')
<script>
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
            timer: 3000,
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
</script>
@endpush