<?php

// Manages the spacing for cards when looped on medium and small screen devices upwards
function manageMdCardLayouts($LoopIterator, $screenAlias)
{
    if ($screenAlias == 1)
        return ($LoopIterator == 1) ? "" : "mt-96";

    return ($LoopIterator == 1 || $LoopIterator == 2) ? "" : "mt-96";
}

?>
@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        My Investments
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}"  >
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

@section('infographics')
<div  >
    <div  >
        <div  >
            <div  >
                <div  >
                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div  >
                            <div>
                                <h2  >{{ formatAmount($total_earnings) }}</h2>
                            </div>
                            <div  >
                                <h4  >Total earnings</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3" />
                                </svg>
                            </div>
                        </div>
                        <div  >
                            <div>
                                <h2  >{{ formatAmount($total_invested) }}</h2>
                            </div>
                            <div  >
                                <h4  >Total invested</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($investments->count() > 0)
                <div  >
                    <div  >
                        <canvas id="myChart" width="100" height="100"></canvas>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection



@section('content')
<div  >
    <div  >
        <div  >
            <div  >
                @if ($investments->count() > 0)
                    {{-- FOR SMALL AND MEDIUM SCREENS ONLY --}}
                    <div  >
                        @foreach ($investments as $invt)
                        {{-- multi layer style card --}}
                        <div  >
                            {{-- First style layer -> card header --}}
                            <div  >
                                <div  >
                                    <div  >{{ $loop->iteration }}</div>
                                    <div  >
                                        @if ($invt->status == 'active')
                                        <div  ></div>
                                        @elseif ($invt->status == 'suspended')
                                        <div  ></div>
                                        @else
                                        <div  ></div>
                                        @endif
                                        <div  >{{ $invt->status }}</div>
                                    </div>
                                </div>

                                <div  >
                                    <div  >
                                        {{ $invt->plan_name }}
                                    </div>
                                </div>
                            </div>
                            {{-- Second style layer -> progress bar --}}
                            <div  >
                                <div  >
                                    <div  >
                                        <?php
                                        $valToHundred = (($invt->total_intervals_given * 100) / $invt->total_intervals);
                                        ?>
                                        {{-- <progress   value="{{ $invt->total_intervals_given }}" max="{{ $invt->total_intervals }}"></progress> --}}
                                        <div  >
                                            <div   style="width: <?php echo $valToHundred ?>%"><?php echo round($valToHundred, 2) ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Third style layer -> card body --}}
                            <div  >
                                <div  >
                                    <table  >
                                        <tr>
                                            <td  >Amount Invested:</td>
                                            <td>{{ formatAmount($invt->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td  >Amount Earned:</td>
                                            <td>{{ formatAmount($invt->total_profit_earned) }}</td>
                                        </tr>
                                        <tr>
                                            <td  >Last Profit:</td>
                                            <td>
                                                @if ($invt->next_profit_time == $invt->last_profit_time)
                                                NILL
                                                @else
                                                {{ formatPastDate($invt->last_profit_time) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  >Next Profit:</td>
                                            <td>{{ formatFutureDate($invt->next_profit_time) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- End multilayer card --}}
                        @endforeach

                        <div  >
                            <button type="button"  >
                                Next
                            </button>
                        </div>
                    </div>




                    {{-- FOR LARGE SCREENS UPWARDS ONLY ---------------------------------------------------}}
                    <div  >
                        @foreach ($investments as $invt)
                        {{-- multi layer style card --}}
                        <div  >
                            {{-- First style layer -> card header --}}
                            <div  >
                                <div  >
                                    <div  >{{ $loop->iteration }}</div>
                                    <div  >
                                        <div  ></div>
                                        <div  >{{ $invt->status }}</div>
                                    </div>
                                </div>

                                <div  >
                                    <div  >
                                        {{ $invt->plan_name }}
                                    </div>
                                </div>
                            </div>
                            {{-- Second style layer -> progress bar --}}
                            <div  >
                                <div  >
                                    <div  >
                                        <?php
                                        $valToHundred = (($invt->total_intervals_given * 100) / $invt->total_intervals);
                                        ?>
                                        {{-- <progress   value="{{ $invt->total_intervals_given }}" max="{{ $invt->total_intervals }}"></progress> --}}
                                        <div  >
                                            <div   style="width: <?php echo $valToHundred ?>%"><?php echo round($valToHundred, 2) ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Third style layer -> card body --}}
                            <div  >
                                <div  >
                                    <table  >
                                        <tr>
                                            <td  >Amount Invested:</td>
                                            <td>{{ formatAmount($invt->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td  >Amount Earned:</td>
                                            <td>{{ formatAmount($invt->total_profit_earned) }}</td>
                                        </tr>
                                        <tr>
                                            <td  >Last Profit:</td>
                                            <td>
                                                @if ($invt->next_profit_time == $invt->last_profit_time)
                                                NILL
                                                @else
                                                {{ formatPastDate($invt->last_profit_time) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  >Next Profit:</td>
                                            <td>{{ formatFutureDate($invt->next_profit_time) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- End multilayer card --}}
                        @endforeach

                        <div  >
                            <button type="button"  >
                                Next
                            </button>
                        </div>
                    </div>
                @else 
                    {{-- disclaimer notification --}}
                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <div>
                                <b  >Empty Record! </b> You haven't made any investments.
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