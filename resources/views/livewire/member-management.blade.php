<div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="mt-4">
            <input type="text" wire:model.live="search"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Search Members">
        </div>
        <!-- Button to Open Create Member Modal -->
        <div class="mt-4">
            <button wire:click="openCreateModal"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Add New Member
            </button>
        </div>

        <!-- Member List Table -->
        <div class="flex flex-col mt-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#SL</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gram</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Paid</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Due</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php
                                        $currentPage = $members->currentPage();
                                        $perPage = $members->perPage();
                                        $startCount = ($currentPage - 1) * $perPage + 1;
                                    @endphp
                                    @foreach ($members as $index => $member)
                                        <tr class="hover:bg-gray-50 cursor-pointer" wire:click="toggleMember({{ $member->id }})">
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $startCount + $index }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->gram }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $member->phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">৳ {{ $this->getTotalPaid($member) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">৳ {{ $this->getTotalDue($member) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900" wire:click.prevent="openModal()">Add Payment</button>
                                                <button class="text-indigo-600 hover:text-indigo-900 ml-2" wire:click.prevent="openEditModal({{ $member->id }})">Edit</button>
                                                <button class="text-red-600 hover:text-red-900 ml-2" wire:click.prevent="deleteMember({{ $member->id }})" onclick="confirm('Are you sure you want to delete this member and all related payments?') || event.stopImmediatePropagation()">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- Expanded Row for Detailed View -->
                                        @if ($selectedMemberId === $member->id)
                                            <div class="overflow-none">
                                                <tr>
                                                    <td colspan="7" class="bg-gray-50 px-6 py-4">
                                                        <div class="bg-white shadow rounded-lg p-6">
                                                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Summary</h3>
                                                            <ul class="mb-6">
                                                                <li class="flex gap-6 py-2 border-b">
                                                                    <span class="font-medium text-gray-600">Total Weeks:</span>
                                                                    <span class="text-gray-900">{{ $this->calculateTotalWeeks() }}</span>
                                                                </li>
                                                                <li class="flex gap-6 py-2 border-b">
                                                                    <span class="font-medium text-gray-600">Total Amount:</span>
                                                                    <span class="text-gray-900">৳ {{ $this->getTotalAmount() }}</span>
                                                                </li>
                                                                <li class="flex gap-6 py-2 border-b">
                                                                    <span class="font-medium text-gray-600">Total Paid:</span>
                                                                    <span class="text-gray-900">৳ {{ $this->getTotalPaid($member) }}</span>
                                                                </li>
                                                                <li class="flex gap-6 py-2">
                                                                    <span class="font-medium text-gray-600">Total Due:</span>
                                                                    <span class="text-gray-900">৳ {{ $this->getTotalDue($member) }}</span>
                                                                </li>
                                                            </ul>
                                                            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Payments</h3>
                                                            <ul class="divide-y divide-gray-200">
                                                                @forelse($member->payments as $payment)
                                                                    <li class="py-2 flex justify-start items-center gap-6">
                                                                        <span class="text-gray-600">{{ $payment->payment_date->format('d-m-Y') }} - ৳ {{ $payment->amount }}</span>
                                                                        <button wire:click="editPayment({{ $payment->id }})" class="text-blue-500 hover:underline">
                                                                            Edit
                                                                        </button>
                                                                    </li>
                                                                @empty
                                                                    <li class="py-2 text-gray-600">No payments yet.</li>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $members->links() }}
        </div>

        @if($showEditPaymentModal)
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Payment</h3>
                        <div class="mt-2">
                            <label for="payment_date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                            <input type="date" wire:model="paymentDate" id="payment_date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-2">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="text" wire:model="paymentAmount" id="amount" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mt-4 sm:mt-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="updatePayment" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
                            <button wire:click="closePaymentEditModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Add Payment Modal -->
        @if ($isModalOpen)
            <div class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
                    <div class="px-6 py-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Add Payment</h3>
                        <div class="mt-4">
                            <input type="date" wire:model.defer="payment_date"
                            class="mt-4 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('payment_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                            <input type="text" wire:model.defer="amount"
                                class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Amount">
                            @error('amount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            wire:click="addPayment">Add Payment</button>
                        <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm"
                            wire:click="closeModal">Cancel</button>
                    </div>
                </div>
            </div>
        @endif


        <!-- Create Member Modal -->
        @if ($isCreateModalOpen)
            <div class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
                    <form wire:submit.prevent="createMember">
                        <div class="px-6 py-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Create Member</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="newMemberName"
                                        class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" id="newMemberName" wire:model.defer="newMemberName"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Member Name">
                                    @error('newMemberName')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="newMemberGram"
                                        class="block text-sm font-medium text-gray-700">Gram</label>
                                    <input type="text" id="newMemberGram" wire:model.defer="newMemberGram"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Gram">
                                    @error('newMemberGram')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="newMemberPhone"
                                        class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="text" id="newMemberPhone" wire:model.defer="newMemberPhone"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Phone">
                                    @error('newMemberPhone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="newMemberPhoto" class="block text-sm font-medium text-gray-700">Photo</label>
                                    <input type="file" id="newMemberPhoto" wire:model="newMemberPhoto"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @error('newMemberPhoto')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror

                                    <!-- Loading indicator -->
                                    <div wire:loading wire:target="newMemberPhoto" class="mt-2 text-blue-500">
                                        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                        </svg>
                                        Uploading...
                                    </div>

                                    <!-- Image preview -->
                                    <div class="mt-2">
                                        @if ($newMemberPhoto)
                                            <img src="{{ $newMemberPhoto->temporaryUrl() }}" alt="Photo Preview" class="w-32 h-32 rounded-md">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Create
                            </button>
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm"
                                wire:click="closeCreateModal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Edit Member Modal -->
        @if ($isEditModalOpen)
            <div class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg w-full">
                    <form wire:submit.prevent="updateMember">
                        <div class="px-6 py-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Member</h3>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="editMemberName" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" id="editMemberName" wire:model.defer="newMemberName"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Member Name">
                                    @error('newMemberName')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="editMemberGram" class="block text-sm font-medium text-gray-700">Gram</label>
                                    <input type="text" id="editMemberGram" wire:model.defer="newMemberGram"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Gram">
                                    @error('newMemberGram')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="editMemberPhone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="text" id="editMemberPhone" wire:model.defer="newMemberPhone"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Phone">
                                    @error('newMemberPhone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="editMemberPhoto" class="block text-sm font-medium text-gray-700">Photo</label>
                                    <input type="file" id="editMemberPhoto" wire:model="newMemberPhoto"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @error('newMemberPhoto')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror

                                    <div wire:loading wire:target="newMemberPhoto" class="mt-2 text-blue-500">
                                        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                        </svg>
                                        Uploading...
                                    </div>


                                    <div class="mt-2">
                                        @if ($newMemberPhoto)
                                            <img src="{{ $newMemberPhoto->temporaryUrl() }}" alt="Photo Preview" class="w-32 h-32 rounded-md">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Update
                            </button>
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm"
                                wire:click="closeEditModal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
