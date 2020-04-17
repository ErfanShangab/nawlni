@extends('admin.default')

@section('page-header')
	 طلبية جديد
@stop
{{-- <small>{{ trans('app.add_new_item') }}</small> --}}
@section('content')
	{!! Form::open([
			'action' => ['CustomerController@store'],
			'files' => true
		])
	!!}

		@include('admin.customers.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
