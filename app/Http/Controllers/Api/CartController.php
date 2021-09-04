<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


class CartController extends Controller
{

	public function getCart(Request $request){

		return response()->json(array (
  0 => 
  array (
    'userId' => 1,
    'id' => 1,
    'title' => 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit',
    'body' => 'quia et suscipit
suscipit recusandae consequuntur expedita et cum
reprehenderit molestiae ut ut quas totam
nostrum rerum est autem sunt rem eveniet architecto',
  ),
  1 => 
  array (
    'userId' => 1,
    'id' => 2,
    'title' => 'qui est esse',
    'body' => 'est rerum tempore vitae
sequi sint nihil reprehenderit dolor beatae ea dolores neque
fugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis
qui aperiam non debitis possimus qui neque nisi nulla',
  ),
  2 => 
  array (
    'userId' => 1,
    'id' => 3,
    'title' => 'ea molestias quasi exercitationem repellat qui ipsa sit aut',
    'body' => 'et iusto sed quo iure
voluptatem occaecati omnis eligendi aut ad
voluptatem doloribus vel accusantium quis pariatur
molestiae porro eius odio et labore et velit aut',
  ),
  3 => 
  array (
    'userId' => 1,
    'id' => 4,
    'title' => 'eum et est occaecati',
    'body' => 'ullam et saepe reiciendis voluptatem adipisci
sit amet autem assumenda provident rerum culpa
quis hic commodi nesciunt rem tenetur doloremque ipsam iure
quis sunt voluptatem rerum illo velit',
  ),
  4 => 
  array (
    'userId' => 1,
    'id' => 5,
    'title' => 'nesciunt quas odio',
    'body' => 'repudiandae veniam quaerat sunt sed
alias aut fugiat sit autem sed est
voluptatem omnis possimus esse voluptatibus quis
est aut tenetur dolor neque',
  ),
));
	}

