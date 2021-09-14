@extends('backend.layouts.app')
@section('controller', 'Chủ đầu tư' )
@section('controller_route', route('company.index'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <div class="btnAdd">
                    <a href="{{ route('company.create') }}">
                        <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
                    </a>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên công ty</th>
                            <th>Số điện thoại</th>
                            <th>Haành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>
                                <img style="max-width:70px" src="{{url('/').$item->image}}" alt="">
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>
                                <a href="{{route('company.edit',['id'=>$item->id])}}" title="Sửa">
                                    <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                                </a>
                                <a href="javascript:;" class="btn-destroy" data-href="{{route('company.destroy',['id'=>$item->id])}}" data-toggle="modal" data-target="#confim">
                                    <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
