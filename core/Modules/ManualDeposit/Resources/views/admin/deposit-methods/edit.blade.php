@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Edit {{ $method->name }}
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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-end space-x-3">
                <div>
                    <a href="{{ route('admin.deposit-method.index') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>View All</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.deposit-method.new') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
                <div>
                    <form action="{{ route('admin.deposit-method.delete', $method->id) }}" method="post" id="deleteMethodForm">
                        @csrf
                        <a id="deleteMethod" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Delete</span>
                        </a>
                    </form>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                {{--  disclaimer notification --}}
                <div class="w-full p-6 md:p-10 flex justify-center">
                    <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                        <div class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>
                        <div>
                            <b class="font-medium">Disclaimer: </b> Manual deposit method <b>type</b> cannot be changed. Delete the is payment method and create a new one if you wish to change the type.
                            <br>
                            <b>Type: </b> {{ $method->type }}
                        </div>
                    </div>
                </div>

                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.deposit-method.edit-method.validate') }}" method="post" enctype="multipart/form-data">

                    <div class="w-full flex justify-between items-center px-2 lg:px-5 mb-5">
                        <div>
                            <img src="{{ route('file', ['deposit-methods', $method->logo]) }}" width="80px" alt="{{ $method->name }}" class="rounded-full">
                        </div>

                        @if ($method->type == 'crypto')
                        <div align="right">
                            {!! QrCode::generate($method->wallet_address) !!}
                            <p class="text-[#bfc9d4] text-right">
                                <b>QR Code</b> *QR Codes are auto regenrated <br>
                            </p>
                        </div>
                        @endif
                    </div>

                    @csrf
                    <input type="hidden" name="id" value="{{ $method->id }}">
                    <input type="hidden" name="type" value="{{ $method->type }}">

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        @if ($method->class == 'manual')
                        <div class="w-full">
                            <label class="font-medium" for="name">Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="name" id="name" value="{{ old('name') ?? $method->name }}" required>
                        </div>
                        @else
                        <div class="w-full">
                            <label class="font-medium" for="name">Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" id="name" value="{{ old('name') ?? $method->name }}" readonly>
                            <input type="hidden" name="name" id="name" value="{{ $method->name }}" required>
                        </div>
                        @endif
                        <span class="p-1 text-red-600">
                            @error('name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="min_amount">Minimum Deposit Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_amount" id="min_amount" value="{{ old('min_amount') ?? $method->min_amount }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('min_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="max_amount">Maximum Deposit Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_amount" id="max_amount" value="{{ old('max_amount') ?? $method->max_amount }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('max_amount') {{ $message }} @enderror
                        </span>
                    </div>


                    @if ($method->class == 'manual')
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="currency">Currency:</label>
                            <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="currency" id="currency" required>
                                @foreach ($currencies as $currency)
                                <option value="{{ $currency['currency_code'] }}" @if (old('currency') ?? $method->currency == $currency['currency_code']) selected @endif>{{ strtoupper($currency['currency_code']) }} | {{ $currency['currency_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('currency') {{ $message }} @enderror
                        </span>
                    </div>

                    @else
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="currency">Currency:</label>
                            <input type="hidden" name="currency" value="{{ $method->currency }}">
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" value="{{ strtoupper($method->currency) }}" readonly>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('currency') {{ $message }} @enderror
                        </span>
                    </div>
                    @endif

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="charge">Charge:</label>
                            <div class="flex space-x-5">
                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="charge" step="any" value="{{ old('charge') ?? $method->charge }}" required>
                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="charge_type" id="charge_type" required>
                                    <option value="percent" @if (old('method_type') ?? $method->charge_type == 'percent') selected @endif>Percentage(%)</option>
                                    <option value="fixed" @if ( old('method_type') ?? $method->charge_type == 'fixed') selected @endif>{{ websiteInfo('general_currency') }}</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('charge') {{ $message }} @enderror @error('charge_type') {{ $message }} @enderror
                        </span>
                    </div>

                    @if ($method->type == 'crypto')
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="wallet_address">Wallet Address:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="wallet_address" id="wallet_address" required value="{{ old('wallet_address') ?? $method->wallet_address }}">
                        </div>
                        <span class="p-1 text-red-600">
                            @error('wallet_address') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="network_type">Network Type:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="network_type" id="netwok_type" value="{{ old('network_type') ?? $method->network_type }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('network_type') {{ $message }} @enderror
                        </span>
                    </div>

                    @elseif ($method->type == 'bank')
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="bank_name">Bank Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') ?? $method->bank_name }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('bank_name') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="account_name">Account Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="account_name" id="account_name" required value="{{ old('account_name') ?? $method->account_name }}">
                        </div>
                        <span class="p-1 text-red-600">
                            @error('account_name') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="account_no">Account No:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="account_no" id="account_no" value="{{ old('account_no') ?? $method->account_no }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('account_no') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="bank_code">Bank Code:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="bank_code" id="bank_code" value="{{ old('bank_code') ?? $method->bank_code }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('bank_code') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="sort_code">Sort Code:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="sort_code" id="bank_code" value="{{ old('sort_code') ?? $method->sort_code }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('sort_code') {{ $message }} @enderror
                        </span>
                    </div>
                    @endif
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="payment_instruction">Payment Instruction:</label>
                            <textarea class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="payment_instruction" id="payment_instruction">{!! old('payment_instruction') ?? $method->payment_instruction !!}</textarea>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('payment_instruction') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">

                            <label class="font-medium" for="status">Status:</label>
                            <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="status" id="status" required>
                                <option value="active" @if ( old('status') ?? $method->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if ( old('status') ?? $method->status == 'inactive') selected @endif>Disabled</option>
                            </select>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('status') {{ $message }} @enderror
                        </span>
                    </div>

                    @if ( $method->class == 'manual' )
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="logo">Logo:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="file" accept="image/png, image/jpg, image/jpeg" name="logo" id="logo">
                        </div>
                        <span class="p-1 text-red-600">
                            @error('logo') {{ $message }} @enderror
                        </span>
                    </div>
                    @endif


                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md" href="{{ route('user.id.upload') }}">
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
{{-- Sweet alert --}}
{{-- //delete deposit --}}
<script>
    //Delete deposit method
    $(document).ready(function() {
        $("#deleteMethod").click(function() {
            Swal.fire({
                title: 'Delete Deposit!',
                text: "Do you want to delete this Deposit method? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deleteMethodForm' }}").submit();
                }
            });
        });
    });

    //editor
    ClassicEditor
        .create(document.querySelector('#payment_instruction'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection