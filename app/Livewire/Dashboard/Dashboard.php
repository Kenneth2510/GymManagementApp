<?php

namespace App\Livewire\Dashboard;

use App\Models\Member;
use App\Models\Program;
use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalMembers, $totalPrograms, $totalSubscriptions;
    public $memberChartData, $subscriptionChartData, $transactionChartData;


    public function mount()
    {
        $this->totalMembers = Member::count();
        $this->totalPrograms = Program::count();
        $this->totalSubscriptions = Subscription::count();

        $this->loadMemberChartData();
        $this->loadSubscriptionChartData();
        $this->loadTransactionChartData();
    }

    public function loadMemberChartData()
    {
        $currentYear = Carbon::now()->year;
    
        // Fetch newly created members grouped by month
        $members = Member::whereYear('created_at', $currentYear)
            ->get()
            ->groupBy(fn ($member) => Carbon::parse($member->created_at)->format('F')); // Group by full month name
    
        // Define all months as labels
        $labels = collect(range(1, 12))->map(fn ($month) => Carbon::create()->month($month)->format('F'));
    
        // Ensure all months exist and assign count (default to 0 if no data)
        $data = $labels->map(fn ($month) => $members->get($month, collect())->count());
    
        // Prepare chart data
        $this->memberChartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'New Members',
                    'data' => $data,
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                ],
            ],
        ];
    }

    public function loadSubscriptionChartData()
    {
        $statuses = ["pending", "active", "expired"];

        $data = collect($statuses)->mapWithKeys(function ($status) {
            return [$status => Subscription::where('status', $status)->count()];
        });

        $this->subscriptionChartData = [
            'labels' => $statuses,
            'datasets' => [
                [
                    'label' => 'Subscription Status',
                    'data' => $data->values(),
                    'backgroundColor' => ['#fbc02d', '#4caf50', '#f44336'], // Yellow, Green, Red
                    'borderColor' => ['#f9a825', '#388e3c', '#d32f2f'],
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function loadTransactionChartData() 
    {
        $paidCount = Transaction::where('isPaid', 1)->count();
        $pendingCount = Transaction::where('isPaid', 0)->count();

        $this->transactionChartData = [
            'labels' => ['Paid', 'Unpaid'],
            'datasets' => [
                [
                    'label' => 'Transaction Payments',
                    'data' => [$paidCount, $pendingCount],
                    'backgroundColor' => ['#4caf50', '#fbc02d'], // Green for paid, Yellow for pending
                    'borderColor' => ['#388e3c', '#f9a825'],
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
