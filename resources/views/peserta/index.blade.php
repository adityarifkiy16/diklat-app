@extends('layouts.index', ['title' => 'Master Peserta', 'head' => 'Peserta', 'headUrl' => '#', 'body' => 'manajemen peserta' ])
@section('content')
<!-- Bordered table -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manajemen Peserta</h5>
        <div class="header-elements">
            <div class="list-icons mr-2">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
            <a href="#"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover datatable-basic">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>TTL</th>
                    <th>Nama Ibu</th>
                    <th>No Telp</th>
                    <th>Profesi</th>
                    <th>Jenis Kelamin</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- /bordered table -->
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
                    targets: [6]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
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
                    data: null,
                    render: function(data) {
                        return data.tempat_lahir + ' - (' + data.tanggal_lahir + ')';
                    }
                },
                {
                    data: 'nama_ibu'
                },
                {
                    data: 'nomer_telp'
                },
                {
                    data: 'profesi'
                },
                {
                    data: 'gender'
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                    <div style="text-align:center">
                        <a href="#"><button type="button" class="btn btn-primary btn-icon"><i class="icon-pencil7" title="Edit"></i></button></a>
                        <a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="#"><button type="button" class="btn btn-danger btn-icon"><i class="icon-x" title="Delete"></i></button></a>
                    </div>`;
                    }
                }
            ];

            // Basic datatable
            $('.datatable-basic').DataTable({
                scrollX: true,
                scrollCollapse: true,
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{url('/peserta')}}",
                    type: "GET",
                    dataSrc: function(response) {
                        return response.data;
                    }
                },
                columns: columns,
                order: [
                    [1, "desc"]
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

            // Scrollable datatable
            var table = $('.datatable-scroll-y').DataTable({
                autoWidth: true,
                scrollY: 300
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
@endpush