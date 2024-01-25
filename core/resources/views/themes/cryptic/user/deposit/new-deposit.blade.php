@extends('themes.cryptic.layout.app')
@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            {{ ct('make new deposit') }}
                        </h2>
                    </div>

                    <div>
                        <a href="{{ url()->previous() }}"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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
    <form action="{{ route('user.deposit.pay') }}" method="POST">
        @csrf
        <div class="w-full py-5">
            <div class="w-full flex justify-center">
                <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                    <div class="p-2 md:p-4">
                        <div class="flex justify-center w-full">
                            <span class="border-none px-3 text-xs font-light text-orange-400 shadow-sm shadow-orange-200">
                                {{ ct('swipe right to see all available payment methods') }}
                            </span>
                        </div>
                        <div class="flex justify-center w-full">
                            <div class="w-3/4 md:w-1/2">
                                <div class="owl-carousel owl-theme w-full">
                                    {{--  manaul crypto deposit methods --}}
                                    @foreach ($methods as $method)
                                        @if ($method->class == 'manual')
                                            @if (isAddonEnabled('manualdeposit'))
                                                <div class="w-full flex justify-center my-3">
                                                    <div
                                                        class="w-60 item bg-[#1b2e4b] text-[#d1d5db] border border-gray-700 rounded-md">
                                                        <label for="{{ $method->id }}">
                                                            <div class="flex justify-center p-4">
                                                                <div class="w-40 h-40">
                                                                    <img class="min-h-full min-w-full rounded-full"
                                                                        src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="text-xs md:text-sm">
                                                                <h3
                                                                    class="font-semibold text-lg md:text-xl text-center py-2">
                                                                    {{ $method->name }}</h3>

                                                                <div class="flex justify-center">
                                                                    <tr>
                                                                        <td>{{ ct('Min') }}:</td>
                                                                        <td>{{ formatAmount($method->min_amount) }}</td>
                                                                    </tr>
                                                                </div>
                                                                <div class="flex justify-center">
                                                                    <tr>
                                                                        <td>{{ ct('Max') }}:</td>
                                                                        <td>{{ formatAmount($method->max_amount) }}</td>
                                                                    </tr>
                                                                </div>
                                                                @if ($method->charge_type == 'fixed')
                                                                    <div class="flex justify-center">
                                                                        <tr>
                                                                            <td>{{ ct('Charge') }}:</td>
                                                                            <td>{{ formatAmount($method->charge) }}</td>
                                                                        </tr>
                                                                    </div>
                                                                @elseif($method->charge_type == 'percent')
                                                                    <div class="flex justify-center">
                                                                        <tr>
                                                                            <td>{{ ct('Charge') }}:</td>
                                                                            <td>{{ $method->charge . '%' }}</td>
                                                                        </tr>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </label>

                                                        <div class="flex justify-center py-3">
                                                            <input type="radio" id="{{ $method->id }}" name="method_id"
                                                                value="{{ $method->id }}" required class="funny-radio">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                    {{--  Paystack starts here --}}
                                    @foreach ($methods->where('type', 'paystack')->where('class', 'gateway') as $method)
                                        <div class="w-full flex justify-center my-3">
                                            <div
                                                class="w-60 item bg-[#1b2e4b] text-[#d1d5db] border border-gray-700 rounded-md">
                                                <label for="{{ $method->id }}">
                                                    <div class="flex justify-center p-4">
                                                        <div class="w-40 h-40">
                                                            <img class="min-h-full min-w-full rounded-full"
                                                                src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div class="text-xs md:text-sm">
                                                        <h3 class="font-semibold text-lg md:text-xl text-center py-2">
                                                            {{ $method->name }}</h3>

                                                        <div class="flex justify-center">
                                                            <tr>
                                                                <td>{{ ct('Min') }}:</td>
                                                                <td>{{ formatAmount($method->min_amount) }}</td>
                                                            </tr>
                                                        </div>
                                                        <div class="flex justify-center">
                                                            <tr>
                                                                <td>{{ ct('Max') }}:</td>
                                                                <td>{{ formatAmount($method->max_amount) }}</td>
                                                            </tr>
                                                        </div>
                                                        @if ($method->charge_type == 'fixed')
                                                            <div class="flex justify-center">
                                                                <tr>
                                                                    <td>{{ ct('Charge') }}:</td>
                                                                    <td>{{ formatAmount($method->charge) }}</td>
                                                                </tr>
                                                            </div>
                                                        @elseif($method->charge_type == 'percent')
                                                            <div class="flex justify-center">
                                                                <tr>
                                                                    <td>{{ ct('Charge') }}:</td>
                                                                    <td>{{ $method->charge . '%' }}</td>
                                                                </tr>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </label>

                                                <div class="flex justify-center py-3">
                                                    <input type="radio" id="{{ $method->id }}" name="method_id"
                                                        value="{{ $method->id }}" required class="funny-radio">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--  paystack ends here --}}

                                    {{-- Add-on gateways starts here --}}
                                    @foreach ($methods->where('type', '!=', 'paystack')->where('class', 'gateway') as $method)
                                        @php
                                            $name = $method->type;
                                            if ($method->type == 'authorize') {
                                                $name = 'authorizenet';
                                            }
                                        @endphp

                                        @if (isAddonEnabled($name))
                                            <div class="w-full flex justify-center my-3">
                                                <div
                                                    class="w-60 item bg-[#1b2e4b] text-[#d1d5db] border border-gray-700 rounded-md">
                                                    <label for="{{ $method->id }}">
                                                        <div class="flex justify-center p-4">
                                                            <div class="w-40 h-40">
                                                                <img class="min-h-full min-w-full rounded-full"
                                                                    src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                        <div class="text-xs md:text-sm">
                                                            <h3 class="font-semibold text-lg md:text-xl text-center py-2">
                                                                {{ $method->name }}</h3>

                                                            <div class="flex justify-center">
                                                                <tr>
                                                                    <td>{{ ct('Min') }}:</td>
                                                                    <td>{{ formatAmount($method->min_amount) }}</td>
                                                                </tr>
                                                            </div>
                                                            <div class="flex justify-center">
                                                                <tr>
                                                                    <td>{{ ct('Max') }}:</td>
                                                                    <td>{{ formatAmount($method->max_amount) }}</td>
                                                                </tr>
                                                            </div>
                                                            @if ($method->charge_type == 'fixed')
                                                                <div class="flex justify-center">
                                                                    <tr>
                                                                        <td>{{ ct('Charge') }}:</td>
                                                                        <td>{{ formatAmount($method->charge) }}</td>
                                                                    </tr>
                                                                </div>
                                                            @elseif($method->charge_type == 'percent')
                                                                <div class="flex justify-center">
                                                                    <tr>
                                                                        <td>{{ ct('Charge') }}:</td>
                                                                        <td>{{ $method->charge . '%' }}</td>
                                                                    </tr>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </label>

                                                    <div class="flex justify-center py-3">
                                                        <input type="radio" id="{{ $method->id }}" name="method_id"
                                                            value="{{ $method->id }}" required class="funny-radio">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    
                                </div>



                                <div class="relative w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="cred-hyip-theme1-input-icon h-8 w-8"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <input type="number" step="any" min="1" name="amount" required
                                        class="cred-hyip-theme1-text-input" placeholder="Enter amount to deposit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-b border-dotted border-gray-600 border mt-2">

                    <div class="w-full my-5 px-5 flex justify-center">
                        <button type="submit"
                            class="w-2/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            {{ ct('Next') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            dots: false,
            items: 1,
            margin: 20,
            responsive: {
                // breakpoint from 768 up
                768: {
                    nav: true
                }
            }
        })
    </script>
@endsection
