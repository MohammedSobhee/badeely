<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Account;
use DB;

class AccountsController extends Controller
{
    public function index()
    {

        Account::setStatuses();

        if (request('priority')) {
            Account::find(request('id'))->update([
                'priority' => request('priority')
            ]);
        }

        $accounts = new Account();

        if (request('name')) {
            $accounts = $accounts->whereHas('translates', function ($q) {
                $q->where('name', 'like', '%' . request('name') . '%');
            });
        }

        if (request('mobile')) {
            $accounts = $accounts->where('mobile', 'like', '%' . request('mobile') . '%');
        }

        if (request('tags')) {
            $accounts = $accounts->where('tags', 'like', '%' . request('tags') . '%');
        }

        if (request('category')) {
            $accounts = $accounts->whereHas('categories', function ($q) {
                $q->where('category_id', request('category'));
            });
        }

        if (request('country')) {
            $accounts = $accounts->where('country_id', request('country'));
        }


        switch (request('filters')) {
            case 'is_featured' :
                $accounts = $accounts->featured();
                break;
            case 'rate' :
                $accounts = $accounts->orderBy('rate', 'desc');
                break;
            case 'clicks' :
                $accounts = $accounts->orderBy('clicks', 'desc');
                break;
            case 'instagram_clicks' :
                $accounts = $accounts->orderBy('instagram_clicks', 'desc');
                break;
            case 'id' :
                $accounts = $accounts->orderBy('id', 'desc');
                break;
            case 'priority' :
                $accounts = $accounts->orderBy('priority');
                break;
            default :
                $accounts = $accounts->latest('id');
                break;
        }

        if (request('status')) {
            $accounts = $accounts->where('status', request('status'));
        }

        $accounts = $accounts->latest();

        /* EXPORT */
        if (request('export')) {
            $collection = Account::accountsTransformer($accounts);
            $this->exportExcel($collection, 'Accounts list');
        }
        /* EXPORT */

        $accounts = $accounts->paginate(15);

        $countries = Country::all();

        $categories = [];
        if (request('country')) {
            $categories = Category::where('parent_id', 0)
                ->whereHas('countries', function ($q) {
                    $q->where('country_id', request('country'));
                })->get();
        }

        return view('admin.accounts.index', [
            'accounts' => $accounts,
            'countries' => $countries,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $countries = Country::all();

        return view('admin.accounts.create', [
            'countries' => $countries,
        ]);
    }

    public function edit($id)
    {
        //badeelyapp@gmail.com
        //badeelyAdmin!2

        $account = Account::find($id);
        $account->seen = 1;
        $account->save();
        $countries = Country::all();

        $categories = Category::where('parent_id', 0)->whereHas('countries', function ($q) use ($account) {
            $q->where('country_id', $account->country_id);
        })->get();

        $parentCategories = $account->categories()->where('parent_id', '<>', 0)->pluck('parent_id')->toArray();

        $subCategories = Category::whereIn('parent_id', $parentCategories)
            ->whereHas('countries', function ($q) use ($account) {
                $q->where('country_id', $account->country_id);
            })->get();

        $accountCategories = $account->categories()
            ->select('id')->pluck('id')->toArray();

        return view('admin.accounts.edit', [
            'account' => $account,
            'categories' => $categories,
            'parentCategories' => $parentCategories,
            'subCategories' => $subCategories,
            'accountCategories' => $accountCategories,
            'countries' => $countries,
        ]);
    }

    public function store()
    {
        $account = new Account();
        $account->mobile = request('mobile');

        $account->phone = request('phone');
        $account->email = request('email');
        $account->account_type = request('account_type');

        $account->facebook_url = request('facebook_url');
        $account->whatsapp = request('whatsapp');
        $account->website_link = request('website_link');
        $account->insta_url = request('insta_url');
        $account->youtube = request('youtube');
        $account->tags = request('tags');
        if ((request()->has('app_tags')))
            $account->app_tags = request('app_tags');
        $account->country_id = request('country');
        $account->status = request('status') ?? 3;
        $account->priority = request('priority') ?? 0;

        $account->started_at = request('started_at') ?
            date('Y-m-d', strtotime(request('started_at'))) : null;

        $account->expire_at = request('expire_at') ?
            date('Y-m-d', strtotime(request('expire_at'))) : null;

        if (request('is_featured')) {
            $account->featured_from = date('Y-m-d', strtotime(request('start')));
            $account->featured_to = date('Y-m-d', strtotime(request('end')));
        }

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

        $account->touchTranslation(request('account_labels'), request('account_names'));

        $account->categories()->attach(request('categories'));

        Account::setStatuses();

        return redirect(route('admin.accounts.index'))->with('success', __('dashboard.added'));
    }

    public function update($id)
    {

        $account = Account::find($id);
        $account->mobile = request('mobile');

        $account->phone = request('phone');
        $account->email = request('email');
        $account->account_type = request('account_type');

        $account->facebook_url = request('facebook_url');
        $account->whatsapp = request('whatsapp');
        $account->website_link = request('website_link');
        $account->insta_url = request('insta_url');
        $account->youtube = request('youtube');
        $account->tags = request('tags');
        if ((request()->has('app_tags')))
            $account->app_tags = implode(',', request('app_tags'));

        $account->category_id = request('category');
        $account->country_id = request('country');
        $account->status = request('status') ?? 3;
        $account->priority = request('priority') ?? 0;

        $account->started_at = request('started_at') ?
            date('Y-m-d', strtotime(request('started_at'))) : null;

        $account->expire_at = request('expire_at') ?
            date('Y-m-d', strtotime(request('expire_at'))) : null;

        if (request('is_featured')) {
            $account->featured_from = date('Y-m-d', strtotime(request('start')));
            $account->featured_to = date('Y-m-d', strtotime(request('end')));
        } else {
            $account->featured_from = null;
            $account->featured_to = null;
        }


        $images = request('old_images') ?? [];
        if (request('images')) {
            foreach (request('images') as $image) {
                $images[] = media()->upload($image, 'accounts', [
                    ['x' => null, 'y' => null, false]
                ]);
            }
        }

        $account->images = json_encode($images);


        $account->save();

        $account->touchTranslation(request('account_labels'), request('account_names'));

        $account->categories()->sync(request('categories'));

//        Account::setStatuses();

        return back()->with('success', __('dashboard.edited'));
    }

    public function destroy($id)
    {
        $account = Account::find($id);

        if (!$account->delete()) {
            return back()->with(['error' => __('dashboard.permission_denied')]);
        }

        return back()->with('success', __('dashboard.deleted'));
    }

}
