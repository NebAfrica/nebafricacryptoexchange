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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-2/3 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">

            {{--  disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
<<<<<<< HEAD
                        <b class="font-medium">Disclaimer: </b> You are about to initiate a transfer request to another {{ websiteInfo('website_name') }} user account. Make sure to confirm the name displayed in the preview page matches the name of the person you are intended to to send this money to. <br>
                        The minimum and maximum amount you can transfer at a single instance is <b>{{ formatAmount(websiteInfo('min_transfer')) }}</b> and <b>{{ formatAmount(websiteInfo('max_transfer')) }}</b> respectively.
=======
                        <b class="font-medium">Disclaimer: </b> You are about to mint NFT. Make sure to have enough funds to cover your gas fees. Accepted NFT Formats are .jpg, .jpeg, .png, .gif, .mp3, .mp4. Max file size is 100MB.
>>>>>>> df5ef8bee3c658de8492c7af8407ce1937a517a7
                    </div>
                </div>
            </div>

            {{--  user balance section --}}
            <div class="w-full my-6 md:my-10 flex justify-center">
                <div>
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
<<<<<<< HEAD
                <form action="{{ route('user.transfer.new-validate') }}" method="POST">
                    @csrf

                    <div class="space-y-5">
                        {{--  amount input --}}
                        <div class="relative w-full">
                            <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                                {{ websiteInfo('general_currency') }}
                            </span>
                            <input name="amount" type="number" step='any' min="{{ websiteInfo('min_transfer') }}" max="{{ websiteInfo('max_transfer') }}" value="{{ old('amount') }}" required class="cred-hyip-theme1-text-input" placeholder="Enter amount to transfer">
                        </div>

                        {{--  recepients account ID input --}}
                        <div class="relative w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="cred-hyip-theme1-input-icon h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                            <input type="text" name="receiver_account_id" value="{{ old('receiver_account_id') }}" required class="cred-hyip-theme1-text-input" placeholder="Enter receipient's Account ID">
                        </div>

                        {{--  transfer narrration text area --}}
                        <div>
                            <textarea name="narration" id="narration" cols="30" rows="8" required placeholder="Enter transfer narration" class="cred-hyip-theme1-textarea"></textarea>
                        </div>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Preview
=======
                <form action="{{ route('user.nft.mint-validate') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-5">
                        <label style="float:left !important;" for="name" class="w-full text-xs lg:text-sm text-left mb-1">Name Of NFT: <span class="text-xs text-red-500">@error('name') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="name" type="text"  placeholder="Nft Name" name="name" required value="{{ old('name') }}">

                    </div>

                    <div class="mb-3">
                        <label style="float:left !important;" for="nft_file" class="w-full text-xs lg:text-sm text-left mb-1">Select NFT: <span class="text-xs text-red-500">@error('nft_file') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="nft_file" type="file" name="nft_file" required>
                    </div>

                    <div class="w-full my-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Mint Now
>>>>>>> df5ef8bee3c658de8492c7af8407ce1937a517a7
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<<<<<<< HEAD




=======
@section('script')
    <script>
        // attachment input processor
        $(".attachment-input").change(function() {
            // first empty whatever is innit
            $(this).parent().siblings(".attachment-list").html("")

            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                if (names.length < 1)
                    names.push($(this).get(0).files[i].name);
                else {
                    names.push(", " + $(this).get(0).files[i].name);

                }
            }

            $(this).parent().siblings(".attachment-list").append(names)
        })
    </script>
@endsection
>>>>>>> df5ef8bee3c658de8492c7af8407ce1937a517a7
