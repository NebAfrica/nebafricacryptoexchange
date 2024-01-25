@extends('themes.skeleton.layout.app')
@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        Add New Wallet
                    </h2>
                </div>

                <div>
                    <form action="{{ route('user.wallets.cancel') }}" method="post">
                        @csrf
                        <button type="submit"  >
                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span>Cancel</span>
                        </button>
                    </form>
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
            <form   action="{{ route('user.wallets.new-validate') }}" method="POST">
                @csrf
                @if (session()->has('wallet_type'))
                <div  >
                    <div  >
                        <label   for="wallet_name">Wallet Name:</label>
                        <input   type="text" name="wallet_name" id="wallet_name" required value="{{ old('wallet_name') }}">
                    </div>
                    <span  >
                        @error('wallet_name') {{ $message }} @enderror
                    </span>
                </div>
                @if (session()->get('wallet_type') == 'crypto')
                <div  >
                    <div  >
                        <label   for="wallet_address">Wallet Address:</label>
                        <input   type="text" name="wallet_address" id="wallet_address" required value="{{ old('wallet_address') }}">
                    </div>
                    <span  >
                        @error('wallet_address') {{ $message }} @enderror
                    </span>
                </div>
                <div  >
                    <div  >
                        <label   for="network_type">Network Type:</label>
                        <input   type="text" name="network_type" id="netwok_type" value="{{ old('network_type') }}" required>
                    </div>
                    <span  >
                        @error('network_type') {{ $message }} @enderror
                    </span>
                </div>
                @elseif (session()->get('wallet_type') == 'bank')
                <div  >
                    <div  >
                        <label   for="bank_name">Bank Name:</label>
                        <input   type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" required>
                    </div>
                    <span  >
                        @error('bank_name') {{ $message }} @enderror
                    </span>
                </div>
                <div  >
                    <div  >
                        <label   for="account_name">Account Name:</label>
                        <input   type="text" name="account_name" id="account_name" required value="{{ old('account_name') }}">
                    </div>
                    <span  >
                        @error('account_name') {{ $message }} @enderror
                    </span>
                </div>
                <div  >
                    <div  >
                        <label   for="account_no">Account No:</label>
                        <input   type="number" name="account_no" id="account_no" value="{{ old('account_no') }}" required>
                    </div>
                    <span  >
                        @error('account_no') {{ $message }} @enderror
                    </span>
                </div>

                @elseif (session()->get('wallet_type') == 'others')
                <p>
                    <label for="payment_info">Payment Info</label>
                    <textarea name="payment_info" id="payment_info" cols="30" rows="10">{{ old('payment_info') }}</textarea>
                    <span>@error('payment_info') {{ $message }} @enderror</span>
                </p>
                @endif

                <div  >
                    <button type="submit"  >
                        Save wallet
                    </button>
                </div>

                @else

                <div  >
                    <div>
                        <h2  >Please, select your wallet type.</h2>
                        <div  >
                            <span  >
                                account_balance_wallet
                            </span>
                            <select name="wallet_type" id="wallet_type"   required>
                                <option value="" @selected(true) disabled>Select wallet type</option>
                                <option value="crypto">Crypto</option>
                                <option value="bank">Bank</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div  >
                    <button type="submit"   href="{{ route('user.id.upload') }}">
                        Next
                    </button>
                </div>

                @endif
            </form>

        </div>
    </div>
</div>

@endsection