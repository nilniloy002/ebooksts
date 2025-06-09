<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentSubscription;
use App\Models\Ebook;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'std_id' => 'required',
            'password' => 'required',
        ]);

        // Find the student by std_id
        $student = StudentSubscription::where('std_id', $request->std_id)->first();

        if (!$student) {
            return back()->withErrors([
                'std_id' => 'Invalid student ID or password.',
            ]);
        }

        // Check password (plain text, as requested)
        if ($student->password !== $request->password) {
            return back()->withErrors([
                'std_id' => 'Invalid student ID or password.',
            ]);
        }

        // Login the student (using Laravel session)
        session(['student' => $student->id]);

        return redirect()->route('student.dashboard');
    }

    public function logout()
    {
        session()->forget('student');

        return redirect()->route('student.login')->with('success', 'Logged out successfully.');
    }

    // ✅ New method for dashboard
    public function dashboard()
    {
        $studentId = session('student');
        $student = StudentSubscription::findOrFail($studentId);

        // Get all ebooks in desc order
        $ebooks = Ebook::orderBy('id', 'desc')->get();

        return view('student.dashboard', compact('student', 'ebooks'));
    }
}
