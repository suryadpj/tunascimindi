@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Media Edukasi untuk anda</h6>
        </div>
    </div>
    <div class="row">
        @foreach ($dataedukasi as $a)
        <div class="col-12 col-md-6 col-lg-4">
            <a href="../{{ $a->img_src }}" class="card mb-3" target="_blank">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="text-color-theme mb-1">{{ $a->alt }}</p>
                            <p class="text-muted size-12">{{ $a->penjelasan }}</p>
                            <button class="btn btn-primary">Download</button>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@endsection


