@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        my deposit
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
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2  >{{ formatAmount($total_deposits_value) }}</h2>
                            </div>
                            <div  >
                                <h4  >Total deposits</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path d="M15.566 11.021A7.016 7.016 0 0 0 19 5V4h1V2H4v2h1v1a7.016 7.016 0 0 0 3.434 6.021c.354.208.566.545.566.9v.158c0 .354-.212.69-.566.9A7.016 7.016 0 0 0 5 19v1H4v2h16v-2h-1v-1a7.014 7.014 0 0 0-3.433-6.02c-.355-.21-.567-.547-.567-.901v-.158c0-.355.212-.692.566-.9zm-1.015 3.681A5.008 5.008 0 0 1 17 19v1H7v-1a5.01 5.01 0 0 1 2.45-4.299c.971-.573 1.55-1.554 1.55-2.622v-.158c0-1.069-.58-2.051-1.551-2.623A5.008 5.008 0 0 1 7 5V4h10v1c0 1.76-.938 3.406-2.449 4.298C13.58 9.87 13 10.852 13 11.921v.158c0 1.068.579 2.049 1.551 2.623z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2  >{{ formatAmount($pending_deposits_value) }}</h2>
                            </div>
                            <div  >
                                <h4  >Pending deposits</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path d="M15.566 11.021A7.016 7.016 0 0 0 19 5V4h1V2H4v2h1v1a7.016 7.016 0 0 0 3.434 6.021c.354.208.566.545.566.9v.158c0 .354-.212.69-.566.9A7.016 7.016 0 0 0 5 19v1H4v2h16v-2h-1v-1a7.014 7.014 0 0 0-3.433-6.02c-.355-.21-.567-.547-.567-.901v-.158c0-.355.212-.692.566-.9zm-1.015 3.681A5.008 5.008 0 0 1 17 19v1H7v-1a5.01 5.01 0 0 1 2.45-4.299c.971-.573 1.55-1.554 1.55-2.622v-.158c0-1.069-.58-2.051-1.551-2.623A5.008 5.008 0 0 1 7 5V4h10v1c0 1.76-.938 3.406-2.449 4.298C13.58 9.87 13 10.852 13 11.921v.158c0 1.068.579 2.049 1.551 2.623z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2  >{{ formatAmount($approved_deposits_value) }}</h2>
                            </div>
                            <div  >
                                <h4  >Approved deposits</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div  >
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2  >{{ formatAmount($rejected_deposits_value) }}</h2>
                            </div>
                            <div  >
                                <h4  >Rejected deposits</h4>
                            </div>
                        </div>
                        <div  >
                            <div  >
                                <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ( $deposits->count() > 0 )
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
            @if ($deposits->count() > 0)
                <table id="datatable-skeleton-table"  >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($deposits as $deposit)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td>
                            <td>{{ formatAmount($deposit->amount) }}</td>
                            <td>{{ $deposit->method }}</td>
                            <td>{{ $deposit->status }}</td>
                            <td  >
                                <a href="deposits/view/{{ user('id') }}/{{ $deposit->id }}">
                                    <svg xmlns=" http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
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
                            <b  >Empty Record! </b> You haven't made any deposit yet.
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
    let pendingVal = "{{$pending_deposits_count}}"
    let approvedVal = "{{$approved_deposits_count}}"
    let rejectedVal = "{{$rejected_deposits_count}}"
    let totalVal = "{{$total_deposits_count}}"
    const data = {
        labels: [
            'ALL',
            'PENDING',
            'APPROVED',
            'REGECTED'
        ],
        datasets: [{
            type: 'pie',
            label: "ALL",
            data: [parseInt(parseInt(totalVal))],
            backgroundColor: ['rgb(69,100,153)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "ACTIONS",
            data: [0, parseInt(pendingVal), parseInt(approvedVal), parseInt(rejectedVal)],
            backgroundColor: [
                'rgb(0, 0, 0)',
                'rgb(255, 136, 0)',
                'rgb(0, 200, 81)',
                'rgb(204, 0, 0)'
            ],
            hoverOffset: 2
        }, ]
    };
    const config = {
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