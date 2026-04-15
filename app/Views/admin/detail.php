<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-6">

        <div class="flex items-center gap-4">
            <a href="/admin/rekap" class="p-2.5 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition active:scale-95 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Detail Analisis</h2>
                <p class="text-slate-500 font-medium text-sm mt-1">Institusi: <span class="text-slate-800 font-bold"><?= $campus->nama_kampus ?></span></p>
            </div>
        </div>

        <div class="flex gap-3 mt-2 md:mt-0">
            <a href="/admin/export/<?= $result->id ?>" class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white font-bold rounded-xl shadow-md shadow-red-100 hover:bg-red-700 transition gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Cetak PDF
            </a>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
            <p class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-1">Readiness Index (RI)</p>
            <h3 class="text-4xl font-extrabold text-slate-900"><?= number_format($result->total_ri, 4, ',', '.') ?></h3>
            <p class="text-[10px] text-slate-400 mt-2 font-medium italic">Skala penilaian 1.00 - 5.00</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
            <p class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-1">Normalisasi 100</p>
            <h3 class="text-4xl font-extrabold text-slate-900"><?= number_format($result->ri_100, 2, ',', '.') ?><span class="text-lg text-slate-400">%</span></h3>
            <div class="mt-3 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="bg-blue-600 h-full" style="width: <?= $result->ri_100 ?>%"></div>
            </div>
        </div>

        <?php
        $levelColor = match ($result->maturity_level) {
            'Initial'    => 'text-red-600 bg-red-50 border-red-100',
            'Repeatable' => 'text-orange-600 bg-orange-50 border-orange-100',
            'Defined'    => 'text-blue-600 bg-blue-50 border-blue-100',
            'Managed'    => 'text-indigo-600 bg-indigo-50 border-indigo-100',
            'Optimized'  => 'text-green-600 bg-green-50 border-green-100',
            default      => 'text-slate-600 bg-slate-50 border-slate-100'
        };
        ?>
        <div class="p-6 rounded-2xl border <?= $levelColor ?> shadow-sm flex flex-col justify-center">
            <p class="text-[10px] font-bold uppercase tracking-widest mb-1 opacity-70">Maturity Level</p>
            <h3 class="text-3xl font-black italic uppercase"><?= $result->maturity_level ?></h3>
            <p class="text-[10px] mt-1 font-bold opacity-80 italic">Status Kesiapan Forensik Digital</p>
        </div>
    </div>

    <div class="bg-white p-6 lg:p-8 rounded-3xl border border-slate-200 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
            <h4 class="font-extrabold text-slate-800 tracking-tight">Kesimpulan & Rekomendasi Strategis</h4>
        </div>
        <div class="bg-slate-50 border border-slate-100 p-6 rounded-2xl">
            <p class="text-slate-700 leading-relaxed italic text-sm md:text-base">
                "<?= $conclusion ?>"
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-6 lg:p-8 rounded-3xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Radar Sebaran Elemen</h3>
                <span class="text-[10px] font-bold bg-slate-100 px-2 py-1 rounded text-slate-500 italic uppercase">Skor Rata-rata</span>
            </div>
            <div class="h-80 w-full">
                <canvas id="radarChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 lg:p-8 rounded-3xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Weighted Score (Kontribusi)</h3>
                <span class="text-[10px] font-bold bg-blue-50 px-2 py-1 rounded text-blue-600 italic uppercase">Hasil Akhir</span>
            </div>
            <div class="h-80 w-full">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
    const labels = ['E1: Strategic', 'E2: Governance', 'E3: Process', 'E4: Technology'];
    const skorData = [<?= $result->score_e1 ?>, <?= $result->score_e2 ?>, <?= $result->score_e3 ?>, <?= $result->score_e4 ?>];
    const wsData = [<?= $result->ws_e1 ?>, <?= $result->ws_e2 ?>, <?= $result->ws_e3 ?>, <?= $result->ws_e4 ?>];

    // Radar Chart
    new Chart(document.getElementById('radarChart'), {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Skor',
                data: skorData,
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderColor: '#2563eb',
                pointBackgroundColor: '#2563eb',
                borderWidth: 2,
            }]
        },
        options: {
            scales: {
                r: {
                    beginAtZero: true,
                    max: 5,
                    ticks: {
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

    // Bar Chart
    const ctxBar = document.getElementById('barChart').getContext('2d');

    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: wsData,
                // WARNA DIUBAH JADI 4 WARNA SEPERTI DI USER
                backgroundColor: ['#3b82f6', '#ef4444', '#10b981', '#8b5cf6'],
                borderRadius: 8,
                barThickness: 25
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    grid: {
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
</script>
<?= $this->endSection() ?>