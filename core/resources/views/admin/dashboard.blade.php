@extends('admin.layout.app')

@section('content')


    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                <div class="">
                    <div class="">
                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <div class="w-full md:flex md:justify-between md:space-x-5">
                                    {{--  Wallet Balance --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full">
                                            <div class="w-full flex justify-end mb-2">
                                                <div>
                                                    <h3 class="font-medium">Cumulative Users Balance</h3>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <img src="{{ asset('public/assets/imgs/custom-icons/wallet.png') }}"
                                                        alt="wallet balance" width="40px" class="rounded-full">
                                                </div>
                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                    <h2 class="font-lg">{{ formatAmount($users->sum('account_bal')) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{--  Wallet Balance --}}

                                    {{--  Deposit --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full div-url" role="button"
                                            data-url="{{ route('admin.deposits.index') }}">
                                            <div class="w-full flex justify-end mb-2">
                                                <div>
                                                    <h3 class="font-medium">Total Deposits</h3>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <img src="{{ asset('public/assets/imgs/custom-icons/deposit.png') }}"
                                                        alt="wallet balance" width="40px" class="rounded-full">
                                                </div>
                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                    <h2 class="font-lg">{{ formatAmount($deposits->sum('amount')) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{--  Deposit --}}

                                    {{--  Withdrawal --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full div-url" role="button"
                                            data-url="{{ route('admin.withdrawals.index') }}">
                                            <div class="w-full flex justify-end mb-2">
                                                <div>
                                                    <h3 class="font-medium">Total Withdrawals</h3>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <img src="{{ asset('public/assets/imgs/custom-icons/withdraw.png') }}"
                                                        alt="wallet balance" width="40px" class="rounded-full">
                                                </div>
                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                    <h2 class="font-lg">{{ formatAmount($withdrawals) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="w-full md:flex md:justify-between md:space-x-5">
                                    {{--  Earnings --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full div-url" role="button"
                                            data-url="{{ route('admin.transactions.index') }}">
                                            <div class="w-full flex justify-end mb-2">
                                                <div>
                                                    <h3 class="font-medium">Total Earnings</h3>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <img src="{{ asset('public/assets/imgs/custom-icons/earning.png') }}"
                                                        alt="wallet balance" width="40px" class="rounded-full">
                                                </div>
                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                    <h2 class="font-lg">{{ formatAmount($earnings) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{--  Earnings --}}

                                    {{--  Investments --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full div-url" role="button"
                                            data-url="{{ route('admin.investments.index') }}">
                                            <div class="w-full flex justify-end mb-2">
                                                <div>
                                                    <h3 class="font-medium">Total Investments</h3>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <img src="{{ asset('public/assets/imgs/custom-icons/invest.png') }}"
                                                        alt="wallet balance" width="40px" class="rounded-full">
                                                </div>
                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                    <h2 class="font-lg">{{ formatAmount($investments) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{--  Investments --}}
                                    @if (websiteInfo('balance_transfer') == 'enabled' && isAddonEnabled('p2ptransfer'))
                                        {{--  Transfers --}}
                                        <div
                                            class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div class="w-full div-url" role="button"
                                                data-url="{{ route('admin.transfers.pending') }}">
                                                <div class="w-full flex justify-end mb-2">
                                                    <div>
                                                        <h3 class="font-medium">Pending Transfers</h3>
                                                    </div>
                                                </div>

                                                <div class="w-full flex justify-between">
                                                    <div>
                                                        <img src="{{ asset('public/assets/imgs/custom-icons/transfer.png') }}"
                                                            alt="wallet balance" width="40px" class="rounded-full">
                                                    </div>
                                                    <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                        <h2 class="font-lg">{{ number_format(getTransfers()->where('status', 'pending')->count(), 0) }}</h2>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        {{--  transfers --}}
                                    @endif
                                </div>

                                <div class="w-full md:flex md:justify-between md:space-x-5">
                                    
                                    @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
                                        {{--  loans --}}
                                        <div
                                            class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div class="w-full div-url" role="button"
                                                data-url="{{ route('admin.loans.index') }}">
                                                <div class="w-full flex justify-end mb-2">
                                                    <div>
                                                        <h3 class="font-medium">Total Loans</h3>
                                                    </div>
                                                </div>

                                                <div class="w-full flex justify-between">
                                                    <div>
                                                        <img src="{{ asset('public/assets/imgs/custom-icons/earning.png') }}"
                                                            alt="wallet balance" width="40px" class="rounded-full">
                                                    </div>
                                                    <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                        <h2 class="font-lg">{{ formatAmount(getLoans()->sum('amount')) }}</h2>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        {{--  loans --}}

                                    @endif

                                    {{--  referrals --}}
                                    <div
                                        class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full div-url" role="button"
                                            data-url="{{ route('admin.users.index') }}">
                                            <div class="w-full flex justify-end mb-2">
                                                <div>
                                                    <h3 class="font-medium">Users</h3>
                                                </div>
                                            </div>

                                            <div class="w-full flex justify-between">
                                                <div>
                                                    <img src="{{ asset('public/assets/imgs/custom-icons/referral.png') }}"
                                                        alt="wallet balance" width="40px" class="rounded-full">
                                                </div>
                                                <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                    <h2 class="font-lg">{{ number_format($users->count(), 0) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    {{--  Investments --}}

                                    {{--  Tickets --}}
                                    @if (isAddonEnabled('supportticket'))
                                        <div
                                            class="w-full flex justify-start items-center space-x-2  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                            <div class="w-full div-url" role="button"
                                                data-url="{{ route('admin.tickets.index') }}">
                                                <div class="w-full flex justify-end mb-2">
                                                    <div>
                                                        <h3 class="font-medium">Tickets</h3>
                                                    </div>
                                                </div>

                                                <div class="w-full flex justify-between">
                                                    <div>
                                                        <img src="{{ asset('public/assets/imgs/custom-icons/ticket.png') }}"
                                                            alt="wallet balance" width="40px" class="rounded-full">
                                                    </div>
                                                    <div class="w-full flex justify-end bg-gray-500 p-2 rounded ml-2">
                                                        <h2 class="font-lg">{{ number_format(getTickets()->count(), 0) }}</h2>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    @endif
                                    {{--  tickets --}}
                                </div>
                            </div>



                        </div>
                    </div>


                    {{--  end of summaries --}}

                    {{--  recent signups starts here --}}

                    <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                        <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="w-full flex justify-between">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    Recent Registration
                                </h2>
                                <a href="{{ route('admin.users.index') }}"
                                    class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                    View All
                                </a>
                            </div>

                            <hr class="w-full border-b border-dotted border-gray-600 border mb-4 mt-2">

                            @if ($users->count() > 0)
                                <table class="datatable-skeleton-table text-[#bfc9d4] text-xs md:text-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody width="100%">
                                        @foreach ($users->take(5) as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->account_id }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ formatAmount($user->account_bal) }}</td>
                                                <td
                                                    class="@if ($user->status == 'active') text-green-500 @else text-red-500 @endif">
                                                    {{ $user->status }}</td> {{--  acitve / suspended --}}
                                                <td class="inline-flex space-x-2 md:space-x-4">
                                                    <a href="{{ route('admin.users.view', $user->id) }}"
                                                        title="View user info">
                                                        <svg xmlns=" http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-blue-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        title="Edit user info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 text-orange-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                    </a>
                                                    @if ($user->status == 'active')
                                                        <a role="button" class="status_button" data-action="suspend"
                                                            data-user_id="{{ $user->id }}" title="Suspend user">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5 text-gray-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <a role="button" class="status_button" data-action="reactivate"
                                                            data-user_id="{{ $user->id }}"
                                                            title="Reactivate suspended user">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5 text-green-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('admin.users.email') . '?email=' . urlencode($user->email) . '&return_url=' . urlencode(url()->current()) }}"
                                                        title="Send email">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 text-sky-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                                        </svg>
                                                    </a>
                                                    <a role="button" class="delete_btn"
                                                        data-value="{{ $user->id }}" title="Delete user"
                                                        data-title="User">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-5 w-5 text-red-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{--  suspend / activate form --}}
                                <form action="{{ route('admin.users.status') }}" id="statusForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" id="status_action" value="">
                                    <input type="hidden" name="user_id" id="status_user_id" value="">

                                </form>

                                {{--  Delete forms here --}}
                                <form action="{{ route('admin.users.delete') }}" id="deleteForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" id="id" value="">
                                </form>
                                {{--  delete forms ends here --}}
                            @else
                                {{-- disclaimer notification --}}
                                <div class="w-full p-6 md:p-10 flex justify-center">
                                    <div
                                        class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                        <div class="text-orange-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                            </svg>
                                        </div>
                                        <div>
                                            <b class="font-medium">Empty Record! </b> You haven't made any deposit yet.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{--  recent signups ends here --}}

                    {{--  recent deposits starts here --}}

                    <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                        <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="w-full flex justify-between">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    Recent Deposits
                                </h2>
                                <a href="{{ route('admin.deposits.index') }}"
                                    class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                    View All
                                </a>
                            </div>

                            <hr class="w-full border-b border-dotted border-gray-600 border mb-4 mt-2">

                            @if ($deposits->count() > 0)
                                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
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
                                        @foreach ($deposits->take(5) as $deposit)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td>
                                                <td>{{ formatAmount($deposit->amount) }}</td>
                                                <td>{{ $deposit->method }}</td>
                                                <td>{{ $deposit->status }}</td>
                                                <td class="inline-flex space-x-3 md:space-x-5">
                                                    <a href="{{ route('admin.deposits.view', $deposit->id)  }}">
                                                        <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                {{-- disclaimer notification --}}
                                <div class="w-full p-6 md:p-10 flex justify-center">
                                    <div
                                        class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                        <div class="text-orange-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                            </svg>
                                        </div>
                                        <div>
                                            <b class="font-medium">Empty Record! </b> You haven't made any deposit yet.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{--  recent deposits ends here --}}
                </div>





            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.datatable-skeleton-table').DataTable({
                scrollX: true,
                "sScrollXInner": "100%",
            });

            $('#datatable-skeleton-table-2').DataTable({
                scrollX: true,
                "sScrollXInner": "100%",
            });

            $(".dataTables_wrapper .dataTables_length").hide();
            $('.dataTables_filter').hide();
            $('.dataTables_info').hide();
            $('.dataTables_paginate').hide();


        });

        //suspend / reactivate user
        $('.status_button').on('click', function() {
            var user_id = $(this).data('user_id');
            var action = $(this).data('action');
            $('#status_user_id').val(user_id);
            $('#status_action').val(action);
            Swal.fire({
                title: action + ' User!',
                text: "Do you want to " + action + " this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + action,
                background: "#0e1726",
                color: "#d1d5db",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("statusForm").submit();
                }
            });
        });

        // url trigger
        $('.div-url').click(function() {
            window.location.href = $(this).data('url');
        });
    </script>

@endsection
