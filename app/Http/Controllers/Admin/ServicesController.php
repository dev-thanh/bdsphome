<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Services;
use App\Models\ServicesCategory;
use DataTables;
use Carbon\Carbon;

class ServicesController extends Controller
{
	protected function fields()
    {
        return [
            'name' => 'required',
            'image' => 'required',
            
        ];
    }
   
    protected function messages()
    {
        return [
            'name.required' => 'Tên dịch vụ không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh dịch vụ.'
        ];
    }

    protected function module(){
        return [
            'name' => 'Danh sách dịch vụ',
            'module' => 'services',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên dịch vụ', 
                    'with' => '',
                ],
                'category' => [
                    'title' => 'Danh mục sản phẩm', 
                    'with' => '200px',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '100px',
                ],
            ]
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

            $type = $request->type;

            $list_products = Services::orderBy('created_at', 'DESC')->get();

            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' .url('').'/'.$data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('name', function ($data) {
                    

                    return '<p>' . $data->name . '</p>'

                    .'<a href="'.url('').'/dich-vu/'.$data->slug.'" target="_blank">'.url('').'/dich-vu/'.$data->slug.'</a>';
                    
                })->addColumn('category', function ($data) {
                    $label = null;

                    if(count($data->category)){
                        foreach ($data->category as $item) {
                            $label = $label. '<span class="label label-success">'.$item->name.'</span><br>';
                        }
                    }
                    return $label;
                })->addColumn('status', function ($data) {
                    $status = '';
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                   
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('services.edit', ['id' => $data->id]) . '" title="Sửa">
                            <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                        </a> &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('services.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'name', 'category'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data['module'] = $this->module();

        $data['categories'] = Categories::where('type', 'service_category')->get();
        
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->fields(), $this->messages());
        
        $data = $request->all();

        $data['slug'] = $this->createSlug(str_slug($request->name));

        $data['status'] = $request->status == 1 ? 1 : null;

        $service = Services::create($data);

        if(!empty($request->category)){

            foreach ($request->category as $item) {

                ServicesCategory::create(['id_category'=> $item, 'id_services'=> $service->id ]);

            }
        }

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);

        $data['categories'] = Categories::where('type','service_category')->get();

        $data['data'] = Services::findOrFail($id);

        $data['array_id'] = ServicesCategory::where('id_services',$id)->pluck('id_category')->toArray();

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    
    public function update(Request $request, $id)
    {
    	$fields        = $this->fields();

        $this->validate($request, $fields, $this->messages());

        $input = $request->all();

        $input['status'] = $request->status == 1 ? 1 : null;
        
        $product = Services::findOrFail($id)->update($input);

        if(!empty($request->category)){

            ServicesCategory::where('id_services', $id )->delete();

            foreach ($request->category as $item) {

                ServicesCategory::create(['id_category'=> $item, 'id_services'=> $id ]);

            }
        }

        flash('Cập nhật thành công.')->success();

        return redirect()->route($this->module()['module'].'.index',['type'=>$request->type]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        flash('Xóa thành công.')->success();

        Services::destroy($id);

        ServicesCategory::where('id_services', $id )->delete();

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {

        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Services::destroy($id);
            }
            flash('Xóa thành công.')->success();
            return back();
        }
        flash('Bạn chưa chọn dữ liệu cần xóa.')->error();
        return back();
    }


    public function getAjaxSlug(Request $request)
    {
        $slug = str_slug($request->slug);
        $id = $request->id;
        $post = Services::find($id);
        $post->slug = $this->createSlug($slug, $id);
        $post->save();
        return $this->createSlug($slug, $id);
    }

    public function createSlug($slugPost, $id = null)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null)
    {
        if($id != null) {
            $count = Services::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Services::where('slug', $slug)->count();
            return $count > 0;
        }
    }



}
