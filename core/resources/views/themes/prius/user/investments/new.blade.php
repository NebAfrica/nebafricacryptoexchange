<?php

// Manages the spacing for cards when looped on medium and small screen devices upwards
function manageMdCardLayouts($LoopIterator, $screenAlias)
{
    if ($screenAlias == 1)
        return ($LoopIterator == 1) ? "" : "mt-[26rem]";

    return ($LoopIterator == 1 || $LoopIterator == 2) ? "" : "mt-[26rem]";
}

?>
@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-full  rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('New Investment Plan') }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('back', 'l') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')

@if (session()->has('plan_id'))
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-2/3 rounded-sm bg-[#0e1726] text-[#d3d6df] p-3 md:p-10">

            <form action="{{ route('user.investments.new-validate') }}" method="POST">
                @csrf

                @if ($plan->amount_type == 'range')
                {{-- details confirmation --}}
                <div class="w-full my-6 md:my-10 flex justify-center">
                    <div class="space-y-2">
                        <div class="flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#dfb05b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-xs md:text-sm font-medium text-center">
                            <p>{{ ct('You have selected the') }} <b>{{ $plan->name }}</b>. {{ ct('Minimum and maximum investment amount are') }} <b>{{ formatAmount($plan->min_amount) }}</b> {{ ct('and') }} <b>{{ formatAmount($plan->max_amount) }}</b> {{ ct('respectively') }}.</p>
                        </div>
                    </div>
                </div>
                <div class="relative w-full">
                    <span class="cred-hyip-theme1-input-icon h-8 w-8 font-semibold">
                        {{ websiteInfo('general_currency') }}
                    </span>
                    <input type="number" step="any" name="amount" id="amount" min="{{ $plan->min_amount }}" max="{{ $plan->max_amount }}" required class="cred-hyip-theme1-text-input" placeholder="{{ ct('enter amount') }}">
                </div>

                @else
                {{-- details confirmation --}}
                <div class="w-full my-6 md:my-10 flex justify-center">
                    <div class="space-y-2">
                        <div class="flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#dfb05b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-xs md:text-sm font-medium text-center">
                            <p>{{ ct('You have selected the') }} <b>{{ $plan->name }}</b>. This plan has a fixed price of <b>{{ formatAmount($plan->min_amount) }}</b>.</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- preview confirm/cancel confirm button --}}
                <div class="w-full flex justify-start items-center space-x-5 my-5">
                    {{-- confirm --}}
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Confirm
                        </button>
                    </div>

                    {{-- cancel --}}
                    <div>
                        <a href="{{ route('user.investments.cancel') }}" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-600 hover:bg-red-400 rounded-md">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@else

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="h-full w-11/12 md:w-full  rounded-sm bg-[#0e1726] px-5 pt-2 pb-5">
            <div class="w-full h-full flex justify-center">

                {{-- FOR SMALL AND MEDIUM SCREENS ONLY --}}
                <form action="{{ route('user.investments.new-validate') }}" method="POST" class="w-full grid lg:hidden grid-cols-1 mt-12">
                    @csrf
                    @foreach ($plans as $plan)
                    {{-- multi layer style card --}}
                    <div class="w-full lg:w-60 xl:w-72 relative bg-transparent {{ manageMdCardLayouts($loop->iteration, 1) }}">
                        {{-- First style layer -> card header --}}
                        <div class="absolute w-full h-44 bg-gradient-to-r from-blue-800 via-blue-400 to-green-300 rounded-2xl z-10">
                            <div class="flex justify-between items-center pr-2">
                                <div class="bg-[#060818] text-white font-bold h-10 w-10 rounded-full flex justify-center items-center opacity-70">{{ $loop->iteration }}</div>
                                <div class="bg-[#060818] text-white flex justify-center space-x-1 items-center py-[0.15rem] px-3 rounded-lg opacity-70">
                                    <div class="text-xs md:text-sm font-medium">{{ $plan->label }}</div>
                                </div>
                            </div>

                            <div class="w-full flex justify-center">
                                <div class="text-xl md:text-2xl font-extrabold text-gray-200">
                                    {{ $plan->name }}
                                </div>
                            </div>
                        </div>
                        {{-- Second style layer -> plan amounts --}}
                        <div class="w-full flex justify-center">
                            <div class="absolute w-10/12 h-20 bg-gray-900 rounded-md z-10 top-32">
                                <div class="w-full h-full flex justify-center items-center px-3 md:px-5 text-gray-100 text-sm md:text-base font-semibold">
                                    @if ($plan->amount_type == 'fixed')
                                    <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                    @else
                                    <div class="flex justify-between space-x-1">
                                        <div>
                                            <h2>{{ formatAmount($plan->min_amount) }}</h2>
                                        </div>
                                        <div>-</div>
                                        <div>
                                            <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Third style layer -> card body --}}
                        <div class="absolute w-full pb-7 md:pb-10 bg-gray-800 top-32 rounded-md z-0">
                            <div class="w-full flex justify-center mt-24 text-xs md:text-sm text-[#ebedf2]">
                                <div class="w-2/3">
                                    <table class="w-full">
                                        @if ($plan->return_type == 'fixed')
                                        <tr>
                                            <td class="font-medium">{{ ct('ROI', 'u') }}:</td>
                                            <td>{{ formatAmount($plan->return) }} %</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Duration') }}:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="font-medium">{{ ct('ROI', 'u') }}:</td>
                                            <td>{{ $plan->return }} %</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Duration') }}:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="font-medium">{{ ct('Profit Return') }}:</td>
                                            <td>{{ $plan->return_interval }}</td>
                                        </tr>
                                    </table>

                                    <div class="w-full flex mt-10 justify-center">                                        
                                        <label for="plan{{ $plan->id }}" type="submit" class="w-2/3 md:w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            {{ ct('Select') }}
                                        </label>
                                        <input type="radio" name="plan_id" id="plan{{ $plan->id }}" value="{{ $plan->id }}" onclick="this.form.submit()" class="hidden" required onclick="this.form.submit()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End multilayer card --}}
                    @endforeach

                    <div class="w-full mt-[25rem]">
                        <button type="button" class="hidden">
                            {{ ct('Next') }}
                        </button>
                    </div>
                </form>




                {{-- FOR LARGE SCREENS UPWARDS ONLY ---------------------------------------------------}}
                <form action="{{ route('user.investments.new-validate') }}" method="POST" class="hidden w-full lg:grid grid-cols-2 gap-3 mt-12 place-items-center">
                    @csrf
                    @foreach ($plans as $plan)
                    {{-- multi layer style card --}}
                    <div class="w-full lg:w-60 xl:w-72 relative bg-transparent {{ manageMdCardLayouts($loop->iteration, 2) }}">
                        {{-- First style layer -> card header --}}
                        <div class="absolute w-full h-44 bg-gradient-to-r from-blue-800 via-blue-400 to-green-300 rounded-2xl z-10">
                            <div class="flex justify-between items-center pr-2">
                                <div class="bg-[#060818] text-white font-bold h-10 w-10 rounded-full flex justify-center items-center opacity-70">{{ $loop->iteration }}</div>
                                <div class="bg-[#060818] text-white flex justify-center space-x-1 items-center py-[0.15rem] px-3 rounded-lg opacity-70">
                                    <div class="text-xs md:text-sm font-medium">{{ $plan->label }}</div>
                                </div>
                            </div>

                            <div class="w-full flex justify-center">
                                <div class="text-xl md:text-2xl font-extrabold text-gray-200">
                                    {{ $plan->name }}
                                </div>
                            </div>
                        </div>
                        {{-- Second style layer -> plan amount --}}
                        <div class="w-full flex justify-center">
                            <div class="absolute w-10/12 h-20 bg-gray-900 rounded-md z-10 top-32">
                                <div class="w-full h-full flex justify-center items-center px-3 md:px-5 text-gray-100 text-sm md:text-base font-semibold">
                                    @if ($plan->amount_type == 'fixed')
                                    <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                    @else
                                    <div class="flex justify-between space-x-1">
                                        <div>
                                            <h2>{{ formatAmount($plan->min_amount) }}</h2>
                                        </div>
                                        <div>-</div>
                                        <div>
                                            <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Third style layer -> card body --}}
                        <div class="absolute w-full pb-7 md:pb-10 bg-gray-800 top-32 rounded-md z-0">
                            <div class="w-full flex justify-center mt-24 text-xs md:text-sm text-[#ebedf2]">
                                <div class="w-3/4">
                                    <table class="w-full">
                                        @if ($plan->return_type == 'fixed')
                                        <tr>
                                            <td class="font-medium">{{ ct('ROI', 'u') }}:</td>
                                            <td>{{ formatAmount($plan->return) }} %</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Duration') }}:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="font-medium">{{ ct('ROI', 'u') }}:</td>
                                            <td>{{ $plan->return }} %</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Duration') }}:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="font-medium">{{ ct('Profit Return') }}:</td>
                                            <td>{{ $plan->return_interval }}</td>
                                        </tr>
                                    </table>

                                    <div class="w-full flex mt-10 justify-center">
                                        <label for="plan{{ $plan->id }}" type="submit" class="w-2/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-blue-500 hover:bg-gray-700 rounded-md">
                                            {{ ct('Next') }}
                                        </label>
                                        <input type="radio" name="plan_id" id="plan{{ $plan->id }}" value="{{ $plan->id }}" class="hidden" required onclick="this.form.submit()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End multilayer card --}}
                    @endforeach

                    <div class="w-full mt-[28rem] col-span-2">
                        <button type="button" class="hidden">
                            {{ ct('Next') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection