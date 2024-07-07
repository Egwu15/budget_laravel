<div>

    <div class="flex items-center justify-between mx-5">
        <h3 class="font-[poppins] font-bold">Spend details for the month of {{ date('F') }}</h3>
        <a class="btn btn-outline font-[poppins]" href="{{ route('transactions.create') }}" wire:navigate>Add Transaction
        </a>
    </div>
    <div class="gap-3 md:grid md:grid-cols-3">
        <div class="m-5 rounded-md shadow-md card bg-base-100 ">
            <div class="card-body font-[poppins]">
                <div class="flex items-center justify-center bg-gray-100 rounded-full h-14 w-14">
                    <img src="{{ asset('icons/income.svg') }}" alt="image" class="w-10 h-10 rounded-md">
                </div>
                <h3 class="text-2xl font-bold leading-none"> ₦{{ $monthCredit }}</h3>
                <div class="flex items-center justify-between">
                    <p class="leading-none text-gray-500">Total Income</p>
                    <img src="{{ asset('icons/trend_down.svg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="m-5 rounded-md shadow-md card bg-base-100 ">
            <div class="card-body font-[poppins]">
                <div class="flex items-center justify-center bg-gray-100 rounded-full h-14 w-14">
                    <img src="{{ asset('icons/expense.svg') }}" alt="image" class="w-10 h-10 rounded-md">
                </div>
                <h3 class="text-2xl font-bold leading-none"> ₦{{ $monthDebit }}</h3>
                <div class="flex items-center justify-between">
                    <p class="leading-none text-gray-500">Total Expense</p>
                    <img src="{{ asset('icons/trend_up.svg') }}" alt="">
                </div>
            </div>
        </div>
        <div class="m-5 rounded-md shadow-md card bg-base-100 ">
            <div class="card-body font-[poppins]">
                <div class="flex items-center justify-center bg-gray-100 rounded-full h-14 w-14">
                    <img src="{{ asset('icons/balance.svg') }}" alt="image" class="w-10 h-10 rounded-md">
                </div>
                <h3 class="text-2xl font-bold leading-none"> ₦{{ $monthBalance }}</h3>
                <div class="flex items-center justify-between">
                    <p class="leading-none text-gray-500">Current balance</p>
                    <img src="{{ asset('icons/trend_down.svg') }}" alt="">
                </div>
            </div>
        </div>



    </div>
    <h2 class="mt-20 font-bold text-center">Expense Categories for the month</h2>
    <div wire:ignore class="mt-2">
        <canvas id="pieChart"></canvas>
    </div>

    <div wire:ignore class="">
        <canvas id="myChart" class="mt-20"></canvas>
    </div>






    @assets
        <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
        <script>
            let ctx = document.getElementById('myChart');


            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                            label: 'Income',
                            data: [{{ implode(', ', array_values($transactions['credit'])) }}],
                            borderWidth: 1
                        },
                        {
                            label: 'Expense',
                            data: [{{ implode(', ', array_values($transactions['debit'])) }}],
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true, // Make the chart responsive
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true

                        }
                    }
                }
            });
        </script>
    @endscript

    @script
        <script>
            let ctx = document.getElementById('pieChart');


            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [{!! '"' . implode('", "', array_keys($pieChart)) . '"' !!}],
                    datasets: [{
                        data: [{{ implode(', ', array_values($pieChart)) }}],
                        // borderWidth: 1
                    }, ]
                },
                options: {
                    responsive: true, // Make the chart responsive
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            display: false,
                        }
                    }
                }
            });
        </script>
    @endscript


</div>
