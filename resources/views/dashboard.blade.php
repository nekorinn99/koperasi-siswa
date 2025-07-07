<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Koperasi Siswa</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --secondary: #10b981;
            --dark: #1e293b;
            --light: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        }

        .card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chart-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: opacity 0.3s ease;
        }

        .nav-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .stats-icon {
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading-overlay {
            position: relative;
        }

        .loading-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.7);
            z-index: 10;
            display: none;
        }

        .loading-overlay.loading::before {
            display: block;
        }
    </style>
</head>

<body class="min-h-screen">

    <!-- navbar -->
    <nav class="bg-white nav-shadow py-4 px-6 lg:px-8 flex items-center justify-between sticky top-0 z-50 rounded-b-xl">
        <div class="flex items-center space-x-3">
            <img class="h-12 w-8"
                src="https://1.bp.blogspot.com/-z4kQkYRpTcY/VJf62-w7-hI/AAAAAAAABS4/ZAvhzyDGZJw/s1600/SMK%2BNegeri%2B9%2BMalang.jpg"
                alt="Logo Sekolah">
            <h1 class="text-2xl font-bold text-indigo-600">Koperasi Siswa</h1>
        </div>

        <!-- login -->
        <div>
            <a href="#" class="gradient-bg text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition-all duration-300 flex items-center">
                <i class="fas fa-sign-in-alt mr-2"></i> Login Admin
            </a>
        </div>
    </nav>

    <!-- header -->
    <header class="container mx-auto px-4 mt-8 animate-fade-in">
        <div class="bg-white rounded-xl p-8 text-center card">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Selamat Datang di Koperasi Siswa</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Kelola stok barang, vendor, pembelian, dan keuangan koperasi dengan sistem yang modern dan efisien.
            </p>
        </div>
    </header>

    <!-- card total produk-->
    <section class="container mx-auto px-4 mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card p-6 animate-fade-in" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Total Produk</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $totalProduk }}</h3>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-boxes text-lg"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-green-500">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>Produk tersedia</span>
            </div>
        </div>

        <!-- card daftar vendor -->
        <div class="card p-6 animate-fade-in" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Daftar Vendor</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $totalVendor }}</h3>
                </div>
                <div class="stats-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--secondary)">
                    <i class="fas fa-handshake text-lg"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-green-500">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>Vendor aktif</span>
            </div>
        </div>

        <!-- card kategori -->
        <div class="card p-6 animate-fade-in" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Produk Terlaris</p>
                    <h3 class="text-xl font-bold text-gray-800 mt-2">{{ $kategoriTerlaris ? $kategoriTerlaris->nama : 'Belum ada data' }}</h3>
                </div>
                <div class="stats-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b">
                    <i class="fas fa-star text-lg"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-gray-500">
                <i class="fas fa-chart-line mr-1"></i>
                <span>85 pembelian</span>
            </div>
        </div>

        <!-- card keuntungan -->
        <div class="card p-6 animate-fade-in" style="animation-delay: 0.4s">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-medium">Keuntungan Total</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">Rp{{ number_format($totalKeuntungan, 0, ',', '.') }}</h3>
                </div>
                <div class="stats-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--secondary)">
                    <i class="fas fa-coins text-lg"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-sm text-green-500">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>Profit</span>
            </div>
        </div>
    </section>

    <!-- filter hari/bulan -->
    <section class="container mx-auto px-4 mt-8 mb-12">
        <div class="chart-container p-6 animate-fade-in loading-overlay" id="chartContainer">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0" id="chartTitle">Grafik Penjualan 6 Bulan Terakhir</h2>
                <div class="flex items-center gap-3">
                    <label for="filter_bulan" class="font-medium text-gray-700 text-sm">
                        <i class="fas fa-filter mr-2 text-indigo-500"></i>Filter Data:
                    </label>
                    <select id="filter_bulan" name="bulan" class="rounded-lg border-gray-300 text-sm px-4 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 hover:border-gray-400 w-full md:w-48">
                        <option value="bulan" selected>Bulan</option>
                        <option value="hari">Hari</option>
                    </select>
                </div>
            </div>

            <!-- chart -->
            <div class="h-80">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-8 border-t border-gray-200">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.instagram.com/smknegeri9malang/" class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-indigo-600 transition-colors duration-200">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <p class="text-gray-500">
                &copy; 2025 Koperasi Siswa. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        // Data untuk chart dari Laravel
        const monthlyData = {
            labels: @json($monthlyChartData['labels'] ?? []),
            data: @json($monthlyChartData['data'] ?? [])
        };

        // Data harian untuk bulan ini (30 hari terakhir)
        const dailyData = {
            labels: @json($dailyChartData['labels'] ?? []),
            data: @json($dailyChartData['data'] ?? [])
        };

        let salesChart;
        let currentFilter = 'bulan';

        // Fungsi untuk membuat chart
        function createChart(labels, data, chartType = 'bulan') {
            const canvasElement = document.getElementById('salesChart');
            if (!canvasElement) {
                console.error('Canvas element tidak ditemukan');
                return;
            }

            const ctx = canvasElement.getContext('2d');
            
            // Hapus chart lama jika ada
            if (salesChart) {
                salesChart.destroy();
            }

            // Buat gradasi untuk chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 320);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.8)');
            gradient.addColorStop(1, 'rgba(124, 58, 237, 0.2)');

            // Konfigurasi chart berdasarkan tipe
            const isDaily = chartType === 'hari';
            
            // Konfigurasi chart
            salesChart = new Chart(ctx, {
                type: isDaily ? 'line' : 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: isDaily ? 'Penjualan Harian' : 'Total Penjualan',
                        data: data,
                        backgroundColor: isDaily ? 'rgba(79, 70, 229, 0.1)' : gradient,
                        borderColor: isDaily ? '#4f46e5' : 'transparent',
                        borderWidth: isDaily ? 3 : 0,
                        borderRadius: isDaily ? 0 : 8,
                        fill: isDaily ? true : false,
                        tension: isDaily ? 0.4 : 0,
                        pointBackgroundColor: isDaily ? '#4f46e5' : 'transparent',
                        pointBorderColor: isDaily ? '#ffffff' : 'transparent',
                        pointBorderWidth: isDaily ? 2 : 0,
                        pointRadius: isDaily ? 4 : 0,
                        pointHoverRadius: isDaily ? 6 : 0,
                        hoverBackgroundColor: '#4f46e5',
                        maxBarThickness: isDaily ? 0 : 60,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            },
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#4f46e5',
                            borderWidth: 1,
                            cornerRadius: 8,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: '#e2e8f0',
                                drawTicks: false,
                            },
                            ticks: {
                                callback: function(value) {
                                    if (isDaily) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'rb';
                                    } else {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                                    }
                                },
                                color: '#64748b',
                                padding: 10,
                            },
                            border: {
                                display: false,
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#64748b',
                                padding: 10,
                                maxTicksLimit: isDaily ? 10 : 6,
                            },
                            border: {
                                display: false,
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart',
                    }
                }
            });

            console.log('Chart berhasil dibuat dengan tipe:', chartType);
            console.log('Data labels:', labels);
            console.log('Data values:', data);
        }

        // Fungsi untuk update judul chart
        function updateChartTitle(filterType) {
            const titleElement = document.querySelector('.chart-container h2');
            if (titleElement) {
                if (filterType === 'hari') {
                    titleElement.textContent = 'Grafik Penjualan Harian (30 Hari Terakhir)';
                } else {
                    titleElement.textContent = 'Grafik Penjualan 6 Bulan Terakhir';
                }
            }
        }

        // Fungsi untuk menampilkan loading
        function showLoading() {
            const chartContainer = document.querySelector('.chart-container');
            if (chartContainer) {
                chartContainer.style.opacity = '0.6';
            }
        }

        // Fungsi untuk menyembunyikan loading
        function hideLoading() {
            const chartContainer = document.querySelector('.chart-container');
            if (chartContainer) {
                chartContainer.style.opacity = '1';
            }
        }

        // Fungsi untuk mengganti chart
        function switchChart(filterType) {
            console.log('Switching chart to:', filterType);
            
            showLoading();
            
            setTimeout(() => {
                if (filterType === 'hari') {
                    createChart(dailyData.labels, dailyData.data, 'hari');
                    updateChartTitle('hari');
                } else {
                    createChart(monthlyData.labels, monthlyData.data, 'bulan');
                    updateChartTitle('bulan');
                }
                
                currentFilter = filterType;
                hideLoading();
            }, 200);
        }

        // Tunggu hingga Chart.js sepenuhnya dimuat
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing chart...');
            console.log('Monthly data:', monthlyData);
            console.log('Daily data:', dailyData);
            
            // Buat chart default (bulanan)
            createChart(monthlyData.labels, monthlyData.data, 'bulan');

            // Event listener untuk filter
            const filterSelect = document.getElementById('filter_bulan');
            if (filterSelect) {
                filterSelect.addEventListener('change', function() {
                    const selectedFilter = this.value;
                    console.log('Filter dipilih:', selectedFilter);
                    
                    // Hanya update jika filter berbeda
                    if (selectedFilter !== currentFilter) {
                        switchChart(selectedFilter);
                    }
                });
            } else {
                console.error('Filter select element tidak ditemukan');
            }
        });

        // Animasi untuk elemen cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.animate-fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>

</html>
