<?php

namespace App\Repositories\Projects;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Projects\ProjectsRepository;
use App\Entities\Projects\Projects;
use App\Validators\Projects\ProjectsValidator;

/**
 * Class ProjectsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Projects;
 */
class ProjectsRepositoryEloquent extends BaseRepository implements ProjectsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Projects::class;
    }

    public function getProjects()
    {
        $data = $this->model->where(['status'=>1])->get();

        return $data;
    }

    public function getProjectsHot()
    {
        $data = $this->model->where(['status'=>1,'hot'=>1])->get();

        return $data;
    }
    public function getProjectsPage()
    {
        $data = $this->model->where(['status'=>1])->paginate(10);

        return $data;
    }

    public function getProjectsBySlug($slug)
    {
        $data = $this->model->where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();

        return $data;
    }

    public function getProjectsSame($data)
    {
        $id_cate = $data->category->pluck('id')->toArray(); 

        $new_related_id   = \App\Models\ProjectsCategory::whereIn('id_category', $id_cate)->get()->pluck('id_services')->toArray();

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
