<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('name', 'name', 'إسم العميل') !!}
		
			{!! Form::myInput('email', 'email', 'البريد الإلكتروني') !!}
	
			{!! Form::myInput('password', 'password', 'كلمة السر ') !!}
	
			
			{!! Form::myInput('password', 'password_confirmation', ' تأكيد كلمة السر') !!}
			{!! Form::myInput('phone', 'phone', ' رقم الهاتف') !!}
	
			{{ Form::hidden('role', 'client') }}
			
			{{-- {!! Form::mySelect('role', 'Role', config('variables.role'), null, ['class' => 'form-control select2']) !!} --}}
			{!! Form::select('type', 
			['merchant' => 'تاجر', 'pharmacy' => 'صيدلية', 'resturant' => 'مطعم'] ,
			'type',['class' => 'form-control'])!!}

	
<div class="form-group">
	{{ Form::label("تفاصيل العميل", null, ['class' => 'control-label']) }}
	{!! Form::textarea('details', null, [
		'class'      => 'form-control',
		'rows'       => 4, 
		'name'       => 'txt',
	 
	 
	]) !!}
</div>

 

<div class="form-group  ">
	<label for="avatar">العلامة التجارية  </label>
	<input class="form-control" name="avatar" id="avatar" type="file" required="true" accept="image/*">
</div>
</div>
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