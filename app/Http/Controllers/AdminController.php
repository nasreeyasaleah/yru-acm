<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function create()
    {
        // แสดงฟอร์มการสมัคร
        return view('admin.register');
    }

    public function store(Request $request)
    {
        // การตรวจสอบข้อมูลฟอร์ม
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // สร้างบัญชีแอดมิน
        Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('admin.login')->with('success', 'สมัครบัญชีแอดมินสำเร็จ');
    }

    // เพิ่มฟังก์ชันล็อกอิน
    public function showLoginForm()
    {
        return view('admin.login'); // แสดงฟอร์มล็อกอิน
    }

    public function login(Request $request)
    {
        // ตรวจสอบข้อมูลที่กรอกเข้ามา
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // ล็อกอินสำเร็จ
            return redirect()->intended('activities.index');
        }
        
        // ข้อมูลไม่ถูกต้อง, ส่งกลับไปยังฟอร์มล็อกอินพร้อมกับข้อผิดพลาด
        return redirect()->back()->withErrors([
            'email' => 'ข้อมูลการเข้าสู่ระบบไม่ถูกต้อง',
        ])->withInput();
    }
}
