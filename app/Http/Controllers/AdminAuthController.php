<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    private $adminEmail = "laibaakhtar9890@gmail.com";
    private $adminPassword = "btmg@123";

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if (
            $request->email === $this->adminEmail &&
            $request->password === $this->adminPassword
        ) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}