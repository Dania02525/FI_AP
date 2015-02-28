<table class="table table-hover">

	<thead>
		<tr>
			<th>{{ trans('fi.vendor_name') }}</th>
			<th>{{ trans('fi.email_address') }}</th>
			<th>{{ trans('fi.phone_number') }}</th>
			<th>{{ trans('fi.options') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($vendors as $vendor)
		<tr>
			<td>{{ link_to_route('vendors.show', $vendor->name, array($vendor->id)) }}</td>
			<td>{{{ $vendor->email }}}</td>
			<td>{{{ $vendor->phone }}}</td>
			<td>
				<div class="btn-group">
					<a href="{{ route('vendors.show', array($vendor->id)) }}" class="btn btn-sm btn-default" title="{{ trans('fi.view') }}"><i class="fa fa-search"></i></a> 
					<a href="{{ route('vendors.edit', array($vendor->id)) }}" class="btn btn-sm btn-default" title="{{ trans('fi.edit') }}"><i class="fa fa-edit"></i></a> 
					<a href="{{ route('vendors.delete', array($vendor->id)) }}" class="btn btn-sm btn-default" title="{{ trans('fi.delete') }}" onclick="return confirm('{{ trans('fi.delete_vendor_warning') }}');"><i class="fa fa-trash-o"></i></a> 
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>