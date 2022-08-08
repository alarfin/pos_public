@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_sale_product', 'active')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Sale Product Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_sale_product') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Company Branch </label>
                                    <select class="form-control select2" name="company_branch_id" id="company_branch_id">
                                        <option value="">All branch </option>
                                        @foreach ($company_branches as $company_branch)
                                            <option value="{{ $company_branch->id }}"
                                                {{ request()->get('company_branch_id') == $company_branch->id ? 'selected' : '' }}>
                                                {{ $company_branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="start_date"
                                            name="start_date" value="{{ date('Y-m-d', strtotime($start_date)) }}"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="end_date"
                                            name="end_date" value="{{ date('Y-m-d', strtotime($end_date)) }}"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('customer') ? 'has-error' : '' }}">
                                    <label> Customer </label>
                                    <select class="form-control customer" name="customer_id" id="customer_id"
                                        data-placeholder="Select customer">
                                        <option value=""> Select customer </option>
                                        @if (request()->get('customer_id'))
                                            <option value="{{ request()->get('customer_id') }}" selected>
                                                {{ App\Models\Customer::find(request()->get('customer_id'))->name ?? '' }}
                                            </option>
                                        @endif
                                    </select>

                                    @error('customer')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Product </label>
                                    <select class="form-control select2" name="product_id">
                                        <option value="">All product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ request()->get('supplier') == $product->id ? 'selected' : '' }}>
                                                {{ $product->code }} - {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Sale Invoice no.</label>
                                    <input type="text" class="form-control" name="invoice_no"
                                        value="{{ request()->get('invoice_no') }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> &nbsp;</label>
                                    <input class="btn btn-primary form-control" type="submit" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-info pull-right" onclick="startPrint()"> Print
                            </button>
                        </div>
                    </div>
                    <div class="print_area">
                        <div class="row">
                            <div class="col-xs-8">
                                <div>
                                    <img src="{{ url('storage/app/' . $setting->logo) }}" alt="Logo" height="50">
                                </div>
                                <div class="company_info">
                                    {{ $setting->address }} <br>
                                    <b>Mobile:</b> {{ $setting->mobile_no }} <br>
                                    <b>Email:</b> {{ $setting->email }} <br>
                                    <b>Web:</b> {{ $setting->web }} <br>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div>
                                    <h3> Sale Product Report</h3>
                                    <b>
                                        Date : {{ date('d-m-Y', strtotime($start_date)) }} to
                                        {{ date('d-m-Y', strtotime($end_date)) }} <br>
                                    </b>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th> Date </th>
                                    <th> Invoice no.</th>
                                    <th> Branch name </th>
                                    <th> Customer </th>
                                    <th> Product </th>
                                    <th class="text-right"> Quantity </th>
                                    <th class="text-right"> Unit Price </th>
                                    <th class="text-right"> Total Price </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->date->format('j F, Y') }}</td>
                                        <td>{{ $order->invoice_no }}</td>
                                        <td>{{ $order->companyBranch->name ?? '' }}</td>
                                        <td>{{ $order->customer->name ?? '' }}</td>
                                        <td> {{ $order->code }} {{ $order->name }}</td>
                                        <td class="text-right">{{ $order->quantity }}</td>
                                        <td class="text-right">{{ number_format($order->unit_price, 2) }}</td>
                                        <td class="text-right">{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-right">Total</th>
                                    <td class="text-right">{{ number_format($orders->sum('quantity'), 2) }}</td>
                                    <td class="text-right">
                                        {{-- {{ number_format($orders->sum('unit_price'), 2) }} --}}
                                    </td>
                                    <td class="text-right">{{ number_format($orders->sum('total'), 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                Printed By {{ Auth::user()->name }}, Printing Time: {{ date('d M-Y h:i a') }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}">
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
            $(function() {
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                });
            });

            // Datatable
            $('.datatable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "ordering": false
            });
        });

        // Get customer
        $(document).ready(function() {
            $('#customer_id').select2({
                placeholder: 'Select customer',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_customers') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        const empty_customer = {
                            id: 0,
                            name: 'Select customer',
                            mobile_no: '',
                        }
                        data.unshift(empty_customer);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name + ' - ' + item.mobile_no,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            })
        });

        // Print Option
        function startPrint() {
            $('.dataTables_length').hide();
            $('.dataTables_filter').hide();
            $('.pagination').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace('{!! url()->full() !!}')
        }
    </script>
@endsection
