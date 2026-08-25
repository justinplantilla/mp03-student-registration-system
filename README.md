# Student Registration System – College of Information Technology

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)

> **Mini Project MP03**  
> Developed by: **Justin Plantilla** ([@justinplantilla](https://github.com/justinplantilla))

---

## 📌 Project Scenario
The **College of Information Technology** is transitioning from a traditional paper-based student registration process to a modern, digital registration system. As a Junior Laravel Developer, this module was developed to enable students to register online while ensuring that all submitted information is strictly validated, secure, and stored correctly in a **MySQL** database alongside file storage for student ID portraits.

---

## 🚀 Key Features

- **Online Student Registration**: Clean, responsive form organized into 4 logical groupings (Personal Info, Academic Info, Contact/Address, Photo Upload).
- **Profile Picture Upload**: Secure image processing and storage via Laravel Storage (`storage/app/public/students`) with public symlink integration.
- **Client-Side Live Image Preview**: Real-time image preview before submitting the form.
- **Strict Server-Side Validation**: Robust validation rules for required fields, unique constraints (`student_id`, `email`), numerical mobile numbers, past date-of-birth, and image mime types.
- **Flash Notifications & Inline Errors**: Celebratory dismissible success banners and field-level red border error feedback.
- **Digital Student ID Card**: Visual ID badge card preview with student details, barcode simulation, and print option (`window.print()`).
- **Student Records Directory**: Searchable registry with degree program & year level filters, enrollment statistics, and responsive tables.
- **Automated Feature Test Suite**: 100% test coverage with PHPUnit feature tests.

---

## 📂 Repository Structure

```
mp03-student-registration-system/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── StudentController.php       # Controller with index, create, store, show
│   └── Models/
│       └── Student.php                     # Eloquent model with accessors and casting
│
├── database/
│   ├── migrations/
│   │   └── 2026_08_25_000000_create_students_table.php  # Students table migration
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── StudentSeeder.php               # Demo student records seeder
│
├── documentation/
│   ├── SYSTEM_ARCHITECTURE.md              # Architecture diagram & component overview
│   ├── DATABASE_SCHEMA.md                  # Table structure & SQL scripts
│   └── VALIDATION_RULES.md                 # Validation constraints specification
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Master layout with Tailwind & Flash alerts
│       └── students/
│           ├── create.blade.php            # Registration form with live preview
│           ├── show.blade.php              # Digital Student ID card & profile view
│           └── index.blade.php             # Student directory with search & filters
│
├── routes/
│   └── web.php                             # Named routes configuration
│
├── screenshots/
│   └── README.md                           # UI screenshot inventory guide
│
├── storage/
│   └── app/public/students/                # Stored student profile images
│
├── tests/
│   └── Feature/
│       └── StudentRegistrationTest.php     # Feature tests covering all requirements
│
└── README.md                               # Project documentation
```

---

## 📋 Required Student Information & Validation Rules

| Field | Validation Rules | Description |
| :--- | :--- | :--- |
| `student_id` | `required\|string\|max:50\|unique:students,student_id` | Institutional ID (e.g. `CIT-2026-0001`) |
| `first_name` | `required\|string\|max:100` | Given name |
| `middle_name` | `nullable\|string\|max:100` | Optional middle name |
| `last_name` | `required\|string\|max:100` | Surname |
| `email` | `required\|email\|max:255\|unique:students,email` | Institutional / personal email |
| `mobile_number` | `required\|numeric\|digits_between:7,15` | Numeric mobile contact |
| `date_of_birth` | `required\|date\|before:today` | Date of birth (past date) |
| `gender` | `required\|string\|in:Male,Female,Non-Binary,...` | Gender option |
| `program` | `required\|string\|max:150` | Enrolled degree program |
| `year_level` | `required\|string\|max:50` | Year standing (1st, 2nd, 3rd, 4th Year) |
| `address` | `required\|string\|max:500` | Complete residential address |
| `profile_picture` | `required\|image\|mimes:jpg,jpeg,png\|max:2048` | Photo portrait under 2MB |

---

## 🛠️ Installation & Setup Guide

### 1. Clone the Repository
```bash
git clone https://github.com/justinplantilla/mp03-student-registration-system.git
cd mp03-student-registration-system
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Environment Configuration
Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Configure your **MySQL Database** credentials in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mp03_student_registration
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### 4. Create Database in MySQL Workbench
In MySQL Workbench, execute:
```sql
CREATE DATABASE IF NOT EXISTS mp03_student_registration;
```

### 5. Run Database Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 6. Create Public Storage Symlink
```bash
php artisan storage:link
```

### 7. Run the Application
```bash
php artisan serve
```

Access the application in your browser:
- **Registration Form**: [http://localhost:8000/register](http://localhost:8000/register)
- **Student Directory**: [http://localhost:8000/students](http://localhost:8000/students)

---

## 🧪 Automated Testing

Execute the test suite using PHPUnit / Pest:
```bash
php artisan test
```

### Test Coverage:
- Form render check (`GET /students/create`)
- All required field validation checks
- Invalid email, mobile, and non-image error checks
- Unique constraint checks (`student_id` & `email`)
- File upload & storage insertion check
- Flash message session check
- Registered student profile view check (`GET /students/{student}`)
- Directory search & filter check (`GET /students`)

---

## 👤 Author
**Justin Plantilla**  
- GitHub: [@justinplantilla](https://github.com/justinplantilla)
