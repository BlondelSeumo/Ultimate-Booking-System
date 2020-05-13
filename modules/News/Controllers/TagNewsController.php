<?php
namespace Modules\News\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\FrontendController;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\News\Models\News;
use Modules\News\Models\NewsTag;

class TagNewsController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        if (empty($tag)) {
            return redirect('/news');
        }
        $listNews = News::query();
        $listNews->join('core_news_tag', 'core_news_tag.news_id', '=', 'core_news.id')
            ->where('core_news_tag.tag_id', $tag->id)
            ->with("getAuthor")->with("getCategory");
        $data = [
            'rows'           => $listNews->paginate(5),
            'model_category' => NewsCategory::where("status", "publish"),
            'model_tag'      => Tag::query(),
            'model_news'     => News::where("status", "publish"),
            'breadcrumbs'    => [
                [
                    'name' => __('News'),
                    'url'  => url("/news")
                ],
                [
                    'name'  => $tag->name,
                    'class' => 'active'
                ],
            ],
            'seo_meta'  => $tag->getSeoMeta(),
        ];
        return view('News::frontend.index', $data);
    }
}