<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0);

        if (request('name')) {
            $categories = $categories->whereHas('translates', function ($q) {
                $q->where('name', 'like', '%' . request('name') . '%');
            });

        }

        if (request('country')) {
            $categories = $categories->whereHas('countries', function ($q) {
                $q->where('country_id', request('country'));
            });
        }


        $categories = $categories->orderBy('sort')->with('children')->get();

        if (request()->has('items_sort')) {
            $sort = array_filter(explode(',', request('items_sort')));
            Category::sort($sort);
        }

        $countries = Country::all();

        return view('admin.categories.index', [
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        $countries = Country::all();

        return view('admin.categories.create', [
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    public function edit(Category $category)
    {
        $categories = Category::where('parent_id', 0)
            ->where('id', '<>', $category->id)->get();

        $countries = Country::all();
        $categoryCountry = $category->countries()->select('id')
            ->pluck('id')->toArray();

        return view('admin.categories.edit', [
            'categories' => $categories,
            'category' => $category,

            'countries' => $countries,
            'categoryCountry' => $categoryCountry,
        ]);
    }

    public function store()
    {

        $data = request()->validate([
            'parent_id' => '',
            'image' => 'image',
        ]);

        if (request('image')) {
            $data['image'] = media()->upload(request()->file('image'), 'categories', [
                ['x' => null, 'y' => null, false],
            ]);
        }

        $data['status'] = request()->has('status') ?: 0;


        $category = Category::create($data);
        $category->touchTranslation(request('category_labels'));

        $category->countries()->attach(request('countries'));

        return redirect(route('admin.categories.index'))->with('success', __('dashboard.added'));
    }

    public function update(Category $category)
    {

        $data = request()->validate([
            'parent_id' => '',
            'image' => 'image',
        ]);

        if (request('image')) {
            $data['image'] = media()->upload(request()->file('image'), 'categories', [
                ['x' => null, 'y' => null, false],
            ]);
        }

        $data['status'] = request()->has('status') ?: 0;

        $category->update($data);
        $category->touchTranslation(request('category_labels'));

        $category->countries()->sync(request('countries'));

        return back()->with('success', __('dashboard.edited'));
    }

    public function destroy(Category $category)
    {
        if (!$category->delete()) {
            return back()->with(['error' => 'permission denied !!']);
        }

        return back()->with('success', __('dashboard.deleted'));
    }

}
