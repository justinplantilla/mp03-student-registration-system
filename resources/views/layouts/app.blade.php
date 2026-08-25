<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Student Registration System') - College of Information Technology</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS (CDN for guaranteed standalone styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            body {
                background: white !important;
            }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-slate-800 antialiased bg-gradient-to-br from-slate-50 via-indigo-50/20 to-slate-100">

    <!-- Navigation Header -->
    <header class="no-print sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Brand Logo & Title -->
                <a href="{{ route('students.create') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform duration-200">
                        <i class="fa-solid fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold bg-gradient-to-r from-slate-900 via-brand-800 to-brand-600 bg-clip-text text-transparent">CIT Portal</span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-brand-100 text-brand-700">Digital Registry</span>
                        </div>
                        <p class="text-xs text-slate-500 hidden sm:block">College of Information Technology</p>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('students.create') }}" 
                       class="px-3.5 py-2 text-sm font-semibold rounded-lg transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('students.create') || request()->routeIs('register') ? 'bg-brand-50 text-brand-700 shadow-xs border border-brand-200' : 'text-slate-600 hover:text-brand-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Register Student</span>
                    </a>

                    <a href="{{ route('students.index') }}" 
                       class="px-3.5 py-2 text-sm font-semibold rounded-lg transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('students.index') ? 'bg-brand-50 text-brand-700 shadow-xs border border-brand-200' : 'text-slate-600 hover:text-brand-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-address-book text-xs"></i>
                        <span>Directory</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            <!-- Global Flash Messages -->
            @if (session('success'))
                <div id="flash-success-banner" class="no-print mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 sm:p-5 shadow-sm transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-md shadow-emerald-500/20">
                            <i class="fa-solid fa-circle-check text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0 pt-0.5">
                            <h3 class="text-base font-bold text-emerald-900">Success Notification</h3>
                            <p class="text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                        </div>
                        <button type="button" onclick="document.getElementById('flash-success-banner').remove()" class="text-emerald-500 hover:text-emerald-700 transition p-1 rounded-lg hover:bg-emerald-100">
                            <i class="fa-solid fa-xmark text-base"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div id="flash-error-banner" class="no-print mb-6 rounded-2xl bg-rose-50 border border-rose-200 p-4 sm:p-5 shadow-sm transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shadow-md shadow-rose-500/20">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0 pt-0.5">
                            <h3 class="text-base font-bold text-rose-900">Please correct the following errors:</h3>
                            <ul class="mt-2 list-disc list-inside text-sm text-rose-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" onclick="document.getElementById('flash-error-banner').remove()" class="text-rose-500 hover:text-rose-700 transition p-1 rounded-lg hover:bg-rose-100">
                            <i class="fa-solid fa-xmark text-base"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Yield Child View Content -->
            @yield('content')

        </div>
    </main>

    <!-- Footer -->
    <footer class="no-print bg-white border-t border-slate-200 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:flex sm:justify-between sm:items-center text-sm text-slate-500">
            <div class="flex items-center justify-center sm:justify-start gap-2 mb-3 sm:mb-0">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="font-medium text-slate-700">College of Information Technology</span>
                <span>— Online Student Registration Module</span>
            </div>
            <div class="text-xs text-slate-400">
                Laravel Student Registration System &bull; Mini Project MP03
            </div>
        </div>
    </footer>

    <!-- Scripts stack -->
    @stack('scripts')
</body>
</html>

