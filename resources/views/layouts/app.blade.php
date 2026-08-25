<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-zinc-950 text-zinc-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Student Registration Portal') - College of Information Technology</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                            950: '#450a0a',
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
                color: black !important;
            }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-zinc-100 antialiased bg-zinc-950 selection:bg-brand-600 selection:text-white">

    <!-- Top Red Accent Line -->
    <div class="h-1 bg-gradient-to-r from-brand-800 via-brand-600 to-red-500"></div>

    <!-- Navigation Header -->
    <header class="no-print sticky top-0 z-50 bg-zinc-900/90 backdrop-blur-md border-b border-zinc-800/90 shadow-lg shadow-black/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-18 items-center py-2">
                <!-- Brand Logo & Title -->
                <a href="{{ route('students.create') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-brand-700 via-brand-600 to-red-500 flex items-center justify-center text-white shadow-md shadow-brand-950 group-hover:scale-105 transition-transform duration-200 border border-brand-500/30">
                        <i class="fa-solid fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-base sm:text-lg font-black tracking-tight text-white group-hover:text-brand-400 transition-colors">
                                College of Information Technology
                            </span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-brand-950 text-brand-400 border border-brand-800/80">
                                CIT Portal
                            </span>
                        </div>
                        <p class="text-xs text-zinc-400 hidden sm:block">Digital Student Registration & Information System</p>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('students.create') }}" 
                       class="px-3.5 py-2 text-xs sm:text-sm font-bold rounded-xl transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('students.create') || request()->routeIs('register') ? 'bg-brand-600 text-white shadow-md shadow-brand-950 border border-brand-500' : 'text-zinc-300 hover:text-white hover:bg-zinc-800/80 border border-transparent' }}">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Register Student</span>
                    </a>

                    <a href="{{ route('students.index') }}" 
                       class="px-3.5 py-2 text-xs sm:text-sm font-bold rounded-xl transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('students.index') ? 'bg-brand-600 text-white shadow-md shadow-brand-950 border border-brand-500' : 'text-zinc-300 hover:text-white hover:bg-zinc-800/80 border border-transparent' }}">
                        <i class="fa-solid fa-address-book text-xs"></i>
                        <span>Directory</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-zinc-900 via-zinc-950 to-black">
        <div class="max-w-6xl mx-auto">
            
            <!-- Global Flash Success Banner -->
            @if (session('success'))
                <div id="flash-success-banner" class="no-print mb-6 rounded-2xl bg-zinc-900/90 border border-emerald-500/40 p-4 sm:p-5 shadow-xl shadow-black/50 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-950/60">
                            <i class="fa-solid fa-circle-check text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0 pt-0.5">
                            <h3 class="text-base font-bold text-emerald-400">Success Notification</h3>
                            <p class="text-sm text-zinc-300 mt-0.5">{{ session('success') }}</p>
                        </div>
                        <button type="button" onclick="document.getElementById('flash-success-banner').remove()" class="text-zinc-400 hover:text-white transition p-1 rounded-lg hover:bg-zinc-800">
                            <i class="fa-solid fa-xmark text-base"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Global Flash Error Banner -->
            @if ($errors->any())
                <div id="flash-error-banner" class="no-print mb-6 rounded-2xl bg-zinc-900/90 border border-brand-500/60 p-4 sm:p-5 shadow-xl shadow-brand-950/40 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-700 to-red-600 text-white flex items-center justify-center shadow-lg shadow-brand-950/60">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0 pt-0.5">
                            <h3 class="text-base font-bold text-brand-400">Please correct the following errors:</h3>
                            <ul class="mt-2 list-disc list-inside text-sm text-zinc-300 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" onclick="document.getElementById('flash-error-banner').remove()" class="text-zinc-400 hover:text-white transition p-1 rounded-lg hover:bg-zinc-800">
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
    <footer class="no-print bg-zinc-900 border-t border-zinc-800 py-6 text-zinc-400 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center justify-center sm:justify-start gap-2 mb-3 sm:mb-0">
                <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                <span class="font-bold text-zinc-200">College of Information Technology</span>
                <span>— Online Student Registration System</span>
            </div>
            <div class="text-xs text-zinc-500">
                CIT Digital Registry &bull; Black & Red Edition &bull; Mini Project MP03
            </div>
        </div>
    </footer>

    <!-- Scripts stack -->
    @stack('scripts')
</body>
</html>
