@include('layouts._datemask')
@include('layouts._typeahead')

<script type="text/javascript">
    var storeExpenseRoute = '{{ route('expenses.store') }}';
    var createExpenseReturnUrl = '{{ url('expenses') }}';
    var vendorNameLookupRoute = '{{ route('vendors.ajax.nameLookup') }}';
    
</script>
<script src="{{ asset('js/FI/expense_create.js') }}" type="text/javascript"></script>
<div class="modal fade" id="create-expense">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('fi.add_expense') }}</h4>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.payee') }}</label>
                        <div class="col-sm-9">
                            {{ Form::text('vendor_name', null, array('id' => 'vendor_name', 'class' => 'form-control vendor-lookup', 'autocomplete' => 'off')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.expense_date') }}</label>
                        <div class="col-sm-9">
                            {{ Form::text('date', date(Config::get('fi.dateFormat')), array('id' => 'date', 'class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.amount') }}</label>
                        <div class="col-sm-9">
                            {{ Form::text('amount', null, array('id' => 'amount', 'class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.note') }}</label>
                        <div class="col-sm-9">
                            {{ Form::text('note', null, array('id' => 'note', 'class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.group') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('invoice_group_id', $invoiceGroups, Config::get('fi.expenseGroup'), array('id' => 'create_invoice_group_id', 'class' => 'form-control')) }}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <button type="button" id="expense-create-confirm" class="btn btn-primary">{{ trans('fi.submit') }}</button>
            </div>
        </div>
    </div>
</div>