	public function addCart(Request $request){

		$dataCart    = [
            'id'      => 8,
            'name'    => 'Xe đạp 2',
            'qty'     => 2,
            'price'   => 7000000,
            'weight'  => 0,
            'options' => [
                'image'       => 'http://xedien.local//uploads/files/GO_1.png',
                'slug'        => 'dsfsadf',
            ],
        ];

        Cart::add($dataCart);

        return response()->json(Cart::content());

	}
    public function postAddCart(Request $request)
    {
        // // $idProduct   = $request->id_product;
        
        // // $dataProduct = Products::findOrFail($idProduct);

        // $dataCart    = [
        //     'id'      => 8,
        //     'name'    => 'Xe đạp 2',
        //     'qty'     => 2,
        //     'price'   => 7000000,
        //     'weight'  => 0,
        //     'options' => [
        //         'image'       => 'http://xedien.local//uploads/files/GO_1.png',
        //         'slug'        => 'dsfsadf',
        //     ],
        // ];

        // Cart::add($dataCart);

        return response()->json($request->all());

        return redirect()->route('home.cart')->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    public function getAddCart(Request $request)
    {
        $idProduct   = $request->id;

        $dataProduct = Products::findOrFail($idProduct);

        $dataCart    = [
            'id'      => $dataProduct->id,
            'name'    => $dataProduct->name,
            'qty'     => 1,
            'price'   => !empty($dataProduct->price_sale) ? $dataProduct->price_sale : $dataProduct->price,
            'weight'  => 0,
            'options' => [
                'image'       => $dataProduct->image,
                'slug'        => $dataProduct->slug,
                'attributes'  => !empty($request->input('attributes')) ? $request->input('attributes') : null,
                'gift'        => !empty($request->gift) ? $request->gift : null,
            ],
        ];
        Cart::add($dataCart);
        return back()->with(['toastr' => 'Thêm vào giỏ hàng thành công.']);
    }

    // public function getCart()
    // {
    //     $dataSeo = Pages::where('type', 'cart')->first();

    //     $this->createSeo($dataSeo);

    //     $dataProducts = Products::orderBy('created_at','DESC')->take(12)->get();

    //     $banks = Banks::where('status',1)->get();

    //     return view('frontend.pages.cart', compact('dataProducts','dataSeo','banks'));
    // }

    public function getRemoveCart(Request $request)
    {
        Cart::remove($request->id);
        $empty = '';
        
        $toastr = 'Xóa thành công sản phẩm ra khỏi giỏ hàng';
        if(Cart::count() ==0){
            $empty = 'Không có sản phẩm nào trong giỏ hàng';
        }
        
        return response()->json([
                'toastr' => $toastr,
                'total' => number_format(Cart::total(), 0, '.', '.').'đ',
                'count' => Cart::count(),
                'empty' => $empty,
        ]);
    }

    public function getUpdateCart(Request $request)
    {
        Cart::update($request->id, $request->qty);
        $item = Cart::get($request->id);
        $price_new = number_format($item->qty*$item->price, 0, '.', '.').'đ';
        return response()->json([
                'price_new'=>$price_new,
                'total' => 'Tổng đơn hàng: '.number_format(Cart::total(), 0, '.', '.').'đ',
                'count' => Cart::count()
        ]);
    }

    public function getCheckOut(){

        $dataSeo = Pages::where('type', 'cart')->first();

        $this->createSeo($dataSeo);

        return view('frontend.pages.checkout', compact('dataSeo'));
    }

    public function postCheckOut(Request $request)
    {
              
        $message = [
            'name.required' => 'Họ tên không được để trống.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.min' => 'Số điện thoại không hợp lệ.',
            'phone.max' => 'Số điện thoại không hợp lệ.',
            'address.required'     => 'Bạn chưa nhập địa chỉ',
            'address.max'          => 'Địa chỉ không thể lớn hơn 250 ký tự.',
            'note.max' => 'Nội dung không thể lớn hơn 300 ký tự.',
                
        ];

        $cart_count = Cart::count();

        if($cart_count==0){
            return response()->json([
                'status'=>3,
                'error' => 'Chưa có sản phẩm trong giỏ hàng!'
            ]);
        }
        
        $input = $request->all();

        if(Cart::count() == 0){
            return response()->json(['error_cart_count'=>'Giỏ hàng hiện đang trống!']); 
        }

        $validator = Validator::make($input, [
            'name' => 'required',
            'phone' => 'required| min:10|max:11',
            'address' => 'required|max:250',
            'note'        => 'max:300',
        ],$message);

        if ($validator->passes()) {
            $customer              = new Customer;
            $customer->name        = $request->name;
            $customer->phone       = $request->phone;
            $customer->address     = $request->address;
            $customer->save();
    
            $order                  = new Order;
            $order->id_customer     = $customer->id;
            $order->total_price     = Cart::total();
    
            $order->type            = $request->type;

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
    
            $dataMail = [
                'name'        => $request->name,
                'phone'       => $request->phone,
                'address'     => $request->address,
                'cart'        => Cart::content(),
                'total'       => Cart::total(),
            ];
    
            $email_admin = getOptions('general', 'email_admin');

            Mail::send('frontend.mail.mail-order', $dataMail, function ($msg) use($email_admin) {
                $msg->from(config('mail.mail_from'), 'Website - Xe đạp điện Phong Lý');
                $msg->to(@$email_admin, 'Website - Xe đạp điện Phong Lý')->subject('Thông báo đơn hàng mới');
            });
    
            Cart::destroy();
    
            $result['success'] = 'Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.';

            $result['html_response'] = '<div class="contn"><div class="row"><div class="col-sm-12"><div class="alert alert-success" role="alert">Chưa có sản phẩm trong giỏ hàng.</div></div><div class="col-md-7 col-sm-7"><ul class="list-inline"><li class="list-inline-item"><div class="back-prd"><a title="Tiếp tục mua hàng" href="'.url('/').'"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a></div></li></ul></div></div></div>';
    
            return json_encode($result);
        }

        return response()->json(['error'=>$validator->errors()]);

    }

    public function postTest(Request $request){
        // return 55;
        return response()->json($request->all());
    }
}
