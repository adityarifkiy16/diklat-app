@extends('layouts.index', ['title' => 'Pendaftaran Diklat', 'head' => 'diklat', 'headUrl' => '#', 'body' => 'pendaftaran' ])
@section('content')
<div class="row">
    @if(isset($dikpes) && $dikpes->isNotEmpty())
    <div class="col-xl-3 col-sm-6 col-12">
        @foreach($dikpes as $diklat)
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ $diklat->title }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <strong>Instruktur:</strong>budi<br>
                    <strong>Date:</strong>22-02-2024<br>
                    <strong>Room:</strong> BRM
                </p>
                <!-- Button to verify status -->
                <a href="#" class="btn btn-primary">
                    Verify Registration Status
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="col-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Anda belum mendaftar diklat!</h5>
                <div class="header-elements">
                    <a href=""><button class="btn btn-success rounded-round">Daftar</button></a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- /2 columns form -->
</div>
@endsection