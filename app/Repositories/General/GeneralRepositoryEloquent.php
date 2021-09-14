<?php

namespace App\Repositories\General;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\General\GeneralRepository;
use App\Repositories\Menu\MenuRepository;
use App\Entities\General\General;
use App\Validators\General\GeneralValidator;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Menu as GeneralModel;

/**
 * Class GeneralRepositoryEloquent.
 *
 * @package namespace App\Repositories\General;
 */
class GeneralRepositoryEloquent extends BaseRepository implements GeneralRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    private $menu,$site_info;

    function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
        $this->site_info = \App\Models\Options::where('type', 'general')->first();
    }

    public function model()
    {
        return GeneralModel::class;
    }

    /* Using seo */

    public function seoGeneral()
    {
        $site_info = $this->site_info;

        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $site_info = $site_info;
            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');
            SEOMeta::addKeyword($site_info->site_keyword);

            $menuHeader = $this->menu->getMenuHeader();

            $menuFooter = $this->menu->getMenuFooter();

            view()->share(compact('site_info', 'menuHeader', 'menuFooter'));

        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->site_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        $site_info = $this->site_info;

        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
