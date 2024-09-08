@extends('layouts.index', ['title' => 'Master user', 'head' => 'user', 'headUrl' => '#', 'body' => 'manajemen user' ])
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Tambah user</h5>
    </div>

    <div class="card-body">
        <form action="{{url('user/store')}}" id="tambah-user">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="font-weight-semibold">
                            <i class="icon-reading mr-2"></i> Akun
                        </legend>

                        <div class="form-group">
                            <label>Masukan username:</label>
                            <input name="username" type="text" class="form-control" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label>Masukan email:</label>
                            <input name="email" type="text" class="form-control" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label>Masukan password:</label>
                            <input name="password" type="password" id="password" class="form-control" placeholder="minimal 8 karakter">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi password:</label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="Konfirmasi password">
                        </div>
                        <div class="form-group">
                            <label>Role:</label>
                            <select name="role" id="datarole" class="form-control select-search" required>
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                </div>
            </div>


            <div class="text-right">
                <a href="{{ route('user') }}" class="btn bg-grey">Cancel <i class="icon-reset ml-2"></i></a>
                <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /2 columns form -->

@endsection
@push('script')
<script>
    $(document).ready(function() {
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
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $(document).ready(function() {
            $("#tambah-user").validate({
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    email: {
                        required: "This field is required",
                        email: "Please enter a valid email address"
                    },
                    username: {
                        required: "This field is required"
                    },
                    password: {
                        required: "This field is required",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "This field is required",
                        equalTo: "Your password not match"
                    }
                },
                errorElement: "span",
                errorClass: "form-text text-danger",
                errorPlacement: function(error, element) {
                    var container = $(element).closest('.form-group');
                    container.append(error);
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function(form) {
                    $('.form-text text-danger').remove();

                    let formData = $(form).serialize();
                    let token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data: formData,
                        success: function(response) {
                            if (response.code === 200) {
                                Toast.fire({
                                    icon: "success",
                                    title: response.data.message
                                }).then(function() {
                                    window.location = '{{route("user")}}';
                                });
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: 'Unexpected Errors'
                                });
                            }
                        },
                        error: async function(xhr) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = []
                            if (errors) {
                                $.each(errors, function(field, messages) {
                                    errorMessage.push(...messages);
                                });
                            }
                            if (errorMessage.length > 0) {
                                for (let i = 0; i < errorMessage.length; i++) {
                                    await displayToast(errorMessage[i]);
                                }
                            }
                            async function displayToast(message) {
                                await Toast.fire({
                                    icon: "error",
                                    title: message
                                });
                                return new Promise(resolve => setTimeout(resolve, 500));
                            }
                        }
                    });
                }
            });
        });

    })
</script>
@endpush