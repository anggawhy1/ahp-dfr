<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto mt-4 space-y-6">

    <div class="flex items-center gap-4 mb-2">
        <a href="/admin/dashboard" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition active:scale-95 flex-shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Profil Keamanan Admin</h2>
            <p class="text-slate-500 font-medium text-sm mt-1">Kelola kredensial login untuk Administrator Pusat.</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-bold text-sm"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-bold text-sm"><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 md:p-8 rounded-[2rem] border border-slate-200 shadow-sm">
        <form action="/admin/profile/update" method="POST" class="space-y-6">

            <div class="flex items-center gap-3 p-4 bg-blue-50 border border-blue-100 rounded-2xl mb-6">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-blue-600 uppercase tracking-widest">Hak Akses Sistem</p>
                    <p class="text-sm font-extrabold text-slate-800">Super Administrator</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Username Baru</label>
                <input type="text" name="username" value="<?= session()->get('username') ?>" required
                    class="w-full px-5 py-3.5 bg-slate-50 rounded-xl border border-slate-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition font-semibold text-slate-800">
            </div>

            <hr class="border-slate-100">

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Password Baru <span class="text-[10px] font-normal lowercase tracking-normal text-slate-400 ml-1">(Kosongkan jika tidak diubah)</span></label>
                <input type="password" name="new_password" placeholder="••••••••"
                    class="w-full px-5 py-3.5 bg-slate-50 rounded-xl border border-slate-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition font-semibold">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                <input type="password" name="confirm_password" placeholder="Ulangi password baru"
                    class="w-full px-5 py-3.5 bg-slate-50 rounded-xl border border-slate-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition font-semibold">
            </div>

            <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                <a href="/admin/dashboard" class="w-full sm:w-auto px-6 py-3.5 text-slate-500 font-bold hover:bg-slate-100 rounded-xl transition text-center text-sm">Batal</a>
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-200 hover:bg-blue-700 transition active:scale-95 text-sm">
                    Simpan Pembaruan
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>