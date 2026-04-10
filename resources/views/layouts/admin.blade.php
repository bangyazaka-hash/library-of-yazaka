<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Library')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #FDFBF7; color: #34495E;">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed md:static z-40 top-0 left-0 h-full w-72 transform -translate-x-full md:translate-x-0 transition-transform duration-300 border-r"
        style="background-color: #ffffff; border-color: #f0e8dc;">

        <!-- Brand -->
        <div class="flex items-center justify-between px-6 py-6 border-b" style="border-color: #f0e8dc;">
            <div>
                <h1 class="text-2xl font-bold">Library</h1>
                <p class="text-sm mt-1" style="color: #7b8a97;">Admin Panel</p>
            </div>

            <button onclick="toggleSidebar()" class="md:hidden text-2xl">
                ×
            </button>
        </div>

        <!-- Menu -->
        <nav class="p-5 space-y-3">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-2xl font-medium"
               style="background-color: {{ request()->routeIs('admin.dashboard') ? '#F4A261' : '#FDFBF7' }};
                      color: {{ request()->routeIs('admin.dashboard') ? 'white' : '#34495E' }};">
                Dashboard
            </a>

            <a href="{{ route('admin.buku.index') }}"
               class="block px-4 py-3 rounded-2xl font-medium"
               style="background-color: {{ request()->routeIs('admin.buku.*') ? '#F4A261' : '#FDFBF7' }};
                      color: {{ request()->routeIs('admin.buku.*') ? 'white' : '#34495E' }};">
                Kelola Data Buku
            </a>

           <a href="{{ route('admin.anggota.index') }}"
                class="block px-4 py-3 rounded-2xl font-medium"
                style="background-color: {{ request()->routeIs('admin.anggota.*') ? '#F4A261' : '#FDFBF7' }};
                color: {{ request()->routeIs('admin.anggota.*') ? 'white' : '#34495E' }};">
                Kelola Anggota
            </a>

            <a href="{{ route('admin.peminjaman.index') }}"
            class="block px-4 py-3 rounded-2xl font-medium"
            style="background-color: {{ request()->routeIs('admin.peminjaman.*') ? '#F4A261' : '#FDFBF7' }};
            color: {{ request()->routeIs('admin.peminjaman.*') ? 'white' : '#34495E' }};">
                Peminjaman
            </a>
        </nav>

        <!-- Bottom -->
        <div class="absolute bottom-0 left-0 right-0 p-5 border-t" style="border-color: #f0e8dc;">
            <div class="rounded-2xl p-4 mb-4" style="background-color: #E9EDC9;">
                <p class="text-sm font-semibold">Admin</p>
                <p class="text-sm">{{ auth()->user()->name }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-2xl text-white font-semibold"
                    style="background-color: #F4A261;">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- OVERLAY -->
    <div id="overlay" onclick="toggleSidebar()"
         class="fixed inset-0 bg-black/30 z-30 hidden md:hidden"></div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">

        <!-- TOPBAR -->
        <header class="sticky top-0 z-20 border-b px-4 md:px-8 py-4 flex items-center justify-between bg-white"
                style="border-color: #f0e8dc;">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-xl">
                    ☰
                </button>

                <div>
                    <h2 class="text-xl md:text-2xl font-bold">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-sm" style="color: #7b8a97;">Sistem Informasi Perpustakaan</p>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold"
                     style="background-color: #E9EDC9;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <p class="font-medium">{{ auth()->user()->name }}</p>
            </div>
        </header>

        <!-- CONTENT (SCROLL DI SINI) -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8">

            @if(session('success'))
                <div class="mb-6 px-4 py-3 rounded-xl text-sm"
                     style="background-color: #ecfdf3; color: #047857;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 px-4 py-3 rounded-xl text-sm"
                     style="background-color: #fde8e8; color: #b91c1c;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>

</body>
</html>