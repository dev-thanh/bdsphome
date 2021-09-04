<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;

class CheckoutController extends Controller
{
    public function getDistrict($id){

        $district = District::where('city_id',$id)->orderBy('district_name','ASC')->get();

        return view('frontend.pages.checkout.get-district',compact('district'))->render();
    }

    public function getWards($id){

        $wards = Wards::where('district_id',$id)->orderBy('ward_name','ASC')->get();

        return view('frontend.pages.checkout.get-wards',compact('wards'))->render();

    }
}
