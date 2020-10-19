<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Category;
use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function profile()
    {
        request()->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:admins,email,'.auth('admins')->id(),
            'password' => request('password') ? 'min:6' : '',
        ]);

        if(request('password')){
            request()->offsetSet('password',bcrypt(request('password')));
        }else{
            request()->offsetUnset('password');
        }

        auth('admins')->user()->update(request()->all());

        return back()->with('success',__('dashboard.edited'));
    }

    public function changeLang()
    {
        $local = app()->isLocale('en') ? 'ar' : 'en';

//        $minutes = 43800;
//        $response = new Response('Set Cookie');
//        $response->withCookie(cookie('lang', $local, $minutes));

        setcookie('lang',$local, time() + (86400 * 86400), "/");

        return back();
    }

    public function categoriesAjax()
    {
        return Category::where('parent_id',0)
                       ->whereHas('countries',function ($q){
                           $q->where('country_id',request('country'));
                        })->select('id')->get();
    }

    public function subCategoriesAjax()
    {
        $categories = request('categories') ?? [];
        $oldSelected = request('old_selected') ?? [];

        return Category::whereIn('parent_id',$categories)
            ->whereHas('countries',function ($q){
                $q->where('country_id',request('country'));
            })->get()->map(function ($item) use($oldSelected){
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'parent_id' => $item->parent->id ?? '',
                    'parent_name' => $item->parent->name ?? '',
                    'selected' => in_array($item->id, $oldSelected)
                ];
            });
    }

    public function subCategoriesByCountryAjax()
    {
        return Category::where('parent_id','<>',0)
            ->whereHas('countries',function ($q){
                $q->where('country_id',request('country'));
            })->select('id')->get();
    }

    public function dashboardStatistics()
    {
        $countryId = request('country_id');

        $data = [

            'active_accounts' => $countryId ?
                Account::published()->where('country_id',$countryId)->count() :
                Account::published()->count(),

            'inactive_accounts' => $countryId ?
                Account::where('status',2)->where('country_id',$countryId)->count() :
                Account::where('status',2)->count(),

            'active_users' => $countryId ?
                User::where('is_confirmed',1)->where('country_id',$countryId)->count() :
                User::where('is_confirmed',1)->count(),

            'inactive_users' => $countryId ?
                User::where('is_confirmed',0)->where('country_id',$countryId)->count() :
                User::where('is_confirmed',0)->count(),

            'featured_accounts' => $countryId ?
                Account::featured()->where('country_id',$countryId)->count() :
                Account::featured()->count(),

            'total_clicks' => $countryId ?
                Account::where('country_id',$countryId)->sum('views') :
                Account::sum('views'),

            'total_votes' => $countryId ?
                Account::where('country_id',$countryId)->sum('rate') :
                Account::sum('rate'),

            'categories' => $countryId ? Category::whereHas('countries',function ($q) use($countryId){
                            $q->where('country_id',$countryId);
                    })->where('parent_id',0)->count() : Category::where('parent_id',0)->count(),
        ];

        return view('admin.statistics',[
            'data' => $data
        ]);
    }

}
