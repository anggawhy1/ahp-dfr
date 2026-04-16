<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - DFR Admin</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Obat sakti anti nge-jeplak / kesetrum (FOUC) saat pertama kali loading */
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-900" 
      x-data="{ 
          sidebarOpen: localStorage.getItem('sidebarState') !== null ? localStorage.getItem('sidebarState') === 'true' : window.innerWidth >= 1024, 
          logoutModalOpen: false 
      }"
      x-init="$watch('sidebarOpen', val => localStorage.setItem('sidebarState', val))">

    <aside 
        x-cloak
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-300 ease-in-out shadow-lg lg:shadow-none -translate-x-full">
        
        <div class="h-full flex flex-col p-5 w-64 relative">
            
            <div class="flex items-center justify-between mb-8 px-2">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold shadow-md shadow-blue-100">D</div>
                    <span class="font-extrabold text-lg tracking-tight">DFR <span class="text-blue-600">System</span></span>
                </div>
                
                <button @click="sidebarOpen = false" class="lg:hidden p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors focus:outline-none active:scale-90">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 space-y-1">
                <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Menu</p>
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition <?= (strpos(uri_string(), 'admin/dashboard') !== false) ? 'bg-blue-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50' ?> font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    Dashboard
                </a>
                <a href="/admin/rekap" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition <?= (strpos(uri_string(), 'admin/rekap') !== false || strpos(uri_string(), 'admin/detail') !== false) ? 'bg-blue-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50' ?> font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Rekapitulasi
                </a>
                <a href="/admin/indikator" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition <?= (strpos(uri_string(), 'admin/indikator') !== false) ? 'bg-blue-600 text-white shadow-md' : 'text-slate-500 hover:bg-slate-50' ?> font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Master Indikator
                </a>
            </nav>

            <div class="pt-5 border-t border-slate-100">
                <button @click="logoutModalOpen = true" class="w-full flex items-center gap-3 px-4 py-2 rounded-xl text-red-500 hover:bg-red-50 transition font-bold text-sm focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen transition-all duration-300" :class="sidebarOpen ? 'lg:pl-64' : 'lg:pl-0'">
        
        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40 px-4 lg:px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg bg-slate-50 text-slate-600 hover:bg-blue-50 transition border border-slate-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
                <h1 class="font-bold text-slate-700 text-sm hidden sm:block">Administrator Panel</h1>
            </div>
            
            <div class="relative" x-data="{ profileOpen: false }">
                <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center gap-2 sm:gap-3 focus:outline-none transition-transform active:scale-95">
                    
                    <div class="text-right leading-tight">
                        <p class="text-sm font-bold text-slate-800"><?= session()->get('username') ?></p>
                    </div>

                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-black shadow-md shadow-blue-200 hover:bg-blue-700 border-2 border-white transition">
                        <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                    </div>
                </button>

                <div x-show="profileOpen" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50"
                     style="display: none;">
                    
                    <a href="/admin/profile" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span class="font-bold">Pengaturan Akun</span>
                    </a>
                    
                    <button @click="logoutModalOpen = true; profileOpen = false" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition group focus:outline-none">
                        <svg class="w-4 h-4 text-red-400 group-hover:text-red-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-bold">Keluar</span>
                    </button>
                </div>
            </div>

        </header>

        <main class="p-6 lg:p-8">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/30 z-30 lg:hidden" x-transition:enter="transition opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition opacity-100" x-transition:leave-end="opacity-0" style="display: none;"></div>

    <div x-show="logoutModalOpen" class="fixed inset-0 z-[60] flex items-center justify-center px-4" style="display: none;">
        <div x-show="logoutModalOpen" @click="logoutModalOpen = false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <div x-show="logoutModalOpen" class="relative bg-white rounded-3xl shadow-2xl max-w-sm w-full p-6 text-center transform transition-all" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-5">
                <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-slate-900 mb-2">Konfirmasi Keluar</h3>
            <p class="text-sm text-slate-500 mb-8 font-medium">Apakah Anda yakin ingin keluar dari Administrator Panel?</p>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <button @click="logoutModalOpen = false" class="w-full inline-flex justify-center rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none transition active:scale-95">
                    Batal
                </button>
                <a href="/logout" class="w-full inline-flex justify-center rounded-xl border border-transparent bg-red-600 px-4 py-3 text-sm font-bold text-white hover:bg-red-700 focus:outline-none shadow-md shadow-red-200 transition active:scale-95">
                    Ya, Keluar
                </a>
            </div>
        </div>
    </div>

</body>
</html>