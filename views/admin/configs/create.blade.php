@extends('admin.default')

@section('page-header')
	   بند جديد
@stop
{{-- <small>{{ trans('app.add_new_item') }}</small> --}}
@section('content')
	{!! Form::open([
			'action' => ['ConfigController@store'],
			'files' => true
		])
	!!}

		@include('admin.configs.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
