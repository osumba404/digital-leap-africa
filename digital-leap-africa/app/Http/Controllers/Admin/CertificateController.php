<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $settings = [
            'certificate_title' => SiteSetting::getValue('certificate_title', 'Certificate of Completion'),
            'certificate_subtitle' => SiteSetting::getValue('certificate_subtitle', 'Digital Leap Africa'),
            'certificate_text' => SiteSetting::getValue('certificate_text', 'This is to certify that'),
            'certificate_completion_text' => SiteSetting::getValue('certificate_completion_text', 'has successfully completed the course'),
            'certificate_achievement_text' => SiteSetting::getValue('certificate_achievement_text', 'and has demonstrated exceptional proficiency in the subject matter through dedicated study, practical application, and commitment to excellence in digital learning.'),
            'certificate_instructor_title' => SiteSetting::getValue('certificate_instructor_title', 'Course Instructor'),
            'certificate_director_title' => SiteSetting::getValue('certificate_director_title', 'Program Director'),
            'certificate_director_name' => SiteSetting::getValue('certificate_director_name', 'Digital Leap Africa'),
        ];

        return view('admin.certificates.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'certificate_title' => 'required|string|max:255',
            'certificate_subtitle' => 'required|string|max:255',
            'certificate_text' => 'required|string|max:500',
            'certificate_completion_text' => 'required|string|max:500',
            'certificate_achievement_text' => 'required|string|max:1000',
            'certificate_instructor_title' => 'required|string|max:255',
            'certificate_director_title' => 'required|string|max:255',
            'certificate_director_name' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::setValue($key, $value);
        }

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate settings updated successfully.');
    }
}