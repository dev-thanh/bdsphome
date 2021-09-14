<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Company;
use App\Models\Projects;
use App\Models\ProjectsCategory;
use DataTables;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    protected function module(){
        return [
            'name' => 'Dự án',
            'module' => 'projects',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên dự án', 
                    'with' => '',
                ],
                'category' => [
                    'title' => 'Danh mục dự án', 
                    'with' => '200px',
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
            'category.required' => 'Bạn chưa chọn danh mục dự án.',
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
            $list_products = Projects::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . url('/').$data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('code', function ($data) {
                    return $data->code;
                })->addColumn('name', function ($data) {
                        return $data->name.'<br><a href="'.route('home.single-project', $data->slug).'" target="_blank">'.route('home.single-project', $data->slug).'</a>';
                })->addColumn('category', function ($data) {
                        $label = null;
                        if(count($data->category)){
                            foreach ($data->category as $item) {
                                $label = $label. '<span class="label label-success">'.$item->name.'</span><br>';
                            }
                        }
                        return $label;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>&nbsp;';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>&nbsp;';
                    }
                    if ($data->hot) {
                        $status = $status . ' <span class="label label-primary">Dự án nổi bật</span>&nbsp;';
                    }
                    
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('projects.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                        </a> &nbsp;
                            <a href="javascript:;" class="btn-destroy" data-href="' . route('projects.destroy', $data->id) . '"
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

    public function create()
    {
        $data['module'] = $this->module();
        $data['categories'] = Categories::where('type', 'project_category')->get();
        $data['company'] = Company::orderBy('created_at', 'desc')->get();
        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->fields(), $this->messages());

        $input = $request->all();

        $input['slug'] = $this->createSlug(str_slug($request->name),$id = null,$type='slug');

        $input['desc'] = !empty($request->desc) ? json_encode($request->desc) : null;

        $input['content'] = !empty($request->content) ? json_encode($request->content) : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['show'] = $request->show == 1 ? 1 : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        $product = Projects::create($input);

        if(!empty($request->category)){
            foreach ($request->category as $item) {
                ProjectsCategory::create(['id_category'=> $item, 'id_projects'=> $product->id]);
            }
        }

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.index');
    }
    

    public function edit($id)
    {
        $data['module'] = $this->module();

        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);
        
        $data['data'] = Projects::findOrFail($id);

        $data['categories'] = Categories::where('type', 'project_category')->get();

        $data['company'] = Company::orderBy('created_at', 'desc')->get();

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request,  $this->fields(), $this->messages());

        $input = $request->all();

        $input['desc'] = !empty($request->desc) ? json_encode($request->desc) : null;

        $input['content'] = !empty($request->content) ? json_encode($request->content) : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['show'] = $request->show == 1 ? 1 : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        
        $project = Projects::findOrFail($id)->update($input);

        if(!empty($request->category)){
            ProjectsCategory::where('id_projects', $id )->delete();
            foreach ($request->category as $item) {
                ProjectsCategory::create(['id_category'=> $item, 'id_projects'=> $id ]);
            }
        }

        flash('Cập nhật thành công.')->success();

        return back();

    }

    public function destroy($id)
    {
        flash('Xóa thành công.')->success();

        Projects::destroy($id);
        
        ProjectsCategory::where('id_Projects',$id)->delete();

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Projects::destroy($id);

                ProjectsCategory::where('id_product',$id)->delete();
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
        $type = 'slug';
        $post = Projects::find($id);
        $post->$type = $this->createSlug($slug, $id,$type);
        $post->save();
        return $this->createSlug($slug, $id,$type);
    }

    public function createSlug($slugPost, $id = null,$type)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id,$type)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null,$type)
    {
        if($id != null) {
            $count = Projects::where('id', '!=', $id)->where($type, $slug)->count();
            return $count > 0;
        }else{
            $count = Projects::where($type, $slug)->count();
            return $count > 0;
        }
    }

}
