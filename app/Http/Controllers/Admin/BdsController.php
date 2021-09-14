<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Models\Categories;
use App\Models\Company;
use App\Models\Bds;

class BdsController extends Controller
{
    protected function module(){
        return [
            'name' => 'Bất động sản',
            'module' => 'bds',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên bất động sản', 
                    'with' => '',
                ],
               
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
            ]
        ];
    }


    protected function fields()
    {
        return [
            'name' => 'required',
            'image' => 'required',
            'category' => 'required',
            'address' => 'required',
            'company_id' => 'required',
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tên dự án không được bỏ trống.',
            'address.required' => 'Địa chỉ không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho dự án.',
            'company_id.required' => 'Bạn chưa chọn chủ đầu tư',
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $list_bds = Bds::whereIn('status',[1,3])->orWhere('status',null)->orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_bds)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . url('/').'/public/images/bds/'.$data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('code', function ($data) {
                    return $data->code;
                })->addColumn('name', function ($data) {
                        return $data->title.'<br><a href="'.route('home.single-bds', $data->slug).'" target="_blank">'.route('home.single-bds', $data->slug).'</a>';
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == null) {
                        $status = ' <span class="label label-primary">Chờ duyệt</span>&nbsp;';
                    } else if($data->status ==1) {
                        $status = ' <span class="label label-success">Hiển thị tin</span>&nbsp;';
                    }else if($data->status ==3) {
                        $status = ' <span class="label label-danger">Đã gở</span>&nbsp;';
                    }else{

                    }
                    if ($data->hot) {
                        $status = $status . ' <span class="label label-primary">Dự án nổi bật</span>&nbsp;';
                    }
                    
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('bds.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                        </a> &nbsp;
                            <a href="javascript:;" class="btn-destroy" data-href="' . route('bds.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'name'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    public function edit($id)
    {
        
        $data['data'] = Bds::findOrFail($id);

        $data['categories'] = Categories::where('type', 'project_category')->get();

        $data['company'] = Company::orderBy('created_at', 'desc')->get();

        return view("backend.bds.edit", $data);
    }

    public function updateStatus(Request $request)
    {
        Bds::find($request->id)->update(['status'=>$request->status]);

        return response()->json([
            'success' => true
        ]);
    }
}
