<?php

namespace App\Models;

use App\Services\StringTransformator;
use App\Traits\GetSet\CreatedAtTrait;
use App\Traits\GetSet\IdTrait;
use App\Traits\Relations\BelongTo\CityTrait;
use App\Traits\Relations\BelongTo\CityTypeTrait;
use App\Traits\Relations\BelongTo\OrganizationTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const CLIENT_UNKNOWN = 'Неизвестный';

    use OrganizationTrait;
    use CityTypeTrait;
    use IdTrait;
    use CityTrait;
    use CreatedAtTrait;

    protected $guarded = array();

    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    public function setFatherName($fatherName)
    {
        $this->father_name = $fatherName;
    }

    public function setSecondName($secondName)
    {
        $this->second_name = $secondName;
    }

    public function setMobilePhone($mobilePhone)
    {
        $stringTransformator = new StringTransformator();
        $this->mobile_phone = $stringTransformator->clearPhone($mobilePhone);
    }

    public function setHomePhone($homePhone)
    {
        $stringTransformator = new StringTransformator();
        $this->home_phone = $stringTransformator->clearPhone($homePhone);;
    }

    public function getStreet()
    {
        return $this->address_street;
    }

    public function setStreet($street)
    {
        $this->address_street = $street;
    }

    public function getHouse()
    {
        return $this->address_house;
    }

    public function setHouse($house)
    {
        $this->address_house = $house;
    }

    public function getFlat()
    {
        return $this->address_flat;
    }

    public function setFlat($flat)
    {
        $this->address_flat = $flat;
    }

    public function getFullName()
    {
        $fullName = '';
        if ($this->getSecondName()) {
            $fullName = $this->getSecondName();
            if ($this->getFirstName()) {
                $fullName .= ' '.$this->getFirstName();
                if ($this->getFatherName()) {
                    $fullName .= ' '.$this->getFatherName();
                }
            }
        } elseif ($this->getFirstName()) {
            $fullName = $this->getFirstName();
            if ($this->getFatherName()) {
                $fullName .= ' '.$this->getFatherName();
            }
        } elseif ($this->getOrganization()) {
            $fullName = $this->getOrganization()->getName();
        } else {
            $fullName = self::CLIENT_UNKNOWN;
        }

        return $fullName;
    }

    public function getSecondName()
    {
        return $this->second_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getFatherName()
    {
        return $this->father_name;
    }

    public function getShortName()
    {
        $firstName = $this->getFirstName() ? mb_substr($this->getFirstName(), 0, 1) : '';
        $fatherName = $this->getFatherName() ? mb_substr($this->getFatherName(), 0, 1) : '';
        $shortName = '';
        if ($this->getSecondName()) {
            $shortName .= $this->getSecondName();
            if ($firstName) {
                $shortName .= ' '.$firstName.'.';
                if ($fatherName) {
                    $shortName .= ' '.$fatherName.'.';
                }
            }
        } elseif ($this->getFirstName()) {
            $shortName = $this->getFirstName();
        } elseif ($this->getOrganization()) {
            $shortName = $this->getOrganization()->getName();
        } else {
            $shortName = self::CLIENT_UNKNOWN;
        }

        return $shortName;
    }

    public function getAddress()
    {
        $address = '';

        if ($this->getCityType()->getShortName()) {
            $address .= $this->getCityType()->getShortName().' ';
        }
        if ($this->getCity()->getName()) {
            $address .= $this->getCity()->getName();
        }
        if ($this->address_street) {
            $address .= ', ул. '.$this->address_street;
        }
        if ($this->address_house) {
            $address .= ', д. '.$this->address_house;
        }
        if ($this->address_flat) {
            $address .= ', кв. '.$this->address_flat;
        }

        return $address;
    }

    public function getAllPhonesOnNativeFormat()
    {
        $phones = '';
        if ($this->getMobilePhone() && $this->getHomePhone()) {
            $phones .= $this->getMobilePhoneOnNativeFormat();
            $phones .= ', '.$this->getHomePhoneOnNativeFormat();
        } elseif ($this->getMobilePhone() && !$this->getHomePhone()) {
            $phones .= $this->getMobilePhoneOnNativeFormat().' (моб.)';
        } elseif (!$this->getMobilePhone() && $this->getHomePhone()) {
            $phones .= $this->getHomePhoneOnNativeFormat().' (дом.)';
        }

        return $phones;
    }

    public function getMobilePhone()
    {
        return $this->mobile_phone;
    }

    public function getHomePhone()
    {
        return $this->home_phone;
    }

    public function getMobilePhoneOnNativeFormat()
    {
        $stringTransformator = new StringTransformator();

        return $stringTransformator->transformToNativePhoneFormat($this->getMobilePhone());
    }

    public function getHomePhoneOnNativeFormat()
    {
        $stringTransformator = new StringTransformator();

        return $stringTransformator->transformToNativeHomePhoneFormat($this->getHomePhone());
    }
}
