<div>
    <!-- Filter -->
    <div class="row mb-3">
        <div class="col-md-2">
            <label>Loại giao dịch</label>
            <select wire:model.live="type" class="form-control">
                <option value="import">Nhập kho</option>
                <option value="export">Xuất kho</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Tháng</label>
            <select wire:model.live="month" class="form-control">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ $m }}</option>
                @endfor
            </select>
        </div>

        <div class="col-md-2">
            <label>Năm</label>
            <select wire:model.live="year" class="form-control">
                @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Chart -->
    <canvas id="myChart" class="mb-4"></canvas>

    <!-- Table -->
    <h4 class="mt-4">Chi tiết giao dịch</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Mã phiếu</th>
                <th>Ngày tạo</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tableData as $transaction)
                <tr>
                    <td>{{ $transaction->code }}</td>
                    <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                    <td>${{ number_format($transaction->total_amount) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let chartInstance = null;

    document.addEventListener('livewire:init', () => {
        Livewire.on('refresh-chart', ({ labels, data }) => {

            const ctx = document.getElementById('myChart').getContext('2d');

            if (chartInstance) chartInstance.destroy();

            chartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tổng tiền',
                        data: data,
                        borderWidth: 2,
                        borderColor: 'rgba(54,162,235,1)',
                        backgroundColor: 'transparent'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    });
</script>
