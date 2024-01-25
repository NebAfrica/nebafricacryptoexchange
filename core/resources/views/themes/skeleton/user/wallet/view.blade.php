@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        view wallet
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
<div  >
    <div  >
        <div  >
            <div  >
                {{--  Card header --}}
                <h2  >
                    {{ $wallet->name }}
                </h2>
            </div>

            <hr  >

            <div  >
                <table  >
                    <tbody  >                        
                        <tr>
                            <td  >Date:</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($wallet->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td  >Type:</td>
                            <td>{{ $wallet->type }}</td>
                        </tr>
                        @if ($wallet->type == 'crypto')
                        <tr>
                            <td   colspan="2">{!! QrCode::generate(json_decode($wallet->info)->wallet_address) !!}</td>
                        </tr>
                        <tr>
                            <td  >Wallet Address:</td>
                            <td>{{ json_decode($wallet->info)->wallet_address }}</td>
                        </tr>
                        <tr>
                            <td  >Network Type:</td>
                            <td>{{ json_decode($wallet->info)->network_type }}</td>
                        </tr>
                        @elseif ($wallet->type == 'bank')
                        <tr>
                            <td  >Bank Name:</td>
                            <td>{{ json_decode($wallet->info)->bank_name }}</td>
                        </tr>
                        <tr>
                            <td  >Account Name:</td>
                            <td>{{ json_decode($wallet->info)->account_name }}</td>
                        </tr>
                        <tr>
                            <td  >Account No:</td>
                            <td>{{ json_decode($wallet->info)->account_no }}</td>
                        </tr>
                        @elseif ($wallet->type == 'others')
                        
                        <tr>
                            <td  >Payment Info:</td>
                            <td>{{ json_decode($wallet->info)->payment_info }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2"  ></td>
                        </tr>
                        <tr>
                            <td  >
                                <a href="{{ route('user.wallets.edit', $wallet->id) }}"  >
                                    <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Edit</span>
                                </a>
                            </td>
                            <td  >
                                <a href="{{ route('user.wallets.index').'/delete/'.$wallet->id }}"  >
                                    <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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