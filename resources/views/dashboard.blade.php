@extends('layouts.app')

@section('title')
    Dashboard
@endsection
@section('style')
    <style>
        .inner h3 {
            text-align: center;
            font-size: 16px !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today's Sale</span>
                    <span class="info-box-number">{{ number_format($today_sale, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today's Paid Sale</span>
                    <span class="info-box-number">{{ number_format($today_paid_sale, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-star"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Today's Due Sale</span>
                    <span class="info-box-number">{{ number_format($today_due_sale, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Sale</span>
                    <span class="info-box-number">{{ number_format($total_sale, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Paid Sale</span>
                    <span class="info-box-number">{{ number_format($total_paid_sale, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-star"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Due Sale</span>
                    <span class="info-box-number">{{ number_format($total_due_sale, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> Latest Sales Order</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Customer Name</th>
                                    <th>Total</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_sale_orders as $sale_order)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('sale_order_details', ['sale_order' => $sale_order->id]) }}">{{ $sale_order->invoice_no }}</a>
                                        </td>
                                        <td>{{ $sale_order->customer->name }}</td>
                                        <td>{{ number_format($sale_order->total, 2) }}</td>
                                        <td>{{ $sale_order->date->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"> Latest Purchase Order</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Supplier</th>
                                    <th>Total</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latest_purchase_orders as $purchase_order)
                                    <tr>
                                        <td><a
                                                href="{{ route('purchase_order_details', ['purchase_order' => $purchase_order->id]) }}">{{ $purchase_order->invoice_no }}</a>
                                        </td>
                                        <td>{{ $purchase_order->supplier->name }}</td>
                                        <td>{{ number_format($purchase_order->total, 2) }}</td>
                                        <td>{{ $purchase_order->date->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales History</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <canvas id="chart-sales-amount" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Order Count History</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <canvas id="chart-order-count" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/backend/plugins/chartjs/Chart.bundle.min.js') }}"></script>
    <script>
        var saleAmountLabel = <?php echo $sale_amount_label; ?>;
        var saleAmount = <?php echo $sale_amount; ?>;
        var orderCount = <?php echo $order_count; ?>;

        var ctx = document.getElementById('chart-sales-amount');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: saleAmountLabel,
                datasets: [{
                    label: 'Sales Amount',
                    data: saleAmount,
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor: 'rgba(60,141,188,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                tooltips: {
                    displayColors: false,
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return "" + tooltipItems.yLabel;
                        }
                    }
                }
            }
        });

        var ctx2 = document.getElementById("chart-order-count").getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: saleAmountLabel,
                datasets: [{
                    data: orderCount,
                    backgroundColor: 'rgba(60, 141, 188, 0.2)',
                    borderColor: 'rgba(60,141,188,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                tooltips: {
                    displayColors: false
                }
            }
        });
    </script>
@endsection
