<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSubMenu extends Model
{
    public function getId() {

        return $this->id;
    }

    public function getAdminMenuId() {

        return $this->admin_menu_id;
    }

    public function getTitle() {

        return $this->title;
    }

    public function getPos() {

        return $this->pos;
    }

    public function getlink() {

        return $this->link;
    }

    public function getSystemName() {

    	return $this->system_name;
    }

    public function getAdminSubMenu(AdminMenu $adminMenu) {

        return $this
            ->where('admin_menu_id', $adminMenu->getId())
            ->orderBy('title')
            ->get();
    }
}
