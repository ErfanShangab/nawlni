@extends('admin.default')

@section('page-header')
	   عميل جديد
@stop
{{-- <small>{{ trans('app.add_new_item') }}</small> --}}

 
@section('content')
	{!! Form::open([
			'action' => ['ClientController@store'],
			'files' => true
		])
	!!}

		@include('admin.clients.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop


{{-- 
@section('content')
<form action="{{route('admin.clients.store')}}" method="Post" enctype="multipart/form-data">
	{{csrf_field()}}
		@include('admin.clients.form') --}}

	  {{-- <div class="form-group form-md-line-input">
		  <input class="form-control" name="name" id="name" type="text"  value="sdsdsdsdsd"required="true">
		  
		  <label for="name">إسم الأستاذ</label>
	  </div>

	  <div class="form-group form-md-line-input">
		  <input class="form-control" name="phone" id="phone" value="sdsdsdsdsd" type="number" >
		  <label for="phone">رقم الهاتف </label>
	  </div>

	  <div class="form-group form-md-line-input">
		  <input class="form-control" name="email" id="email" type="text"  >
		  <label for="email">البريد الإلكتروني</label>
	  </div>

	  <div class="form-group form-md-line-input">
		  <input class="form-control" name="password" id="password" type="password" value="sdsdsdsdsd" required="true">
		  <label for="password">كلمة المرور </label>
	  </div>

	  <div class="form-group form-md-line-input">
		<input class="form-control" name="password_confirmation" id="password_confirmation" value="sdsdsdsdsd" type="password" required="true">
		<label for="password">كلمة المرور </label>
	</div>
		 
 
 
	  
	  <div class="form-group form-md-line-input has-info">
		  <select class="form-control" id="role" name="role">
			  <option value="client"></option>
			 
		  </select>
	  </div>

	  <div class="form-group form-md-line-input has-info">
		<select class="form-control" id="type" name="type">
			<option value="client"></option>
		   
		</select>
	</div>




	  <div class="form-group form-md-line-input">
		  <textarea class="form-control my-editor" name="details" rows="10">sddsdsd</textarea required="true">
		  <label for="form_control_1">السيرة الذاتية  للأستاذ</label>
	  </div>

	  <div class="form-body">
			  <div class="form-group form-md-line-input">
				  <input class="form-control" name="avatar" id="avatar" type="file" required="true" accept="image/*">
				  <label for="image">صورة الأستاذ</label>
			  </div>
	  </div> --}}

		{{-- <div class="form-actions noborder left-align">
			<button type="submit" class="btn blue">حفظ</button>
			<button type="button" class="btn default">إلغاء</button>
		</div> --}}
	{{-- </div>
  </form> --}}
	
