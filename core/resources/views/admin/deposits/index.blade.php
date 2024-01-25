@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        All User Deposits
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="w-full py-5">
                <div class="w-full lg:grid lg:grid-cols-3 lg:gap-3 lg:place-content-evenly space-y-3 lg:space-y-0 text-[#bfc9d4]">
                    <div class="lg:col-span-2 flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($deposits->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Total Deposits</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($deposits->where('status', 'approved')->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Approved Deposits</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($deposits->where('status', 'rejected')->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Rejected Deposits</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($deposits->where('status', 'pending')->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Pending Deposits</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center items-center mt-5">
                <div class="w-full flex justify-center items-center lg:w-2/3">
                    <canvas id="myChart" width="100" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            @if ($deposits->count() > 0)
            <form action="{{ route('admin.deposits.action') }}" method="POST">
                @csrf
                <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                    <div class="text-xs lg:text-sm">
                        <label for="action">With Selected:</label>
                    </div>
                    <div>
                        <select name="action" id="action1" class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                            <option value="" selected disabled>Choose Action</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Go
                        </button>
                    </div>
                </div>
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="all" id="all"></th>
                            <th></th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Method Amount</th>
                            <th>Charge</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($deposits as $deposit)
                        <tr>
                            <td><input type="checkbox" name="ids[]" id="{{ 'id'.$deposit->id }}" class="checkSingle" value="{{ $deposit->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td>
                            <td><a class="underline" href="{{ route('admin.users.view', $deposit->user_id) }}">{{ adminUser($deposit->user_id, 'first_name') }} {{ adminUser($deposit->user_id, 'last_name') }}</a></td>
                            <td>{{ formatAmount($deposit->amount) }}</td>
                            <td>{{ $deposit->method }}</td>
                            <td>{{ strtoupper($deposit->currency) }} | {{ $deposit->converted_amount }}</td>
                            <td>{{ formatAmount($deposit->charge) }}</td>
                            <td class="@if($deposit->status == 'approved') text-green-600 @elseif($deposit->status == 'pending') text-orange-600 @else text-red-600 @endif">{{ $deposit->status }}</td>

                            <td class="inline-flex space-x-3 md:space-x-5">
                                <a href="{{ route('admin.deposits.view', $deposit->id) }}">
                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a role="button" data-title="Deposit" class="delete_btn" data-value="{{ $deposit->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </td>


                        </tr>

                        @endforeach
                    </tbody>

                </table>
                <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                    <div class="text-xs lg:text-sm">
                        <label for="action">With Selected:</label>
                    </div>
                    <div>
                        <select name="action" id="action2" class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                            <option value="" selected disabled>Choose Action</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Go
                        </button>
                    </div>
                </div>
            </form>

            {{--  delete form --}}

            <form action="{{ route('admin.deposits.delete') }}" method="post" id="deleteForm">
                @csrf
                <input type="hidden" name="id" id="id" placeholder="Deposit Id">
            </form>



            @else
            {{-- disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Empty Record! </b> There are no deposit record found.
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
    let totalDeposits = "{{ $deposits->count() }}"
    let approvedDeposits = "{{ $deposits->where('status', 'approved')->count() }}"
    let rejectedDeposits = "{{ $deposits->where('status', 'rejected')->count() }}"
    let pendingDeposits = "{{ $deposits->where('status', 'pending')->count() }}"
    const data = {
        labels: [
            'TOTAL DEPOSITS',
            'APPROVED DEPOSITS',
            'REJECTED DEPOSITS',
            'PENDING DEPOSITS',
        ],
        datasets: [{
            type: 'pie',
            label: "Total Deposits",
            data: [parseInt(totalDeposits)],
            backgroundColor: ['rgb(46, 112, 55)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Approved Deposits",
            data: [0, parseInt(approvedDeposits)],
            backgroundColor: ['rgb(78, 58, 170)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Rejected Deposits",
            data: [0, 0, parseInt(rejectedDeposits)],
            backgroundColor: ['rgba(223, 151, 43, 0.99)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Pending Deposits",
            data: [0, 0, 0, parseInt(pendingDeposits)],
            backgroundColor: ['rgb(165, 79, 40)'],
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