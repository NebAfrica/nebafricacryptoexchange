@extends('admin.layout.app')
@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            View Withdrawal
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

@section('content')
    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

                <div class="flex justify-end">
                    <div class="flex justify-between space-x-1">
                        @if (request()->is('admin/withdrawals/pending'))
                            <a href="{{ route('admin.withdrawals.index') }}"
                                class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>View All</span>
                            </a>
                        @elseif (request()->is('admin/withdrawals'))
                            <a href="{{ route('admin.withdrawals.pending') }}"
                                class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                <span>View Pending</span>
                            </a>
                        @else
                            <a href="{{ route('admin.withdrawals.index') }}"
                                class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                <span>All Withdrawals</span>
                            </a>
                            <a href="{{ route('admin.withdrawals.pending') }}"
                                class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                <span>View Pending</span>
                            </a>
                        @endif
                    </div>
                </div>
                <hr class="w-full border-b border-dotted border-gray-600 border">

                <table
                    class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                    <tbody class="p-2 md:p-4">
                        <tr>

                            <td class="font-medium">Date:</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($withdrawal->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Status:</td>
                            @if ($withdrawal->status == 'approved')
                                <td class="flex space-x-1 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div>
                                        {{ strtoupper($withdrawal->status) }}
                                    </div>
                                </td>
                            @elseif($withdrawal->status == 'pending')
                                <td class="flex space-x-1 text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        {{ strtoupper($withdrawal->status) }}
                                    </div>
                                </td>
                            @elseif($withdrawal->status == 'rejected')
                                <td class="flex space-x-1 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <div>
                                        {{ strtoupper($withdrawal->status) }}
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td class="font-medium">TXN ID:</td>
                            <td>{{ $withdrawal->txn_id ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Account ID:</td>
                            <td><a href="{{ route('admin.users.view', $withdrawal->user_id) }}">{{ adminUser($withdrawal->user_id, 'account_id') }}
                                </a></td>
                        </tr>

                        <tr>
                            <td class="font-medium">Full Name:</td>
                            <td><a href="{{ route('admin.users.view', $withdrawal->user_id) }}">{{ adminUser($withdrawal->user_id, 'first_name') . ' ' . adminUser($withdrawal->user_id, 'last_name') }}
                                </a></td>
                        </tr>

                        <tr>
                            <td class="font-medium">Amount:</td>
                            <td>{{ formatAmount($withdrawal->amount) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Fee:</td>
                            <td>{{ formatAmount($withdrawal->fee ?? 0) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Total:</td>
                            <td>{{ formatAmount($withdrawal->total ?? 0) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Wallet:</td>
                            <td>{{ $withdrawal->wallet_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Wallet Type:</td>
                            <td>{{ $withdrawal->wallet_type }}</td>
                        </tr>

                        @if ($withdrawal->wallet_type == 'crypto')
                            <tr>
                                <td class="font-medium">Wallet Address:</td>
                                <td>{{ json_decode($withdrawal->info)->wallet_address }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium">Network Type:</td>
                                <td>{{ json_decode($withdrawal->info)->network_type }}</td>
                            </tr>
                        @elseif ($withdrawal->wallet_type == 'bank')
                            <tr>
                                <td class="font-medium">Bank Name:</td>
                                <td>{{ json_decode($withdrawal->info)->bank_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium">Account Name:</td>
                                <td>{{ json_decode($withdrawal->info)->account_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-medium">Account No:</td>
                                <td>{{ json_decode($withdrawal->info)->account_no }}</td>
                            </tr>
                        @else
                            <tr>
                                <td class="font-medium">Payment Info:</td>
                                <td>{{ json_decode($withdrawal->info)->payment_info }}</td>
                            </tr>
                        @endif

                        <tr>
                            @if ($withdrawal->status == 'pending')
                                <td
                                    class="font-medium bg-green-400 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                    <a role="button" id="{{ 'processWithdrawal' . $withdrawal->id }}"
                                        class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span>Process</span>
                                    </a>
                                </td>
                            @endif

                            <td
                                class="font-medium bg-red-500 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                <form action="{{ route('admin.withdrawals.delete', $withdrawal->id) }}"
                                    id="{{ 'deleteWithdrawalForm' . $withdrawal->id }}" method="POST">
                                    @csrf
                                    <a role="button" id="{{ 'deleteWithdrawal' . $withdrawal->id }}"
                                        class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Delete</span>
                                    </a>
                                </form>

                            </td>
                        </tr>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        //Delete Withdrawal
        $(document).ready(function() {
            $("{{ '#deleteWithdrawal' . $withdrawal->id }}").click(function() {
                Swal.fire({
                    title: 'Delete Withdrawal!',
                    text: "Do you want to delete this withdrawal? It can't be reversed",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b2e4b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete',
                    background: "#0e1726",
                    color: "#d1d5db",

                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("{{ 'deleteWithdrawalForm' . $withdrawal->id }}")
                            .submit();
                    }
                });
            });
        });

        //Process Withdrawal
        $(document).ready(function() {
            $("{{ '#processWithdrawal' . $withdrawal->id }}").click(function() {
                Swal.fire({
                    title: 'Process Withdrawal',
                    html: ` 
                <form action="{{ route('admin.withdrawals.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $withdrawal->id }}">
                    <p>
                        <label for="action">Action</label>
                        <select name="action" id="action" required>
                            <option value="approve">Approve</option>
                            <option value="reject">Reject</option>
                        </select>
                    </p>

                    <p>
                        <label for="additional_info">Additional Info</label>
                        <textarea name="additional_info" id="additional_info" cols="30" rows="10" required></textarea>
                    </p>

                    <p>
                        <button type="submit">Process</button>
                    </p>
                </form>
                `,
                    showCancelButton: false,
                    showcloseButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#d33',

                    background: "#0e1726",
                    color: "#d1d5db",
                    
                });
            });
        });
    </script>
@endsection
