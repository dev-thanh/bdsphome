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
use App\Repositories\Products\ProductRepository;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\General\GeneralRepository;


class IndexController extends Controller
{

	public $config_info,$menu,$general;

    public function __construct(MenuRepository $menu, GeneralRepository $general)
    {
        $this->menu = $menu;

        $this->general = $general;
        
        $this->general->seoGeneral();
    }


    public function getHome()
    { 
        
        $contentHome = Pages::where('type', 'home')->first();

    	$this->general->createSeo($contentHome);

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
            'user_name.required' => 'T??n ????ng nh???p kh??ng ???????c ????? tr???ng',
            'user_name.unique' => 'T??n ????ng nh???p n??y ???? c?? ng?????i s??? d???ng',
            'email.required' => 'Email kh??ng ???????c ????? tr???ng',
            'email.email' => 'Email kh??ng ????ng ?????nh d???ng',
            'email.unique' => 'Email n??y ???? c?? ng?????i s??? d???ng',
            'phone.required' => 'S??? ??i???n tho???i kh??ng ???????c ????? tr???ng',
            'password.required' => 'M???t kh???u kh??ng ???????c ????? tr???ng',
            'password.string' => 'M???t kh???u ph???i l?? chu???i k?? t???',
            'password.min' => 'M???t kh???u ??t nh???t ph???i 6 k?? t???',
            'password.confirmed' => 'Nh???p l???i m???t kh???u kh??ng kh???p',
            'password_confirmation.required' => 'Vui l??ng nh???p l???i m???t kh???u',
            'accept.required' => 'Vui l??ng ?????ng ?? v???i ??i???u kho???n d???ch v???'
        ];

        $success = '????ng k?? th??nh c??ng, vui l??ng x??c th???c t??i kho???n c???a b???n qua gmail';
        
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
                    
