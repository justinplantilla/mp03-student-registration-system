@extends('layouts.app')

@section('title', 'Student Registration Form')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header & Welcome Banner -->
    <div class="mb-8 bg-gradient-to-r from-brand-900 via-indigo-900 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
            <i class="fa-solid fa-laptop-code text-9xl"></i>
        </div>
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/20 text-brand-200 border border-brand-400/30 text-xs font-semibold uppercase tracking-wider mb-3">
                <i class="fa-solid fa-graduation-cap"></i> College of Information Technology
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Student Online Registration</h1>
            <p class="text-slate-300 text-sm sm:text-base mt-2 max-w-2xl">
                Please complete the digital registration form below with accurate information. Make sure to upload a clear portrait photo for your student ID profile.
            </p>
        </div>
    </div>

    <!-- Main Registration Form Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-10" novalidate>
            @csrf

            <!-- Section 1: Personal Information -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-brand-100 text-brand-600 flex items-center justify-center font-bold text-sm">
                        1
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Personal Information</h2>
                        <p class="text-xs text-slate-500">Official identification details as stated on civil registry documents</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    
                    <!-- Student ID -->
                    <div class="sm:col-span-3 lg:col-span-1">
                        <label for="student_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Student ID Number <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-id-badge text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="student_id" 
                                   id="student_id" 
                                   value="{{ old('student_id') }}"
                                   placeholder="e.g. 2026-00101-IT" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('student_id') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                   required>
                        </div>
                        @error('student_id')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="lg:col-span-1">
                        <label for="first_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            First Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="first_name" 
                                   id="first_name" 
                                   value="{{ old('first_name') }}"
                                   placeholder="e.g. Maria" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('first_name') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                   required>
                        </div>
                        @error('first_name')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Middle Name -->
                    <div class="lg:col-span-1">
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="middle_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                Middle Name
                            </label>
                            <span class="text-[10px] text-slate-400 font-medium">Optional</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="middle_name" 
                                   id="middle_name" 
                                   value="{{ old('middle_name') }}"
                                   placeholder="e.g. Santos" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('middle_name') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2">
                        </div>
                        @error('middle_name')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="lg:col-span-1">
                        <label for="last_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Last Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="last_name" 
                                   id="last_name" 
                                   value="{{ old('last_name') }}"
                                   placeholder="e.g. Dela Cruz" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('last_name') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                   required>
                        </div>
                        @error('last_name')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="lg:col-span-1">
                        <label for="date_of_birth" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Date of Birth <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-calendar-days text-sm"></i>
                            </div>
                            <input type="date" 
                                   name="date_of_birth" 
                                   id="date_of_birth" 
                                   value="{{ old('date_of_birth') }}"
                                   max="{{ now()->format('Y-m-d') }}"
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('date_of_birth') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                   required>
                        </div>
                        @error('date_of_birth')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="lg:col-span-1">
                        <label for="gender" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Gender <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-venus-mars text-sm"></i>
                            </div>
                            <select name="gender" 
                                    id="gender" 
                                    class="w-full pl-10 pr-8 py-2.5 rounded-xl text-sm border {{ $errors->has('gender') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                    required>
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                                @foreach ($genders as $genderOption)
                                    <option value="{{ $genderOption }}" {{ old('gender') === $genderOption ? 'selected' : '' }}>
                                        {{ $genderOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('gender')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Section 2: Academic Program Information -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                        2
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Academic Information</h2>
                        <p class="text-xs text-slate-500">Degree program enrollment and current academic standing</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Degree Program -->
                    <div>
                        <label for="program" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Degree Program <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-book-bookmark text-sm"></i>
                            </div>
                            <select name="program" 
                                    id="program" 
                                    class="w-full pl-10 pr-8 py-2.5 rounded-xl text-sm border {{ $errors->has('program') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                    required>
                                <option value="" disabled {{ old('program') ? '' : 'selected' }}>Select Academic Program</option>
                                @foreach ($programs as $prog)
                                    <option value="{{ $prog }}" {{ old('program') === $prog ? 'selected' : '' }}>
                                        {{ $prog }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('program')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Year Level -->
                    <div>
                        <label for="year_level" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Year Level <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-layer-group text-sm"></i>
                            </div>
                            <select name="year_level" 
                                    id="year_level" 
                                    class="w-full pl-10 pr-8 py-2.5 rounded-xl text-sm border {{ $errors->has('year_level') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                    required>
                                <option value="" disabled {{ old('year_level') ? '' : 'selected' }}>Select Year Level</option>
                                @foreach ($yearLevels as $level)
                                    <option value="{{ $level }}" {{ old('year_level') === $level ? 'selected' : '' }}>
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('year_level')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 3: Contact & Address Information -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm">
                        3
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Contact & Residential Address</h2>
                        <p class="text-xs text-slate-500">Contact coordinates for university correspondence and emergency notices</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}"
                                   placeholder="student@university.edu.ph" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('email') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                   required>
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Mobile Number -->
                    <div>
                        <label for="mobile_number" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Mobile Number <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-phone text-sm"></i>
                            </div>
                            <input type="tel" 
                                   name="mobile_number" 
                                   id="mobile_number" 
                                   value="{{ old('mobile_number') }}"
                                   placeholder="09123456789" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('mobile_number') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2"
                                   required>
                        </div>
                        @error('mobile_number')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Residential Address -->
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Complete Residential Address <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <textarea name="address" 
                                      id="address" 
                                      rows="3" 
                                      placeholder="House/Unit No., Street Name, Barangay, City/Municipality, Province, Postal Code" 
                                      class="w-full p-3.5 rounded-xl text-sm border {{ $errors->has('address') ? 'border-rose-300 bg-rose-50/50 text-rose-900 focus:ring-rose-500 focus:border-rose-500' : 'border-slate-200 bg-slate-50/50 text-slate-900 focus:bg-white focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-xs focus:ring-2 resize-none"
                                      required>{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 4: Profile Picture Upload -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm">
                        4
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Student Profile Photo</h2>
                        <p class="text-xs text-slate-500">Upload a formal 2x2 portrait photo for the digital student ID card (Max 2MB, JPG/PNG)</p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row items-center gap-6">
                    <!-- Photo Preview Box -->
                    <div class="flex-shrink-0 flex flex-col items-center">
                        <div class="w-32 h-32 rounded-2xl bg-slate-100 border-2 border-dashed {{ $errors->has('profile_picture') ? 'border-rose-300' : 'border-slate-300' }} flex items-center justify-center overflow-hidden relative shadow-inner group">
                            <img id="image-preview" src="#" alt="Profile Preview" class="w-full h-full object-cover hidden">
                            <div id="image-placeholder" class="text-center p-3">
                                <i class="fa-solid fa-user-astronaut text-3xl text-slate-400 mb-1"></i>
                                <span class="block text-[11px] text-slate-400 font-medium">No Photo</span>
                            </div>
                        </div>
                        <span class="text-[11px] text-slate-400 mt-1.5 font-medium">2x2 Preview</span>
                    </div>

                    <!-- Upload Input Zone -->
                    <div class="flex-1 w-full">
                        <div class="relative">
                            <label for="profile_picture" class="flex flex-col items-center justify-center w-full p-5 border-2 border-dashed {{ $errors->has('profile_picture') ? 'border-rose-300 bg-rose-50/20' : 'border-slate-300 bg-slate-50 hover:bg-slate-100/70 hover:border-brand-400' }} rounded-2xl cursor-pointer transition">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-brand-600 mb-2"></i>
                                    <p class="text-sm font-semibold text-slate-700">
                                        <span class="text-brand-600 hover:underline">Click to upload photo</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">PNG, JPG, or JPEG format (Up to 2MB)</p>
                                    <span id="selected-file-name" class="mt-2 text-xs font-semibold text-brand-700 bg-brand-50 px-2.5 py-1 rounded-full hidden"></span>
                                </div>
                                <input type="file" 
                                       name="profile_picture" 
                                       id="profile_picture" 
                                       accept="image/jpeg,image/png,image/jpg" 
                                       class="sr-only" 
                                       onchange="handleImagePreview(this)"
                                       required>
                            </label>
                        </div>
                        @error('profile_picture')
                            <p class="mt-2 text-xs text-rose-600 flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions & Submission -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('students.index') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold transition text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Cancel & Directory</span>
                </a>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="reset" onclick="resetImagePreview()" class="w-1/2 sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold transition text-center">
                        Clear Fields
                    </button>

                    <button type="submit" class="w-1/2 sm:w-auto px-7 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 text-white text-sm font-bold shadow-md shadow-brand-500/25 hover:shadow-lg hover:shadow-brand-500/35 active:scale-[0.98] transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Register Student</span>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function handleImagePreview(input) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');
        const fileNameSpan = document.getElementById('selected-file-name');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                
                fileNameSpan.textContent = file.name + ' (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)';
                fileNameSpan.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            resetImagePreview();
        }
    }

    function resetImagePreview() {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');
        const fileNameSpan = document.getElementById('selected-file-name');
        const input = document.getElementById('profile_picture');

        preview.src = '#';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        fileNameSpan.textContent = '';
        fileNameSpan.classList.add('hidden');
        if (input) input.value = '';
    }
</script>
@endpush

