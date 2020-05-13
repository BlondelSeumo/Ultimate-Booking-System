<?php
namespace Modules\News\Controllers;

use Illuminate\Http\Request;
use Modules\FrontendController;
use Modules\News\Models\News;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;

class NewsController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $model_News = News::query();
        $model_News->where("status", "publish")->orderBy('id', 'desc');
        if (!empty($search = $request->input("s"))) {
            $model_News->where(function($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%');
                $query->orWhere('content', 'LIKE', '%' . $search . '%');
            });
            $title_page = __('Search results : ":s"', ["s" => $search]);
        }
        $data = [
            'rows'              => $model_News->with("getAuthor")->with("getCategory")->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'custom_title_page' => $title_page ?? "",
            'breadcrumbs'       => [
                [
                    'name'  => __('News'),
                    'url'   => url(config('news.news_route_prefix')),
                    'class' => 'active'
                ],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index', $data);
    }

    public function detail(Request $request, $slug)
    {
        $row = News::where('slug', $slug)->where('status','publish')->first();
        if (empty($row)) {
            return redirect('/');
        }

        $data = [
            'row'               => $row,
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'custom_title_page' => $title_page ?? "",
            'breadcrumbs'       => [
                [
                    'name' => __('News'),
                    'url'  => url(config('news.news_route_prefix'))
                ],
                [
                    'name'  => $row->title,
                    'class' => 'active'
                ],
            ],
            'seo_meta'  => $row->getSeoMeta(),
        ];
        $this->setActiveMenu($row);
        return view('News::frontend.detail', $data);
    }
}
