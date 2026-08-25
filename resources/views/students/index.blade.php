@extends('layouts.app')

@section('title', 'Registered Students Directory')

@section('content')
<div class="space-y-8">

    <!-- Top Title Banner & Actions -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-950 text-brand-400 border border-brand-800/80 text-xs font-bold uppercase tracking-wider mb-2">
                <i class="fa-solid fa-graduation-cap"></i> CIT Registry
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Student Directory</h1>
            <p class="text-sm text-zinc-400 mt-1">Official registry of students enrolled in the College of Information Technology</p>
        </div>
        <a href="{{ route('students.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-brand-700 via-brand-600 to-red-600 hover:from-brand-800 hover:to-red-700 text-white font-black text-sm shadow-xl shadow-brand-950 transition border border-brand-500/40">
            <i class="fa-solid fa-user-plus text-xs"></i>
            <span>Register New Student</span>
        </a>
    </div>

    <!-- Stat Metrics Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <!-- Total Students -->
        <div class="bg-zinc-900/90 p-5 rounded-2xl border border-zinc-800 shadow-xl">
            <div class="flex items-center justify-between text-zinc-500 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">Total Enrolled</span>
                <div class="w-8 h-8 rounded-lg bg-brand-950 text-brand-400 border border-brand-800/80 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $stats['total'] }}</div>
            <span class="text-[11px] text-zinc-400 font-medium">Registered student records</span>
        </div>

        <!-- Distinct Degree Programs -->
        <div class="bg-zinc-900/90 p-5 rounded-2xl border border-zinc-800 shadow-xl">
            <div class="flex items-center justify-between text-zinc-500 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">Programs</span>
                <div class="w-8 h-8 rounded-lg bg-zinc-800 text-brand-400 border border-zinc-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $stats['programs_count'] }}</div>
            <span class="text-[11px] text-zinc-400 font-medium">Academic disciplines</span>
        </div>

        <!-- Freshmen Intake -->
        <div class="bg-zinc-900/90 p-5 rounded-2xl border border-zinc-800 shadow-xl">
            <div class="flex items-center justify-between text-zinc-500 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">1st Year Students</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-950 text-emerald-400 border border-emerald-800/80 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-seedling"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $stats['freshmen_count'] }}</div>
            <span class="text-[11px] text-zinc-400 font-medium">Freshmen intake</span>
        </div>

        <!-- Recent Registrations -->
        <div class="bg-zinc-900/90 p-5 rounded-2xl border border-zinc-800 shadow-xl">
            <div class="flex items-center justify-between text-zinc-500 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-zinc-400">This Week</span>
                <div class="w-8 h-8 rounded-lg bg-red-950 text-red-400 border border-red-800/80 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $stats['recent_count'] }}</div>
            <span class="text-[11px] text-zinc-400 font-medium">New registrations</span>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-zinc-900/90 p-4 sm:p-5 rounded-2xl border border-zinc-800 shadow-xl">
        <form method="GET" action="{{ route('students.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            
            <!-- Search Query Input -->
            <div class="sm:col-span-5 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-500">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ $filters['search'] ?? '' }}" 
                       placeholder="Search by ID, name, email..." 
                       class="w-full pl-9 pr-3 py-2 text-sm rounded-xl border border-zinc-700 bg-zinc-800/80 text-white placeholder-zinc-500 focus:bg-zinc-800 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition outline-none">
            </div>

            <!-- Filter by Program -->
            <div class="sm:col-span-3">
                <select name="program" class="w-full px-3 py-2 text-sm rounded-xl border border-zinc-700 bg-zinc-800/80 text-white focus:bg-zinc-800 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition outline-none">
                    <option value="" class="bg-zinc-900">All Degree Programs</option>
                    @foreach ($programs as $prog)
                        <option value="{{ $prog }}" {{ ($filters['program'] ?? '') === $prog ? 'selected' : '' }} class="bg-zinc-900 text-white">
                            {{ $prog }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Year Level -->
            <div class="sm:col-span-2">
                <select name="year_level" class="w-full px-3 py-2 text-sm rounded-xl border border-zinc-700 bg-zinc-800/80 text-white focus:bg-zinc-800 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition outline-none">
                    <option value="" class="bg-zinc-900">All Year Levels</option>
                    @foreach ($yearLevels as $lvl)
                        <option value="{{ $lvl }}" {{ ($filters['year_level'] ?? '') === $lvl ? 'selected' : '' }} class="bg-zinc-900 text-white">
                            {{ $lvl }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Buttons -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="w-full px-4 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-md shadow-brand-950 border border-brand-500/40">
                    <i class="fa-solid fa-filter text-xs"></i>
                    <span>Filter</span>
                </button>
                @if (!empty($filters['search']) || !empty($filters['program']) || !empty($filters['year_level']))
                    <a href="{{ route('students.index') }}" class="p-2 rounded-xl border border-zinc-700 text-zinc-400 hover:text-white hover:bg-zinc-800 transition" title="Clear Filters">
                        <i class="fa-solid fa-rotate-left text-xs"></i>
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Students Directory Table -->
    <div class="bg-zinc-900/90 rounded-3xl border border-zinc-800 shadow-2xl overflow-hidden">
        @if ($students->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-300">
                    <thead class="bg-zinc-950/80 text-xs uppercase font-bold text-zinc-400 border-b border-zinc-800 tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Student</th>
                            <th class="px-6 py-4">Student ID</th>
                            <th class="px-6 py-4">Program & Year</th>
                            <th class="px-6 py-4">Contact</th>
                            <th class="px-6 py-4">Registered</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/80">
                        @foreach ($students as $student)
                            <tr class="hover:bg-zinc-800/50 transition-colors group">
                                <!-- Student Avatar & Full Name -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $student->profile_picture_url }}" 
                                             alt="{{ $student->full_name }}" 
                                             class="w-11 h-11 rounded-xl object-cover border border-zinc-700 shadow-sm bg-zinc-950">
                                        <div>
                                            <div class="font-bold text-white group-hover:text-brand-400 transition">
                                                {{ $student->full_name }}
                                            </div>
                                            <span class="text-xs text-zinc-400 flex items-center gap-1">
                                                <i class="fa-solid fa-venus-mars text-[10px] text-brand-400"></i> {{ $student->gender }} &bull; {{ $student->age }} yo
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Student ID Badge -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-xs font-bold text-brand-400 bg-brand-950 px-2.5 py-1 rounded-lg border border-brand-800">
                                        {{ $student->student_id }}
                                    </span>
                                </td>

                                <!-- Program & Year -->
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-zinc-200 line-clamp-1 max-w-xs">{{ $student->program }}</div>
                                    <span class="inline-block mt-0.5 text-[11px] font-bold text-zinc-300 bg-zinc-800 px-2.5 py-0.5 rounded-full border border-zinc-700">
                                        {{ $student->year_level }}
                                    </span>
                                </td>

                                <!-- Contact Information -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-zinc-200 flex items-center gap-1.5">
                                        <i class="fa-solid fa-envelope text-zinc-500 text-[10px]"></i>
                                        <span>{{ $student->email }}</span>
                                    </div>
                                    <div class="text-xs text-zinc-400 flex items-center gap-1.5 mt-0.5">
                                        <i class="fa-solid fa-phone text-zinc-500 text-[10px]"></i>
                                        <span>{{ $student->mobile_number }}</span>
                                    </div>
                                </td>

                                <!-- Registration Date -->
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-zinc-400">
                                    <span>{{ $student->created_at->format('M d, Y') }}</span>
                                    <span class="block text-[10px] text-zinc-500">{{ $student->created_at->diffForHumans() }}</span>
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('students.show', $student) }}" 
                                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-zinc-800 hover:bg-brand-600 text-zinc-200 hover:text-white text-xs font-bold transition border border-zinc-700 hover:border-brand-500 shadow-md">
                                        <i class="fa-solid fa-id-card text-xs"></i>
                                        <span>View ID</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if ($students->hasPages())
                <div class="p-4 border-t border-zinc-800 bg-zinc-950/60">
                    {{ $students->links() }}
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="text-center py-16 px-6">
                <div class="w-16 h-16 rounded-2xl bg-zinc-800 text-brand-500 border border-brand-500/30 flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
                <h3 class="text-lg font-bold text-white">No student records found</h3>
                <p class="text-sm text-zinc-400 mt-1 max-w-md mx-auto">
                    @if (!empty($filters['search']) || !empty($filters['program']) || !empty($filters['year_level']))
                        No registered students matched your selected filters or search criteria. Try adjusting your search keywords.
                    @else
                        No students have been registered yet. Start by filling out the online registration form.
                    @endif
                </p>
                <div class="mt-6 flex items-center justify-center gap-3">
                    @if (!empty($filters['search']) || !empty($filters['program']) || !empty($filters['year_level']))
                        <a href="{{ route('students.index') }}" class="px-4 py-2 rounded-xl border border-zinc-700 text-zinc-300 hover:text-white hover:bg-zinc-800 text-xs font-bold transition">
                            Clear Filters
                        </a>
                    @endif
                    <a href="{{ route('students.create') }}" class="px-5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-lg shadow-brand-950 transition flex items-center gap-2 border border-brand-500/40">
                        <i class="fa-solid fa-user-plus"></i>
                        <span>Register First Student</span>
                    </a>
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
