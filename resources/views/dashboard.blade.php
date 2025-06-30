<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Koperasi Siswa</title>
    
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f9fafb;
            color: #1f2937;
        }

        nav {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #111827;
        }

        .btn {
            padding: 0.5rem 1rem;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        header {
            padding: 3rem 2rem 2rem;
            text-align: center;
        }

        header h1 {
            font-size: 2.25rem;
            font-weight: bold;
        }

        header p {
            margin-top: 0.5rem;
            color: #6b7280;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .card h3 {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 1.5rem;
            font-weight: bold;
            color: #111827;
            margin: 0;
        }

        .chart-container {
            padding: 2rem;
            background-color: #ffffff;
            margin: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        footer {
            text-align: center;
            padding: 2rem;
            font-size: 0.875rem;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">Koperasi Siswa</div>
        <div>
            @if (!Auth::check())
                <a href="{{ url('/admin') }}" class="btn">Login Admin</a>
            @else
                <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn">Ke Panel Admin</a>
            @endif
        </div>
    </nav>

    <header>
        <h1>Selamat Datang di Inventory App</h1>
        <p>Kelola stok barang, vendor, pembelian, dan keuangan koperasi dengan mudah.</p>
    </header>

    <section class="stats">
        <div class="card">
            <h3>Total Produk</h3>
            <p>120</p>
        </div>
        <div class="card">
            <h3>Vendor Terdaftar</h3>
            <p>8</p>
        </div>
        <div class="card">
            <h3>Kategori Terlaris</h3>
            <p>Makanan Ringan</p>
        </div>
        <div class="card">
            <h3>Keuntungan Bulan Ini</h3>
            <p>Rp 1.200.000</p>
        </div>
    </section>

    <div class="chart-container">
        <h2 style="margin-bottom: 1rem;">Grafik Penjualan 6 Bulan Terakhir</h2>
        <canvas id="salesChart" height="80"></canvas>
    </div>

    <footer>
        &copy; {{ now()->year }} Koperasi Siswa. All rights reserved.
    </footer>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Total Penjualan',
                    data: [1200000, 1500000, 900000, 1800000, 1600000, 2100000],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
