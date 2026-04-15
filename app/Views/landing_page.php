<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DFR Assessment System - Ukur Kesiapan Forensik Digital</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 font-sans text-slate-900 overflow-x-hidden selection:bg-blue-200 selection:text-blue-900">

    <div class="fixed inset-0 z-[-1] w-full h-full bg-slate-50">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        <div class="absolute left-0 right-0 top-0 -z-10 m-auto h-[310px] w-[310px] rounded-full bg-blue-500 opacity-20 blur-[100px]"></div>
    </div>

    <nav x-data="{ mobileMenuOpen: false }" class="fixed w-full top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-black shadow-lg shadow-blue-200">D</div>
                    <span class="text-2xl font-black tracking-tight text-slate-800">DFR <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Index</span></span>
                </div>

                <div class="hidden md:flex items-center gap-6">
                    <a href="/login" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Masuk Sistem</a>
                    <a href="/register" class="px-6 py-2.5 bg-slate-900 text-white rounded-full text-sm font-bold shadow-lg shadow-slate-900/20 hover:bg-slate-800 transition active:scale-95">Daftar Institusi</a>
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 hover:text-blue-600 focus:outline-none p-2">
                        <svg class="w-6 h-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6" x-show="mobileMenuOpen" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden absolute top-20 left-0 w-full bg-white border-b border-slate-200 shadow-xl" style="display: none;">
            <div class="px-4 py-6 flex flex-col gap-4">
                <a href="/login" class="w-full text-center px-6 py-3 text-slate-600 font-bold bg-slate-50 rounded-xl hover:bg-slate-100">Masuk Sistem</a>
                <a href="/register" class="w-full text-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200">Daftar Institusi</a>
            </div>
        </div>
    </nav>

    <main class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20 lg:pt-48 lg:pb-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div class="text-center lg:text-left z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 text-blue-700 rounded-full text-xs font-black uppercase tracking-widest mb-8">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Metode AHP Pro v1.0
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] mb-6">
                    Ukur Kesiapan <br class="hidden lg:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Digital Forensic</span> Anda.
                </h1>

                <p class="text-base sm:text-lg text-slate-500 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                    Sistem penilaian mandiri berbasis standar internasional untuk mengukur kematangan infrastruktur, proses, dan kebijakan forensik digital di institusi Anda.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-5 justify-center lg:justify-start">
                    <a href="/register" class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-sm lg:text-base shadow-xl shadow-blue-600/30 hover:bg-blue-700 transition transform hover:-translate-y-1 active:scale-95 text-center flex items-center justify-center gap-2">
                        Mulai Assessment
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <div class="flex items-center gap-3 px-2">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-indigo-700 font-bold text-xs">AI</div>
                            <div class="w-10 h-10 rounded-full bg-blue-100 border-2 border-white flex items-center justify-center text-blue-700 font-bold text-xs">CS</div>
                            <div class="w-10 h-10 rounded-full bg-emerald-100 border-2 border-white flex items-center justify-center text-emerald-700 font-bold text-xs">IT</div>
                        </div>
                        <div class="text-left leading-tight">
                            <span class="text-xs text-slate-800 font-black">Digunakan oleh</span><br>
                            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Fakultas Teknologi</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-full max-w-lg mx-auto lg:max-w-none lg:mx-0 mt-10 lg:mt-0 z-10 group perspective">
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-[3rem] rotate-3 -z-10 blur-xl opacity-50 group-hover:opacity-70 transition duration-500"></div>
                <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-[3rem] -rotate-3 -z-10 group-hover:rotate-0 transition duration-500"></div>

                <div class="bg-white/90 backdrop-blur-md p-8 rounded-[2.5rem] shadow-2xl border border-white relative transform transition duration-500 hover:-translate-y-2">

                    <div class="flex justify-between items-start mb-10">
                        <div>
                            <div class="inline-flex items-center gap-1.5 mb-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Maturity Level</p>
                            </div>
                            <h3 class="text-4xl font-black text-slate-800 italic tracking-tight">Optimized</h3>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-slate-400 mb-1 uppercase tracking-wider">Index 100</p>
                            <p class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">92.4%</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between text-xs font-bold text-slate-500 mb-2">
                                <span>E1: Strategic & Governance</span>
                                <span class="text-slate-800">4.8 / 5.0</span>
                            </div>
                            <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full w-[96%]"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-xs font-bold text-slate-500 mb-2">
                                <span>E4: Technology Infrastructure</span>
                                <span class="text-slate-800">4.2 / 5.0</span>
                            </div>
                            <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 rounded-full w-[84%]"></div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 lg:-left-10 bg-white p-4 rounded-2xl shadow-xl border border-slate-100 flex items-center gap-4 animate-bounce hover:animate-none" style="animation-duration: 3s;">
                        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Metodologi</p>
                            <p class="text-sm font-black text-slate-800">AHP Algorithm</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200/60 bg-white/50 backdrop-blur-sm mt-10">
        <div class="max-w-7xl mx-auto px-4 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm font-bold text-slate-400">© <?= date('Y') ?> DFR Assessment System. All rights reserved.</p>
            <div class="flex gap-6 text-sm font-bold text-slate-400">
                <a href="#" class="hover:text-blue-600 transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-blue-600 transition">Panduan Sistem</a>
            </div>
        </div>
    </footer>

</body>

</html>