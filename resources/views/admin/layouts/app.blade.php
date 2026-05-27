<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Admin Ulyabi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #F7EFE5; }

        .sidebar {
            background: linear-gradient(180deg, #5B2C59 0%, #674188 100%);
            transition: transform 0.3s ease;
        }

        .sidebar-link {
            color: #FFF8F0;
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            position: relative;
        }

        .sidebar-link:hover {
            background: rgba(221, 195, 195, 0.2);
            color: #DDC3C3;
        }

        .sidebar-link.active {
            background: rgba(221, 195, 195, 0.25);
            color: #DDC3C3;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: #DDC3C3;
            border-radius: 0 4px 4px 0;
        }

        .card-admin {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }

        .card-admin:hover {
            box-shadow: 0 4px 12px rgba(163, 118, 162, 0.1);
        }

        .stat-card {
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: scale(0);
            transition: transform 0.5s ease;
        }

        .stat-card:hover::after {
            transform: scale(3);
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .btn-admin-primary {
            background: linear-gradient(135deg, #A376A2, #8D5F8C);
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .btn-admin-primary:hover {
            background: linear-gradient(135deg, #8D5F8C, #6B3F69);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(163, 118, 162, 0.4);
        }

        .btn-admin-danger {
            background: #EF4444;
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .btn-admin-danger:hover {
            background: #DC2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .btn-admin-warning {
            background: #F59E0B;
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .btn-admin-warning:hover {
            background: #D97706;
            transform: translateY(-1px);
        }

        .btn-admin-secondary {
            background: #F3F4F6;
            color: #6B3F69;
            padding: 0.625rem 1.25rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #E5E7EB;
            cursor: pointer;
        }

        .btn-admin-secondary:hover {
            background: #E5E7EB;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #E5E7EB;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            background: white;
            font-size: 0.875rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #A376A2;
            box-shadow: 0 0 0 3px rgba(163, 118, 162, 0.15);
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-error {
            color: #EF4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .table-admin {
            width: 100%;
            border-collapse: collapse;
        }

        .table-admin th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: #F9FAFB;
            border-bottom: 2px solid #E5E7EB;
        }

        .table-admin td {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            border-bottom: 1px solid #F3F4F6;
            vertical-align: middle;
        }

        .table-admin tr:hover td {
            background: #F9FAFB;
        }

        .badge-admin {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .toast-success {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .toast-error {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .toggle-checkbox:checked {
            background-color: #A376A2;
            border-color: #A376A2;
        }

        .pagination-admin .page-link {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            color: #6B3F69;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .pagination-admin .page-link:hover {
            background: rgba(163, 118, 162, 0.1);
        }

        .pagination-admin .active .page-link {
            background: #A376A2;
            color: white;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        #sidebar-overlay {
            display: none;
        }

        #sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 767px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 60;
                transform: translateX(-100%);
            }
            #sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div id="sidebar-overlay" class="overlay fixed inset-0 z-50 md:hidden" onclick="closeSidebar()"></div>

    <aside id="sidebar" class="sidebar fixed top-0 left-0 h-screen w-64 flex flex-col z-50">  
        <div class="p-6 border-b border-[#DDC3C3]/20">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#DDC3C3]/20 flex items-center justify-center">
                    <span class="text-xl font-bold text-[#DDC3C3]">U</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-[#FFF8F0]">Ulyabi</h1>
                    <p class="text-xs text-[#DDC3C3]/70">Admin Panel</p>
                </div>
            </a>
        </div>

        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                <span>Produk</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>Kategori</span>
            </a>
            <a href="{{ route('admin.subcategories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                <span>Subkategori</span>
            </a>
        </nav>

        <div class="p-4 border-t border-[#DDC3C3]/20">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sidebar-link flex items-center gap-3 px-4 py-3 w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="md:pl-64 min-h-screen flex flex-col">
    <header class="bg-white shadow-sm border-b border-[#DDC3C3]/20">         
           <div class="flex items-center justify-between px-4 sm:px-6 h-16">
                <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg hover:bg-[#F3F4F6] transition">
                    <svg class="w-6 h-6 text-[#6B3F69]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="hidden md:block">
                    <h2 class="text-lg font-semibold text-[#6B3F69]">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#A376A2] to-[#6B3F69] flex items-center justify-center text-white text-sm font-semibold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @if(session('success'))
            <div id="toast-success" class="toast-success fixed top-4 right-4 z-50 flex items-center gap-3 text-sm font-medium animate-pulse">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('toast-success');
                    if (el) { el.style.opacity = '0'; el.style.transition = 'opacity 0.5s'; setTimeout(() => el.remove(), 500); }
                }, 3000);
            </script>
            @endif

            @if(session('error'))
            <div id="toast-error" class="toast-error fixed top-4 right-4 z-50 flex items-center gap-3 text-sm font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('toast-error');
                    if (el) { el.style.opacity = '0'; el.style.transition = 'opacity 0.5s'; setTimeout(() => el.remove(), 500); }
                }, 3000);
            </script>
            @endif

            @yield('content')
        </main>

        <footer class="bg-white border-t border-[#DDC3C3]/20 py-4 px-6">
            <p class="text-center text-sm text-gray-400">&copy; {{ date('Y') }} Ulyabi Admin Panel. All rights reserved.</p>
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('show');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebar-overlay').classList.remove('show');
        }
    </script>

    @stack('scripts')
</body>
</html>
