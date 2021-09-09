<?php

namespace App\Entities\Posts;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Posts.
 *
 * @package namespace App\Entities\Posts;
 */
class Posts extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'news_category', 'id_news', 'id_category');
    }

}
