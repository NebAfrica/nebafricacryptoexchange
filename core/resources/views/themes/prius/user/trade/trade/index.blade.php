@php
    $balance = [];
    foreach (tradingWallet() as $wallet) {
        $bal = currencyConverter($wallet->symbol, 'usd' , $wallet->balance)['amount'];
        array_push($balance, $bal);
    }

    $balance = array_sum($balance);

@endphp

@extends('themes.cryptic.layout.app')




@section('content')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                <div class="">
                    <div class="">
                        <div class="md:flex md:justify-between md:space-x-5">
                            <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4 md:w-1/2">
                                <div
                                    class="w-full  space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                        {{ ct('Hi') }} {{ user('first_name') }}
                                    </h2>


                                    <div class="mt-4">
                                        <a href="{{ '/user/trading/trade/BTC/USDT' }}"
                                            class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">

                                            {{ ct('START TRADING') }}
                                        </a>
                                    </div>


                                </div>
                            </div>
                            <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4 ms:w-2/3">
                                <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-3 text-xs md:text-sm">
                                    <div
                                        class="w-full flex flex-wrap  justify-evenly md:justify-center items-center space-x-0 lg:space-x-5 mt-10 mb-5">

                                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-green-500 hover:bg-gray-600 mb-2"
                                            href="{{ route('user.deposit.new') }}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                            </svg>
                                            <h6>{{ ct('Deposit') }}</h6>
                                        </a>
                                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-blue-500 hover:bg-gray-600 mb-2"
                                            href="{{ route('user.investments.new') }}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                                </path>
                                            </svg>
                                            <h6>{{ ct('Invest') }}</h6>
                                        </a>
                                        @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
                                            <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-purple-500 hover:bg-gray-600 mb-2"
                                                href="{{ route('user.loan.new') }}">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z">
                                                    </path>
                                                </svg>
                                                <h6>{{ ct('Borrow') }}</h6>
                                            </a>
                                        @endif


                                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-red-500 hover:bg-gray-600 mb-2"
                                            href="{{ route('user.withdrawals.new') }}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                            </svg>
                                            <h6>{{ ct('Withdraw') }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-3">
                                    {{-- Wallet Balance --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/wallet.png') }}"
                                                alt="wallet balance" width="40px" class="rounded-full">
                                        </div>
                                        <div class="w-full">
                                            <div class="w-full flex justify-between mb-2">
                                                <div>
                                                    <h3 class="font-medium">{{ ct('Fiat Balance') }}</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.deposit.new') }}"
                                                        class="flex justify-start items-center space-x-1 text-xs text-[#d1d5db] text-center p-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                                        {{ ct('TOP UP') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-end bg-gray-500 p-2 rounded">
                                                <h2 class="font-lg">{{ formatAmount(user('account_bal')) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/wallet.png') }}"
                                                alt="wallet balance" width="40px" class="rounded-full">
                                        </div>
                                        <div class="w-full">
                                            <div class="w-full flex justify-between mb-2">
                                                <div>
                                                    <h3 class="font-medium">{{ ct('Crypto Bal') }}</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.deposit.new') }}"
                                                        class="flex justify-start items-center space-x-1 text-xs text-[#d1d5db] text-center p-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                                        {{ ct('TOP UP') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-end bg-gray-500 p-2 rounded">
                                                <h2 class="font-lg">{{ formatAmount($balance) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    @foreach (tradingWallet() as $wallet)
                                        <div
                                            class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower( $wallet->symbol) . '.svg') }}"
                                                    alt="{{ $wallet->symbol }}" width="40px" class="rounded-full">
                                            </div>
                                            <div class="w-full">
                                                <div class="w-full flex justify-between mb-2">
                                                    <div>
                                                        <h3 class="font-medium">{{ $wallet->symbol }}</h3>
                                                    </div>

                                                    <div>
                                                        <h3 class="text-xs">{{ $wallet->balance }}</h3>
                                                    </div>
                                                    
                                                </div>

                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded">
                                                    <h2 class="font-lg">{{ formatAmount(currencyConverter($wallet->symbol, 'usd' , $wallet->balance)['amount']) }}</h2>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach


                                    

                                </div>

                            </div>



                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>








    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                <div class="parent-row">
                    <div class="trade-section">

                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            <div
                                class="w-full space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    Wallets
                                </h2>

                                <div class="mt-5"></div>
                                @if (tradingWallet()->count() > 0)
                                    @foreach (tradingWallet() as $wallet)
                                        <div
                                            class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg'))
                                                    <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg') }}"
                                                        alt="{{ $wallet->name }}" width="30px" class="rounded-full">
                                                @else
                                                    <img src="{{ asset('public/assets/imgs/fallback.png') }}"
                                                        alt="{{ $wallet->name }}" width="30px" class="rounded-full">
                                                @endif

                                            </div>
                                            <div>
                                                {{ $wallet->symbol }}
                                            </div>
                                            <div>{{ number_format($wallet->balance, 8) }}</div>
                                            <div class="inline-flex space-x-3 md:space-x-5">
                                                <a href="{{ route('user.trading.wallets.view', $wallet->address) }}">
                                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="">
                                        <b class="font-medium text-orange-500">Empty! </b>
                                        You don't have any wallets
                                    </p>
                                @endif
                            </div>


                        </div>
                    </div>
                    <div class="wallet-section">
                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            <div
                                class="w-full flex justify-between items-center rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <div class="wallet-heading current" data-toggle="market-orders">
                                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                        MARKET ORDERS
                                    </h2>
                                </div>

                                <div class="wallet-heading" data-toggle="limit-orders">
                                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                        LIMIT ORDERS
                                    </h2>
                                </div>

                                <div class="wallet-heading" data-toggle="stop-limit-orders">
                                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                        STOP LIMIT ORDERS
                                    </h2>
                                </div>

                            </div>
                        </div>

                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">

                                <div id="market-orders" class="orders">
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            TRADE
                                        </div>
                                        <div>
                                            PRICING
                                        </div>

                                        <div>
                                            ORDER
                                        </div>

                                        <div>
                                            STATUS
                                        </div>
                                    </div>

                                    @if (1 == 2)
                                    @else
                                        <div
                                            class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                <p class="">
                                                    <b class="font-medium text-orange-500">Empty! </b>
                                                    No Market Orders Found
                                                </p>
                                                <img src="/public/assets/trading/images/empty.png" alt="no-orders">
                                            </div>

                                        </div>
                                    @endif
                                </div>

                                <div id="limit-orders" class="orders hidden">
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            TRADE
                                        </div>
                                        <div>
                                            PRICING
                                        </div>

                                        <div>
                                            ORDER
                                        </div>

                                        <div>
                                            STATUS
                                        </div>
                                    </div>

                                    @if (1 == 2)
                                    @else
                                        <div
                                            class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                <p class="">
                                                    <b class="font-medium text-orange-500">Empty! </b>
                                                    No Limit Orders Found
                                                </p>
                                                <img src="/public/assets/trading/images/empty.png" alt="no-orders">
                                            </div>

                                        </div>
                                    @endif
                                </div>

                                <div id="stop-limit-orders" class="orders hidden">
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            TRADE
                                        </div>
                                        <div>
                                            PRICING
                                        </div>

                                        <div>
                                            ORDER
                                        </div>

                                        <div>
                                            STATUS
                                        </div>
                                    </div>

                                    @if (1 == 2)
                                    @else
                                        <div
                                            class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                <p class="">
                                                    <b class="font-medium text-orange-500">Empty! </b>
                                                    No Stop Limit Orders Found
                                                </p>
                                                <img src="/public/assets/trading/images/empty.png" alt="no-orders">
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>

    <style>
        .parent-row {
            display: flex;
            justify-content: space-between;
        }

        .trade-section {
            position: relative;
            width: 35%;

        }

        .wallet-section {
            position: relative;
            width: 65%;

        }

        @media only screen and (max-width: 600px) {
            .parent-row {
                display: block;

            }

            .trade-section,
            .wallet-section {
                width: 100%;
                display: block;
                margin-top: 10px;
            }
        }

        .wallet-section .wallet-heading {
            cursor: pointer;
        }

        .wallet-section .current {
            border-bottom: solid 5px #d3d6df;
        }

        .hidden {
            display: none;
        }
    </style>
@endsection

@section('script')
    <script>
        //toggle wallet heading
        $('.wallet-heading').on('click', function() {
            $('.wallet-heading').removeClass('current');
            $(this).addClass('current');

            var target = '#' + $(this).data('toggle');
            $('.orders').addClass('hidden');
            setTimeout(() => {
                $(target).toggleClass('hidden');
            }, 200);

        });

        $('#referral_link').on('click', function() {
            var hiddenInput = '<input type="text" name="" value="" id="toCopy">';
            $('#toCopyDiv').html(hiddenInput);
            $('#toCopy').val($(this).data('link'));
            let elemToCopy = $('#toCopy');
            elemToCopy.select();
            document.execCommand("copy");

            Swal.fire({
                title: '',
                text: "Copied to clipboard",
                icon: 'success',
                background: "#0e1726",
                color: "#d1d5db",

            }).then((result) => {
                if (result.isConfirmed) {
                    $('#toCopyDiv').html('');
                }
            });
        });
    </script>
@endsection
