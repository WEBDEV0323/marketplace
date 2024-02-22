@extends('frontend.user.user-masters')
@section('user-content')

    <div class="column content edit-address affiliate-column">
        <div class="affiliate-header">
            <div class="row">
                <div class="col-4">
                    <div class="affiliate-header-text">Rank: {{$rank>0?$rank:''}}</div>
                </div>
                <div class="col-4 text-center">
                    <div class="affiliate-header-text">Unique Code: {{Auth::user()->coupon_code}}</div>
                </div>
                <div class="col-4 text-center">
                    <div class="affiliate-header-text">Total Sales: £{{number_format((float)$currentMonth, 2, '.', '')}}</div>
                </div>
            </div>
        </div>
        <div class="triangle-row">
            <!-- <div class="triangle-block">
                <a href="javascript:void(0);" class="{{($currentMonth > 50000)?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 4" data-content="Have to sell £50,000 worth of products – 5% Commission ">Tier 4</a>
                <a href="javascript:void(0);" class="{{($currentMonth > 20000)?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 3" data-content="Have to sell £20,000 worth of products – 3% Commission">Tier 3</a>
                <a href="javascript:void(0);" class="{{($currentMonth > 10000)?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 2" data-content="Have to sell £10,000 worth of products – 2.5% Commission">Tier 2</a>
                <a href="javascript:void(0);" class="{{($currentMonth > 0)?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 1 (Standard)" data-content="2% Commission">Tier 1</a>
            </div> -->
            <div class="triangle-block">
                <a href="javascript:void(0);" class="{{Auth::user()->tier_type=='tier-4'?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 4" data-content="Have to sell £50,000 worth of products – 5% Commission ">Tier 4</a>
                <a href="javascript:void(0);" class="{{(Auth::user()->tier_type=='tier-3' || Auth::user()->tier_type=='tier-4')?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 3" data-content="Have to sell £20,000 worth of products – 3% Commission">Tier 3</a>
                <a href="javascript:void(0);" class="{{(Auth::user()->tier_type=='tier-2' || Auth::user()->tier_type=='tier-3' || Auth::user()->tier_type=='tier-4')?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 2" data-content="Have to sell £10,000 worth of products – 2.5% Commission">Tier 2</a>
                <a href="javascript:void(0);" class="{{(Auth::user()->tier_type=='tier-1'||Auth::user()->tier_type=='tier-2'||Auth::user()->tier_type=='tier-3'||Auth::user()->tier_type=='tier-4')?'active_tier':''}}" data-placement="top" data-trigger="focus" data-toggle="popover" title="Tier 1 (Standard)" data-content="2% Commission">Tier 1</a>
            </div>
        </div>
        <div class="sales-chart-row">
            <h4 class="vr-heading">Sales (£)</h4>
            <div class="sales-chart">
                <canvas id="myChart"></canvas>
                <h4>Month</h4>
            </div>
        </div>
        <div class="affiliate-table">
            <div class="table-responsive">
                <table class="table table-borderless m-0 fixed-header">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Sales</th>
                            <th>% Change</th>
                            <th>Units Sold</th>
                            <th>% Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataTableData as $data)
                            @php
                            if($data['total_price'] > 10000 && $data['total_price'] < 20000){
                                $commissionPercentage = 2.5;
                                $commission = ($data['total_price'] * 2.5) / 100;
                            }elseif($data['total_price'] > 20000 && $data['total_price'] < 50000){
                                $commissionPercentage = 3;
                                $commission = ($data['total_price'] * 3) / 100;
                            }elseif($data['total_price'] > 50000){
                                $commissionPercentage = 5;
                                $commission = ($data['total_price'] * 5) / 100;
                            }elseif($data['total_price'] < 1){
                                $commissionPercentage = 0;
                                $commission = 0;
                            }else{
                                $commissionPercentage = 2; 
                                $commission = ($data['total_price'] * 2) / 100;
                            }
                            @endphp
                            <tr>
                                <td>{{$data['month']}}</td>
                                <td>£{{number_format((float)$data['total_price'], 2, '.', '')}}</td>
                                <td>{{$commissionPercentage}}</td>
                                <td>{{$data['quantity']}}</td>
                                <td>£{{number_format((float)$commission, 2, '.', '')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script> 
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
        new Chart(document.getElementById("myChart"), {
            type: "line",
            data: {
                labels: @json($monthName),
                datasets: [
                {
                    label: " Sales",
                    data: @json($monthDataGraph),
                    fill: true,
                    borderColor: "rgb(0, 169, 236)",
                    backgroundColor: "rgba(0,0,0,0.0)",
                    borderWidth: 2,
                    lineTension: 0,
                    /* point options */
                    pointBorderColor: "rgb(0, 169, 236)", // blue point border
                    pointBackgroundColor: "rgb(0, 169, 236)", // wite point fill
                    pointBorderWidth: 5, // point border width
                }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';

                                if (label) {
                                label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'GBP'
                                    }).format(context.parsed.y); 
                                }
                                return label;
                            }
                        }
                    }
                },
                legend: {
                    labels: {
                        usePointStyle: true, // show legend as point instead of box
                        fontSize: 10 // legend point size is based on fontsize
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                }
            },
        });
    </script>

@endsection
@section('scripts')
@endsection