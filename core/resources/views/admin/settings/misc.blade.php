@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        MISC Settings
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

            {{--  setting pannel --}}

            @include('admin.includes.settings-panel')
            {{--  setting pannel ends --}}

            <div class="p-2 md:p-4">
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.misc-validate') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if (isAddonEnabled('p2ptransfer'))
                        <h4 class="text-[#ebedf2] font-medium capitalize mb-2 mt-4">Transfer Setting</h4>

                        <div class="w-full">
                            <div class="flex space-x-5">
                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                        <div class="w-full">
                                            <label class="font-medium" >Balance Transfer:</label>
                                            <div class="flex mt-1 items-center">
                                                <label for="balance_transfer" class="hidden-radio toggle @if(old('balance_transfer') ?? websiteInfo('balance_transfer') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                                <input type="hidden"  name="balance_transfer" id="balance_transfer" @if(old('balance_transfer') ?? websiteInfo('balance_transfer') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                            </div>
                                        </div>
                
                                        <span class="p-1 text-red-600">
                                            @error('balance_transfer') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                        <div class="w-full">
                                            <label class="font-medium" for="">Auto Approve Transfer:</label>
                                            <div class="flex mt-1 items-center">
                                                <label for="transfer_auto_approve" class="hidden-radio toggle @if(old('transfer_auto_approve') ?? websiteInfo('transfer_auto_approve') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                                <input type="hidden"  name="transfer_auto_approve" id="transfer_auto_approve" @if(old('transfer_auto_approve') ?? websiteInfo('transfer_auto_approve') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                            </div>
                                        </div>
                
                                        <span class="p-1 text-red-600">
                                            @error('transfer_auto_approve') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class="w-full">
                            <div class="flex space-x-5">
                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                                        <div class="w-full">
                                            <label class="font-medium" for="min_transfer">Minimum Transfer ({{ strtoupper(websiteInfo('general_currency')) }}):</label>                                        
                                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_transfer" id="min_transfer" value="{{ old('min_transfer') ?? websiteInfo('min_transfer') }}" required>
                                            <h6 class="text-xs text-blue-400">
                                                minimum amount users can transfer at a single instance
                                            </h6>
                                        </div>
                                        <span class="p-1 text-red-600">
                                            @error('min_transfer') {{ $message }} @enderror
                                        </span>
                                    </div>
                
                                </div>

                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                                        <div class="w-full">
                                            <label class="font-medium" for="max_transfer">Maximum Transfer ({{ strtoupper(websiteInfo('general_currency')) }}):</label>                                        
                                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_transfer" id="max_transfer" value="{{ old('max_transfer') ?? websiteInfo('max_transfer') }}" required>
                                            <h6 class="text-xs text-blue-400">
                                                maximum amount users can transfer at a single instance
                                            </h6>
                                        </div>
                                        <span class="p-1 text-red-600">
                                            @error('max_transfer') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class="w-full">
                            <div class="flex space-x-5">
                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                                        <div class="w-full">
                                            <label class="font-medium" for="transfer_fee">Transfer Fee:</label>
                                            <div class="flex space-x-5">
                                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="transfer_fee" step="any" value="{{ old('transfer_fee') ?? websiteInfo('transfer_fee') }}" required>
                                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="transfer_fee_type" id="transfer_fee_type" required>
                                                    <option value="percent" @if (old('transfer_fee_type') ?? websiteInfo('transfer_fee_type')=='percent' ) selected @endif>%</option>
                                                    <option value="fixed" @if ( old('transfer_fee_type') ?? websiteInfo('transfer_fee_type')=='fixed' ) selected @endif>{{ websiteInfo('general_currency') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <span class="p-1 text-red-600">
                                            @error('transfer_fee') {{ $message }} @enderror @error('transfer_fee_type') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>    
                        </div>

                    @endif

                    @if (isAddonEnabled('cryptoloan'))
                        <hr class="w-full border-b border-dotted border-gray-600 border my-5">
                        <h4 class="text-[#ebedf2] font-medium capitalize mb-2 mt-4">Loan Setting</h4>
                        
                        <div class="w-full">
                            <div class="flex space-x-5">
                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                        <div class="w-full">
                                            <label class="font-medium" for="">Loan:</label>
                                            <div class="flex mt-1 items-center">
                                                <label for="loan" class="hidden-radio toggle @if(old('loan') ?? websiteInfo('loan') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                                <input type="hidden"  name="loan" id="loan" @if(old('loan') ?? websiteInfo('loan') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                            </div>
                                        </div>
                
                                        <span class="p-1 text-red-600">
                                            @error('loan') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="w-1/2 pt-2">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                        <div class="w-full">
                                            <label class="font-medium" for="">Multiple Loan:</label>
                                            <div class="flex mt-1 items-center">
                                                <label for="multiple_loans" class="hidden-radio toggle @if(old('multiple_loans') ?? websiteInfo('multiple_loans') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                                <input type="hidden"  name="multiple_loans" id="multiple_loans" @if(old('multiple_loans') ?? websiteInfo('multiple_loans') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                            </div>
                                        </div>
                
                                        <span class="p-1 text-red-600">
                                            @error('multiple_loans') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>    
                        </div>

                    @endif

                    <hr class="w-full border-b border-dotted border-gray-600 border my-5">

                    <h4 class="text-[#ebedf2] font-medium capitalize mb-2 mt-4">Withdrawal Setting</h4>
                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full">
                                        <label class="font-medium" for="min_withdrawal">Minimum Withdrawal ({{ strtoupper(websiteInfo('general_currency')) }}):</label>                                        
                                        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_withdrawal" id="min_withdrawal" value="{{ old('min_withdrawal') ?? websiteInfo('min_withdrawal') }}" required>
                                        <h6 class="text-xs text-blue-400">
                                            minimum amount users can withdraw at a single instance
                                        </h6>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('min_withdrawal') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full">
                                        <label class="font-medium" for="max_withdrawal">Maximum Withdrawal ({{ strtoupper(websiteInfo('general_currency')) }}):</label>                                        
                                        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_withdrawal" id="max_withdrawal" value="{{ old('max_withdrawal') ?? websiteInfo('max_withdrawal') }}" required>
                                        <h6 class="text-xs text-blue-400">
                                            maximum amount users can withdraw at a single instance
                                        </h6>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('max_withdrawal') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w-1/2 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full">
                                        <label class="font-medium" for="withdrawal_fee">Withdrawal Fee:</label>
                                        <div class="flex space-x-5">
                                            <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="withdrawal_fee" step="any" value="{{ old('withdrawal_fee') ?? websiteInfo('withdrawal_fee') }}" required>
                                            <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="withdrawal_fee_type" id="withdrawal_fee_type" required>
                                                <option value="percent" @if (old('withdrawal_fee_type') ?? websiteInfo('withdrawal_fee_type')=='percent' ) selected @endif>%</option>
                                                <option value="fixed" @if ( old('withdrawal_fee_type') ?? websiteInfo('withdrawal_fee_type')=='fixed' ) selected @endif>{{ websiteInfo('general_currency') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('withdrawal_fee') {{ $message }} @enderror @error('withdrawal_fee_type') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>
                        </div>    
                    </div>

                    <hr class="w-full border-b border-dotted border-gray-600 border my-5">
                    <h4 class="text-[#ebedf2] font-medium capitalize mb-2 mt-4">Other Settings</h4>
                    
                    <div class="w-full">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Blog Aggregator:</label>
                                        <h6 class="text-xs text-blue-400">
                                            automatically fetch and publish finance related blog posts using the Cred Aggregator API
                                        </h6>
                                        <div class="flex mt-1 items-center">
                                            <label for="auto_blog" class="hidden-radio toggle @if(old('auto_blog') ?? websiteInfo('auto_blog') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="auto_blog" id="auto_blog" @if(old('auto_blog') ?? websiteInfo('auto_blog') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('auto_blog') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                    <div class="w-full">
                                        <label class="font-medium" for="">Auto Delete Expired Investment:</label>
                                        <h6 class="text-xs text-blue-400">
                                            automatically delete investments when they expire
                                        </h6>
                                        <div class="flex mt-1 items-center">
                                            <label for="auto_delete_expired_investments" class="hidden-radio toggle @if(old('aauto_delete_expired_investments') ?? websiteInfo('auto_delete_expired_investments') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                            <input type="hidden"  name="auto_delete_expired_investments" id="auto_delete_expired_investments" @if(old('auto_delete_expired_investments') ?? websiteInfo('auto_delete_expired_investments') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                                        </div>
                                    </div>
            
                                    <span class="p-1 text-red-600">
                                        @error('auto_delete_expired_investments') {{ $message }} @enderror
                                    </span>
                                </div>
                            </div>

                            
                        </div>    
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Changes
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