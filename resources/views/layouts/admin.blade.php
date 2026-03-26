<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name', 'Issue Reporter') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #0D0D0D; color: #FFFFFF; }
        h1, h2, h3, .syne { font-family: 'Syne', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); backdrop-filter: blur(12px); }
        .sidebar-active { border-left: 4px solid #F59E0B; background: rgba(245, 158, 11, 0.1); }
    </style>
</head>
<body class="antialiased flex min-h-screen bg-[#0D0D0D]" x-data="{ sidebarOpen: false }">
    <!-- Mobile Header -->
    <div class="lg:hidden fixed top-0 left-0 right-0 z-50 glass bg-[#0D0D0D]/80 border-b border-white/10 px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-amber-500 syne uppercase tracking-tight">Admin</h1>
        <button @click="sidebarOpen = !sidebarOpen" class="text-white p-2">
            <svg x-show="!sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            <svg x-show="sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="lg:hidden fixed inset-0 bg-black/60 z-40 backdrop-blur-sm transition-opacity" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="w-64 border-r border-white/10 flex flex-col fixed h-full bg-[#0D0D0D] z-50 transform transition-transform duration-300 lg:translate-x-0">
        <div class="p-8 hidden lg:block">
            <h1 class="text-2xl font-bold text-amber-500 syne uppercase tracking-tight">Admin</h1>
        </div>
        <div class="p-8 lg:hidden">
             <!-- Spacer for mobile header when sidebar is open if needed, or just some padding -->
        </div>
        <nav class="flex-1 px-4 space-y-2 mt-10 lg:mt-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/5 transition {{ request()->routeIs('admin.dashboard') ? 'sidebar-active text-amber-400' : 'text-gray-400' }}">
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/5 transition {{ request()->routeIs('admin.reports.*') ? 'sidebar-active text-amber-400' : 'text-gray-400' }}">
                <span>All Reports</span>
            </a>
            <a href="{{ route('admin.messages.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/5 transition {{ request()->routeIs('admin.messages.*') ? 'sidebar-active text-amber-400' : 'text-gray-400' }}">
                <span>Contact Messages</span>
            </a>
        </nav>
        <div class="p-4 border-t border-white/10">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-500 hover:bg-red-500/10 transition">
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 flex-1 p-6 lg:p-10 pt-24 lg:pt-10">
        <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h2 class="text-3xl font-bold syne">@yield('header', 'Admin Panel')</h2>
            <div class="px-3 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-xs uppercase font-bold tracking-widest shrink-0">Admin Access</div>
        </header>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
