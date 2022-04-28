@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="content">
        <div class="panel-header bg-danger-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                {{-- Harian --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-success mr-3">
                                <i class="fa fa-dollar-sign"></i>
                            </span>
                            <div>
                                <h5 class="mb-1">
                                    <b>
                                        {{ number_format($penjualanHarian,0) }}
                                    </b>
                                </h5>
                                <small class="text-muted">Pendapatan Harian</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bank --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-info mr-3">
                                <i class="far fa-credit-card"></i>
                            </span>
                            <div>
                                <h5 class="mb-1">
                                    <b>
                                        {{ number_format($penjualanHarianBank,0) }}
                                    </b>
                                </h5>
                                <small class="text-muted">Pendapatan Harian Bank</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Cash --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-primary mr-3">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <div>
                                <h5 class="mb-1">
                                    <b>
                                        {{ number_format($penjualanHarianCash,0) }}
                                    </b>
                                </h5>
                                <small class="text-muted">Pendapatan Harian Cash</small>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="col-sm-6 col-lg-3">
                    <div class="card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-danger mr-3">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <div>
                                <h5 class="mb-1">
                                    <b>
                                        {{ number_format($penjualanBulanan,0) }}
                                    </b>
                                </h5>
                                <small class="text-muted">Pendapatan Bulanan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        var tanggal = 21;
       Highcharts.chart('container', {

        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },

        yAxis: {
            title: {
                text: ''
            }
        },

        xAxis: {
                type: 'datetime'
            },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
                series: {
                    pointStart: Date.now(),
                    pointInterval: 24 * 3600 * 1000 // one day
                }
        },

        series: [{
            name: 'Harian',
            data: [
                @foreach ($chartHarian as $data)
                    {{ ($data->jumlah) }},
                @endforeach
            ]
        }],

        responsive: {
            rules: [{
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
        });
    </script>

<script>
    Highcharts.chart('bulanan', {
     title: {
         text: ''
     },

     subtitle: {
         text: ''
     },

     yAxis: {
         title: {
             text: ''
         }
     },

     xAxis: {
             type: 'datetime'
         },

     legend: {
         layout: 'vertical',
         align: 'right',
         verticalAlign: 'middle'
     },

     plotOptions: {
             series: {
                 pointStart: Date.now(),
                 pointInterval: 24 * 3600 * 1000*30 // one day
             }
     },

     series: [{
         name: 'Bulanan',
         data: [
             @foreach ($chartBulanan as $data)
                 {{ ($data->jumlah) }},
             @endforeach
         ]
     }],

     responsive: {
         rules: [{
             chartOptions: {
                 legend: {
                     layout: 'horizontal',
                     align: 'center',
                     verticalAlign: 'bottom'
                 }
             }
         }]
     }
     });
 </script>
@endpush