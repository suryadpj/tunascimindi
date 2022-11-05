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
                <h1>33764</h1>
                <p>Total Database</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h1>165</h1>
                <p>Total Data Login</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info</a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h1>0</h1>
                <p>Potensi t-care</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h1>4</h1>
                <p> Potensi gbsb</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Apps Visitors</h3>
                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Customer detail</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="customer-detail-chart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Habit Service</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="composition-chart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Data Login</h3>
                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="login-chart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Reservasi</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Oktober</th>
                        <th>Booking</th>
                        <th>Konfirmasi</th>
                    </tr>
                    <tr>
                        <td>Booking Service</td>
                        <td>48</td>
                        <td>48</td>
                    </tr>
                    <tr>
                        <td>Booking CR7</td>
                        <td>16</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td>Aksesoris</td>
                        <td>9</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Unit baru</td>
                        <td>11</td>
                        <td>9</td>
                    </tr>
                    <tr>
                        <td>Trade in</td>
                        <td>2</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Referensi</td>
                        <td>3</td>
                        <td>2</td>
                    </tr>
                </table>
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
    var $visitorsChart = $('#visitors-chart')
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21'],
            datasets: [{
                type: 'line',
                data: [9, 11, 5, 8, 15, 16, 6, 4, 7, 9, 12, 15, 5, 6, 8, 13, 17, 4, 5, 6, 9],
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
    var $customerChart = $('#customer-detail-chart')
    var myoption = {
        tooltips: {
            enabled: true
        },
        legend: {
            display: false
        },
        hover: {
            animationDuration: 1
        },
        animation: {
        duration: 1,
        onComplete: function () {
            var chartInstance = this.chart,
                ctx = chartInstance.ctx;
                ctx.textAlign = 'center';
                ctx.fillStyle = "rgba(0, 0, 0, 1)";
                ctx.textBaseline = 'bottom';

                // Loop through each data in the datasets

                this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x + 10, bar._model.y + 3);

                    });
                });
            }
        }
    };
    var customerChart = new Chart($customerChart, {
        type: 'horizontalBar',
        "data": {
            "labels": ["Gold", "Silver", "Bronze"],
            "datasets": [{
                "data": [10, 33, 57],
                "fill": false,
                "backgroundColor": ["rgb(59,60,54)", "rgb(255,215,0)", "rgb(192,192,192)", "rgb(205,127,50)"],
                // "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)"],
            }]
        },
        options: myoption
    })
    var $compositionChart = $('#composition-chart')
    var compositionChart = new Chart($compositionChart, {
        type: 'doughnut',
        "data": {
            "labels": ["Punctual", "Active", "passive", "Inactive"],
            "datasets": [{
                "data": [55, 25, 15, 5],
                "fill": false,
                "backgroundColor": ["rgb(59,60,54)", "rgb(255,215,0)", "rgb(192,192,192)", "rgb(205,127,50)"],
                // "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)"],
            }]
        },
    })
    var $visitorsChart = $('#login-chart')
    var visitorsChart = new Chart($visitorsChart, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                data: [0, 0, 0, 0, 0, 0, 0, 0, 123, 165, 0, 0],
                "fill": false,
                "backgroundColor": ["rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)","rgb(59,60,54)",],
            }]
        },
        options: myoption
    })
})
</script>
@endsection
