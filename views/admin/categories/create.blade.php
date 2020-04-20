@extends('admin.default')

@section('page-header')
	تصنيف جديد
@stop
@section('content')
	{!! Form::open([
			'action' => ['CategoryController@store'],
			'files' => true
		])
	!!}
		@include('admin.categories.form')
		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
	{!! Form::close() !!}
	
@stop
