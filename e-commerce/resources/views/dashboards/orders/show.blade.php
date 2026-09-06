<x-app-layout headerTitle="Order Detail">
    <x-slot name="actions">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-pill btn-sm px-4">Kembali</a>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="panel-card p-4 p-sm-5">
                <h5 class="font-display fw-bold mb-4">Detail Order</h5>

                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <p class="text-muted small mb-1">Order Number</p>
                        <p class="fw-bold">{{ $order->order_number }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="text-muted small mb-1">Customer Name</p>
                        <p class="fw-bold">{{ $order->customer_name }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="text-muted small mb-1">Phone</p>
                        <p class="fw-bold">{{ $order->customer_phone }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="text-muted small mb-1">Payment Method</p>
                        <p class="fw-bold">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                    <div class="col-12">
                        <p class="text-muted small mb-1">Address</p>
                        <p class="fw-bold">{{ $order->customer_address }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="text-muted small mb-1">Total Amount</p>
                        <p class="fw-bold fs-5 card-price">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="text-muted small mb-1">Status</p>
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
                    </div>
                </div>

                @if (Auth::user()->role === 'admin')
                    <form method="POST" action="{{ route('orders.update', $order) }}" class="mb-4">
                        @csrf
                        @method('PUT')
                        <div class="row g-2 align-items-end">
                            <div class="col-12 col-md-4">
                                <label class="form-label small text-muted">Update Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-primary btn-pill w-100">Update Status</button>
                            </div>
                        </div>
                    </form>
                @endif

                <h5 class="font-display fw-bold mb-3">Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product->name ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end card-price">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-end card-price">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total</td>
                                <td class="text-end fw-bold card-price">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
