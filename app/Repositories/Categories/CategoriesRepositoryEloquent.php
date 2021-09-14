<?php

namespace App\Repositories\Categories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Categories\CategoriesRepository;
use App\Entities\Categories\Categories;
use App\Validators\Categories\CategoriesValidator;

/**
 * Class CategoriesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Categories;
 */
class CategoriesRepositoryEloquent extends BaseRepository implements CategoriesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Categories::class;
    }

    public function getParentCate($type)
    {
        
        $data  = $this->model->where([
            'type' => $type,
            'parent_id' => 0,
        ])->get();

        return $data;
    }

    public function getChildCate($type,$id)
    {
        $data  = $this->model->where([
            'type' => $type,
            'parent_id' => $id,
        ])->get();

        return $data;
    }

    public function getCate($type)
    {
        $data  = $this->model->where([
            'type' => $type
        ])->get();

        return $data;
    }

    public function getCateServices()
    {
        $data  = $this->model->where([
            'type' => 'service_category',
            'show_home' => 1
        ])->get();

        return $data;
    }

    public function getImageSlide()
    {
        return \App\Models\Image::where('status', 1)->where('type', 'slider')->get();
        
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
