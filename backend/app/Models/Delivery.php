<?php

namespace App\Models;

use App\Interfaces\GeneralModel;
use App\Traits\GetSet\CreatedAtTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model implements GeneralModel
{
    use CreatedAtTrait;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'employee_id',
    ];

    protected $fillable = [
        'delivered_at'
    ];

    protected $hidden = [
        'employee_id'
    ];

    protected $with = [
        'employee'
    ];

    protected $appends = [
        'delivered_at_timestamp',
        'delivered_at_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByDeliveredDate', function (Builder $builder) {
            $builder->orderBy('delivered_at');
        });
    }

    /** ********* Relations ********* */

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function spares()
    {
        return $this->hasMany(Spare::class);
    }

    /** ********* Accessors & Mutators ********* */

    public function getDeliveredAtTimestampAttribute()
    {
        return Carbon::parse($this->delivered_at);
    }

    public function getDeliveredAtDateAttribute()
    {
        return date('d.m.Y', Carbon::parse($this->delivered_at)->timestamp);
    }

    /** ********* Getters & Setters ********* */

    public function getName()
    {
        return $this->delivered_at;
    }
}
