<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{

    public static function getAdminMenu() {

        return self::orderBy('pos')->get();
    }

	public function subMenu() {

		return $this->hasMany('App\Models\AdminSubMenu');
	}

	public function getId() {

		return $this->id;
	}

	public function getTitle() {

		return $this->title;
	}

	public function getlink() {

		return $this->link;
	}

	public function getPos() {

		return $this->pos;
	}

	public function getImg() {

		return $this->img;
	}

	public function getSubMenuSize() {

		return count($this->getSubMenu());
	}

	public function getSubMenu() {

		return $this->subMenu;
	}

}
