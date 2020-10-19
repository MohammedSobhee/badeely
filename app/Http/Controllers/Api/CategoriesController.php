<?php

namespace App\Http\Controllers\Api;

use App\Api\Controller;
use App\Category;
use App\CategoryView;
use App\FeatureCategory;
use App\Http\Transformer\CategoriesTransformer;
use App\Http\Transformer\AccountsTransformer;
use App\Account;
use App\ViewFeatureCategory;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->orderBy('sort')
            ->whereHas('countries', function ($q) {
                $q->where('id', config('country'));
            })->where('status', 1)->get();

        $categories = $this->transformer(new CategoriesTransformer(), $categories)->collection();

        $data = [
            'items' => $categories,
            'featured' => [
                'title' => config('settings.featured_title_' . app()->getLocale()),
                'image' => url('/assets/featured_img.png') . '?time=' . time(),
            ],
        ];

        return $this->success($data)->data();
    }

    public function show($id)
    {
        $categories = Category::where('parent_id', $id)->get();
        $categories = $this->transformer(new CategoriesTransformer(), $categories)->collection();

        return $this->success($categories)->data();
    }

    public function accounts($id)
    {
        $category = Category::find($id);

        $accounts = Account::published()->where('country_id', config('country'));

        $accounts = $accounts->whereHas('categories', function ($q) use ($category) {
            $q->where('category_id', $category->id);
        });

        if (request('name')) {
            $accounts = $accounts->whereHas('translates', function ($q) {
                $q->where('name', 'like', '%' . request('name') . '%');
            });
        }

        if (request('tag')) {
            $accounts = $accounts->where('tags', 'like', '%' . request('tag') . '%');
        }

        if (request('sort_by')) {
            $accounts = $accounts->sortBy(request('sort_by'));
        }

        $accounts = $accounts->orderBy('priority')->paginate(20);

        $accounts->sortBy(function ($q) {
            return $q->isFeature();
        });

        $data = $this->transformer(new AccountsTransformer(), $accounts)->collection();

        return $this->success($data)
            ->pagination($accounts);

    }

    public function addClick($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->error()->NotFound();
        }
//        'user_id' => $this->user()->id,
//            'category_id' => $id
        $cv = new CategoryView();
        $cv->user_id = $this->user()->id;
        $cv->category_id = $id;
        $cv->save();
        return $this->success()->custom('category_has_been_clicked');

//        $category = $this->transformer(new CategoriesTransformer(),$category)->one();

//        return $this->success($category)
//            ->data('category_has_been_clicked');
    }

    public function addView()
    {
        $featureCategory = FeatureCategory::where('name', request('name'))->first();

        if (!$featureCategory) {
            return $this->error()->NotFound();
        }

        $view = ViewFeatureCategory::where('user_id', $this->user()->id)
            ->where('feature_id', $featureCategory->id)->first();

        if (!isset($view))
            ViewFeatureCategory::create([
                'user_id' => $this->user()->id,
                'feature_id' => $featureCategory->id
            ]);

        $featureCategory->views = $featureCategory->views()->count();
        $featureCategory->save();

//        $account = $this->transformer(new AccountsTransformer(),$account)->one();

//        return $this->success($account)
//            ->data('account_has_been_clicked');

        return $this->success()->custom('account_has_been_clicked');

    }

}