<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\ProductRepositoryEloquent;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Menu\MenuRepositoryEloquent;
use App\Repositories\General\GeneralRepository;
use App\Repositories\General\GeneralRepositoryEloquent;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryEloquent;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Profile\ProfileRepositoryEloquent;
use App\Repositories\Services\ServicesRepository;
use App\Repositories\Services\ServicesRepositoryEloquent;
use App\Repositories\Posts\PostsRepository;
use App\Repositories\Posts\PostsRepositoryEloquent;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Categories\CategoriesRepositoryEloquent;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Contact\ContactRepositoryEloquent;
use App\Repositories\Projects\ProjectsRepository;
use App\Repositories\Projects\ProjectsRepositoryEloquent;
use App\Repositories\Bds\BdsRepository;
use App\Repositories\Bds\BdsRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepository::class, ProductRepositoryEloquent::class);
        $this->app->bind(MenuRepository::class, MenuRepositoryEloquent::class);
        $this->app->bind(GeneralRepository::class, GeneralRepositoryEloquent::class);
        $this->app->bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        $this->app->bind(ProfileRepository::class, ProfileRepositoryEloquent::class);
        $this->app->bind(ServicesRepository::class, ServicesRepositoryEloquent::class);
        $this->app->bind(PostsRepository::class, PostsRepositoryEloquent::class);
        $this->app->bind(CategoriesRepository::class, CategoriesRepositoryEloquent::class);
        $this->app->bind(ContactRepository::class, ContactRepositoryEloquent::class);
        $this->app->bind(ProjectsRepository::class, ProjectsRepositoryEloquent::class);
        $this->app->bind(BdsRepository::class, BdsRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
