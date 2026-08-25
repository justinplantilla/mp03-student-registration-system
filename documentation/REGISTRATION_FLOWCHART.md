# Student Registration Flowchart

This document details the operational workflow of a student registering online in the system.

## Flowchart Diagram

```mermaid
flowchart TD
    Start([User Opens Web Browser]) --> OpenPage[Navigate to GET /register]
    OpenPage --> RenderForm[System Renders Registration Form]
    RenderForm --> FillForm[User Enters Student Info & Selects Photo]
    FillForm --> PreviewPhoto[Client-side Live Photo Preview]
    PreviewPhoto --> SubmitForm[User Clicks 'Register Student' Button]
    SubmitForm --> PostRequest[HTTP POST /students with CSRF Token & Multipart Data]
    PostRequest --> ValidateData{Validate All Required Fields & Rules?}
    
    ValidateData -- No (Validation Failed) --> FlashError[Populate Session $errors & Preserve old Input]
    FlashError --> RedirectBack[Redirect 302 back to /students/create]
    RedirectBack --> RenderForm
    
    ValidateData -- Yes (Valid Data) --> SaveImage[Store Profile Photo to storage/app/public/students]
    SaveImage --> SaveDB[Insert Student Record into MySQL Database]
    SaveDB --> FlashSuccess[Set Session Flash: 'Student registered successfully!']
    FlashSuccess --> RedirectShow[Redirect 302 to GET /students/{id}]
    RedirectShow --> RenderIDCard[Render Digital Student ID Card & Profile Preview]
    RenderIDCard --> End([Registration Complete / Print Profile])
```

---

## Detailed Process Narrative

1. **Accessing the Portal**: The student visits `http://localhost:8000/register` or `http://localhost:8000/`.
2. **Form Interaction**: The student inputs personal details, contact coordinates, academic program, and attaches a portrait photo.
3. **Live Preview**: JavaScript immediately updates the 2x2 preview box before sending data over the network.
4. **Validation Check**:
   - **Invalid Path**: If any field fails validation (e.g. invalid email format, duplicate student ID, missing fields, oversized image), Laravel redirects back to the form with red alert styling and descriptive error messages.
   - **Valid Path**: The image is saved to the public storage disk, a new row is created in the `students` table, and the user is redirected to their digital ID card preview.

