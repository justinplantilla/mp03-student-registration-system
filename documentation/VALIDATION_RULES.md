# Validation Rules & Constraints

## Overview
All registration requests undergo strict validation via the `StudentController::store()` method before data persistence and storage operations.

| Field | Rules | Custom Error Message |
| :--- | :--- | :--- |
| `student_id` | `required\|string\|max:50\|unique:students,student_id` | "Please provide the student ID number." / "This Student ID has already been registered." |
| `first_name` | `required\|string\|max:100` | "First name is required." |
| `middle_name`| `nullable\|string\|max:100` | Optional field |
| `last_name`  | `required\|string\|max:100` | "Last name is required." |
| `email`      | `required\|email\|max:255\|unique:students,email` | "A valid email address is required." / "This email address is already in use." |
| `mobile_number` | `required\|numeric\|digits_between:7,15` | "Mobile number is required." / "Mobile number must only contain numbers." |
| `date_of_birth` | `required\|date\|before:today` | "Date of birth is required." / "Date of birth must be a past date." |
| `gender`     | `required\|string\|in:Male,Female,Non-Binary,...` | "Please select a gender." |
| `program`    | `required\|string\|max:150` | "Please select a degree program." |
| `year_level` | `required\|string\|max:50` | "Please select a year level." |
| `address`    | `required\|string\|max:500` | "Complete residential address is required." |
| `profile_picture` | `required\|image\|mimes:jpg,jpeg,png\|max:2048` | "A student profile picture is required." / "Must be JPG, JPEG, or PNG up to 2MB." |

