<?php

namespace App\Http\Controllers;

use App\Classes\Page\Page;
use App\Models\AdminMenu;
use App\Models\Employee;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller {

    public function index() {
        $blocks = [];
        $blocks['repair_statistic']['title'] = 'Статистика по ремонту';

        $blocks['users']['title'] = 'Сотрудники';
        $blocks['users']['people'] = Employee::all();

        $blocks['workers']['title'] = 'Инженеры';
        $blocks['workers']['people'] = Worker::all();

        $userAdmin = Admin::getAuthAdmin();
        $menu = AdminMenu::getAdminMenu();
        $page = new Page('Статистика', 'admin.dashboard');

        return view($page->getViewName(),
            [
                'admin' => $userAdmin,
                'adminMenu' => $menu,
                'page' => $page,
                'blocks' => $blocks
            ]
        );
    }

    public function login() {

        $page = new Page('Вход в панель управления', 'admin.login');

        return view($page->getViewName(),
            [
                'page' => $page
            ]
        );

    }

    public function check(Request $request, Admin $admin) {

        if($request->isMethod('post')) {

            $login = $request->input('login');
            $password = $request->input('password');
            $remember = $request->input('remember');

            $adminUser = $admin->checkAdmin($login, $password);
            if ($adminUser) {
                setcookie('user', '', time() - 3600, '/');
                if ($remember == 'on') {
                    setcookie('user', $adminUser->getId(), time() + 0xFFFFFFF, '/');
                } else {
                    setcookie('user', $adminUser->getId(), 0, '/');
                }
                return redirect()->route('admin');
            }

            return redirect()->route('admin.login')->with('status', 'Логин и(или) пароль неверный.');;
        }
    }

    public function logout() {
        setcookie('admin', '', time() - 3600, '/');
        return redirect()->route('admin.login');
    }
}
