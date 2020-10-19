<?php

namespace App\Classes;

use App\Translation;
use Illuminate\Database\Eloquent\Builder;

trait Transable
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with('translate');
        });
    }

    public function name($local){
       return optional($this->translate($local)->first())->name;
    }

    public function description($local){
       return optional($this->translate($local)->first())->description;
    }

    public function getNameAttribute()
    {
        return optional($this->translate)->name;
    }

    public function touchTranslation($names, $descriptions = null)
    {
        foreach (config('languages') as $code => $label) {

            Translation::updateOrCreate(
                [
                    'transable_type' => __CLASS__,
                    'transable_id' => $this->id,
                    'language_code' => $code,
                ],
                [
                    'name' => $names[$code] ?? '',
                    'description' => $descriptions[$code] ?? '',
                ]
            );

        }
    }


    public function getDescriptionAttribute()
    {
        return optional($this->translate)->description;
    }

    public function translate($local = null)
    {
        if(!$local){
            $local = app()->getLocale() ?? 'en';
        }

        return $this->morphOne(Translation::class, 'transable')->where('language_code',$local);
    }

    public function translates()
    {
        return $this->morphMany(Translation::class, 'transable');
    }
}
