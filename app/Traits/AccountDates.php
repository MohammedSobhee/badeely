<?php

namespace App\Traits;

use Carbon\Carbon;

trait AccountDates
{
    public static function dateInRange()
    {
        return

            // for started_at and expire_at date
            self::where('started_at','<',Carbon::now())
                ->where('expire_at','>',Carbon::now())

                // for expire_at date and not started date
                ->orWhere(function ($q){
                    $q->where('expire_at','>',Carbon::now())
                        ->whereNull('started_at');
                })

                // for started_at and not expire date
                ->orWhere(function ($q){
                    $q->where('started_at','<',Carbon::now())
                        ->whereNull('expire_at');
                })

                // for started_at and not expire date
                ->orWhere(function ($q){
                    $q->whereNull('started_at')
                        ->whereNull('expire_at');
                });
    }

    public static function dateNotInRange()
    {
        return
            // for started_at and expire_at date
            self::where('expire_at','<',Carbon::now())

                // for expire_at date and not started date
                ->orWhere(function ($q){
                    $q->where('expire_at','<',Carbon::now())
                        ->whereNull('started_at');
                });
    }

    public static function dateNotStarted()
    {
        return self::where('started_at','>',Carbon::now());
    }

    public static function setFeaturedBefore()
    {
        self::featured()->where('is_featured_before',0)
                ->update(['is_featured_before'=>1]);
    }

    public static function setStatuses()
    {
        self::dateInRange()->where('status','<>',3)->update(['status'=>1]);
        self::dateNotInRange()->where('status','<>',3)->update(['status'=>2]);
        self::dateNotStarted()->where('status','<>',3)->update(['status'=>4]);

        self::setFeaturedBefore();
    }
}
