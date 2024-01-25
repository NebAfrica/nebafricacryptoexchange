@php
$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp

@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('Pay With') }} {{ $payment_method->name }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

            {{--  payment details confirmation --}}
            <div class="w-full my-6 md:my-10 flex justify-center">
                <div class="space-y-2">
                    <div align="center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#dfb05b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-xs md:text-sm font-medium text-center">
                        <p>{{ ct('You have selected to deposit') }} <b>{{ formatAmount($amount) }}</b> {{ ct('via') }} <b>{{ $payment_method->name }}</b> . {{ ct('A depsoit charge of') }} <b>{{ formatAmount($charge) }}</b> {{ ct('has been applied to your deposit. Follow the payment instruction to complete your payment') }} </p>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <div class="flex space-x-2 font-medium">
                    <div>
                        <h3 class="text-sm md:text-base">{{ ct('Amount') }}:</h3>
                    </div>
                    <div>{{ strtoupper($currency) }} {{ number_format($converted_amount, 2) }}</div>
                </div>

                <div class="">
                    <div class="font-medium">
                        <h3 class="text-xs md:text-sm">{{ ct('Payment Instruction') }}:</h3>
                    </div>
                    <div class="text-xs md:text-sm">{!! $payment_method->payment_instruction !!}</div>
                </div>

                <form action="{{ route('gateway.authorize.pay') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-1 mt-3">
                        <div class="relative">
                            <span class="cred-hyip-theme1-input-icon material-icons">
                                credit_card
                            </span>
                            <input type="text" placeholder="{{ ct('Name on card') }}" class="cred-hyip-theme1-text-input" id="owner" name="owner" value="{{ user('first_name').' '.user('last_name') }}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-3">
                        <div class="relative">
                            <span class="cred-hyip-theme1-input-icon material-icons">
                                credit_card
                            </span>
                            <input type="text" placeholder="{{ ct('Card number') }}" class="cred-hyip-theme1-text-input" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-3">
                        <div class="relative">
                            <span class="cred-hyip-theme1-input-icon font-bold">
                                CVV
                            </span>
                            <input type="text" placeholder="{{ ct('CVV', 'u') }}" class="cred-hyip-theme1-text-input" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <div>
                            <select class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none" id="expiration-month" name="expiration-month">
                                @foreach($months as $k=>$v)
                                <option value="{{ $k }}" {{ old('expiration-month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none" id="expiration-year" name="expiration-year">
                                @for($i = date('Y'); $i <= (date('Y') + 15); $i++)<option value="{{ $i }}">{{ $i }}</option>@endfor
                            </select>
                        </div>
                    </div>

                    {{--  preview confirm/cancel confirm button --}}
                    <div class="w-full flex justify-start items-center space-x-5 mt-5">
                        {{--  confirm --}}
                        <div>
                            <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                {{ ct('Pay now') }}
                            </button>
                        </div>

                        {{--  cancel --}}
                        <div>
                            <button type="button" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-600 hover:bg-red-400 rounded-md cancel-payment">
                                {{ ct('Cancel') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form id="stripe-cancel-form" action="{{ route('user.deposit.pay.manual.cancel') }}" method="POST">
    @csrf
</form>
@endsection
@section('script')
<script>
    jQuery(function() {
        $(".cancel-payment").click(function() {
            Swal.fire({
                title: '{{ ct("Cancel payment?") }}',
                text: "{{ ct('Are you sure you want to cancel your payment?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ "Yes, cancel" }}',
                cancelButtonText: 'No',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#stripe-cancel-form").submit();
                }
            });
        });
    });
</script>
@endsection