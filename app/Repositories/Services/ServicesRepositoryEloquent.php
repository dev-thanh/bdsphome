<?php

namespace App\Repositories\Services;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Services\ServicesRepository;
use App\Entities\Services\Services;
use App\Validators\Services\ServicesValidator;

/**
 * Class ServicesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Services;
 */
class ServicesRepositoryEloquent extends BaseRepository implements ServicesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Services::class;
    }

    public function getServices()
    {
        $data = $this->model->get();

        return $data;
    }

    public function getServicesPage()
    {
        $data = $this->model->where(['status'=>1])->paginate(10);

        return $data;
    }

    public function getServicesBySlug($slug)
    {
        $data = $this->model->where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();

        return $data;
    }

    public function getServicesSame($data)
    {
        $id_cate = $data->category->pluck('id')->toArray(); 

        $new_related_id   = \App\Models\ServicesCategory::whereIn('id_category', $id_cate)->get()->pluck('id_services')->toArray();

        $new_same_category  = $this->model->where('id', '!=', $data->id)->where('status', 1)
                                ->whereIn('id', $new_related_id)->orderBy('created_at', 'DESC')->get();

        return $new_same_category;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
