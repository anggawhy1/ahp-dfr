<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                <a href="/user/profile" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-bold">Pengaturan Akun</span>
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
    <div class="max-w-6xl mx-auto px-4 mt-8 space-y-8">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium text-sm"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium text-sm"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Hasil Assessment</h2>
                <p class="text-gray-500 text-sm mt-1">Laporan kesiapan pada tanggal <?= date('d M Y', strtotime($result->created_at)) ?></p>
            </div>

            <div class="grid grid-cols-2 sm:flex gap-2 w-full md:w-auto mt-2 md:mt-0">

                <a href="/user/history" class="inline-flex items-center justify-center px-4 py-2.5 sm:py-2 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl shadow-sm hover:bg-slate-50 hover:text-blue-600 transition gap-2 text-xs sm:text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="truncate">Riwayat</span>
                </a>

                <a href="/user/export/<?= $result->id ?>" class="inline-flex items-center justify-center px-4 py-2.5 sm:py-2 bg-white border border-red-100 text-red-500 font-bold rounded-xl shadow-sm hover:bg-red-50 hover:text-red-600 transition gap-2 text-xs sm:text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span class="truncate">Cetak PDF</span>
                </a>

                <a href="/user/assessment" class="col-span-2 sm:col-span-1 inline-flex items-center justify-center px-5 py-2.5 sm:py-2 bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-200 hover:bg-blue-700 transition gap-2 text-sm w-full sm:w-auto">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span>Ulangi Tes</span>
                </a>

            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute right-[-10px] top-[-10px] text-blue-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Readiness Index</p>
                <h2 class="text-4xl font-black text-gray-800"><?= number_format($result->total_ri, 4, ',', '.') ?></h2>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-[10px] px-2 py-0.5 bg-blue-100 text-blue-600 rounded-full font-bold uppercase">Skala 1 - 5</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute right-[-10px] top-[-10px] text-green-50 opacity-50">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Normalisasi 100</p>
                <h2 class="text-4xl font-black text-gray-800"><?= number_format($result->ri_100, 2, ',', '.') ?><span class="text-xl">%</span></h2>
                <div class="mt-4 w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-green-500 h-full" style="width: <?= $result->ri_100 ?>%"></div>
                </div>
            </div>

            <?php
            $levelColor = [
                'Initial' => 'text-red-600 bg-red-50 border-red-200',
                'Repeatable' => 'text-orange-600 bg-orange-50 border-orange-200',
                'Defined' => 'text-blue-600 bg-blue-50 border-blue-200',
                'Managed' => 'text-indigo-600 bg-indigo-50 border-indigo-200',
                'Optimized' => 'text-green-600 bg-green-50 border-green-200',
            ];
            $colorClass = $levelColor[$result->maturity_level] ?? 'text-gray-600 bg-gray-50 border-gray-200';
            ?>
            <div class="p-6 rounded-3xl shadow-sm border <?= $colorClass ?> flex flex-col justify-center sm:col-span-2 md:col-span-1">
                <p class="text-xs font-bold uppercase tracking-widest mb-1 opacity-70">Maturity Level</p>
                <h2 class="text-3xl font-black"><?= $result->maturity_level ?></h2>
                <p class="text-[11px] mt-2 font-semibold">Status Kesiapan Forensik Digital</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                    <h3 class="text-lg font-bold text-gray-800">Radar Sebaran Elemen</h3>
                </div>
                <div class="h-64 md:h-80 w-full"><canvas id="radarChart"></canvas></div>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-2 h-6 bg-indigo-600 rounded-full"></div>
                    <h3 class="text-lg font-bold text-gray-800">Weighted Score (Kontribusi)</h3>
                </div>
                <div class="h-64 md:h-80 w-full"><canvas id="barChart"></canvas></div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-800">Kesimpulan & Rekomendasi</h3>
            </div>
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <p class="text-gray-700 leading-relaxed italic text-sm md:text-base">
                    "<?= $conclusion ?? 'Berdasarkan hasil assessment, universitas Anda berada pada level <strong>' . $result->maturity_level . '</strong>. Disarankan untuk terus meningkatkan koordinasi antar elemen strategis dan teknologi.' ?>"
                </p>
            </div>
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
        function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        const labels = ['E1: Strategic', 'E2: Governance', 'E3: Process', 'E4: Technology'];
        const skorData = [<?= $result->score_e1 ?>, <?= $result->score_e2 ?>, <?= $result->score_e3 ?>, <?= $result->score_e4 ?>];
        const wsData = [<?= $result->ws_e1 ?>, <?= $result->ws_e2 ?>, <?= $result->ws_e3 ?>, <?= $result->ws_e4 ?>];

        new Chart(document.getElementById('radarChart'), {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Elemen',
                    data: skorData,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 3,
                    pointRadius: 4
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 5,
                        ticks: {
                            stepSize: 1,
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                maintainAspectRatio: false
            }
        });

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: wsData,
                    backgroundColor: ['#3b82f6', '#ef4444', '#10b981', '#8b5cf6'],
                    borderRadius: 12,
                    barThickness: 40
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                maintainAspectRatio: false
            }
        });
    </script>
</body>

</html>