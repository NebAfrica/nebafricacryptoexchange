@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ $page_title }}

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
{{-- Infograpics Section should be here
Ingraphics for this page are
1. Total loans : {{ $all->count() }} | {{ formatAmount($all->sum('amount')) }}
2. Unpaid Loans : {{ $all->where('status', 'unpaid')->count() }} | {{ formatAmount($all->where('status', 'unpaid')->sum('amount')) }}
3. Rejected Loans : {{ $all->where('status', 'rejected')->count() }} | {{ formatAmount($all->where('status', 'rejected')->sum('amount')) }}
4. Pending Loans : {{ $all->where('status', 'pending')->count() }} | {{ formatAmount($all->where('status', 'pending')->sum('amount')) }}
5. Overdue Loans : {{ $all->where('status', 'unpaid')->where('repayment_date', '<', time())->count() }} | {{ formatAmount($all->where('status', 'unpaid')->where('repayment_date', '<', time())->sum('amount')) }}
6. A piechart showing 2-5 --}}
@endsection


@section('content')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            <div class="flex justify-end space-x-2">
                <div>
                    @if (request()->is('admin/loans'))
                    <a href="{{ route('admin.loans.pending') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                        </svg>
                        <span>Pending</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.loans.unpaid') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        <span>Unpaid</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.loans.overdue') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <span>Overdue</span>
                    </a>
                    @else
                </div>
                <div>
                    <a href="{{ route('admin.loans.index') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>View All</span>
                    </a>
                    @endif
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="w-full flex justify-center mt-10 lg:mt-20">
                <div class="w-full lg:w-2/3 border border-gray-700 rounded-md flex justify-center p-8 lg:p-16 shadow-md">
                    <table class="text-[#bfc9d4] text-xs md:text-sm">
                        <tr>
                            <td class="font-medium">User:</td>
                            <td class="pl-6 md:pl-10"><a class="underline" href="{{ route('admin.users.view', $loan->user_id) }}">{{ adminUser($loan->user_id, 'first_name') }} {{ adminUser($loan->user_id, 'last_name') }}</a></td>
                        </tr>

                        <tr>
                            <td class="font-medium">User Account ID:</td>
                            <td class="pl-6 md:pl-10">{{ adminUser($loan->user_id , 'account_id') }}</td>
                        </tr>

                        <tr>
                            <td class="font-medium">Amount:</td>
                            <td class="pl-6 md:pl-10">{{ formatAmount($loan->amount) }}</td>
                        </tr>

                        <tr>
                            <td class="font-medium">Interest:</td>
                            <td class="pl-6 md:pl-10">{{ formatAmount($loan->interest) }}</td>
                        </tr>

                        <tr>
                            <td class="font-medium">Total Repayable:</td>
                            <td class="pl-6 md:pl-10">{{ formatAmount($loan->amount + $loan->interest) }}</td>
                        </tr>

                        <tr>
                            <td class="font-medium">Repayment Date:</td>
                            <td class="pl-6 md:pl-10">
                                @if ($loan->status == 'pending')
                                {{ formatAmount($loan->amount + $loan->interest) }}
                                @else
                                {{ date('d.m.y H:i:s', $loan->repayment_date) }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="my-1"></td>
                        </tr>

                        <tr>
                            <td class="font-medium">Status:</td>
                            <td class="pl-6 md:pl-10">
                                <div>{{ $loan->status }}</div>
                                <div class="w-full flex space-x-2">
                                    @if ($loan->status == 'pending')
                                    <a role="button" id="process" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-1 my-1 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span>Process</span>
                                    </a>
                                    @endif

                                    <form action="{{ route('admin.loans.delete', $loan->id) }}" method="post" id="deleteLoanForm" class="w-full">
                                        @csrf
                                        <a role="button" id="{{ 'deleteLoan'.$loan->id }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-1 my-1 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span>Delete</span>
                                        </a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    //Process loan
    $(document).ready(function() {
        $("#process").click(function() {
            Swal.fire({
                html: `
                {{--  process form --}}
                <div class="p-2 md:p-4">
                    <form action="{{ route('admin.loans.process') }}" method="POST">
                        @csrf
                        <h3 class="text-sm lg:text-base font-medium mb-4">Process Loan </h3>
                        <input type="hidden" name="loan_id" value="{{ $loan->id }}">
                        <div class="space-y-5">
                            {{--  Action --}}
                            <div class="relative w-full">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    reorder
                                </span>
                                <select name="action" id="action" class="cred-hyip-theme1-text-input" required>
                                    <option value="" selected disabled>Select Action</option>
                                    <option value="approve">Approve</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                        </div>

                        <div align="left" class="w-full mt-5 mb-3">
                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Process
                            </button>
                        </div>
                    </form>
                </div>
                `,
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                background: "#0e1726",
                color: "#d1d5db",
                
            });
        });
    });


    //Delete loan
    $(document).ready(function() {
        $("{{ '#deleteLoan'.$loan->id }}").click(function() {
            Swal.fire({
                title: 'Delete Loan!',
                text: "Do you want to delete this loan? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deleteLoanForm'}}").submit();
                }
            });
        });
    });
</script>

@endsection