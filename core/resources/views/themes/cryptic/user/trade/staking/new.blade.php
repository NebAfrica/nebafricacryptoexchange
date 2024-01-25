<div class="staking-form hidden">
    <div class="w-full py-5" id="content">    
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4 box-shadow">
                <div class="w-full flex justify-between mb-2">
                    <div>
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            {{ ct('New Staking') }}
                         </h2>
                    </div>
                    <div>
                        <a role="button" class="stake-button text-red-600" data-type="close">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
                 <hr class="w-full border-b border-dotted border-gray-600 border mb-4"> 
                 <div class="p-2 md:p-4">
                    <form class="mt-2 p-2 md:p-4" action="{{ route('user.trading.coin-stakings.stake') }}"  method="post">
    
                        @csrf
                        <div class="w-full md:flex md:justify-space-around">
                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="coin">Coin:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="coin">Bitcoin</span>
                                        </h6>                                        
                                    </div>

                                </div>
                            </div>
    
                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="symbol">Symbol:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="symbol">BTC</span>
                                        </h6>
                                    </div>                                
                                </div>
                            </div>
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="price">Price ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                                        <h6 class="text-xs text-blue-400">
                                           <span id="price">19999</span>
                                        </h6>                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
    
                        <div class="w-full md:flex md:justify-space-around">
                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="coin">Staking Period:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="duration">30</span> Days
                                        </h6>
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="total">Total:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="total">9309</span>
                                        </h6>                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="price">Staked: </label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="staked">3000</span>
                                        </h6>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
    
                        <div class="w-full md:flex md:justify-space-around">
                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="apr">Apr:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="apr">3000</span>%
                                        </h6>
                                    </div>                                    
                                </div>
                            </div>

                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="daily_return">Daily Return:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="daily_return">1.5</span>
                                        </h6>                                    
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="min_stake">Minimum Stake:</label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="min_stake">999</span>
                                        </h6>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        
    
                        <div class="w-full md:flex md:justify-space-around">
                            
    
                            
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="max_stake">Maximum Stake </label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="max_stake">99</span>
                                        </h6>
                                        
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                        <div class="relative w-full">
                            <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold" id="amount_unit">
                                BTC
                            </span>
                            <input type="hidden" name="coin_id" id="coin_id">
                            <input id="amount" name="amount" type="number" step='any' min="" max="" value="{{ old('amount') }}" required class="cred-hyip-theme1-text-input" placeholder="Enter amount to stake">
                        </div>
                        <div class="relative w-full">
                            <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Stake
                            </button>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
    
</div>

<style>
    .staking-form {
        width: 40vw;
        
        z-index: 10000;
        top: 0;
        right: 0;
        position: fixed;
        
        
    }

    @media only screen and (max-width: 700px) {
        .staking-form {
            width: 90vw;
        }
    }

    .box-shadow {
        box-shadow: -7px 3px 3px -3px rgb(100 130 181 / 74%);
        -webkit-box-shadow: -7px 3px 3px -3px rgb(100 130 181 / 74%);
        -moz-box-shadow: -7px 3px 3px -3px rgb(100 130 181 / 74%);
    }

</style>