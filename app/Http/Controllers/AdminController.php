<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    private $adminEmail = 'admin@btmg.com';
    private $adminPassword = '123456'; // baad me hash bhi karwa denge

    public function login(Request $request)
    {
        if (
            $request->email === $this->adminEmail &&
            $request->password === $this->adminPassword
        ) {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid admin credentials');
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
