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
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('Select New Loan Plan') }}
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
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-4 md:p-10">
            @if ($qualified == 'yes')
            <div class="w-full h-full flex justify-center">

                {{--  FOR SMALL AND MEDIUM SCREENS ONLY --}}
                <form action="{{ route('user.loan.newnext') }}" method="POST" class="w-full grid lg:hidden grid-cols-1 mt-12">
                    @csrf
                    @foreach ($loan_plans as $plan)
                    {{--  multi layer style card --}}
                    <div class="w-full lg:w-60 xl:w-72 relative bg-transparent {{ manageMdCardLayouts($loop->iteration, 1) }}">
                        {{--  First style layer -> card header --}}
                        <div class="absolute w-full h-44 bg-gradient-to-r from-blue-800 via-blue-400 to-green-300 rounded-2xl z-10">
                            <div class="flex justify-between items-center pr-2">
                                <div class="bg-[#060818] text-white font-bold h-10 w-10 rounded-full flex justify-center items-center opacity-70">{{ $loop->iteration }}</div>
                            </div>

                            <div class="w-full flex justify-center">
                                <div class="text-xl md:text-2xl font-extrabold text-gray-200">
                                    {{ $plan->name }}
                                </div>
                            </div>
                        </div>
                        {{--  Second style layer -> plan amounts --}}
                        <div class="w-full flex justify-center">
                            <div class="absolute w-10/12 h-20 bg-gray-900 rounded-md z-10 top-32">
                                <div class="w-full h-full flex justify-center items-center px-3 md:px-5 text-gray-100 text-sm md:text-base font-medium">
                                    <div class="flex justify-between space-x-1">
                                        <div>
                                            <h2>{{ formatAmount($plan->min_amount) }}</h2>
                                        </div>
                                        <div>-</div>
                                        <div>
                                            <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Third style layer -> card body --}}
                        <div class="absolute w-full pb-7 md:pb-10 bg-gray-800 top-32 rounded-md z-0">
                            <div class="w-full flex justify-center mt-24 text-xs md:text-sm text-[#ebedf2]">
                                <div class="w-4/5">
                                    <table class="w-full">
                                        <tr>
                                            <td class="font-medium">{{ ct('Min Deposit To Qualify') }}:</td>
                                            <td>{{ formatAmount($plan->min_deposit) }}</td>
                                        </tr>
                                        @if ($plan->interest_type == 'fixed')
                                        <tr>
                                            <td class="font-medium">{{ ct('Interest') }}:</td>
                                            <td>{{ formatAmount($plan->interest) }}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="font-medium">{{ ct('Interest') }}:</td>
                                            <td>{{ $plan->interest }} %</td>
                                        </tr>
                                        @endif
                                    </table>

                                    <div class="w-full flex mt-10 justify-center">
                                        <label for="plan{{ $plan->id }}" type="submit" class="w-2/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-blue-500 hover:bg-gray-700 rounded-md">
                                            {{ ct('Next') }}
                                        </label>
                                        <input type="radio" name="loan_plan_id" id="plan{{ $plan->id }}" value="{{ $plan->id }}" class="hidden" required onclick="this.form.submit()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  End multilayer card --}}
                    @endforeach

                    <div class="w-full mt-[25rem]">
                        <button type="button" class="hidden">
                            {{ ct('Next') }}
                        </button>
                    </div>
                </form>



                {{--  FOR LARGE SCREENS UPWARDS ONLY ---------------------------------------------------}}
                <form action="{{ route('user.loan.newnext') }}" method="POST" class="hidden w-full lg:grid grid-cols-2 gap-3 mt-12 place-items-center">
                    @csrf
                    @foreach ($loan_plans as $plan)
                    {{--  multi layer style card --}}
                    <div class="w-full lg:w-60 xl:w-72 relative bg-transparent {{ manageMdCardLayouts($loop->iteration, 2) }}">
                        {{--  First style layer -> card header --}}
                        <div class="absolute w-full h-44 bg-gradient-to-r from-blue-800 via-blue-400 to-green-300 rounded-2xl z-10">
                            <div class="flex justify-between items-center pr-2">
                                <div class="bg-[#060818] text-white font-bold h-10 w-10 rounded-full flex justify-center items-center opacity-70">{{ $loop->iteration }}</div>
                            </div>

                            <div class="w-full flex justify-center">
                                <div class="text-xl md:text-2xl font-extrabold text-gray-200">
                                    {{ $plan->name }}
                                </div>
                            </div>
                        </div>
                        {{--  Second style layer -> plan amounts --}}
                        <div class="w-full flex justify-center">
                            <div class="absolute w-10/12 h-20 bg-gray-900 rounded-md z-10 top-32">
                                <div class="w-full h-full flex justify-center items-center px-3 md:px-5 text-gray-100 text-sm md:text-base font-semibold">
                                    <div class="flex justify-between space-x-1">
                                        <div>
                                            <h2>{{ formatAmount($plan->min_amount) }}</h2>
                                        </div>
                                        <div>-</div>
                                        <div>
                                            <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  Third style layer -> card body --}}
                        <div class="absolute w-full pb-7 md:pb-10 bg-gray-800 top-32 rounded-md z-0">
                            <div class="w-full flex justify-center mt-24 text-xs md:text-sm text-[#ebedf2]">
                                <div class="w-4/5">
                                    <table class="w-full">
                                        <tr>
                                            <td class="font-medium">{{ ct('Min Deposit To Qualify') }}:</td>
                                            <td>{{ formatAmount($plan->min_deposit) }}</td>
                                        </tr>
                                        @if ($plan->interest_type == 'fixed')
                                        <tr>
                                            <td class="font-medium">{{ ct('Interest') }}:</td>
                                            <td>{{ formatAmount($plan->interest) }}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td class="font-medium">{{ ct('Interest') }}:</td>
                                            <td>{{ $plan->interest }} %</td>
                                        </tr>
                                        @endif
                                    </table>

                                    <div class="w-full flex mt-10 justify-center">
                                        <label for="plan{{ $plan->id }}" type="submit" class="w-2/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-blue-500 hover:bg-gray-700 rounded-md">
                                            {{ ct('Next') }}
                                        </label>
                                        <input type="radio" name="loan_plan_id" id="plan{{ $plan->id }}" value="{{ $plan->id }}" class="hidden" required onclick="this.form.submit()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  End multilayer card --}}
                    @endforeach

                    <div class="w-full mt-[28rem] col-span-2">
                        <button type="button" class="hidden">
                            {{ ct('Next') }}
                        </button>
                    </div>
                </form>
            </div>

            @else
            {{--  unqualified info --}}
            <div class="w-full p-3 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        {{ ct('You have pending or unpaid loan(s), please pay up to qualify for a new loan') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection