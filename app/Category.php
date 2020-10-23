<?php

namespace App;

use App\Classes\Transable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Transable;

    public $timestamps = false;
    protected $guarded = [];
    protected $appends = ['name', 'follow_num', 'is_follow', 'countries', 'status'];

    public function image()
    {
        return media()->url('categories', $this->image);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    public function views()
    {
        return $this->hasMany(CategoryView::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'category_follows', 'category_id', 'user_id')->whereNull('category_follows.deleted_at');
    }


    public function getFollowNumAttribute()
    {
        return $this->follows()->count();
    }

    public function getCountriesAttribute()
    {
        return implode(',', $this->countries()->pluck('name')->toArray());
    }

    public function getIsFollowAttribute()
    {
        if (auth()->check()) {
            $follow = $this->follows()->where('category_follows.user_id', auth()->user()->id)->first();
            return isset($follow) ? 1 : 0;
        }
        return 0;
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeChild($query)
    {
        return $query->where('parent_id', '<>', 0);
    }

    public static function sort($sort)
    {
        foreach (self::where('parent_id', 0)->get() as $category) {
            $index = array_search($category->id, $sort);
            $category->update(['sort' => $index]);
        }
    }

}
