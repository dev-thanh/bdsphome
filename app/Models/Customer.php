<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customer';
    protected $fillable = [ 'name', 'user_name','phone','email', 'address', 'province_id', 'district_id','confirmed','code','password','provider_id','provider','image','email_social','total_point'];
}
