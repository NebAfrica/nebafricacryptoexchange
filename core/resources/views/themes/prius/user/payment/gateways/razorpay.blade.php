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
                        <span>{{ ct('back') }}</span>
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

                <div class="w-full flex justify-start items-center space-x-5">
                    {{--  confirm --}}
                    <div>
                        <form action="{!!route('razor.pay')!!}" method="POST">
                            {{--  Note that the amount is in paise = 50 INR --}}
                            {{-- amount need to be in paisa--}}
                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RZP_KEY_ID') }}" data-amount="{{ round(session()->get('converted_amount'), 2) * 100}}" data-buttontext="Pay Now" data-name="{{ env('APP_NAME') }}" data-description="Account Deposit" data-image=" " data-prefill.name="{{ user('first_name').' '. user('last_name') }}" data-prefill.email="{{ user('email') }}" data-theme.color="#ff7529">
                            </script>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        </form>
                    </div>

                    {{--  cancel --}}
                    <div>
                        <button type="button" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-600 hover:bg-red-400 rounded-md cancel-payment">
                            {{ ct('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="razorpay-cancel-form" action="{{ route('user.deposit.pay.manual.cancel') }}" method="POST">
    @csrf
</form>

<script>
    jQuery(function() {
        $(".cancel-payment").click(function() {
            Swal.fire({
                title: '{{ "Cancel payment?" }}',
                text: "{{ ct('Are you sure you want to cancel your payment?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ct("Yes, cancel") }}',
                cancelButtonText: 'No',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#razorpay-cancel-form").submit();
                }
            });
        });
    });
</script>
@endsection