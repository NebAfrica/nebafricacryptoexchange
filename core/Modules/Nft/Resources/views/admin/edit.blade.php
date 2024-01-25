@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ $page_title }}
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="flex justify-end">
                <div>
                    <a href="{{ route('admin.nft.index') }}" title="Add New FAQ" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>View All</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-4">

            <div class="p-2 md:p-4">
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.nft.edit-validate') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="id" value="{{ $nft->id }}">

                    <div class="mb-5 text-[#d1d5db]">
                        <label style="float:left !important;" for="name" class="w-full text-xs lg:text-sm text-left mb-1">Name: <span class="text-xs text-red-500">@error('name') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="name" type="text"  placeholder="Nft Name" name="name" required value="{{ old('name') ?? $nft->name }}">

                    </div>

                    <div class="mb-5 text-[#d1d5db]">
                        <label style="float:left !important;" for="price" class="w-full text-xs lg:text-sm text-left mb-1">Price: <span class="text-xs text-red-500">@error('price') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="price" type="number" step="any"  placeholder="Price" name="price" required value="{{ old('price') ?? $nft->price }}">

                    </div>

                    <div class="mb-3 text-[#d1d5db]">
                        <label style="float:left !important;" for="blockchain" class="w-full text-xs lg:text-sm text-left mb-1">Blockchain: </label>
                        <select class="cred-hyip-theme1-text-input pl-4" id="blockchain"  name="blockchain" required>
                            <option value="" disabled selected>Select Blockchain</option>
                            @foreach($fees as $fee) 
                                <option value="{{ $fee->blockchain }}" @if(old('blockchain') ?? $nft->blockchain == $fee->blockchain) selected @endif>  {{ strtoupper($fee->blockchain)     }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5 text-[#d1d5db]">
                        <label style="float:left !important;" for="contract_address" class="w-full text-xs lg:text-sm text-left mb-1">Contract Address: <span class="text-xs text-red-500">@error('contract_address') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="contract_address" type="text"  placeholder="contract address" name="contract_address" required value="{{ old('contract_address') ?? $nft->contract_address }}">

                    </div>

                    <div class="mb-5 text-[#d1d5db]">
                        <label style="float:left !important;" for="hash_id" class="w-full text-xs lg:text-sm text-left mb-1">Hash ID: <span class="text-xs text-red-500">@error('hash_id') {{ $message }} @enderror</span></label>
                        <input class="cred-hyip-theme1-text-input pl-4" id="hash_id" type="text"  placeholder="hash id" name="hash_id" required value="{{ old('hash_id') ?? $nft->hash_id }}">

                    </div>

                    <div class="mb-3 text-[#d1d5db]">
                        <label style="float:left !important;" for="status" class="w-full text-xs lg:text-sm text-left mb-1">Status: </label>
                        <select class="cred-hyip-theme1-text-input pl-4" id="status"  name="status" required>
                            <option value="active" @if(old('status') ?? $nft->status == 'active') selected @endif> Active </option>
                            <option value="pending" @if(old('status') ?? $nft->status == 'pending') selected @endif> Pending </option>
                        </select>
                    </div>

                    

                    


                    
                    <div class="w-full">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
@endsection

@section('script')

@endsection