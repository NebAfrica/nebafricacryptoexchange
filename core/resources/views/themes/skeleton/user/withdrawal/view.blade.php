@extends('themes.skeleton.layout.app')
@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        View Withdrawal
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
                <table  >
                    <tbody  >
                        <tr>
                            <td  >Date:</td>
                            <td>{{ date('d.m.Y H:i:s', $withdrawal->created_at) }}</td>
                        </tr>
                        <tr>
                            <td  >Status:</td>
                            @if($withdrawal->status == "approved")
                            <td  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    {{ strtoupper($withdrawal->status) }}
                                </div>
                            </td>
                            @elseif($withdrawal->status == "pending")
                            <td  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    {{ strtoupper($withdrawal->status) }}
                                </div>
                            </td>
                            @elseif($withdrawal->status == "rejected")
                            <td  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <div>
                                    {{ strtoupper($withdrawal->status) }}
                                </div>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td  >TXN ID:</td>
                            <td>{{ $withdrawal->txn_id ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td  >Amount:</td>
                            <td>{{ formatAmount($withdrawal->amount) }}</td>
                        </tr>
                        <tr>
                            <td  >Fee:</td>
                            <td>{{ formatAmount($withdrawal->fee ?? 0) }}</td>
                        </tr>
                        <tr>
                            <td  >Total:</td>
                            <td>{{ formatAmount($withdrawal->total ?? 0) }}</td>
                        </tr>
                        <tr>
                            <td  >Wallet:</td>
                            <td>{{ $withdrawal->wallet_name }}</td>
                        </tr>
                        <tr>
                            <td  >Wallet Type:</td>
                            <td>{{ $withdrawal->wallet_type }}</td>
                        </tr>

                        @if ($withdrawal->wallet_type == 'crypto')
                        <tr>
                            <td  >Wallet Address:</td>
                            <td>{{ json_decode($withdrawal->info)->wallet_address }}</td>
                        </tr>
                        <tr>
                            <td  >Network Type:</td>
                            <td>{{ json_decode($withdrawal->info)->network_type }}</td>
                        </tr>

                        @elseif ($withdrawal->wallet_type == 'bank')
                        <tr>
                            <td  >Bank Name:</td>
                            <td>{{ json_decode($withdrawal->info)->bank_name }}</td>
                        </tr>
                        <tr>
                            <td  >Account Name:</td>
                            <td>{{ json_decode($withdrawal->info)->account_name }}</td>
                        </tr>
                        <tr>
                            <td  >Account No:</td>
                            <td>{{ json_decode($withdrawal->info)->account_no }}</td>
                        </tr>

                        @else
                        <tr>
                            <td  >Payment Info:</td>
                            <td>{{ json_decode($withdrawal->info)->payment_info }}</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection