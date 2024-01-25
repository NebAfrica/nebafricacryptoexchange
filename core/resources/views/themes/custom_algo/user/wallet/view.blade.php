@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        view wallet
                    </h2>
                </div>

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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="w-full">
                {{--  Card header --}}
                <h2 class="bg-transparent text-center text-[#ebedf2] font-medium capitalize">
                    {{ $wallet->name }}
                </h2>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                    <tbody class="p-2 md:p-4">                        
                        <tr>
                            <td class="font-medium">Date:</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($wallet->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Type:</td>
                            <td>{{ $wallet->type }}</td>
                        </tr>
                        @if ($wallet->type == 'crypto')
                        <tr>
                            <td class="p-3 qrcode" colspan="2">{!! QrCode::generate(json_decode($wallet->info)->wallet_address) !!}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Wallet Address:</td>
                            <td>{{ json_decode($wallet->info)->wallet_address }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Network Type:</td>
                            <td>{{ json_decode($wallet->info)->network_type }}</td>
                        </tr>
                        @elseif ($wallet->type == 'bank')
                        <tr>
                            <td class="font-medium">Bank Name:</td>
                            <td>{{ json_decode($wallet->info)->bank_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Account Name:</td>
                            <td>{{ json_decode($wallet->info)->account_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Account No:</td>
                            <td>{{ json_decode($wallet->info)->account_no }}</td>
                        </tr>
                        @elseif ($wallet->type == 'others')
                        
                        <tr>
                            <td class="font-medium">Payment Info:</td>
                            <td>{{ json_decode($wallet->info)->payment_info }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="p-3"></td>
                        </tr>
                        <tr>
                            <td class="font-medium bg-green-400 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                <a href="{{ route('user.wallets.edit', $wallet->id) }}" class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Edit</span>
                                </a>
                            </td>
                            <td class="font-medium bg-red-500 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                <a href="{{ route('user.wallets.index').'/delete/'.$wallet->id }}" class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection