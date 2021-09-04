<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductQuestions;
use DataTables;
use Carbon\Carbon;
use App\Models\ProductAttributes;
use App\Models\ProductVersion;


class ProductsController extends Controller
{

    protected function module(){
        return [
            'name' => 'Sản phẩm',
            'module' => 'products',
            'table' =>[
                'sku' => [
                    'title' => 'SKU', 
                    'with'  =>  '100px',
                ],
                'image' => [
                    'title' => 'Hình ảnh', 
                    'with' => '70px',
                ],
                'name' => [
                    'title' => 'Tên sản phẩm', 
                    'with' => '',
                ],
                'price' => [
                    'title' => 'Giá', 
                    'with' => '200px',
                ],
                'brand' => [
                    'title' => 'Thương hiệu', 
                    'with' => '',
                ],
                'status' => [
                    'title' => 'Trạng thái', 
                    'with' => '200px',
                ],
            ]
        ];
    }


    protected function fields()
    {

        return [
            'sku' => 'required|unique:products,sku',
            'name' => 'required',
            'image' => 'required',
            'regular_price' => 'required',
            "end_date_apply_gift" => "required_if:is_apply_gift,==,1",
            'category' => "required",
        ];
    }

    protected function messages()
    {
        return [
        	'sku.required' => 'Bạn chưa nhập sku.',
        	'sku.unique' => 'Mã SKU đã tồn tại.',
            'name.required' => 'Tên sản phẩm không được bỏ trống.',
            'image.required' => 'Bạn chưa chọn hình ảnh cho sản phẩm.', 
            'regular_price.required' => 'Bạn chưa nhập giá bán cho sản phẩm.',
            'end_date_apply_gift.required_if' => "Bạn chưa chọn ngày kết thúc khuyến mại",
            'category.required' => "Bạn chưa chọn danh mục sản phẩm",
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
            $list_products = Products::orderBy('created_at', 'DESC')->get();
            return Datatables::of($list_products)
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="chkItem[]" value="' . $data->id . '">';
                })->addColumn('image', function ($data) {
                    return '<img src="' . $data->image . '" class="img-thumbnail" width="50px" height="50px">';
                })->addColumn('name', function ($data) {
                        return $data->name.'<br><a href="' . route('home.single.product', $data->slug) . '" target="_black">
                        <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: 
                        ' . route('home.single.product', $data->slug) . '
                      </a>';
                })->addColumn('price', function ($data) {
                    $price = 'Giá bán: '.number_format($data->regular_price).'đ';
                    if(!is_null($data->sale_price)){
                        $price = $price.'<br>Giá KM:'.number_format($data->sale_price).'đ (-'.$data->sale.'%)';
                    }
                    return $price;
                })->addColumn('brand', function ($data) {
                    return @$data->Brand->name;
                })->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $status = ' <span class="label label-success">Hiển thị</span>';
                    } else {
                        $status = ' <span class="label label-danger">Không hiển thị</span>';
                    }
                    if ($data->is_hot) {
                        $status = $status . ' <span class="label label-primary">Nổi bật</span>';
                    }
                    if($data->is_flash_sale == 1){
                        $status = $status . ' <span class="label label-primary">Flash Sale</span>';
                    }
                    if($data->is_price_shock == 1){
                        $status = $status . ' <span class="label label-primary">Sản phẩm giá sốc</span>';
                    }

                    if($data->CheckApplyGift()){
                        $status = $status . ' <span class="label label-primary">Quà tặng</span>';
                    }
                    return $status;
                })->addColumn('action', function ($data) {
                    return '<a href="' . route('products.edit', ['id' => $data->id ]) . '" title="Sửa">
                            <i class="fa fa-pencil fa-fw"></i> Sửa
                        </a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" 
                            data-href="' . route('products.destroy', $data->id) . '"
                            data-toggle="modal" data-target="#confim">
                            <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        ';
                })->rawColumns(['checkbox', 'image', 'status', 'action', 'slug', 'name', 'price'])
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
    public function create()
    {
        $data['module'] = $this->module();
        $data['categories'] = Categories::where('type','product_category')->get();
        $data['brands'] = Categories::where('type','brand_category')->get();

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

    	if(!empty($request->sale_price)){
            if($request->regular_price < $request->sale_price){
                return redirect()->back()->withInput()->withErrors(['Giá khuyến mại không thể cao hơn giá bán']);
            }
        }

       	$input = $request->all();

       	$input['slug'] = $this->createSlug(str_slug($request->name));

        $input['color_content'] = !empty($request->input('color_content')) ? json_encode( $request->input('color_content') ) : null;
    
        $input['cd_content'] = !empty($request->input('cd_content')) ? json_encode( $request->input('cd_content') ) : null;
        
        $input['status'] = $request->status == 1 ? 1 : null;

        $input['is_hot'] = $request->is_hot == 1 ? 1 : null;

        $input['is_flash_sale'] = $request->is_flash_sale == 1 ? 1 : null;

        $input['show_home'] = $request->show_home == 1 ? 1 : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $input['price_priority'] = !is_null($request->sale_price) ? $request->sale_price : $request->regular_price;

        $input['spkh'] = !is_null($request->spkh_id) ? json_encode($request->spkh_id) : null;

        $product = Products::create($input);


        if(!empty($request->category)){
        	foreach ($request->category as $item) {
        		ProductCategory::create(['id_category'=> $item, 'id_product'=> $product->id]);
        	}
        }

        if(!empty($request->product_attributes)){
            foreach ($request->product_attributes as $value) {
                ProductAttributes::create(
                    [
                        'id_product' => $product->id,
                        'id_product_attribute_types' => $value['id_product_attribute_types'],
                        'key' => $value['key'],
                        'value' => 0,
                    ]
                );
            }
        }

        if(!empty($request->tags)){
            $product->tag(explode(',', $request->tags));
        }

        flash('Thêm mới thành công.')->success();

        return redirect()->route($this->module()['module'].'.edit', $product);


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
        $data['categories'] = Categories::where('type','product_category')->get();
        
        $data['brands'] = Categories::where('type','brand_category')->get();

        $data['data'] = Products::findOrFail($id);

        if(!empty($data['data']->spkh)){
            $data['spkh'] = Products::whereIn('id',json_decode($data['data']->spkh))->get();
        }

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
    	$fields = $this->fields();
        
    	$fields['sku'] = 'required|unique:products,sku,'.$id;

        $input['slug'] = $this->createSlug(str_slug($request->name));

        $this->validate($request, $fields, $this->messages());

        if(!empty($request->sale_price)){
            if($request->regular_price < $request->sale_price){
                return redirect()->back()->withInput()->withErrors(['Giá khuyến mại không thể cao hơn giá bán']);
            }
        }

        $input = $request->all();

        $input['color_content'] = !empty($request->input('color_content')) ? json_encode( $request->input('color_content') ) : null;
        
        $input['cd_content'] = !empty($request->input('cd_content')) ? json_encode( $request->input('cd_content') ) : null;
        
        $input['status'] = $request->status == 1 ? 1 : null;

        $input['is_hot'] = $request->is_hot == 1 ? 1 : null;

        $input['is_flash_sale'] = $request->is_flash_sale == 1 ? 1 : null;

        $input['show_home'] = $request->show_home == 1 ? 1 : null;

        $input['more_image'] = !empty($request->gallery) ? json_encode($request->gallery) : null;

        $input['price_priority'] = !is_null($request->sale_price) ? $request->sale_price : $request->regular_price;

        $input['spkh'] = !is_null($request->spkh_id) ? json_encode($request->spkh_id) : null;

        $product = Products::find($id)->update($input);

        if(!empty($request->category)){
        	 ProductCategory::where('id_product', $id)->delete();
        	foreach ($request->category as $item) {
        		ProductCategory::create(['id_category'=> $item, 'id_product'=> $id]);
        	}
        }

        ProductAttributes::where('id_product', $id)->delete();
        if(!empty($request->product_attributes)){
            foreach ($request->product_attributes as $value) {
                ProductAttributes::create(
                    [
                        'id_product' => $id,
                        'id_product_attribute_types' => $value['id_product_attribute_types'],
                        'key' => $value['key'],
                        'value' => 0,
                    ]
                );
            }
        }

        flash('Cập nhật sản phẩm thành công.')->success();
        return back()->with('active_tab', $request->active_tab);
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

        Products::destroy($id);

        ProductAttributes::where('id_product', $id)->delete();
        ProductCategory::where('id_product', $id)->delete();

        return redirect()->back();
    }

    public function deleteMuti(Request $request)
    {
        if(!empty($request->chkItem)){
            foreach ($request->chkItem as $id) {
                Products::destroy($id);
                ProductAttributes::where('id_product', $id)->delete();
                ProductCategory::where('id_product', $id)->delete();
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
        $post = Products::find($id);
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
            $count = Products::where('id', '!=', $id)->where('slug', $slug)->count();
            return $count > 0;
        }else{
            $count = Products::where('slug', $slug)->count();
            return $count > 0;
        }
    }

    public function getAllProducts(Request $request){

        $id = $request->id;

        $array_spkh='';

        if($id!=''){

            $array_spkh = explode(",",$id);

        }
        $products = Products::all();

        return view('backend.products.get-all',compact('products','array_spkh'))->render();
    }
}
