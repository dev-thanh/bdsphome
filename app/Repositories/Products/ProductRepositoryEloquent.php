<?php

namespace App\Repositories\Products;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Products\ProductRepository;
use App\Entities\Products\Product;
use App\Validators\Products\ProductValidator;
use App\Models\Products as Products;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories\Products;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function model()
    {
        return Products::class;
    }

    public function getProducts()
    {
        return $this->model->first();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
