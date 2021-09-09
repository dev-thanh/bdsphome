<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use View;
use App\Models\Pages;
use App\Models\Image;
use App\Models\Categories;
use App\Models\Products;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\General\GeneralRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Services\ServicesRepository;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class IndexController extends Controller
{
    public $config_info,$menu,$general,$customer,$categories,$posts,$services;

    public function __construct(MenuRepository $menu, GeneralRepository $general,CustomerRepository $customer, CategoriesRepository $categories, PostsRepository $posts,ServicesRepository $services)
    {
        $this->menu = $menu;

        $this->general = $general;

        $this->customer = $customer;

        $this->categories = $categories;

        $this->posts = $posts;

        $this->services = $services;
        
        $this->general->seoGeneral();
    }

    public function getHome(){

        $contentHome = Pages::where('type', 'home')->first();

    	$this->general->createSeo($contentHome);

        $cateServices = $this->categories->getCateServices();

        $posts = $this->posts->getPostsHome();

        $slider = $this->categories->getImageSlide();

    	return view('frontend.pages.home', compact('contentHome','slider','cateServices','posts'));
    }

    public function postLogin(LoginRequest $request){

        return $this->customer->loginAccount($request);

    }

    public function postRegister(RegisterRequest $request){
        
        return $this->customer->registerAccount($request);

    }

    public function logOut()
    {
        Auth::guard('customer')->logout();

        return redirect()->back();
    }

    public function getAbout()
    {
        $dataSeo = $this->customer->getDataPage('about');

        return view('frontend.pages.about',compact('dataSeo'));
    }

    /* Tin tức */
    public function getListNews(){

        $dataSeo = Pages::where('type', 'news')->first();

        $this->general->createSeo($dataSeo);

        $posts = $this->posts->getPostsPage();

        $cate_post = $this->categories->getCate('news_category');

        return view('frontend.pages.archives-news',compact('cate_post','posts', 'dataSeo'));
    }

    public function getSingleNews($slug){

        $data = $this->posts->getPostBySlug($slug);

        $new_same_category  = $this->posts->getPostsSame($data);

        return view('frontend.pages.single-news',compact('data','new_same_category'));

    }

    public function ajaxLoadMoreNews(Request $request)
    {
        try {
            
            if($request->cate=='all')
            {

                $news = $this->posts->getPostsPage();

            }else{

                $category = $this->categories->find($request->cate);
    
                $news = $category->Posts()->paginate(10);
            }

            $view = (string) View::make('frontend.pages.ajax-load-news',compact('news'));
            
            return response()->json(
                [
                    'status'=>'success',
                    'html_response' => $view
                ]
            );
        } catch (Exception $e) {

            return response()->json(['status'=>'error']);

        }
    }

    /** Dịch vụ */
    public function getListServices()
    {
        $dataSeo = Pages::where('type', 'services')->first();

        $this->general->createSeo($dataSeo);

        $posts = $this->services->getServicesPage();

        $cate_post = $this->categories->getCate('service_category');

        return view('frontend.pages.archives-services',compact('cate_post','posts', 'dataSeo'));
    }

    public function getSingleServices($slug){

        $data = $this->services->getServicesBySlug($slug);

        $new_same_category  = $this->services->getServicesSame($data);

        return view('frontend.pages.single-services',compact('data','new_same_category'));

    }

    public function ajaxLoadMoreServices(Request $request)
    {
        try {

            if($request->cate=='all')
            {

                $news = $this->services->getServicesPage();

            }else{

                $category = $this->categories->find($request->cate);
    
                $news = $category->Services()->paginate(10);
            }
            

            $view = (string) View::make('frontend.pages.ajax-load-services',compact('news'));
            
            return response()->json(
                [
                    'status'=>'success',
                    'html_response' => $view
                ]
            );
        } catch (Exception $e) {

            return response()->json(['status'=>'error']);

        }
    }

    public function getContact()
    {
        return view('frontend.pages.contact');
    }

}