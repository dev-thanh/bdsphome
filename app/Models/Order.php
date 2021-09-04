<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttributes;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;
use App\Models\Options;

class Order extends Model
{
   	protected $table = 'orders';
    
    protected $fillable = [ 
        'id_customer', 'type' , 'total_price' , 'status', 'email', 'name', 'phone', 'city_id', 'district_id', 'ward_id', 'address','point'
    ];

    public function Customers()
    {
    	return $this->hasOne('App\Models\Customer', 'id', 'id_customer');
    }

    public function OrderDetail()
    {
    	return $this->hasMany('App\Models\OrderDetail', 'id_order', 'id');
    }

    public static function getColor($id){
        $color = ProductAttributes::find($id);
        if($color){
            return $color->key;
        }
        return '';
    }

    public static function getAddress($id_city,$id_district,$id_ward){
        $city = City::find($id_city)->city_name;
        $district = District::find($id_district)->district_name;
        $wards = Wards::find($id_ward)->ward_name;
        return $wards.', '.$district.' ,'.$city;
    }

    public static function getPoin($poin){
        $options = Options::where('type','general')->first();

        try {
            $content = json_decode($options->content);
            if($content->poin_price!=''){
                return $poin*$content->poin_price;
            }
        } catch (\Throwable $th) {
            return 0;
        }
        
    }
}
