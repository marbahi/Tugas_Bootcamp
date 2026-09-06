<x-app-layout headerTitle="Orders">

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="panel-card p-4">
                <form method="GET" action="{{ route('orders.index') }}" id="order-filter" class="row g-2 mb-3">
                    <div class="col-12 col-md-4">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Cari nomor order atau nama customer...">
                    </div>
                    <div class="col-6 col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        @if (request()->hasAny(['search', 'status']))
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-pill w-100">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted small">ID</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th class="text-center">Total Items</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="text-muted small">{{ $order->id }}</td>
                                    <td><code>{{ $order->order_number }}</code></td>
                                    <td class="fw-semibold">{{ $order->customer_name }}</td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill stock-badge stock-badge--in">{{ $order->items_count }}</span>
                                    </td>
                                    <td class="card-price">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($order->payment_method) }}</td>
                                    <td>
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge rounded-pill order-status-badge order-status-badge--pending">Pending</span>
                                                @break
                                            @case('processing')
                                                <span class="badge rounded-pill order-status-badge order-status-badge--processing">Processing</span>
                                                @break
                                            @case('completed')
                                                <span class="badge rounded-pill order-status-badge order-status-badge--completed">Selesai</span>
                                                @break
                                            @case('canceled')
                                                <span class="badge rounded-pill order-status-badge order-status-badge--cancelled">Dibatalkan</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm btn-pill">Detail</a>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" data-bs-toggle="modal" data-bs-target="#deleteOrder{{ $order->id }}">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($orders->hasPages())
                    <div class="d-flex justify-content-end mt-3">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @foreach ($orders as $order)
        <div class="modal fade" id="deleteOrder{{ $order->id }}" tabindex="-1" aria-labelledby="deleteOrderLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-display fw-bold" id="deleteOrderLabel{{ $order->id }}">Hapus Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin menghapus order ini?
                        <br><strong>{{ $order->order_number }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary btn-pill" data-bs-dismiss="modal">Batal</button>
                        <form method="POST" action="{{ route('orders.destroy', $order) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-pill">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        (function () {
            const selects = document.querySelectorAll('#order-filter select');
            selects.forEach((select) => select.addEventListener('change', () => select.form.submit()));

            const search = document.querySelector('#order-filter input[name="search"]');
            if (search) {
                search.addEventListener('input', () => {
                    clearTimeout(search.delay);
                    search.delay = setTimeout(() => search.form.submit(), 600);
                });
            }
        })();
    </script>
</x-app-layout>
