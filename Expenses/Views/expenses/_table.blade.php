<table class="table table-hover">

	<thead>
		<tr>
			<th>{{ trans('fi.expense') }}</th>
			<th>{{ trans('fi.payee') }}</th>
			<th>{{ trans('fi.date') }}</th>
			<th>{{ trans('fi.note') }}</th>
			<th style="text-align: right; padding-right: 25px;">{{ trans('fi.amount') }}</th>
			<th>{{ trans('fi.options') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($expenses as $expense)
		<tr>
			<td><a href="{{ route('expenses.edit', array($expense->id)) }}" title="{{ trans('fi.edit') }}">{{ $expense->number }}</a></td>
			<td>{{ $expense->vendor->name }}</td>
			<td>{{ $expense->formatted_date }}</td>
			<td>{{ $expense->note }}</td>
			<td style="text-align: right; padding-right: 25px;">{{ $expense->formatted_amount }}</td>
			<td>
				<div class="btn-group">
					<a href="{{ route('expenses.edit', array($expense->id)) }}" class="btn btn-sm btn-default" title="{{ trans('fi.edit') }}"><i class="fa fa-edit"></i></a> 
					<a href="{{ route('expenses.delete', array($expense->id)) }}" class="btn btn-sm btn-default" title="{{ trans('fi.delete') }}" onclick="return confirm('{{ trans('fi.delete_record_warning') }}');"><i class="fa fa-trash-o"></i></a> 
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>