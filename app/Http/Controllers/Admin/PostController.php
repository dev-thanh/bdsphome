<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\NewsCategory;
use DataTables;
use File, DB;

class PostController extends Controller
{

    private $type = 'blog';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function module(){
        return [
            'name' => 'Tin tức',
            'module' => 'posts',
            'table' =>[
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'code' => [
                    'title' => 'Mã sản phẩm', 
                    'with' => '',
                ],
                'name' => [
                    'title' => 'Tên sản phẩm', 
                    'with' => '',
                ],
                'category' => [
                    'title' => 'Danh mục sản phẩm', 
                    'with' => '200px',
                ],
                'order' => [
                    'title' => 'Thứ tự', 
                    'with' => '30px',
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
        ];
    }


    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề tin tứckhông được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh đại diện.',
            'category.required' => 'Bạn chưa chọn danh mục tin tức.',
            
        ];
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $list_post = Posts::where('type', 'blog')->orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_post)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="90px" height="60px">';
                })->addColumn('category', function ($data) {
                        $label = null;

                        if(count($data->category)){
                            foreach ($data->category as $item) {
                                $label = $label. '<span class="label label-success">'.$item->name.'</span><br>';
                            }
                        }
                        return $label;
                })->addColumn('author', function ($data) { 
                    return $data->Author->name;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('posts.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                        </a> &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('posts.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'name', 'category'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['categories'] = Categories::where('type', 'news_category')->get();
        $data['module'] = $this->module();
        return view("backend.{$this->module()['module']}.list", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module'] = $this->module();
        $data['categories'] = Categories::where('type', 'news_category')->get();
        
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
        $this->validate($request,
            $this->fields(),
            $this->messages()
        );

        $data = $request->all();

        $data['slug'] = $this->createSlug(str_slug($request->name),$id = null,$type='slug');

        $data['status'] = $request->status == 1 ? 1 : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        $input['tag'] = !empty($request->tag) ? json_encode($request->tag) : null;

        $data['type'] = 'blog';

        $data['user_id'] =  \Auth::user()->id;

        $product = Posts::create($data);

        $this->updateOrder();

        if(!empty($request->category)){

            foreach ($request->category as $item) {

                NewsCategory::create(['id_category'=> $item, 'id_news'=> $product->id]);

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
    public function edit($id)
    {
        $data['module'] = array_merge($this->module(),[
            'action' => 'update'
        ]);

        $data['categories'] = Categories::where('type','news_category')->get();

        $data['data'] = Posts::findOrFail($id);

        $data['array_id'] = NewsCategory::where('id_news',$id)->pluck('id_category')->toArray();

        return view("backend.{$this->module()['module']}.create-edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields        = $this->fields();

        $this->validate($request, $fields, $this->messages());

        $input = $request->all();

        $input['status'] = $request->status == 1 ? 1 : null;

        $input['tag'] = !empty($request->tag) ? json_encode($request->tag) : null;

        $input['hot'] = $request->hot == 1 ? 1 : null;

        $input['type'] = 'blog';
       
        $product = Posts::findOrFail($id)->update($input);

        $this->updateOrder();

        if(!empty($request->category)){

            NewsCategory::where('id_news', $id )->delete();

            foreach ($request->category as $item) {

                NewsCategory::create(['id_category'=> $item, 'id_news'=> $id ]);

            }
        }

        flash('Cập nhật thành công.')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrder()
    {
        $data = Posts::orderBy('stt')->orderBy('updated_at', 'DESC')->get();
        $index = 0;
        foreach ($data as $cate) {
            $index = $index + 1;
            $update = Posts::find($cate->id);
            $update->stt = $index;
            $update->save();
        }

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

        Posts::destroy($id);

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){

            foreach ($request->chkItem as $id) {
                Posts::destroy($id);
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

        $type = $request->type;

        $post = Posts::find($id);

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
            $count = Posts::where('id', '!=', $id)->where($type, $slug)->count();
            return $count > 0;
        }else{
            $count = Posts::where($type, $slug)->count();
            return $count > 0;
        }
    }
}
