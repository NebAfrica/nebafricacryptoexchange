@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Edit {{ $gateway->name }}
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            {{--  setting pannel --}}

            @include('admin.includes.settings-panel')
            {{--  setting pannel ends --}}

            <div class="p-2 md:p-4">
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.gateways.edit-validate') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="id" value="{{ $gateway->id }}">
                    <input type="hidden" name="type" value="{{ $gateway->type }}">

                    <h4 class="text-[#ebedf2] font-medium capitalize mb-2 mt-4">Config</h4>

                    @if ($gateway->type == 'authorize' && isAddonEnabled('authorizenet'))
                        {{--  Authorize.net starts here --}}
                            @include('authorizenet::admin.edit')
                        {{--  Authorize.net Ends here --}}
                    @endif


                    @if ($gateway->type == 'paypal' && isAddonEnabled('paypal'))
                        {{--  Paypal starts here --}}
                            @include('paypal::admin.edit')
                        {{--  Paypal Ends here --}}
                    @endif

                    @if ($gateway->type == 'stripe' && isAddonEnabled('stripe'))
                        {{--  Stripe starts here --}}
                            @include('stripe::admin.edit')
                        {{--  Stripe Ends here --}}
                    @endif


                    @if ($gateway->type == 'razorpay' && isAddonEnabled('razorpay'))
                        {{--  RazorPay starts here --}}
                            @include('razorpay::admin.edit')
                        {{--  RazorPay Ends here --}}
                    @endif

                    @if ($gateway->type == 'flutterwave' && isAddonEnabled('flutterwave'))
                        {{--  Flutterwave starts here --}}
                            @include('flutterwave::admin.edit')
                        {{--  Flutterwave Ends here --}}
                    @endif

                    @if ($gateway->type == 'coingate' && isAddonEnabled('coingate'))
                        {{--  Coingate starts here --}}
                            @include('coingate::admin.edit')
                        {{--  Coingate Ends here --}}
                    @endif

                    @if ($gateway->type == 'cashmaal' && isAddonEnabled('cashmaal'))
                        {{--  Cashmaal starts here --}}
                            @include('cashmaal::admin.edit')
                        {{--  Cashmaal Ends here --}}
                    @endif

                    @if ($gateway->type == 'coinbase' && isAddonEnabled('coinbase'))
                        {{--  Coinbase starts here --}}
                            @include('coinbase::admin.edit')
                        {{--  Coinbase Ends here --}}
                    @endif

                    @if ($gateway->type == 'monnify' && isAddonEnabled('monnify'))
                        {{--  Monnify starts here --}}
                            @include('monnify::admin.edit')
                        {{--  Monnify Ends here --}}
                    @endif
                

                    @if ($gateway->type == 'paystack')
                    {{--  Paystack Gateway starts here --}}
                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-2">
                        <div class="w-full">
                            <label class="font-medium" for="">Paystack Callback Url:</label>
                            <div class="flex space-x-5 items-baseline">
                                <input class="to-copy w-5/6 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" value="{{ route('gateway.paystack.callback') }}">
                                <button class="w-1/6 p-3 bg-blue-500 hover:bg-blue-600 text-xs lg:text-sm rounded-md" type="button" onclick="copyToClipboard(this)">copy</button>
                            </div>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="paystack_public_key">Paystack Public Key:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paystack_public_key" id="paystack_public_key" value="{{ old('paystack_public_key') ?? env('PAYSTACK_PUBLIC_KEY') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('paystack_public_key') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="paystack_secret_key">Paystack Secret Key:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paystack_secret_key" id="paystack_secret_key" value="{{ old('paystack_secret_key') ?? env('PAYSTACK_SECRET_KEY') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('paystack_secret_key') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="merchant_email">Merchant Email:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="merchant_email" id="merchant_email" value="{{ old('merchant_email') ?? env('MERCHANT_EMAIL') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('merchant_email') {{ $message }} @enderror
                        </span>
                    </div>
                    {{--  Paystack Gateway ends here here --}}

                    @endif

                    <h4 class="text-[#ebedf2] font-medium capitalize mb-2 mt-4">Payment Setting</h4>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="min_amount">Minimum Deposit Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_amount" id="min_amount" value="{{ old('min_amount') ?? $gateway->min_amount }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('min_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="max_amount">Maximum Deposit Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_amount" id="max_amount" value="{{ old('max_amount') ?? $gateway->max_amount }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('max_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="charge">Charge:</label>
                            <div class="flex space-x-5">
                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="charge" id="charge" value="{{ old('charge') ?? $gateway->charge }}" required>
                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="charge_type" id="charge_type" required>
                                    <option value="percent" @if (old('charge_type') ?? $gateway->charge_type == 'percent') selected @endif>%</option>
                                    <option value="charge" @if (old('charge_type') ?? $gateway->charge_type == 'fixed') selected @endif>({{ strtoupper(websiteInfo('general_currency')) }})</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('charge') {{ $message }} @enderror @error('charge_type') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="status">Status:</label>
                            <div class="">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="status" id="status" required>
                                    <option value="active" @if (old('status') ?? $gateway->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if (old('status') ?? $gateway->status == 'inactive') selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('status') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="payment_instruction">Payment Instruction:</label>
                            <textarea class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="payment_instruction" id="payment_instruction" required>{!! $gateway->payment_instruction !!}</textarea>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('payment_instruction') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    function copyToClipboard(element) {
        let elemToCopy = $(element).siblings(".to-copy");
        elemToCopy.select();
        document.execCommand("copy");

        Swal.fire({
            title: '',
            text: "Copied to clipboard",
            icon: 'success',
            background: "#0e1726",
            color: "#d1d5db",
            
        })
    }
</script>

{{--  text editor --}}
<script>
    ClassicEditor
        .create(document.querySelector('#payment_instruction'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection