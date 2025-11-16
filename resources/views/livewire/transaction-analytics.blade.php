<div>
    <div class="mb-3">
        <label for="type">Loại giao dịch</label>
        <select wire:model.live="type" id="type" class="form-control" style="max-width:200px;">
            <option value="import">Nhập kho</option>
            <option value="export">Xuất kho</option>
        </select>
    </div>

    <canvas id="myChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let chartInstance = null;

        // Bắt event từ Livewire khi dữ liệu đổi
        document.addEventListener('refresh-chart', event => {

            const labels = event.detail.labels;
            const values = event.detail.data;

            const ctx = document.getElementById('myChart').getContext('2d');

            if (chartInstance) chartInstance.destroy();

            chartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tổng tiền',
                        data: values,
                        borderWidth: 2,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'transparent',
                        fill: false
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
    </script>
</div>
