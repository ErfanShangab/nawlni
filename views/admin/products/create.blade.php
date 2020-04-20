@extends('admin.default')

@section('page-header')
	منتج جديد
@stop
{{-- <small>{{ trans('app.add_new_item') }}</small> --}}
@section('content')
	{!! Form::open([
			'action' => ['ProductController@store'],
			'files' => true
		])
	!!}

		@include('admin.products.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
