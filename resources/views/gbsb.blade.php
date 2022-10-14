@extends('layouts.master')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('/sw.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="http://afarkas.github.io/lazysizes/lazysizes.min.js"></script>
<script>
$(document).ready(function(){
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
});
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<style>
    .slider .slick-slide {
    border: solid 1px #000;
    }
    .slider .slick-slide img {
        width: 100%;
    }
    .slick-prev, .slick-next {
        width: 50px;
        height: 50px;
        z-index: 1;
    }
    .slick-prev {
    left: 5px;
    }
    .slick-next {
        right: 5px;
    }
    .slick-prev:before,
    .slick-next:before {
        font-size: 40px;
        text-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    .slick-dots {
    bottom: 15px;
    }
    .slick-dots li button:before {
    font-size: 12px;
    color: #fff;
    text-shadow: 0 0 10px rgba(0,0,0,0.5);
    opacity: 1;
    }
    .slick-dots li.slick-active button:before {
        color: #dedede;
    }
    .slider:not(:hover) .slick-arrow,
    .slider:not(:hover) .slick-dots {
        opacity: 0;
    }
    .slick-arrow,
    .slick-dots {
        transition: opacity 0.5s ease-out;
    }

</style>
@endsection
