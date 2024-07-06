<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($members as $member)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://via.placeholder.com/150' }}" alt="Member Photo" class="w-16 h-16 rounded-full object-cover">
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-900">{{ $member->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $member->gram }}</p>
                            <p class="text-sm text-gray-500">{{ $member->phone }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-4 p-4">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Total Amount</dt>
                            <dd class="mt-1 text-sm text-gray-900">৳ {{ $this->getTotalAmount() }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Total Paid</dt>
                            <dd class="mt-1 text-sm text-gray-900">৳ {{ $member->payments->sum('amount') }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Total Due</dt>
                            <dd class="mt-1 text-sm text-gray-900">৳ {{ $this->getTotalAmount() - $member->payments->sum('amount') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        @endforeach
    </div>
</div>
