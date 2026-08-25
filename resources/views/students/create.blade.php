@extends('layouts.app')

@section('title', 'Student Registration Form')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header & Welcome Banner -->
    <div class="mb-8 bg-gradient-to-r from-zinc-900 via-black to-zinc-900 rounded-3xl p-6 sm:p-8 text-white shadow-2xl border border-zinc-800 relative overflow-hidden">
        <!-- Red Accent Glow Background -->
        <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-brand-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-700 via-brand-500 to-red-600"></div>

        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-950/80 text-brand-400 border border-brand-800/80 text-xs font-bold uppercase tracking-wider mb-3">
                <i class="fa-solid fa-graduation-cap"></i> College of Information Technology
            </div>
            <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">Student Online Registration</h1>
            <p class="text-zinc-400 text-sm sm:text-base mt-2 max-w-2xl">
                The College of Information Technology is transitioning from paper-based registration to a digital system. Please complete the form below with valid information and attach your profile photo.
            </p>
        </div>
    </div>

    <!-- Main Registration Form Card -->
    <div class="bg-zinc-900/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-zinc-800/90 overflow-hidden">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-10" novalidate>
            @csrf

            <!-- Section 1: Personal Information -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-zinc-800">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center font-black text-sm shadow-md shadow-brand-950">
                        1
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Personal Information</h2>
                        <p class="text-xs text-zinc-400">Official student identification details as stated on civil registry documents</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    
                    <!-- Student ID -->
                    <div class="sm:col-span-3 lg:col-span-1">
                        <label for="student_id" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Student ID Number <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-id-badge text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="student_id" 
                                   id="student_id" 
                                   value="{{ old('student_id') }}"
                                   placeholder="e.g. CIT-2026-0001" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('student_id') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                   required>
                        </div>
                        @error('student_id')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="lg:col-span-1">
                        <label for="first_name" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            First Name <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="first_name" 
                                   id="first_name" 
                                   value="{{ old('first_name') }}"
                                   placeholder="e.g. John" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('first_name') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                   required>
                        </div>
                        @error('first_name')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Middle Name -->
                    <div class="lg:col-span-1">
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="middle_name" class="block text-xs font-bold uppercase tracking-wider text-zinc-300">
                                Middle Name
                            </label>
                            <span class="text-[10px] text-zinc-500 font-medium">Optional</span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="middle_name" 
                                   id="middle_name" 
                                   value="{{ old('middle_name') }}"
                                   placeholder="e.g. Santos" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('middle_name') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2">
                        </div>
                        @error('middle_name')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="lg:col-span-1">
                        <label for="last_name" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Last Name <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-user text-sm"></i>
                            </div>
                            <input type="text" 
                                   name="last_name" 
                                   id="last_name" 
                                   value="{{ old('last_name') }}"
                                   placeholder="e.g. Dela Cruz" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('last_name') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                   required>
                        </div>
                        @error('last_name')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="lg:col-span-1">
                        <label for="date_of_birth" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Date of Birth <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-calendar-days text-sm"></i>
                            </div>
                            <input type="date" 
                                   name="date_of_birth" 
                                   id="date_of_birth" 
                                   value="{{ old('date_of_birth') }}"
                                   max="{{ now()->format('Y-m-d') }}"
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('date_of_birth') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                   required>
                        </div>
                        @error('date_of_birth')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="lg:col-span-1">
                        <label for="gender" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Gender <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-venus-mars text-sm"></i>
                            </div>
                            <select name="gender" 
                                    id="gender" 
                                    class="w-full pl-10 pr-8 py-2.5 rounded-xl text-sm border {{ $errors->has('gender') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                    required>
                                <option value="" disabled {{ old('gender') ? '' : 'selected' }} class="bg-zinc-900 text-zinc-400">Select Gender</option>
                                @foreach ($genders as $genderOption)
                                    <option value="{{ $genderOption }}" {{ old('gender') === $genderOption ? 'selected' : '' }} class="bg-zinc-900 text-white">
                                        {{ $genderOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('gender')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Section 2: Academic Program Information -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-zinc-800">
                    <div class="w-8 h-8 rounded-lg bg-zinc-800 text-brand-500 border border-brand-500/30 flex items-center justify-center font-black text-sm shadow-md">
                        2
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Academic Information</h2>
                        <p class="text-xs text-zinc-400">Degree program enrollment and current academic year level</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Degree Program -->
                    <div>
                        <label for="program" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Degree Program <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-book-bookmark text-sm"></i>
                            </div>
                            <select name="program" 
                                    id="program" 
                                    class="w-full pl-10 pr-8 py-2.5 rounded-xl text-sm border {{ $errors->has('program') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                    required>
                                <option value="" disabled {{ old('program') ? '' : 'selected' }} class="bg-zinc-900 text-zinc-400">Select Degree Program</option>
                                @foreach ($programs as $prog)
                                    <option value="{{ $prog }}" {{ old('program') === $prog ? 'selected' : '' }} class="bg-zinc-900 text-white">
                                        {{ $prog }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('program')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Year Level -->
                    <div>
                        <label for="year_level" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Year Level <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-layer-group text-sm"></i>
                            </div>
                            <select name="year_level" 
                                    id="year_level" 
                                    class="w-full pl-10 pr-8 py-2.5 rounded-xl text-sm border {{ $errors->has('year_level') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                    required>
                                <option value="" disabled {{ old('year_level') ? '' : 'selected' }} class="bg-zinc-900 text-zinc-400">Select Year Level</option>
                                @foreach ($yearLevels as $level)
                                    <option value="{{ $level }}" {{ old('year_level') === $level ? 'selected' : '' }} class="bg-zinc-900 text-white">
                                        {{ $level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('year_level')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 3: Contact & Address Information -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-zinc-800">
                    <div class="w-8 h-8 rounded-lg bg-zinc-800 text-brand-500 border border-brand-500/30 flex items-center justify-center font-black text-sm shadow-md">
                        3
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Contact & Residential Address</h2>
                        <p class="text-xs text-zinc-400">Contact coordinates for university correspondence and emergency notices</p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Email Address <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </div>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}"
                                   placeholder="student@cit.edu.ph" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('email') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                   required>
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Mobile Number -->
                    <div>
                        <label for="mobile_number" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Mobile Number <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                                <i class="fa-solid fa-phone text-sm"></i>
                            </div>
                            <input type="tel" 
                                   name="mobile_number" 
                                   id="mobile_number" 
                                   value="{{ old('mobile_number') }}"
                                   placeholder="09123456789" 
                                   class="w-full pl-10 pr-3.5 py-2.5 rounded-xl text-sm border {{ $errors->has('mobile_number') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2"
                                   required>
                        </div>
                        @error('mobile_number')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Residential Address -->
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-xs font-bold uppercase tracking-wider text-zinc-300 mb-1.5">
                            Complete Residential Address <span class="text-brand-500">*</span>
                        </label>
                        <div class="relative">
                            <textarea name="address" 
                                      id="address" 
                                      rows="3" 
                                      placeholder="House No., Street Name, Barangay, City/Municipality, Province, Postal Code" 
                                      class="w-full p-3.5 rounded-xl text-sm border {{ $errors->has('address') ? 'border-brand-500 bg-brand-950/40 text-white focus:ring-brand-500 focus:border-brand-500' : 'border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-brand-500 focus:border-brand-500' }} transition outline-none shadow-inner focus:ring-2 resize-none"
                                      required>{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <p class="mt-1.5 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 4: Profile Picture Upload -->
            <div>
                <div class="flex items-center gap-3 pb-4 border-b border-zinc-800">
                    <div class="w-8 h-8 rounded-lg bg-zinc-800 text-brand-500 border border-brand-500/30 flex items-center justify-center font-black text-sm shadow-md">
                        4
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">Student Profile Photo</h2>
                        <p class="text-xs text-zinc-400">Upload a formal 2x2 portrait photo for the digital student ID card (Max 2MB, JPG/PNG)</p>
                    </div>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row items-center gap-6">
                    <!-- Photo Preview Box -->
                    <div class="flex-shrink-0 flex flex-col items-center">
                        <div class="w-32 h-32 rounded-2xl bg-zinc-950 border-2 border-dashed {{ $errors->has('profile_picture') ? 'border-brand-500' : 'border-zinc-700' }} flex items-center justify-center overflow-hidden relative shadow-inner group">
                            <img id="image-preview" src="#" alt="Profile Preview" class="w-full h-full object-cover hidden">
                            <div id="image-placeholder" class="text-center p-3">
                                <i class="fa-solid fa-user-astronaut text-3xl text-zinc-600 mb-1"></i>
                                <span class="block text-[11px] text-zinc-500 font-medium">No Photo</span>
                            </div>
                        </div>
                        <span class="text-[11px] text-zinc-400 mt-1.5 font-medium">2x2 ID Preview</span>
                    </div>

                    <!-- Upload Input Zone -->
                    <div class="flex-1 w-full">
                        <div class="relative">
                            <label for="profile_picture" class="flex flex-col items-center justify-center w-full p-5 border-2 border-dashed {{ $errors->has('profile_picture') ? 'border-brand-500 bg-brand-950/20' : 'border-zinc-700 bg-zinc-800/50 hover:bg-zinc-800 hover:border-brand-500' }} rounded-2xl cursor-pointer transition">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-brand-500 mb-2"></i>
                                    <p class="text-sm font-semibold text-zinc-200">
                                        <span class="text-brand-400 hover:underline">Click to upload photo</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-zinc-400 mt-1">PNG, JPG, or JPEG format (Up to 2MB)</p>
                                    <span id="selected-file-name" class="mt-2 text-xs font-bold text-brand-400 bg-brand-950 px-3 py-1 rounded-full border border-brand-800/80 hidden"></span>
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
                            <p class="mt-2 text-xs text-brand-400 flex items-center gap-1 font-semibold">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions & Submission -->
            <div class="pt-6 border-t border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('students.index') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-zinc-700 text-zinc-300 hover:bg-zinc-800 hover:text-white text-sm font-bold transition text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Cancel & Directory</span>
                </a>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="reset" onclick="resetImagePreview()" class="w-1/2 sm:w-auto px-5 py-2.5 rounded-xl border border-zinc-700 text-zinc-400 hover:text-white hover:bg-zinc-800 text-sm font-bold transition text-center">
                        Clear Fields
                    </button>

                    <button type="submit" class="w-1/2 sm:w-auto px-7 py-2.5 rounded-xl bg-gradient-to-r from-brand-700 via-brand-600 to-red-600 hover:from-brand-800 hover:to-red-700 text-white text-sm font-extrabold shadow-lg shadow-brand-950/80 active:scale-[0.98] transition flex items-center justify-center gap-2 border border-brand-500/50">
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
