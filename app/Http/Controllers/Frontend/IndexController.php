<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use Validator;
use View;
use App\Models\Pages;
use App\Models\Image;
use App\Models\Categories;
use App\Models\Products;
use App\Models\PromotionalNews;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\General\GeneralRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Services\ServicesRepository;
use App\Repositories\Projects\ProjectsRepository;
use App\Repositories\Posts\PostsRepository;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Bds\BdsRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ContactRequest;

class IndexController extends Controller
{
    public $config_info,$menu,$general,$customer,$categories,$posts,$services,$contact, $projects,$bds;

    public function __construct(MenuRepository $menu, GeneralRepository $general,CustomerRepository $customer, CategoriesRepository $categories, PostsRepository $posts,ServicesRepository $services, ContactRepository $contact, ProjectsRepository $projects,BdsRepository $bds)
    {
        $this->menu = $menu;

        $this->general = $general;

        $this->customer = $customer;

        $this->categories = $categories;

        $this->posts = $posts;

        $this->services = $services;

        $this->projects = $projects;

        $this->contact = $contact;
        $this->bds = $bds;
        
        $this->general->seoGeneral();
    }

    public function getHome(){

        $contentHome = Pages::where('type', 'home')->first();

    	$this->general->createSeo($contentHome);

        $cateServices = $this->categories->getCateServices();

        $posts = $this->posts->getPostsHome();

        $slider = $this->categories->getImageSlide();

        $projectsHot = $this->projects->getProjectsHot();

        $bds = $this->bds->getBdsHome(16);


    	return view('frontend.pages.home', compact('contentHome','slider','cateServices','posts','projectsHot','bds'));
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
        $dataSeo = Pages::where('type', 'contact')->first();

        return view('frontend.pages.contact',compact('dataSeo'));
    }

    public function postContact(ContactRequest $request)
    {
        $data = $this->contact->saveContact($request);

        return $data;
    }

    public function getListProjects()
    {
        
        $dataSeo = Pages::where('type', 'projects')->first();

        $this->general->createSeo($dataSeo);

        $posts = $this->projects->getProjectsPage();

        $cate_post = $this->categories->getCate('project_category');

        return view('frontend.pages.projects',compact('cate_post','posts', 'dataSeo'));
    }

    public function getSingleProject($slug)
    {
        $data = $this->projects->getProjectsBySlug($slug);

        $new_same_category  = $this->projects->getProjectsSame($data);

        $bds = $this->bds->where(['status' =>1,'projects_id' => $data->id])->get();

        return view('frontend.pages.single-project',compact('data','new_same_category','bds'));
    }

    public function ajaxLoadMoreProjects()
    {
        try {

            if($request->cate=='all')
            {

                $news = $this->projects->getProjectsPage();

            }else{

                $category = $this->categories->find($request->cate);
    
                $news = $category->Projects()->paginate(10);
            }
            

            $view = (string) View::make('frontend.pages.ajax-load-projects',compact('news'));
            
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

    public function getListBds()
    {
        $listBds = $this->bds->getBdsHome(21);

        return view('frontend.pages.list-bds',compact('listBds'));
    }

    public function getSingleBdst($slug)
    {
        $bdsDetail = $this->bds->getBdsBySlug($slug);

        $project = null;

        if(!empty($bdsDetail->projects_id))
        {
            $project = $this->projects->find($bdsDetail->projects_id);
        }

        $cateBds = $bdsDetail->type_housing;

        $bdsSame = $this->bds->where('id','!=',$bdsDetail->id)->where([
            'type_housing' => $cateBds,
            'status' => 1
        ])->take(6)->get();

        return view('frontend.pages.single-bds',compact('bdsDetail','project','bdsSame'));
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

            $msg->from(config('mail.mail_from'), 'Website - Bất động sản Phome');

            $msg->to($email_admin, 'Website - Bất động sản Phome')->subject('Đăng ký nhận tin khuyến mại');

        });

        $result['success'] = 'Gửi đăng ký nhận tin khuyến mại thành công, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn !';

        return json_encode($result);

    }

}