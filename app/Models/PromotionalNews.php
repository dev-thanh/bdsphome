<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionalNews extends Model
{
   	protected $table = 'promotional_news';
   	
    protected $fillable = [ 'email','status'];
}
