@extends('layouts.app_dashboard')

@php($page = 'dashboard')
@section('content')
    <!-- Stats Grid - Clean & Minimal -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Blog -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-blog text-[#1B3A6D] text-sm"></i>
                </div>
                <span class="text-xs text-gray-500">Total</span>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $blogs->count() }}</h3>
                <p class="text-sm text-gray-600">Artikel Blog</p>
            </div>
        </div>

        <!-- Total Produk -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-[#1B3A6D] text-sm"></i>
                </div>
                <span class="text-xs text-gray-500">Total</span>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $products->count() }}</h3>
                <p class="text-sm text-gray-600">Produk UMKM</p>
            </div>
        </div>

        <!-- Total Foto -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-images text-[#1B3A6D] text-sm"></i>
                </div>
                <span class="text-xs text-gray-500">Total</span>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $photos->count() }}</h3>
                <p class="text-sm text-gray-600">Foto Galeri</p>
            </div>
        </div>

        <!-- Pengunjung Bulan Ini -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#1B3A6D]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-[#1B3A6D] text-sm"></i>
                </div>
                <span class="text-xs text-green-600">+12%</span>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $totalVisitor }}</h3>
                <p class="text-sm text-gray-600">Pengunjung</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200">
            <div class="px-4 py-3 border-b border-gray-100">
                <h3 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h3>
            </div>
            <div class="p-4">
                @if($recentActivities && $recentActivities->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-start space-x-3">
                                <div class="w-7 h-7 bg-[#1B3A6D]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="{{ $activity['icon'] }} text-[#1B3A6D] text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900">{{ $activity['title'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-clock text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500 text-sm">Tidak ada aktivitas tercatat.</p>
                        <p class="text-gray-400 text-xs mt-1">Aktivitas akan muncul setelah ada pembaruan konten</p>
                    </div>
                @endif

                @if($recentActivities && $recentActivities->count() > 0)
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <button class="text-[#1B3A6D] hover:text-[#1B3A6D]/80 text-sm font-medium transition-colors">
                            Lihat semua aktivitas →
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-4">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Aksi Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ url('/dashboard/blogs/create') }}"
                       class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-7 h-7 bg-[#1B3A6D] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-plus text-white text-xs"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Tulis Artikel</span>
                    </a>

                    <a href="{{ url('/dashboard/products/create') }}"
                       class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-7 h-7 bg-[#1B3A6D] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-box text-white text-xs"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Tambah Produk</span>
                    </a>

                    <a href="{{ url('/dashboard/gallery') }}" 
                       class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors group">
                        <div class="w-7 h-7 bg-[#1B3A6D] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-images text-white text-xs"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900">Kelola Galeri</span>
                    </a>
                </div>
            </div>

            <!-- Website Status -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Status Website</h3>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-700">Server</span>
                        </div>
                        <span class="text-xs text-green-600 font-medium">Online</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-700">Database</span>
                        </div>
                        <span class="text-xs {{ $dbStatus === 'connected' ? 'text-green-600' : 'text-red-600'  }} font-medium">
                            
                            {{ ucfirst($dbStatus) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="text-sm text-gray-700">Storage</span>
                        </div>
                        <span class="text-xs text-yellow-600 font-medium">68% Used</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Location Chart -->
    <div class="mt-6">
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Sebaran Kota Pengunjung</h3>
                        <p class="text-sm text-gray-500 mt-1">Top 5 kota pengunjung dalam 30 hari terakhir</p>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $visitorLocations->sum('total') }} Total Pengunjung</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="relative" style="height: 350px;">
                    <canvas id="visitorLocationChart"></canvas>
                </div>
                @if($visitorLocations->isEmpty())
                    <div class="text-center py-8">
                        <i class="fas fa-chart-bar text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">Belum ada data pengunjung untuk ditampilkan</p>
                        <p class="text-sm text-gray-400 mt-2">Data akan muncul setelah ada pengunjung website</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* Minimal Dashboard Styles */
.dashboard-card {
    transition: all 0.2s ease;
}

.dashboard-card:hover {
    border-color: #1B3A6D;
    box-shadow: 0 4px 12px rgba(27, 58, 109, 0.1);
}

/* Chart container styling */
#visitorLocationChart {
    max-height: 350px;
}

/* Responsive chart adjustments */
@media (max-width: 768px) {
    #visitorLocationChart {
        max-height: 280px;
    }
}

.stat-number {
    font-variant-numeric: tabular-nums;
}

/* Subtle animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

.fade-in-delay-1 { animation-delay: 0.1s; }
.fade-in-delay-2 { animation-delay: 0.2s; }
.fade-in-delay-3 { animation-delay: 0.3s; }
.fade-in-delay-4 { animation-delay: 0.4s; }

/* Quick action hover effect */
.quick-action:hover .quick-action-icon {
    background-color: #1B3A6D;
    color: white;
}

/* Status indicator pulse */
.status-online {
    animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in classes with delays
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.classList.add('fade-in', `fade-in-delay-${Math.min(index + 1, 4)}`);
    });

    // Real-time clock update
    function updateClock() {
        const now = new Date();
        const timeElement = document.querySelector('.text-xs.text-gray-400');
        if (timeElement) {
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            timeElement.textContent = `${hours}:${minutes} WIB`;
        }
    }

    // Update clock every minute
    setInterval(updateClock, 60000);

    // Add subtle hover effects
    const quickActions = document.querySelectorAll('a[href*="dashboard"]');
    quickActions.forEach(action => {
        const icon = action.querySelector('.w-8.h-8');
        if (icon) {
            icon.classList.add('quick-action-icon');
        }
    });

    // Status indicators
    const statusIndicators = document.querySelectorAll('.bg-green-500');
    statusIndicators.forEach(indicator => {
        indicator.classList.add('status-online');
    });

    // Smooth scroll for any internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Visitor Location Chart
    const ctx = document.getElementById('visitorLocationChart');
    if (ctx) {
        const visitorLocationData = @json($visitorLocations);
        
        // Check if there's data to display
        if (visitorLocationData && visitorLocationData.length > 0) {
            const chartCtx = ctx.getContext('2d');
            
            // Prepare data for chart
            const labels = [];
            const data = [];
            const backgroundColors = [];
            
            visitorLocationData.forEach((item, index) => {
                // Create label with city and province
                const label = item.city === item.province ? item.city : `${item.city}, ${item.province}`;
                labels.push(label);
                data.push(item.total);
                
                // Generate colors similar to the screenshot - various shades of blue
                const colors = [
                    '#1B3A6D',  // Dark blue (main brand color)
                    '#2563EB',  // Blue  
                    '#3B82F6',  // Light blue
                    '#1E40AF',  // Blue
                    '#1D4ED8',  // Blue
                    '#2563EB',  // Blue
                    '#3730A3',  // Indigo
                    '#4338CA',  // Indigo
                    '#5B21B6',  // Purple
                    '#7C3AED'   // Violet
                ];
                backgroundColors.push(colors[index % colors.length]);
            });

            new Chart(chartCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: backgroundColors.map(color => color),
                        borderWidth: 0,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    indexAxis: 'y', // This makes it horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 20,
                            right: 40,
                            bottom: 20,
                            left: 20
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#1B3A6D',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false,
                            titleFont: {
                                size: 13,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    const total = context.parsed.x;
                                    const percentage = ((total / data.reduce((a, b) => a + b, 0)) * 100).toFixed(1);
                                    return [`${total} Pengunjung`, `${percentage}% dari total`];
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.08)',
                                lineWidth: 1
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                color: '#6B7280',
                                padding: 10,
                                callback: function(value) {
                                    return value >= 1000 ? (value / 1000).toFixed(1) + 'k' : value;
                                }
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    weight: '500'
                                },
                                color: '#374151',
                                padding: 10,
                                crossAlign: 'far'
                            },
                            border: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }
    }
});
</script>
@endpush
