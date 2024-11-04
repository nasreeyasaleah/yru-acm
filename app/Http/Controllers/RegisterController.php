<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Registration;
use App\Models\TeamMember;


class RegisterController extends Controller
{
    // ฟังก์ชันนี้อาจมีอยู่แล้วใน RegisterController
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function update(Request $request, $activityId)
{
    foreach ($request->registrations as $id => $data) {
        $registration = Registration::findOrFail($id);

        // ตรวจสอบว่า team_members เป็นอาร์เรย์ก่อนที่จะวนลูป
        if (isset($data['team_members']) && is_array($data['team_members'])) {
            // วนลูปเพื่ออัปเดตชื่อสมาชิกในทีม
            foreach ($data['team_members'] as $memberId => $memberName) {
                $teamMember = TeamMember::findOrFail($memberId);
                $teamMember->update(['name' => $memberName]);
            }

            // นับจำนวนสมาชิกและอัปเดตในฟิลด์ team_members
            $data['team_members'] = count($data['team_members']);
        } else {
            // ถ้าไม่ใช่อาร์เรย์, ให้เก็บเพียงจำนวนสมาชิก (หรือตามที่ต้องการ)
            $data['team_members'] = 0;  // หรือค่าอื่น ๆ ที่เหมาะสม
        }

        $registration->update($data);
    }

    return redirect()->route('activities.showRegistrations', ['activityId' => $activityId])
        ->with('success', 'ข้อมูลได้รับการอัปเดตเรียบร้อยแล้ว');
}



    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'school_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
    
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_name' => $request->school_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        if ($user) {
            // Success
            return redirect()->route('login')->with('status', 'User created successfully!');
        } else {
            // Failure
            return redirect()->back()->with('error', 'Failed to create user!');
        }
    
        
    
        auth()->login($user);
    
        return redirect()->route('announcements.index');
    }
    
}
