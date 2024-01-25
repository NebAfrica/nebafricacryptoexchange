@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        New Withdrawal Request
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>back</span>
                    </a>
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
            <div class="w-full flex justify-start items-baseline space-x-2">
                {{--  Card header --}}
                <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                    Available Bal.
                </h6>
                <h2 class="bg-transparent text-center text-[#ebedf2] text-xl md:text-2xl font-semibold capitalize">
                    {{ formatAmount(user('account_bal')) }}
                </h2>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="md:p-4">
                <form action="{{ route('user.withdrawals.new-validate') }}" method="POST">
                    <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                        <tbody class="md:p-4">
                            <tr>
                                <td><span class="font-medium">Min Withdrawal:</span></td>
                                <td>{{ formatAmount(websiteInfo('min_withdrawal')) }}</td>
                            </tr>
                            <tr>
                                <td><span class="font-medium">Max Withdrawal:</td>
                                <td>{{ formatAmount(websiteInfo('max_withdrawal')) }}</td>
                            </tr>
                            @if(websiteInfo('withdrawal_fee_type') == 'fixed')
                            <tr>
                                <td class="font-medium">Withdrawal Fee:</td>
                                <td>{{ formatAmount(websiteInfo('withdrawal_fee')) }}</td>
                            </tr>

                            @elseif (websiteInfo('withdrawal_fee_type') == 'percent')
                            <tr>
                                <td colspan="2" class="font-medium">
                                    <span class="font-medium">Withdrawal Fee:</span>
                                    <span>{{ websiteInfo('withdrawal_fee') .'%' }}</span>
                                </td>
                            </tr>
                            @endif

                            @csrf
                            @if (session()->has('amount'))
                            <tr>
                                <td colspan="2">
                                    {{-- details confirmation --}}
                                    <div class="w-full my-6 md:my-10 flex justify-center">
                                        <div class="space-y-2">
                                            <div class="flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#dfb05b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="text-xs md:text-sm font-medium text-center">
                                                <p>You have selected to withdraw <b>{{ formatAmount(session()->get('amount'))  }}</b> via <b>{{ session()->get('wallet')->name }}</b>. A withdrawal fee of <b>{{ formatAmount(session()->get('fee')) }} </b> has been applied to this request </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @if (websiteInfo('withdrawal_otp') == 'enabled')
                            <tr>
                                <td colspan="2">
                                    <div class="w-full flex space-x-2 items-center">
                                        {{-- OTP input --}}
                                        <div class="relative w-3/4">
                                            <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                                                OTP
                                            </span>
                                            <input type="text" name="otp" id="otp" required class="cred-hyip-theme1-text-input" placeholder="Enter OTP">
                                        </div>
                                        <div class="w-1/4">
                                            <a class="text-xs md:text-sm font-light text-blue-800 cursor-pointer hover:text-blue-600 resend-otp" role="button">Resend OTP</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            {{-- Just a seprrator --}}
                            <tr>
                                <td colspan="2"></td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    {{-- confirm --}}
                                    <div>
                                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            Confirm
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td class="font-medium">
                                    <label for="amount">Amount {{ websiteInfo('general_currency') }}:</label>
                                </td>
                                <td>
                                    <div class="relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="cred-hyip-theme1-input-icon h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <input type="number" step="any" name="amount" id="amount" required value="{{ old('amount') }}" min="" max="{{ user('account_bal') }}" class=" cred-hyip-theme1-text-input">
                                    </div>
                                    @error('amount') {{ $message }} @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="flex justify-center items-center font-medium my-5">
                                    <h4 class="text-lg md:text-xl my-5">
                                        Select Wallet
                                    </h4>
                                </td>
                            </tr>

                            {{--  wallets --}}
                            @foreach ($wallets as $wallet)
                            <tr>
                                <td class="flex justify-center items-center" colspan="2">
                                    <div class="w-2/3 md:w-1/3 text-[#d1d5db] px-5 py-3 my-5 bg-[#1b2e4b] border border-gray-700 rounded-md">
                                        <label class="mb-3" for="{{ $wallet->id }}">
                                            <h3 class="text-xl md:text-2xl">
                                                <span>{{ $wallet->name }}</span>
                                            </h3>
                                            <h6 class="text-xs md:text-sm">
                                                <span>{{ $wallet->type }}</span>
                                            </h6>
                                        </label>
                                        <br><br><br>
                                        <input class="funny-radio" type="radio" id="{{ $wallet->id }}" name="wallet_id" value="{{ $wallet->id }}" required>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    <hr class="w-full border-b border-dotted border-gray-600 border">

                                    <div class="w-full mt-5 px-5">
                                        <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            Next
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection