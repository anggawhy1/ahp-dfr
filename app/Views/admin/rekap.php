<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Rekapitulasi Hasil</h2>
            <p class="text-slate-500 font-medium text-sm mt-2">Daftar seluruh riwayat assessment yang telah dilakukan oleh institusi.</p>
        </div>
        <div class="flex gap-2">
            <span class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 shadow-sm">
                Total Data: <?= count($results) ?>
            </span>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 border-b-2 border-slate-200">
                        <th class="px-5 py-4 font-bold text-slate-700 uppercase text-xs tracking-wider">Institusi</th>
                        <th class="px-5 py-4 font-bold text-slate-700 uppercase text-xs tracking-wider">Waktu Input</th>
                        <th class="px-5 py-4 font-bold text-slate-700 uppercase text-xs tracking-wider text-center">Skor (RI)</th>
                        <th class="px-5 py-4 font-bold text-slate-700 uppercase text-xs tracking-wider text-center">Indeks 100</th>
                        <th class="px-5 py-4 font-bold text-slate-700 uppercase text-xs tracking-wider text-center">Status Level</th>
                        <th class="px-5 py-4 font-bold text-slate-700 uppercase text-xs tracking-wider text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($results)): ?>
                        <tr>
                            <td colspan="6" class="p-10 text-center text-slate-500 font-medium">Belum ada data assessment yang masuk.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($results as $r): ?>
                        <tr class="hover:bg-blue-50/50 transition-colors group">
                            <td class="p-5">
                                <p class="font-extrabold text-slate-800 text-sm leading-tight"><?= $r['nama_kampus'] ?></p>
                                <p class="text-[10px] text-slate-500 font-bold mt-1 uppercase tracking-wider">ID Assessment: #<?= $r['id'] ?></p>
                            </td>
                            <td class="p-5 text-sm font-semibold text-slate-600">
                                <?= date('d M Y', strtotime($r['created_at'])) ?>
                                <span class="block text-[10px] text-slate-400 font-bold mt-0.5"><?= date('H:i', strtotime($r['created_at'])) ?> WIB</span>
                            </td>
                            <td class="p-5 text-center font-mono text-xs font-bold text-slate-700">
                                <?= number_format($r['total_ri'], 4) ?>
                            </td>
                            <td class="p-5 text-center">
                                <span class="text-sm font-black text-blue-600"><?= number_format($r['ri_100'], 2) ?>%</span>
                            </td>
                            <td class="p-5 text-center">
                                <?php
                                $badgeClass = match ($r['maturity_level']) {
                                    'Initial'    => 'bg-red-50 text-red-600 border-red-200',
                                    'Repeatable' => 'bg-orange-50 text-orange-600 border-orange-200',
                                    'Defined'    => 'bg-blue-50 text-blue-600 border-blue-200',
                                    'Managed'    => 'bg-indigo-50 text-indigo-600 border-indigo-200',
                                    'Optimized'  => 'bg-green-50 text-green-600 border-green-200',
                                    default      => 'bg-slate-50 text-slate-600 border-slate-200'
                                };
                                ?>
                                <span class="inline-flex px-3 py-1 rounded-lg border <?= $badgeClass ?> text-[10px] font-black uppercase tracking-wider shadow-sm">
                                    <?= $r['maturity_level'] ?>
                                </span>
                            </td>
                            <td class="p-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="/admin/detail/<?= $r['id'] ?>" class="p-2 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-blue-600 hover:text-white hover:border-blue-600 transition shadow-sm" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="/admin/export/<?= $r['id'] ?>" class="p-2 bg-white border border-slate-200 text-red-500 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition shadow-sm" title="Cetak PDF">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>