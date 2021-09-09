<?php

namespace App\Repositories\Posts;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Posts\PostsRepository;
use App\Entities\Posts\Posts;
use App\Validators\Posts\PostsValidator;

/**
 * Class PostsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Posts;
 */
class PostsRepositoryEloquent extends BaseRepository implements PostsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Posts::class;
    }

    public function getPostsHome()
    {
        $data = $this->model->where(['status'=>1,'hot'=>1])->get();

        return $data;
    }

    public function getPostsPage()
    {
        $data = $this->model->where(['status'=>1])->paginate(10);

        return $data;
    }

    public function getPostBySlug($slug)
    {
        $data = $this->model->where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();

        return $data;
    }

    public function getPostsSame($data)
    {
        $id_cate = $data->category->pluck('id')->toArray(); 

        $new_related_id   = \App\Models\NewsCategory::whereIn('id_category', $id_cate)->get()->pluck('id_news')->toArray();

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
