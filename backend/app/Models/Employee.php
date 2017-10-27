<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Employee extends Admin
{
    protected $table = "admins";

    protected $appends = [
      'repairs_count'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('worker', function (Builder $builder) {
            $builder->whereIn('skill', [Admin::SKILL_WORKER, Admin::SKILL_MANAGER, Admin::SKILL_DIRECTOR]);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repairs()
    {
        return $this->hasMany(Repair::class, 'employee_id');
    }

    public function getRepairsCountAttribute()
    {
        return $this->repairs()->count();
    }
}