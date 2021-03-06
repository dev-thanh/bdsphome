<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = [ 
        'name', 'slug' , 'desc' , 'content' , 'image' , 'status' , 'meta_title' , 'meta_description' , 'meta_keyword', 'type'
	];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'services_category', 'id_services', 'id_category');
    }
}
