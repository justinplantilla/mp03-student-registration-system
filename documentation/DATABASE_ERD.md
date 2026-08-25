# Database Entity Relationship Diagram (ERD)

This document visualizes the table schemas within the `mp03_student_registration` MySQL database. As per the system architecture, the tables operate as **independent, standalone entities without foreign key constraints/relations**.

## Entity Relationship Diagram (Standalone Tables)

```mermaid
erDiagram
    STUDENTS {
        bigint_unsigned id PK "Auto Increment"
        varchar student_id UK "Unique Student ID"
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
        varchar email UK "Unique User Email"
        timestamp email_verified_at "Verification Timestamp"
        varchar password "Hashed Password"
        varchar remember_token "Session Token"
        timestamp created_at "Creation Timestamp"
        timestamp updated_at "Update Timestamp"
    }

    CACHE {
        varchar key PK "Cache Key"
        mediumtext value "Serialized Cache Value"
        integer expiration "Expiration Timestamp"
    }

    JOBS {
        bigint_unsigned id PK "Auto Increment"
        varchar queue "Queue Name"
        longtext payload "Job Payload"
        tinyint_unsigned attempts "Attempts Count"
        unsigned_integer reserved_at "Reserved Timestamp"
        unsigned_integer available_at "Available Timestamp"
        unsigned_integer created_at "Created Timestamp"
    }
```

---

## Architectural Note on Database Relations

In this registration module:
- The **`students`** table functions as a self-contained, standalone entity holding all required personal, academic, contact, and portrait path data.
- No foreign key relationships or join constraints are enforced between `students` and other system tables (`users`, `cache`, `jobs`), ensuring maximum performance, modularity, and simplified data lifecycle management in MySQL Workbench.
