<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    public function index(Request $request,)
    {
        $user = $request->user();
        return view('my_job_application.index', [
            'applications' => $user->jobApplications()
                ->with([
                    'job' => fn($query) => $query->withCount('jobApplications')
                        ->withAvg('jobApplications', 'expected_salary')
                        ->withTrashed(),
                    'job.employer',
                ])
                ->latest()

                ->get(),
        ]);
    }

    public function destroy(JobApplication $myJobApplication)
    {
        // dd($myJobApplication);
        $myJobApplication->delete();

        return redirect()->back()->with(
            'success',
            'Job application removed.'
        );
    }
}
