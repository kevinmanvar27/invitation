<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Payment Details</h3>
                        <div>
                            <a href="{{ route('admin.payments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Payments
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-semibold mb-2">Payment Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">ID:</span>
                                    <span class="ml-2">{{ $payment->id }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">User:</span>
                                    <span class="ml-2">{{ $payment->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Subscription:</span>
                                    <span class="ml-2">{{ $payment->subscription_id ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Amount:</span>
                                    <span class="ml-2">${{ number_format($payment->amount, 2) }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Currency:</span>
                                    <span class="ml-2">{{ $payment->currency }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Payment Method:</span>
                                    <span class="ml-2">{{ $payment->payment_method }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Gateway:</span>
                                    <span class="ml-2">{{ $payment->gateway }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Transaction ID:</span>
                                    <span class="ml-2">{{ $payment->transaction_id ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Status:</span>
                                    <span class="ml-2">{{ $payment->status }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-md font-semibold mb-2">Additional Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">Created At:</span>
                                    <span class="ml-2">{{ $payment->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Updated At:</span>
                                    <span class="ml-2">{{ $payment->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>