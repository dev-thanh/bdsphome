<?php

namespace App\Entities\Categories;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Categories.
 *
 * @package namespace App\Entities\Categories;
 */
class Categories extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function Posts()
    {
        return $this->belongsToMany('App\Models\Posts', 'news_category', 'id_category', 'id_news');
    }

    public function Services()
    {
        return $this->belongsToMany('App\Models\Services', 'services_category', 'id_category', 'id_services');
    }

}
