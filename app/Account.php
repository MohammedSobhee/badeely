<?php

namespace App;

use App\Classes\Transable;
use App\Traits\AccountDates;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Account extends Model
{
    use Transable, AccountDates;

    const statuses = [
        1 => [
            'key' => 'active',
            'color' => 'success',
        ],
        2 => [
            'key' => 'inactive',
            'color' => 'danger',
        ],
        3 => [
            'key' => 'pending',
            'color' => 'metal',
        ],
        4 => [
            'key' => 'waiting',
            'color' => 'accent',
        ],
    ];

    protected $fillable = [
        'priority', 'status', 'is_featured_before',
    ];

    protected static function boot()
    {
        $today = date('Y-m-d');

        if(cache()->get('last_set_statuses_perform') != $today){

            // perform
            self::setStatuses();

           // cache it
            cache()->forever('last_set_statuses_perform',$today);

            // log it
            \Log::info('last set statuses perform:'.now());

        }

        parent::boot();
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Rate::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

//    public function instagramClicks()
//    {
//        return $this->belongsToMany(User::class,'instagram_clicks');
//    }

//    public function clicks()
//    {
//        return $this->belongsToMany(User::class,'clicks');
//    }

    public function scopeFeatured($query)
    {
        $today = date('Y-m-d');
        $query->where('featured_from','<=',$today)
              ->where('featured_to','>=',$today);
    }

    public function scopePublished($query)
    {
        $query->where('status',1);
    }

    public function isFeature()
    {
        $today = date('Y-m-d');
        return $this->featured_from <= $today && $this->featured_to >= $today;
    }

    public function remainingDays()
    {
        $today = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $startedAt = Carbon::createFromFormat('Y-m-d', date('Y-m-d',strtotime($this->started_at)));
        $expireAt = Carbon::createFromFormat('Y-m-d', date('Y-m-d',strtotime($this->expire_at)));

        if(!$this->expire_at && $today > $startedAt){
            return 'unlimited';
        }

        if ($this->started_at && $today < $startedAt) {
            return 'not_started';
        }

        if($expireAt <= $today){
            $remaining = -1;
        }else{
            $remaining = $today->diffInDays($expireAt);
        }

        return $remaining >= 0 ? $remaining : 'over' ;

    }

    public function gallery()
    {
        $images = [];
        if($gallery = json_decode($this->images)){
            foreach ($gallery as $image){
                $images[] =  media()->url('accounts',$image);
            }
        }

        return $images;
    }

    public function isVoted()
    {
        return (bool) Rate::where('user_id', Auth::id())
            ->where('account_id', $this->id)
            ->first();
    }

    public function isViewed()
    {
        return (bool) View::where('user_id', Auth::id())
            ->where('account_id', $this->id)
            ->first();
    }

    public function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy){
            case 'latest' :
                 return $query->latest();
                break;
            case 'votes' :
                 return $query->orderBy('rate','desc');
                break;
            case 'alphabet' :
                   //return $query->orderBy('name','desc');
 //               return $query->orderByCharacters();

     //           return $query->orderBy('translate.account_name', 'asc');
                break;
            default :
                 return $query->latest();
                break;
        }
    }

    // public function ScopeOrderByCharacters($query)
    // {
    //     $local = app()->getLocale() ?? 'en';
    //     return $query->leftJoin('translations', 'accounts.id', '=', 'translations.transable_id')
    //         ->select("accounts.*")
    //         ->where('translations.language_code', $local)
    //         ->groupBy('accounts.id')
    //         ->orderByRaw('translations.name ASC');
    // }

    public static function accountsTransformer($collection)
    {
        //clicks
        return $collection->get()->map(function ($item){

            $remainingDays = $item->remainingDays();

            $categories = '';
            foreach( $item->categories as $key => $category ){
                if($key){
                    $categories .= ' , ';
                }
                $categories .= $category->name;
            }

            return [
                '#' => $item->id,
                __('inputs.name') => $item->name,
                __('inputs.user') => $item->user->name ?? '-',
                __('inputs.category') => $categories,
                __('inputs.rate') => $item->rate,
                __('inputs.clicks') => $item->views,
//                __('inputs.instagram_clicks') => $item->instagram_clicks,
                __('inputs.filters') => $item->isFeature() ? 'Featured' : '',
                __('inputs.remaining_days') => $remainingDays === 'unlimited' ? '∞' : $remainingDays,
                __('inputs.priority') => $item->priority,
                __('inputs.created_at') => date( 'd/m/Y - g:i A' , strtotime($item->created_at) ),
                __('inputs.status') => isset(self::statuses[$item->status]) ? __('inputs.'.self::statuses[$item->status]['key']) : '-',
            ];
        });
    }

}
