@extends('themes.skeleton.layout.app')




@section('content')
    <div  >
        <div  >
            <div  >
                <div  ">
                        <div  >
                            <div  >
                                <div
                                     >
                                    <h2  >
                                        Hi {{ user('first_name') }}
                                    </h2>


                                    <div  >
                                        <a href="{{ route('user.investments.new') }}"
                                             >

                                            START INVESTING
                                        </a>
                                    </div>


                                </div>
                            </div>
                            <div  >
                                <div  >
                                    <div
                                         >

                                        <a  
                                            href="{{ route('user.deposit.new') }}">
                                            <svg   fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                            </svg>
                                            <h6>Deposit</h6>
                                        </a>
                                        <a  
                                            href="{{ route('user.investments.new') }}">
                                            <svg   fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                                </path>
                                            </svg>
                                            <h6>Invest</h6>
                                        </a>

                                        @if (websiteInfo('loan') == 'enabled')
                                            <a  
                                                href="{{ route('user.loan.new') }}">
                                                <svg   fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z">
                                                    </path>
                                                </svg>
                                                <h6>Borrow</h6>
                                            </a>

                                        @endif

                                        <a  
                                            href="{{ route('user.withdrawals.new') }}">
                                            <svg   fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                            </svg>
                                            <h6>Withdraw</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div  >
                            <div  >
                                <div  >
                                    {{--  Wallet Balance --}}
                                    <div
                                         >
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/wallet.png') }}"
                                                alt="wallet balance" width="40px"  >
                                        </div>
                                        <div  >
                                            <div  >
                                                <div>
                                                    <h3  >Account Balance</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.deposit.new') }}"
                                                         >
                                                        TOP UP
                                                    </a>
                                                </div>
                                            </div>

                                            <div  >
                                                <h2  >{{ formatAmount(user('account_bal')) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    {{--  Wallet Balance --}}

                                    {{--  Deposit --}}
                                    <div
                                         >
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/deposit.png') }}"
                                                alt="deposits" width="40px"  >
                                        </div>
                                        <div  >
                                            <div  >
                                                <div>
                                                    <h3  >Deposit</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.deposit.index') }}"
                                                         >
                                                        VIEW ALL
                                                    </a>
                                                </div>
                                            </div>

                                            <div  >
                                                <h2  >{{ formatAmount($deposits->sum('amount')) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    {{--  Deposit --}}

                                    {{--  Withdrawal --}}
                                    <div
                                         >
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/withdraw.png') }}"
                                                alt="withdrawals" width="40px"  >
                                        </div>
                                        <div  >
                                            <div  >
                                                <div>
                                                    <h3  >Withdrawals</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.withdrawals.index') }}"
                                                         >
                                                        VIEW ALL
                                                    </a>
                                                </div>
                                            </div>

                                            <div  >
                                                <h2  >{{ formatAmount($withdrawals->sum('amount')) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div  >
                                    {{--  Earnings --}}
                                    <div
                                         >
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/earning.png') }}"
                                                alt="withdrawals" width="40px"  >
                                        </div>
                                        <div  >
                                            <div  >
                                                <div>
                                                    <h3  >ROI</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.transactions') }}"
                                                         >
                                                        VIEW ALL
                                                    </a>
                                                </div>
                                            </div>

                                            <div  >
                                                <h2  >{{ formatAmount($earnings) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    {{--  Earnings --}}

                                    {{--  Investments --}}
                                    <div
                                         >
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/invest.png') }}"
                                                alt="investments" width="40px"  >
                                        </div>
                                        <div  >
                                            <div  >
                                                <div>
                                                    <h3  >Investments</h3>
                                                </div>
                                                <div>
                                                    <a href="{{ route('user.investments.new') }}"
                                                         >
                                                        INVEST
                                                    </a>
                                                </div>
                                            </div>

                                            <div  >
                                                <h2  >{{ formatAmount($investments->sum('amount')) }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    {{--  Investments --}}

                                    @if (websiteInfo('balance_transfer') == 'enabled' && isAddonEnabled('p2ptransfer'))
                                        {{--  Transfers --}}
                                        <div
                                             >
                                            <div>
                                                <img src="{{ asset('public/assets/imgs/custom-icons/transfer.png') }}"
                                                    alt="transfers" width="40px"  >
                                            </div>
                                            <div  >
                                                <div  >
                                                    <div>
                                                        <h3  >Transfers</h3>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('user.transfer.index') }}"
                                                             >
                                                            View All
                                                        </a>
                                                    </div>
                                                </div>

                                                <div  >
                                                    <h2  >{{ formatAmount(getTransfers(user('id'))->sum('amount')) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                        {{--  Transfers --}}
                                    
                                    @endif
                                </div>

                                <div  >
                                    @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
                                        {{--  loans --}}
                                        <div
                                             >
                                            <div>
                                                <img src="{{ asset('public/assets/imgs/custom-icons/loan.png') }}"
                                                    alt="loans" width="40px"  >
                                            </div>
                                            <div  >
                                                <div  >
                                                    <div>
                                                        <h3  >Loans</h3>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('user.loan.new') }}"
                                                             >
                                                            APPLY
                                                        </a>
                                                    </div>
                                                </div>

                                                <div  >
                                                    <h2  >{{ formatAmount(getLoans(user('id'))->sum('amount')) }}</h2>
                                                </div>
                                            </div>

                                        </div>

                                        {{--  loans --}}

                                    @endif

                                    {{--  referrals --}}
                                    <div
                                         >
                                        <div>
                                            <img src="{{ asset('public/assets/imgs/custom-icons/referral.png') }}"
                                                alt="referrals" width="40px"  >
                                        </div>
                                        <div  >
                                            <div  >
                                                <div>
                                                    <h3  >Referrals</h3>
                                                </div>
                                                <div>
                                                    <div id="toCopyDiv"></div>
                                                    <a role="button" id="referral_link"
                                                        data-link="{{ route('ref', ['code' => user('account_id')]) }}"
                                                         >
                                                        COPY LINK
                                                    </a>
                                                </div>
                                            </div>

                                            <div  >
                                                <h2  >{{ $referrals->count() }}</h2>
                                            </div>
                                        </div>

                                    </div>

                                    {{--  Investments --}}

                                    {{--  Tickets --}}
                                    @if (isAddonEnabled('supportticket'))
                                        <div
                                             >
                                            <div>
                                                <img src="{{ asset('public/assets/imgs/custom-icons/ticket.png') }}"
                                                    alt="transfers" width="40px"  >
                                            </div>
                                            <div  >
                                                <div  >
                                                    <div>
                                                        <h3  >Tickets</h3>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('user.tickets.new') }}"
                                                             >
                                                            CREATE
                                                        </a>
                                                    </div>
                                                </div>

                                                <div  >
                                                    <h2  >{{ getTickets(user('id'))->count() }}</h2>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                    {{--  support tickets --}}
                                </div>
                            </div>



                        </div>
                    </div>



                    <div  >
                        <div  >
                            <div  >
                                <h2  >
                                    Recent Transactions
                                </h2>
                                <a href="{{ route('user.transactions') }}"
                                     >
                                    View All
                                </a>
                            </div>

                            <hr  >

                            @if ($transactions->count() > 0)
                                <table    >
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
                                        @foreach ($transactions->take(5) as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($transaction->created_at)) }}</td>
                                                <td  >
                                                    {{ $transaction->type }}</td>
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
                                    <div
                                         >
                                        <div  >
                                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
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

                    <div  >
                        <div  >
                            <div  >
                                <h2  >
                                    Recent Deposits
                                </h2>
                                <a href="{{ route('user.deposit.index') }}"
                                     >
                                    View All
                                </a>
                            </div>

                            <hr  >

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
                                        @foreach ($deposits->take(5) as $deposit)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td>
                                                <td>{{ formatAmount($deposit->amount) }}</td>
                                                <td>{{ $deposit->method }}</td>
                                                <td>{{ $deposit->status }}</td>
                                                <td  >
                                                    <a href="deposits/view/{{ user('id') }}/{{ $deposit->id }}">
                                                        <svg xmlns=" http://www.w3.org/2000/svg"  
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
                                <div  >
                                    <div
                                         >
                                        <div  >
                                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
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


                    <div  >
                        <div  >
                            <div  >
                                <h2  >
                                    Recent Withdrawals
                                </h2>
                                <a href="{{ route('user.withdrawals.index') }}"
                                     >
                                    View All
                                </a>
                            </div>

                            <hr  >

                            @if ($withdrawals->count() > 0)
                                <table id="datatable-skeleton-table"  >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Wallet</th>
                                            <th>Amount</th>
                                            <th>Fee</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody width="100%">
                                        @forelse ($withdrawals->take(5) as $withdrawal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ date('d.m.Y H:i:s', strtotime($withdrawal->created_at)) }}</td>
                                                <td>{{ $withdrawal->wallet_name }}</td>
                                                <td>{{ formatAmount($withdrawal->amount) }}</td>
                                                <td>{{ formatAmount($withdrawal->fee) }}</td>
                                                <td>{{ formatAmount($withdrawal->total) }}</td>
                                                <td>{{ $withdrawal->status }}</td>
                                                <td  >
                                                    <a href="{{ route('user.withdrawals.view', $withdrawal->id) }}">
                                                        <svg xmlns=" http://www.w3.org/2000/svg"  
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
                                        @empty
                                            <tr>
                                                <td colspan="7">You haven't made any withdrawals yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            @else
                                {{-- disclaimer notification --}}
                                <div  >
                                    <div
                                         >
                                        <div  >
                                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                            </svg>
                                        </div>
                                        <div>
                                            <b  >Empty Record! </b> You haven't made any withdrawals.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

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


            $('#referral_link').on('click', function() {
                var hiddenInput = '<input type="text" name="" value="" id="toCopy">';
                $('#toCopyDiv').html(hiddenInput);
                $('#toCopy').val($(this).data('link'));
                let elemToCopy = $('#toCopy');
                elemToCopy.select();
                document.execCommand("copy");

                Swal.fire({
                    title: '',
                    text: "Copied to clipboard",
                    icon: 'success',
                    background: "#0e1726",
                    color: "#d1d5db",
                    
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#toCopyDiv').html('');
                    }
                });
            });

        });
    </script>
@endsection
