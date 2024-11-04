<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Registration; 
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;
use Illuminate\Support\Facades\Log; // Import Log

class CertificateController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลการลงทะเบียนเฉพาะของผู้ใช้ที่ล็อกอินอยู่ พร้อมกิจกรรมและเกียรติบัตร
        $registrations = Registration::with(['activity', 'certificate']) // ดึงข้อมูล activity และ certificate
            ->where('user_id', auth()->id()) // เฉพาะผู้ใช้ที่ล็อกอินอยู่
            ->where('attendance', 'เข้า') // เฉพาะผู้ที่ "เข้า"
            ->orderBy('created_at', 'desc') // เรียงจากล่าสุดไปเก่าสุด
            ->get();
    
        // ส่งข้อมูลไปยัง view
        return view('certificates.index', compact('registrations'));
    }
    
    public function download($id)
{
    // ดึงข้อมูลการลงทะเบียนพร้อมกับข้อมูลกิจกรรม
    $registration = Registration::with('activity')->findOrFail($id);
    $activity = $registration->activity; // ดึงข้อมูล activity

    // ค้นหาข้อมูล certificate ที่ต้องการใช้
    $certificate = Certificate::first();

    if (!$certificate) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลเกียรติบัตร');
    }

    // ส่งข้อมูลไปยัง Blade
    $data = [
        'registration' => $registration,
        'activity' => $activity, // ส่งข้อมูล activity ที่มีฟิลด์ certificate_type
        'certificate' => $certificate
    ];

    // สร้าง PDF จาก template ที่เลือก
    $pdf = Pdf::loadView('certificates.template', $data)->setPaper('a4', 'landscape');
    return $pdf->download('certificate.pdf');
}

    


public function participate($id)
{
    // ดึงข้อมูลการลงทะเบียนพร้อมกับข้อมูลกิจกรรม
    $registration = Registration::with('activity')->findOrFail($id);
    $activity = $registration->activity; // ดึงข้อมูล activity

    // ค้นหาข้อมูล certificate ที่ต้องการใช้
    $certificate = Certificate::first();

    if (!$certificate) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลเกียรติบัตร');
    }

    // ตรวจสอบ template ของ activity เพื่อส่งไปยัง Blade
    $data = [
        'registration' => $registration,
        'activity' => $activity, // ส่งข้อมูล activity ที่มีฟิลด์ certificate_type
        'certificate' => $certificate
    ];

    // สร้าง PDF จาก template ที่เลือก
    $pdf = Pdf::loadView('certificates.participate', $data)->setPaper('a4', 'landscape');

    return $pdf->download('certificate_participate.pdf');
}

    

    public function downloadSignature($id)
{
    $certificate = Certificate::find($id);

    if (!$certificate || !$certificate->signature1) {
        return redirect()->back()->with('error', 'ไม่พบลายเซ็น');
    }

    $filePath = storage_path('app/public/signatures/' . $certificate->signature1);

    return response()->download($filePath);
}

    
    
    public function update(Request $request)
    {
        $certificate = Certificate::first();
    
        if ($request->hasFile('signature1')) {
            $signature1Path = $request->file('signature1')->store('public/signatures');
            $certificate->signature1 = basename($signature1Path); // เก็บชื่อไฟล์
        }
    
        if ($request->hasFile('signature2')) {
            $signature2Path = $request->file('signature2')->store('public/signatures');
            $certificate->signature2 = basename($signature2Path); // เก็บชื่อไฟล์
        }
    
        $certificate->save();
    
        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
    

    
    public function admin()
    {
        $certificates = Certificate::all(); // ดึงข้อมูลเกียรติบัตรทั้งหมด
        return view('certificates.admin', compact('certificates')); // ส่งไปยัง view
    }
    
    

    public function edit($activityId)
{
    $activity = Activity::findOrFail($activityId); // ดึงข้อมูลกิจกรรม
    $registrations = Registration::where('activity_id', $activityId)->get(); // ดึงผู้ลงทะเบียนในกิจกรรมนี้

    return view('registrations.edit', compact('activity', 'registrations'));
}

public function generateCertificate($id) {
    $registration = Registration::find($id);
    $activity = $registration->activity;
    $certificate = Certificate::first(); // หรือค้นหา certificate ตามที่ต้องการ

    return view('certificates.template', compact('registration', 'activity', 'certificate'));
}


public function registration()
{
    return $this->belongsTo(Registration::class);
}


}
