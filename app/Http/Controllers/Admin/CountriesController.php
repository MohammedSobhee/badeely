<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        return view('admin.countries.index',[
            'countries' => $countries
        ]);
    }

    public function create()
    {
        return view( 'admin.countries.create' , []);
    }

    public function edit($id)
    {
        $country = Country::find($id);

        return view( 'admin.countries.edit' , [
            'country' => $country
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'code' => 'required',
            'call_key' => 'required',
        ]);

        $country = new Country();
        $country->name = request('name');
        $country->code = request('code');
        $country->call_key = request('call_key');
        $country->is_active = request('is_active') ? 1 : 0;
        $country->save();

        return redirect(route('admin.countries.index'))
            ->with('success',__('dashboard.added'));
    }

    public function update($id)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'code' => 'required',
            'call_key' => 'required',
        ]);

        $country = Country::find($id);
        $country->name = request('name');
        $country->code = request('code');
        $country->call_key = request('call_key');
        $country->is_active = request('is_active') ? 1 : 0;
        $country->save();

        return back()->with('success',__('dashboard.edited'));

    }

    public function destroy( $id )
    {
        $country = Country::find($id);
        $country->delete();

        return back()->with('success',__('dashboard.deleted'));
    }

}
