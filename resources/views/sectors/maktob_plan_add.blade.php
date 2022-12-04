@extends('layouts.sector_layouts.sector_layout')
@section('content')

 @if(Session::has('error_message'))  
<div class="alert alert-danger" rol="alert" style="margin-top: 10px;color:white;">
	{{ Session::get('error_message') }}
<button type="button" class="close" data-dismiss="alert" aria-lable="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
@endif
@if(Session::has('success_message'))  
<div class="alert alert-success" rol="alert" style="margin-top: 10px;color:white;">
	{{ Session::get('success_message') }}
<button type="button" class="close" data-dismiss="alert" aria-lable="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger" style="color:white;">
<ul>
	@foreach ( $errors->all() as $error )
	<li> {{ $error }} </li>
	@endforeach
</ul>
</div>
@endif
 
<div class="container" style="background-color: white;border-radius: 10px;box-shadow: 1px 2px 12px 12px silver;margin-bottom:2rem">
	<h4  style="text-align:center;">ثبت مکتوب پلان</h4>
	<hr/>
	<div class="custom-modal-text text-left">
		<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.maktob_plan_add') }}" >
		@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر صلاحیت نامه مربوطه:</label>
						<select class="form-control"  id="maktob_no" name="maktob_no" >
							<option> </option>
							@foreach($maktob_numbers as $data)
								<option value="{{ $data->maktob_no }}" @if(!empty(@old('maktob_no')) && $data['maktob_no']==@old('maktob_no')) selected @endif> {{ $data->maktob_no }} </option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="plan_no" class="control-label">نمبر مکتوب پلان:</label>
						<input type="text" id="plan_no" name="plan_no" class="form-control" value="{{ old('plan_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="plan_date" class="control-label">تاریخ مکتوب پلان:</label>
						<input type="text" id="plan_date" name="plan_date" data-targetselector="#plan_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('plan_date')}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="plan_status" class="control-label">حالت پلان:</label>
						<select name="plan_status" id="plan_status" class="form-control">
							<option> </option>
							<option value="تائید">تائید</option>
							<option value="رد">رد</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="quality" class="control-label">کیفیت پلان:</label>
						<select name="quality" id="quality" class="form-control">
							<option> </option>
							<option value="عالی">عالی</option>
							<option value="خوب">خوب</option>
							<option value="متوسط">متوسط</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="verify_date" class="control-label">تاریخ ارائه پلان جهت منظوری به مقام:</label>
						<input type="text" id="verify_date" name="verify_date" data-targetselector="#verify_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('verify_date')}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="rmaktob_no" class="control-label">نمبر مکتوب جواب:</label>
						<input type="text" id="rmaktob_no" name="rmaktob_no" class="form-control" value="{{ old('rmaktob_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="rmaktob_date" class="control-label">تاریخ مکتوب جواب:</label>
						<input type="text" id="rmaktob_date" name="rmaktob_date" data-targetselector="#rmaktob_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ old('rmaktob_date')}}"  autocomplete="off">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="rmaktob_subject" class="control-label">خلاصه موضوع:</label>
						<textarea id="rmaktob_subject" name="rmaktob_subject" class="form-control">{{ old('rmaktob_subject')}}</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="doc_no" class="control-label">نمبر کارتن: </label>
						<input type="text" id="doc_no" name="doc_no" class="form-control" value="{{ old('doc_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="shelf_no" class="control-label">نمبر الماری:</label>
						<input type="text" id="shelf_no" name="shelf_no" class="form-control" value="{{ old('shelf_no')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="shelf_row" class="control-label">ردیف الماری:</label>
						<input type="text" id="shelf_row" name="shelf_row" class="form-control" value="{{ old('shelf_row')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="year" class="control-label">سال:</label>
						<input type="number" id="year" name="year" class="form-control" value="{{ old('year')}}" autocomplete="off"  />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="file" class="control-label">فایل:</label>
						<input type="file" class="form-control" name="file" id="file" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="remarks" class="control-label">ملاحظات:</label>
						<textarea id="remarks" name="remarks" class="form-control">{{ old('remarks')}}</textarea>
					</div>
				</div>				
			</div>
			<div class="modal-footer">
				<button type="submit" id="submit"  class="btn btn-success  waves-effect waves-light">ثبت معلومات</button>
			</div>
		</form>
	</div>	
</div> 
       
@endsection        
