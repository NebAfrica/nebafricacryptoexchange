@extends('themes.cryptic.layout.app')




@section('content')
@include('themes.cryptic.user.trade.wallets.deposit')
<div class="w-full py-5" id="content">    
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
            <div class="parent-row">
                <div class="wallet-section" id="content-left">
                    <div class="parent-row">
                        <div class="trade-section" id="price-block">
                            <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                <div class="w-full  space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                                        <div class="hidden lg:block relative w-full">
                                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-blue-600 text-white">
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg'))
                                                    <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg') }}" alt="{{ $wallet->name }}"  class="rounded-full">
                                                @else 
                                                    <img src="{{ asset('public/assets/imgs/fallback.png') }}" alt="{{ $wallet->name }}"  class="rounded-full">
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <h2 class="text-sm lg:text-base font-semibold">{{ number_format($wallet->balance, 8) }}</h2>
                                            </div>
                                            <div class="mt-2">
                                                <h4 class="text-xs lg:text-sm font-medium">{{ $wallet->symbol }}</h4>
                                            </div>
                                        </div>
                                        <div class="lg:hidden opacity-50">
                                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-blue-600 text-white">
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg'))
                                                    <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg') }}" alt="{{ $wallet->name }}"  class="rounded-full">
                                                @else 
                                                    <img src="{{ asset('public/assets/imgs/fallback.png') }}" alt="{{ $wallet->name }}"  class="rounded-full">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wallet-section">
                            <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                <div class="w-full flex justify-between space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                    <div class="mt-3 mb-3">
                                        <a role="button" data-action="fund" class="wallet-trigger flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            <span class="text-green-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                                </svg>
                                            </span>                                            
                                            <span>Fund</span>
                                        </a>
                                    </div>

                                    <div class="mt-3 mb-3">
                                        <a role="button" data-action="withdraw"  class="wallet-trigger flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            <span class="text-red-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                                </svg>
                                            </span>
                                            <span>Withdraw</span>
                                        </a>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                        <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            
                            <div id="market-orders" class="orders">
                                <div class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                    <div>
                                        DATE
                                    </div>
                                    <div>
                                        TYPE
                                    </div>

                                    <div>
                                        AMOUNT
                                    </div>

                                    <div>
                                        ORDER
                                    </div>
                                </div>

                                @if ($wallet_transactions->count() > 0)
                                    @foreach ($wallet_transactions as $trx)
                                        <div class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div>
                                                {{ date('d.m.Y', strtotime($trx->created_at)) }} <br>
                                                {{ date('H:i:s', strtotime($trx->created_at)) }}
                                            </div>
                                            <div class="flex">
                                                @if ($trx->type == 'credit')
                                                    <span class="text-green-600">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                        </svg>
                                                    </span>
                                                @else
                                                    <span class="text-red-600">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                        </svg>
                                                    </span>  
                                                @endif
                                                <span>{{ $trx->type }}</span>
                                            </div>

                                            <div>
                                                {{ number_format($trx->amount, 8) }}
                                            </div>

                                            <div>
                                                {{ $trx->order_type }}
                                            </div>
                                        </div> 
                                    @endforeach
                                    

                                @else
                                <div class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                    <div>
                                        <p class="">
                                            <b class="font-medium text-orange-500">Empty! </b> 
                                            No transaction found for this wallet
                                         </p>
                                        <img src="/public/assets/trading/images/empty.png" alt="no-orders">
                                    </div>
                                    
                                </div>
                                @endif
                            </div>

                           
                        </div>
                    </div>
                </div>
                <div class="trade-section">
                    

                    <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4" id="content-right">
                        <div class="w-full space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                Other Wallets
                             </h2>

                             <div class="mt-5"></div>
                             @if (tradingWallet()->count() > 0)

                             @foreach (tradingWallet() as $wallet)
                                <div class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                    <div>
                                        @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg'))
                                            <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower($wallet->symbol) . '.svg') }}" alt="{{ $wallet->name }}"  width="30px" class="rounded-full">
                                        @else 
                                            <img src="{{ asset('public/assets/imgs/fallback.png') }}" alt="{{ $wallet->name }}"  width="30px" class="rounded-full">
                                        @endif
                                        
                                    </div>
                                    <div>
                                        {{ $wallet->symbol }}
                                    </div>
                                    <div>{{ number_format($wallet->balance, 8) }}</div>
                                    <div class="inline-flex space-x-3 md:space-x-5">
                                        <a role="button" data-href="{{ route('user.trading.wallets.view', $wallet->address) }}" class="wallet_link">
                                            <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
                
            </div>
            

            

            
        </div>
    </div>
