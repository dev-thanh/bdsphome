<?php

namespace App\Repositories\Menu;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Menu\MenuRepository;
use App\Entities\Menu\Menu;
use App\Validators\Menu\MenuValidator;
use App\Models\Menu as Menus;

/**
 * Class MenuRepositoryEloquent.
 *
 * @package namespace App\Repositories\Menu;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menus::class;
    }

    public function getMenuHeader()
    {
        $data = $this->model->where('id_group', 1)->orderBy('position')->get();

        return $data;
    }

    public function getMenuFooter()
    {
        $data = $this->model->where('id_group', 2)->orderBy('position')->get();

        return $data;
    }

    public function getMenuFooter2()
    {
        $data = $this->model->where('id_group', 3)->orderBy('position')->get();

        return $data;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
