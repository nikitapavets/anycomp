<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller {

    public function index() {

        return redirect()->route('admin.repair.list');
    }

    public function login() {

        $page = [
            'title' => 'AnyComp | Вход в панель управления',
	        'css' => '/styles/admin.min.css',
	        'css_header' => ''
        ];

        return view('admin.login', [
            'page' => $page
        ]);
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
