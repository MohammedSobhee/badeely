<?php

namespace App;

use App\Classes\Transable;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use Transable;
    public $timestamps = false;

    protected $guarded = [];

    protected $fillable = ['title', 'content', 'category_id', 'action', 'action_id', 'is_all'];
    protected $appends = ['category', 'action_name'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Receivers()
    {
        return $this->hasMany(NotificationReceiver::class, 'notification_id', 'id');
    }

    public function Action()
    {
        if ($this->action == 'collection')
            return $this->belongsTo(Category::class, 'action_id');
        if ($this->action == 'account')
            return $this->belongsTo(Account::class, 'action_id');

        return null;
    }

    public function getCategoryAttribute()
    {
        if ($this->category_id == 0) {
            return __('inputs.all');
        }
        return $this->Category()->first()->name;
    }

    public function getActionNameAttribute()
    {
        $actionList = $this->Action();
        if (isset($actionList))
            return $actionList->first()->name;
    }
}
