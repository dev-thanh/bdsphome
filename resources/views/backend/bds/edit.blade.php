@extends('backend.layouts.app')
@section('controller',$data->title)
@section('controller_route',route('bds.index'))
@section('action','Chi tiết')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
				<form action="{{ route('bds.store', $data->id) }}" method='POST' enctype="multipart/form-data" name="frmEditProduct">
			        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    
			        <div class="nav-tabs-custom">
			            <ul class="nav nav-tabs">
			                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">
                                <div>
                                <button class="btn btn-primary btn__update_status" data-status="1">Duyệt tin đăng</button>
                                <button class="btn btn-danger btn__update_status" data-status="3">Gỡ tin</button>
                            </div>
                            </a>
                        </li>
			            </ul>
			            <div class="tab-content">
			                <div class="tab-pane active" id="activity">
			                    <div class="row">
			                        <div class="col-lg-12">
                                        <?php $status = '';
                                        if ($data->status == null) {
                                            $status = ' <span style="padding: 5px 10px;" class="label label-primary">Chờ duyệt</span>&nbsp;';
                                        } else if($data->status ==1) {
                                            $status = ' <span style="padding: 5px 10px;" class="label label-success">Hiển thị tin</span>&nbsp;';
                                        }else if($data->status ==3) {
                                            $status = ' <span style="padding: 5px 10px;" class="label label-danger">Đã gở</span>&nbsp;';
                                        }else{

                                        } ?>
                                        <div class="form-group">
			                                <label>Trạng thái tin</label>
			                                {!! $status !!}
			                            </div>
			                            <div class="form-group">
			                                <label>Tiêu đề</label>
			                                <input type="text" class="form-control" value="{{@$data->title}}" readonly>
			                            </div>

			                            <div class="form-group">
			                                <label>Vị trí</label>
			                                <input type="text" class="form-control" name="phone" id="phone"
                                            value="{{$data->address}} {{getAddress($data->city_id,$data->district_id,$data->ward_id)}}" readonly>
			                            </div>
                                        
			                        </div>
                                    <h3>Thông tin bất động sản</h3>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Nhu cầu</label>                           
		                                    <textarea class="form-control" readonly="">{{ App\Models\Categories::find($data->need)->name }}</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Đối tượng</label>                           
		                                    <textarea class="form-control" readonly="">{{ $data->object }}</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Loại nhà đất</label>                           
		                                    <textarea class="form-control" readonly="">{{App\Models\Categories::find($data->type_housing)->name}}</textarea>
		                                </div>
                                    </div>
                                    @if(!empty($data->projects_id))
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Dự án</label>                           
		                                    <textarea class="form-control" readonly="">{{App\Models\Projects::find($data->projects_id)->name}}</textarea>
		                                </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Diện tích đất</label>                           
		                                    <textarea class="form-control" readonly="">{{$data->land_area}} m2</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Diện tích sử dụng</label>                           
		                                    <textarea class="form-control" readonly="">{{$data->usable_area}} m2</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Giá</label>                           
		                                    <textarea class="form-control" readonly="">{{number_format($data->price,0, '.', '.') }}VND</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Giá/m2</label>                           
		                                    <textarea class="form-control" readonly="">{{number_format($data->price2,0, '.', '.') }}VND/m2</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Ngày bắt đầu</label>                           
		                                    <textarea class="form-control" readonly="">{{format_datetime($data->startDate,'d/m/Y')}}</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Ngày hết hạn</label>                           
		                                    <textarea class="form-control" readonly="">{{format_datetime($data->endtDate,'d/m/Y')}}</textarea>
		                                </div>
                                    </div>
                                    <div class="col-lg-12">
		                                <div class="form-group" style="">
		                                    <label>Mô tả</label>                           
		                                    <div style="padding: 10px">{!! $data->content !!}</div>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Ảnh bìa</label>                           
		                                    <div style="max-width: 300px">
                                                <img src="{{url('/').'/public/images/bds/'.$data->image}}" alt="">
                                            </div>
		                                </div>
                                    </div>
                                    <div class="col-lg-6">
		                                <div class="form-group" style="">
		                                    <label>Ảnh chi tiết</label>
                                            @if(!empty($data->more_image))
                                            @php $images = json_decode($data->more_image); @endphp                           
		                                    <div style="display: flex">
                                                @foreach($images as $image)
                                                <img style="width: 150px;height:150px;object-fit: cover;padding: 5px" src="{{url('/').'/public/images/bds/'.$image}}" alt="">
                                                @endforeach
                                            </div>
                                            @endif
		                                </div>
                                    </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <button type="submit" class="btn btn-primary">Cập nhật</button>
			    </form>
            </div>
        </div>
    </div>
    <script>
        $('.btn__update_status').on('click',function(){

            const status = $(this).data('status');

            const id = '{{$data->id}}';

            $.ajax({
            type:'GET',
            url:'{{route('bds.update-status')}}',
            data: {status : status,id:id},
            success:function(data){
                if(data.success==true){
                    location.reload();
                }
            }
            });
            
        })
    </script>
@stop