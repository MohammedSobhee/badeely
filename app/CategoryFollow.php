<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryFollow extends Model
{
    //
    use SoftDeletes;

    protected $table = 'category_follows';

    function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
