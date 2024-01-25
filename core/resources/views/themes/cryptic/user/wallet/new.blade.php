@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Add New Wallet
                    </h2>
                </div>

                <div>
                    <form action="{{ route('user.wallets.cancel') }}" method="post">
                        @csrf
                        <button type="submit" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span>Cancel</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <form class="pt-2 md:pt-4" action="{{ route('user.wallets.new-validate') }}" method="POST">
                @csrf
                @if (session()->has('wallet_type'))
                <div class="mt-5 text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium" for="wallet_name">Wallet Name:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="wallet_name" id="wallet_name" required value="{{ old('wallet_name') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('wallet_name') {{ $message }} @enderror
                    </span>
                </div>
                @if (session()->get('wallet_type') == 'crypto')
                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium" for="wallet_address">Wallet Address:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="wallet_address" id="wallet_address" required value="{{ old('wallet_address') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('wallet_address') {{ $message }} @enderror
                    </span>
                </div>
                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium" for="network_type">Network Type:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="network_type" id="netwok_type" value="{{ old('network_type') }}" required>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('network_type') {{ $message }} @enderror
                    </span>
                </div>
                @elseif (session()->get('wallet_type') == 'bank')
                <div class="mt-5 text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium" for="bank_name">Bank Name:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" required>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('bank_name') {{ $message }} @enderror
                    </span>
                </div>
                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium" for="account_name">Account Name:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="account_name" id="account_name" required value="{{ old('account_name') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('account_name') {{ $message }} @enderror
                    </span>
                </div>
                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium" for="account_no">Account No:</label>
                        <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="account_no" id="account_no" value="{{ old('account_no') }}" required>
                    </div>
                    <span class="p-1 text-red-600">
                        @error('account_no') {{ $message }} @enderror
                    </span>
                </div>

                @elseif (session()->get('wallet_type') == 'others')
                <p>
                    <label for="payment_info">Payment Info</label>
                    <textarea name="payment_info" id="payment_info" cols="30" rows="10">{{ old('payment_info') }}</textarea>
                    <span>@error('payment_info') {{ $message }} @enderror</span>
                </p>
                @endif

                <div class="w-full my-5 px-5">
                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        Save wallet
                    </button>
                </div>

                @else

                <div class="w-full flex justify-center md:py-2">
                    <div>
                        <h2 class="text-[#bfc9d4] text-xs md:text-sm font-medium mb-3">Please, select your wallet type.</h2>
                        <div class="relative">
                            <span class="cred-hyip-theme1-input-icon material-icons">
                                account_balance_wallet
                            </span>
                            <select name="wallet_type" id="wallet_type" class="cred-hyip-theme1-text-input" required>
                                <option value="" @selected(true) disabled>Select wallet type</option>
                                <option value="crypto">Crypto</option>
                                <option value="bank">Bank</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="w-full my-3 px-5">
                    <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-3 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        Next
                    </button>
                </div>

                @endif
            </form>

        </div>
    </div>
</div>

@endsection