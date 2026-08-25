# Database Schema & Structure

## Database: `mp03_student_registration`

### Table: `students`

| Field | Type | Nullable | Key | Default | Description |
| :--- | :--- | :---: | :---: | :--- | :--- |
| `id` | `BIGINT UNSIGNED` | NO | PRI | Auto Increment | Primary record ID |
| `student_id` | `VARCHAR(255)` | NO | UNI | None | Institutional Student ID number |
| `first_name` | `VARCHAR(100)` | NO | | None | Student given name |
| `middle_name` | `VARCHAR(100)` | YES | | NULL | Optional middle name |
| `last_name` | `VARCHAR(100)` | NO | | None | Student surname |
| `email` | `VARCHAR(255)` | NO | UNI | None | Student institutional / personal email |
| `mobile_number` | `VARCHAR(30)` | NO | | None | Contact mobile number |
| `gender` | `VARCHAR(30)` | NO | | None | Gender identification |
| `date_of_birth` | `DATE` | NO | | None | Birth date |
| `program` | `VARCHAR(150)` | NO | | None | Degree Program |
| `year_level` | `VARCHAR(50)` | NO | | None | Academic Year Level |
| `address` | `TEXT` | NO | | None | Residential street and city address |
| `profile_picture` | `VARCHAR(255)` | NO | | None | Storage relative file path |
| `created_at` | `TIMESTAMP` | YES | | NULL | Record creation timestamp |
| `updated_at` | `TIMESTAMP` | YES | | NULL | Record update timestamp |

---

## SQL Table Creation Query
```sql
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `program` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_student_id_unique` (`student_id`),
  UNIQUE KEY `students_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

