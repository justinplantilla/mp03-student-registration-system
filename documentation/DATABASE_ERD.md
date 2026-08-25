# Database Entity Relationship Diagram (ERD)

This document visualizes the database structure and relational entities within the `mp03_student_registration` database.

## Entity Relationship Diagram

```mermaid
erDiagram
    STUDENTS {
        bigint_unsigned id PK "Auto Increment"
        varchar student_id UK "Unique Student ID Number"
        varchar first_name "Given First Name (max 100)"
        varchar middle_name "Optional Middle Name (max 100)"
        varchar last_name "Family Surname (max 100)"
        varchar email UK "Unique Institutional/Personal Email"
        varchar mobile_number "Contact Number (7-15 digits)"
        varchar gender "Gender (Male/Female/Other)"
        date date_of_birth "Birth Date"
        varchar program "Academic Degree Program"
        varchar year_level "Academic Year Level"
        text address "Residential Street Address"
        varchar profile_picture "Storage Relative Path"
        timestamp created_at "Record Creation Timestamp"
        timestamp updated_at "Record Update Timestamp"
    }

    USERS {
        bigint_unsigned id PK "Auto Increment"
        varchar name "User Name"
        varchar email UK "User Email"
        timestamp email_verified_at "Verification Timestamp"
        varchar password "Hashed Password"
        varchar remember_token "Session Token"
        timestamp created_at "Creation Timestamp"
        timestamp updated_at "Update Timestamp"
    }

    SESSIONS {
        varchar id PK "Session ID"
        bigint_unsigned user_id FK "Nullable User ID"
        varchar ip_address "Client IP Address"
        text user_agent "Client Browser User Agent"
        longtext payload "Encrypted Session Data"
        integer last_activity "Last Activity Unix Timestamp"
    }

    USERS ||--o{ SESSIONS : "owns"
```

---

## Field Specifications & Keys

- **Primary Key (`PK`)**: `students.id` uniquely indexes each record.
- **Unique Keys (`UK`)**:
  - `students.student_id`: Prevents duplicate enrollment records.
  - `students.email`: Enforces email uniqueness across all students.
- **Storage Path**: `students.profile_picture` references the file saved under `storage/app/public/students/`.
