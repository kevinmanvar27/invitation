<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Edit Referral') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Edit Referral</h3>

                    <form method="POST" action="{{ route('admin.referrals.update', $referral->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Referrer User -->
                        <div class="mb-4">
                            <label for="referrer_user_id" class="block text-primary-dark text-sm font-bold mb-2">Referrer User</label>
                            <select name="referrer_user_id" id="referrer_user_id" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('referrer_user_id', $referral->referrer_user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('referrer_user_id')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Referred User -->
                        <div class="mb-4">
                            <label for="referred_user_id" class="block text-primary-dark text-sm font-bold mb-2">Referred User</label>
                            <select name="referred_user_id" id="referred_user_id" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('referred_user_id', $referral->referred_user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('referred_user_id')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Reward Earned -->
                        <div class="mb-4">
                            <label for="reward_earned" class="block text-primary-dark text-sm font-bold mb-2">Reward Earned ($)</label>
                            <input type="number" step="0.01" name="reward_earned" id="reward_earned" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('reward_earned', $referral->reward_earned) }}">
                            @error('reward_earned')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-primary-dark text-sm font-bold mb-2">Status</label>
                            <select name="status" id="status" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ (old('status', $referral->status) == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ (old('status', $referral->status) == 'completed') ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.referrals.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Referral
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>