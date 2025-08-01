<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Keuangan</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path('fonts/dejavu-sans/DejaVuSans.ttf') }}');
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 10px;
            font-size: 11px;
            line-height: 1.3;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .logo-placeholder {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            border: 1px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #999;
            font-size: 9px;
        }
        .header-content {
            flex-grow: 1;
        }
        .title {
            font-size: 14px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 3px 0;
        }
        .period {
            font-size: 11px;
            color: #7f8c8d;
        }
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        .transaction-table thead th {
            background-color: #f0f0f0;
            color: #333;
            padding: 6px 8px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #ddd;
            font-size: 10px;
        }
        .transaction-table tbody td {
            padding: 5px 8px;
            border: 1px solid #e0e0e0;
            vertical-align: top;
        }
        .amount {
            text-align: right;
            font-family: 'DejaVu Sans', monospace;
        }
        .pemasukan {
            background-color: #92f792; /* Hijau sangat tipis */
        }
        .pengeluaran {
            background-color: #fff0f0; /* Merah sangat tipis */
        }
        .footer {
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px solid #eee;
            font-size: 9px;
            color: #95a5a6;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-placeholder">
            [LOGO]
        </div>
        <div class="header-content">
            <h1 class="title">LAPORAN TRANSAKSI KEUANGAN</h1>
            <div class="period">Periode: {{ date('d/m/Y', strtotime($start)) }} - {{ date('d/m/Y', strtotime($end)) }}</div>
        </div>
    </div>

    <table class="transaction-table">
        <thead>
            <tr>
                <th width="15%">Tanggal</th>
                <th width="15%">Tipe</th>
                <th width="25%">Jumlah</th>
                <th width="45%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr class="{{ $trx->tipe === 'pemasukan' ? 'pemasukan' : 'pengeluaran' }}">
                <td>{{ date('d/m/Y', strtotime($trx->tanggal)) }}</td>
                <td style="text-transform: capitalize;">{{ $trx->tipe }}</td>
                <td class="amount">Rp {{ number_format($trx->jumlah, 0, ',', '.') }}</td>
                <td>{{ $trx->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh sistem pada {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>