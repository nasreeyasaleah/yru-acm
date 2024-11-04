<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Barryvdh\DomPDF\Facade as PDF; // Ensure this import is here

class ReportController extends Controller
{
    public function generatePdf($activityId)
    {
        try {
            // Fetch the activity along with its registrations
            $activity = Activity::with('registrations')->findOrFail($activityId);

            // Prepare the data to be passed to the view
            $data = [
                'activity' => $activity,
                'registrations' => $activity->registrations,
            ];

            // Generate the PDF from a view and data
            $pdf = PDF::loadView('reports.registration-pdf', $data);

            // Return the generated PDF to download
            return $pdf->download('registration_report_' . $activity->id . '.pdf');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('PDF generation error: ' . $e->getMessage());

            // Return a user-friendly error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
