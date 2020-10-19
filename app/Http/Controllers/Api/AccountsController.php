<?php

namespace App\Http\Controllers\Api;

use App\Api\Controller;
use App\Http\Transformer\AccountsTransformer;
use App\Rate;
use App\Account;
use App\SearchHistory;
use App\View;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {

//        dd(config('country'));
        $accounts = Account::published()->where('country_id', config('country'));

        if (request('name')) {

            $searchValues = explode(' ', request('name'));

            $accounts = $accounts->whereHas('translates', function ($q) {
                $q->where('name', 'like', '%' . request('name') . '%');
            })->orWhere(function ($query) use ($searchValues) {

                foreach ($searchValues as $key => $value) {
                    // first key == 0
                    if (!$key) {
                        $query->where('app_tags', 'like', "%{$value}%");
                    }
                    $query->orWhere('app_tags', 'like', "%{$value}%");
                }

            });

            // ->orWhere('tags', 'like', '%' . request('name') . '%');

            try {
                $user = api()->user() ?? null;
            } catch (\Exception $ex) {
                $user = null;
            }

            //store in search history
            SearchHistory::create([
                'search' => request('name'),
                'user_id' => optional($user)->id,
                'ip' => get_client_ip()
            ]);

        }

//        if(request('tag')){
//
//            $searchValues =  explode(' ',request('tag'));
//
//            $accounts = $accounts->where(function ($query) use($searchValues){
//
//                foreach ($searchValues as $key => $value) {
//
//                    // first key == 0
//                    if(!$key){
//                        $query->where('tags', 'like', "%{$value}%");
//                    }
//
//                    $query->orWhere('tags', 'like', "%{$value}%");
//                }
//
//            });

//            $accounts = $accounts->where('tags', 'like', '%' . request('tag') . '%');
//        }

        if (request('category_id')) {

            $accounts = $accounts->whereHas('categories', function ($q) {
                if (request('sub_category_id')) {
                    $q->where('category_id', request('sub_category_id'));
                }
                if (request('category_id')) {
                    $q->where('category_id', request('category_id'));
                }
            });

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

    public function store()
    {
        $this->validator([
            'mobile' => 'required',
            'category_id' => 'required',
        ]);

        $account = new Account();
        $account->mobile = request('mobile');

        $account->phone = request('phone');
        $account->email = request('email');
        $account->account_type = request('account_type');

        $account->insta_url = request('insta_url');
        $account->facebook_url = request('facebook_url');
        $account->whatsapp = request('whatsapp');
        $account->website_link = request('website_link');
        $account->youtube = request('youtube');
//        $account->category_id = request('category_id');
        $account->country_id = config('country');

        $account->user_id = $this->user()->id;

        $account->seen = 0;
        $account->status = 3;

        $images = [];
        if (request('images')) {

            foreach (request('images') as $image) {
                $images[] = media()->upload($image, 'accounts', [
                    ['x' => null, 'y' => null, false]
                ]);
            }

            $account->images = json_encode($images);
        }

        $account->save();

        $labels = [
            'en' => request('name_en'),
            'ar' => request('name_ar'),
        ];

        $accountNames = [
            'en' => request('account_name_en'),
            'ar' => request('account_name_ar'),
        ];

        $account->touchTranslation($labels, $accountNames);

        $account->categories()->attach([request('category_id')]);

        $account = $this->transformer(new AccountsTransformer(), $account)->one();

        return $this->success($account)
            ->created('successfully_sent');

    }

    public function vote($id)
    {
        $this->validator([
//            'vote' => 'required|numeric|min:1',
//            'comment' => 'required',
        ]);


        $account = Account::published()->find($id);

        if (!$account) {
            return $this->error()->NotFound();
        }

        $rate = Rate::where('user_id', $this->user()->id)
            ->where('account_id', $id)->first();

        if (!$rate) {
            Rate::create([
                'user_id' => $this->user()->id,
                'account_id' => $id,
                'rate' => 1
            ]);
        } else {
            $rate->delete();
        }

        $account->rate = $account->votes()->count();
        $account->save();


        $account = $this->transformer(new AccountsTransformer(), $account)->one();

        return $this->success($account)
            ->data('account_has_been_voted');

    }

    public function addView($id)
    {
        $account = Account::published()->find($id);

        if (!$account) {
            return $this->error()->NotFound();
        }

        $view = View::where('user_id', $this->user()->id)
            ->where('account_id', $id)->first();

        if (!isset($view))
            View::create([
                'user_id' => $this->user()->id,
                'account_id' => $id
            ]);

        $account->views = $account->views()->count();
        $account->save();

//        $account = $this->transformer(new AccountsTransformer(),$account)->one();

//        return $this->success($account)
//            ->data('account_has_been_clicked');

        return $this->success()->custom('account_has_been_clicked');

    }

    public function getAccountsByTag(Request $request)
    {

        $accounts = Account::where('tags', 'LIKE', '%' . $request->get('tag') . '%')->where('status',1)->paginate(20);
        $data = $this->transformer(new AccountsTransformer(), $accounts)->collection();

        return $this->success($data)
            ->pagination($accounts);
    }
//    public function click($id)
//    {
//        $account = Account::published()->find($id);
//
//        if(!$account){
//            return $this->error()->NotFound();
//        }
//
//        if(!$account){
//            return $this->error()->NotFound();
//        }
//
//        //sync id
//        $account->clicks()->sync($this->user()->id);
//
//        $account->clicks = $account->clicks()->count();
//        $account->save();
//
//        $account = $this->transformer(new AccountsTransformer(),$account)->one();
//
//        return $this->success($account)
//            ->data();
//    }


//    public function instagramClick($id)
//    {
//        $account = Account::published()->find($id);
//
//        if(!$account){
//            return $this->error()->NotFound();
//        }
//
//        if(!$account){
//            return $this->error()->NotFound();
//        }
//
//        //sync id
//        $account->instagramClicks()->sync($this->user()->id);
//
//        $account->instagram_clicks = $account->instagramClicks()->count();
//        $account->save();
//
//        $account = $this->transformer(new AccountsTransformer(),$account)->one();
//
//        return $this->success($account)
//            ->data('account_has_been_voted');
//
//
//    }

}