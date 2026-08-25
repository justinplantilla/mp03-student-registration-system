@extends('layouts.app')

@section('title', 'Student Profile - ' . $student->full_name)

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Top Action Bar -->
    <div class="no-print flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-zinc-900/90 p-4 sm:p-5 rounded-2xl border border-zinc-800 shadow-xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('students.index') }}" class="w-9 h-9 rounded-xl bg-zinc-800 hover:bg-brand-600 text-zinc-300 hover:text-white flex items-center justify-center transition border border-zinc-700" title="Back to Directory">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-base font-bold text-white">Student Profile & Digital ID</h1>
                <p class="text-xs text-zinc-400">CIT Student Record #{{ $student->id }} &bull; Registered on {{ $student->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5 w-full sm:w-auto">
            <button onclick="window.print()" class="px-4 py-2 rounded-xl bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs font-bold transition flex items-center gap-2 border border-zinc-700">
                <i class="fa-solid fa-print"></i>
                <span>Print Profile / ID</span>
            </button>

            <a href="{{ route('students.create') }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-brand-700 via-brand-600 to-red-600 hover:from-brand-800 hover:to-red-700 text-white text-xs font-bold shadow-md shadow-brand-950 transition flex items-center gap-2 border border-brand-500/40">
                <i class="fa-solid fa-user-plus"></i>
                <span>Register Another</span>
            </a>
        </div>
    </div>

    <!-- Layout Grid: Digital Student ID Card + Comprehensive Details -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left Column: Official Digital Student ID Card (Black & Red Edition) -->
        <div class="lg:col-span-5 flex flex-col items-center">
            <div class="w-full max-w-sm bg-gradient-to-b from-black via-zinc-950 to-zinc-900 rounded-3xl p-6 text-white shadow-2xl border-2 border-brand-700/60 relative overflow-hidden">
                
                <!-- Background Red Accent Glow -->
                <div class="absolute -top-16 -right-16 w-48 h-48 bg-brand-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-red-800/20 rounded-full blur-3xl pointer-events-none"></div>

                <!-- ID Card Header -->
                <div class="flex items-center justify-between pb-4 border-b border-zinc-800 relative z-10">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-brand-600/20 border border-brand-500/40 flex items-center justify-center text-brand-400">
                            <i class="fa-solid fa-graduation-cap text-base"></i>
                        </div>
                        <div>
                            <span class="block text-[11px] font-black tracking-wider text-white uppercase">College of Info Tech</span>
                            <span class="block text-[9px] text-brand-400 font-bold tracking-widest uppercase">Student Identity Card</span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-black bg-emerald-950 text-emerald-400 border border-emerald-700/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Active
                    </span>
                </div>

                <!-- ID Card Photo & Name -->
                <div class="pt-6 pb-4 flex flex-col items-center text-center relative z-10">
                    <div class="w-32 h-32 rounded-2xl p-1 bg-gradient-to-tr from-brand-600 via-red-500 to-zinc-700 shadow-2xl shadow-brand-950 mb-4 border border-brand-400/50">
                        <img src="{{ $student->profile_picture_url }}" 
                             alt="{{ $student->full_name }}" 
                             class="w-full h-full object-cover rounded-xl bg-zinc-950">
                    </div>

                    <h2 class="text-xl font-black text-white tracking-tight">{{ $student->full_name }}</h2>
                    <span class="inline-block mt-1 font-mono text-xs font-black tracking-wider text-brand-400 bg-brand-950 px-3 py-1 rounded-lg border border-brand-800">
                        {{ $student->student_id }}
                    </span>

                    <p class="text-xs text-zinc-300 mt-2 font-semibold px-4 leading-relaxed">
                        {{ $student->program }}
                    </p>

                    <div class="mt-3 inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-zinc-800/90 text-zinc-200 text-xs font-bold border border-zinc-700">
                        <i class="fa-solid fa-layer-group text-brand-400 text-[10px]"></i>
                        <span>{{ $student->year_level }}</span>
                    </div>
                </div>

                <!-- ID Card Footer Barcode Sim -->
                <div class="pt-4 mt-2 border-t border-zinc-800 flex flex-col items-center justify-center relative z-10">
                    <div class="h-8 flex items-center gap-1 opacity-80">
                        @for ($i = 0; $i < 30; $i++)
                            <span class="inline-block bg-white h-6 {{ $i % 3 == 0 ? 'w-1' : ($i % 2 == 0 ? 'w-0.5' : 'w-1.5') }}"></span>
                        @endfor
                    </div>
                    <span class="text-[9px] text-zinc-400 font-mono tracking-widest mt-1">OFFICIAL CIT DIGITAL REGISTRY</span>
                </div>

            </div>

            <p class="no-print text-center text-xs text-zinc-400 mt-3">
                <i class="fa-solid fa-shield-halved text-brand-500"></i> Digitally verified student credential
            </p>
        </div>

        <!-- Right Column: Detailed Breakdown Cards -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Personal & Academic Details Card -->
            <div class="bg-zinc-900/90 rounded-3xl p-6 sm:p-8 border border-zinc-800 shadow-xl space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-zinc-800">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-950 border border-brand-800/80 text-brand-400 flex items-center justify-center">
                            <i class="fa-solid fa-user-check text-sm"></i>
                        </div>
                        <h3 class="text-base font-bold text-white">Student Profile Information</h3>
                    </div>
                    <span class="text-xs font-mono font-bold text-brand-400 bg-brand-950 px-2.5 py-1 rounded-lg border border-brand-800">
                        {{ $student->student_id }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <!-- First Name -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">First Name</span>
                        <span class="font-bold text-white">{{ $student->first_name }}</span>
                    </div>

                    <!-- Middle Name -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Middle Name</span>
                        <span class="font-bold text-white">{{ $student->middle_name ?: '—' }}</span>
                    </div>

                    <!-- Last Name -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Last Name</span>
                        <span class="font-bold text-white">{{ $student->last_name }}</span>
                    </div>

                    <!-- Gender -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Gender</span>
                        <span class="font-bold text-white flex items-center gap-1.5">
                            <i class="fa-solid fa-venus-mars text-brand-400 text-xs"></i>
                            {{ $student->gender }}
                        </span>
                    </div>

                    <!-- Date of Birth & Age -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Date of Birth & Age</span>
                        <div class="flex items-center justify-between font-bold text-white">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-cake-candles text-brand-500 text-xs"></i>
                                {{ $student->formatted_dob }}
                            </span>
                            @if ($student->age !== null)
                                <span class="text-xs bg-brand-950 text-brand-400 border border-brand-800 px-2.5 py-0.5 rounded-full font-bold">
                                    {{ $student->age }} years old
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Degree Program -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Enrolled Program</span>
                        <span class="font-black text-brand-400 block">{{ $student->program }}</span>
                    </div>

                    <!-- Year Level -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Year Level</span>
                        <span class="font-bold text-white flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            {{ $student->year_level }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Contact & Address Card -->
            <div class="bg-zinc-900/90 rounded-3xl p-6 sm:p-8 border border-zinc-800 shadow-xl space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-zinc-800">
                    <div class="w-8 h-8 rounded-lg bg-zinc-800 border border-zinc-700 text-brand-500 flex items-center justify-center">
                        <i class="fa-solid fa-address-card text-sm"></i>
                    </div>
                    <h3 class="text-base font-bold text-white">Contact & Address Details</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <!-- Email -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Email Address</span>
                        <a href="mailto:{{ $student->email }}" class="font-bold text-brand-400 hover:underline flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-zinc-400 text-xs"></i>
                            {{ $student->email }}
                        </a>
                    </div>

                    <!-- Mobile -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Mobile Number</span>
                        <a href="tel:{{ $student->mobile_number }}" class="font-bold text-white hover:text-brand-400 flex items-center gap-1.5">
                            <i class="fa-solid fa-phone text-zinc-400 text-xs"></i>
                            {{ $student->mobile_number }}
                        </a>
                    </div>

                    <!-- Residential Address -->
                    <div class="p-3.5 rounded-2xl bg-zinc-800/80 border border-zinc-700/60 sm:col-span-2">
                        <span class="block text-[11px] font-bold uppercase tracking-wider text-zinc-400 mb-0.5">Residential Address</span>
                        <p class="font-semibold text-zinc-200 leading-relaxed flex items-start gap-2 mt-1">
                            <i class="fa-solid fa-location-dot text-brand-500 text-xs mt-1"></i>
                            <span>{{ $student->address }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Picture File Reference -->
            <div class="bg-zinc-900 rounded-2xl p-4 border border-zinc-800 flex items-center justify-between text-xs text-zinc-400">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-image text-brand-500"></i>
                    <span>Storage Path: <code class="font-mono text-zinc-200 bg-zinc-950 px-2 py-0.5 rounded border border-zinc-800">{{ $student->profile_picture }}</code></span>
                </div>
                <a href="{{ $student->profile_picture_url }}" target="_blank" class="text-brand-400 font-bold hover:underline">
                    View Raw <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
