<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    protected $table = 'real_estate';

    protected $fillable = ['customer_id','city_id','district_id','ward_id','address','object','need','type_housing','projects_id','land_area','usable_area','price','price2','bedroom','bathroom','number_floors','direction_house','balcony_direction','frontispiece','way','image','more_image','desc','content','status','startDate','endDate','tt'];
}
