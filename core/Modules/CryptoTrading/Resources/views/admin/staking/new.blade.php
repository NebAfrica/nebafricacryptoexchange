@extends('admin.layout.app')
@section('content')

<div class="w-full py-5" id="content">    
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
            <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                Add Staking Coin
             </h2>
             <hr class="w-full border-b border-dotted border-gray-600 border mb-4"> 
             <div class="p-2 md:p-4">
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.trading.staking-coins.new-validate') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="w-full md:flex md:justify-between">
                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="coin">Coin:</label>
                                    <h6 class="text-xs text-blue-400">
                                        e.g Bitcoin
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="coin" id="coin" value="{{ old('coin') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('coin') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="symbol">Symbol:</label>
                                    <h6 class="text-xs text-blue-400">
                                        e.g BTC
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="symbol" id="symbol" value="{{ old('symbol') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('symbol') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="price">Price ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                                    <h6 class="text-xs text-blue-400">
                                        price per coin staking
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="price" id="price" value="{{ old('price') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('price') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="w-full md:flex md:justify-between">
                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="coin">Staking Period:</label>
                                    <h6 class="text-xs text-blue-400">
                                        e.g 30 Days
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="duration" id="duration" value="{{ old('duration') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('duration') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="total">Total:</label>
                                    <h6 class="text-xs text-blue-400">
                                        total number of coins available for staking
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="total" id="total" value="{{ old('total') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('total') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="price">Staked </label>
                                    <h6 class="text-xs text-blue-400">
                                        total staked already
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="staked" id="staked" value="{{ old('staked') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('staked') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="w-full md:flex md:justify-between">
                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="apr">Apr:</label>
                                    
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="apr" id="apr" value="{{ old('apr') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('apr') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="total">Icon:</label>
                                    
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="file" name="icon" id="icon"  required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('icon') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="status">Status </label>                                    
                                    <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="status" id="status" required>
                                        <option value="status" @if (old('status')=='enabled' ) selected @endif>Enabled</option>
                                        <option value="status" @if ( old('status')=='disabled' ) selected @endif>Disabled</option>
                                    </select>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('status') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        
                    </div>

                    <div class="w-full md:flex md:justify-between">
                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="daily_return">Daily Return (%):</label>
                                    <h6 class="text-xs text-blue-400">
                                        percentage daily amount earned
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="daily_return" id="daily_return" value="{{ old('daily_return') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('daily_return') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 text-[#bfc9d4] text-xs md:text-sm ">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="min_stake">Minimum Stake:</label>
                                    <h6 class="text-xs text-blue-400">
                                        Minimum number of coins users can stake
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="min_stake" id="min_stake" value="{{ old('min_stake') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('min_stake') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="max_stake">Maximum Stake </label>
                                    <h6 class="text-xs text-blue-400">
                                        maximum amount users can stake
                                    </h6>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number"  name="max_stake" id="max_stake" value="{{ old('max_stake') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('max_stake') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="w-full md:w-1/3 my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Coin
                        </button>
                    </div>
                </form>

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