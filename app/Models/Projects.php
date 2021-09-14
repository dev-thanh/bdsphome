<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    protected $fillable = [ 
        'name', 'slug' ,'address','company_id','price','price2', 'desc' , 'content' , 'image' , 'more_image' , 'type','status','hot' , 'meta_title' , 'meta_description' , 'meta_keyword'
	];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'projects_category', 'id_projects', 'id_category');
    }
}
