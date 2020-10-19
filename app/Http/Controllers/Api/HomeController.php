<?php

namespace App\Http\Controllers\Api;

use App\Api\Controller;
use App\Country;
use App\Http\Transformer\AccountsTransformer;
use App\Account;
use App\Setting;
use App\TopLevelView;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
       // $date = Carbon::today()->subDays(config('settings.latest_accounts_last_days'));

        $accounts = Account::published()
            ->where('country_id',config('country'));
          // ->where('created_at', '>=', $date);

//        dd($accounts);
        if(request('name')){
            $accounts = $accounts->whereHas('translates', function ($q) {
                $q->where('name', 'like', '%' . request('name') . '%');
            });
        }

        if(request('filter')){

            switch (request('filter')){
                case 'featured' :
                    $accounts = $accounts->featured();
                    break;
                case 'top' :
                    $accounts = $accounts->orderBy('views','desc');
                    break;
                case 'new' :
                    $accounts = $accounts->latest();
                    break;
                default :
                    $accounts = $accounts->latest();
                    break;
            }

        }

        $accounts = $accounts->orderBy('priority')->paginate(config('settings.accounts_in_page'));

        $data = $this->transformer(new AccountsTransformer(),$accounts)->collection();

        return $this->success($data)
            ->pagination($accounts);
    }

    public function countries()
    {
        $countries = Country::where('is_active',1)->get();
        return $this->success($countries)->data();
    }

    public function configs()
    {
        $settings = Setting::pluck('value','key');


        $settings['website_description'] = $settings['website_description_'.app()->getLocale()];
        unset($settings['website_description_ar']);
        unset($settings['website_description_en']);


        unset($settings['accounts_in_page']);
        unset($settings['latest_accounts_last_days']);

        return $this->success($settings)->data();
    }

    public function topLevelClick()
    {
        $this->validator([
//            'target' => 'required|in:featured,top,new',
            'target' => 'required|in:featured,new',
        ]);

        TopLevelView::create([
            'user_id' => $this->user()->id,
            'target' => request('target')
        ]);

        return $this->success()->custom('category_has_been_clicked');
    }
}