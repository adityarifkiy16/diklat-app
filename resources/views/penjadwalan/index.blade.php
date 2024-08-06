@extends('layouts.index', ['title' => 'Master penjadwalan', 'head' => 'penjadwalan', 'headUrl' => '#', 'body' => 'manajemen penjadwalan' ])
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manajemen penjadwalan</h5>
        <div class="header-elements">
            <div class="list-icons mr-2">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
            <a href="{{ route('penjadwalan.create') }}"><button type="button" class="btn btn-success rounded-round"><i class="icon-add mr-2"></i> Tambah</button></a>
        </div>
    </div>
    <div class="card-body" id="penjadwalan-container">
    </div>
</div>
<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Hapus penjadwalan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" id="delform">
                @method('DELETE')
                <div class="modal-body">
                    <h5 class="text-muted">Data<span class="name-penjadwalan"></span>akan dihapus secara permanen. Yakin ingin menghapus?</h5>
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
    $(document).ready(function() {
        let token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: `{{route('penjadwalan')}}`,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                let container = $('#penjadwalan-container');
                container.empty();

                if (response.code === 200) {
                    const html = response.penjadwalan.map(item => `
                     <div class="card p-3" style="border-radius: 10px; border: 1px solid #ddd;">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- Date Section -->
                                    <div class="col-md-2 d-flex flex-column align-items-center justify-content-center border-right">
                                        <h1 class="m-0 font-weight-bold text-center">
                                            <span class="${moment(item.tgl_mulai).day() === 0 ? 'text-danger' : ''}">${moment(item.tgl_mulai).format('DD')} ${moment(item.tgl_mulai).format('MMM')}</span>   - 
                                            <span class="${moment(item.tgl_selesai).day() === 0 ? 'text-danger' : ''}">${moment(item.tgl_selesai).format('DD')}  ${moment(item.tgl_selesai).format('MMM')}</span>
                                        </h1>
                                    </div>

                                    <!-- Time and Location Section -->
                                    <div class="col-md-4 d-flex flex-column justify-content-center">
                                        <div class="d-flex align-items-center mb-2 ml-4">
                                            <i class="icon-alarm mr-2 icon-1x"></i>
                                            <span class="font-weight-bold">${item.start_time} - ${item.end_time}</span>
                                        </div>
                                        <div class="d-flex align-items-center ml-4">
                                            <i class="icon-location3 mr-2 icon-1x"></i>
                                            <span class="font-weight-bold">${item.diklat.room}</span>
                                        </div>
                                    </div>

                                    <!-- Name Section -->
                                    <div class="col-md-4 d-flex align-items-center">
                                        <i class="icon-user mr-2 icon-1x"></i>
                                        <span class="font-weight-bold">${item.instruct?.name ?? ''}</span>
                                    </div>

                                    <!-- Additional Info Section -->
                                    <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">
                                        <p class="m-0 font-weight-bold text-center">Diklat</p>
                                        <h1 class="m-0 font-weight-bold text-center">${item.diklat.name}</h1>
                                    </div>
                                </div>
                            </div>
                    </div>
                        `).join('');
                    container.append(html);
                } else {
                    container.append('<p class="align-center">No data found</p>');
                }
            },
            error: function(xhr) {
                console.error('AJAX Error:', status, error);
            }
        })
    });
</script>
@endpush