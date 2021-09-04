<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = [ 
        'name', 'slug' , 'desc' , 'content' , 'image' , 'type' , 'stt' , 
        'status' , 'meta_title' , 'meta_description' , 'meta_keyword', 'user_id','image_top','hot','minute','tag'
	];


	public function Author()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'news_category', 'id_news', 'id_category');
    }
}