</div>

<style>

    .parent-row {
        display: flex;
        justify-content: space-between;
    }
    .trade-section{
        position: relative;
        width: 35%;
        
    }

    .wallet-section{
        position: relative;
        width: 65%;
        
    }

    @media only screen and (max-width: 600px) {
        .parent-row {
            display: block;
            
        }
        .trade-section, .wallet-section {
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
    <script>
        //ajax page reoad
        $('.wallet_link').on('click', function(reload){
            var reloadUrl = $(this).data('href');
            $.get(reloadUrl).done(function(r) {
                var newDom = $(r);
                $('#price-block').replaceWith($('#price-block',newDom));
                $('#market-orders').replaceWith($('#market-orders',newDom));                
                $('#segment-1').replaceWith($('#segment-1',newDom));
                $('#segment-2').replaceWith($('#segment-2',newDom));
                $('#segment-3').replaceWith($('#segment-3',newDom));
                $('#reloadSection').replaceWith($('#reloadSection',newDom));
                $('#symbol-change').replaceWith($('#symbol-change',newDom));
               
            });

            
        });

        $("#funding-amount").on('input', function(){
            var action_type = $('#action-type').val();
            var funding_rate = $('#funding-rate').html();
            var funding_amount = $('#funding-amount').val();
            var actual_rate =  1 / funding_rate;
            var curren_bal = $('#funding-current-balance').data('bal');
            var coin_bal = $('#coin-balance').data('bal');
            var funding_total = funding_amount * actual_rate;            
            $('#funding-total').val(funding_total.toFixed(8));

            if (action_type == 'fund') {
                if (funding_amount > curren_bal ) {
                    $('#funding-current-balance').removeClass('text-green-600').addClass('text-red-600').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                    $('#funding-submit').hide();
                } else {
                    $('#funding-current-balance').removeClass('text-red-600').addClass('text-green-600');
                    $('#funding-submit').show();
                }
            } else {
                if (funding_total > coin_bal ) {
                    $('#coin-balance').removeClass('text-green-600').addClass('text-red-600').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                    $('#funding-submit').hide();
                } else {
                    $('#coin-balance').removeClass('text-red-600').addClass('text-green-600');
                    $('#funding-submit').show();
                }
            }

            
            
            
        });

        $('#funding-form').on('submit', function(e){
            e.preventDefault();
            $('#preloader').show();
            var action = $('#action-type').val();
            var amount = $('#funding-amount').val();
            var wallet = $('#wallet').html();
            $.ajax({
                url: "{{  route('user.trading.wallets.fund-withdraw') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    action: action,
                    amount: amount,
                    wallet: wallet,
                },
                success: function(response) {
                    $('#preloader').hide();
                    var reloadUrl = $('#reloadUrl').val();
                    $.get(reloadUrl).done(function(r) {
                        var newDom = $(r);
                        $('#price-block').replaceWith($('#price-block',newDom));
                        $('#market-orders').replaceWith($('#market-orders',newDom));                
                        $('#segment-1').replaceWith($('#segment-1',newDom));
                        $('#segment-2').replaceWith($('#segment-2',newDom));
                        $('#segment-3').replaceWith($('#segment-3',newDom));
                        $('#symbol-change').replaceWith($('#symbol-change',newDom));
                        
                    
                    });

                    $('.full-popup').hide(200);
                    $('#funding-total').val('');
                    $('#funding-amount').val('');
                    
                    
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Wallet ' + action + ' successful',
                        showConfirmButton: false,
                        timer: 4500,
                        background: "#0e1726",
                        color: "#b9bead",
                        toast: true,
                        
                    });

                },
                error: function(response) {                    
                    $('#preloader').hide(); 
                    Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            text: 'An Error Occured Reload this page and try again',
                            showConfirmButton: false,
                            timer: 4500,
                            background: "#0e1726",
                            color: "#b9bead",
                            toast: true,
                            
                        });

                },
            });

        });

        $('#close-popup').on('click', function(){
            $('.full-popup').hide(200);
            $('#funding-total').val('');
            $('#funding-amount').val('');

        });

        //trigger
        $('.wallet-trigger').on('click', function(){
            var action = $(this).data('action');
            if (action == 'fund') {
                $('#action-type').val('fund');
                $('#wallet-action-heading').html('Fund ');
            } else {
                $('#action-type').val('withdraw');
                $('#wallet-action-heading').html('Withdraw From ');
            }

            $('.full-popup').show(200);

        });
    </script>
@endsection