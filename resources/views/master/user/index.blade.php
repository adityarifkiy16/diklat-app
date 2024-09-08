@extends('layouts.index', ['title' => 'Master User', 'head' => 'user', 'headUrl' => '#', 'body' => 'manajemen user' ])
@section('content')
<!-- Bordered table -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manajemen User</h5>
        <div class="header-elements">
            <div class="list-icons mr-2">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
            <a href="{{ route('user.create') }}"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover datatable-basic">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- /bordered table -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Form User</h5>
    </div>

    <div class="card-body">
        <form action="{{url('user/store')}}" id="tambah-user">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <div class="form-group">
                            <label>Masukan username:</label>
                            <input name="username" type="text" class="form-control" placeholder="username" id="username">
                        </div>
                        <div class="form-group">
                            <label>Masukan email:</label>
                            <input name="email" type="text" class="form-control" placeholder="email" id="email">
                        </div>
                        <div class="form-group">
                            <label>Masukan password:</label>
                            <input name="password" type="password" class="form-control" placeholder="minimal 8 karakter" id="password">
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
<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Hapus user</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" id="delform">
                @method('DELETE')
                <div class="modal-body">
                    <h5 class="text-muted">Data<span class="name-user"></span>akan dihapus secara permanen. Yakin ingin menghapus?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- dangermodal -->
@endsection
@push('script')
<script>
    // datatable
    var DatatableBasic = function() {

        var _componentDatatableBasic = function() {
            if (!$().DataTable) {
                console.warn('Warning - datatables.min.js is not loaded.');
                return;
            }

            // Setting datatable defaults
            $.extend($.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [4]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Search:</span> _INPUT_',
                    searchPlaceholder: 'Type to search...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: {
                        'first': 'First',
                        'last': 'Last',
                        'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                        'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                    }
                }
            });

            let columns = [{
                    data: 'DT_RowIndex',
                    name: 'no'
                },
                {
                    data: 'username'
                },
                {
                    data: 'email'
                },
                {
                    data: null,
                    render: function(data) {
                        return data.roles.name;
                    }
                },
                {
                    data: null,
                    render: function(data) {
                        if (data.role_id === 1) {
                            return '';
                        }
                        return `
                    <div class=d-flex flex-row">
                        <a class='editbutton' data-isnewuser="false" data-userid="${data.id}" data-uri="{{url('/user/edit/${data.id}')}}"><button type="button" class="btn btn-primary btn-icon"><i class="icon-pencil7" title="Edit"></i></button></a>
                        <a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{url('/user/delete/${data.id}')}}" data-user="${data.username}"><button type="button" class="btn btn-danger btn-icon ml-2"><i class="icon-x" title="Delete"></i></button></a>
                    </div>`;
                    }
                }
            ];

            // Basic datatable
            var table = $('.datatable-basic').DataTable({
                scrollX: false,
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{url('/user')}}",
                    type: "GET",
                    dataSrc: function(response) {
                        return response.data;
                    }
                },
                columns: columns,
                order: [
                    [0, "asc"]
                ],
            });

            // Alternative pagination
            $('.datatable-pagination').DataTable({
                pagingType: "simple",
                language: {
                    paginate: {
                        'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;',
                        'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'
                    }
                }
            });

            // Datatable with saving state
            $('.datatable-save-state').DataTable({
                stateSave: true
            });

            // Resize scrollable table when sidebar width changes
            $('.sidebar-control').on('click', function() {
                table.columns.adjust().draw();
            });
        };

        var _componentSelect2 = function() {
            if (!$().select2) {
                console.warn('Warning - select2.min.js is not loaded.');
                return;
            }

            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: 'auto'
            });
        };

        return {
            init: function() {
                _componentDatatableBasic();
                _componentSelect2();
            }
        }
    }();

    document.addEventListener('DOMContentLoaded', function() {
        DatatableBasic.init();
    });
</script>
<script>
    $(document).ready(function() {
        let isNewUser = true;
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
                    required: isNewUser,
                    minlength: 8
                },
                password_confirmation: {
                    required: isNewUser,
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

        $(document).on("click", ".editbutton", function(e) {
            isNewUser = $(this).data('isnewuser') === true;
            var url = $(this).data('uri');
            var userid = $(this).data('userid');
            var urlstore = `user/update/${userid}`;
            let token = $('meta[name="csrf-token"]').attr('content');
            $("#tambah-user").validate().settings.rules.password.required = isNewUser;
            $("#tambah-user").validate().settings.rules.password_confirmation.required = isNewUser;

            console.log("URL:", url);
            console.log("UserID:", userid);
            console.log("URL Store:", urlstore);

            $("#tambah-user").attr('action', urlstore);
            $("#tambah-user").validate().resetForm();
            $('.form-text.text-danger').remove();
            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    console.log(response.data.role_id);
                    $('#username').val(response.data.username);
                    $('#email').val(response.data.email);
                    $('#datarole').val(response.data.role_id).change();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            })
        });

        $(document).on("click", ".delbutton", function() {
            var url = $(this).data('uri');
            var name = $(this).data('user')
            $("#delform").attr("action", url);
            $(".name-user").text(" " + name + " ");
        });

        $('#delform').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            let token = $('meta[name="csrf-token"]').attr('content');
            let actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (response.code === 200) {
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        $('.datatable-basic').DataTable().ajax.reload();
                        $('#modal_theme_danger').modal('hide');
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.data.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Toast.fire({
                        icon: 'error',
                        title: error
                    });
                }
            });
        });
    });
</script>
@endpush