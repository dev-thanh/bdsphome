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
				            	<a href="#content-2" data-toggle="tab" aria-expanded="true">Khối chăm sóc da</a>
				            </li>

				            <li class="">
				            	<a href="#content-3" data-toggle="tab" aria-expanded="true">Khối thời trang</a>
				            </li>
				            
							<li class="">
				            	<a href="#content-4" data-toggle="tab" aria-expanded="true">Khối hình ảnh instagram</a>
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
								<div class="col-sm-12">
									
									<div class="col-sm-9">
										<div class="repeater">
											<div class="form-group">
												<label for="">Tiêu đề khối</label>
												<input type="text" name="content[aboutus][title]" class="form-control" value="{{ @$content->aboutus->title }}">
											</div>
										</div>

										<div class="repeater">
											<div class="form-group">
												<label for="">Mô tả ngắn khối</label>
												<textarea name="content[aboutus][desc]" class="form-control content" style="min-height: 150px">{{ @$content->aboutus->desc }}</textarea>
											</div>
										</div>

										<div class="repeater">
											<div class="form-group">
												<label for="">Liên kết</label>
												<input type="text" name="content[aboutus][link]" class="form-control" value="{{ @$content->aboutus->link }}">
											</div>
										</div>
										
										<div class="col-sm-2">
											<div class="form-group">
					                           <label>Hình ảnh đại diện khối</label>
					                           <div class="image">
					                               <div class="image__thumbnail">
					                                   <img src="{{ @$content->aboutus->iamge ?  url('/').@$content->aboutus->iamge : __IMAGE_DEFAULT__ }}"  
					                                   data-init="{{ __IMAGE_DEFAULT__ }}">
					                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
					                                    <i class="fa fa-times"></i></a>
					                                   <input type="hidden" value="{{ @$content->aboutus->iamge }}" name="content[aboutus][iamge]"  />
					                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
					                               </div>
					                           </div>
					                       </div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="tab-pane active" id="content-3">
							<div class="row">
								<div class="col-sm-12">
									
									<div class="col-sm-9">
										<div class="repeater">
											<div class="form-group">
												<label for="">Tiêu đề khối</label>
												<input type="text" name="content[fashion][title]" class="form-control" value="{{ @$content->fashion->title }}">
											</div>
										</div>

										<div class="repeater">
											<div class="form-group">
												<label for="">Mô tả ngắn khối</label>
												<textarea name="content[fashion][desc]" class="form-control content" style="min-height: 150px">{{ @$content->fashion->desc }}</textarea>
											</div>
										</div>

										<div class="repeater">
											<div class="form-group">
												<label for="">Liên kết</label>
												<input type="text" name="content[fashion][link]" class="form-control" value="{{ @$content->fashion->link }}">
											</div>
										</div>
										
										<div class="col-sm-2">
											<div class="form-group">
					                           <label>Hình ảnh đại diện khối</label>
					                           <div class="image">
					                               <div class="image__thumbnail">
					                                   <img src="{{ @$content->fashion->iamge ?  url('/').@$content->fashion->iamge : __IMAGE_DEFAULT__ }}"  
					                                   data-init="{{ __IMAGE_DEFAULT__ }}">
					                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
					                                    <i class="fa fa-times"></i></a>
					                                   <input type="hidden" value="{{ @$content->fashion->iamge }}" name="content[fashion][iamge]"  />
					                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
					                               </div>
					                           </div>
					                       </div>
										</div>
									</div>
									
								</div>
							</div>
						</div>

						<div class="tab-pane" id="content-4">
							<div class="row">
								<div class="col-sm-12">
									
									
									<div class="col-sm-9">
										<div class="repeater">
											<div class="form-group">
												<label for="">Tên tài khoản instagram</label>
												<input type="text" name="content[partner][name]" class="form-control" value="{{ @$content->partner->name }}">
											</div>
										</div>
										<div class="repeater">
										<div class="form-group">
												<label for="">Link tài khoản instagram</label>
												<input type="text" name="content[partner][link]" class="form-control" value="{{ @$content->partner->link }}">
											</div>
										</div>
										<div class="repeater" id="repeater">
											<div class="form-group">
												<label for="">Nội dung khối</label>	
											</div>
											<table class="table table-bordered table-hover partner">
												<thead>
													<tr>
														<th style="width: 30px;">STT</th>
														<th style="width: 200px">Hình ảnh instagram</th>
														<th>Tiêu đề hình ảnh</th>
														<th>Liên kết</th>
														<th></th>
													</tr>
												</thead>
												<tbody id="sortable">
													@if (!empty($content->partner->content))
														@foreach ($content->partner->content as $key => $value)
															<?php $index = $loop->index + 1; ?>
															@include('backend.repeater.row-partner')
														@endforeach
													@endif
												</tbody>
											</table>
											<div class="text-right">
												<button class="btn btn-primary" 
													onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'partner', '.partner')">Thêm
												</button>
											</div>
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