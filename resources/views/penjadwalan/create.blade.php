@extends('layouts.index', ['title' => 'Penjadwalan', 'head' => 'Penjadwalan', 'headUrl' => '#', 'body' => 'manajemen penjadwalan' ])
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Tambah Penjadwalan</h5>
    </div>

    <div class="card-body">
        <form action="{{url('penjadwalan/store')}}" id="tambah-jadwal">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Pelaksanaan:</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                </span>
                                <input name="tgl_jadwal" type="text" class="form-control daterange-time" value="07/28/2024 - 03/23/2013">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diklat:</label>
                            <select name="diklat_id" id="datadiklat" class="form-control select-search" required>
                                <option value="">Pilih Diklat</option>
                                @foreach($diklats as $diklat)
                                <option value="{{ $diklat->id }}">{{ $diklat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Instruktur:</label>
                            <select name="instruc_id" id="datainstruc" class="form-control select-search" required>
                                <option value="">Pilih Instruktur</option>
                                @foreach($instructors as $inst)
                                <option value="{{ $inst->id }}">{{ $inst->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                </div>
            </div>


            <div class="text-right">
                <a href="{{ route('penjadwalan') }}" class="btn bg-grey">Cancel <i class="icon-reset ml-2"></i></a>
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
            $("#tambah-jadwal").validate({
                rules: {
                    tgl_mulai: {
                        required: true,
                    },
                    tgl_selesai: {
                        required: true,
                    },
                    diklat: {
                        required: true,
                    }
                },
                messages: {
                    tgl_mulai: {
                        required: 'this field is required',
                    },
                    tgl_selesai: {
                        required: 'this field is required',
                    },
                    diklat: {
                        required: 'this field is required',
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
                                    window.location = '{{route("penjadwalan")}}';
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