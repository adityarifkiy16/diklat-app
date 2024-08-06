@extends('layouts.index', ['title' => 'Master diklat', 'head' => 'diklat', 'headUrl' => '#', 'body' => 'manajemen diklat' ])
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Tambah diklat</h5>
    </div>

    <div class="card-body">
        <form action="{{url('diklat/store')}}" id="tambah-diklat">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <div class="form-group">
                            <label>Masukan Diklat:</label>
                            <input name="diklat" type="text" class="form-control" placeholder="Nama Diklat">
                        </div>
                        <div class="form-group">
                            <label>Masukan Ruangan:</label>
                            <input name="room" type="text" class="form-control" placeholder="Nama Ruangan">
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="text-right">
                <a href="{{ route('diklat') }}" class="btn bg-grey">Cancel <i class="icon-reset ml-2"></i></a>
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
            $("#tambah-diklat").validate({
                rules: {
                    diklat: {
                        required: true
                    },
                    room: {
                        required: true
                    }
                },
                messages: {
                    diklat: {
                        required: "This field is required"
                    },
                    room: {
                        required: "This field is required"
                    },

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
                                    window.location = '{{route("diklat")}}';
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