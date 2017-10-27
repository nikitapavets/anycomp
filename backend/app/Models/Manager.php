<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Manager extends Admin
{
    protected $table = "admins";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('worker', function (Builder $builder) {
            $builder->where('skill', '=',Admin::SKILL_MANAGER);
        });
    }
}