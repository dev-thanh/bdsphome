<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Options;
use App\Models\Service;
use DateTime;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Menu;
use Illuminate\Support\Facades\Mail;
use App\Models\Image;
use JsValidator;
use Validator;
use DOMDocument;
use DB;
use Cart;
use App\Models\Services;
use App\Models\ServicesCategory;
use App\Models\Products;
use App\Models\Policy;
use App\Models\Contact;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\ProductCategory;
use App\Models\ProductAttributes;
use App\Models\ProductAttributeTypes;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Filter;
use App\Models\Banks;
use App\Models\PromotionalNews;
use App\Models\ResetPass;
use Illuminate\Support\Facades\Hash;
use App\Events\RegisterEvent;
use App\Events\ForgotPassword;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Session;


class IndexController extends Controller
{

	public $config_info;

    public function __construct()
    {
        $site_info = Options::where('type', 'general')->first();
        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $this->config_info = $site_info;
            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');
            SEOMeta::addKeyword($site_info->site_keyword);

            $menuHeader = Menu::where('id_group', 1)->orderBy('position')->get();
            $menuFooter = Menu::where('id_group', 2)->orderBy('position')->get();
            $menuFooter2 = Menu::where('id_group', 3)->orderBy('position')->get();
            
            $policy = Policy::where('status', 1)->orderBy('stt','ASC')->get();

            view()->share(compact('site_info', 'menuHeader','menuFooter','menuFooter2', 'policy'));
        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->config_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($this->config_info->site_description);
            OpenGraph::setDescription($this->config_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($this->config_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function getHome()
    { 
        
        $contentHome = Pages::where('type', 'home')->first();

    	$this->createSeo($contentHome);

        $slider = Image::where('status', 1)->where('type', 'slider')->get();

        $category = Categories::where('type', 'product_category')->get();

        $product_hot = Products::where([
            'status' => 1,
            'is_hot' => 1
        ])->get();

        $product_selling = Products::where([
            'status' => 1,
            'is_flash_sale' => 1
        ])->get();

    	return view('frontend.pages.home', compact('contentHome','slider','product_selling','product_hot'));
    }

    public function getProducts(){

        $dataSeo = Pages::where('type', 'products')->first();

        $this->createSeo($dataSeo);

        $data    = Products::active()->filter()->sort()->take(16)->get();

        $filters = Filter::where('category_id', 0)->orderBy('position', 'ASC')->get();

        return view('frontend.pages.archive-products', compact('data', 'dataSeo', 'filters'));

    }

    public function getSearch(Request $request)
    {
        $key = $request->search;

        $dataSeo = Pages::where('type', 'product')->first();

        $this->createSeo($dataSeo);

        SEO::setTitle('Tìm kiếm từ khóa: '.$key);

        $products = null;
        
        $posts = null;

        if(!empty($request->search)){
            
            $products = Products::where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->orderBy('created_at', 'DESC')->paginate(9);

            $posts = Posts::where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })->orderBy('created_at', 'DESC')->paginate(9);
        }


        return view('frontend.pages.get-search', compact('dataSeo', 'products','posts'));
    }

    public function getCart()
    {
        $dataSeo = Pages::where('type', 'cart')->first();

        $this->createSeo($dataSeo);

        $dataProducts = Products::orderBy('created_at','DESC')->take(12)->get();

        $banks = Banks::where('status',1)->get();

        return view('frontend.pages.cart', compact('dataProducts','dataSeo','banks'));
    }

    public function policy($slug){

        $data = Policy::where([
            'slug' =>$slug,
            'status' => 1
        ])->first();

        if(!isset($data)){
            return abort(404);
        }

        $this->createSeoPost($data);

        if($data){
            return view('frontend.pages.policy',compact('data'));
        }

    }

    public function sendSale(Request $request){
        $result = [];
        
        if($request->email ==''){
            $result['message_error'] = 'Bạn chưa nhập email';
        }else{
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            }else{
                $result['message_error'] = 'Vui lòng nhập email hợp lệ';
            }
        }

        if($result != []){
            return json_encode($result);
        }

        $model = new PromotionalNews();

        $model->email = $request->email;

        $model->status = 0;

        $model->save();

        $content_email = [
            'email' => $request->email,
        ]; 

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-sale', $content_email, function ($msg) use($email_admin) {

            $msg->from(config('mail.mail_from'), 'Website - Xe đạp điện Phong Lý');

            $msg->to($email_admin, 'Website - Xe đạp điện Phong Lý')->subject('Đăng ký nhận tin khuyến mại');

        });

        $result['success'] = 'Gửi đăng ký nhận tin khuyến mại thành công, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn !';

        return json_encode($result);

    }




    
    public function login(){

        if(Auth::guard('customer')->check()){
            return redirect()->route('home.index');
        }

        return view('frontend.pages.login');
    }

    public function register(){

        return view('frontend.pages.register');

    }

    public function postRegister(Request $request){
                 
        $message = [
            'user_name.required' => 'Tên đăng nhập không được để trống',
            'user_name.unique' => 'Tên đăng nhập này đã có người sử dụng',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã có người sử dụng',
            'phone.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'password.min' => 'Mật khẩu ít nhất phải 6 kí tự',
            'password.confirmed' => 'Nhập lại mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu',
            'accept.required' => 'Vui lòng đồng ý với điều khoản dịch vụ'
        ];

        $success = 'Đăng ký thành công, vui lòng xác thực tài khoản của bạn qua gmail';
        
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:customer,email',
            'user_name' => 'required|unique:customer,user_name',
            'phone' => 'required',
            'accept' => 'required',
            'password' => [
                'required',
                'string',
                'min:6', 
                'confirmed',
            ],
            'password_confirmation' => 'required',
        ],$message);


        if ($validator->passes()) {
            $confirmation_code = time().uniqid(true);
            $input['password'] = Hash::make($request->password);
            $input['confirmed'] = 0;
            $input['code'] = $confirmation_code;
            $member = Customer::create($input);

            $content_email = [
                'url' => route('home.verify-account',['code'=>$confirmation_code]),
            ];
    
            $email_admin = getOptions('general', 'email_admin');

            event(new RegisterEvent($request->email,$content_email));

            return redirect()->back()->with(['toastr' => $success]);
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function verifyRegister($code){

        $user = Customer::where('code', $code);

        if ($user->count() > 0) {
            $user->update([
                'confirmed' => 1,
                'code' => null
            ]);
                    
            $success = 'Xác nhận tài khoản thành công,vui lòng đăng nhập lại';
            

        } else {
            return abort(404);
        }

        return redirect()->route('home.login')->with(['toastr' => $success]);
    }

    public function postLogin(Request $request){

        $input = $request->all();
        
        $message = [
            'email.required' => 'Vui lòng nhập tên tài khoản hoặc địa chỉ email',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ];
        $message_login = 'Thông tin đăng nhập không chính xác';
        
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ],$message);

        if ($validator->passes()) {
            
            $login_type = filter_var($request->email, FILTER_VALIDATE_EMAIL ) 
                ? 'email' 
                : 'user_name';
            if($login_type == 'email'){
                $credentials = array('email' => $request->email, 'password' => $request->password);
            }else{
                $credentials = array('user_name' => $request->email, 'password' => $request->password);
            }
           
            if (Auth::guard('customer')->attempt($credentials)) {

                if(Auth::guard('customer')->user()->confirmed == 1){

                    if($request->tab=='checkout'){
                        return redirect()->route('home.check-out1')->with('toastr','Đăng nhập thành công.');
                    }else{

                        return redirect()->route('home.profile')->with('toastr','Đăng nhập thành công.');

                    }


                }else{

                    Auth::guard('customer')->logout();

                    $validator->getMessageBag()->add('confirmed', 'Tài khoản chưa được xác nhận,vui lòng kiểm tra email để xác nhận tài khoản.');

                    return redirect()->back()->withErrors($validator);

                }
                
            }

            $validator->getMessageBag()->add('login_error', $message_login);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function logOut(){
        
        Auth::guard('customer')->logout();
        
        Cart::destroy();

        return redirect()->back();
    }

    public function profile(){

        if(Auth::guard('customer')->check()){

            $profile = auth('customer')->user();

            $orders = Order::where('id_customer',$profile->id)->get();

            return view('frontend.pages.profile',compact('profile','orders'));
            
        }

        

        return redirect()->route('home.index');

    }

    public function editAccount(){

        if(!Auth::guard('customer')->check()){

            return redirect()->route('home.login');
            
        }

        $customer = auth('customer')->user();

        return view('frontend.pages.edit-account',compact('customer'));
    }

    public function postEditAccount(Request $request){

        $message = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã có người sử dụng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại phải có 10 số',
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.string' => 'Mật khẩu mới phải là chuỗi kí tự',
            'password.min' => 'Mật khẩu mới ít nhất phải 6 kí tự',
            'password.confirmed' => 'Nhập lại mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu'
        ];

        $success = 'Cập nhập tài khoản thành công';
        
        $input = $request->all();

        $id = auth('customer')->user()->id;

        if(!empty($request->old_password) || !empty($request->password) || !empty($request->password_confirmation)){

            $fields = [
                'email' => 'required|email|unique:customer,email,'.$id,
                'phone' => 'required|min:10',
                'old_password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, auth('customer')->user()->password)) {
                            $fail('Mật khẩu cũ không xính xác');
                        }
                    },
                ],
                'password' => [
                    'required',
                    'string',
                    'min:6', 
                    'confirmed',
                ],
                'password_confirmation' => 'required',
            ];

            $validator = Validator::make($input, $fields ,$message);

            if ($validator->passes()) {

                $input['password'] = Hash::make($request->password);
                
                $member = Customer::find($id)->update($input);

                return redirect()->back()->with(['toastr' => $success]);
            }

        }else{

            $fields = [
                'email' => 'required|email|unique:customer,email,'.$id,
                'phone' => 'required|min:10'
            ];

            $validator = Validator::make($input, $fields ,$message);

            if ($validator->passes()) {

                unset($input["password"]);
               
                $member = Customer::find($id)->update($input);

                return redirect()->back()->with(['toastr' => $success]);
            }
            
        }

        return redirect()->back()->withErrors($validator)->withInput();
        
    }
    
    public function forgotPassword(){

        return view('frontend.pages.forgot-password');

    }

    public function postForgotPassword(Request $request)
    {
        $success_message = 'Vui lòng kiểm tra email của bạn để xác nhận thay đổi mật khẩu';

        $input = $request->all();

        $message = [
            'email.required' => 'Vui lòng điền email đăng ký tài khoản',
            'email.email' => 'Email không đúng định dạng',
        ];
        
        $validator = Validator::make($input, [
            'email' => 'required|email'
        ],$message);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $result = Customer::where('email', $request->email)->first();

        if($result){

            $resetPassword = ResetPass::firstOrCreate(['email'=>$request->email, 'token'=>Str::random(60)]);

            $token = ResetPass::where('email', $request->email)->first();

            $link = url('resetPassword')."/".$token->token; //send it to email

            $content_email = [
                'url' => $link,
            ];

            event(new ForgotPassword($request->email,$content_email));

            return redirect()->back()->with('message', $success_message);
            
        } else {

            $validator->getMessageBag()->add('email', 'Email không tồn tại trong hệ thống.');

            return redirect()->back()->withErrors($validator)->withInput();
            
        }
        
    }

    public function resetPassword($token)
    {
        $result = ResetPass::where('token', $token)->first();

        if($result){
            return view('frontend.pages.new-password', compact('result'));
        } else {
            echo 'This link is expired';
        }
    }

    public function newPassword(Request $request)
    {
        $success_message = 'Thay đổi mật khẩu thành công';

        $input = $request->all();

        $message = [
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu mới ít nhất 6 ký tự',
            'confirm.required' => 'Vui lòng nhập lại mật khẩu mới',
        ];
        
        $validator = Validator::make($input, [
            'password' => 'required|min:6',
            'confirm' => 'required'
        ],$message);

        if($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        }

        if($request->password == $request->confirm){

            $result = ResetPass::where('token', $request->token)->first();
    
            // Update new password 
            Customer::where('email', $result->email)->update(['password'=>Hash::make($request->password)]);
    
            ResetPass::where('token', $request->token)->delete();
    
            return redirect()->route('home.index')->with(['toastr' => $success_message]);

        }else{

            $validator->getMessageBag()->add('pass_confirm', 'Nhập lại mật khẩu không khớp');

            return redirect()->back()->withErrors($validator)->withInput();

        }
        
    }

    public function categoryProduct(Request $request, $slug){
        $dataSeo = Pages::where('type', 'product')->first();

        $category = Categories::where('slug', $slug)->firstOrFail();

        if(!isset($category)){
            return abort(404);
        }

        $this->createSeoPost($category);

        $data = Products::select('products.*')
            ->join('product_category','products.id','=','product_category.id_product')
            ->where('product_category.id_category',$category->id)
            ->orderBy('created_at','DESC')
            ->get();
            
            $parent  = getListParent(@$category);
            
            $filters = Filter::where('category_id',$parent->id)->get();

        return view('frontend.pages.cate-product',compact('data', 'filters','category'));
    }

    public function getFilterProductsAjax(Request $request){

        $sort_fields  = $request->sort_fields;
        $sort_type    = $request->sort_type;
        $offset       = !empty($request->offset) ? $request->offset : 0;
        $dataProduct  = Products::active();
        $filterString = $request->filterString;
        $category_id  = $request->category_base;

        if (!empty($filterString)) {
            if ($category_id != 'product-page') {
                $category           = Categories::findOrFail($category_id);
                $list_id_children   = get_list_ids($category);
                $list_id_children[] = $category->id;
                $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
                $dataProduct        = $dataProduct->whereIn('id', $list_id_product);
            }

            $filterArray = explode('&', $filterString);

            if (!empty($filterArray)) {
                $array = [];
                foreach ($filterArray as $value) {
                    $filter = explode(':', $value);

                    $type  = $filter[0];

                    $param = $filter[1];

                    if ($type == 'category') {

                        $list_id         = explode(',', $param);

                        $list_id_product = ProductCategory::whereIn('id_category', $list_id)->get()->pluck('id_product')->toArray(); 

                        $dataProduct     = $dataProduct->whereIn('id', $list_id_product);

                    }else {

                        $attribute_types_id        = explode('-', $type);

                        $array[]                   = $attribute_types_id[1];

                        $list_key                  = explode(',', $param);

                        $list_id_product_attribute = ProductAttributes::where('id_product_attribute_types', $attribute_types_id[1])->whereIn('key', $list_key)->get()->pluck('id_product')->toArray();
                        
                        $dataProduct               = $dataProduct->whereIn('id', $list_id_product_attribute);
                    }
                }
            }

        } else {

            if ($category_id != 'product-page') {

                $category           = Categories::findOrFail($category_id);

                $list_id_children   = get_list_ids($category);

                $list_id_children[] = $category->id;

                $list_id_product    = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
                
                $dataProduct        = $dataProduct->whereIn('id', $list_id_product);

            }
        }

        if ($sort_fields == 'price') {

            $dataProduct = $dataProduct->orderBy('regular_price', $sort_type);

        } elseif ($sort_fields == 'product-selling') {

            $dataProduct = $dataProduct->where('is_selling', 1)->orderBy('is_selling', 'desc');

        }
        $data = $dataProduct->get();

        if ($offset == 0) {

            if(count($data)){

                return view('frontend.pages.loop-products', compact('data'))->render();

            }else{

                return '<div class="no-products">Không tìm thấy sản phẩm nào</div>';

            }
        }

        return view('frontend.pages.loop-products', compact('data'))->render();
        
    }

    public function getSingleProduct($slug){

        $data = Products::where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();

        $dataSeo = Pages::where('type', 'products')->first();

        $array_products = $data->spkh;

        $product_combined = '';

        if(!empty($array_products)){

            $product_combined = Products::whereIn('id',json_decode($array_products))->get();

        }

        $this->createSeoPost($data);

        return view('frontend.pages.single-product', compact('data', 'dataSeo', 'product_combined'));
    }

    public function postAddCart(Request $request)
    {
        $id_product = $request->id_product;
        
        $dataProduct = Products::findOrFail($id_product);

        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'color'    => $request->color,
            'qty'     => 1,
            'price'   => $request->price,
            
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'sale_price'   => $request->sale_price,
                'volume'   => $request->volume,
                'color'    => $request->color,
            ],
        ];

        Cart::add($dataCart);

        return redirect()->back()->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getRemoveCart(Request $request)
    {
        Cart::remove($request->id);

        $empty = '';
        
        $toastr = 'Xóa thành công sản phẩm ra khỏi giỏ hàng';

        if(Cart::count() ==0){
            $empty = 'Chưa có sản phẩm nào trong giỏ hàng';
        }
        
        return response()->json([
                'toastr' => $toastr,
                'total' => number_format(Cart::total(), 0, '.', '.').'VND',
                'count' => Cart::count(),
                'empty' => $empty,
        ]);
    }

    public function getUpdateCart(Request $request)
    {
        Cart::update($request->id, $request->qty);

        $item = Cart::get($request->id);

        $price_new = number_format($item->qty*$item->price, 0, '.', '.').'VND';

        return response()->json([
                'price_new'=>$price_new,
                'total' => number_format(Cart::total(), 0, '.', '.').'VND',
                'count' => Cart::count()
        ]);
    }

    public function getCheckOut1(){

        $city = City::orderBy('city_name','ASC')->get();

        return view('frontend.pages.checkout.checkout1',compact('city'));
    }

    public function postCheckOut1(Request $request){
        
        $input = $request->all();

        if(Cart::count() == 0){
            return response()->json([
                'check_cart'=>0,
                'message'=> 'Không có sản phẩm nào trong giỏ hàng',
            ]);
        }

        if(!Auth::guard('customer')->check()){

            return response()->json([
                'check_login'=>0,
                'message'=> 'Vui lòng đăng nhập trước khi tiến hành thanh toán',
            ]);

        }

        $message = [
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Số điện thoại không được để trống',
            'city.required' => 'Vui lòng chọn tỉnh thành',
            'district.required' => 'Vui lòng chọn quận huyện',
            'ward.required' => 'Vui lòng chọn xã phường',
            'address.required' => 'Vui lòng nhập địac chỉ nhận hàng cụ thể',
        ];
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required'
        ],$message);

        
        if($validator->fails()) {
            
            return response()->json($validator->errors());
            
        }

        if (Session::has('customer_account')){

            $array = Session::get('customer_account');

            $array['name'] = $request->name;
            $array['email'] = $request->email;
            $array['phone'] = $request->phone;
            $array['city'] = $request->city;
            $array['district'] = $request->district;
            $array['ward'] = $request->ward;
            $array['address'] = $request->address;

            Session::put('customer_account',$array);

        }else{

            Session::put('customer_account',$input);

        }

        return response()->json([
            'status'=>1,
            'url'=>route('home.check-out2')
        ]);

    }

    public function getCheckOut2(){

        $dataSeo = Pages::where('type', 'cart')->first();

        $this->createSeo($dataSeo);

        return view('frontend.pages.checkout.checkout2', compact('dataSeo'));
    }

    public function postCheckOut2(Request $request){

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('home.login');
        }

        if(Cart::count() == 0){
            return redirect()->back()->with(['toastr_err' => 'Không có sản phẩm nào trong giỏ hàng.']); 
        }

        

        if (Session::has('customer_account')){

            $session = Session::get('customer_account');

            $session['payments'] = $request->payments;

            Session::put('customer_account',$session);

            //dd(Session::get('customer_account'));
            

            return redirect()->route('home.get-check-out3');

        }else{
        
            return redirect()->route('home.check-out1')->with(['toastr_err' => 'Vui lòng nhập thông tin trước khi chuyển sang hình thức thanh toán']); 
        }
        
    }

    public function checkOut3(){
        
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('home.login');
        }

        if (!Session::has('customer_account')){
            return redirect()->route('home.check-out1');
        }
        
        return view('frontend.pages.checkout.check-out4');

    }

    public function getCheckOut3($id){

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('home.login');
        }

        $order = Order::find($id);

        if(!isset($order)){
            return abort(404);
        }

        if(auth('customer')->user()->id != $order->id_customer){
            return abort(404);
        }

        $order_detail = OrderDetail::where('id_order',$order->id)->get();


        return view('frontend.pages.checkout.check-out3',compact('order','order_detail'));

    }

    public function saveOrder($session){

        $order                  = new Order;
        $order->id_customer     = auth('customer')->user()->id;
        $order->total_price     = Cart::total();
        $order->type            =$session['payments'];
        $order->email            = $session['email'];
        $order->name            = $session['name'];
        $order->phone            = $session['phone'];
        $order->city_id            = $session['city'];
        $order->district_id            = $session['district'];
        $order->ward_id            = $session['ward'];
        $order->address            = $session['address'];
        $order->point            = isset($session['point']) ? $session['point'] : 0;
        $order->status          = 1;
        $order->save();

        foreach (Cart::content() as $item) {
            $orderDetail                   = new OrderDetail;
            $orderDetail->id_order         = $order->id;
            $orderDetail->id_product       = $item->id;
            $orderDetail->qty              = $item->qty;
            $orderDetail->price            = $item->price;
            $orderDetail->color            = $item->options->color;
            $orderDetail->total            = $item->price * $item->qty;
            $orderDetail->save();
        }

        Cart::destroy();

        session()->forget('customer_account');

        return $order;

    }

    public function postCheckOut3(Request $request){

        if (Session::has('customer_account')){

            $session = Session::get('customer_account');

            if($session['payments'] == 1){
                $order = $this->saveOrder($session);
            }elseif($session['payments'] == 2){
                dd($session);
            }else{

            }

            

            return redirect()->route('home.check-out3',['id'=>$order->id]);

        }else{
        
            return redirect()->route('home.check-out1')->with(['toastr_err' => 'Vui lòng nhập thông tin trước khi chuyển sang hình thức thanh toán']); 
        }
        
    }

    public function checkPoint(Request $request){

        if (!Auth::guard('customer')->check()) {
            return response()->json([
                'login_false'=>0,
                'message'=> 'Vui lòng đăng nhập lại trước khi thanh toán'
            ]);
        }

        $point = auth('customer')->user()->total_point;

        if($request->point > $point){
            return response()->json([
                'status'=>0,
                'message'=> 'Điểm của bạn hiện tại không đủ',
            ]);
        }else{

            if (Session::has('customer_account')){

                $input = Session::get('customer_account');

                $input['point'] = $request->point;

                Session::put('customer_account',$input);

            }else{
                
                $input = $request->all();

                Session::put('customer_account',$input);

            }

            return response()->json([
                'status'=>1,
                'message'=> 'Áp dụng điểm thành công'
            ]);
            
        }

    }

    public function getListNews(){

        $dataSeo = Pages::where('type', 'news')->first();

        $this->createSeo($dataSeo);

        $posts = Posts::where('status',1)->orderBy('stt','DESC')->get();

        $cate_post = Categories::where([
            'type' =>'news_category'
        ])->get();
        return view('frontend.pages.archives-news',compact('cate_post','posts', 'dataSeo'));
    }

    public function getSingleNews($slug){

        $data = Posts::where('slug',$slug)->first();

        $posts_hot = Posts::where([
            'status' => 1,
            'hot' => 1
        ])->get();

        $products_hot = Products::where([
            'status' => 1,
            'is_hot' => 1
        ])->get();

        return view('frontend.pages.single-news',compact('data','posts_hot','products_hot'));

    }

    public function getFaq(){

        $dataSeo = Pages::where('type', 'faq')->first();

        $this->createSeo($dataSeo);

        return view('frontend.pages.faq',compact('dataSeo'));

    }

}
