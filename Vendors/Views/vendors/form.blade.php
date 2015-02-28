@extends('layouts.master')

@section('content')

@if ($editMode == true)
{{ Form::model($vendor, array('route' => array('vendors.update', $vendor->id))) }}
@else
{{ Form::open(array('route' => 'vendors.store')) }}
@endif

<aside class="right-side">                

	<section class="content-header">
		<h1 class="pull-left">
			{{ trans('fi.vendor_form') }}
		</h1>
		<div class="pull-right">
			{{ Form::submit(trans('fi.save'), array('class' => 'btn btn-primary')) }}
		</div>
		<div class="clearfix"></div>
	</section>

	<section class="content">

		@include('layouts._alerts')

		<div class="row">

			<div class="col-md-12">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">{{ trans('fi.personal_information') }}</h3>
					</div>
					
					<div class="box-body">						

						<div class="form-group">
							<label>{{ trans('fi.vendor_name') }}</label>
							{{ Form::text('name', null, array('id' => 'name', 'class' => 'form-control')) }}
						</div>

						<div class="form-group">
							<label>{{ trans('fi.address') }}: </label>
							{{ Form::textarea('address', null, array('id' => 'address', 'class' => 'form-control', 'rows' => 4)) }}
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">{{ trans('fi.phone_number') }}: </label>
									{{ Form::text('phone', null, array('id' => 'phone', 'class' => 'form-control')) }}
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">{{ trans('fi.fax_number') }}: </label>
									{{ Form::text('fax', null, array('id' => 'fax', 'class' => 'form-control')) }}
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">{{ trans('fi.mobile_number') }}: </label>
									{{ Form::text('mobile', null, array('id' => 'mobile', 'class' => 'form-control')) }}
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ trans('fi.email_address') }}: </label>
									{{ Form::text('email', null, array('id' => 'email', 'class' => 'form-control')) }}
								</div>

							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ trans('fi.web_address') }}: </label>
									{{ Form::text('web', null, array('id' => 'web', 'class' => 'form-control')) }}
								</div>
							</div>
						</div>

					</div>

			</div>

			</div>
			
		</div>

	</section>

</aside>

{{ Form::close() }}
@stop