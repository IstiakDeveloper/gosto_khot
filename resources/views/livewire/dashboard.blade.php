<div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Total Members -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-md bg-green-500 text-white">
                            <!-- Heroicon name: users -->
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 11a2 2 0 11-4 0 2 2 0 014 0zM3 12a9 9 0 0118 0h-2a7 7 0 00-14 0H3zm4 7a4 4 0 004 4h2a4 4 0 004-4M5 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Members</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalMembers }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Weeks -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-md bg-blue-500 text-white">
                            <!-- Heroicon name: calendar -->
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 18a3 3 0 11-6 0 3 3 0 016 0zM8 6h3m0 0H8m0 0H5m0 0h3m0 0H5m0 0H3a2 2 0 00-2 2v11a2 2 0 002 2h18a2 2 0 002-2V8a2 2 0 00-2-2h-3m-4 0v12m0 0h-6" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Weeks</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalWeeks }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-md bg-yellow-500 text-white">
                            <!-- Heroicon name: currency-dollar -->
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6m12 0a9 9 0 01-9 9v-2a7 7 0 007-7h2a5 5 0 005-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v4a3 3 0 003 3h4a1 1 0 011 1z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Amount</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">৳ {{ $totalAmount }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Payment -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-md bg-pink-500 text-white">
                            <!-- Heroicon name: cash -->
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v2m0 12h16M4 8h16m-8 8h8m-8 0H4m0-8h8m-8 0H4m8-8v6m-8-2h8" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Payment</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">৳ {{ $totalPayment }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Due -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12 rounded-md bg-purple-500 text-white">
                            <!-- Heroicon name: receipt-refund -->
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V4zm6 9a2 2 0 002 2h.01M6 8a2 2 0 00-2 2h.01M14 8a2 2 0 00-2-2h-.01M18 12a2 2 0 01-2 2h-.01M12 12a2 2 0 01-2-2h-.01" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Due</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">৳ {{ $totalDue }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
