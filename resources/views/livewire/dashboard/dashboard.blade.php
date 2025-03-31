<div class="overflow-y-auto overflow-x-hidden">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="p-5 flex flex-col text-white justify-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-purple-500 via-blue-500 to-teal-500">
                <p class="text-lg lg:text-3xl text-center">Total Members</p>
                <div class="text-center">
                    <div class="text-6xl lg:text-9xl font-bold p-1 flex justify-center items-center">
                        <span>{{ $totalMembers }} </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="ml-3 w-10 h-10 md:w-12 md:h-12 lg:w-24 lg:h-24 flex-shrink-0" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div
                class="p-5 flex flex-col text-white justify-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-orange-500 via-yellow-500 to-yellow-600">
                <p class="text-lg lg:text-3xl text-center">Total Programs</p>
                <div class="text-center">
                    <div class="text-6xl lg:text-9xl font-bold p-1 flex justify-center items-center">
                        <span>{{ $totalPrograms }} </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="ml-3 w-10 h-10 md:w-12 md:h-12 lg:w-24 lg:h-24 flex-shrink-0" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-zap-icon lucide-zap">
                                <path
                                    d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div
                class="p-5 flex flex-col text-white justify-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-pink-500 to-purple-500">
                <p class="text-lg lg:text-3xl text-center">Total Subscriptions</p>
                <div class="text-center">
                    <div class="text-6xl lg:text-9xl font-bold p-1 flex justify-center items-center">
                        <span>{{ $totalSubscriptions }} </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="ml-3 w-10 h-10 md:w-12 md:h-12 lg:w-24 lg:h-24 flex-shrink-0" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-bell-icon lucide-bell">
                                <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                                <path
                                    d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div
            class="relative p-5 h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-r from-indigo-500 to-purple-600">
            
            <!-- Title -->
            <h2 class="text-3xl font-extrabold text-center text-white mb-6">New Members for the Year</h2>
        
            <!-- Chart Container -->
            <div class="relative w-full h-80 rounded-lg overflow-hidden bg-white shadow-lg">
                <canvas id="loadMemberChartData" class="w-full h-full"></canvas>
            </div>
        
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const chartData = @json($memberChartData);
                    const ctx = document.getElementById("loadMemberChartData").getContext("2d");
        
                    new Chart(ctx, {
                        type: 'line',
                        data: chartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 5,
                                    }
                                }
                            }
                        }
                    })
                });
            </script>
        </div>

        <div class="relative h-full grid auto-rows-min gap-4 md:grid-cols-2 overflow-hidden">
            <div class="mt-5 md:mt-1 p-5 bg-gradient-to-r from-blue-500 to-purple-600 border rounded-xl">
                <!-- Title -->
                <h2 class="text-3xl font-extrabold text-white mb-6">Subscription Status</h2>
            
                <!-- Chart Container -->
                <div class="relative w-full h-80 rounded-lg overflow-hidden bg-white shadow-lg">
                    <canvas id="loadSubscriberChartData" class="w-full h-full"></canvas>
                </div>
            
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const chartData = @json($subscriptionChartData);
                        const ctx = document.getElementById("loadSubscriberChartData").getContext("2d");
            
                        new Chart(ctx, {
                            type: 'bar',
                            data: chartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        })
                    });
                </script>
            </div>

            <div class="mt-5 md:mt-1 p-5 bg-gradient-to-r from-teal-500 to-indigo-600 border rounded-xl">
                <!-- Title -->
                <h2 class="text-3xl font-extrabold text-white mb-6">Transaction Status</h2>
            
                <!-- Chart Container -->
                <div class="relative w-full h-80 rounded-lg overflow-hidden bg-white shadow-lg">
                    <canvas id="loadTransactionChartData" class="w-full h-full"></canvas>
                </div>
            
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const chartData = @json($transactionChartData);
                        const ctx = document.getElementById("loadTransactionChartData").getContext("2d");
            
                        new Chart(ctx, {
                            type: 'bar',
                            data: chartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        })
                    });
                </script>
            </div>
            
        </div>

        <flux:separator class="m-5" />

        <div class="relative h-full grid auto-rows-min gap-4 md:grid-cols-2 overflow-hidden">
            
        </div>

    </div>
</div>