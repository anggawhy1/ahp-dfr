<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Assessment - DFR Index</title>
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
                                <a href="/user/profile" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span class="font-bold">Pengaturan Akun</span>
                                </a>
                                
                                <div class="h-px bg-slate-100 my-1 mx-4"></div>
                                
                                <button @click="profileOpen = false; showLogoutModal()" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition group text-left">
                                    <svg class="w-4 h-4 text-red-400 group-hover:text-red-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span class="font-bold">Keluar</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <div id="intro-section" class="max-w-3xl mx-auto px-4 mt-16 text-center transition-all duration-500">
        <div class="bg-white p-10 rounded-3xl shadow-xl border border-slate-100">
            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h2 class="text-3xl font-black text-slate-800 mb-4">Selamat Datang di DFR Assessment</h2>
            <p class="text-slate-500 leading-relaxed mb-8">
                Sistem ini akan mengukur tingkat kesiapan forensik digital (<i>Digital Forensic Readiness</i>) di institusi Anda secara mandiri. Terdapat <b>40 pernyataan</b> yang terbagi dalam 4 elemen utama berdasarkan standar industri.
            </p>
            <div class="bg-blue-50 border border-blue-100 text-blue-800 p-6 rounded-2xl text-sm mb-8 text-left">
                <h4 class="font-bold mb-3 text-blue-900">Petunjuk Pengisian:</h4>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Pilih skor <b>1 hingga 5</b> pada setiap pernyataan yang muncul.</li>
                    <li>Skor <b>1</b> berarti "Sangat Kurang / Belum Ada", sedangkan skor <b>5</b> berarti "Sangat Baik / Optimal".</li>
                    <li>Pastikan Anda mengisi sesuai dengan kondisi aktual dan objektif di universitas Anda.</li>
                    <li>Seluruh pertanyaan (40 butir) wajib diisi sebelum sistem dapat menghitung nilai <i>Maturity Level</i>.</li>
                </ul>
            </div>
            <button type="button" id="btn-mulai" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-lg shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform hover:scale-105 active:scale-95">
                Mengerti, Mulai Assessment Sekarang
            </button>
        </div>
    </div>

    <div id="form-section" class="hidden max-w-4xl mx-auto px-4 mt-10 opacity-0 transition-opacity duration-700">
        <header class="mb-8 text-center">
            <h2 class="text-3xl font-black text-slate-800">Form Self-Assessment</h2>
            <p class="text-slate-500 mt-2">Pilih angka 1-5 untuk setiap pernyataan berikut.</p>
        </header>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-xl mb-8 text-sm font-semibold text-center shadow-sm">
                ⚠ <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/user/assessment/submit" method="POST" class="space-y-10">
            <?php
            $elements = ['E1' => 'Strategic', 'E2' => 'Governance', 'E3' => 'Process', 'E4' => 'Technology'];
            foreach ($elements as $key => $title):
            ?>
                <section class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-slate-800 px-6 py-4 flex items-center justify-between">
                        <h3 class="text-white font-bold text-lg">Elemen <?= $key ?></h3>
                        <span class="px-3 py-1 bg-slate-700 text-slate-200 text-xs font-bold rounded-lg uppercase tracking-wider"><?= $title ?></span>
                    </div>
                    <div class="p-6 md:p-8 space-y-8">
                        <?php foreach ($indicators as $ind): if ($ind['element'] == $key): ?>
                                <div class="border-b border-slate-50 pb-6 last:border-0 last:pb-0">
                                    <p class="text-slate-800 font-medium mb-5 leading-relaxed text-lg">
                                        <span class="text-blue-600 font-bold mr-2"><?= $ind['code'] ?></span> <?= $ind['statement'] ?>
                                    </p>
                                    <div class="flex items-center space-x-2 md:space-x-4 bg-slate-50 p-3 rounded-xl inline-flex">
                                        <span class="text-xs text-slate-400 uppercase font-bold tracking-wider mr-2">Skor:</span>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <label class="flex flex-col items-center cursor-pointer group">
                                                <input type="radio" name="answers[<?= $ind['id'] ?>]" value="<?= $i ?>" required class="sr-only peer">
                                                <div class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-slate-200 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white transition-all duration-200 hover:bg-slate-200 font-bold text-slate-500 peer-checked:shadow-md">
                                                    <?= $i ?>
                                                </div>
                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                        <?php endif; endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>

            <div class="flex justify-between items-center pt-6 pb-10">
                <p class="text-sm text-slate-400 italic hidden md:block">Pastikan 40 pertanyaan telah terjawab.</p>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black text-lg shadow-xl shadow-blue-200 transform transition hover:-translate-y-1 active:scale-95 w-full md:w-auto">
                    Kirim & Hitung Hasil
                </button>
            </div>
        </form>
    </div>

    <div id="logoutModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl transform scale-100 transition-transform">
            <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-black text-center text-gray-900 mb-2">Yakin ingin keluar?</h3>
            <p class="text-center text-gray-500 mb-8 text-sm leading-relaxed">Sesi Anda akan diakhiri dan progres pengisian yang belum disimpan mungkin akan hilang.</p>
            <div class="flex gap-3">
                <button onclick="closeLogoutModal()" class="flex-1 py-3 px-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Batal</button>
                <a href="/logout" class="flex-1 py-3 px-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 text-center transition shadow-lg shadow-red-200">Ya, Keluar</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btn-mulai').addEventListener('click', function() {
            const intro = document.getElementById('intro-section');
            const form = document.getElementById('form-section');
            intro.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                intro.classList.add('hidden');
                form.classList.remove('hidden');
                setTimeout(() => { form.classList.remove('opacity-0'); }, 50);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 500); 
        });

        <?php if (session()->getFlashdata('error')): ?>
            document.getElementById('intro-section').classList.add('hidden');
            document.getElementById('form-section').classList.remove('hidden', 'opacity-0');
        <?php endif; ?>

        // Logika Modal
        function showLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }
        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
</body>
</html>