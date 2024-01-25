@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Gateway Deposit Methods
                        </h2>
                    </div>

                    <div>
                        <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
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

@section('infographics')
    {{--  This page doesn't need infographics --}}
@endsection

@section('content')
    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
                {{--  setting pannel --}}

                @include('admin.includes.settings-panel')
                {{--  setting pannel ends --}}

                <form action="{{ route('admin.settings.gateways.status') }}" method="post" id="gateway_action_form">
                    <input type="hidden" name="action" id="gateway_action">
                    <input type="hidden" name="gateway_id" id="gateway_id">
                    @csrf
                </form>
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">

                        {{--  default paystack --}}

                        @foreach ($gateways->where('type', 'paystack') as $method)
                            <tr>
                                <td><img class="w-16 h-16 rounded-full bg-white p-1"
                                        src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                        alt="{{ $method->name }}"></td>
                                <td>{{ $method->name }}</td>
                                <td>{{ $method->status }}</td>
                                <td class="flex items-center space-x-3 md:space-x-5 mt-6">
                                    <a href="{{ route('admin.settings.gateways.edit', $method->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    @if ($method->status == 'active')
                                        <a role="button" class='gateway_action_btn' data-id="{{ $method->id }}"
                                            data-action="disable">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        </a>
                                    @elseif($method->status == 'inactive')
                                        <a role="button" class='gateway_action_btn' data-id="{{ $method->id }}"
                                            data-action="enable">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                    @endif

                                </td>
                            </tr>

                            {{--  paystack ends here --}}
                        @endforeach

                        {{--  Authorize starts here --}}
                        @if (isAddonEnabled('authorizenet'))
                            @include('authorizenet::admin.index')
                        @endif
                        {{--  Authorize ends here --}}

                        {{--  Paypal starts here --}}
                        @if (isAddonEnabled('paypal'))
                            @include('paypal::admin.index')
                        @endif
                        {{--  Paypal ends here --}}

                        {{--  Stripe starts here --}}
                        @if (isAddonEnabled('stripe'))
                            @include('stripe::admin.index')
                        @endif
                        {{--  Stripe ends here --}}


                        {{--  RazorPay starts here --}}
                        @if (isAddonEnabled('razorpay'))
                            @include('razorpay::admin.index')
                        @endif
                        {{--  RazorPay ends here --}}

                        {{--  Flutterwave starts here --}}
                        @if (isAddonEnabled('flutterwave'))
                            @include('flutterwave::admin.index')
                        @endif
                        {{--  Flutterwave ends here --}}

                        {{--  Coingate starts here --}}
                        @if (isAddonEnabled('coingate'))
                            @include('coingate::admin.index')
                        @endif
                        {{--  Coingate ends here --}}

                        {{--  Cashmaal starts here --}}
                        @if (isAddonEnabled('cashmaal'))
                            @include('cashmaal::admin.index')
                        @endif
                        {{--  Cashmaal ends here --}}

                        {{--  COINBASE starts here --}}
                        @if (isAddonEnabled('coinbase'))
                            @include('coinbase::admin.index')
                        @endif
                        {{--  Coinbase ends here --}}

                        {{--  Monnify starts here --}}
                        @if (isAddonEnabled('monnify'))
                            @include('monnify::admin.index')
                        @endif
                        {{--  Monnify ends here --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{--  enable/disable gateway --}}
    <script>
        $('.gateway_action_btn').on('click', function() {
            var gateway_id = $(this).data('id');
            var action = $(this).data('action');
            $('#gateway_id').val(gateway_id);
            $('#gateway_action').val(action);

            Swal.fire({
                title: action + ' Payment Gateway!',
                text: "Do you want " + action + " this Payment Gateway? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + action,
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#gateway_action_form').submit();
                }
            });
        });
    </script>
@endsection
