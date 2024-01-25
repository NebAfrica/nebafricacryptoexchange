<?php
    use Modules\Nft\Entities\NftGasFee;
    function getTheMime($name) 
    {
       
        $extension = explode('.', $name);
        $extension = $extension[1];
        return $extension;

    }

    function getBlockChainFee($blockchain)
    {
        $gas_fee = NftGasFee::where('blockchain', $blockchain)->first();
        return $gas_fee->fee ?? 0;
    }
?>

@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        NFT Market Place
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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4 text-[#d3d6df]">
            <div class="flex justify-end">
                
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-4">
            {{--  transfer form --}}
            <div class="p-2 md:p-4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach($nfts as $nft) 
                        <div class="rounded-lg bg-[#131d2c] p-1 hover:bg-[#c3c4ef] hover:text-[#324152]">
                            <div>
                                
                                @if (getTheMime($nft->file) == 'png' || getTheMime($nft->file) == 'jpg' || getTheMime($nft->file) == 'jpeg' || getTheMime($nft->file) == 'gif')
                                    <img src="{{ route('file', ['nfts', $nft->file]) }}" alt="{{ $nft->name }}" class="w-full h-44">
                                @elseif (getTheMime($nft->file) == 'mp4')
                                    <video src="{{ route('file', ['nfts', $nft->file]) }}" controls playsinline class="w-full h-44"></video>
                                @else 
                                    <audio src="{{ route('file', ['nfts', $nft->file]) }}" controls playsinline class="w-full h-44"></audio>
                                @endif
                            </div>
                            <div class="p-2 break-all">
                                <h3>{{ $nft->name }}</h3>
                                <p class="flex items-center text-xs mt-3">
                                    <img src="{{ route('file', ['profile', adminUser($nft->user_id, 'profile_picture')]) }}" class="w-10 h-10" alt="">
                                    <span>{{ '@' . adminUser($nft->user_id, 'account_id') }}</span>
                                    <span>
                                        <svg class="w-5 h-5 text-blue-500" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.5213 2.62368C11.3147 1.75255 12.6853 1.75255 13.4787 2.62368L14.4989 3.74391C14.8998 4.18418 15.4761 4.42288 16.071 4.39508L17.5845 4.32435C18.7614 4.26934 19.7307 5.23857 19.6757 6.41554L19.6049 7.92905C19.5771 8.52388 19.8158 9.10016 20.2561 9.50111L21.3763 10.5213C22.2475 11.3147 22.2475 12.6853 21.3763 13.4787L20.2561 14.4989C19.8158 14.8998 19.5771 15.4761 19.6049 16.071L19.6757 17.5845C19.7307 18.7614 18.7614 19.7307 17.5845 19.6757L16.071 19.6049C15.4761 19.5771 14.8998 19.8158 14.4989 20.2561L13.4787 21.3763C12.6853 22.2475 11.3147 22.2475 10.5213 21.3763L9.50111 20.2561C9.10016 19.8158 8.52388 19.5771 7.92905 19.6049L6.41553 19.6757C5.23857 19.7307 4.26934 18.7614 4.32435 17.5845L4.39508 16.071C4.42288 15.4761 4.18418 14.8998 3.74391 14.4989L2.62368 13.4787C1.75255 12.6853 1.75255 11.3147 2.62368 10.5213L3.74391 9.50111C4.18418 9.10016 4.42288 8.52388 4.39508 7.92905L4.32435 6.41553C4.26934 5.23857 5.23857 4.26934 6.41554 4.32435L7.92905 4.39508C8.52388 4.42288 9.10016 4.18418 9.50111 3.74391L10.5213 2.62368Z" stroke="currentColor" stroke-width="1.5"/> <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                                    </span>
                                </p>

                                <p>
                                    <span>Price:</span>
                                    <?php
                                        if ($nft->blockchain == 'trc20') {
                                            $mc = 'usdt';
                                        } else  {
                                            $mc = $nft->blockchain;
                                        }
                                    ?>
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-low-fill" viewBox="0 0 16 16"> <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8.5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 11a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm5-5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm-11 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9.743-4.036a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm-7.779 7.779a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm7.072 0a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707zM3.757 4.464a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707z"/> </svg>
                                        {{ formatAmount($nft->price) }} 
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-low-fill" viewBox="0 0 16 16"> <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8.5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 11a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm5-5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm-11 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9.743-4.036a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm-7.779 7.779a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm7.072 0a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707zM3.757 4.464a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707z"/> </svg>
                                        {{ currencyConverter(websiteInfo('general_currency'), $mc, $nft->price)['amount'] }}{{ strtoupper($nft->blockchain) }}
                                    </span>
                                </p>
                                <p class="flex">
                                    <span>Hash ID: {{ $nft->hash_id ?? 'nill' }}</span>
                                </p>
                                <p class="flex">
                                    <span>Contract address: {{ $nft->contract_address ?? 'nill' }} </span>
                                </p>
                                <div class="w-full flex justify-between items-center mt-3">
                                    <div class="flex">
                                        <?php
                                            $a = 1;
                                            while ($a <= 5) {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg"  width="16" height="16" fill="currentColor" class="bi bi-star-fill w-3 h-3 text-orange-500" viewBox="0 0 16 16"> <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/> </svg>';
                                                $a++;
                                            }
                                        ?>
                                    </div>
                                    <div>
                                    
                                        <a href="{{ route('admin.nft.edit', ['id' => $nft->id]) }}"
                                            
                                            class="buyNFTButton w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            Edit 
                                        </a>
                                    
                                    </div>
                                    <div>
                                    
                                        <a role="button"
                                            data-id="{{ $nft->id }}"
                                            data-title="{{ $nft->name }}"
                                            class="deleteButton w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-500 hover:bg-gray-700 rounded-md">
                                            Delete
                                        </a>
                                    
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                    @endforeach
                </div>

                <div class="rounded  p-1 mt-3">
                    {{ $nfts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.nft.delete') }}" method="post" id="deleteForm">
    @csrf
    <input type="hidden" name="id" id="id" value="">
</form>
@endsection

@section('script')
    <script>
        $(".deleteButton").on("click", function () {
            var id = $(this).data("id");
            var title = $(this).data('title');
            jQuery("#id").val(id); //
            Swal.fire({
                title: 'Delete ' + title + '!',
                text: "Do you really want to delete this " + title + "? This action can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm").submit();
                }
            });
        });
    </script>
@endsection
