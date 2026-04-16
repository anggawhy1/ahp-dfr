<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - DFR System</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen py-8">
    <div class="bg-white p-6 sm:p-10 rounded-3xl shadow-xl w-full max-w-md mx-4 border border-slate-100">
        <div class="mb-8 text-center">
            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold shadow-md shadow-blue-100 mx-auto mb-4 text-xl">D</div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">Daftar Akun</h1>
            <p class="text-slate-500 mt-2 text-sm sm:text-base">Daftarkan institusi Anda untuk memulai assessment.</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-medium border border-red-100 flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="/register/process" method="POST" class="space-y-4 sm:space-y-5">
            <div>
                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Username</label>
                <input type="text" name="username" required placeholder="admin_kampus"
                    class="w-full px-4 py-3 sm:px-5 sm:py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Nama Penanggung Jawab</label>
                <input type="text" name="nama_lengkap" required placeholder="Contoh: Budi Santoso, S.Kom"
                    class="w-full px-4 py-3 sm:px-5 sm:py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Nama Institusi / Kampus</label>
                <input type="text" name="nama_kampus" required placeholder="Contoh: Universitas Alma Ata"
                    class="w-full px-4 py-3 sm:px-5 sm:py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Email Resmi</label>
                <input type="email" name="email" required placeholder="admin@institusi.ac.id"
                    class="w-full px-4 py-3 sm:px-5 sm:py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm sm:text-base">
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5 sm:mb-2">Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                    class="w-full px-4 py-3 sm:px-5 sm:py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-sm sm:text-base">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-3.5 sm:py-4 rounded-2xl shadow-lg shadow-blue-200 transition transform active:scale-95 text-sm sm:text-base mt-2">
                Buat Akun Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-slate-500 text-xs sm:text-sm">
            Sudah punya akun? <a href="/login" class="text-blue-600 font-bold hover:underline">Login di sini</a>
        </p>
    </div>
</body>

</html>