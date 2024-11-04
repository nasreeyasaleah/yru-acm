<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('announcements');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::logout(); // ออกจากระบบ
    
        $request->session()->invalidate(); // ยกเลิก session
        $request->session()->regenerateToken(); // สร้าง token ใหม่ ป้องกัน CSRF
    
        return redirect('login'); // เปลี่ยนเส้นทางไปยังหน้า login
    }
    
 
}
