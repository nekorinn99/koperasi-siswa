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
            background-color: #F8F9FA;
            color: #1f2937;
        }

        nav {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            border-radius: 0px 0 20px 20px;
        }

        .logo {
            direction: rtl;
            line-height: 20px;
            color: #111827;
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            height: 50px;
            width: auto;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: black;
            margin: 0;
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
            text-align: center;
            line-height: 1.5;
            align-items: start;
        }

        .stats>div {
            justify-content: flex-start;
            align-items: center;
            height: 100%;
            padding: 1rem;
        }

        .card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            text-align: center;
            opacity: 0;
            transform: translateY(20px);

            /* mengatur kecepatan animasi */
            animation: fadeInDown 1s ease-out forwards;
            -webkit-font-smoothing: antialiased;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: rotateY(0);
            }
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

      /* mengatur jatuhnya text   | */     /* | mengatur masuknya text */
            animation: fadeInDown 1s ease-out 2.4s both;
            -webkit-font-smoothing: antialiased;
        }

        .chart-container {
            padding: 2rem;
            background-color: #ffffff;
            margin: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        footer {
            text-align: center;
            padding: 2rem;
            font-size: 0.875rem;
            color: #9ca3af;
        }

        .header-animasi {
            padding: 3.2rem;
            background: white;
            border-radius: 20px;
        }

        .title-animasi {
            animation: fadeInDown 1s ease-out both;
            color: #2d3748;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .desc-animasi {
            animation: fadeInDown 1s ease-out 1.5s both;
            color: #4a5568;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 600px;
            margin: 0.5rem auto 0;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);

            /* teknik anti-aliasing untuk memperjelas teks */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">
            <h1 class="logo-text">Koperasi Siswa</h1>
            <img class="logo-img" src="https://1.bp.blogspot.com/-z4kQkYRpTcY/VJf62-w7-hI/AAAAAAAABS4/ZAvhzyDGZJw/s1600/SMK%2BNegeri%2B9%2BMalang.jpg" width="40" height="65">
        </div>
        <div>
            @if (!Auth::check())
            <a href="{{ url('/admin') }}" class="btn">Login Admin</a>
            @else
            <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn">Ke Panel Admin</a>
            @endif
        </div>
    </nav>
    <br>
    <header class="header-animasi">
        <h1 class="title-animasi">Selamat Datang di Inventory App</h1>
        <p class="desc-animasi">Kelola stok barang, vendor, pembelian, dan keuangan koperasi dengan mudah.</p>
    </header>

    <section class="stats">
        <div class="card">
            <h3>Total Produk</h3>
            <p>120</p>
        </div>
        <div class="card">
            <h3>Daftar Vendor</h3>
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
