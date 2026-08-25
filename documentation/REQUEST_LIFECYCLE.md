# Laravel Request Lifecycle Diagram

This document details how an HTTP request for student registration moves through the Laravel framework.

## Lifecycle Diagram

```mermaid
sequenceDiagram
    autonumber
    actor Student as Student (Browser)
    participant Route as routes/web.php
    participant Controller as StudentController
    participant Validator as Form Validator
    participant Storage as Laravel Storage Disk
    participant Model as Student (Eloquent Model)
    participant Database as MySQL Database (`students`)
    participant View as Blade View Engine

    Student->>Route: POST /students (Multipart Form Data)
    Route->>Controller: Route dispatch -> StudentController@store
    Controller->>Validator: $request->validate([...])
    
    alt Validation Fails
        Validator-->>Controller: ValidationException ($errors)
        Controller-->>Student: 302 Redirect back to /students/create with Errors & old() input
    else Validation Passes
        Validator-->>Controller: Sanitized & Validated Data Array
        Controller->>Storage: $file->store('students', 'public')
        Storage-->>Controller: Relative Path ('students/hash.png')
        Controller->>Model: Student::create($validatedData)
        Model->>Database: INSERT INTO `students` (...) VALUES (...)
        Database-->>Model: Auto-increment ID & Timestamps
        Model-->>Controller: $student Eloquent Instance
        Controller->>View: 302 Redirect to route('students.show', $student) with flash('success')
        View-->>Student: Render HTML (Digital Student ID & Profile View)
    end
```

---

## Step-by-Step Explanation

1. **Browser (Client Request)**:
   - The student fills out the registration form in `students/create.blade.php` and submits multipart form data containing textual data and the profile photo file.
2. **Routing Layer (`routes/web.php`)**:
   - The request hits `POST /students`, matched against the named route `students.store`, invoking `StudentController@store`.
3. **Controller (`StudentController@store`)**:
   - Receives the incoming `Illuminate\Http\Request` instance.
4. **Validation Layer**:
   - Executes validation rules against every input. If any rule fails, a `ValidationException` is thrown, halting execution and redirecting back with `$errors` and `old()` inputs.
5. **Storage Subsystem**:
   - Upon successful validation, the uploaded image file is hashed and saved under `storage/app/public/students/`.
6. **Eloquent Model (`Student.php`)**:
   - The validated attributes and image path are mass-assigned to the `Student` model.
7. **MySQL Database**:
   - Eloquent generates a parameterized `INSERT` query into the `students` table.
8. **HTTP Response & Blade Engine**:
   - Controller redirects to `students.show` with flash session data. The Blade engine renders the student's profile and digital ID badge.
