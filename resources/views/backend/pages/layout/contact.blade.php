@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">

	               	<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
				 				
								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>
							
						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
							<li class="active">
								<a href="#content" data-toggle="tab" aria-expanded="true">Khối header</a>
				            </li>
				            <li class="">
								<a href="#content2" data-toggle="tab" aria-expanded="true">Khối form liên hệ</a>
				            </li>
				            <li class="">
								<a href="#content3" data-toggle="tab" aria-expanded="true">Khối google map</a>
				            </li>
							<li class="">
								<a href="#seo" data-toggle="tab" aria-expanded="true">Cấu hình trang</a>
							</li>
				            
				        </ul>
				    </div>
				    <?php if(!empty($data->content)){
							$content = json_decode($data->content);
							//dd(@$content);
						} ?>
				    <div class="tab-content">
			            <div class="tab-pane active" id="content">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ @$content->header->image ?  url('/').@$content->header->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$content->header->image }}" name="content[header][image]"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Tiêu đề header</label>
										<input type="text" name="content[header][title]" class="form-control" value="{{ @$content->header->title }}">
									</div>
									<div class="form-group">
										<label for="">Link Facebook</label>
										<input type="text" name="content[header][link1]" class="form-control" value="{{ @$content->header->link1 }}">
									</div>
									<div class="form-group">
										<label for="">Link instagram</label>
										<input type="text" name="content[header][link2]" class="form-control" value="{{ @$content->header->link2 }}">
									</div>
									<div class="form-group">
										<label for="">Link youtube</label>
										<input type="text" name="content[header][link3]" class="form-control" value="{{ @$content->header->link3 }}">
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content2">
							<div class="row">
								<div class="col-sm-12">
								<div class="form-group">
										<label for="">Địa chỉ</label>
										<input type="text" name="content[form][address]" class="form-control" value="{{ @$content->form->address }}">
									</div>
									<div class="form-group">
										<label for="">Số điệnt thoại</label>
										<input type="text" name="content[form][phone]" class="form-control" value="{{ @$content->form->phone }}">
									</div>
									<div class="form-group">
										<label for="">Email</label>
										<input type="text" name="content[form][email]" class="form-control" value="{{ @$content->form->email }}">
									</div>
									
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content3">
							<div class="row">
								<div class="col-sm-12">
									
									<div class="repeater" id="repeater">
										<div class="form-group">
											<label for="">Code Google Maps</label>
											<textarea name="content[code_google_map]" class="form-control" rows="5">{!! @$content->code_google_map !!}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="seo">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->image ?  url('/').$data->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Banner</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ $data->banner ?  url('/').$data->banner : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$data->banner }}" name="banner"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-8">
									<div class="form-group">
										<label for="">Tiêu đề trang</label>
										<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">
									</div>
									<div class="form-group">
										<label for="">Mô tả trang</label>
										<textarea name="meta_description" 
										class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="">Từ khóa</label>
										<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">
									</div>
								</div>
							</div>
			            </div>

			           <button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop