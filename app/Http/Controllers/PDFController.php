<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Activity; // หรือ Model ที่คุณใช้
use App\Models\Registration; // หรือ Model ที่คุณใช้



class PDFController extends Controller
{
    public function generateResultsPDF($activityId)
{
    $activity = Activity::findOrFail($activityId); // Fetch the activity by its ID
    $registrations = Registration::where('activity_id', $activityId)->get(); // Get the registrations associated with the activity

    // Generate the PDF using the view 'pdf.results_pdf'
    $pdf = Pdf::loadView('pdf.results_pdf', compact('activity', 'registrations'))
        ->setPaper('A4', 'portrait')
        ->setOption('isHtml5ParserEnabled', true)
        ->setOption('isRemoteEnabled', true);

    return $pdf->stream('results_list.pdf');
}
public function generateRegistrationPDF($activityId)
{
    $activity = Activity::findOrFail($activityId); // Fetch the activity by its ID
    $registrations = Registration::where('activity_id', $activityId)->get(); // Get the registrations associated with the activity

    // Generate the PDF using the view 'pdf.registration_list'
    $pdf = Pdf::loadView('pdf.registration_list', compact('activity', 'registrations'))
        ->setPaper('A4', 'portrait')
        ->setOption('isHtml5ParserEnabled', true)
        ->setOption('isRemoteEnabled', true);

    return $pdf->stream('registration_list.pdf');
}
public function generateRegistrationResultsPDF($activityId)
{
    $activity = Activity::findOrFail($activityId); // Fetch the activity by its ID
    $registrations = Registration::where('activity_id', $activityId)->get(); // Get the registrations associated with the activity

    // Generate the PDF using the view 'pdf.registration_results'
    $pdf = Pdf::loadView('pdf.result', compact('activity', 'registrations'))
        ->setPaper('A4', 'portrait')
        ->setOption('isHtml5ParserEnabled', true)
        ->setOption('isRemoteEnabled', true);

    return $pdf->stream('result.pdf');
}



public function showRegistrations() {
    // Increase execution time
    ini_set('max_execution_time', 300); // Increase to 5 minutes

    // Fetch your data and render the view
    $activity = Activity::find(1);  // Example fetching of activity
    $registrations = Registration::where('activity_id', $activity->id)->get();

    return view('registrations.index', compact('activity', 'registrations'));
}

public function uploadImage(Request $request)
{
    // ดึงไฟล์ภาพที่อัปโหลด
    $image = $request->file('image');
    $pathToImage = $image->getRealPath(); // ที่อยู่ไฟล์จริง

    // เรียกฟังก์ชันเพิ่มประสิทธิภาพของภาพ
    $this->optimizeImage($pathToImage);

    // บันทึกภาพลงใน storage หรือเส้นทางที่ต้องการ
    $image->store('public/images');

    return back()->with('success', 'อัปโหลดและเพิ่มประสิทธิภาพของภาพเรียบร้อยแล้ว');
}

public function optimizeImage($pathToImage)
{
    $optimizerChain = OptimizerChainFactory::create();
    $optimizerChain->optimize($pathToImage);
}

    
}
