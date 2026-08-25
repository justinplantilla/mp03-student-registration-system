<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Program list constant for consistency across the application.
     */
    public const PROGRAMS = [
        'Bachelor of Science in Information Technology (BSIT)',
        'Bachelor of Science in Computer Science (BSCS)',
        'Bachelor of Science in Information Systems (BSIS)',
        'Bachelor of Science in Cybersecurity (BSCY)',
        'Bachelor of Science in Data Science & Analytics (BSDS)',
    ];

    /**
     * Year levels list constant.
     */
    public const YEAR_LEVELS = [
        '1st Year',
        '2nd Year',
        '3rd Year',
        '4th Year',
    ];

    /**
     * Gender options list constant.
     */
    public const GENDERS = [
        'Male',
        'Female',
        'Non-Binary',
        'Prefer not to say',
        'Other',
    ];

    /**
     * Display a listing of registered students.
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search filter (ID, name, email)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('student_id', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%");
            });
        }

        // Program filter
        if ($program = $request->input('program')) {
            $query->where('program', $program);
        }

        // Year level filter
        if ($yearLevel = $request->input('year_level')) {
            $query->where('year_level', $yearLevel);
        }

        $students = $query->latest()->paginate(9)->withQueryString();

        $stats = [
            'total' => Student::count(),
            'programs_count' => Student::distinct('program')->count('program'),
            'freshmen_count' => Student::where('year_level', '1st Year')->count(),
            'recent_count' => Student::where('created_at', '>=', now()->subDays(7))->count(),
        ];

        return view('students.index', [
            'students' => $students,
            'stats' => $stats,
            'programs' => self::PROGRAMS,
            'yearLevels' => self::YEAR_LEVELS,
            'filters' => $request->only(['search', 'program', 'year_level']),
        ]);
    }

    /**
     * Show the form for creating a new student registration.
     */
    public function create()
    {
        return view('students.create', [
            'programs' => self::PROGRAMS,
            'yearLevels' => self::YEAR_LEVELS,
            'genders' => self::GENDERS,
        ]);
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => 'required|string|max:50|unique:students,student_id',
            'first_name'      => 'required|string|max:100',
            'middle_name'     => 'nullable|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => 'required|email|max:255|unique:students,email',
            'mobile_number'   => 'required|numeric|digits_between:7,15',
            'date_of_birth'   => 'required|date|before:today',
            'gender'          => 'required|string|in:' . implode(',', self::GENDERS),
            'program'         => 'required|string|max:150',
            'year_level'      => 'required|string|max:50',
            'address'         => 'required|string|max:500',
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'student_id.required'      => 'Please provide the student ID number.',
            'student_id.unique'        => 'This Student ID has already been registered.',
            'first_name.required'      => 'First name is required.',
            'last_name.required'       => 'Last name is required.',
            'email.required'           => 'A valid email address is required.',
            'email.email'              => 'Please enter a valid email format.',
            'email.unique'             => 'This email address is already in use by another student.',
            'mobile_number.required'   => 'Mobile number is required.',
            'mobile_number.numeric'    => 'Mobile number must only contain numbers.',
            'mobile_number.digits_between' => 'Mobile number must be between 7 and 15 digits.',
            'date_of_birth.required'   => 'Date of birth is required.',
            'date_of_birth.before'     => 'Date of birth must be a past date.',
            'gender.required'          => 'Please select a gender.',
            'program.required'         => 'Please select a degree program.',
            'year_level.required'      => 'Please select a year level.',
            'address.required'         => 'Complete residential address is required.',
            'profile_picture.required' => 'A student profile picture is required.',
            'profile_picture.image'    => 'The profile picture file must be an image.',
            'profile_picture.mimes'    => 'The profile picture must be a file of type: JPG, JPEG, or PNG.',
            'profile_picture.max'      => 'The profile picture size must not exceed 2MB.',
        ]);

        // Upload and store the profile picture in storage/app/public/students
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('students', 'public');
            $validated['profile_picture'] = $path;
        }

        // Create student record
        $student = Student::create($validated);

        // Redirect to student preview page with success notification
        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student registered successfully!');
    }

    /**
     * Display the specified registered student.
     */
    public function show(Student $student)
    {
        return view('students.show', [
            'student' => $student,
        ]);
    }
}

