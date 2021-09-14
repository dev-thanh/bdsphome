<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class CategoriesRealEstateController extends Controller
{
    protected function fields()
    {
        return [
            'name' => "required",
            'category_nd' => "required",
            'slug' => "required",
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tiêu đề không được bỏ trống.',
            'category_nd.required' => 'Loại nhà đất không được bỏ trống.',
            'slug.required' => 'Đường dẫn tĩnh tiếng anh không được bỏ trống.',
        ];
    }


    protected function module(){
        return [
            'name' => 'Danh mục bất động sản',
            'module' => 'categories-bds',
            'table' =>[
                'name' => [
                    'title' => 'Tiêu đề', 
                    'with' => '',
                ],
                'slug' => [
                    'title' => 'Liên kết', 
                    'with' => '',
                ],
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module'] = $this->module();
        $data['data'] = Categories::where('type', 'bds_category')->get();
        return view("backend.{$this->module()['module']}.list", $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort(404);
        $data['module'] = $this->module();
        $data['categories'] = Categories::where('type', 'bds_category')->get();
        $data['cateNd'] = Categories::where('type', 'nd_category')->get();
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

        $post_check_sulg = Categories::where('slug', $request->slug)->where('type', 'bds_category')->first();

        if (!empty($post_check_sulg)) {

            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);

        }

        $input = $request->all();

        $input['content'] = !empty($request->content) ? json_encode($request->content) : null;

        $input['type'] = 'bds_category';

        $data = Categories::create($input);

        flash('Thêm mới thành công.')->success();

        return redirect()->route("{$this->module()['module']}.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);

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

        $data['categories'] = Categories::where('id', '!=', $id)->where('type', 'bds_category')->get();

        $data['data'] = Categories::findOrFail($id);

        $data['cateNd'] = Categories::where('type', 'nd_category')->get();

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
        $this->validate($request, $this->fields(), $this->messages());

        $post_check_sulg = Categories::where('slug', $request->slug)->where('id', '!=', $id)->where('type', 'product_category')->first();

        if (!empty($post_check_sulg)) {

            return redirect()->back()->withInput()->withErrors(['Đường đẫn tĩnh này đã tồn tại.']);

        }

        $input = $request->all();
        

        $input['content'] = !empty($request->content) ? json_encode($request->content) : null;

        $cate = Categories::findOrFail($id)->update($input);

        flash('Cập nhật thành công.')->success();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::destroy($id);

        flash('Xóa thành công.')->success();

        return redirect()->back();

    }
}
