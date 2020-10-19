<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Excel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function exportExcel($collection, $title)
    {
        Excel::create($title, function($excel) use ($collection,$title){

            // Set the spreadsheet title, creator, and description
            $excel->setTitle(config('settings.website_name') . ' , ' .$title);
            $excel->setCreator(config('settings.website_name'))->setCompany(config('settings.website_name').', CO');
            $excel->setDescription($title);

            // Build the spreadsheet, passing in the payments array
            $excel->sheet($title, function($sheet) use ($collection) {

                if(app()->isLocale('ar')){
                    $sheet->setRightToLeft(true);
                }

                $sheet->fromArray($collection);

            });

        })->download('xlsx');

    }

}
