<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Transaksi Keuangan</title>
    <style>
        @page { margin: 20px 25px; } /* Atur margin halaman */
        body {
            font-family: 'system-ui', Helvetica, Arial;
            margin: 0;
            padding: 0;
            background-color: #F5F7FA;
            color: #2d3748;
            line-height: 1.4;
            font-size: 12px;
        }
        .container {
            padding: 15px 20px;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .logo-container {
            width: 70px;
            height: 70px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
        .title {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            color: #1a365d;
        }
        .subtitle {
            font-size: 12px;
            color: #718096;
            margin: 0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }
        .info-card {
            background: white;
            border-radius: 8px;
            padding: 10px;
            border-left: 4px solid #4299e1;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .info-label { font-size: 11px; color: #718096; }
        .info-value { font-size: 13px; font-weight: 600; color: #2d3748; }

        table.transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 12px;
        }
        table.transaction-table thead {
            background: #DCFAF8;
            display: table-header-group; /* Agar header muncul di halaman berikutnya */
        }
        table.transaction-table th {
            color: #333;
            font-weight: 600;
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        table.transaction-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
        }
        .badge-income { background: #c6f6d5; color: #22543d; }
        .badge-expense { background: #fed7d7; color: #742a2a; }
        .amount { text-align: right; }
        .footer {
            margin-top: 10px;
            font-size: 11px;
            text-align: center;
            color: #718096;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="logo-container">LOGO</div>
        <div>
            <h1 class="title">Laporan Transaksi Keuangan</h1>
            <p class="subtitle">Sistem Manajemen Keuangan Digital</p>
        </div>
    </div>
    <div class="info-grid">
        <div class="info-card">
            <span class="info-label">Periode Laporan</span>
            <span class="info-value">{{ \Carbon\Carbon::parse($start)->format('d M Y') }} - {{ \Carbon\Carbon::parse($end)->format('d M Y') }}</span>
        </div>
        <div class="info-card">
            <span class="info-label">Tanggal Cetak</span>
            <span class="info-value">{{ now()->format('d M Y H:i') }}</span>
        </div>
    </div>
    <table class="transaction-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $trx)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                <td>
                    <span class="badge badge-{{ $trx->tipe === 'pemasukan' ? 'income' : 'expense' }}">
                        {{ ucfirst($trx->tipe) }}
                    </span>
                </td>
                <td>{{ $trx->keterangan }}</td>
                <td class="amount {{ $trx->tipe === 'pemasukan' ? 'income' : 'expense' }}">
                    Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Dokumen ini dicetak otomatis oleh sistem pada {{ now()->format('d M Y H:i') }}
    </div>
</div>
</body>
</html>
