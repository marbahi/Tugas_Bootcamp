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
        </div>
    </div>
</x-app-layout>