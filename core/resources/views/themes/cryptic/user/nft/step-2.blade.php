@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Mint NFT
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
{{-- popup --}}
<div class="loading-wrapper hidden">
    <div class="loading">
        <span>Estimating NFT Worth</span>
    </div>
</div>
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-2/3 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">

            

            {{--  user balance section --}}
            <div class="w-full p-6 md:p-10 flex justify-center" id="balance">
                <div class="w-full  rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-xl md:text-2xl font-bold text-center">
                        <h1>{{ formatAmount(user('account_bal')) }}</h1>
                    </div>
                    <div class="text-xs md:text-sm text-center">
                        <h6>Current Balance</h6>
                    </div>
                </div>
            </div>

            

            {{--  transfer form --}}
            <div class="p-2 md:p-4">
                <form action="{{ route('user.nft.step-2-validate') }}" method="POST" enctype="multipart/form-data" class="hidden" id="mintingForm">
                    @csrf

                    <div class="mb-5">
                        <label style="float:left !important;" for="name" class="w-full text-xs lg:text-sm text-left mb-1">Name Of NFT: <span class="text-xs text-red-500">@error('name') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="name" type="text"  placeholder="Nft Name" name="name" required value="{{ $nft['name'] }}" disabled>

                    </div>

                    <div class="">
                        <label style="float:left !important;" for="price" class="w-full text-xs lg:text-sm text-left mb-1">Price: ({{ websiteInfo('general_currency') }}): <span class="text-xs text-red-500">@error('price') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="price" type="number" step="any" name="price" required value="{{ $nft['price'] }}"> 
                    </div>

                    <div class="mb-3 text-xs text-green-500">
                        Your NFT Art value is estimated at {{ websiteInfo('general_currency') }} {{ $nft['price'] }}
                    </div>

                    <div class="mb-3">
                        <label style="float:left !important;" for="blockchain" class="w-full text-xs lg:text-sm text-left mb-1">Blockchain: </label>
                        <select class="cred-hyip-theme1-text-input pl-4" id="blockchain"  name="blockchain" required>
                            <option value="" disabled selected>Select Blockchain</option>
                            @foreach($fees as $fee) 
                                <option value="{{ $fee->blockchain }}" data-fee="{{ $fee->fee }}">  {{ strtoupper($fee->blockchain)     }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full my-5">
                        <button id="proceedButton" type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Proceed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .loading-wrapper {
        background: rgb(14, 23, 38, 0.9);
        position: fixed;
        min-height: 100vh;
        min-width: 100vw;
        z-index: 1000000;
        top: 0;
        left: 0;
    }
    .loading {
        font-family: "Arial Black", "Arial Bold", Gadget, sans-serif;
        text-transform:uppercase;
        
        width:300px;
        text-align:center;
        line-height:50px;
        
        position:absolute;
        left:0;right:0;top:50%;
        margin:auto;
        transform:translateY(-50%);
    }

    .loading span {
        position:relative;
        z-index:999;
        color:#fff;
    }
    .loading:before {
        content:'';
        background:#61bdb6;
        width:300px;
        height:36px;
        display:block;
        position:absolute;
        top:0;left:0;right:0;bottom:0;
        margin:auto;
        
        animation:2s loadingBefore infinite ease-in-out;
    }

    @keyframes loadingBefore {
        0%   {transform:translateX(-14px);}
        50%  {transform:translateX(14px);}
        100% {transform:translateX(-14px);}
        }


    .loading:after {
        content:'';
        background:#ff3600;
        width:14px;
        height:60px;
        display:block;
        position:absolute;
        top:0;left:0;right:0;bottom:0;
        margin:auto;
        opacity:.5;
        
        animation:2s loadingAfter infinite ease-in-out;
    }

    @keyframes loadingAfter {
        0%   {transform:translateX(-50px);}
        50%  {transform:translateX(50px);}
        100% {transform:translateX(-50px);}
    }
</style>
@endsection

@section('script')
    <script>
        // fire calculating animation
        $(document).ready(function(){
            $('.loading-wrapper').removeClass('hidden');
            setTimeout(function() { 
                $('.loading-wrapper').addClass('hidden');
                Swal.fire({
                    title: "NFT Worth Calculated",
                    icon: 'success',
                    text: "Your nft '{{ $nft['name'] }}' is worth {{ websiteInfo('general_currency') . $nft['price'] }}",
                    showConfirmButton: true,
                    
                    background: "#0e1726",
                    color: "#b9bead",                    

                }).then((result) => {
                    if (result.isConfirmed) {                            
                        $('#mintingForm').removeClass('hidden');
                    }
                });
            }, 4500);
        });
        

        //calculate the fees
        $('#proceedButton').on('click', function(e){
            e.preventDefault();
            var blockchain = $('#blockchain').find('option:selected');
            var fee = blockchain.data('fee') * 1;
            var amount = $('#price').val();
            var total_fee = fee / 100 * amount;
            var balance = "{{ user('account_bal') }}" * 1;
            
            if (total_fee > balance) {
                Swal.fire({
                    title: "Insufficient balance",
                    icon: 'error',
                    text: "You do not have sufficient balance to cover your gas fees",
                    showConfirmButton: true,
                    background: "#0e1726",
                    color: "#b9bead",                    

                });
                
            } else {
                Swal.fire({
                    title: "Gas Fees",
                    icon: 'success',
                    text: "Your gas fee is {{ websiteInfo('general_currency') }}" + total_fee + ". Your account will be debited",
                    showConfirmButton: true,
                    background: "#0e1726",
                    color: "#b9bead",                    
                    showCancelButton: true,
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {                            
                        $('#mintingForm').submit();
                    }
                });
            }


            
            
        });
    </script>
@endsection
