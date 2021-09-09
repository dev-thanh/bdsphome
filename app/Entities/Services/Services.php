<?php

namespace App\Entities\Services;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Services.
 *
 * @package namespace App\Entities\Services;
 */
class Services extends Model implements Transformable
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
        return $this->belongsToMany('App\Models\Categories', 'services_category', 'id_services', 'id_category');
    }
}
