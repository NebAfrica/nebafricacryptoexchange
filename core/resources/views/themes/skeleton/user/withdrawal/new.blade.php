@extends('themes.skeleton.layout.app')
@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        New Withdrawal Request
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
                {{--  Card header --}}
                <h6  >
                    Available Bal.
                </h6>
                <h2  >
                    {{ formatAmount(user('account_bal')) }}
                </h2>
            </div>

            <hr  >

            <div  >
                <form action="{{ route('user.withdrawals.new-validate') }}" method="POST">
                    <table  >
                        <tbody  >
                            <tr>
                                <td><span  >Min Withdrawal:</span></td>
                                <td>{{ formatAmount(websiteInfo('min_withdrawal')) }}</td>
                            </tr>
                            <tr>
                                <td><span  >Max Withdrawal:</td>
                                <td>{{ formatAmount(websiteInfo('max_withdrawal')) }}</td>
                            </tr>
                            @if(websiteInfo('withdrawal_fee_type') == 'fixed')
                            <tr>
                                <td  >Withdrawal Fee:</td>
                                <td>{{ formatAmount(websiteInfo('withdrawal_fee')) }}</td>
                            </tr>

                            @elseif (websiteInfo('withdrawal_fee_type') == 'percent')
                            <tr>
                                <td colspan="2"  >
                                    <span  >Withdrawal Fee:</span>
                                    <span>{{ websiteInfo('withdrawal_fee') .'%' }}</span>
                                </td>
                            </tr>
                            @endif

                            @csrf
                            @if (session()->has('amount'))
                            <tr>
                                <td colspan="2">
                                    {{-- details confirmation --}}
                                    <div  >
                                        <div  >
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div  >
                                                <p>You have selected to withdraw <b>{{ formatAmount(session()->get('amount'))  }}</b> via <b>{{ session()->get('wallet')->name }}</b>. A withdrawal fee of <b>{{ formatAmount(session()->get('fee')) }} </b> has been applied to this request </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @if (websiteInfo('withdrawal_otp') == 'enabled')
                            <tr>
                                <td colspan="2">
                                    <div  >
                                        {{-- OTP input --}}
                                        <div  >
                                            <span  >
                                                OTP
                                            </span>
                                            <input type="text" name="otp" id="otp" required   placeholder="Enter OTP">
                                        </div>
                                        <div  >
                                            <a   role="button">Resend OTP</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            {{-- Just a seprrator --}}
                            <tr>
                                <td colspan="2"></td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    {{-- confirm --}}
                                    <div>
                                        <button type="submit"  >
                                            Confirm
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td  >
                                    <label for="amount">Amount {{ websiteInfo('general_currency') }}:</label>
                                </td>
                                <td>
                                    <div  >
                                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <input type="number" step="any" name="amount" id="amount" required value="{{ old('amount') }}" min="" max="{{ user('account_bal') }}"  >
                                    </div>
                                    @error('amount') {{ $message }} @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"  >
                                    <h4  >
                                        Select Wallet
                                    </h4>
                                </td>
                            </tr>

                            {{--  wallets --}}
                            @foreach ($wallets as $wallet)
                            <tr>
                                <td colspan="2">
                                    <div  >
                                        <label   for="{{ $wallet->id }}">
                                            <h3  >
                                                <span>{{ $wallet->name }}</span>
                                            </h3>
                                            <h6  >
                                                <span>{{ $wallet->type }}</span>
                                            </h6>
                                        </label>
                                        <br><br><br>
                                        <input   type="radio" id="{{ $wallet->id }}" name="wallet_id" value="{{ $wallet->id }}" required>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    <hr  >

                                    <div  >
                                        <button type="submit"  >
                                            Next
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection