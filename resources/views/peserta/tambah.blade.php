@extends('layouts.index', ['title' => 'Master Peserta', 'head' => 'Peserta', 'headUrl' => '#', 'body' => 'manajemen peserta' ])
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Tambah Peserta</h5>
    </div>

    <div class="card-body">
        <form action="{{url('peserta/store')}}" id="tambah-peserta">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend class="font-weight-semibold">
                            <i class="icon-reading mr-2"></i> Bio Data Peserta
                        </legend>

                        <div class="form-group">
                            <label>Masukan nama anda:</label>
                            <input name="name" type="text" class="form-control" placeholder="nama lengkap">
                        </div>

                        <div class="form-group">
                            <label>Masukan nama ibu kandung:</label>
                            <input name="nama_ibu" type="text" class="form-control" placeholder="Nama Ibu">
                        </div>

                        <div class="form-group">
                            <label>Masukan nomer telpon:</label>
                            <input name="nomer_telp" type="number" class="form-control" placeholder="08xxxxxxxxx">
                        </div>


                        <div class="form-group">
                            <label>Profesi:</label>
                            <input name="profesi" type="text" class="form-control" placeholder="Profesi">
                        </div>

                        <div class="form-group">
                            <label>Gender:</label>
                            <select name="gender" id="gender" class="form-control select">
                                <option value="" selected disabled>Jenis Kelamin</option>
                                <option value="1">Laki - laki</option>
                                <option value="0">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tempat Lahir:</label>
                                    <select name="kota" id="datakota" class="form-control select-search" required>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>

                                <div class="col-lg-4">
                                    <label for="tanggalLahir">Tanggal Lahir:</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                        </span>
                                        <input name="tanggal_lahir" type="text" class="form-control daterange-single">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Masukan detail alamat:</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        </div>

                    </fieldset>
                </div>

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
                            <input name="password" type="password" class="form-control" placeholder="minimal 8 karakter">
                        </div>
                    </fieldset>
                </div>
            </div>


            <div class="text-right">
                <a href="{{ route('peserta') }}" class="btn bg-grey">Cancel <i class="icon-reset ml-2"></i></a>
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
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{ route("get.kota") }}',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                var kota = response.kota;
                var options = '';

                // Populate provinces select box
                $.each(kota, function(index, kota) {
                    options += '<option value="' + kota.id + '">' + kota.name + '</option>';
                });

                $('#datakota').append(options);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching provinces: ' + error);
            }
        });

        $(document).ready(function() {
            $("#tambah-peserta").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    nama_ibu: {
                        required: true
                    },
                    nomer_telp: {
                        required: true,
                        number: true
                    },
                    profesi: {
                        required: true
                    },
                    gender: {
                        required: true,
                    },
                    kota: {
                        required: true
                    },
                    tanggalLahir: {
                        required: true,
                        date: true
                    },
                    alamat: {
                        required: true
                    },
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
                    }
                },
                messages: {
                    name: {
                        required: "This field is required",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    email: {
                        required: "This field is required",
                        email: "Please enter a valid email address"
                    },
                    nama_ibu: {
                        required: "This field is required",
                    },
                    nomer_telp: {
                        required: "This field is required",
                        number: 'Please enter a valid number.'
                    },
                    profesi: {
                        required: "This field is required"
                    },
                    gender: {
                        required: "This field is required",
                    },
                    kota: {
                        required: "This field is required"
                    },
                    tanggal_lahir: {
                        required: "This field is required",
                        date: 'Please enter a valid date'
                    },
                    alamat: {
                        required: "This field is required"
                    },
                    username: {
                        required: "This field is required"
                    },
                    password: {
                        required: "This field is required",
                        minlength: "Your password must be at least 8 characters long"
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
                                    title: response.message
                                }).then(function() {
                                    window.location = '{{route("peserta")}}';
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
                }
            });
        });

    })
</script>
@endpush