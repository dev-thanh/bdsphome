@extends('backend.layouts.app')
@section('controller', 'Chủ đầu tư' )
@section('controller_route', route('company.index'))
@section('action', request()->route()->getName()=='company.create' ? 'Thêm mới' : 'Cập nhập')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        
       	@include('flash::message')
       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
			@csrf
			@if(isUpdate(@$module['action']))
		        {{ method_field('put') }}
		    @endif
		    <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Chủ đầu tư</a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
						<div class="form-group">
							<label for="">Tên chủ đầu tư (công ty)</label>
							<input type="text" class="form-control" name="name" id="name" value="{{ old('name', @$data->name) }}">
						</div>
						<div class="form-group">
							<label for="">Số điện thoại</label>
							<input type="text" class="form-control" name="phone" value="{{ old('phone', @$data->phone) }}">
						</div>
						<div class="form-group">
							<label for="">Địa chỉ</label>
							<input type="text" class="form-control" name="address" value="{{ old('address', @$data->address) }}">
						</div>
						
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Hình ảnh đại diện công ty</label>
									<div class="image">
									<div class="image__thumbnail" style="width: 150px;height: 150px">
										<img src="{{ !empty(@$data->image) ? @$data->image : __IMAGE_DEFAULT__ }}"
												data-init="{{ __IMAGE_DEFAULT__ }}">
										<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
											<i class="fa fa-times"></i></a>
										<input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
										<div class="image__button" onclick="fileSelect(this)">
											<i class="fa fa-upload"></i>
											Upload
										</div>
									</div>
								</div>
							</div>
						</div>
						
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
		</form>
			
	</div>
@stop