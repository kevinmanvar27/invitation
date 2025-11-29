<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Edit Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-6">Edit Payment</h3>

                    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-primary-dark">User</label>
                                <select name="user_id" id="user_id" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                                    <option value="">Select User</option>
                                    <!-- In a real application, this would be populated with actual users -->
                                    <option value="1" {{ $payment->user_id == 1 ? 'selected' : '' }}>John Doe</option>
                                    <option value="2" {{ $payment->user_id == 2 ? 'selected' : '' }}>Jane Smith</option>
                                </select>
                                @error('user_id')
                                    <p class="mt-1 text-sm text-error-dark">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="amount" class="block text-sm font-medium text-primary-dark">Amount</label>
                                <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount', $payment->amount) }}" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                                @error('amount')
                                    <p class="mt-1 text-sm text-error-dark">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-primary-dark">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="credit_card" {{ $payment->payment_method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="debit_card" {{ $payment->payment_method == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                    <option value="paypal" {{ $payment->payment_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank_transfer" {{ $payment->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-error-dark">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="gateway" class="block text-sm font-medium text-primary-dark">Payment Gateway</label>
                                <select name="gateway" id="gateway" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                                    <option value="">Select Gateway</option>
                                    <option value="stripe" {{ $payment->gateway == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                    <option value="paypal" {{ $payment->gateway == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank" {{ $payment->gateway == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('gateway')
                                    <p class="mt-1 text-sm text-error-dark">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="transaction_id" class="block text-sm font-medium text-primary-dark">Transaction ID</label>
                                <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                                @error('transaction_id')
                                    <p class="mt-1 text-sm text-error-dark">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-primary-dark">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="refunded" {{ $payment->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-error-dark">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Update Payment
                            </button>
                            <a href="{{ route('admin.payments.index') }}" class="ml-2 bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>