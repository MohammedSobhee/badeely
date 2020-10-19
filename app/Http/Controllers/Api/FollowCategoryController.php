<?php

namespace App\Http\Controllers\Api;

use App\Api\Controller;
use App\Category;
use App\CategoryFollow;
use App\Http\Requests\AddFollowRequest;
use App\Http\Transformer\AccountsTransformer;
use App\Http\Transformer\CategoriesTransformer;
use App\Rate;
use App\Account;
use App\SearchHistory;
use App\View;

class FollowCategoryController extends Controller
{
    public function addFollow(AddFollowRequest $request)
    {

        $follow = CategoryFollow::where('category_id', $request->get('category_id'))->where('user_id', $this->user()->id)->first();

        if (!isset($follow)) {
            $follow = new CategoryFollow();
            $follow->user_id = $this->user()->id;
            $follow->category_id = $request->get('category_id');
            $follow->save();

            $categories = Category::where('parent_id', 0)->find($follow->category_id);

            $categories = $this->transformer(new CategoriesTransformer(), $categories)->one();
//            $data = [
//                'items' => $categories,
//            ];
//            $account = $this->transformer(new AccountsTransformer(), $follow)->one();
            return $this->success($categories)
                ->data('collection_has_been_followed');

        } else {
            {
                $follow->delete();

                $categories = Category::where('parent_id', 0)->find($follow->category_id);

                $categories = $this->transformer(new CategoriesTransformer(), $categories)->one();
                return $this->success($categories)
                    ->data('collection_has_been_unfollowed');
            }

        }


    }

    public function getFollows()
    {
        $cats = CategoryFollow::where('user_id', $this->user()->id)->pluck('category_id');

        $categories = Category::where('parent_id', 0)->whereIn('id', $cats)->orderBy('sort')->get();

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
}