@extends('themes.cryptic.layout.app')
@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{-- Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            {{ ct('Confirm Loan Application') }}
                        </h2>
                    </div>

                    <div>
                        <a href="{{ url()->previous() }}"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span>{{ ct('back', 'l') }}</span>
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

                {{--  loan details confirmation --}}
                <div class="w-full my-6 md:my-10 flex justify-center">
                    <div class="space-y-2">
                        <div align="center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#dfb05b]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-xs md:text-sm font-medium text-center">
                            <p>{{ ct('You have selected the') }} <b>{{ $loan_plan->name }}</b>. {{ ct('Please enter an amount between') }}
                                <b>{{ formatAmount($loan_plan->min_amount) }}</b> {{ ct('and') }}
                                <b>{{ formatAmount($loan_plan->max_amount) }}</b>.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('user.loan.confirm-validate') }}" method="POST">
                    @csrf

                    {{--  amount input --}}
                    <div class="relative w-full">
                        <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                            {{ websiteInfo('general_currency') }}
                        </span>
                        <input type="number" step="any" name="amount" id="amount"
                            min="{{ $loan_plan->min_amount }}" max="{{ $loan_plan->max_amount }}" required
                            class="cred-hyip-theme1-text-input" placeholder="{{ ct('Enter amount') }}">
                    </div>

                    <br>

                    {{--  OTP input --}}
                    @if (websiteInfo('loan_otp') == 'enabled')
                        <div class="w-full flex justify-end mb-1">
                            <a class="text-xs md:text-sm font-medium text-blue-800 cursor-pointer hover:text-blue-600 resend-otp"
                            role="button">{{ ct('Resend OTP') }}</a>
                        </div>
                        <div class="relative w-full">
                            <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                                {{ ct('OTP', 'u') }}
                            </span>
                            <input type="text" name="otp" id="otp" required class="cred-hyip-theme1-text-input"
                                placeholder="{{ ct('Enter OTP') }}" >
                        </div>
                        
                        @error('otp')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    @endif

                    {{--  submit button --}}
                    <div class="w-full my-5">
                        {{--  confirm --}}
                        <div>
                            <button type="submit"
                                class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                {{ ct('Submit Loan Application') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


