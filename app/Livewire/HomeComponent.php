<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use DateTime;
use DateInterval;
use DatePeriod;

class HomeComponent extends Component
{
    public $members;

    public function mount()
    {
        $this->members = Member::with('payments')->get();
    }

    public function render()
    {
        return view('livewire.home-component', [
            'members' => $this->members,
        ])->layout('layouts.guest');
    }

    private function calculateTotalWeeks()
    {
        $startDate = new DateTime('2024-05-10');
        $currentDate = new DateTime();

        $currentDate->modify('+1 day');
        // Adjust current date to last Friday
        $currentDate->modify('last Friday');

        // Calculate the total number of Fridays between $startDate and $currentDate
        $interval = DateInterval::createFromDateString('1 week');
        $period = new DatePeriod($startDate, $interval, $currentDate);
        $totalFridays = iterator_count($period);

        // Include the start week in the count
        if ($startDate <= $currentDate) {
            $totalFridays += 1;
        }

        return $totalFridays;
    }

    private function getTotalAmount()
    {
        $totalWeeks = $this->calculateTotalWeeks();
        return $totalWeeks * 100; // Assuming 100 is the weekly amount
    }

    private function getTotalPaid($member)
    {
        return $member->payments->sum('amount');
    }

    private function getTotalDue($member)
    {
        $totalAmount = $this->getTotalAmount();
        $totalPaid = $this->getTotalPaid($member);
        return max(0, $totalAmount - $totalPaid);
    }
}
