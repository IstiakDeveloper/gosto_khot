<?php

namespace App\Livewire;

use App\Models\Member;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;
use Livewire\Component;
use App\Models\Payment;

class PaymentManagement extends Component
{
    public $member_id, $amount;

    public function render()
    {
        $members = Member::with('payments')->get();
        return view('livewire.payment-management', ['members' => $members]);
    }

    public function addPayment()
    {
        $this->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|integer|min:1',
        ]);

        $member = Member::findOrFail($this->member_id);

        // Create the payment
        $payment = Payment::create([
            'member_id' => $this->member_id,
            'payment_date' => Carbon::now(),
            'amount' => $this->amount,
        ]);

        // Update member's totals
        $totalWeeks = $this->calculateTotalWeeks($member);
        $totalAmount = $totalWeeks * 100;
        $totalPaid = $member->payments()->sum('amount');
        $totalDue = max(0, $totalAmount - $totalPaid);

        $member->payments()->update([
            'total_weeks' => $totalWeeks,
            'total_amount' => $totalAmount,
            'total_payment' => $totalPaid,
            'total_due' => $totalDue,
        ]);

        // Emit event to refresh the component
        $this->dispatch('paymentAdded');

        // Reset input fields after adding payment
        $this->reset();
    }

    public function calculateTotalWeeks(Member $member)
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


    public function getTotalAmount(Member $member)
    {
        $totalWeeks = $this->calculateTotalWeeks($member);
        return $totalWeeks * 100;
    }

    public function getTotalPaid(Member $member)
    {
        return $member->payments->sum('amount');
    }

    public function getTotalDue(Member $member)
    {
        $totalWeeks = $this->calculateTotalWeeks($member);
        return max(0, $totalWeeks * 100 - $this->getTotalPaid($member));
    }
}
