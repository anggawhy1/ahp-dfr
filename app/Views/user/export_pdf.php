<html>

<head>
    <style>
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 3px double #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            color: #1e40af;
            text-transform: uppercase;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }

        .section-title {
            background-color: #f1f5f9;
            padding: 8px 12px;
            border-left: 5px solid #1e40af;
            font-size: 16px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
            font-size: 13px;
        }

        .table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: bold;
        }

        .level-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-weight: bold;
            background-color: #1e40af;
            color: white;
            text-transform: uppercase;
            font-size: 12px;
        }

        .summary-box {
            margin-top: 30px;
            padding: 20px;
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
        }

        .summary-box strong {
            color: #1e40af;
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .summary-box em {
            font-style: italic;
            color: #1e3a8a;
            font-size: 14px;
        }

        .footer {
            margin-top: 50px;
            font-size: 10px;
            text-align: center;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Kesiapan Forensik Digital</h2>
        <p>Institusi: <?= $campus->nama_kampus ?></p>
        <p>Waktu Assessment: <?= date('d F Y, H:i', strtotime($result->created_at)) ?></p>
    </div>

    <div class="section-title">Ringkasan Indeks Kesiapan</div>
    <table class="table">
        <tr>
            <th width="40%">Readiness Index (RI)</th>
            <td><strong><?= number_format($result->total_ri, 4, ',', '.') ?></strong> (Skala 1 - 5)</td>
        </tr>
        <tr>
            <th>Normalisasi Skor (Persentase)</th>
            <td><strong><?= number_format($result->ri_100, 2, ',', '.') ?>%</strong></td>
        </tr>
        <tr>
            <th>Maturity Level</th>
            <td><span class="level-badge"><?= $result->maturity_level ?></span></td>
        </tr>
    </table>

    <div class="section-title">Detail Skor Per Elemen</div>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Elemen</th>
                <th style="text-align: center;">Skor Rata-rata</th>
                <th style="text-align: center;">Weighted Score</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>E1 - Strategic (Bobot: 0.3917)</td>
                <td style="text-align: center;"><?= number_format($result->score_e1, 2) ?></td>
                <td style="text-align: center;"><?= number_format($result->ws_e1, 4) ?></td>
            </tr>
            <tr>
                <td>E2 - Governance (Bobot: 0.2999)</td>
                <td style="text-align: center;"><?= number_format($result->score_e2, 2) ?></td>
                <td style="text-align: center;"><?= number_format($result->ws_e2, 4) ?></td>
            </tr>
            <tr>
                <td>E3 - Process (Bobot: 0.1683)</td>
                <td style="text-align: center;"><?= number_format($result->score_e3, 2) ?></td>
                <td style="text-align: center;"><?= number_format($result->ws_e3, 4) ?></td>
            </tr>
            <tr>
                <td>E4 - Technology (Bobot: 0.1401)</td>
                <td style="text-align: center;"><?= number_format($result->score_e4, 2) ?></td>
                <td style="text-align: center;"><?= number_format($result->ws_e4, 4) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="summary-box">
        <strong>Kesimpulan dan Rekomendasi:</strong>
        <em>"<?= $conclusion ?>"</em>
    </div>

    <div class="footer">
        Laporan ini dibuat secara otomatis oleh DFR Assessment System pada <?= date('d/m/Y H:i:s') ?>.<br>
        Seluruh perhitungan menggunakan metode Analytical Hierarchy Process (AHP).
    </div>
</body>

</html>