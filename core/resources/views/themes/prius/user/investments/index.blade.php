<?php

// Manages the spacing for cards when looped on medium and small screen devices upwards
function manageMdCardLayouts($LoopIterator, $screenAlias)
{
    if ($screenAlias == 1)
        return ($LoopIterator == 1) ? "" : "mt-96";

    return ($LoopIterator == 1 || $LoopIterator == 2) ? "" : "mt-96";
}

?>
@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('My Investments') }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('back') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('infographics')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="w-full py-5">
                <div class="w-full lg:flex lg:justify-evenly lg:space-x-2 space-y-3 lg:space-y-0 text-[#bfc9d4]">
                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#456499] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($total_earnings) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">{{ ct('Total earnings') }}</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#456499] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($total_invested) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">{{ ct('Total invested') }}</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($investments->count() > 0)
                <div class="w-full flex justify-center items-center mt-5">
                    <div class="w-full flex justify-center items-center lg:w-2/3">
                        <canvas id="myChart" width="100" height="100"></canvas>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection



@section('content')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-4 md:p-10">
            <div class="w-full h-full flex justify-center">
                @if ($investments->count() > 0)
                    {{-- FOR SMALL AND MEDIUM SCREENS ONLY --}}
                    <div class="w-full grid lg:hidden grid-cols-1 mt-12">
                        @foreach ($investments as $invt)
                        {{-- multi layer style card --}}
                        <div class="w-full lg:w-60 xl:w-72 relative bg-transparent {{ manageMdCardLayouts($loop->iteration, 1) }}">
                            {{-- First style layer -> card header --}}
                            <div class="absolute w-full h-44 bg-gradient-to-r from-blue-800 via-blue-400 to-green-300 rounded-2xl z-10">
                                <div class="flex justify-between items-center pr-2">
                                    <div class="bg-[#060818] text-white font-bold h-10 w-10 rounded-full flex justify-center items-center opacity-70">{{ $loop->iteration }}</div>
                                    <div class="bg-[#060818] text-white flex space-x-1 items-center py-[0.15rem] px-2 rounded-lg opacity-70">
                                        @if ($invt->status == 'active')
                                        <div class="h-2 w-2 rounded-full animate-pulse bg-green-500 shadow-sm shadow-green-200"></div>
                                        @elseif ($invt->status == 'suspended')
                                        <div class="h-2 w-2 rounded-full animate-pulse bg-orange-500 shadow-lg shadow-orange-300"></div>
                                        @else
                                        <div class="h-2 w-2 rounded-full animate-pulse bg-red-600 shadow-lg shadow-red-400"></div>
                                        @endif
                                        <div class="text-xs md:text-sm">{{ $invt->status }}</div>
                                    </div>
                                </div>

                                <div class="w-full flex justify-center">
                                    <div class="text-xl md:text-2xl font-extrabold text-gray-200">
                                        {{ $invt->plan_name }}
                                    </div>
                                </div>
                            </div>
                            {{-- Second style layer -> progress bar --}}
                            <div class="w-full flex justify-center">
                                <div class="absolute w-10/12 h-20 bg-gray-900 rounded-md z-10 top-32">
                                    <div class="w-full h-full flex justify-center items-center px-3 md:px-5">
                                        <?php
                                        $valToHundred = (($invt->total_intervals_given * 100) / $invt->total_intervals);
                                        ?>
                                        {{-- <progress class="w-full rounded-lg" value="{{ $invt->total_intervals_given }}" max="{{ $invt->total_intervals }}"></progress> --}}
                                        <div class="shadow w-full bg-gray-300 rounded-md">
                                            <div class="bg-green-600 text-xs leading-none py-1 text-center text-white rounded-md" style="width: <?php echo $valToHundred ?>%"><?php echo round($valToHundred, 2) ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Third style layer -> card body --}}
                            <div class="absolute w-full pb-7 md:pb-10 bg-gray-800 top-32 rounded-md z-0">
                                <div class="w-full flex justify-center pl-3 md:pl-5 mt-24 text-xs md:text-sm text-[#ebedf2]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="font-medium">{{ ct('Amount Invested') }}:</td>
                                            <td>{{ formatAmount($invt->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Amount Earned') }}:</td>
                                            <td>{{ formatAmount($invt->total_profit_earned) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Last Profit') }}:</td>
                                            <td>
                                                @if ($invt->next_profit_time == $invt->last_profit_time)
                                                {{ ct('NILL', 'u') }}
                                                @else
                                                {{ formatPastDate($invt->last_profit_time) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Next Profit') }}:</td>
                                            <td>{{ formatFutureDate($invt->next_profit_time) }}</td>
                                        </tr>
                                    </table>
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
                    </div>




                    {{-- FOR LARGE SCREENS UPWARDS ONLY ---------------------------------------------------}}
                    <div class="hidden w-full lg:grid grid-cols-2 gap-3 mt-12 place-items-center">
                        @foreach ($investments as $invt)
                        {{-- multi layer style card --}}
                        <div class="w-full lg:w-60 xl:w-72 relative bg-transparent {{ manageMdCardLayouts($loop->iteration, 2) }}">
                            {{-- First style layer -> card header --}}
                            <div class="absolute w-full h-44 bg-gradient-to-r from-blue-800 via-blue-400 to-green-300 rounded-2xl z-10">
                                <div class="flex justify-between items-center pr-2">
                                    <div class="bg-[#060818] text-white font-bold h-10 w-10 rounded-full flex justify-center items-center opacity-70">{{ $loop->iteration }}</div>
                                    <div class="bg-[#060818] text-white flex space-x-1 items-center py-[0.15rem] px-2 rounded-lg opacity-70">
                                        <div class="h-2 w-2 rounded-full animate-pulse bg-green-500 shadow-sm shadow-green-200"></div>
                                        <div class="text-xs md:text-sm">{{ $invt->status }}</div>
                                    </div>
                                </div>

                                <div class="w-full flex justify-center">
                                    <div class="text-xl md:text-2xl font-extrabold text-gray-200">
                                        {{ $invt->plan_name }}
                                    </div>
                                </div>
                            </div>
                            {{-- Second style layer -> progress bar --}}
                            <div class="w-full flex justify-center">
                                <div class="absolute w-10/12 h-20 bg-gray-900 rounded-md z-10 top-32">
                                    <div class="w-full h-full flex justify-center items-center px-3 md:px-5">
                                        <?php
                                        $valToHundred = (($invt->total_intervals_given * 100) / $invt->total_intervals);
                                        ?>
                                        {{-- <progress class="w-full rounded-lg" value="{{ $invt->total_intervals_given }}" max="{{ $invt->total_intervals }}"></progress> --}}
                                        <div class="shadow w-full bg-gray-300 rounded-md">
                                            <div class="bg-green-600 text-xs leading-none py-1 text-center text-white rounded-md" style="width: <?php echo $valToHundred ?>%"><?php echo round($valToHundred, 2) ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Third style layer -> card body --}}
                            <div class="absolute w-full pb-10 bg-gray-800 top-32 rounded-md z-0">
                                <div class="w-full flex justify-center pl-3 md:pl-5 mt-28 text-xs md:text-sm text-[#ebedf2]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="font-medium">{{ ct('Amount Invested') }}:</td>
                                            <td>{{ formatAmount($invt->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Amount Earned') }}:</td>
                                            <td>{{ formatAmount($invt->total_profit_earned) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Last Profit') }}:</td>
                                            <td>
                                                @if ($invt->next_profit_time == $invt->last_profit_time)
                                                NILL
                                                @else
                                                {{ formatPastDate($invt->last_profit_time) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-medium">{{ ct('Next Profit') }}:</td>
                                            <td>{{ formatFutureDate($invt->next_profit_time) }}</td>
                                        </tr>
                                    </table>
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
                    </div>
                @else 
                    {{-- disclaimer notification --}}
                    <div class="w-full p-6 md:p-10 flex justify-center">
                        <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">{{ ct('Empty Record!') }} </b> {{ ct("You haven't made any investments", 'l') }}.
                            </div>
                        </div>
                    </div> 
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let totalEarningVal = "{{$total_earnings}}"
    let totalInvestedVal = "{{$total_invested}}"
    let activePlansVal = "{{$active_plans}}"
    let suspendedPlansVal = "{{$suspended_plans}}"
    let maturedPlansVal = "{{$expired_plans}}"
    const data = {
        labels: [
            '{{ formatAmount($total_earnings) }}',
            '{{ formatAmount($total_invested) }}',
            'ACTIVE',
            'MATURED',
            'SUSPENDED',
        ],
        datasets: [{
            type: 'pie',
            label: "Total Earnings",
            data: [parseInt(parseInt(totalEarningVal))],
            backgroundColor: ['rgb(69,100,153)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Total Invested",
            data: [0, parseInt(parseInt(totalInvestedVal))],
            backgroundColor: ['rgb(78, 58, 170)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Plans Count",
            data: [0, 0, parseInt(activePlansVal), parseInt(maturedPlansVal), parseInt(suspendedPlansVal)],
            backgroundColor: [
                'rgb(0, 0, 0)',
                'rgb(255, 136, 0)',
                'rgb(0, 200, 81)',
                'rgb(204, 0, 0)'
            ],
            hoverOffset: 2
        }, ]
    };
    const config = {
        data: data,
        options: {
            layout: {
                padding: 20
            }
        }
    };
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, config)
</script>
    
@endsection