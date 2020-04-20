@extends('admin.default')

@section('page-header')
	تعديل بيانات منتج 
@stop
{{-- <small>{{ trans('app.update_item') }}</small> --}}
@section('content')
	{!! Form::model($item, [
			'action' => ['ProductController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('name', 'name', 'إسم المنتج') !!}
		
			{!! Form::myInput('details', 'details', 'تفاصيل المنتج') !!}
	
			
 
	
	<div class="form-group form-md-line-input form-md-floating-label">
		<label for="college"> اضافة كإعلان  </label>
		  <select class="form-control" v-model="is_advetise" name="is_advetise" id="is_advetise" required >
			<option value="false">ليس اعلانا </option>
		   <option value="true">اعلان</option>
		</select>
	  </div>
 

	 <div class="form-group  ">
	  <label for="image">صورة المنتج  </label>
	  <input class="form-control" name="image" id="image" type="file" required="true" accept="image/*">
  </div>

	@if (isset($item) && $item->image)
		<div class="col-sm-4">
			<div class="bgc-white p-20 bd">
				<img src="{{ $item->image }}" alt="">
			</div>
		</div>
	@endif
</div>

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
