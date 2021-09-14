<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [ 'name','slug','parent_id','category_nd','image','content','show_home', 'meta_title','meta_description', 'meta_keyword','type', 'banner', 'order','meta_banner','teamplate'];


    public function get_child_cate()
    {
        return $this->where('parent_id', $this->id)->orderBy('order')->get();
    }

    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

    public function getCateNd()
    {
        $data = $this->where('id', $this->category_nd)->first();

        return $data;
    }

    public function Posts()
    {
        return $this->belongsToMany('App\Models\Posts', 'news_category', 'id_category', 'id_news');
    }

}
