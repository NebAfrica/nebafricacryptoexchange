@extends('admin.layout.app')
@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            All Transactions
                        </h2>
                    </div>

                    <div>
                        <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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
    {{--  The infograpics for this page are  --}}
    {{--  Info graphics for this page are;
1. Total Transactions: {{ $all->count() }} | {{ formatAmount($all->sum('amount') }}
2. Total Credits : {{ $all->where('type', 'credit')->count() }} | {{ formatAmount($all->where('type', 'credit')->sum('amount')) }}
3. Total Debits : {{ $all->where('type', 'debit')->count() }} | {{ formatAmount($all->where('type', 'debit')->sum('amount')) }}

4. A piechart indicating no. 2, 3 --}}
@endsection

@section('content')

    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-10/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

                @if ($transactions->count() > 0)
                    <form action="{{ route('admin.transactions.action') }}" method="POST">
                        @csrf

                        <hr class="w-full border-b border-dotted border-gray-600 border">
                        <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                            <div class="text-xs lg:text-sm">
                                <label for="action">With Selected:</label>
                            </div>
                            <div>
                                <select name="action" id="action1"
                                    class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                                    <option value="" selected disabled>Choose Action</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit"
                                    class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                    Go
                                </button>
                            </div>
                        </div>
                        <hr class="w-full border-b border-dotted border-gray-600 border .mb-4">
                        <div class="mb-4"></div>

                        <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="all"></th>
                                    <th></th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Balance</th>
                                    <th>Remark</th>
                                    <th>TXN ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody width="100%">
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td><input type="checkbox" name="transaction_ids[]" class="checkSingle"
                                                id="" value="{{ $transaction->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d.m.Y H:i:s', strtotime($transaction->created_at)) }}</td>
                                        <td><a
                                                href="{{ route('admin.users.view', $transaction->user_id) }}">{{ adminUser($transaction->user_id, 'account_id') }}</a>
                                        </td>
                                        <td>{{ $transaction->type }}</td>
                                        <td>{{ formatAmount($transaction->amount) }}</td>
                                        <td>{{ $transaction->method }}</td>
                                        <td>{{ formatAmount($transaction->balance_after_transaction) }}</td>
                                        <td>{{ $transaction->remark }}</td>
                                        <td>{{ $transaction->txn_id }}</td>
                                        <td class="inline-flex space-x-3 md:space-x-5">
                                            <a role="button" id="{{ 'deleteTransaction' . $transaction->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="mb-4"></div>
                        <hr class="w-full border-b border-dotted border-gray-600 border .mb-4">

                        <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                            <div class="text-xs lg:text-sm">
                                <label for="action">With Selected:</label>
                            </div>
                            <div>
                                <select name="action" id="action1"
                                    class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                                    <option value="" selected disabled>Choose Action</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit"
                                    class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                    Go
                                </button>
                            </div>
                        </div>
                        <hr class="w-full border-b border-dotted border-gray-600 border .mb-4">
                    </form>
                    {{--  Delete forms here --}}
                    @foreach ($transactions as $transaction)
                        <form action="{{ route('admin.transactions.delete', $transaction->id) }}"
                            id="{{ 'deleteTransactionForm' . $transaction->id }}" method="POST">
                            @csrf
                        </form>
                    @endforeach
                    {{--  delete forms ends here --}}
                @else
                    {{-- disclaimer notification --}}
                    <div class="w-full p-6 md:p-10 flex justify-center">
                        <div
                            class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">Empty Record! </b> There are no transaction records found.
                            </div>
                        </div>
                    </div>
                @endif



            </div>
        </div>
    </div>

@endsection

@section('script')
    @foreach ($transactions as $transaction)
        <script>
            //Delete Transaction
            $(document).ready(function() {
                $("{{ '#deleteTransaction' . $transaction->id }}").click(function() {
                    Swal.fire({
                        title: 'Delete Transaction!',
                        text: "Do you want to delete this transaction? It can't be reversed",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1b2e4b',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Delete',
                        background: "#0e1726",
                        color: "#d1d5db",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById("{{ 'deleteTransactionForm' . $transaction->id }}")
                                .submit();
                        }
                    });
                });
            });
        </script>
    @endforeach
@endsection
