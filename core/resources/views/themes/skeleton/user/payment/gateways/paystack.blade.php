@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        Pay With {{ $payment_method->name }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}"  >
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
<div  >
    <div  >
        <div  >

            {{-- payment details confirmation --}}
            <div  >
                <div  >
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div  >
                        <p>You have selected to deposit <b>{{ formatAmount($amount) }}</b> via <b>{{ $payment_method->name }}</b> . A depsoit charge of <b>{{ formatAmount($charge) }}</b> has been applied to your deposit. Follow the payment instruction to complete your payment </p>
                    </div>
                </div>
            </div>

            <div  >
                <div  >
                    <div>
                        <h3  >Amount:</h3>
                    </div>
                    <div>{{ strtoupper($currency) }} {{ number_format($converted_amount, 2) }}</div>
                </div>

                <div  font-medium">
                        <h3  >Payment Instruction:</h3>
                    </div>
                    <div  >{!! $payment_method->payment_instruction !!}</div>
                </div>

                <form action="{{ route('gateway.paystack.pay') }}" method="POST"  >
                    @csrf
                    <input type="hidden" name="email" value="{{ user('email') }}"> {{--  required --}}
                    <input type="hidden" name="amount" value="{{ (round($converted_amount, 2) * 100) }}"> {{--  required in kobo --}}
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="currency" value="{{ strtoupper($currency) }}">
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{--  required --}}
                    {{-- preview confirm/cancel confirm button --}}
                    <div  >
                        {{-- confirm --}}
                        <div>
                            <button type="submit"  >
                                Pay now
                            </button>
                        </div>

                        {{-- cancel --}}
                        <div>
                            <button type="button"  >
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<form id="paystack-cancel-form" action="{{ route('user.deposit.pay.manual.cancel') }}" method="POST">
    @csrf
</form>


<script>
    jQuery(function() {
        $(".cancel-payment").click(function() {
            Swal.fire({
                title: 'Cancel payment?',
                text: "Are you sure you want to cancel your payment?",
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
                    $("#paystack-cancel-form").submit();
                }
            });
        });
    });
</script>
@endsection