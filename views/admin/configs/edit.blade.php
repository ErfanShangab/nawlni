@extends('admin.default')

@section('page-header')
	تعديل بيانات كابتن 
@stop
{{-- <small>{{ trans('app.update_item') }}</small> --}}
@section('content')
	{!! Form::model($item, [
			'action' => ['ConfigController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('admin.configs.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
