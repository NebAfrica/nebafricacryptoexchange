@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <div class="flex items-center space-x-1">
                        {{--  icon before header --}}
                        <div class="<?php if ($transfer->receiver_id == user('id')) echo "text-green-600";
                                    else echo "text-red-600"; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                            </svg>
                        </div>

                        {{--  header --}}
                        <div>
                            <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                Transfer - [ {{ $transfer->txn_id }} ]
                            </h2>
                        </div>
                    </div>
                </div>

                {{--  back button --}}
                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-2/3 rounded-sm bg-[#0e1726] p-10">
            <table class="text-[#bfc9d4] text-xs md:text-sm">
                
                <tr>
                    <td class="font-medium">Type:</td>
                    @if ($transfer->receiver_id == user('id'))
                    <td class="pl-6 md:pl-10"> Incoming Transfer </td>
                    @else
                    <td class="pl-6 md:pl-10"> Outgoing Transfer </td>
                    @endif
                </tr>
                <tr>
                    <td class="font-medium">Amount:</td>
                    <td class="pl-6 md:pl-10">{{ formatAmount($transfer->amount) }}</td>
                </tr>
                @if ($transfer->sender_id == user('id'))
                <tr>
                    <td class="font-medium">Fee:</td>
                    <td class="pl-6 md:pl-10">{{ formatAmount($transfer->fee) }}</td>
                </tr>
                <tr>
                    <td class="font-medium">Total:</td>
                    <td class="pl-6 md:pl-10">{{ formatAmount($transfer->total) }}</td>
                </tr>
                @endif
                <tr>
                    <td class="font-medium">Narration:</td>
                    <td class="pl-6 md:pl-10">{{ $transfer->narration }}</td>
                </tr>
                <tr>
                    <td class="font-medium">Date:</td>
                    <td class="pl-6 md:pl-10">{{ date('d.m.Y H:i:s', strtotime($transfer->created_at)) }}</td>
                </tr>
                <tr>
                    <td class="font-medium">Status:</td>
                    <td class="pl-6 md:pl-10">{{ $transfer->status }}</td>
                </tr>
            </table>

            <hr class="w-full border-b border-dotted border-gray-600 border my-8 md:my-10">


            {{--  transfer from section --}}
            <div class="block w-full">
                <table class="text-[#bfc9d4] text-xs md:text-sm w-full table-fixed">
                    <tr>
                        <td class="w-20 md:w-24"></td>
                        <td class=""></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="font-medium">
                            <div class="flex items-center space-x-1">
                                <div class="text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                    </svg>
                                </div>
                                <div class="font-semibold text-base">
                                    <h2>FROM:</h2>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" class="font-medium">First Name:</td>
                        <td align="left">{{ $sender->first_name}}</td>
                    </tr>
                    <tr>
                        <td align="left" class="font-medium">Last Name:</td>
                        <td align="left">{{ $sender->last_name}}</td>
                    </tr>
                    <tr>
                        <td align="left" class="font-medium">Account ID:</td>
                        <td align="left">{{ $sender->account_id}}</td>
                    </tr>
                </table>
            </div>

            <br><br>

            {{--  transfer to section --}}
            <div class="block w-full">
                <table class="text-[#bfc9d4] text-xs md:text-sm w-full table-fixed">
                    <tr>
                        <td class=""></td>
                        <td class="w-16 md:w-20"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="font-medium text-right">
                            <div class="flex justify-end items-center space-x-1">
                                <div class="text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                    </svg>
                                </div>
                                <div class="font-semibold text-base">
                                    <h2>TO:</h2>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-medium">First Name:</td>
                        <td align="right">{{ $receiver->first_name}}</td>
                    </tr>
                    <tr>
                        <td align="right" class="font-medium">Last Name:</td>
                        <td align="right">{{ $receiver->last_name}}</td>
                    </tr>
                    <tr>
                        <td align="right" class="font-medium">Account ID:</td>
                        <td align="right">{{ $receiver->account_id}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection