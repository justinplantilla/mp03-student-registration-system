<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper to create a valid fake image file without requiring GD extension.
     */
    protected function createFakeImage(string $filename = 'test_image.png'): UploadedFile
    {
        // 1x1 transparent PNG base64 decoded
        $pngBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';
        return UploadedFile::fake()->createWithContent($filename, base64_decode($pngBase64));
    }

    public function test_registration_form_can_be_rendered(): void
    {
        $response = $this->get(route('students.create'));

        $response->assertStatus(200);
        $response->assertSee('Student Online Registration');
        $response->assertSee('Student ID Number');
        $response->assertSee('First Name');
        $response->assertSee('Last Name');
        $response->assertSee('Email Address');
        $response->assertSee('Degree Program');
        $response->assertSee('Year Level');
    }

    public function test_validation_errors_when_required_fields_are_missing(): void
    {
        $response = $this->post(route('students.store'), []);

        $response->assertSessionHasErrors([
            'student_id',
            'first_name',
            'last_name',
            'email',
            'mobile_number',
            'date_of_birth',
            'gender',
            'program',
            'year_level',
            'address',
            'profile_picture',
        ]);
    }

    public function test_validation_errors_for_invalid_email_and_mobile(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->post(route('students.store'), [
            'student_id' => 'CIT-2026-0001',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'invalid-email-string',
            'mobile_number' => 'not-a-number',
            'date_of_birth' => '2099-01-01', // Future date
            'gender' => 'Male',
            'program' => 'Bachelor of Science in Information Technology (BSIT)',
            'year_level' => '1st Year',
            'address' => 'Sample Address',
            'profile_picture' => $file, // Non-image file
        ]);

        $response->assertSessionHasErrors([
            'email',
            'mobile_number',
            'date_of_birth',
            'profile_picture',
        ]);
    }

    public function test_validation_requires_unique_student_id_and_email(): void
    {
        Student::create([
            'student_id' => 'CIT-2026-0001',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'mobile_number' => '09123456789',
            'gender' => 'Female',
            'date_of_birth' => '2004-05-15',
            'program' => 'Bachelor of Science in Information Technology (BSIT)',
            'year_level' => '1st Year',
            'address' => '123 University Ave',
            'profile_picture' => 'students/sample.jpg',
        ]);

        Storage::fake('public');
        $image = $this->createFakeImage('avatar.png');

        $response = $this->post(route('students.store'), [
            'student_id' => 'CIT-2026-0001', // Duplicate ID
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jane.smith@example.com', // Duplicate Email
            'mobile_number' => '09987654321',
            'gender' => 'Male',
            'date_of_birth' => '2003-08-20',
            'program' => 'Bachelor of Science in Computer Science (BSCS)',
            'year_level' => '2nd Year',
            'address' => '456 Campus Blvd',
            'profile_picture' => $image,
        ]);

        $response->assertSessionHasErrors(['student_id', 'email']);
    }

    public function test_student_can_be_registered_with_profile_picture_upload(): void
    {
        Storage::fake('public');
        $image = $this->createFakeImage('profile_pic.png');

        $postData = [
            'student_id' => 'CIT-2026-0002',
            'first_name' => 'Alex',
            'middle_name' => 'Morgan',
            'last_name' => 'Reyes',
            'email' => 'alex.reyes@example.com',
            'mobile_number' => '09171234567',
            'date_of_birth' => '2004-10-12',
            'gender' => 'Male',
            'program' => 'Bachelor of Science in Information Technology (BSIT)',
            'year_level' => '1st Year',
            'address' => 'Block 5 Lot 12 Emerald St, Pasig City',
            'profile_picture' => $image,
        ];

        $response = $this->post(route('students.store'), $postData);

        // Assert database record exists
        $this->assertDatabaseHas('students', [
            'student_id' => 'CIT-2026-0002',
            'first_name' => 'Alex',
            'middle_name' => 'Morgan',
            'last_name' => 'Reyes',
            'email' => 'alex.reyes@example.com',
            'mobile_number' => '09171234567',
            'gender' => 'Male',
            'program' => 'Bachelor of Science in Information Technology (BSIT)',
            'year_level' => '1st Year',
        ]);

        $student = Student::where('student_id', 'CIT-2026-0002')->first();
        $this->assertNotNull($student);

        // Assert storage has the uploaded file
        Storage::disk('public')->assertExists($student->profile_picture);

        // Assert redirect to student show page with success notification flash
        $response->assertRedirect(route('students.show', $student));
        $response->assertSessionHas('success', 'Student registered successfully!');
    }

    public function test_registered_student_details_can_be_viewed(): void
    {
        $student = Student::create([
            'student_id' => 'CIT-2026-0003',
            'first_name' => 'Carlos',
            'middle_name' => 'D.',
            'last_name' => 'Mendoza',
            'email' => 'carlos.mendoza@example.com',
            'mobile_number' => '09223344556',
            'gender' => 'Male',
            'date_of_birth' => '2003-03-25',
            'program' => 'Bachelor of Science in Cybersecurity (BSCY)',
            'year_level' => '3rd Year',
            'address' => '789 Tech Hub Lane, Quezon City',
            'profile_picture' => 'students/sample.jpg',
        ]);

        $response = $this->get(route('students.show', $student));

        $response->assertStatus(200);
        $response->assertSee('CIT-2026-0003');
        $response->assertSee('Carlos D. Mendoza');
        $response->assertSee('carlos.mendoza@example.com');
        $response->assertSee('Bachelor of Science in Cybersecurity (BSCY)');
        $response->assertSee('3rd Year');
    }

    public function test_student_directory_renders_and_filters(): void
    {
        Student::create([
            'student_id' => 'CIT-2026-0010',
            'first_name' => 'Samantha',
            'last_name' => 'Cruz',
            'email' => 'samantha.cruz@example.com',
            'mobile_number' => '09331122334',
            'gender' => 'Female',
            'date_of_birth' => '2005-01-01',
            'program' => 'Bachelor of Science in Computer Science (BSCS)',
            'year_level' => '1st Year',
            'address' => 'Taguig City',
            'profile_picture' => 'students/sample.jpg',
        ]);

        $response = $this->get(route('students.index'));
        $response->assertStatus(200);
        $response->assertSee('Samantha Cruz');
        $response->assertSee('CIT-2026-0010');

        // Test search filter
        $searchResponse = $this->get(route('students.index', ['search' => 'Samantha']));
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Samantha Cruz');

        // Test non-matching search
        $emptyResponse = $this->get(route('students.index', ['search' => 'NonExistentStudent']));
        $emptyResponse->assertStatus(200);
        $emptyResponse->assertSee('No student records found');
    }
}

