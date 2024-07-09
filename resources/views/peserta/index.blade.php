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
            <a href="https://starlax.noretest2.com/users/create"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
        </div>
    </div>
    <div class="table-responsive table-hover">
        <table class="table table-bordered datatable-basic">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width:20%;">Nama</th>
                    <th style="width:15%;">TTL</th>
                    <th style="width:20%;">Nama Ibu</th>
                    <th style="width:15%;">No Telp</th>
                    <th style="width:10%;">Profesi</th>
                    <th style="width:10%;">Jenis Kelamin</th>
                    <th style="width:5%; text-align: center;">Actions</th>
                </tr>
            </thead>

        </table>
    </div>
</div>
<!-- /bordered table -->
@endsection
@push('script')
@endpush