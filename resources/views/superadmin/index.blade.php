@extends('layouts.superadmin')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-8">

    {{-- Statistik summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">Total Admin</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalAdmins ?? '-' }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">Total Visitor Berita</h2>
            <p class="text-3xl font-bold text-red-500">{{ $totalVisitorBerita ?? '-' }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">Total Visitor Home</h2>
            <p class="text-3xl font-bold text-green-500">{{ $totalVisitorHome ?? '-' }}</p>
        </div>
    </div>

    {{-- Grafik gabungan per hari --}}
    <div class="bg-white p-6 rounded-lg shadow" style="width: 100%;">
        <h3 class="text-xl font-semibold mb-4">Statistik Visitor per Hari (7 Hari Terakhir)</h3>
        <div style="width: 100%; height: 400px;">
            <canvas id="chartCombined" width="100%" height="100%"></canvas>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Membuat array tanggal 7 hari terakhir
    function getLast7DaysLabels() {
        const labels = [];
        const today = new Date();
        for (let i = 6; i >= 0; i--) {
            const d = new Date(today);
            d.setDate(today.getDate() - i);
            labels.push(d.toISOString().slice(0, 10));
        }
        return labels;
    }

    const dayLabels = getLast7DaysLabels();

    function mapDataPerDay(data) {
        const map = {};
        data.forEach(item => {
            map[item.date] = item.total;
        });
        return dayLabels.map(date => map[date] ?? 0);
    }

    const visitorsHomeDayData = @json($visitorsHomePerDay);
    const visitorsBeritaDayData = @json($visitorsBeritaPerDay);

    const visitorsHomePerDay = mapDataPerDay(visitorsHomeDayData);
    const visitorsBeritaPerDay = mapDataPerDay(visitorsBeritaDayData);

    new Chart(document.getElementById('chartCombined').getContext('2d'), {
        type: 'line',
        data: {
            labels: dayLabels,
            datasets: [
                {
                    label: 'Visitor Home',
                    data: visitorsHomePerDay,
                    borderColor: 'rgba(16, 185, 129, 1)',
                    backgroundColor: 'rgba(16, 185, 129, 0.15)',
                    fill: true,
                    tension: 0.5,
                    cubicInterpolationMode: 'monotone',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                },
                {
                    label: 'Visitor Berita',
                    data: visitorsBeritaPerDay,
                    borderColor: 'rgba(244, 63, 94, 1)',
                    backgroundColor: 'rgba(244, 63, 94, 0.15)',
                    fill: true,
                    tension: 0.5,
                    cubicInterpolationMode: 'monotone',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 0,
                        minRotation: 0,
                        font: {
                            size: 13
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0,
                    ticks: {
                        font: {
                            size: 13
                        }
                    },
                    grid: {
                        color: '#e5e7eb'
                    }
                }
            }
        }
    });
</script>
@endsection
