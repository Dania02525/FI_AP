@extends('layouts.master')

@section('content')

<aside class="right-side">                

	<section class="content-header">
		<h1 class="pull-left">
			{{ trans('fi.view_vendor') }}
		</h1>
		<div class="pull-right">
			<a href="{{ route('vendors.edit', array($vendor->id)) }}" class="btn btn-default">{{ trans('fi.edit') }}</a>
			<a class="btn btn-default" href="{{ route('vendors.delete', array($vendor->id)) }}" onclick="return confirm('{{ trans('fi.delete_vendor_warning') }}');"><i class="fa fa-trash"></i> {{ trans('fi.delete') }}</a>
		</div>
		<div class="clearfix"></div>
	</section>

	<section class="content">

		@include('layouts._alerts')

		<div class="row">

			<div class="col-xs-12">

				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-details">{{ trans('fi.details') }}</a></li>
						<li><a data-toggle="tab" href="#tab-expenses">{{ trans('fi.expenses') }}</a></li>
					</ul>
					<div class="tab-content">

						<div id="tab-details" class="tab-pane active">

							<div class="row">

								<div class="col-md-12">

									<div class="pull-left">
										<h2>{{{ $vendor->name }}}</h2>
									</div>

									<div class="pull-right" style="text-align: right;">
										<p>
											<br>
											<strong>{{ trans('fi.total_expenses') }}:</strong> {{ $vendor->formatted_total }}
										</p>
									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-md-12">

									<table class="table table-striped">
										<tr>
											<td class="col-md-2">{{ trans('fi.address') }}</td>
											<td class="col-md-10">{{ $vendor->formatted_address }}</td>
										</tr>
										<tr>
											<td class="col-md-2">{{ trans('fi.email') }}</td>
											<td class="col-md-10"><a href="mailto:{{{ $vendor->email }}}">{{{ $vendor->email }}}</a></td>
										</tr>
										<tr>
											<td class="col-md-2">{{ trans('fi.phone') }}</td>
											<td class="col-md-10">{{{ $vendor->phone }}}</td>
										</tr>
										<tr>
											<td class="col-md-2">{{ trans('fi.mobile') }}</td>
											<td class="col-md-10">{{{ $vendor->mobile }}}</td>
										</tr>
										<tr>
											<td class="col-md-2">{{ trans('fi.fax') }}</td>
											<td class="col-md-10">{{{ $vendor->fax }}}</td>
										</tr>
										<tr>
											<td class="col-md-2">{{ trans('fi.web') }}</td>
											<td class="col-md-10"><a href="{{{ $vendor->web }}}" target="_blank">{{{ $vendor->web }}}</a></td>
										</tr>
										
									</table>

								</div>

							</div>

						</div>

						<div id="tab-expenses" class="tab-pane">
                            <div class="panel panel-default">
                                @include('expenses._table')
                                <div class="panel-footer"><p class="text-center"><strong><a href="{{ route('expenses.index') }}?vendor={{ $vendor->id }}">{{ trans('fi.view_all_expenses_for_vendor') }}</a></strong></p></div>
                            </div>
                        </div>
									

					</div>
				</div>

			</div>

		</div>

	</section>

</aside>
@stop
