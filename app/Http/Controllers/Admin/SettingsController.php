<?php

namespace App\Http\Controllers\Admin;

use App\FeatureCategory;
use App\Http\Controllers\Controller;
use App\Setting;
use Cache;

class SettingsController extends Controller
{
    public function get()
    {
        return view('admin.settings.index', [
            'settings' => (object)config('settings')
        ]);
    }

    public function post()
    {
        $settings = config('settings');

        if (request()->hasFile('featured_img')) {

            $img = request()->file('featured_img');
            $img->move(base_path('assets'), 'featured_img.png');

        }

        if (request('cancel_reasons')) {
            request()->merge([
                'cancel_reasons' => json_encode(request('cancel_reasons'))
            ]);
        }

        foreach (request()->all() as $key => $value) {
            if (isset($settings[$key])) {
                Setting::where('key', $key)->update(['value' => $value]);
            }
        }

        $feature_cat = FeatureCategory::where('name', 'LIKE', '%' . request('featured_title_en') . '%')->first();

        if (!isset($feature_cat)) {
            FeatureCategory::create(['name' => request('featured_title_en')]);
        }
        Cache::forget('settings');

        return back()->with('success', __('dashboard.edited'));
    }

}
