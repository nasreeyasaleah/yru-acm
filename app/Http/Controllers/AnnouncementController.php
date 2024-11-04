<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');  // เพิ่มเมธอดนี้
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'announcement_date' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);
    
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->announcement_date = $request->announcement_date;
    
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public/announcements');
            $announcement->file_path = $filePath;
        }
    
        // เพิ่มการตั้งค่า user_id สำหรับการเชื่อมโยงกับผู้ใช้ที่ล็อกอิน
        $announcement->user_id = auth()->user()->id;  // ตรวจสอบว่าผู้ใช้ล็อกอินและบันทึก user_id
    
        $announcement->save();
    
        return redirect()->back()->with('success', 'ข่าวสารถูกสร้างเรียบร้อยแล้ว');
    }
    

}
