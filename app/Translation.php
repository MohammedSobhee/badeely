<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function transable()
    {
        return $this->morphTo();
    }

}
