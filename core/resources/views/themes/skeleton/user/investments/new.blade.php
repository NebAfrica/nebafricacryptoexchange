<?php

// Manages the spacing for cards when looped on medium and small screen devices upwards
function manageMdCardLayouts($LoopIterator, $screenAlias)
{
    if ($screenAlias == 1)
        return ($LoopIterator == 1) ? "" : "mt-[26rem]";

    return ($LoopIterator == 1 || $LoopIterator == 2) ? "" : "mt-[26rem]";
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
                        New Investment Plan
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


@section('content')

@if (session()->has('plan_id'))
<div  >
    <div  >
        <div  >

            <form action="{{ route('user.investments.new-validate') }}" method="POST">
                @csrf

                @if ($plan->amount_type == 'range')
                {{-- details confirmation --}}
                <div  >
                    <div  >
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div  >
                            <p>You have selected the <b>{{ $plan->name }}</b>. Minimum and maximum investment amount are <b>{{ formatAmount($plan->min_amount) }}</b> and <b>{{ formatAmount($plan->max_amount) }}</b> respectively.</p>
                        </div>
                    </div>
                </div>
                <div  >
                    <span  >
                        {{ websiteInfo('general_currency') }}
                    </span>
                    <input type="number" step="any" name="amount" id="amount" min="{{ $plan->min_amount }}" max="{{ $plan->max_amount }}" required   placeholder="Enter amount">
                </div>

                @else
                {{-- details confirmation --}}
                <div  >
                    <div  >
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div  >
                            <p>You have selected the <b>{{ $plan->name }}</b>. This plan has a fixed price of <b>{{ formatAmount($plan->min_amount) }}</b>.</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- preview confirm/cancel confirm button --}}
                <div  >
                    {{-- confirm --}}
                    <div>
                        <button type="submit"  >
                            Confirm
                        </button>
                    </div>

                    {{-- cancel --}}
                    <div>
                        <a href="{{ route('user.investments.cancel') }}"  >
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@else

<div  >
    <div  >
        <div  >
            <div  >

                {{-- FOR SMALL AND MEDIUM SCREENS ONLY --}}
                <form action="{{ route('user.investments.new-validate') }}" method="POST"  >
                    @csrf
                    @foreach ($plans as $plan)
                    {{-- multi layer style card --}}
                    <div  >
                        {{-- First style layer -> card header --}}
                        <div  >
                            <div  >
                                <div  >{{ $loop->iteration }}</div>
                                <div  >
                                    <div  >{{ $plan->label }}</div>
                                </div>
                            </div>

                            <div  >
                                <div  >
                                    {{ $plan->name }}
                                </div>
                            </div>
                        </div>
                        {{-- Second style layer -> plan amounts --}}
                        <div  >
                            <div  >
                                <div  >
                                    @if ($plan->amount_type == 'fixed')
                                    <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                    @else
                                    <div  >
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
                        <div  >
                            <div  >
                                <div  >
                                    <table  >
                                        @if ($plan->return_type == 'fixed')
                                        <tr>
                                            <td  >ROI:</td>
                                            <td>{{ formatAmount($plan->return) }} %</td>
                                        </tr>
                                        <tr>
                                            <td  >Duration:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td  >ROI:</td>
                                            <td>{{ $plan->return }} %</td>
                                        </tr>
                                        <tr>
                                            <td  >Duration:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td  >Profit Return:</td>
                                            <td>{{ $plan->return_interval }}</td>
                                        </tr>
                                    </table>

                                    <div  >                                        
                                        <label for="plan{{ $plan->id }}" type="submit"  >
                                            Select
                                        </label>
                                        <input type="radio" name="plan_id" id="plan{{ $plan->id }}" value="{{ $plan->id }}" onclick="this.form.submit()"   required onclick="this.form.submit()">
                                    </div>
                                </div>
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
                </form>




                {{-- FOR LARGE SCREENS UPWARDS ONLY ---------------------------------------------------}}
                <form action="{{ route('user.investments.new-validate') }}" method="POST"  >
                    @csrf
                    @foreach ($plans as $plan)
                    {{-- multi layer style card --}}
                    <div  >
                        {{-- First style layer -> card header --}}
                        <div  >
                            <div  >
                                <div  >{{ $loop->iteration }}</div>
                                <div  >
                                    <div  >{{ $plan->label }}</div>
                                </div>
                            </div>

                            <div  >
                                <div  >
                                    {{ $plan->name }}
                                </div>
                            </div>
                        </div>
                        {{-- Second style layer -> plan amount --}}
                        <div  >
                            <div  >
                                <div  >
                                    @if ($plan->amount_type == 'fixed')
                                    <h2>{{ formatAmount($plan->max_amount) }}</h2>
                                    @else
                                    <div  >
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
                        <div  >
                            <div  >
                                <div  >
                                    <table  >
                                        @if ($plan->return_type == 'fixed')
                                        <tr>
                                            <td  >ROI:</td>
                                            <td>{{ formatAmount($plan->return) }} %</td>
                                        </tr>
                                        <tr>
                                            <td  >Duration:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td  >ROI:</td>
                                            <td>{{ $plan->return }} %</td>
                                        </tr>
                                        <tr>
                                            <td  >Duration:</td>
                                            <td>{{ $plan->duration }} @if ($plan->duration > 1 ) {{ $plan->duration_type.'s' }} @else {{ $plan->duration_type }} @endif</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td  >Profit Return:</td>
                                            <td>{{ $plan->return_interval }}</td>
                                        </tr>
                                    </table>

                                    <div  >
                                        <label for="plan{{ $plan->id }}" type="submit"  >
                                            Next
                                        </label>
                                        <input type="radio" name="plan_id" id="plan{{ $plan->id }}" value="{{ $plan->id }}"   required onclick="this.form.submit()">
                                    </div>
                                </div>
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
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection