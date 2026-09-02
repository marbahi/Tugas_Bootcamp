<x-app-layout headerTitle="Dashboard">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row g-3 mb-4">
                @foreach ($items as $item)
                    <div class="col-12 col-md-4">
                        <div class="panel-card p-4 d-flex align-items-center gap-3 h-100">
                            <span class="material-symbols-outlined dashboard-stat-icon">{{ $item['icon'] }}</span>
                            <div>
                                <div class="fs-3 fw-bold font-display">{{ $item['number'] }}</div>
                                <div class="text-muted small">{{ $item['title'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="panel-card p-4">
                        <h5 class="font-display fw-bold mb-3">Penjualan Bulanan</h5>
                        <div style="height: 300px;">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="panel-card p-4 h-100">
                        <h5 class="font-display fw-bold mb-3">Ringkasan</h5>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Total Order</span>
                                <span class="fw-bold fs-5">76</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Revenue</span>
                                <span class="fw-bold fs-5">Rp45.2jt</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Pending</span>
                                <span class="fw-bold fs-5 text-warning">12</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Completed</span>
                                <span class="fw-bold fs-5 text-success">58</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Cancelled</span>
                                <span class="fw-bold fs-5 text-danger">6</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-12">
                    <div class="panel-card p-4">
                        <h5 class="font-display fw-bold mb-3">Order Terbaru</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle admin-table mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-muted small">ID</th>
                                        <th>Customer</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td class="text-muted small">{{ $order['id'] }}</td>
                                            <td class="fw-semibold">{{ $order['customer'] }}</td>
                                            <td>{{ $order['product'] }}</td>
                                            <td class="card-price">Rp{{ number_format($order['amount'], 0, ',', '.') }}</td>
                                            <td>
                                                @switch($order['status'])
                                                    @case('completed')
                                                        <span class="badge rounded-pill order-status-badge order-status-badge--completed">Selesai</span>
                                                        @break
                                                    @case('pending')
                                                        <span class="badge rounded-pill order-status-badge order-status-badge--pending">Pending</span>
                                                        @break
                                                    @case('cancelled')
                                                        <span class="badge rounded-pill order-status-badge order-status-badge--cancelled">Dibatalkan</span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="text-muted small">{{ $order['date'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            const ctx = document.getElementById('salesChart');
            if (!ctx) return;

            const chartData = @json($chartData);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Order',
                        data: chartData.values,
                        borderColor: '#1D5B41',
                        backgroundColor: 'rgba(29, 91, 65, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#1D5B41',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
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
                            backgroundColor: '#1B2A27',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' order';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#E5E5DF',
                            },
                            ticks: {
                                color: '#78736A',
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                            },
                            ticks: {
                                color: '#78736A',
                            }
                        }
                    }
                }
            });
        })();
    </script>
    @endpush
</x-app-layout>
