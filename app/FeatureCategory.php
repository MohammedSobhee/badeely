<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureCategory extends Model
{

    protected $fillable = ['name', 'views'];
    //
    use SoftDeletes;

    public function views()
    {
        return $this->hasMany(ViewFeatureCategory::class, 'feature_id', 'id');
    }
}
