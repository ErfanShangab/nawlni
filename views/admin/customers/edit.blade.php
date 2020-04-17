@extends('admin.default')

@section('page-header')
	تعديل بيانات عميل 
@stop
{{-- <small>{{ trans('app.update_item') }}</small> --}}
@section('content')
	{!! Form::model($item, [
			'action' => ['CustomerController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('admin.customers.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
