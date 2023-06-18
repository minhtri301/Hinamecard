<?php

namespace App\Repositories\PagesSub;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PagesSub\PagesSubRepository;
use App\Entities\PagesSub\PagesSub;
use App\Models\Settings;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Request;
use App\Validators\PagesSub\PagesSubValidator;
use Illuminate\Support\Facades\Auth;

/**
 * Class PagesSubRepositoryEloquent.
 *
 * @package namespace App\Repositories\PagesSub;
 */
class PagesSubRepositoryEloquent extends BaseRepository implements PagesSubRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Settings::class;
    }

    public function getSiteInfo()
    {
        $site_info = \App\Models\Settings::where('type', 'general')->first();

        return $site_info;
    }

    public function seoGeneral()
    {
        $data = $this->getSiteInfo();

        if ($data) {
            $site_info = json_decode($data->content);
            OpenGraph::setUrl(URL::current());
            OpenGraph::addProperty('locale', 'vi_VN');
            OpenGraph::addProperty('type', 'website');
            OpenGraph::addProperty('author', $site_info->company);
            SEOMeta::addKeyword($site_info->site_keyword);

            view()->share(compact('site_info'));
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createSeo($dataSeo = null)
    {
        $data = $this->getSiteInfo();

        $site_info = json_decode($data->content);
        $site_title = (!empty(Auth::guard('customer')->user()->name) ? Auth::guard('customer')->user()->name.' | ' : null) .$site_info->site_title;
        if (!empty($dataSeo->meta_title)) {
            SEOMeta::setTitle(($dataSeo->meta_title.' | '. $site_info->site_title));
            OpenGraph::setTitle(($dataSeo->meta_title.' | '. $site_info->site_title));
            TwitterCard::setTitle(($dataSeo->meta_title.' | '. $site_info->site_title));
            JsonLd::setTitle(($dataSeo->meta_title.' | '. $site_info->site_title));
        } else {
            SEOMeta::setTitle($site_title);
            OpenGraph::setTitle($site_title);
            TwitterCard::setTitle($site_title);
            JsonLd::setTitle($site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
            JsonLd::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
            JsonLd::setDescription($site_info->site_description);
        }

        if (!empty($dataSeo->image)) {
            OpenGraph::addImage(url('').$dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage(url('').$site_info->favicon, ['height' => 400, 'width' => 400]);
        }

        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }
    
}
