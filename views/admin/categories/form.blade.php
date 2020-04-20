<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'إسم التصنيف') !!}
			{!! Form::myInput('text', 'details', 'تفاصيل التصنيف') !!}
			{!! Form::myFile('image', 'صورة التصنيف  ') !!}
	
		 
		</div>  
	</div>
	@if (isset($item) && $item->image)
		<div class="col-sm-4">
			<div class="bgc-white p-20 bd">
				<img src="{{ $item->image }}" alt="">
			</div>
		</div>
	@endif
</div>