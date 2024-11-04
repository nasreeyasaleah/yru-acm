<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Activity;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 


class ActivityController extends Controller
{
    public function index(Request $request)
{
    // รับค่าปีจากการค้นหา
    $year = $request->get('year');
    
    // สร้าง query และเพิ่มการนับจำนวนผู้ลงทะเบียน
    $query = Activity::withCount('registrations');
    
    // ถ้ามีการเลือกปี ให้กรองข้อมูลตามปี
    if ($year) {
        $query->where('year', $year);
    }
    
    // ดึงข้อมูลกิจกรรมทั้งหมด
    $activities = $query->get();

    // ดึงข้อมูลปีทั้งหมดเพื่อแสดงใน dropdown
    $years = Activity::distinct()->pluck('year');
    
    // ส่งข้อมูลไปยัง view
    return view('activities.index', compact('activities', 'years'));
}

    

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'type' => 'required|string',
        'level' => 'required|string',
        'Certificate_type' => 'required|string',
        'year' => 'required|integer',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'teacher_name' => 'required|string',
        'registration_limit' => 'required|integer|min:1',
        'team_limit' => 'nullable|integer|min:1',
        'school_limit' => 'required|integer',
        'registration_end_date' => 'required|date',
    ]);

    // กำหนดค่า team_limit เป็น 1 ถ้าประเภทเป็น "แบบเดียว"
    if ($validatedData['type'] === 'แบบเดียว') {
        $validatedData['team_limit'] = 1;
    }


    $activity = new Activity();
    $activity->name = $request->name;
    $activity->type = $request->type;
    $activity->level = $request->level;
    $activity->Certificate_type = $request->Certificate_type;
    $activity->year = $request->year;
    $activity->date = $request->date;
    $activity->time = $request->start_time;
    $activity->time = $request->end_time;
    $activity->registration_end_date = $request->registration_end_date;
    $activity->teacher_name = $request->teacher_name;
    $activity->registration_limit = $request->registration_limit;
    $activity->registration_count = 0;
    $activity->school_limit = $request->school_limit;
    $activity->team_limit = $request->team_limit;
    $activity->save();

    return redirect()->route('activities.index')->with('success', 'กิจกรรมถูกสร้างเรียบร้อยแล้ว');
}



    public function edit(Activity $activity)
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'level' => 'required',
            'Certificate_type' => 'required',
            'year' => 'required',
            'date' => 'required|date',
            'start_time' =>'required',
            'end_time' => 'required',
            'teacher_name' => 'required',
            'registration_count' => '|integer|min:1',
            'school_limit' => 'required|integer',
            'registration_end_date' => 'required|date',
            'registration_end_date' => 'required|date',
            'team_limit' => 'required|integer|min:1'
            
        ]);
    
        $activity->update($request->all());
    
        return redirect()->route('activities.index')
            ->with('success', 'กิจกรรมถูกแก้ไขเรียบร้อยแล้ว.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'กิจกรรมถูกลบเรียบร้อยแล้ว.');
    }
    
    public function showRegistrations($id, Request $request)
    {
        $activity = Activity::findOrFail($id);
    
        // รับค่าตัวกรองสถานะการเข้าร่วมจากแบบฟอร์ม
        $attendance = $request->get('attendance');
    
        // ดึงข้อมูลการลงทะเบียนของกิจกรรมที่เลือก
        $query = Registration::where('activity_id', $id);
    
        // ถ้ามีการเลือกตัวกรองการเข้าร่วม (เช่น "เข้า") กรองตามสถานะนี้
        if ($attendance == 'เข้า') {
            $query->where('attendance', 'เข้า');
        }
    
        $registrations = $query->get();
    
        // ตรวจสอบว่ามีการดึงข้อมูลกิจกรรมทั้งหมดหรือไม่
        $activities = Activity::all();
    
        return view('activities.registrations', compact('activity', 'registrations', 'activities'));
    }
    

    


    public function someFunction($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            return redirect()->route('activities.showRegistrations', ['id' => $activity->id]);

        } else {
            return redirect()->route('activities.index')->with('error', 'ไม่พบกิจกรรมที่เลือก');
        }
    }

    public function registerForActivity($activityId)
{
    $activity = Activity::findOrFail($activityId);

    // ตรวจสอบว่ากิจกรรมเต็มแล้วหรือยัง
    if ($activity->registration_count >= $activity->registration_limit) {
        return redirect()->back()->with('error', 'กิจกรรมนี้เต็มแล้ว');
    }

    // เพิ่มจำนวนผู้สมัคร
    $activity->registration_count += 1;
    $activity->save();

    return redirect()->back()->with('success', 'ลงทะเบียนสำเร็จ');
}


    public function certificate($id)
    {
        $activity = Activity::findOrFail($id);
        $data = [
            'name' => $activity->name,
            'type' => $activity->type,
            'level' => $activity->level,
            'year' => $activity->year,
            'date' => $activity->date,
            'time' => $activity->time,
        ];
        $pdf = Pdf::loadView('certificates.template', $data);
        return $pdf->download('certificate.pdf');
    }
}
