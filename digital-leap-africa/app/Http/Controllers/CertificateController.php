<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function show(Certificate $certificate)
    {
        // Ensure user can only view their own certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        return view('certificates.show', compact('certificate'));
    }

    public function download(Certificate $certificate)
    {
        // Ensure user can only download their own certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        $settings = \App\Helpers\SettingsHelper::all();
        $logoUrl = !empty($settings['logo_url']) ? url($settings['logo_url']) : asset('images/logo.png');

        $instructorSignature = self::nameToSignature($certificate->course->instructor ?? '');
        $directorName = 'Florence Ndinda';
        $directorSignature = self::nameToSignature($directorName);
        $directorTitle = 'Executive Director';

        return view('certificates.download', compact('certificate', 'logoUrl', 'instructorSignature', 'directorSignature', 'directorName', 'directorTitle'));
    }

    /** Derive a signature-style form from a full name (e.g. "John Smith" -> "J. Smith"). */
    private static function nameToSignature(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY);
        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1)) . '. ' . $parts[count($parts) - 1];
        }
        return $name ?: '—';
    }

    public function verify($certificateNumber)
    {
        $certificate = Certificate::where('certificate_number', $certificateNumber)->first();
        
        if (!$certificate) {
            return view('certificates.verify', ['certificate' => null, 'error' => 'Certificate not found']);
        }

        return view('certificates.verify', compact('certificate'));
    }

    public static function issueCertificate($userId, $courseId)
    {
        $course = Course::find($courseId);
        
        if (!$course || !$course->has_certification) {
            return false;
        }

        // Check if certificate already exists
        $existingCertificate = Certificate::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($existingCertificate) {
            return $existingCertificate;
        }

        // Create new certificate
        $certificate = Certificate::create([
            'user_id' => $userId,
            'course_id' => $courseId,
            'certificate_number' => Certificate::generateCertificateNumber(),
            'certificate_title' => $course->certificate_title ?: $course->title,
            'issued_at' => now(),
        ]);

        return $certificate;
    }
}