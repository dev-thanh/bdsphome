<?php

namespace App\Entities\Projects;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Projects.
 *
 * @package namespace App\Entities\Projects;
 */
class Projects extends Model implements Transformable
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
        return $this->belongsToMany('App\Models\Categories', 'projects_category', 'id_projects', 'id_category');
    }

    public function getCompany($id)
    {
        return \App\Models\Company::find($id);
    }
}
