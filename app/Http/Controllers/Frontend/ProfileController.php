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
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Projects\ProjectsRepository;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Bds\BdsRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\AddPost;

class ProfileController extends Controller
{
    public $profile,$menu,$general,$customer,$auth,$projects,$cate,$bds;

    public function __construct(ProfileRepository $profile, MenuRepository $menu, GeneralRepository $general,CustomerRepository $customer,ProjectsRepository $projects, CategoriesRepository $cate,BdsRepository $bds)
    {
        $this->profile = $profile;

        $this->menu = $menu;

        $this->general = $general;

        $this->customer = $customer;

        $this->projects = $projects;
        $this->cate = $cate;
        $this->bds = $bds;

    }

    public function adminPostManagement()
    {
        $auth = Auth::guard('customer')->user();

        $bds = $this->bds->getAllBds();

        return view('frontend.profile.admin-post',compact('auth','bds'));

    }

    public function draftNews()
    {
        $auth = Auth::guard('customer')->user();
        
        $bds = $this->bds->getBdsType(2);

        return view('frontend.profile.admin-post',compact('auth','bds'));
    }

    public function newsDown()
    {
        $auth = Auth::guard('customer')->user();

        $bds = $this->bds->getBdsType(3);

        return view('frontend.profile.admin-post',compact('auth','bds'));
    }

    public function newsPosting()
    {
        $auth = Auth::guard('customer')->user();

        $bds = $this->bds->getBdsType(1);

        return view('frontend.profile.admin-post',compact('auth','bds'));
    }

    public function newsExpired()
    {
        $auth = Auth::guard('customer')->user();

        $bds = $this->bds->getBdsType(1);

        return view('frontend.profile.admin-post',compact('auth','bds'));
    }

    public function adminAccountManagement()
    {
        $auth = Auth::guard('customer')->user();

        $city = $this->profile->getCity();

        $district = null;

        $wards = null;

        if($auth->city_id !=null){
            $district = $this->profile->getDistrict($auth->city_id);
        }

        if($district !=null){
            $wards = $this->profile->getWard($auth->district_id);
        }

        return view('frontend.profile.admin-account',compact('auth','city','district','wards'));
    }

    public function ajaxGetDistrict($id)
    {

        $district = $this->profile->getDistrict($id);

        return view('frontend.profile.ajax-district',compact('district'));

    }

    public function ajaxGetWards($id)
    {
        $wards = $this->profile->getWard($id);

        return view('frontend.profile.ajax-wards',compact('wards'));
    }

    public function updateAccount(UpdateAccountRequest $request)
    {
        $auth = Auth::guard('customer')->user();

        $image = $this->profile->saveUpdateAccount($request,$auth->id);

        return response()->json(
            [
                'success' => true,
                'message'=>'Cập nhập tài khoản thành công',
                'image_respon' => $image,
            ]
        );
    }

    public function changePassword()
    {
        $auth = Auth::guard('customer')->user();

        return view('frontend.profile.change-password',compact('auth'));

    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $auth = Auth::guard('customer')->user();

        $auth->update(['password'=>Hash::make($request->new_password)]);

        $success_message = 'Cập nhập mật khẩu thành công';

        return redirect()->back()->with(['toastr' => $success_message]);
    }

    public function adminAddPost(){

        $auth = Auth::guard('customer')->user();

        $city = $this->profile->getCity();

        $projects = $this->projects->getProjects();

        $cateParent = $this->cate->getParentCate('bds_category');

        $cateBds = $this->cate->getChildCate('bds_category',$cateParent[0]->id);

        return view('frontend.profile.add-post',compact('auth','city','projects','cateParent','cateBds'));

    }

    public function adminSaveAddPost(AddPost $request)
    {
        //dd($request->all());

        $data = $this->bds->createBds($request);

        return $data;
    }

    public function adminAddPostTest()
    {
        $auth = Auth::guard('customer')->user();
        return  view('frontend.profile.add-post-test',compact('auth'));
    }

    public function getTeamplateBds($id)
    {
        $cateBds = $this->cate->find($id);

        $data =  View::make('frontend.profile.ajax-template-bds',compact('cateBds'))->render();

        return $data;
    }
}
