@extends('backend.layouts.app')
@section('controller','Cấu hình chung')
@section('action','Cập nhật')
@section('controller_route', route('backend.options.general'))
@section('content')
	<div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('backend.options.general.post') }}" method="POST">
               		@csrf
               		 <div class="nav-tabs-custom">
			            <ul class="nav nav-tabs">
			               <li class="active">
								   <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a>
							</li>
			                
			               	<li class="">
			               		<a href="#activity3" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
			               	</li>
			               	<li class="">
			               		<a href="#activity4" data-toggle="tab" aria-expanded="true">Mạng xã hội</a>
							</li>
							
						 	<li class="">
								<a href="#activity8" data-toggle="tab" aria-expanded="true">Top footer</a>
						 	</li>
						 	<li class="">
								<a href="#activity7" data-toggle="tab" aria-expanded="true">Phương thức thanh toán</a>
						 	</li>

							 <li class="">
								<a href="#activity9" data-toggle="tab" aria-expanded="true">Điểm thưởng</a>
						 	</li>

			            </ul>
				        <div class="tab-content">

	                		<div class="tab-pane active" id="activity">
			               		<div class="row">
			               			<div class="col-lg-2">
				                        <div class="form-group">
				                           <label>Favicon</label>
				                           <div class="image">
				                               <div class="image__thumbnail">
				                                   <img src="{{ !empty($content->favicon) ? url('/').$content->favicon :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ @$content->favicon }}" name="content[favicon]"  />
				                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
				                               </div>
				                           </div>
				                       </div>
				                    </div>
				                    <div class="col-lg-2">
				                        <div class="form-group">
				                           <label>Logo</label>
				                           <div class="image">
				                               <div class="image__thumbnail">
				                                   <img src="{{ !empty($content->logo) ? url('/').$content->logo :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ @$content->logo }}" name="content[logo]"  />
				                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
				                               </div>
				                           </div>
				                       </div>
									</div>
									
									<div class="col-lg-2">
				                        <div class="form-group">
				                           <label>Logo footer</label>
				                           <div class="image">
				                               <div class="image__thumbnail">
				                                   <img src="{{ !empty($content->logo_footer) ? url('/').$content->logo_footer :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ @$content->logo_footer }}" name="content[logo_footer]"  />
				                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
				                               </div>
				                           </div>
				                       </div>
				                    </div>

				                    <div class="col-lg-2">
				                        <div class="form-group">
				                           <label>Hình ảnh đại diện khi chia sẻ</label>
				                           <div class="image">
				                               <div class="image__thumbnail">
				                                   <img src="{{ !empty($content->logo_share) ? url('/').$content->logo_share :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ @$content->logo_share }}" name="content[logo_share]"  />
				                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
				                               </div>
				                           </div>
				                       </div>
				                    </div>
			               		</div>

			               		<div class="row">
			               			<!-- <div class="col-sm-3">
			               				<div class="form-group">
			               					<label for="">Code Google Maps</label>
			               					<textarea name="content[google_maps]" class="form-control" rows="10">{!! @$content->google_maps !!}</textarea>
			               				</div>
									</div> -->
									<div class="col-sm-3">
										<div class="form-group">
											<label for="">Ticktok</label>
										 <input type="text" name="content[ticktok]" class="form-control" value="{!! @$content->ticktok !!}">
										</div>
									</div>
			               			<div class="col-sm-3">
			               				<div class="form-group">
			               					<label for="">Google Analytics</label>
											<input type="text" name="content[google_analytics]" class="form-control" value="{!! @$content->google_analytics !!}">
			               				</div>
			               			</div>
			               			<div class="col-sm-3">
			               				<div class="form-group">
											<label for="">Google Tag Manager</label>
											<input type="text" name="content[google_tag_manager]" class="form-control" value="{!! @$content->google_tag_manager !!}">
			               				</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for="">Facebook pixel</label>
											<input type="text" name="content[facebook_pixel]" class="form-control" value="{!! @$content->facebook_pixel !!}">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for="">Facebook chat</label>
											<input type="text" name="content[facebook_chat]" class="form-control" value="{!! @$content->facebook_chat !!}">
										</div>
									</div>
			               		</div>

			               		<div class="row">
			               			<div class="col-sm-12">
			               				<div class="form-group">
				               				<label for="">Email nhận thông tin liên hệ</label>
				               				<input type="email" class="form-control" name="content[email_admin]" value="{{ @$content->email_admin }}">
										</div>
										<div class="form-group">
				               				<label for="">Đăng ký nhận tin khuyến mãi(mô tả ngắn)</label>
											   <textarea class="form-control" name="content[sale_desc]">{{ @$content->sale_desc }}</textarea>
										</div>
				               			<div class="form-group">
			                                <label class="custom-checkbox">
			                                    <input type="checkbox" name="content[index_google]" value="1" {{ @$content->index_google == 1 ? 'checked' : null }}> 
			                                    Cho phép google tìm kiếm
			                                </label>
			                            </div>

		                            </div>
			               			
			               		</div>
			               	</div>

			               	<div class="tab-pane" id="activity3">
			               		<div class="row">
			               			<div class="col-sm-12">
			               				<div class="form-group">
											<label for="">Tên website</label>
											<input type="text" class="form-control" name="content[site_title]"
											value="{{ @$content->site_title }}">
										</div>

			               				<div class="form-group">
		               						<label for="">Mô tả ngắn</label>
		               						<textarea class="form-control" rows="5" 
		               						name="content[site_description]">{{ @$content->site_description }}</textarea>
			               				</div>

			               				<div class="form-group">
		               						<label for="">Meta keyword</label>
		               						<input type="text" class="form-control" name="content[site_keyword]"
		               						value="{{ @$content->site_keyword }}">
			               				</div>

			               			</div>
			               		</div>
			               	</div>
							
							<div class="tab-pane" id="activity4">
								<div class="row">
									<div class="col-sm-12">
										<div class="repeater" id="repeater">
							                <table class="table table-bordered table-hover social">
							                    <thead>
								                    <tr>
														<th style="width: 30px">STT</th>
								                    	<th style="max-width: 150px">Tên mạng xã hội</th>
								                    	<th>Icon</th>
								                    	<th>Liên kết</th>
								                    	<th></th>
								                    </tr>
							                	</thead>
							                    <tbody id="sortable">
							                    	@if (!empty($content->social))
							                    		@foreach ($content->social as $id => $val)
															<tr>
																<td class="index">{{ $index = $loop->index + 1  }}</td>
																<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ $val->name }}" ></td>
																<td>
																	<textarea class="form-control" name="content[social][{{$id}}][image]">{{ @$val->image }}</textarea>
																</td>
																<td>
															        <input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ $val->link }}">
															    </td>
															    <td style="text-align: center;">
															        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
															            <i class="fa fa-minus"></i>
															        </a>
															    </td>
															</tr>
							                    		@endforeach
							                    	@endif
												</tbody>
							                </table>
							                <div class="text-right">
							                    <button class="btn btn-primary" 
									            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'social', '.social')">Thêm
									            </button>
							                </div>
							            </div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane" id="activity7">
								<div class="row">
									
									<div class="col-sm-12">
										<div class="repeater" id="repeater">
							                <table class="table table-bordered table-hover payment_methods">
							                    <thead>
								                    <tr>
														<th style="width: 30px">STT</th>
								                    	<th style="width: 200px">Hình ảnh</th>
								                    	<th>Tiêu đề</th>
								                    	<th></th>
								                    </tr>
							                	</thead>
							                    <tbody id="sortable">
							                    	@if (!empty($content->payment_methods))
							                    		@foreach ($content->payment_methods as $id => $val)
															<tr>
																<td class="index">{{ $index = $loop->index + 1  }}</td>
																<td>
																	<div class="image">
																		<div class="image__thumbnail">
																			<img src="{{ !empty($val->image) ? url('/').$val->image : __IMAGE_DEFAULT__ }}"  
																			data-init="{{ __IMAGE_DEFAULT__ }}">
																			<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
																			<i class="fa fa-times"></i></a>
																			<input type="hidden" value="{{ @$val->image }}" name="content[payment_methods][{{ $id }}][image]"  />
																			<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
																		</div>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																        <input type="text" class="form-control" required="" name="content[payment_methods][{{$id}}][title]" value="{{ @$val->title }}">
																    </div>
																</td>
																
															    <td style="text-align: center;">
															        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
															            <i class="fa fa-minus"></i>
															        </a>
															    </td>
															</tr>
							                    		@endforeach
							                    	@endif
												</tbody>
							                </table>
							                <div class="text-right">
							                    <button class="btn btn-primary" 
									            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'payment_methods', '.payment_methods')">Thêm
									            </button>
							                </div>
							            </div>
									</div>
								</div>
							</div>

							<div class="tab-pane" id="activity8">
								<div class="row">
									<div class="col-sm-12">
										<div class="repeater" id="repeater">
							                <table class="table table-bordered table-hover social_header">
							                    <thead>
								                    <tr>
														<th style="width: 30px">STT</th>
								                    	<th style="width: 200px">Hình ảnh</th>
								                    	<th>Nội dung</th>
								                    	<th></th>
								                    </tr>
							                	</thead>
							                    <tbody id="sortable">
							                    	@if (!empty($content->social_header))
							                    		@foreach ($content->social_header as $id => $val)
															<tr>
																<td class="index">{{ $index = $loop->index + 1  }}</td>
																<td>
																	<div class="image">
																		<div class="image__thumbnail">
																			<img src="{{ !empty($val->image) ? url('/').$val->image : __IMAGE_DEFAULT__ }}"  
																			data-init="{{ __IMAGE_DEFAULT__ }}">
																			<a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
																			<i class="fa fa-times"></i></a>
																			<input type="hidden" value="{{ @$val->image }}" name="content[social_header][{{ $id }}][image]"  />
																			<div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
																		</div>
																	</div>
																</td>
																<td>
																	<div class="form-group">
																	<label for="">Tiêu đề 1</label>
															        <input type="text" class="form-control" required="" name="content[social_header][{{$id}}][title1]" value="{{ @$val->title1 }}">
																</td>
																
															    <td style="text-align: center;">
															        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
															            <i class="fa fa-minus"></i>
															        </a>
															    </td>
															</tr>
							                    		@endforeach
							                    	@endif
												</tbody>
							                </table>
							                <div class="text-right">
							                    <button class="btn btn-primary" 
									            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'social_header', '.social_header')">Thêm
									            </button>
							                </div>
							            </div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="activity9">
								<div class="row">
									<div class="col-sm-12">
									<div class="form-group">
											<label for="">Số tiền tương đương với 1 điểm thưởng</label>
											<input type="number" class="form-control" name="content[poin_price]"
											value="{{ @$content->poin_price }}">
										</div>
									</div>
								</div>
							</div>
			            </div>
			        </div>
               		<div class="row">
               			<div class="col-lg-12">
               				<button class="btn btn-primary" type="submit">Lưu lại</button>
               			</div>
               		</div>
               	</form>
            </div>
        </div>
    </div>
@stop