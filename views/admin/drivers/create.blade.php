@extends('admin.default')

@section('page-header')
	   كابتن جديد
@stop
{{-- <small>{{ trans('app.add_new_item') }}</small> --}}
@section('content')
	{!! Form::open([
			'action' => ['DriverController@store'],
			'files' => true
		])
	!!}

		@include('admin.drivers.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
