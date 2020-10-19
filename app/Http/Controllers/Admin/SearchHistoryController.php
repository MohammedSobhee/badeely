<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SearchHistory;

class SearchHistoryController extends Controller
{
    public function index()
    {
        $histories = SearchHistory::latest()->paginate(20);
        return view('admin.search_history.index',[
            'histories' => $histories
        ]);
    }

}
