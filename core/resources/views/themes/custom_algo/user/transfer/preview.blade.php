@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Preview Transfer
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-2/3 rounded-sm bg-[#0e1726] text-[#d3d6df] p-3 md:p-10">

            {{--  recepient details confirmation --}}
            <div class="w-full my-6 md:my-10 flex justify-center">
                <div>
                    <div align="center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#1a362b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="font-medium text-center">
                        <h6>Confirm Receipient's Details</h6>
                    </div>
                </div>
            </div>


            <table class="w-full text-[#bfc9d4] table-auto text-xs md:text-base">
                <tr>
                    <td class="font-medium pr-2">Receipient Account ID:</td>
                    <td>{{ $receiver->account_id }}</td>
                </tr>
                <tr>
                    <td class="font-medium pr-2">Receipient Full Name:</td>
                    <td>{{ $receiver->first_name .' '.$receiver->last_name }}</td>
                </tr>
                <tr>
                    <td class="font-medium pr-2">Transfer Amount:</td>
                    <td>{{ formatAmount(session()->get('amount')) }}</td>
                </tr>
                <tr>
                    <td class="font-medium pr-2">Fee:</td>
                    <td>{{ formatAmount(session()->get('transfer_fee')) }}</td>
                </tr>
                <tr>
                    <td class="font-medium pr-2">Total:</td>
                    <td>{{ formatAmount(session()->get('total_amount')) }}</td>
                </tr>
                <tr>
                    <td class="font-medium pr-2">Narration:</td>
                    <td>{{ session()->get('narration') }}</td>
                </tr>
            </table>
            <br>

            <form action="{{ route('user.transfer.confirm') }}" method="POST">
                @csrf

                <div class="w-full flex space-x-2 items-center">
                    {{--  OTP input --}}
                    <div class="relative w-3/4">
                        <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                            OTP
                        </span>
                        <input type="text" name="otp" id="otp" required class="cred-hyip-theme1-text-input" placeholder="Enter OTP">
                    </div>
                    <div class="w-1/4">
                        <a class="text-xs md:text-sm font-medium text-blue-800 cursor-pointer hover:text-blue-600 resend-otp" role="button">Resend OTP</a>
                    </div>
                </div>
                @error('otp')<span class="text-xs text-red-500">{{ $message }}</span>@enderror

                {{--  preview confirm/cancel confirm button --}}
                <div class="w-full flex justify-start items-center space-x-5 my-5">
                    {{--  confirm --}}
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Confirm
                        </button>
                    </div>

                    {{--  cancel --}}
                    <div>
                        <a href="{{ route('user.transfer.cancel') }}" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-600 hover:bg-red-400 rounded-md">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection