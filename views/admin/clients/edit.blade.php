@extends('admin.default')

@section('page-header')
	تعديل بيانات عميل 
@stop
{{-- <small>{{ trans('app.update_item') }}</small> --}}
@section('content')
	{!! Form::model($item,[
			'action' => ['ClientController@update', $item->id],
			'method' => 'PUT', 
			'files' => true
		])
	!!}
	<div class="row mB-40">
		<div class="col-sm-8">
			<div class="bgc-white p-20 bd">

				<div class="form-group form-md-line-input">
                    <label for="name">إسم العميل</label>
                    <input class="form-control" name="name" id="name" type="text" required="true" value="{{$item->User->name}}">
				</div>
				
				

                <div class="form-group form-md-line-input">
                    <label for="phone">رقم الهاتف </label>
                    <input class="form-control" name="phone" id="phone" type="number"  value="{{$item->User->phone}}">
                </div>

                <div class="form-group form-md-line-input">
                    <label for="email">البريد الإلكتروني </label>
                    <input class="form-control" name="email" id="email" type="email"  value="{{$item->User->email}}">
                </div>
					   
				
			
		
				
		
				{{ Form::hidden('role', 'merchant') }}
				
				{!! Form::select('type', 
				['merchant' => 'تاجر', 'pharmacy' => 'صيدلية', 'resturant' => 'مطعم'] ,
				'type',['class' => 'form-control'])!!}
	
		
	<div class="form-group line-input">

		{{ Form::label("تفاصيل العميل", null, ['class' => 'control-label']) }}
	 
	</div>
				
	<div class="form-group form-md-line-input">
		<textarea class="form-control my-editor" name="details" rows="10">{{$item->User->details}}</textarea >
	</div>

	
	{!! Form::myFile('avatar', ' العلامة التجارية  ' ,['class' => 'form-control']   ) !!}
	
	
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
