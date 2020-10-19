<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewFeatureCategory extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'feature_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feature()
    {
        return $this->belongsTo(FeatureCategory::class);
    }


    public function scopeBetweenDate($query)
    {
        if (request('from') && request('to')) {
            $query->whereBetween('created_at', [request('from'), request('to')]);
        }
    }
}
