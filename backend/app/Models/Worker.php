<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

class Worker extends Admin
{
    const NO_SELECTED_ID = 1;

    protected $table = "admins";

    protected $appends = [
        'completed_repairs_count'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('worker', function (Builder $builder) {
            $builder->whereIn('skill', [Admin::SKILL_WORKER, Admin::SKILL_DIRECTOR]);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function completed_repairs()
    {
        return $this->hasMany(Repair::class, 'worker_id');
    }

    public function getCompletedRepairsCountAttribute()
    {
        return $this->completed_repairs()->count();
    }
}