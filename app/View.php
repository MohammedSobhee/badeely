<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function scopeBetweenDate($query)
    {
        if(request('from') && request('to')){
            $query->whereBetween('created_at',[request('from'),request('to')]);
        }
    }

}
