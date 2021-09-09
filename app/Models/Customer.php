<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customer';
    protected $fillable = [ 'name', 'user_name','phone','email', 'address', 'city_id', 'district_id','ward_id','sex','birthday','object','cmnd','facebook','zalo','confirmed','code','password','provider_id','provider','image','email_social'];
}
