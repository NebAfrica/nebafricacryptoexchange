@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Add New Investment Plan
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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-end">
                <div>
                    <a href="{{ route('admin.investment-plans.index') }}" title="View All Investment Plans" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>View All</span>
                    </a>


                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                <form action="{{ route('admin.investment-plans.new-validate') }}" method="POST">

                    @csrf

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="name">Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="name" id="name" value="{{ old('name') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="amount_type">Amount Type:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="amount_type" id="amount_type" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="range" @if (old('amount_type')=='range' ) selected @endif> Range</option>
                                    <option value="fixed" @if ( old('amount_type')=='fixed' ) selected @endif>Fixed</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('amount_type') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="min_amount">Min Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <h6 class="text-xs text-blue-400">
                                minimum amount of users can invest on this plan
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_amount" id="min_amount" value="{{ old('min_amount') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('min_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="max_amount">Max Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <h6 class="text-xs text-blue-400">
                                maximum amount users can invest on this plan, if this you selected 'FIXED' in Amount Type, this should be same as Min Amount
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_amount" id="max_amount" value="{{ old('max_amount') }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('max_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="return">Return (ROI):</label>
                            <div class="flex space-x-5">
                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="return" step="any" value="{{ old('return') }}" required>
                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="return_type" id="return_type" required>
                                    <option value="percent" @if (old('return_type')=='percent' ) selected @endif>%</option>
                                    <option value="fixed" @if ( old('return_type')=='fixed' ) selected @endif>{{ websiteInfo('general_currency') }}</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('return') {{ $message }} @enderror @error('return_type') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="duration">Duration:</label>
                            <div class="flex space-x-5">
                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="duration" step="any" value="{{ old('duration') }}" required>
                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="duration_type" id="duration_type" required>
                                    <option value="hour" @if (old('duration_type')=='hour' ) selected @endif>Hour(s)</option>
                                    <option value="day" @if (old('duration_type')=='day' ) selected @endif>Day(s)</option>
                                    <option value="week" @if (old('duration_type')=='week' ) selected @endif>Week(s)</option>
                                    <option value="month" @if (old('duration_type')=='month' ) selected @endif>Month(s)</option>
                                    <option value="year" @if (old('duration_type')=='year' ) selected @endif>Year(s)</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('duration') {{ $message }} @enderror @error('duration_type') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="return_interval">Return Interval:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="return_interval" id="return_interval" required>
                                    <option value="hourly" @if (old('duration_type')=='hourly' ) selected @endif>Hourly</option>
                                    <option value="daily" @if (old('duration_type')=='daily' ) selected @endif>Daily</option>
                                    <option value="weekly" @if (old('duration_type')=='weekly' ) selected @endif>Weekly</option>
                                    <option value="monthly" @if (old('duration_type')=='monthly' ) selected @endif>Monthly</option>
                                    <option value="yearly" @if (old('duration_type')=='yearly' ) selected @endif>Yearly</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('return_interval') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="label">Label:</label>
                            <h6 class="text-xs text-blue-400">
                                e.g: vip, popular, etc
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="label" id="label" value="{{ old('label') }}">
                        </div>
                        <span class="p-1 text-red-600">
                            @error('label') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="status">Status:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="status" id="status" required>
                                    <option value="active" @if (old('status')=='active' ) selected @endif>Active</option>
                                    <option value="inactive" @if (old('status')=='inactive' ) selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('status') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
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