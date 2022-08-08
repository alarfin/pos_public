@extends('layouts.app')
@section('hr', 'active menu-open')
@section('salary_process', 'display: block')
@section('salary_process_add', 'active')
@section('title')
    Salary process add
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Salary process Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('salary_process_add') }}">
                    @csrf

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Company branch *</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="company_branch_id"
                                            id="company_branch_id">
                                            <option value="" disabled selected> Select branch</option>
                                            @foreach ($branches as $brach)
                                                <option value="{{ $brach->id }}"
                                                    @if (old('company_branch_id') == $brach->id) selected @endif>{{ $brach->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('company_branch_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Process Date *</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="date" class="form-control date"
                                            value="{{ date('Y-m-d') }}" required autocomplete="off">
                                        @error('date')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Year *</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="year" id="year">
                                            <option value="" disabled selected> Select year </option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year->name }}"
                                                    @if (old('year') == $year->id) selected @endif>{{ $year->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('year')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('month') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Month *</label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="month" id="month">
                                            <option value="" disabled selected> Select month </option>
                                        </select>
                                        @error('month')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Payment Method *</label>
                                    <div class="col-sm-12">
                                        <select name="payment_method" id="payment_method" class="form-control select2">
                                            <option value="1" @if (old('payment_method') == 1) selected @endif> Cash
                                                In Hand </option>
                                            <option value="2" @if (old('payment_method') == 2) selected @endif> Bank
                                            </option>
                                        </select>
                                        @error('payment_method')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" id="bank_part" style="display: none;">
                                <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Bank *</label>
                                    <div class="col-sm-12">
                                        <select name="bank_id" id="bank_id" class="form-control select2">
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    @if (old('bank_id') == $bank->id) selected @endif>
                                                    {{ $bank->account_no }} - {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('bank_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('themes/backend/js/sweetalert2.js') }}"></script>
    <script>
        $(function() {
            // Select2
            $('.select2').select2();
            // Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('body').on('change', '#payment_method', function() {
                if ($(this).val() == 2) {
                    $('#bank_part').show();
                } else {
                    $('#bank_part').hide();
                }
            })
            $('#payment_method').trigger('change');

            $('body').on('change', '#year,#company_branch_id', function() {
                var company_branch_id = $('#company_branch_id').val();
                var year = $('#year').val();
                var options = '<option value="" disabled> Select Month </option>';
                if (year && company_branch_id) {
                    $.ajax({
                        method: 'GET',
                        url: '{{ route('get_salary_month') }}',
                        data: {
                            year: year,
                            company_branch_id: company_branch_id
                        },
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            options += '<option value="' + item.name + '"> ' + item
                                .full_name + ' </option>';
                        })
                        $('#month').html(options);
                    })
                } else {
                    $('#month').html(options);
                    return false;
                }
            })
        })
    </script>
@endsection
