@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        View Transfer
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

@section('content')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            <div class="flex justify-end space-x-2">
                <div>
                    <a href="{{ route('admin.transfers.pending') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                        </svg>
                        <span>Pending Transfers</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.transfers.index') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>All Transfers</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <table class="text-[#bfc9d4] text-xs md:text-sm mt-5">
                <tr>
                    <td class="font-medium">Date:</td>
                    <td class="pl-6 md:pl-10">{{ date('d.m.Y H:i:s', strtotime($transfer->created_at)) }}</td>
                </tr>

                <tr>
                    <td class="font-medium">TXN ID:</td>
                    <td class="pl-6 md:pl-10">{{ $transfer->txn_id }}</td>
                </tr>

                <tr>
                    <td class="font-medium">Amount:</td>
                    <td class="pl-6 md:pl-10">{{ formatAmount($transfer->amount) }}</td>
                </tr>

                <tr>
                    <td class="font-medium">Fee:</td>
                    <td class="pl-6 md:pl-10">{{ formatAmount($transfer->fee) }}</td>
                </tr>
                <tr>
                    <td class="font-medium">Total:</td>
                    <td class="pl-6 md:pl-10">{{ formatAmount($transfer->total) }}</td>
                </tr>

                <tr>
                    <td class="font-medium">Narration:</td>
                    <td class="pl-6 md:pl-10">{{ $transfer->narration }}</td>
                </tr>

                <tr>
                    <td class="font-medium">Status:</td>
                    <td class="pl-6 md:pl-10">{{ $transfer->status }}</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <a role="button" id="process" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Process</span>
                        </a>
                    </td>
                </tr>
            </table>

            <hr class="w-full border-b border-dotted border-gray-600 border mt-6">

            <div class="w-full flex justify-center items-center border border-gray-500 p-5 lg:p-10 rounded shadow-sm">
                <div class="w-full lg:w-3/4">
                    {{--  transfer from section --}}
                    <div class="block w-full">
                        <table class="text-[#bfc9d4] text-xs md:text-sm w-full table-fixed">
                            <tr>
                                <td class="w-20 md:w-24"></td>
                                <td class=""></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-medium">
                                    <div class="flex items-center space-x-1">
                                        <div class="text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                            </svg>
                                        </div>
                                        <div class="font-semibold text-base">
                                            <h2>FROM:</h2>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" class="font-medium">First Name:</td>
                                <td align="left">{{ $sender->first_name}}</td>
                            </tr>
                            <tr>
                                <td align="left" class="font-medium">Last Name:</td>
                                <td align="left">{{ $sender->last_name}}</td>
                            </tr>
                            <tr>
                                <td align="left" class="font-medium">Account ID:</td>
                                <td align="left"><a class="underline" href="{{ route('admin.users.view', $sender->id) }}">{{ $sender->account_id}}</a></td>
                            </tr>
                        </table>
                    </div>

                    {{--  transfer to section --}}
                    <div class="block w-full">
                        <table class="text-[#bfc9d4] text-xs md:text-sm w-full table-fixed">
                            <tr>
                                <td class=""></td>
                                <td class="w-16 md:w-20"></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-medium text-right">
                                    <div class="flex justify-end items-center space-x-1">
                                        <div class="text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                            </svg>
                                        </div>
                                        <div class="font-semibold text-base">
                                            <h2>TO:</h2>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" class="font-medium">First Name:</td>
                                <td align="right">{{ $receiver->first_name}}</td>
                            </tr>
                            <tr>
                                <td align="right" class="font-medium">Last Name:</td>
                                <td align="right">{{ $receiver->last_name}}</td>
                            </tr>
                            <tr>
                                <td align="right" class="font-medium">Account ID:</td>
                                <td align="right"><a class="underline" href="{{ route('admin.users.view', $receiver->id) }}">{{ $receiver->account_id}}</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    //Process transfer
    $(document).ready(function() {
        $("#process").click(function() {
            Swal.fire({
                html: `
                {{--  process form --}}
                <div class="p-2 md:p-4">
                    <form action="{{ route('admin.transfers.process') }}" method="POST">
                        @csrf
                        <h3 class="text-sm lg:text-base font-medium mb-4">Process Transfer </h3>
                        <input type="hidden" name="transfer_id" value="{{ $transfer->id }}">
                        <input type="hidden" name="sender_id" value="{{ $sender->id }}">
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                        <div class="space-y-5">
                            {{--  Action --}}
                            <div class="relative w-full">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    reorder
                                </span>
                                <select name="action" id="action" class="cred-hyip-theme1-text-input" required>
                                    <option selected disabled>Select Action</option>
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
</script>

@endsection