<div class="p-6 max-w-3xl mx-auto">
    <form wire:submit.prevent="addPayment" class="mb-4">
        <div class="flex items-center mb-4">
            <label for="member_id" class="mr-2">Select Member:</label>
            <select wire:model="member_id" id="member_id" class="rounded-md border border-gray-300 px-2 py-1">
                <option value="">Select Member</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center mb-4">
            <label for="amount" class="mr-2">Amount:</label>
            <input type="text" wire:model="amount" id="amount" placeholder="Enter amount"
                   class="rounded-md border border-gray-300 px-2 py-1">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Payment</button>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Member</th>
                    <th class="border border-gray-300 px-4 py-2">Total Paid</th>
                    <th class="border border-gray-300 px-4 py-2">Total Due</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $member->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">৳ {{ $this->getTotalPaid($member) }}</td>
                        <td class="border border-gray-300 px-4 py-2">৳ {{ $this->getTotalDue($member) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('paymentAdded', () => {
            Livewire.emit('refresh');
        });
    </script>
@endpush
