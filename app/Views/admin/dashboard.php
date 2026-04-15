<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Ringkasan Statistik</h2>
            <p class="text-slate-500 font-medium text-sm mt-1">Data akumulasi kesiapan forensik digital seluruh universitas.</p>
        </div>
        <div class="text-slate-400 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Update: <?= date('d M Y') ?>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"></path>
                </svg>
            </div>
            <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Total Institusi</p>
            <h3 class="text-3xl font-extrabold text-slate-900"><?= $total_kampus ?></h3>
            <p class="text-xs text-slate-400 mt-2 font-medium">Universitas terdaftar</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-12 h-12 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Laporan Masuk</p>
            <h3 class="text-3xl font-extrabold text-slate-900"><?= $total_assessment ?></h3>
            <p class="text-xs text-slate-400 mt-2 font-medium">Hasil assessment selesai</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-12 h-12 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Rata-rata Index</p>
            <h3 class="text-3xl font-extrabold text-slate-900"><?= number_format($avg_readiness, 2) ?><span class="text-lg">%</span></h3>
            <div class="mt-2 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="bg-orange-500 h-full" style="width: <?= $avg_readiness ?>%"></div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-3 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            </div>
            <p class="text-slate-500 font-bold text-xs uppercase tracking-widest mb-1">Skor Tertinggi</p>
            <h3 class="text-sm font-extrabold text-purple-700 leading-tight min-h-[2.5rem] flex items-center">
                <?= $top_kampus->nama_kampus ?? 'Belum ada data' ?>
            </h3>
            <div class="flex items-center gap-2 mt-1">
                <span class="text-[10px] font-bold text-slate-800"><?= number_format($top_kampus->ri_100 ?? 0, 2) ?>% Index</span>
            </div>
        </div>

    </div>

    <div class="bg-white p-6 lg:p-10 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 border-b border-slate-100 pb-6">
            <div>
                <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">Perbandingan Antar Kampus</h3>
                <p class="text-slate-400 font-semibold text-xs mt-1">Analisis distribusi Readiness Index berdasarkan hasil input institusi.</p>
            </div>
            <div class="px-3 py-1.5 bg-blue-50 border border-blue-100 rounded-lg text-[10px] font-bold text-blue-600 uppercase">
                Analytical Hierarchy Process
            </div>
        </div>

        <div class="h-[400px] w-full">
            <canvas id="compareChart"></canvas>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('compareChart').getContext('2d');

    // Gradasi Biru Pro
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.7)');
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0.05)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($comparison as $c) echo '"' . $c['nama_kampus'] . '",'; ?>],
            datasets: [{
                data: [<?php foreach ($comparison as $c) echo $c['ri_100'] . ','; ?>],
                backgroundColor: gradient,
                borderColor: '#1e40af',
                borderWidth: 1.5,
                borderRadius: 8,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    bottom: 20
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#64748b',
                        font: {
                            weight: 'bold',
                            size: 10
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#334155',
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 0,
                        sampleSize: 100
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>