<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Category;
use App\CategoryCountry;
use App\CategoryView;
use App\Country;
use App\Http\Controllers\Controller;
use App\Rate;
use App\TopLevelView;
use App\View;

class ReportsController extends Controller
{
    public function categoriesVisits()
    {
        $categories = Category::where('parent_id', 0)->orderBy('sort')->with('children');

        $views = new CategoryView;
        if (request('from') && request('to')) {
            $views = $views->whereBetween('created_at', [request('from'), request('to')]);
        }
        if (request('country_id')) {

            //Question
            $category_id = CategoryCountry::where('country_id', request('country_id'))->pluck('category_id');
            $categories = Category::where('parent_id', 0)->orderBy('sort')->with(['children' => function ($query) use ($category_id) {
                $query->whereIn('id', $category_id);
            }]);

        }

//        if(request('sort')){
        //  dd(request('sort'));
//        }

        $count = $views->count();

        $countries = Country::where('is_active', 1)->get();
        return view('admin.reports.categories_visits', [
            'categories' => $categories->get(),
            'countries' => $countries,
            'count' => $count,
        ]);
    }

    public function featuredVisits()
    {
        $accounts = Account::where('is_featured_before', 1)->get();

        $views = new View;
        if (request('from') && request('to')) {
            $views = $views->whereBetween('created_at', [request('from'), request('to')]);
        }

        $count = $views->whereHas('account', function ($q) {
            $q->where('is_featured_before', 1);
        })->count();

        return view('admin.reports.featured_visits', [
            'accounts' => $accounts,
            'count' => $count,
        ]);
    }

    public function voteReport()
    {
        $accounts = Account::latest('rate');

        $rates = new Rate;
        if (request('from') && request('to')) {
            $rates = $rates->whereBetween('created_at', [request('from'), request('to')]);
        }

        if (request('country_id')) {

            //Question
            $accounts = $accounts->where('country_id', request('country_id'));

        }
        $count = $rates->count();
        $accounts = $accounts->with('country')->paginate(30);
        $countries = Country::where('is_active', 1)->get();

        return view('admin.reports.vote_report', [
            'accounts' => $accounts,
            'countries' => $countries,
            'count' => $count,
        ]);
    }

    public function clicksReport()
    {
        $accounts = new Account();

        switch (request('filters')) {
            case 'is_featured' :
                $accounts = $accounts->featured();
                break;
            case 'rate' :
                $accounts = $accounts->orderBy('rate', 'desc');
                break;
            case 'id' :
                $accounts = $accounts->orderBy('id', 'desc');
                break;
            default :
                $accounts = $accounts->latest('id');
                break;
        }


        $clicks = new View;
        if (request('from') && request('to')) {
            $clicks = $clicks->whereBetween('created_at', [request('from'), request('to')]);
        }

        if (request('country_id')) {

            //Question
            $accounts = $accounts->where('country_id', request('country_id'));

        }
        $accounts = $accounts->with('country')->paginate(30);


        $count = $clicks->count();
        $countries = Country::where('is_active', 1)->get();

        return view('admin.reports.clicks_report', [
            'accounts' => $accounts,
            'countries' => $countries,
            'count' => $count,
        ]);
    }

    public function topLevelClicks()
    {
        $views = new TopLevelView();

        if (request('target')) {
            $views = $views->where('target', request('target'));
        }

        if (request('from') && request('to')) {
            $views = $views->whereBetween('created_at', [request('from'), request('to')]);
        }

        $views = $views->latest()->paginate(30);

        return view('admin.reports.top_level_clicks', [
            'views' => $views,
        ]);
    }
}