            $success = 'X??c nh???n t??i kho???n th??nh c??ng,vui l??ng ????ng nh???p l???i';
            

        } else {
            return abort(404);
        }

        return redirect()->route('home.login')->with(['toastr' => $success]);
    }

    public function postLogin(Request $request){

        $input = $request->all();
        
        $message = [
            'email.required' => 'Vui l??ng nh???p t??n t??i kho???n ho???c ?????a ch??? email',
            'password.required' => 'Vui l??ng nh???p m???t kh???u'
        ];
        $message_login = 'Th??ng tin ????ng nh???p kh??ng ch??nh x??c';
        
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
                        return redirect()->route('home.check-out1')->with('toastr','????ng nh???p th??nh c??ng.');
                    }else{

                        return redirect()->route('home.profile')->with('toastr','????ng nh???p th??nh c??ng.');

                    }


                }else{

                    Auth::guard('customer')->logout();

                    $validator->getMessageBag()->add('confirmed', 'T??i kho???n ch??a ???????c x??c nh???n,vui l??ng ki???m tra email ????? x??c nh???n t??i kho???n.');

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
            'email.required' => 'Email kh??ng ???????c ????? tr???ng',
            'email.email' => 'Email kh??ng ????ng ?????nh d???ng',
            'email.unique' => 'Email n??y ???? c?? ng?????i s??? d???ng',
            'phone.required' => 'S??? ??i???n tho???i kh??ng ???????c ????? tr???ng',
            'phone.min' => 'S??? ??i???n tho???i ph???i c?? 10 s???',
            'old_password.required' => 'Vui l??ng nh???p m???t kh???u c??',
            'password.required' => 'Vui l??ng nh???p m???t kh???u m???i',
            'password.string' => 'M???t kh???u m???i ph???i l?? chu???i k?? t???',
            'password.min' => 'M???t kh???u m???i ??t nh???t ph???i 6 k?? t???',
            'password.confirmed' => 'Nh???p l???i m???t kh???u kh??ng kh???p',
            'password_confirmation.required' => 'Vui l??ng nh???p l???i m???t kh???u'
        ];

        $success = 'C???p nh???p t??i kho???n th??nh c??ng';
        
        $input = $request->all();

        $id = auth('customer')->user()->id;

        if(!empty($request->old_password) || !empty($request->password) || !empty($request->password_confirmation)){

            $fields = [
                'email' => 'required|email|unique:customer,email,'.$id,
                'phone' => 'required|min:10',
                'old_password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, auth('customer')->user()->password)) {
                            $fail('M???t kh???u c?? kh??ng x??nh x??c');
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
        $success_message = 'Vui l??ng ki???m tra email c???a b???n ????? x??c nh???n thay ?????i m???t kh???u';

        $input = $request->all();

        $message = [
            'email.required' => 'Vui l??ng ??i???n email ????ng k?? t??i kho???n',
            'email.email' => 'Email kh??ng ????ng ?????nh d???ng',
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

            $validator->getMessageBag()->add('email', 'Email kh??ng t???n t???i trong h??? th???ng.');

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
        $success_message = 'Thay ?????i m???t kh???u th??nh c??ng';

        $input = $request->all();

        $message = [
            'password.required' => 'Vui l??ng nh???p m???t kh???u m???i',
            'password.min' => 'M???t kh???u m???i ??t nh???t 6 k?? t???',
            'confirm.required' => 'Vui l??ng nh???p l???i m???t kh???u m???i',
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

            $validator->getMessageBag()->add('pass_confirm', 'Nh???p l???i m???t kh???u kh??ng kh???p');

            return redirect()->back()->withErrors($validator)->withInput();

        }
        
    }

























    public function getProducts(){

        $dataSeo = Pages::where('type', 'products')->first();

        $this->general->createSeo($dataSeo);

        $data    = Products::active()->filter()->sort()->take(16)->get();

        $filters = Filter::where('category_id', 0)->orderBy('position', 'ASC')->get();

        return view('frontend.pages.archive-products', compact('data', 'dataSeo', 'filters'));

    }




















    public function getSearch(Request $request)
    {
        $key = $request->search;

        $dataSeo = Pages::where('type', 'product')->first();

        $this->general->createSeo($dataSeo);

        SEO::setTitle('T??m ki???m t??? kh??a: '.$key);

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

        $this->general->createSeo($dataSeo);

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

        $this->general->createSeoPost($data);

        if($data){
            return view('frontend.pages.policy',compact('data'));
        }

    }

    public function sendSale(Request $request){
        $result = [];
        
        if($request->email ==''){
            $result['message_error'] = 'B???n ch??a nh???p email';
        }else{
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            }else{
                $result['message_error'] = 'Vui l??ng nh???p email h???p l???';
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

            $msg->from(config('mail.mail_from'), 'Website - Xe ?????p ??i???n Phong L??');

            $msg->to($email_admin, 'Website - Xe ?????p ??i???n Phong L??')->subject('????ng k?? nh???n tin khuy???n m???i');

        });

        $result['success'] = 'G???i ????ng k?? nh???n tin khuy???n m???i th??nh c??ng, ch??ng t??i s??? li??n l???c v???i b???n trong th???i gian s???m nh???t. Xin c???m ??n !';

        return json_encode($result);

    }




    
    

    public function categoryProduct(Request $request, $slug){
        $dataSeo = Pages::where('type', 'product')->first();

        $category = Categories::where('slug', $slug)->firstOrFail();

        if(!isset($category)){
            return abort(404);
        }

        $this->general->createSeoPost($category);

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

                return '<div class="no-products">Kh??ng t??m th???y s???n ph???m n??o</div>';

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

        $this->general->createSeoPost($data);

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

        return redirect()->back()->with(['toastr' => 'Th??m v??o gi??? h??ng th??nh c??ng.']);
    }

    public function getRemoveCart(Request $request)
    {
        Cart::remove($request->id);

        $empty = '';
        
        $toastr = 'X??a th??nh c??ng s???n ph???m ra kh???i gi??? h??ng';

        if(Cart::count() ==0){
            $empty = 'Ch??a c?? s???n ph???m n??o trong gi??? h??ng';
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
                'message'=> 'Kh??ng c?? s???n ph???m n??o trong gi??? h??ng',
            ]);
        }

        if(!Auth::guard('customer')->check()){

            return response()->json([
                'check_login'=>0,
                'message'=> 'Vui l??ng ????ng nh???p tr?????c khi ti???n h??nh thanh to??n',
            ]);

        }

        $message = [
            'name.required' => 'H??? t??n kh??ng ???????c ????? tr???ng',
            'email.required' => 'Email kh??ng ???????c ????? tr???ng',
            'email.email' => 'Email kh??ng ????ng ?????nh d???ng',
            'phone.required' => 'S??? ??i???n tho???i kh??ng ???????c ????? tr???ng',
            'city.required' => 'Vui l??ng ch???n t???nh th??nh',
            'district.required' => 'Vui l??ng ch???n qu???n huy???n',
            'ward.required' => 'Vui l??ng ch???n x?? ph?????ng',
            'address.required' => 'Vui l??ng nh???p ?????ac ch??? nh???n h??ng c??? th???',
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

        $this->general->createSeo($dataSeo);

        return view('frontend.pages.checkout.checkout2', compact('dataSeo'));
    }

    public function postCheckOut2(Request $request){

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('home.login');
        }

        if(Cart::count() == 0){
            return redirect()->back()->with(['toastr_err' => 'Kh??ng c?? s???n ph???m n??o trong gi??? h??ng.']); 
        }

        

        if (Session::has('customer_account')){

            $session = Session::get('customer_account');

            $session['payments'] = $request->payments;

            Session::put('customer_account',$session);

            //dd(Session::get('customer_account'));
            

            return redirect()->route('home.get-check-out3');

        }else{
        
            return redirect()->route('home.check-out1')->with(['toastr_err' => 'Vui l??ng nh???p th??ng tin tr?????c khi chuy???n sang h??nh th???c thanh to??n']); 
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
        
            return redirect()->route('home.check-out1')->with(['toastr_err' => 'Vui l??ng nh???p th??ng tin tr?????c khi chuy???n sang h??nh th???c thanh to??n']); 
        }
        
    }

    public function checkPoint(Request $request){

        if (!Auth::guard('customer')->check()) {
            return response()->json([
                'login_false'=>0,
                'message'=> 'Vui l??ng ????ng nh???p l???i tr?????c khi thanh to??n'
            ]);
        }

        $point = auth('customer')->user()->total_point;

        if($request->point > $point){
            return response()->json([
                'status'=>0,
                'message'=> '??i???m c???a b???n hi???n t???i kh??ng ?????',
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
                'message'=> '??p d???ng ??i???m th??nh c??ng'
            ]);
            
        }

    }

    public function getListNews(){

        $dataSeo = Pages::where('type', 'news')->first();

        $this->general->createSeo($dataSeo);

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

        $this->general->createSeo($dataSeo);

        return view('frontend.pages.faq',compact('dataSeo'));

    }

}
