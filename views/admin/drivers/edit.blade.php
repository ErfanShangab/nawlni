@extends('admin.default')

@section('page-header')
	تعديل بيانات كابتن 
@stop
{{-- <small>{{ trans('app.update_item') }}</small> --}}
@section('content')
	{!! Form::model($item, [
			'action' => ['DriverController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		{{-- @include('admin.drivers.form') --}}


		<div class="row mB-40">
			<div class="col-sm-8">
				<div class="bgc-white p-20 bd">
	
					<div class="form-group form-md-line-input">
						<label for="name">إسم الكابتن</label>
						<input class="form-control" name="name" id="name" type="text" required="true" value="{{$item->User->name}}">
					</div>
	
					<div class="form-group form-md-line-input">
						<label for="phone">رقم الهاتف </label>
						<input class="form-control" name="phone" id="phone" type="text"  value="{{$item->User->phone}}">
					</div>
	
					<div class="form-group form-md-line-input">
						<label for="email">البريد الإلكتروني </label>
						<input class="form-control" name="email" id="email" type="email"  value="{{$item->User->email}}">
					</div>
						   
					<div class="form-group form-md-line-input">
						<label for="name">رقم المركبة  </label>
						<input class="form-control" name="vehicle_id" id="vehicle_id" type="text" required="true" value="{{$item->vehicle_id}}">
					</div>
	
					{{ Form::hidden('role', 'driver') }}
					
				 
		
		{!! Form::myFile('avatar', '  صورة الكابتن    ' ,['class' => 'form-control']  , 'User[avatar]' ) !!}
		
		
					{{-- {!! Form::myTextArea('bio', 'Bio') !!} --}}
				</div>  
			</div>
			@if (isset($item) && $item->avatar)
				<div class="col-sm-4">
					<div class="bgc-white p-20 bd">
						<img src="{{ $item->avatar }}" alt="">
					</div>
				</div>
			@endif
		</div>
	
		 
		

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
