@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('Deposit details') }}
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

@section('content')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="p-2 md:p-4">
                <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                    <tbody class="p-2 md:p-4">
                        
                        <tr>
                            <td class="font-medium">{{ ct('Amount') }}:</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">{{ ct('Amount') }}:</td>
                            <td>{{ formatAmount($deposit->amount) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">{{ ct('Payment Method') }}:</td>
                            <td>{{ $deposit->method }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">{{ ct('Payment Method Amount') }}:</td>
                            <td>{{ $deposit->converted_amount }}{{ $deposit->currency }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">{{ ct('Deposit Charge') }}:</td>
                            <td>{{ formatAmount($deposit->charge) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">{{ ct('Status') }}:</td>
                            <td class="
                            @if ($deposit->status == 'cancelled')
                            bg-red-500 
                            @elseif ($deposit->status == 'pending')
                            bg-orange-500
                            @elseif ($deposit->status == 'approved')
                            bg-green-500
                            @endif
                            pl-2 rounded-sm text-gray-200">{{$deposit->status }}</td>
                        </tr>
                        @if ($deposit->status != 'cancelled')
                        <tr>
                            <td class="font-medium">{{ ct('Additional Info') }}</td>
                            <td>{{ $deposit->additional_info }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="font-medium">
                                <h2>{{ ct('Payment Screenshot') }}</h2>
                            </td>
                            <td>
                                <div class="h-36 md:h-64 w-28 md:w-60 bg-blue-300 rounded-sm">
                                    <img class="min-h-full min-w-full rounded-sm" src="{{ route('file', ['deposits', $deposit->payment_screenshot]) }}" alt="Deposit screenshot">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection