@extends('adminlte::page')

@section('title', 'Dashboard - TCC Backend')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ number_format($user,0) }}</h3>
                <p>Database Customer</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($pkb,0) }}</h3>
    <p>Data PKB</p>
    </div>
    <div class="icon">
    <i class="ion ion-settings"></i>
    </div>
    <a href="pkb" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
    <div class="inner">
    <h3>{{ number_format($reservasi,0) }}</h3>
    <p>Data Reservasi</p>
    </div>
    <div class="icon">
    <i class="ion ion-clipboard"></i>
    </div>
    <a href="reesevasidata" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{ number_format($tradein,0) }}</h3>
        <p>Data Minat Tradein</p>
        </div>
        <div class="icon">
        <i class="ion ion-model-s"></i>
        </div>
        <a href="tradein" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>

        </div><div class="content">
            <div class="container-fluid">
            <div class="row">
            <div class="col-lg-6">
            <div class="card">
            <div class="card-header border-0">
            <div class="d-flex justify-content-between">
            <h3 class="card-title">Aktivitas User login</h3>
            {{-- <a href="javascript:void(0);">View Report</a> --}}
            </div>
            </div>
            <div class="card-body">
            <div class="d-flex">
            <p class="d-flex flex-column">
            <span class="text-bold text-lg">820</span>
            <span>Visit</span>
            </p>
            </div>

            <div class="position-relative mb-4">
            <canvas id="visitors-chart" height="200"></canvas>
            </div>
            </div>
            </div>
@stop

@section('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('js')
<script src="vendor/Chart.min.js" type="text/javascript"></script>
<script>
    $(function() {
    'use strict'
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode = 'index'
    var intersect = true
    var $salesChart = $('#sales-chart')
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                backgroundColor: '#007bff',
                borderColor: '#007bff',
                data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
            }, {
                backgroundColor: '#ced4da',
                borderColor: '#ced4da',
                data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        callback: function(value) {
                            if (value >= 1000) {
                                value /= 1000
                                value += 'k'
                            }
                            return '$' + value
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
    var $visitorsChart = $('#visitors-chart')
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
            datasets: [{
                type: 'line',
                data: [10, 4, 6, 15, 10, 5, 6, 9, 3, 5, 15, 12, 10, 8, 5, 7, 8, 6, 3, 5, 0, 0,0,0,0,0,0,0,0,0],
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 20
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
})
</script>
@endsection
