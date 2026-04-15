<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 pb-20 font-sans text-gray-900">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between min-h-[4.5rem] py-2 items-center gap-4">

                <div class="flex items-center gap-2 shrink-0">
                    <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md shadow-blue-100">D</div>
                    <span class="font-extrabold text-xl tracking-tight text-gray-800">DFR <span class="text-blue-600 hidden sm:inline">System</span></span>
                </div>

                <div class="flex items-center gap-3 sm:gap-4 justify-end flex-1">

                    <div class="text-right leading-tight flex flex-col justify-center">
                        <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-widest mb-0.5">Institusi</p>
                        <p class="text-xs sm:text-sm font-extrabold text-gray-800 truncate max-w-[140px] sm:max-w-xs"><?= $campus->nama_kampus ?></p>
                    </div>

                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white font-black shadow-md shadow-blue-200 hover:bg-blue-700 border-2 border-white transition focus:outline-none active:scale-95 shrink-0">
                            <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                        </button>

                        <div x-show="profileOpen"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50"
                            style="display: none;">

                            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Login Sebagai</p>
                                <p class="text-sm font-extrabold text-slate-800 truncate mt-0.5"><?= session()->get('username') ?></p>
                            </div>

                            <div class="py-1">
                                <a href="/user/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span class="font-bold">Kembali ke Dashboard</span>
                                </a>

                                <div class="h-px bg-slate-100 my-1 mx-4"></div>

                                <button @click="profileOpen = false; showLogoutModal()" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition group text-left">
                                    <svg class="w-4 h-4 text-red-400 group-hover:text-red-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span class="font-bold">Keluar</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-3xl mx-auto px-4 mt-10">

        <div class="mb-8 flex items-center gap-3">
            <a href="/user/dashboard" class="p-2 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900">Pengaturan Akun</h2>
                <p class="text-gray-500 mt-1">Kelola informasi kredensial login universitas Anda.</p>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 mb-6">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium text-sm"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3 mb-6">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium text-sm"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
            <form action="/user/profile/update" method="POST" class="space-y-6">

                <div>
                    <label class="block text-sm font-bold text-slate-400 mb-2">Nama Kampus Terdaftar</label>
                    <input type="text" value="<?= $campus->nama_kampus ?>" disabled
                        class="w-full px-4 py-3 bg-gray-100 text-gray-500 rounded-xl border border-gray-200 cursor-not-allowed">
                    <p class="text-xs text-slate-400 mt-2 italic">*Nama kampus hanya bisa diubah oleh Administrator Pusat.</p>
                </div>

                <hr class="border-gray-100">

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Username Login</label>
                    <input type="text" name="username" value="<?= session()->get('username') ?>" required
                        class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru <span class="text-xs font-normal text-slate-400">(Kosongkan jika tidak ingin diubah)</span></label>
                    <input type="password" name="new_password" placeholder="••••••••"
                        class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" placeholder="Ulangi password baru"
                        class="w-full px-4 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="/user/dashboard" class="px-6 py-3 text-slate-500 font-bold hover:bg-slate-100 rounded-xl transition">Batal</a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-200 hover:bg-blue-700 transition active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="logoutModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl transform scale-100 transition-transform">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-black text-center text-gray-900 mb-2">Yakin ingin keluar?</h3>
            <p class="text-center text-gray-500 mb-8 text-sm leading-relaxed">Sesi Anda akan diakhiri dan Anda harus masuk kembali untuk melihat hasil assessment.</p>
            <div class="flex gap-3">
                <button onclick="closeLogoutModal()" class="flex-1 py-3 px-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</button>
                <a href="/logout" class="flex-1 py-3 px-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 text-center transition shadow-lg shadow-red-200">Ya, Keluar</a>
            </div>
        </div>
    </div>

    <script>
        // Logika Modal Logout
        function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
</body>

</html>