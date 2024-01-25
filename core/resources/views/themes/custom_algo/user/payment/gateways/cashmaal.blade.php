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
                <form method="POST" action="https://www.cashmaal.com/Pay/" class="mt-4 mb-2">
                    {{--  pay_method (cm,pm,jca,epa,btc) if blank user will select on CM --}}

                    <input type="hidden" name="pay_method" value="">

                    {{--  amount (Enter Amount HERE) --}}

                    <input type="hidden" name="amount" value="{{ round($converted_amount, 2) }}">

                    {{--  currency (PKR,USD) --}}

                    <input type="hidden" name="currency" value="{{ strtoupper($currency) }}">

                    {{--  succes_url (User will redirect if payment complete) --}}

                    <input type="hidden" name="succes_url" value="{{ route('gateway.cashmaal.success') }}">

                    {{--  cancel_url (User will redirect if payment Not Complete) --}}

                    <input type="hidden" name="cancel_url" value="{{ route('gateway.cashmaal.cancel') }}">

                    {{--  client_email (After Complete payment CM sent Confirmation EMail to Client) --}}

                    <input type="hidden" name="client_email" value="{{ user('email') }}">

                    {{--  web_id (Your web id you can find this on CM panel) --}}

                    <input type="hidden" name="web_id" value="{{ env('CM_WEB_ID') }}">

                    {{--  Unique Order Id (You will get this order id after payment success (Optional) (Max 80 Character Allowed)) --}}

                    <input type="hidden" name="order_id" value="{{ $order_id }}">

                    {{--  Additional info (additional information (you will get this value after success payment) (Optional) (Max 80 Character Allowed)) --}}

                    <input type="hidden" name="addi_info" value="Account Funding Deposit">
                    {{--  preview confirm/cancel confirm button --}}
                    <div class="w-full flex justify-start items-center space-x-5">
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

<form id="cashmaal-cancel-form" action="{{ route('user.deposit.pay.manual.cancel') }}" method="POST">
    @csrf
</form>

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
                confirmButtonText: 'Yes, cancel',
                cancelButtonText: 'No',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#cashmaal-cancel-form").submit();
                }
            });
        });
    });
</script>
@endsection