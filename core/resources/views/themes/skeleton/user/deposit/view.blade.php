@extends('themes.skeleton.layout.app')
@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        Deposit details
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
                            <td  >Amount:</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td  >Amount:</td>
                            <td>{{ formatAmount($deposit->amount) }}</td>
                        </tr>
                        <tr>
                            <td  >Payment Method:</td>
                            <td>{{ $deposit->method }}</td>
                        </tr>
                        <tr>
                            <td  >Payment Method Amount:</td>
                            <td>{{ $deposit->converted_amount }}{{ $deposit->currency }}</td>
                        </tr>
                        <tr>
                            <td  >Deposit Charge:</td>
                            <td>{{ formatAmount($deposit->charge) }}</td>
                        </tr>
                        <tr>
                            <td  >Status:</td>
                            <td  >{{$deposit->status }}</td>
                        </tr>
                        @if ($deposit->status != 'cancelled')
                        <tr>
                            <td  >Additional Info</td>
                            <td>{{ $deposit->additional_info }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td  >
                                <h2>Payment Screenshot</h2>
                            </td>
                            <td>
                                <div  >
                                    <img   src="{{ route('file', ['deposits', $deposit->payment_screenshot]) }}" alt="Deposit screenshot">
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