@extends('admin.layout.app')




@section('content')

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
                                                
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <h2 class="text-sm lg:text-base font-semibold"> </h2>
                                            </div>
                                            <div class="mt-2">
                                                <h4 class="text-xs lg:text-sm font-medium"> </h4>
                                            </div>
                                        </div>
                                        <div class="lg:hidden opacity-50">
                                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-blue-600 text-white">
                                                
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

                                @if (1  > 0)
                                    <div class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            
                                        </div>
                                        <div class="flex">
                                            @if ( 'credit' == 'credit')
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
                                            <span></span>
                                        </div>

                                        <div>
                                            
                                        </div>

                                        <div>
                                            
                                        </div>
                                    </div>
                                    

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
                             @if (1 > 0)

                             <div class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                <div>
                                   
                                    
                                </div>
                                <div>
                                    
                                </div>
                                <div>

                                </div>
                                <div class="inline-flex space-x-3 md:space-x-5">
                                    
                                    
                                </div>
                            </div>
                            
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
    
@endsection