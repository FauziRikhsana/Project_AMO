<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\FormTemplate;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard User
     */
    public function user()
    {
        $userId = Auth::id();

        $totalForms = FormTemplate::where('status', 'active')->count();

        $totalReports = FormSubmission::where(
            'user_id',
            $userId
        )->count();

        $totalDraft = FormSubmission::where(
            'user_id',
            $userId
        )
        ->where('status', 'draft')
        ->count();

        $totalSubmitted = FormSubmission::where(
            'user_id',
            $userId
        )
        ->where('status', 'submitted')
        ->count();

        $recentReports = FormSubmission::with(
            'formTemplate'
        )
        ->where('user_id', $userId)
        ->orderByDesc('id')
        ->limit(5)
        ->get();

        return view('dashboard.user', compact(
            'totalForms',
            'totalReports',
            'totalDraft',
            'totalSubmitted',
            'recentReports'
        ));
    }


    /**
     * Dashboard Admin
     */
    public function admin()
{
    $totalTemplates = FormTemplate::where('status', 'active')->count();

    $totalReports = FormSubmission::count();

    $totalReview = FormSubmission::where('status', 'submitted')->count();

    $totalApproved = FormSubmission::where('status', 'approved')->count();

    $recentReports = FormSubmission::with([
        'formTemplate',
        'user'
    ])
    ->orderByDesc('id')
    ->limit(5)
    ->get();

    return view('dashboard.admin', compact(
        'totalTemplates',
        'totalReports',
        'totalReview',
        'totalApproved',
        'recentReports'
    ));
}
}