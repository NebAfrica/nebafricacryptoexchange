@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        my Transfers
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

@section('infographics')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-4">
            <div class="w-full py-5">
                <div class="w-full lg:flex lg:justify-evenly lg:space-x-2 space-y-3 lg:space-y-0 text-[#bfc9d4]">
                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-blue-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($total_transfers_value) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Total transfers</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-blue-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-green-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($incoming_transfers_value) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Incoming transfers</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-green-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-red-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($outgoing_transfers_value) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Outgoing transfers</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-red-600 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($transfers->count() > 0)
                <div class="w-full flex justify-center items-center mt-5">
                    <div class="w-full flex justify-center items-center lg:w-2/3">
                        <canvas id="myChart" width="100" height="100"></canvas>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection


@section('content')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            @if ($transfers->count() > 0)
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Amount</th>
                            <th>Transfer ID</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @forelse ($transfers as $transfer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($transfer->created_at)) }}</td>
                            <td>
                                @if ($transfer->sender_id == user('id'))
                                <div class="flex space-x-1 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                    </svg>
                                    <h5>Outgoing</h5>
                                </div>
                                @else
                                <div class="flex space-x-1 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                    </svg>
                                    <h5>Incoming</h5>
                                </div>
                                @endif
                            </td>
                            <td>{{ adminUser($transfer->sender_id, 'account_id') }}</td>
                            <td>{{ adminUser($transfer->receiver_id, 'account_id') }}</td>
                            <td>{{ formatAmount($transfer->amount) }}</td>
                            <td>{{ $transfer->txn_id }}</td>
                            <td>{{ $transfer->status }}</td>
                            <td class="inline-flex space-x-3 md:space-x-5">
                                <a href="{{ route('user.transfer.view', $transfer->txn_id) }}">
                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">No transfer history found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            @else 
                {{--  disclaimer notification --}}
                <div class="w-full p-6 md:p-10 flex justify-center">
                    <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                        <div class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>
                        <div>
                            <b class="font-medium">Empty Record! </b> You haven't made any transfers.
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
    let incomingXfer = "{{ $incoming_transfers_count }}"
    let outgoingXfer = "{{ $outgoing_transfers_count }}"
    let totalXfer = "{{ $total_transfers_count }}"
    const data = {
        labels: [
            'ALL',
            'INCOMING',
            'OUTGOING',
        ],
        datasets: [{
            type: 'pie',
            label: "ALL",
            data: [parseInt(parseInt(totalXfer))],
            backgroundColor: ['rgb(69,100,153)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "ACTIONS",
            data: [0, parseInt(incomingXfer), parseInt(outgoingXfer)],
            backgroundColor: [
                'rgb(0, 0, 0)',
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