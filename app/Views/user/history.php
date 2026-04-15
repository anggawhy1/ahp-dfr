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
                        <div x-show="profileOpen" x-transition class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50" style="display: none;">
                            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Login Sebagai</p>
                                <p class="text-sm font-extrabold text-slate-800 truncate mt-0.5"><?= session()->get('username') ?></p>
                            </div>
                            <div class="py-1">
                                <a href="/user/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span class="font-bold">Dashboard</span>
                                </a>
                                <div class="h-px bg-slate-100 my-1 mx-4"></div>
                                <button @click="profileOpen = false; showLogoutModal()" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition group text-left">
                                    <svg class="w-4 h-4 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <div class="max-w-4xl mx-auto px-4 mt-8 space-y-8">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-200 pb-6">
            <div class="flex items-center gap-3">
                <a href="/user/dashboard" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition active:scale-95 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Riwayat Jawaban</h2>
                    <p class="text-gray-500 text-sm mt-1">Tanggal Input: <?= date('d M Y, H:i', strtotime($assessment->created_at)) ?> WIB</p>
                </div>
            </div>
            <div class="bg-blue-50 border border-blue-100 px-4 py-2 rounded-xl">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block mb-0.5">Nilai Akhir RI</span>
                <span class="text-xl font-black text-blue-800"><?= number_format($assessment->total_ri, 4, ',', '.') ?></span>
            </div>
        </div>

        <div class="space-y-10">
            <?php
            $elements = ['E1' => 'Strategic', 'E2' => 'Governance', 'E3' => 'Process', 'E4' => 'Technology'];
            foreach ($elements as $key => $title):
            ?>
                <section class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-slate-800 px-6 py-4 flex items-center justify-between">
                        <h3 class="text-white font-bold text-lg">Elemen <?= $key ?></h3>
                        <span class="px-3 py-1 bg-slate-700 text-slate-200 text-xs font-bold rounded-lg uppercase tracking-wider"><?= $title ?></span>
                    </div>
                    <div class="p-6 space-y-6">
                        <?php foreach ($answers as $ans): if ($ans['element'] == $key): ?>
                                <div class="flex flex-col sm:flex-row gap-4 border-b border-slate-50 pb-6 last:border-0 last:pb-0">
                                    <div class="shrink-0 flex sm:flex-col items-center gap-3 sm:gap-1">
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest sm:hidden">Skor:</span>
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-xl font-black bg-blue-600 text-white shadow-lg shadow-blue-200 border-2 border-white">
                                            <?= $ans['skor'] ?>
                                        </div>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest hidden sm:block mt-1">Skor</span>
                                    </div>

                                    <div class="flex-1">
                                        <p class="text-slate-800 font-medium leading-relaxed text-sm md:text-base">
                                            <span class="text-blue-600 font-bold mr-1"><?= $ans['code'] ?>.</span> <?= $ans['statement'] ?>
                                        </p>
                                    </div>
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>

        <div class="pb-10 pt-4 flex justify-center">
            <a href="/user/dashboard" class="px-8 py-3.5 bg-slate-800 text-white font-bold rounded-2xl shadow-lg shadow-slate-200 hover:bg-slate-900 transition active:scale-95 text-center w-full sm:w-auto">
                Selesai & Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div id="logoutModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-black text-center text-gray-900 mb-2">Yakin ingin keluar?</h3>
            <p class="text-center text-gray-500 mb-8 text-sm leading-relaxed">Sesi Anda akan diakhiri.</p>
            <div class="flex gap-3">
                <button onclick="closeLogoutModal()" class="flex-1 py-3 px-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</button>
                <a href="/logout" class="flex-1 py-3 px-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 text-center transition">Ya, Keluar</a>
            </div>
        </div>
    </div>

    <script>
        function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
</body>

</html>