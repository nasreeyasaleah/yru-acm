<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // ฟังก์ชันสำหรับแสดงฟอร์มการติดต่อ
    public function create()
    {
        return view('contact.form');
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลการติดต่อ
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'ส่งข้อความเรียบร้อยแล้ว');
    }

     // ฟังก์ชันสำหรับแสดงรายการการติดต่อ
     public function index()
     {
         $contacts = Contact::all();
         return view('contact.index', compact('contacts'));
     }
 
     // ฟังก์ชันสำหรับแสดงรายละเอียดการติดต่อแต่ละรายการ
     public function show($id)
     {
         $contact = Contact::findOrFail($id);
         return view('contact.show', compact('contact'));
     }
}
