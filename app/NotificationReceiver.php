<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationReceiver extends Model
{
    //

    protected $fillable = ['notification_id', 'receiver_id'];
    use SoftDeletes;
}
