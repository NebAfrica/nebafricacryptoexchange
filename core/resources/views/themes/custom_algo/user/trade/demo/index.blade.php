@extends('themes.cryptic.layout.app')

@section('content')

    <div class="w-full py-5" id="content">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                <div class="parent-row">
                    <div class="wallet-section" id="content-left">
                        <div class="parent-row">

                            <div class="w-full">
                                <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                    <div
                                        class="w-full flex justify-between space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                        <div class="mt-3 mb-3">
                                            <h3 class="font-bold">{{ ct('Welcome to Demo Dashboard') }}</h3>
                                        </div>

                                        <div class="mt-3 mb-3">
                                            <a role="button"
                                                href="{{ route('user.trading.demo.trade', ['symbol1' => 'BTC', 'symbol2' => 'USDT']) }}"
                                                data-action="withdraw"
                                                class="wallet-trigger flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                                <span class="text-green-600">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                    </svg>
                                                </span>
                                                <span>{{ ct('Start Trading') }}</span>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">

                                <div id="market-orders" class="orders">
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            {{ ct('DATE', 'u') }}
                                        </div>
                                        <div>
                                            {{ ct('TYPE', 'u') }}
                                        </div>

                                        <div>
                                            {{ ct('AMOUNT', 'u') }}
                                        </div>

                                        <div>
                                            {{ ct('ORDER', 'u') }}
                                        </div>
                                    </div>

                                    @if ($trades->count() > 0)
                                        @foreach ($trades->where('status', 'active') as $trade)
                                            <div
                                                class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                                <div>
                                                    {!! date('d.m.y', strtotime($trade->created_at)) . '<br>' . date('H:i:s', strtotime($trade->created_at)) !!}
                                                </div>
                                                <div class="flex">
                                                    @if ($trade->order_type == 'buy')
                                                        <span class="text-green-600">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                            </svg>
                                                        </span>
                                                    @else
                                                        <span class="text-red-600">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                            </svg>
                                                        </span>
                                                    @endif
                                                    <span>{{ ct($trade->order_type) }}</span>
                                                </div>
                                                    
                                                <div>
                                                    {{ $trade->amount . ' ' .  str_replace('_', '/' , $trade->pair) }}
                                                </div>
                                                    
                                                <div>
                                                    <a href="{{ route('user.trading.demo.trade', ['symbol1' => (explode('_', $trade->pair)[0]), 'symbol2' => (explode('_', $trade->pair)[1])]) }}" class="end-trade flex space-x-1 bg-orange-500 px-2 py-1 rounded hover:bg-gray-600">{{ ct('End Trade') }}</a>
                                                </div>
                                            
                                            </div>
                                        @endforeach

                                        @foreach ($trades->where('status', '!=', 'active') as $trade)
                                            <div
                                                class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                                <div>
                                                    {!! date('d.m.y', strtotime($trade->created_at)) . '<br>' . date('H:i:s', strtotime($trade->created_at)) !!}
                                                </div>
                                                <div class="flex">
                                                    @if ($trade->order_type == 'buy')
                                                        <span class="text-green-600">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                            </svg>
                                                        </span>
                                                    @else
                                                        <span class="text-red-600">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                            </svg>
                                                        </span>
                                                    @endif
                                                    <span>{{ ct($trade->order_type) }}</span>
                                                </div>
                                                    
                                                <div>
                                                    {{ $trade->amount . ' ' .  str_replace('_', '/' , $trade->pair) }}
                                                </div>
                                                    
                                                <div class="@if($trade->status == 'win') text-green-500 @else text-red-500 @endif">
                                                    {{ ct($trade->status) }}
                                                </div>
                                            
                                            </div>
                                        @endforeach
                                    @else
                                        <div
                                            class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                <p class="">
                                                    <b class="font-medium text-orange-500">{{ ct('Empty!') }} </b>
                                                    {{ ct("You don't have any trades") }}
                                                </p>
                                                <img src="{{ asset('public/assets/trading/images/empty.png') }}" alt="no-orders">
                                            </div>

                                        </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="trade-section">


                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4" id="content-right">
                            <div
                                class="w-full space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    {{ ct('Demo Wallets') }}
                                </h2>

                                <div class="mt-5"></div>
                                @if ($wallets->count() > 0)
                                    @foreach ($wallets as $wallet)
                                        <div
                                            class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div class="font-medium">
                                                {{ $wallet->symbol }}

                                            </div>
                                            <div>
                                                {{ number_format($wallet->balance, 8) }}
                                            </div>

                                        </div>
                                    @endforeach
                                @else
                                    <p class="">
                                        <b class="font-medium text-orange-500">{{ ct('Empty!') }} </b>
                                        {{ ct("You don't have any wallets") }}
                                    </p>
                                @endif
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
    </style>
@endsection

@section('script')
@endsection
