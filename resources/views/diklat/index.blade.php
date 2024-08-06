@extends('layouts.index', ['title' => 'Master diklat', 'head' => 'diklat', 'headUrl' => '#', 'body' => 'manajemen diklat' ])
@section('content')
<!-- Bordered table -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manajemen diklat</h5>
        <div class="header-elements">
            <div class="list-icons mr-2">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
            <a href="{{ route('diklat.create') }}"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover datatable-basic">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Diklat</th>
                    <th>Ruangan</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- /bordered table -->
<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Hapus diklat</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" id="delform">
                @method('DELETE')
                <div class="modal-body">
                    <h5 class="text-muted">Data<span class="name-diklat"></span>akan dihapus secara permanen. Yakin ingin menghapus?</h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
                    targets: [3]
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
                    data: 'name'
                },
                {
                    data: 'room'
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                    <div class=d-flex flex-row">
                        <a href="#"><button type="button" class="btn btn-primary btn-icon"><i class="icon-pencil7" title="Edit"></i></button></a>
                        <a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{url('/diklat/delete/${data.id}')}}" data-diklat="${data.name}"><button type="button" class="btn btn-danger btn-icon ml-2"><i class="icon-x" title="Delete"></i></button></a>
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
                    url: "{{url('/diklat')}}",
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
    $(document).on("click", ".delbutton", function() {
        var url = $(this).data('uri');
        var name = $(this).data('diklat')
        $("#delform").attr("action", url);
        $(".name-diklat").text(" " + name + " ");
    });

    $('#delform').submit(function(event) {
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
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

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
</script>
@endpush