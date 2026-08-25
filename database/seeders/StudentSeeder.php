<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds for College of Information Technology.
     */
    public function run(): void
    {
        // Ensure storage/app/public/students directory exists
        $studentsDirectory = storage_path('app/public/students');
        if (!File::exists($studentsDirectory)) {
            File::makeDirectory($studentsDirectory, 0755, true);
        }

        // Create sample placeholder avatar image if not present
        $sampleImagePath = $studentsDirectory . '/sample-student.png';
        if (!File::exists($sampleImagePath)) {
            $pngBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';
            File::put($sampleImagePath, base64_decode($pngBase64));
        }

        $sampleStudents = [
            [
                'student_id' => 'CIT-2026-0001',
                'first_name' => 'John Christian',
                'middle_name' => 'Santos',
                'last_name' => 'Dela Cruz',
                'email' => 'jc.delacruz@cit.edu.ph',
                'mobile_number' => '09171234567',
                'gender' => 'Male',
                'date_of_birth' => '2004-03-15',
                'program' => 'Bachelor of Science in Information Technology (BSIT)',
                'year_level' => '1st Year',
                'address' => 'Unit 402 Silicon Heights, Katipunan Ave, Quezon City, Metro Manila',
                'profile_picture' => 'students/sample-student.png',
            ],
            [
                'student_id' => 'CIT-2026-0002',
                'first_name' => 'Maria Sophia',
                'middle_name' => 'Gonzales',
                'last_name' => 'Reyes',
                'email' => 'sophia.reyes@cit.edu.ph',
                'mobile_number' => '09289876543',
                'gender' => 'Female',
                'date_of_birth' => '2003-08-22',
                'program' => 'Bachelor of Science in Computer Science (BSCS)',
                'year_level' => '2nd Year',
                'address' => '12 Acacia St., Valle Verde 5, Pasig City, Metro Manila',
                'profile_picture' => 'students/sample-student.png',
            ],
            [
                'student_id' => 'CIT-2026-0003',
                'first_name' => 'Alexander',
                'middle_name' => 'Villanueva',
                'last_name' => 'Tan',
                'email' => 'alexander.tan@cit.edu.ph',
                'mobile_number' => '09335557788',
                'gender' => 'Male',
                'date_of_birth' => '2002-11-09',
                'program' => 'Bachelor of Science in Cybersecurity (BSCY)',
                'year_level' => '3rd Year',
                'address' => 'Block 8 Lot 14 Maharlika Village, Taguig City, Metro Manila',
                'profile_picture' => 'students/sample-student.png',
            ],
            [
                'student_id' => 'CIT-2026-0004',
                'first_name' => 'Alyssa Nicole',
                'middle_name' => 'Mendoza',
                'last_name' => 'Aquino',
                'email' => 'alyssa.aquino@cit.edu.ph',
                'mobile_number' => '09192223344',
                'gender' => 'Female',
                'date_of_birth' => '2001-05-30',
                'program' => 'Bachelor of Science in Data Science & Analytics (BSDS)',
                'year_level' => '4th Year',
                'address' => '55 Commonwealth Ave, Diliman, Quezon City, Metro Manila',
                'profile_picture' => 'students/sample-student.png',
            ],
        ];

        foreach ($sampleStudents as $data) {
            Student::firstOrCreate(['student_id' => $data['student_id']], $data);
        }
    }
}
