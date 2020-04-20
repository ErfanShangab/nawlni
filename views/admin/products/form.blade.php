<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('name', 'name', 'إسم المنتج') !!}
		
			{!! Form::myInput('details', 'details', 'تفاصيل المنتج') !!}
	
			
			<div class="form-group form-md-line-input form-md-floating-label">
				<label for="college">صاحب المنتج</label>
				<select class="form-control" v-model="client_id" name="client_id" id="client_id" required >
					<option value=""></option>
					@foreach($clients as $client)
					  <option value="{{ $client->id }}">{{ $client->User->name }}</option>
					@endforeach
				</select>
			</div>
	
	<div class="form-group form-md-line-input form-md-floating-label">
		<label for="category"> التصنيف  </label>
		<select class="form-control" v-model="category" name="category_id" id="category_id" required >
			<option value=""></option>
			@foreach($categories as $category)
			  <option value="{{ $category->id }}">{{ $category->name }}</option>
			@endforeach
		</select>
	</div>

	
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