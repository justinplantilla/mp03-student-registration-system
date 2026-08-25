@extends('layouts.app')

@section('title', 'Student Profile - ' . $student->full_name)

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Top Action Bar -->
    <div class="no-print flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200 shadow-xs">
        <div class="flex items-center gap-3">
            <a href="{{ route('students.index') }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition" title="Back to Directory">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-base font-bold text-slate-900">Student Profile & Digital ID</h1>
                <p class="text-xs text-slate-500">Record ID #{{ $student->id }} &bull; Registered on {{ $student->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 w-full sm:w-auto">
            <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-2">
                <i class="fa-solid fa-print"></i>
                <span>Print Profile / ID</span>
            </button>

            <a href="{{ route('students.create') }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-700 hover:to-indigo-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-user-plus"></i>
                <span>Register Another</span>
            </a>
        </div>
    </div>

    <!-- Layout Grid: Digital Student ID Card + Comprehensive Details -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left Column: Official Digital Student ID Card -->
        <div class="lg:col-span-5 flex flex-col items-center">
            <div class="w-full max-w-sm bg-gradient-to-b from-slate-900 via-indigo-950 to-slate-950 rounded-3xl p-6 text-white shadow-2xl border border-indigo-500/20 relative overflow-hidden">
                
                <!-- Background Accent Glow -->
                <div class="absolute -top-16 -right-16 w-48 h-48 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

                <!-- ID Card Header -->
                <div class="flex items-center justify-between pb-4 border-b border-white/10 relative z-10">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-brand-300">
                            <i class="fa-solid fa-graduation-cap text-base"></i>
                        </div>
                        <div>
                            <span class="block text-[11px] font-bold tracking-wider text-slate-200 uppercase">College of Info Tech</span>
                            <span class="block text-[9px] text-brand-300 tracking-widest uppercase">Student Identity Card</span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Active
                    </span>
                </div>

                <!-- ID Card Photo & Name -->
                <div class="pt-6 pb-4 flex flex-col items-center text-center relative z-10">
                    <div class="w-32 h-32 rounded-2xl p-1 bg-gradient-to-tr from-brand-400 via-indigo-300 to-amber-300 shadow-xl mb-4">
                        <img src="{{ $student->profile_picture_url }}" 
                             alt="{{ $student->full_name }}" 
                             class="w-full h-full object-cover rounded-xl bg-slate-800">
                    </div>

                    <h2 class="text-xl font-black text-white tracking-tight">{{ $student->full_name }}</h2>
                    <span class="inline-block mt-1 font-mono text-sm font-semibold tracking-wider text-brand-300 bg-brand-950/60 px-3 py-0.5 rounded-lg border border-brand-500/30">
                        {{ $student->student_id }}
                    </span>

                    <p class="text-xs text-slate-300 mt-2 font-medium px-4 leading-relaxed">
                        {{ $student->program }}
                    </p>

                    <div class="mt-3 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold">
                        <i class="fa-solid fa-layer-group text-brand-300 text-[10px]"></i>
                        <span>{{ $student->year_level }}</span>
                    </div>
                </div>

                <!-- ID Card Footer Barcode Sim -->
                <div class="pt-4 mt-2 border-t border-white/10 flex flex-col items-center justify-center relative z-10">
                    <div class="h-8 flex items-center gap-1 opacity-70">
                        @for ($i = 0; $i < 30; $i++)
                            <span class="inline-block bg-white h-6 {{ $i % 3 == 0 ? 'w-1' : ($i % 2 == 0 ? 'w-0.5' : 'w-1.5') }}"></span>
                        @endfor
                    </div>
                    <span class="text-[9px] text-slate-400 font-mono tracking-widest mt-1">OFFICIAL CIT DIGITAL REGISTRY</span>
                </div>

            </div>

            <p class="no-print text-center text-xs text-slate-400 mt-3">
                <i class="fa-solid fa-shield-halved text-brand-500"></i> Digitally verified student credential
            </p>
        </div>

        <!-- Right Column: Detailed Breakdown Cards -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Personal & Academic Details Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="fa-solid fa-user-check text-sm"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900">Student Profile Information</h3>
                    </div>
                    <span class="text-xs font-mono font-bold text-brand-600 bg-brand-50 px-2.5 py-1 rounded-lg">
                        {{ $student->student_id }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <!-- First Name -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">First Name</span>
                        <span class="font-semibold text-slate-800">{{ $student->first_name }}</span>
                    </div>

                    <!-- Middle Name -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Middle Name</span>
                        <span class="font-semibold text-slate-800">{{ $student->middle_name ?: '—' }}</span>
                    </div>

                    <!-- Last Name -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Last Name</span>
                        <span class="font-semibold text-slate-800">{{ $student->last_name }}</span>
                    </div>

                    <!-- Gender -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Gender</span>
                        <span class="font-semibold text-slate-800 flex items-center gap-1.5">
                            <i class="fa-solid fa-venus-mars text-slate-400 text-xs"></i>
                            {{ $student->gender }}
                        </span>
                    </div>

                    <!-- Date of Birth & Age -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Date of Birth & Age</span>
                        <div class="flex items-center justify-between font-semibold text-slate-800">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-cake-candles text-brand-500 text-xs"></i>
                                {{ $student->formatted_dob }}
                            </span>
                            @if ($student->age !== null)
                                <span class="text-xs bg-indigo-50 text-indigo-700 px-2.5 py-0.5 rounded-full font-bold">
                                    {{ $student->age }} years old
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Degree Program -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Enrolled Program</span>
                        <span class="font-bold text-brand-900 block">{{ $student->program }}</span>
                    </div>

                    <!-- Year Level -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Year Level</span>
                        <span class="font-semibold text-slate-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                            {{ $student->year_level }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Contact & Address Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-address-card text-sm"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Contact & Address Details</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <!-- Email -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Email Address</span>
                        <a href="mailto:{{ $student->email }}" class="font-semibold text-brand-600 hover:underline flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-slate-400 text-xs"></i>
                            {{ $student->email }}
                        </a>
                    </div>

                    <!-- Mobile -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Mobile Number</span>
                        <a href="tel:{{ $student->mobile_number }}" class="font-semibold text-slate-800 hover:text-brand-600 flex items-center gap-1.5">
                            <i class="fa-solid fa-phone text-slate-400 text-xs"></i>
                            {{ $student->mobile_number }}
                        </a>
                    </div>

                    <!-- Residential Address -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Residential Address</span>
                        <p class="font-semibold text-slate-800 leading-relaxed flex items-start gap-2 mt-1">
                            <i class="fa-solid fa-location-dot text-slate-400 text-xs mt-1"></i>
                            <span>{{ $student->address }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Picture File Reference -->
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200 flex items-center justify-between text-xs text-slate-500">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-image text-brand-500"></i>
                    <span>Storage File: <code class="font-mono text-slate-700 bg-white px-2 py-0.5 rounded border border-slate-200">{{ $student->profile_picture }}</code></span>
                </div>
                <a href="{{ $student->profile_picture_url }}" target="_blank" class="text-brand-600 font-bold hover:underline">
                    View Raw <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>

        </div>

    </div>
</div>
@endsection

