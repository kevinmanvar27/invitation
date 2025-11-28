<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-6">Edit Payment</h3>

                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                    <option value="">Select User</option>
                                    <!-- In a real application, this would be populated with actual users -->
                                    <option value="1" {{ $payment->user_id == 1 ? 'selected' : '' }}>John Doe</option>
                                    <option value="2" {{ $payment->user_id == 2 ? 'selected' : '' }}>Jane Smith</option>
                                </select>
                                @error('user_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                                <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount', $payment->amount) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                @error('amount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="credit_card" {{ $payment->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="debit_card" {{ $payment->payment_method == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                    <option value="paypal" {{ $payment->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank_transfer" {{ $payment->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="gateway" class="block text-sm font-medium text-gray-700">Payment Gateway</label>
                                <select name="gateway" id="gateway" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                    <option value="">Select Gateway</option>
                                    <option value="stripe" {{ $payment->gateway == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                    <option value="paypal" {{ $payment->gateway == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank" {{ $payment->gateway == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('gateway')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="transaction_id" class="block text-sm font-medium text-gray-700">Transaction ID</label>
                                <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                @error('transaction_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="refunded" {{ $payment->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Payment
                            </button>
                            <a href="{{ route('admin.payments.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>