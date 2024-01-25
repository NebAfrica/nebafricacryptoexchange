@extends('themes.skeleton.layout.app')
@section('title')
    <div  >
        <div  >
            <div  >
                <div  >
                    <div>
                        {{--  Card header --}}
                        <h2  >
                            make new deposit
                        </h2>
                    </div>

                    <div>
                        <a href="{{ url()->previous() }}"
                             >
                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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
    <form action="{{ route('user.deposit.pay') }}" method="POST">
        @csrf
        <div  >
            <div  >
                <div  >
                    <div  >
                        <div  >
                            <span  >
                                swipe right to see all available payment methods
                            </span>
                        </div>
                        <div  >
                            <div  >
                                <div  >
                                    {{--  manaul crypto deposit methods --}}
                                    @foreach ($methods as $method)
                                        @if ($method->class == 'manual')
                                            @if (isAddonEnabled('manualdeposit'))
                                                <div  >
                                                    <div
                                                         >
                                                        <label for="{{ $method->id }}">
                                                            <div  >
                                                                <div  >
                                                                    <img  
                                                                        src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div  >
                                                                <h3
                                                                     >
                                                                    {{ $method->name }}</h3>

                                                                <div  >
                                                                    <tr>
                                                                        <td>Min:</td>
                                                                        <td>{{ formatAmount($method->min_amount) }}</td>
                                                                    </tr>
                                                                </div>
                                                                <div  >
                                                                    <tr>
                                                                        <td>Max:</td>
                                                                        <td>{{ formatAmount($method->max_amount) }}</td>
                                                                    </tr>
                                                                </div>
                                                                @if ($method->charge_type == 'fixed')
                                                                    <div  >
                                                                        <tr>
                                                                            <td>Charge:</td>
                                                                            <td>{{ formatAmount($method->charge) }}</td>
                                                                        </tr>
                                                                    </div>
                                                                @elseif($method->charge_type == 'percent')
                                                                    <div  >
                                                                        <tr>
                                                                            <td>Charge:</td>
                                                                            <td>{{ $method->charge . '%' }}</td>
                                                                        </tr>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </label>

                                                        <div  >
                                                            <input type="radio" id="{{ $method->id }}" name="method_id"
                                                                value="{{ $method->id }}" required  >
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                    {{--  Paystack starts here --}}
                                    @foreach ($methods->where('type', 'paystack')->where('class', 'gateway') as $method)
                                        <div  >
                                            <div
                                                 >
                                                <label for="{{ $method->id }}">
                                                    <div  >
                                                        <div  >
                                                            <img  
                                                                src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                    <div  >
                                                        <h3  >
                                                            {{ $method->name }}</h3>

                                                        <div  >
                                                            <tr>
                                                                <td>Min:</td>
                                                                <td>{{ formatAmount($method->min_amount) }}</td>
                                                            </tr>
                                                        </div>
                                                        <div  >
                                                            <tr>
                                                                <td>Max:</td>
                                                                <td>{{ formatAmount($method->max_amount) }}</td>
                                                            </tr>
                                                        </div>
                                                        @if ($method->charge_type == 'fixed')
                                                            <div  >
                                                                <tr>
                                                                    <td>Charge:</td>
                                                                    <td>{{ formatAmount($method->charge) }}</td>
                                                                </tr>
                                                            </div>
                                                        @elseif($method->charge_type == 'percent')
                                                            <div  >
                                                                <tr>
                                                                    <td>Charge:</td>
                                                                    <td>{{ $method->charge . '%' }}</td>
                                                                </tr>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </label>

                                                <div  >
                                                    <input type="radio" id="{{ $method->id }}" name="method_id"
                                                        value="{{ $method->id }}" required  >
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--  paystack ends here --}}

                                    {{--  authorize starts here --}}
                                    @if (isAddonEnabled('authorizenet'))
                                        @include('authorizenet::themes.skeleton.index')
                                    @endif
                                    {{--  authorize ends here --}}

                                    {{--  paypal starts here --}}
                                    @if (isAddonEnabled('paypal'))
                                        @include('paypal::themes.skeleton.index')
                                    @endif
                                    {{--  paypal ends here --}}

                                    {{--  stripe starts here --}}
                                    @if (isAddonEnabled('stripe'))
                                        @include('stripe::themes.skeleton.index')
                                    @endif
                                    {{--  stripe ends here --}}

                                    {{--  razorpay starts here --}}
                                    @if (isAddonEnabled('razorpay'))
                                        @include('razorpay::themes.skeleton.index')
                                    @endif
                                    {{--  razorpay ends here --}}

                                    {{--  flutterwave starts here --}}
                                    @if (isAddonEnabled('razorpay'))
                                        @include('flutterwave::themes.skeleton.index')
                                    @endif
                                    {{--  flutterwave ends here --}}

                                    {{--  coingate starts here --}}
                                    @if (isAddonEnabled('coingate'))
                                        @include('coingate::themes.skeleton.index')
                                    @endif
                                    {{--  Coingate ends here --}}

                                    {{--  cashmaal starts here --}}
                                    @if (isAddonEnabled('cashmaal'))
                                        @include('cashmaal::themes.skeleton.index')
                                    @endif
                                    {{--  Cashmaal ends here --}}

                                    {{--  coinbase starts here --}}
                                    @if (isAddonEnabled('coinbase'))
                                        @include('coinbase::themes.skeleton.index')
                                    @endif
                                    {{--  Coinbase ends here --}}

                                    {{--  Monnify starts here --}}
                                    @if (isAddonEnabled('monnify'))
                                        @include('monnify::themes.skeleton.index')
                                    @endif
                                    {{--  Monnify ends here --}}
                                </div>



                                <div  >
                                    <svg xmlns="http://www.w3.org/2000/svg"  
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <input type="number" step="any" min="1" name="amount" required
                                          placeholder="Enter amount to deposit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr  >

                    <div  >
                        <button type="submit"
                             >
                            Next
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
