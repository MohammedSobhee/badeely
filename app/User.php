<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAvatarAttribute()
    {
        return str_contains($this->image, 'https://') || str_contains($this->image, 'http://')
            ? $this->image : media()->url('users', $this->image);
    }

    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function upVotes()
    {
        return $this->belongsToMany(Account::class, 'rates');
    }

//    public function instagramClicks()
//    {
//        return $this->belongsToMany(Account::class,'instagram_clicks');
//    }

//    public function clicks()
//    {
//        return $this->belongsToMany(Account::class,'clicks');
//    }

    public function views()
    {
        return $this->belongsToMany(Account::class, 'views');
    }

    public function follows()
    {
        return $this->belongsToMany(Category::class, 'category_follows', 'user_id', 'category_id')->whereNull('category_follows.deleted_at');
    }


    public function sendVerificationEmail()
    {
        $token = $this->id . '-' . rand(111111, 999999);
        Mail::send('mail.verification_email', ['token' => $token], function ($message) {
            $message->from(config('settings.website_email'), config('settings.website_name'));
            $message->to($this->email)
                ->subject(__('dashboard.verify_account'));
        });

        return $token;
    }

    public function sendVerificationSMS()
    {
        $token = 1111;
        \Log::info($token);
        return $token;
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::send('mail.reset_password', ['token' => $token], function ($message) {
            $message->from(config('settings.website_email'), config('settings.website_name'));
            $message->to($this->email)
                ->subject(__('dashboard._reset_password'));
        });
    }

    public static function usersTransformer($collection)
    {
        return $collection->get()->map(function ($item) {
            return [
                '#' => $item->id,
                __('inputs.name') => $item->name,
                __('inputs.email') => $item->email,
                __('inputs.mobile') => $item->mobile,
                __('inputs.gender') => __('inputs.' . $item->gender),
                __('inputs.age') => __('inputs.' . $item->age),
                __('inputs.register_by') => $item->register_by == 'facebook' ? __('inputs.facebook') : __('inputs.normal'),

                __('inputs.rate') => $item->upVotes()->count(),
                __('inputs.clicks') => $item->views()->count(),

                __('inputs.country') => $item->country->name ?? '-',
                __('inputs.verified') => $item->is_confirmed == 1 ? __('inputs.verified') : __('inputs.not_verified'),
            ];
        });
    }

}
