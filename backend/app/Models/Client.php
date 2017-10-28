<?php

namespace App\Models;

use App\Services\StringTransformator;
use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\Relations\BelongTo\CityTrait;
use App\Traits\Relations\BelongTo\CityTypeTrait;
use App\Traits\Relations\BelongTo\OrganizationTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class Client extends SearchableModel
{
    use OrganizationTrait;
    use CityTypeTrait;
    use IdTrait;
    use CityTrait;
    use CreatedAtTrait;

    const CLIENT_UNKNOWN = 'Неизвестный';
    const RANG_NO_REGISTERED = '1';
    const RANG_REGISTERED = '2';

    const SEARCH = [
        'first_name',
        'second_name',
        'mobile_phone^100',
        'city.name',
        'organization.name',
    ];

    protected $guarded = [
        'id',
        'organization_id',
        'city_id',
        'city_type_id',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
      'second_name',
      'first_name',
      'father_name',
      'mobile_phone',
      'home_phone',
      'address_street',
      'address_house',
      'address_flat',
    ];

    protected $hidden = [
        'organization_id',
        'city_id',
        'city_type_id',
    ];

    protected $with = [
        'organization',
        'city',
        'cityType',
    ];

    protected $appends = [
        'full_name',
        'mobile_phone_native',
        'home_phone_native',
        'address',
        'link',
        'repairs_count',
        'last_repair',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderBySecondName', function (Builder $builder) {
            $builder->orderBy('second_name');
        });
    }

    /** ********* Relations ********* */

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    /** ********* Accessors & Mutators ********* */

    public function getMobilePhoneNativeAttribute()
    {
        $stringTransformator = new StringTransformator();

        return $stringTransformator->transformToNativePhoneFormat($this->mobile_phone);
    }

    public function getHomePhoneNativeAttribute()
    {
        $stringTransformator = new StringTransformator();

        return $stringTransformator->transformToNativePhoneFormat($this->home_phone);
    }

    public function getAddressAttribute()
    {
        $address = '';

        if ($this->getCityType()->getShortName()) {
            $address .= $this->getCityType()->getShortName() . ' ';
        }
        if ($this->getCity()->getName()) {
            $address .= $this->getCity()->getName();
        }
        if ($this->address_street) {
            $address .= ', ул. ' . $this->address_street;
        }
        if ($this->address_house) {
            $address .= ', д. ' . $this->address_house;
        }
        if ($this->address_flat) {
            $address .= ', кв. ' . $this->address_flat;
        }

        return $address;
    }

    public function getFullNameAttribute()
    {
        $fullName = '';
        if ($this->second_name) {
            $fullName = $this->second_name;
            if ($this->first_name) {
                $fullName .= ' ' . $this->first_name;
                if ($this->father_name) {
                    $fullName .= ' ' . $this->father_name;
                }
            }
        } elseif ($this->first_name) {
            $fullName = $this->first_name;
            if ($this->father_name) {
                $fullName .= ' ' . $this->father_name;
            }
        } elseif ($this->getOrganization()) {
            $fullName = $this->getOrganization()->getName();
        } else {
            $fullName = self::CLIENT_UNKNOWN;
        }

        return $fullName;
    }

    public function getLinkAttribute()
    {
        return route('admin.clients.show', ['id' => $this->id]);
    }

    public function getRepairsCountAttribute()
    {
        return $this->repairs()->count();
    }

    public function getLastRepairAttribute()
    {
        return $this->repairs()->latest()->first();
    }

    public function setMobilePhoneAttribute($value)
    {
        $stringTransformator = new StringTransformator();
        $this->attributes['mobile_phone'] = $stringTransformator->clearPhone($value);
    }

    public function setHomePhoneAttribute($value)
    {
        $stringTransformator = new StringTransformator();
        $this->attributes['home_phone'] = $stringTransformator->clearPhone($value);
    }

    /** ********* Getters & Setters ********* */

    public function getShortName()
    {
        $firstName = $this->first_name ? mb_substr($this->first_name, 0, 1) : '';
        $fatherName = $this->father_name ? mb_substr($this->father_name, 0, 1) : '';
        $shortName = '';
        if ($this->second_name) {
            $shortName .= $this->second_name;
            if ($firstName) {
                $shortName .= ' ' . $firstName . '.';
                if ($fatherName) {
                    $shortName .= ' ' . $fatherName . '.';
                }
            }
        } elseif ($this->first_name) {
            $shortName = $this->first_name;
        } elseif ($this->getOrganization()) {
            $shortName = $this->getOrganization()->getName();
        } else {
            $shortName = self::CLIENT_UNKNOWN;
        }

        return $shortName;
    }

    public function getAllPhonesOnNativeFormat()
    {
        $phones = '';
        if ($this->mobile_phone && $this->home_phone) {
            $phones .= $this->mobile_phone_native;
            $phones .= ', ' . $this->home_phone_native;
        } elseif ($this->mobile_phone && !$this->home_phone) {
            $phones .= $this->mobile_phone_native . ' (моб.)';
        } elseif (!$this->mobile_phone && $this->home_phone) {
            $phones .= $this->home_phone_native . ' (дом.)';
        }

        return $phones;
    }

    public function setPassword($password)
    {
        if ($password) {
            $this->password = Hash::make($password);
        }
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
