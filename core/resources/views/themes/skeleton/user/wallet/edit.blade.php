@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        Edit Wallet
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

            <div  >
                <div>
                    <a href="#"  >
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
            </div>
            <hr  >

            {{-- <div  >
                <div  >
                    <img   src="put-me" alt="Wallet picture">
                </div>
            </div> --}}

            <form   action="{{ route('user.wallets.edit-validate') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $wallet->id }}">

                <div  >
                    <div  >
                        <label   for="wallet_name">Wallet Name:</label>
                        <input   type="text" name="wallet_name" id="wallet_name" required value="{{ $wallet->name }}">
                    </div>
                    <span  >
                        @error('wallet_name') {{ $message }} @enderror
                    </span>
                </div>


                @if ($wallet->type == 'crypto')
                <div  >
                    <div  >
                        <label   for="wallet_address">Wallet Address:</label>
                        <input   type="text" name="wallet_address" id="wallet_address" required value="{{ json_decode($wallet->info)->wallet_address }}">
                    </div>
                    <span  >
                        @error('wallet_address') {{ $message }} @enderror
                    </span>
                </div>
                <div  >
                    <div  >
                        <label   for="network_type">Network Type:</label>
                        <input   type="text" name="network_type" id="netwok_type" value="{{ json_decode($wallet->info)->network_type }}" required>
                    </div>
                    <span  >
                        @error('network_type') {{ $message }} @enderror
                    </span>
                </div>

                @elseif ($wallet->type == 'bank')
                <div  >
                    <div  >
                        <label   for="bank_name">Bank Name:</label>
                        <input   type="text" name="bank_name" id="bank_name" value="{{ json_decode($wallet->info)->bank_name }}" required>
                    </div>
                    <span  >
                        @error('bank_name') {{ $message }} @enderror
                    </span>
                </div>
                <div  >
                    <div  >
                        <label   for="account_name">Account Name:</label>
                        <input   type="text" name="account_name" id="account_name" required value="{{ json_decode($wallet->info)->account_name }}">
                    </div>
                    <span  >
                        @error('account_name') {{ $message }} @enderror
                    </span>
                </div>
                <div  >
                    <div  >
                        <label   for="account_no">Account No:</label>
                        <input   type="number" name="account_no" id="account_no" value="{{ json_decode($wallet->info)->account_no }}" required>
                    </div>
                    <span  >
                        @error('account_no') {{ $message }} @enderror
                    </span>
                </div>
                @elseif ($wallet->type == 'others')
                <div  >
                    <div  >
                        <label   for="payment_info">Payment Info:</label>
                        <textarea   name="payment_info" id="payment_info">{{ json_decode($wallet->info)->payment_info }}</textarea>
                    </div>
                    <span  >
                        @error('payment_info') {{ $message }} @enderror
                    </span>
                </div>
                @endif

                <div  >
                    <button type="submit"   href="{{ route('user.id.upload') }}">
                        Save wallet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection