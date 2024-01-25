@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        my Transactions
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

@section('infographics')
<div  >
    <div  >
        <div  >
            <div  >
                <div  >

                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.9">
                                    <path d="M16 12h2v4h-2z"></path>
                                    <path d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM5 5h13v2H5a1.001 1.001 0 0 1 0-2zm15 14H5.012C4.55 18.988 4 18.805 4 18V8.815c.314.113.647.185 1 .185h15v10z"></path>
                                </svg>
                            </div>
                        </div>
                        <div  >
                            <div>
                                <h2  >{{ formatAmount($total_credits) }}</h2>
                            </div>
                            <div  >
                                <h4  >Total credit</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.9">
                                    <path d="M16 12h2v4h-2z"></path>
                                    <path d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM5 5h13v2H5a1.001 1.001 0 0 1 0-2zm15 14H5.012C4.55 18.988 4 18.805 4 18V8.815c.314.113.647.185 1 .185h15v10z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.9">
                                    <path d="M12 15c-1.84 0-2-.86-2-1H8c0 .92.66 2.55 3 2.92V18h2v-1.08c2-.34 3-1.63 3-2.92 0-1.12-.52-3-4-3-2 0-2-.63-2-1s.7-1 2-1 1.39.64 1.4 1h2A3 3 0 0 0 13 7.12V6h-2v1.09C9 7.42 8 8.71 8 10c0 1.12.52 3 4 3 2 0 2 .68 2 1s-.62 1-2 1z"></path>
                                    <path d="M5 2H2v2h2v17a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4h2V2H5zm13 18H6V4h12z"></path>
                                </svg>
                            </div>
                        </div>
                        <div  >
                            <div>
                                <h2  >{{ formatAmount($total_debits) }}</h2>
                            </div>
                            <div  >
                                <h4  >Total debit</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.9">
                                    <path d="M12 15c-1.84 0-2-.86-2-1H8c0 .92.66 2.55 3 2.92V18h2v-1.08c2-.34 3-1.63 3-2.92 0-1.12-.52-3-4-3-2 0-2-.63-2-1s.7-1 2-1 1.39.64 1.4 1h2A3 3 0 0 0 13 7.12V6h-2v1.09C9 7.42 8 8.71 8 10c0 1.12.52 3 4 3 2 0 2 .68 2 1s-.62 1-2 1z"></path>
                                    <path d="M5 2H2v2h2v17a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4h2V2H5zm13 18H6V4h12z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @if ($transactions->count() > 0)
                <div  >
                    <div  >
                        <canvas id="myChart" width="100" height="100"></canvas>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection

@section('content')
<div  >
    <div  >
        <div  >
            @if ($transactions->count() > 0)
                <table id="datatable-skeleton-table"  >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Bal</th>
                            <th>Remark</th>
                            <th>TXN ID</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($transaction->created_at)) }}</td>
                            <td  credit") ? "text-green-600" : "text-red-600"; ?>">{{ $transaction->type }}</td>
                            <td>{{ formatAmount($transaction->amount) }}</td>
                            <td>{{ $transaction->method }}</td>
                            <td>{{ formatAmount($transaction->balance_after_transaction) }}</td>
                            <td>{{ $transaction->remark }}</td>
                            <td>{{ $transaction->txn_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
                {{-- disclaimer notification --}}
                <div  >
                    <div  >
                        <div  >
                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>
                        <div>
                            <b  >Empty Record! </b> You haven't made any investments.
                        </div>
                    </div>
                </div> 
            @endif

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let debitVal = "{{ $debits_count }}"
    let creditVal = "{{ $credits_count }}"
    const data = {
        labels: ["CREDITS", "DEBITS"],
        datasets: [{
            label: "TRANSACTIONS",
            data: [parseInt(creditVal), parseInt(debitVal)],
            backgroundColor: ['rgb(0, 200, 81)', 'rgb(204, 0, 0)'],
            hoverOffset: 2
        }]
    };
    const config = {
        type: "pie",
        data: data,
        options: {
            layout: {
                padding: 20
            }
        }
    };
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, config)
</script>

@endsection
