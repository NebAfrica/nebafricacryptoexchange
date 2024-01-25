@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('Complete your payment') }}
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
                @if ($payment_method->type == 'crypto')
                <div class="w-full grid grid-cols-2 gap-2 text-sm md:text-base break-all">
                    <div align="center" class="col-span-2 mb-3">
                        <div class="qrcode">
                            {!! QrCode::generate($payment_method->wallet_address) !!}
                        </div>
                    </div>

                    <div class="font-medium">
                        <h3>{{ ct('Amount') }}:</h3>
                    </div>
                    <div class="text-left">{{ $converted_amount }} {{ $currency }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Network Type') }}:</h3>
                    </div>
                    <div>{{ $payment_method->network_type }}</div>

                    <div class="font-medium py-3">
                        <h3>{{ ct('Wallet Address') }}:</h3>
                    </div>
                    <div class="p-3 bg-gray-300 text-blue-500 rounded-md font-mono font-medium">
                        {{ $payment_method->wallet_address }}
                    </div>

                    <div class="font-medium">
                        <h3>{{ ct('Payment Instruction') }}:</h3>
                    </div>
                    <div>{!! $payment_method->payment_instruction !!}</div>
                </div>
                @elseif($payment_method->type == 'bank')
                <div class="w-full grid grid-cols-2 gap-2 text-sm md:text-base break-all">
                    <div class="font-medium">
                        <h3>{{ ct('Amount') }}:</h3>
                    </div>
                    <div class="text-left">{{ strtoupper($currency) }} {{ number_format($converted_amount, 2) }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Bank Name') }}:</h3>
                    </div>
                    <div class="text-left">{{ $payment_method->bank_name }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Account Name') }}:</h3>
                    </div>
                    <div class="text-left">{{ $payment_method->account_name }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Account No') }}:</h3>
                    </div>
                    <div class="text-left">{{ $payment_method->account_no }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Sort Code') }}:</h3>
                    </div>
                    <div class="text-left">{{ $payment_method->sort_code }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Bank Code') }}:</h3>
                    </div>
                    <div class="text-left">{{ $payment_method->bank_code }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Payment Instruction') }}:</h3>
                    </div>
                    <div>{!! $payment_method->payment_instruction !!}</div>
                </div>
                @elseif($payment_method->type == 'others')
                <div class="w-full grid grid-cols-2 gap-2 text-sm md:text-base break-all">
                    <div class="font-medium">
                        <h3>{{ ct('Amount') }}:</h3>
                    </div>
                    <div class="text-left">{{ strtoupper($currency) }} {{ number_format($converted_amount, 2) }}</div>

                    <div class="font-medium">
                        <h3>{{ ct('Payment Instruction') }}:</h3>
                    </div>
                    <div>{!! $payment_method->payment_instruction !!}</div>
                </div>
                @endif


                {{--  save/cancel button --}}
                <div class="w-full flex justify-start items-center space-x-5 mt-10">
                    {{--  confirm --}}
                    <div>
                        <button type="button" class="save-deposit-btn text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            {{ ct('Save Deposit') }}
                        </button>
                    </div>

                    {{--  cancel --}}
                    <div>
                        <button type="button" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-600 hover:bg-red-400 rounded-md cancel-payment">
                            {{ ct('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>

            <form id="manual-cancel-form" action="{{ route('user.deposit.pay.manual.cancel') }}" method="POST">
                @csrf
            </form>

        </div>
    </div>
</div>

<script>
    jQuery(function() {
        // attachment input processor
        $(".attachment-input").change(function() {
            // first empty whatever is innit
            $(this).parent().siblings(".attachment-list").html("")

            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                if (names.length < 1)
                    names.push($(this).get(0).files[i].name);
                else {
                    names.push(", " + $(this).get(0).files[i].name);

                }
            }

            $(this).parent().siblings(".attachment-list").append(names)
        })

        // on payment cancel
        $(".cancel-payment").click(function() {
            Swal.fire({
                title: '{{ ct("Cancel payment?") }}',
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
                    $("#manual-cancel-form").submit();
                }
            });
        });


        // save deposit
        $(".save-deposit-btn").click(function() {
            Swal.fire({
                html: `
                {{--  process form --}}
                <div class="p-2 md:p-4 text-[#bfc9d4]">
                    <form action="{{ route('user.deposit.pay.manual.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-sm lg:text-base font-medium mb-4">Save Deposit </h3>

                        <div class="space-y-5">
                            {{--  screenshot --}}
                            <div>
                                <label style="float:left !important;" for="screenshot" class="w-full text-xs lg:text-sm text-left">{{ ct("Upload payment screenshot") }}:</label>
                                <input class="cred-hyip-theme1-text-input pl-4" id="screenshot" type="file" accept="image/png, image/jpg, image/jpeg" placeholder="Upload screenshot" name="payment_screenshot" required>
                            </div>

                            {{--  Addtional comment --}}
                            <div>
                                <textarea name="additional_info" id="additional_info" rows="5" required placeholder="{{ ct('Enter comment') }}" class="cred-hyip-theme1-textarea pl-4"></textarea>
                            </div>
                        </div>

                        <div class="w-full my-5" align="left">
                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                {{ ct('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
                `,
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                background: "#0e1726",
                color: "#d1d5db",
                
            });
        });
    });
</script>
@endsection