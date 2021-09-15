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
				            	<a href="#content-2" data-toggle="tab" aria-expanded="true">Khối về chúng tôi</a>
				            </li>

				            <li class="">
				            	<a href="#content-3" data-toggle="tab" aria-expanded="true">Khối đối tác</a>
				            </li>
				            <li class="">
				            	<a href="#content-4" data-toggle="tab" aria-expanded="true">Khối dự án nổi bật</a>
				            </li>
				            <li class="">
				            	<a href="#content-5" data-toggle="tab" aria-expanded="true">Khối bất động sản theo khu vực</a>
				            </li>
				           
				        </ul>
				    </div>
				    <?php if(!empty($data->content)){
						$content = json_decode($data->content);
						//dd($content->difference);
					} ?>
				    <div class="tab-content">
						<div class="tab-pane active" id="content-2">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
										<label>Hình ảnh background khối</label>
										<div class="image">
											<div class="image__thumbnail" style="max-width: 150px;max-height: 150px">
												<img src="{{ @$content->home->background ?  url('/').@$content->home->background : __IMAGE_DEFAULT__ }}"  
												data-init="{{ __IMAGE_DEFAULT__ }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
													<i class="fa fa-times"></i></a>
												<input type="hidden" value="{{ @$content->home->background }}" name="content[home][background]"  />
												<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Hình ảnh đại diện khối(bên phải)</label>
										<div class="image">
											<div class="image__thumbnail" style="max-width: 150px;max-height: 150px">
												<img src="{{ @$content->home->image ?  url('/').@$content->home->image : __IMAGE_DEFAULT__ }}"  
												data-init="{{ __IMAGE_DEFAULT__ }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
													<i class="fa fa-times"></i></a>
												<input type="hidden" value="{{ @$content->home->image }}" name="content[home][image]"  />
												<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Hình ảnh logo</label>
										<div class="image">
											<div class="image__thumbnail" style="max-width: 150px;max-height: 150px">
												<img src="{{ @$content->home->logo ?  url('/').@$content->home->logo : __IMAGE_DEFAULT__ }}"  
												data-init="{{ __IMAGE_DEFAULT__ }}">
												<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
													<i class="fa fa-times"></i></a>
												<input type="hidden" value="{{ @$content->home->logo }}" name="content[home][logo]"  />
												<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
											</div>
										</div>
									</div>
									</div>
									<div class="col-sm-10">
										<div class="form-group">
											<label for="">Tiêu đề khối</label>
											<input class="form-control" name="content[home][title]" value="{{ @$content->home->title }}">
										</div>
										<div class="form-group">
											<label for="">Mô tả khối</label>
											<textarea class="content" name="content[home][content]">{!! @$content->home->content !!}</textarea>
										</div>
									</div>
									<div class="col-sm-12">
										<h3 class="text-center" style="background: #62ff00;padding: 10px 0px">Thông số thống kê</h3>
										<div class="form-group">
											<div class="repeater" id="repeater">
												<table class="table table-bordered table-hover statistical">
													
													<?php if(!empty($data->content)){
														$contents = json_decode($data->content);
														//dd(@$contents);
													} ?>
													<tbody id="sortable">
														@if(!empty(@$contents->statistical->content))
															@foreach (@$content->statistical->content as $key => $value)
																<?php $index = $loop->index + 1; ?>
																@include('backend.repeater.row-statistical')
															@endforeach
														@endif
													</tbody>
												</table>
												<div class="text-right">
													
													<button class="btn btn-primary" 
														onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'statistical', '.statistical')">Thêm
													</button>
													
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						<div class="tab-pane" id="content-3">
							<div class="row">
								<div class="col-sm-12">
									<div class="repeater" id="repeater">
										<table class="table table-bordered table-hover logo">
											
											<?php if(!empty($data->content)){
												$contents = json_decode($data->content);
												//dd(@$contents);
											} ?>
											<tbody id="sortable">
												@if(!empty(@$contents->logo->content))
													@foreach (@$content->logo->content as $key => $value)
														<?php $index = $loop->index + 1; ?>
														@include('backend.repeater.row-logo')
													@endforeach
												@endif
											</tbody>
										</table>
										<div class="text-right">
											
											<button class="btn btn-primary" 
												onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'logo', '.logo')">Thêm
											</button>
											
										</div>
									</div>
									
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content-4">
							<div class="row">
								<div class="col-sm-12">
									<label>Hình ảnh background khối</label>
									<div class="image">
										<div class="image__thumbnail" style="max-width: 150px;max-height: 150px">
											<img src="{{ @$content->hot->background ?  url('/').@$content->hot->background : __IMAGE_DEFAULT__ }}"  
											data-init="{{ __IMAGE_DEFAULT__ }}">
											<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
												<i class="fa fa-times"></i></a>
											<input type="hidden" value="{{ @$content->hot->background }}" name="content[hot][background]"  />
											<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="content-5">
							<div class="row">
								<div class="col-sm-12">
									<div class="repeater" id="repeater">
										<table class="table table-bordered table-hover bds">
											
											<?php if(!empty($data->content)){
												$contents = json_decode($data->content);
												//dd(@$contents);
											} ?>
											<tbody id="sortable">
												@if(!empty(@$contents->bds->content))
													@foreach (@$content->bds->content as $key => $value)
														<?php $index = $loop->index + 1; ?>
														@include('backend.repeater.row-bds')
													@endforeach
												@endif
											</tbody>
										</table>
										<div class="text-right">
											
											<button class="btn btn-primary" 
												onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'bds', '.bds')">Thêm
											</button>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
			           		<button type="submit" class="btn btn-primary">Lưu lại</button>
						</div>
			        </div>
				</form>
			</div>
		</div>
	</div>
	
@stop