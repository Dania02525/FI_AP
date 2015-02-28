@extends('layouts.master')

@section('jscript')

<script type="text/javascript">

	var expenseEditRoute      = '{{ route('expenses.edit', array($expense->id)) }}';
	var expenseUpdateRoute    = '{{ route('expenses.update', array($expense->id)) }}';
	var expenseId             = {{ $expense->id }};

</script>

@include('layouts._datemask')
@include('layouts._typeahead')

<script src="{{ asset('js/plugins/jquery-autosize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/FI/expense_edit.js') }}" type="text/javascript"></script>

@stop

@section('content')

<aside class="right-side">

    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.expense') }} #{{{ $expense->number }}}</h1>
    <div class="pull-right">
    
        <div class="btn-group">
            @if ($backPath)
            <a href="{{ URL::to($backPath) }}" class="btn btn-default"><i class="fa fa-backward"></i> {{ trans('fi.back') }}</a>
            @endif
        </div>
         <div class="btn-group">
            <button type="button" class="btn btn-primary btn-save-expense"><i class="fa fa-save"></i> {{ trans('fi.save') }}</button>
        </div>
    </div>
    
        <div class="clearfix"></div>
    </section>

    <section class="content">
    
    <div class="row">
    
       <div class="col-lg-10">
        
            @include('layouts._alerts')
        
            <div id="form-status-placeholder"></div>

            <div class="row">
        
                <div class="col-sm-12 table-responsive">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('fi.expense_details') }}</h3>
                            
                        </div>
        
                        <div class="box-body">
                            <table id="item-table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 25%;">{{ trans('fi.payee') }}</th>
                                    <th style="width: 15%;">{{ trans('fi.date') }}</th>
                                    <th style="width: 50%;">{{ trans('fi.note') }}</th>
                                    <th style="width: 10%;">{{ trans('fi.amount') }}</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <tr >
                                	{{ Form::hidden('expense_id', $expense->id) }}                                   
                                    <td>{{ Form::text('vendor_name', $expense->vendor->name, array('class' => 'form-control', 'id' => 'vendor_name')) }}</td>
                                    <td>{{ Form::text('date', $expense->formatted_date, array('class' => 'form-control', 'id' => 'date')) }}</td>
                                    <td>{{ Form::text('note', $expense->note, array('class' => 'form-control', 'id' => 'note')) }}</td>
                                    <td>{{ Form::text('amount', $expense->amount, array('class' => 'form-control', 'id' => 'amount')) }}</td>
                                </tr>                               
                                </tbody>
                            </table>
                        </div>
        
                    </div>
                </div>
        
            </div>
    </section>

</aside>

@stop