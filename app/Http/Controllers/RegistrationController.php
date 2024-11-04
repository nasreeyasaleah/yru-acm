<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certificate;
use Dompdf\Dompdf;
use Dompdf\Options;



class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function create($activityId)
    {
        // ดึงข้อมูลกิจกรรมจากฐานข้อมูล
        $activity = Activity::find($activityId);
    
        if (!$activity) {
            return redirect()->route('activities.index')->with('error', 'ไม่พบกิจกรรมที่เลือก');
        }
    
        // ตรวจสอบจำนวนโรงเรียนที่ไม่ซ้ำกันที่ลงทะเบียนแล้วในกิจกรรมนี้
        $distinctSchoolsCount = Registration::where('activity_id', $activityId)
            ->distinct('school_name')
            ->count('school_name');
    
        // ส่งข้อมูลกิจกรรมและจำนวนโรงเรียนไปยังหน้า view
        return view('registrations.create', compact('activity', 'distinctSchoolsCount'));
    }
    


    public function index(Request $request)
    {
       // กำหนดให้ปี 2567 เป็นค่าเริ่มต้นหากไม่ได้เลือกปี
    $year = $request->get('year', '2567'); // ค่าเริ่มต้นเป็น 2567

    // ดึงข้อมูลกิจกรรมตามปี
    $activities = Activity::where('year', $year)->get();

    // ส่งค่าปีและกิจกรรมไปยัง view
    $years = Activity::select('year')->distinct()->orderBy('year', 'desc')->get()->pluck('year');
    
    // ส่งข้อมูลไปยัง View
    return view('registrations.index', compact('activities', 'years'));
}


    
    public function showindex()
    {
        $activities = Activity::all(); 
        return view('registrations.index', compact('activities'));
    }
    public function showRegistrations($id)
    {
        $activity = Activity::findOrFail($id);
        $registrations = Registration::where('activity_id', $id)->get();
        
        foreach ($registrations as $registration) {
            $teamMembers = json_decode($registration->team_members ?? '[]', true);
            $registration->teamMembers = $teamMembers;
        }
    
        return view('activities.showRegistrations', compact('activity', 'registrations'));
    }
    


public function registrations()
{
    $registrations = Registration::with('activity')->get();
    return view('registrations.index', compact('registrations'));
}



public function results(Request $request)
{
    // กำหนดให้ปีล่าสุด (2567) เป็นค่าเริ่มต้นถ้าไม่มีการเลือกปี
    $year = $request->get('year', '2567');

    // ดึงข้อมูลการลงทะเบียนของผู้ใช้ที่ล็อกอินอยู่ และกรองตามปีการศึกษา
    $registrations = Registration::where('user_id', auth()->id()) // เฉพาะผู้ใช้ที่ล็อกอินอยู่
        ->whereHas('activity', function($query) use ($year) {
            $query->where('year', $year);
        })
        ->with('activity', 'teamMembers') // ดึงความสัมพันธ์กับ activity และ teamMembers
        ->orderBy('created_at', 'desc') // เรียงจากล่าสุดไปเก่าสุด
        ->get();

    // ดึงข้อมูลปีทั้งหมดเพื่อแสดงใน dropdown
    $years = Activity::select('year')->distinct()->orderBy('year', 'desc')->get();

    // ส่งข้อมูลไปยัง view
    return view('registrations.results', compact('registrations', 'years'));
}

   
public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'activity_id' => 'required|exists:activities,id',
        'school_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'supervisor_name' => 'required|string|max:255',
        'supervisor_phone' => 'required|string|max:255',
        'supervisor_email' => 'required|email',
        'title' => 'required|string|max:255',
        'level' => 'required|string',
        'registrant_names' => 'required|array|min:1',
        'registrant_names.*' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ]);

    // Fetch the activity details
    $activity = Activity::findOrFail($request->activity_id);

    // Check the school limit for this activity
    $school_limit = $activity->school_limit;  // Ensure 'school_limit' is correctly fetched from the 'activities' table

    // Count how many distinct teams from the same school are already registered in this activity
    $schoolAlreadyRegisteredCount = Registration::where('activity_id', $request->activity_id)
        ->where('school_name', $request->school_name)
        ->count();

    // If the school already registered teams exceeding the limit, block further registration
    if ($schoolAlreadyRegisteredCount >= $school_limit) {
        return redirect()->back()->with('error', 'โรงเรียนนี้ลงทะเบียนครบ ' . $school_limit . ' ทีมสำหรับกิจกรรมนี้แล้ว');
    }

    // Proceed with registration logic
    $type = count($request->registrant_names) > 1 ? 'team' : 'individual';
    $registrantName = $type === 'individual' ? $request->input('registrant_names.0') : null;

    // Create the registration record
    Registration::create([
        'activity_id' => $request->input('activity_id'),
        'school_name' => trim($request->input('school_name')),
        'address' => $request->input('address'),
        'supervisor_name' => $request->input('supervisor_name'),
        'user_id' => $request->input('user_id'),
        'supervisor_phone' => $request->input('supervisor_phone'),
        'supervisor_email' => $request->input('supervisor_email'),
        'title' => $request->input('title'),
        'project_name' => $request->input('project_name') ?? null,
        'level' => $request->input('level'),
        'type' => $type,
        'registrant_name' => $registrantName,
        'team_members' => $type === 'team' ? json_encode($request->input('registrant_names')) : null,
    ]);

    return redirect()->route('registrations.results')->with('success', 'การลงทะเบียนสำเร็จ');
}


    public function update(Request $request, $activityId)
    {
        $registrations = $request->input('registrations');
    
        foreach ($registrations as $id => $data) {
            $registration = Registration::find($id);
            if ($registration) {
                // อัปเดตฟิลด์ต่างๆ
                if (isset($data['team_members'])) {
                    $registration->team_members = json_encode($data['team_members']);
                }
                $registration->registrant_name = $data['registrant_name'] ?? $registration->registrant_name;
                $registration->school_name = $data['school_name'] ?? $registration->school_name;
                $registration->title = $data['title'] ?? $registration->title;
                $registration->supervisor_name = $data['supervisor_name'] ?? $registration->supervisor_name;
                $registration->attendance = $data['attendance'] ?? $registration->attendance;
                $registration->result = $data['result'] ?? $registration->result;
    
                // บันทึกการเปลี่ยนแปลง
                $registration->save();
            }
        }
    
        return redirect()->back()->with('masser', 'อัปเดตข้อมูลสำเร็จ');
    }
    

    

    
    public function team_members()
{
    return $this->hasMany(TeamMember::class, 'registration_id');
}





    
}
