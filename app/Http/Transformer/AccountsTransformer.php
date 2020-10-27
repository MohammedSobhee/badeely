<?php

namespace App\Http\Transformer;

use App\Api\Transformer\Transformer;

class AccountsTransformer extends Transformer
{
    public function get($item)
    {
        $subCategories = [];
        $category = [];

        foreach ($item->categories()->where('parent_id', 0)->get() as $cat) {
            $category[] = [
                'id' => $cat->id ?? 0,
                'name' => $cat->name ?? __('inputs.undefined')
            ];
        }

        foreach ($item->categories()->where('parent_id', '<>', 0)->get() as $cat) {
            $subCategories[] = [
                'id' => $cat->id ?? 0,
                'name' => $cat->name ?? __('inputs.undefined')
            ];
        }

        return [
            'id' => $item->id,
            'name' => $item->name,
            'account_name' => $item->description,
            'mobile' => $item->mobile,
            'email' => $item->email,
            'images' => $item->gallery(),
            'remaining_days' => $item->remainingDays(),

            'views' => $item->views,
            'votes' => $item->rate,

            'user_is_view' => $item->isViewed(),
            'user_is_vote' => $item->isVoted(),

            'instagram_username' => instagramUsername($item->insta_url),
            'instagram_url' => $item->insta_url,
            'facebook_url' => $item->facebook_url,
            'whatsapp' => $item->whatsapp,
            'youtube' => $item->youtube,
            'link' => $item->website_link,

            'tags' => $item->app_tags ?? '',
            'tags_list' => explode(',', $item->app_tags) ?? '',

            'created_at' => strtotime($item->created_at),

//            'user' => $this->includeOne(new Profile(),$item->user),

            'sub_category' => $subCategories,

            'category' => $category,
            'category_name' => count($category) > 0 ? $category[0]['name'] : null,

            'country' => [
                'id' => $item->country->id ?? 0,
                'code' => $item->country->code ?? '',
                'name' => $item->country->name ?? ''
            ],

            'is_featured' => $item->isFeature(),

        ];

    }
}