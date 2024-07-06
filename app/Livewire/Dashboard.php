<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Payment;
use DateInterval;
use DatePeriod;
use DateTime;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalMembers;
    public $totalWeeks;
    public $totalAmount;
    public $totalPayment;
    public $totalDue;

    public function mount()
    {
        $this->totalMembers = Member::count();
        $this->totalWeeks = $this->calculateTotalWeeks();
        $this->totalAmount = $this->totalWeeks * 100 * $this->totalMembers;
        $this->totalPayment = Payment::sum('amount');
        $this->totalDue = $this->totalAmount - $this->totalPayment;
    }

    public function calculateTotalWeeks()
    {
        // Define your start and end dates
        $startDate = new DateTime('2024-05-10');
        $endDate = new DateTime();

        $endDate->modify('+1 day');
        // Adjust the end date to last Friday
        $endDate->modify('last Friday');

        // Calculate the total number of complete weeks between $startDate and $endDate
        $interval = DateInterval::createFromDateString('1 week');
        $period = new DatePeriod($startDate, $interval, $endDate);

        // Count the number of weeks in the period
        $totalWeeks = iterator_count($period);

        // Include the start week in the count
        if ($startDate <= $endDate) {
            $totalWeeks += 1;
        }

        return $totalWeeks;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
