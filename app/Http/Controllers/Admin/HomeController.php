<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Страница администратора';
        return view('admin.home-index', compact(['pageTitle']));
    }

    public function edit()
    {
        $admin = Auth::user();
        $pageTitle = 'Настройки';
        return view('admin.home-edit', compact(['admin', 'pageTitle']));
    }

    public function update(StoreUserRequest $request)
    {
        $admin =  Auth::user();
        $admin->name = $request->name;
        if ($admin->email != $request->email) {
            $admin->email_verified_at = null;
        }
        $admin->email = $request->email;
        if($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return redirect()->route('admin.home.index')->with(['message' => 'Данные профиля успешно обновлены']);
    }
}
