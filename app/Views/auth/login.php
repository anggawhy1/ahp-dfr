<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DFR Index</title>
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-10 rounded-3xl shadow-xl w-full max-w-md border border-slate-100">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-black text-slate-800">Login Sistem</h1>
            <p class="text-slate-500 mt-2">Masuk untuk melanjutkan ke dashboard DFR.</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-medium border border-red-100 italic text-center">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 text-sm font-medium border border-emerald-100 italic text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/login/process') ?>" method="POST" class="space-y-5">
            <div>
                <label for="username" class="block text-sm font-bold text-slate-700 mb-2">Username</label>
                <input type="text" name="username" id="username" required placeholder="admin_kampus"
                    class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
            </div>

            <div>
                <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required placeholder="••••••••"
                    class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-200 transition transform active:scale-95 mt-2">
                Masuk Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-slate-500 text-sm">
            Belum mendaftarkan universitas? <br>
            <a href="/register" class="text-blue-600 font-bold hover:underline">Daftar di sini</a>
        </p>
    </div>

</body>

</html>