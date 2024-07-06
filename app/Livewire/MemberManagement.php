<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
use DateTime;
use DateInterval;
use DatePeriod;
use Livewire\WithPagination;

class MemberManagement extends Component
{
    use WithFileUploads, WithPagination;

    public $selectedMemberId;
    public $amount;
    public $isModalOpen = false;
    public $isCreateModalOpen = false;
    public $isEditModalOpen = false; // For edit modal
    public $showEditPaymentModal = false;
    public $newMemberName;
    public $newMemberGram;
    public $newMemberPhone;
    public $newMemberPhoto;
    public $search = '';
    public $paymentId;
    public $paymentDate;
    public $paymentAmount;
    public $payment_date;
    public $memberId;




    protected $rules = [
        'amount' => 'required|numeric',
        'payment_date' => 'required|date', // Add this line
    ];


    public function mount()
    {
        $this->payment_date = now()->format('Y-m-d');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.member-management', [
            'members' => $this->loadMembers(),
            'selectedMember' => $this->selectedMemberId ? Member::findOrFail($this->selectedMemberId) : null,
        ]);
    }

    public function loadMembers()
    {
        return Member::where('name', 'like', '%' . $this->search . '%')->paginate(10);
    }

    public function toggleMember($memberId)
    {
        if ($this->selectedMemberId === $memberId) {
            $this->selectedMemberId = null;
        } else {
            $this->selectedMemberId = $memberId;
        }
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['amount']);
    }

    public function openCreateModal()
    {
        $this->isCreateModalOpen = true;
    }

    public function closeCreateModal()
    {
        $this->isCreateModalOpen = false;
        $this->resetValidation();
        $this->reset(['newMemberName', 'newMemberGram', 'newMemberPhone', 'newMemberPhoto']);
    }

    public function openEditModal($memberId)
    {
        $member = Member::findOrFail($memberId);
        $this->memberId = $memberId;
        $this->newMemberName = $member->name;
        $this->newMemberGram = $member->gram;
        $this->newMemberPhone = $member->phone;
        $this->isEditModalOpen = true;
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->resetValidation();
        $this->reset(['newMemberName', 'newMemberGram', 'newMemberPhone', 'newMemberPhoto']);
    }

    public function addPayment()
    {
        $validatedData = $this->validate([
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);

        // Use the current date if payment_date is not set (fallback)
        $paymentDate = $this->payment_date ?: now()->format('Y-m-d');

        Payment::create([
            'member_id' => $this->selectedMemberId,
            'payment_date' => $paymentDate,
            'amount' => $validatedData['amount'],
        ]);

        $this->reset(['payment_date', 'amount']);
        $this->closeModal();
        flash()->success('Payment Added successfully!');
        $this->dispatch('paymentAdded');
    }

    public function createMember()
    {
        $validatedData = $this->validate([
            'newMemberName' => 'required|string|max:255',
            'newMemberGram' => 'nullable|string|max:255',
            'newMemberPhone' => 'nullable|string|max:20',
            'newMemberPhoto' => 'nullable|image'
        ]);

        // Upload photo if provided
        if ($this->newMemberPhoto) {
            $photoPath = $this->newMemberPhoto->store('photos', 'public');
        }

        Member::create([
            'name' => $validatedData['newMemberName'],
            'gram' => $validatedData['newMemberGram'],
            'phone' => $validatedData['newMemberPhone'],
            'photo' => $photoPath, // Store the photo path in the database
        ]);

        $this->dispatch('refreshMembersList');

        // Reset input fields and close modal
        $this->reset(['newMemberName', 'newMemberGram', 'newMemberPhone', 'newMemberPhoto']);
        flash()->success('Member Created Successfully!');
        $this->closeCreateModal();
    }

    public function updateMember()
    {
        $validatedData = $this->validate([
            'newMemberName' => 'required|string|max:255',
            'newMemberGram' => 'nullable|string|max:255',
            'newMemberPhone' => 'nullable|string|max:20',
            'newMemberPhoto' => 'nullable|image',
        ]);

        if ($this->memberId) {
            $member = Member::findOrFail($this->memberId);
            $photoPath = $member->photo;
            if ($this->newMemberPhoto) {
                $photoPath = $this->newMemberPhoto->store('photos', 'public');
            }
            $member->update([
                'name' => $validatedData['newMemberName'],
                'gram' => $validatedData['newMemberGram'],
                'phone' => $validatedData['newMemberPhone'],
                'photo' => $photoPath, // Update the photo path in the database
            ]);

            $this->dispatch('refreshMembersList');
            $this->reset(['newMemberName', 'newMemberGram', 'newMemberPhone', 'newMemberPhoto']);
            $this->closeEditModal();
            flash()->success('Member Update successfully!');
        }

    }


    public function deleteMember($memberId)
    {
        $member = Member::findOrFail($memberId);
        $member->payments()->delete(); // Delete all payments for the member
        $member->delete(); // Delete the member
        return redirect()->route('members');
    }

    public function editPayment($paymentId)
    {
        $this->showEditPaymentModal = true;
        $this->paymentId = $paymentId;
        $payment = Payment::findOrFail($paymentId);
        $this->paymentDate = $payment->payment_date->format('Y-m-d');
        $this->paymentAmount = $payment->amount;
    }


    public function updatePayment()
    {
        $this->validate([
            'paymentDate' => 'required|date',
            'paymentAmount' => 'required|numeric',
        ]);

        $payment = Payment::findOrFail($this->paymentId);
        $payment->update([
            'payment_date' => $this->paymentDate,
            'amount' => $this->paymentAmount,
        ]);

        $this->showEditPaymentModal = false;
        $this->reset(['paymentId', 'paymentDate', 'paymentAmount']);
        $this->dispatch('refreshMembersList');

        flash()->success('Payment Update successfully!');
    }

    public function closePaymentEditModal()
    {
        $this->showEditPaymentModal = false;
        $this->reset(['paymentId', 'paymentDate', 'paymentAmount']);
    }

    public function calculateTotalWeeks()
    {
        $startDate = new \DateTime('2024-05-10');
        $currentDate = new \DateTime();
        $currentDate->modify('+1 day');
        // Adjust current date to last Friday
        $currentDate->modify('last Friday');

        // Calculate the total number of Fridays between $startDate and $currentDate
        $interval = \DateInterval::createFromDateString('1 week');
        $period = new \DatePeriod($startDate, $interval, $currentDate);
        $totalFridays = iterator_count($period);

        // Include the start week in the count
        if ($startDate <= $currentDate) {
            $totalFridays += 1;
        }

        return $totalFridays;
    }

    public function getTotalAmount()
    {
        $totalWeeks = $this->calculateTotalWeeks();
        return $totalWeeks * 100;
    }

    public function getTotalPaid($member)
    {
        return $member->payments->sum('amount');
    }

    public function getTotalDue($member)
    {
        $totalWeeks = $this->calculateTotalWeeks();
        return max(0, $totalWeeks * 100 - $this->getTotalPaid($member));
    }
}
