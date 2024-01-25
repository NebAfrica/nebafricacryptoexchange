@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">            
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Deposit details
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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="p-2 md:p-4">
                <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                    <tbody class="p-2 md:p-4">
                        <tr>
                            <td class="font-medium">Date:</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($deposit->created_at)) }}</td> 
                        </tr>
                        <tr>
                            <td class="font-medium">User:</td>
                            <td><a href="{{ route('admin.users.view', $deposit->user_id) }}">{{ adminUser($deposit->user_id, 'first_name') }} {{ adminUser($deposit->user_id, 'last_name') }}</a></td>
                        </tr>
                        <tr>
                            <td class="font-medium">Amount:</td>
                            <td>{{ formatAmount($deposit->amount) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Payment Method:</td>
                            <td>{{ $deposit->method }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Payment Method Amount:</td>
                            <td>{{ $deposit->converted_amount }}{{ $deposit->currency }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Deposit Charge:</td>
                            <td>{{ formatAmount($deposit->charge) }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">Status:</td>
                            <td class="
                            @if ($deposit->status == 'cancelled')
                            bg-red-500 
                            @elseif ($deposit->status == 'pending')
                            bg-orange-500
                            @elseif ($deposit->status == 'approved')
                            bg-green-500
                            @endif
                            pl-2 rounded-sm text-gray-200">{{$deposit->status }}</td>
                        </tr>
                        @if ($deposit->status != 'cancelled')
                        <tr>
                            <td class="font-medium">Additional Info</td>
                            <td>{{ $deposit->additional_info }}</td>
                        </tr>
                        @endif

                        @if ($deposit->payment_screenshot)
                        <tr>
                            <td class="font-medium">
                                <h2>Payment Screenshot</h2>
                            </td>
                            <td>
                                <div class="h-36 md:h-64 w-28 md:w-60 bg-blue-300 rounded-sm">
                                    <img class="min-h-full min-w-full rounded-sm" src="{{ route('file', ['deposits', $deposit->payment_screenshot]) }}" alt="Deposit screenshot">
                                </div>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="my-1"></td>
                        </tr>
                        <tr>
                            @if ($deposit->status == 'pending')
                                <td class="font-medium bg-green-400 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                    <a role="button" id="processDeposit" class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span>Process</span>
                                    </a>
                                </td>
                            @endif
                            <td class="font-medium bg-red-500 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 text-white">
                                <a role="button" data-title="Deposit" data-value="{{ $deposit->id }}" class="delete_btn flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{--  delete form --}}

<form action="{{ route('admin.deposits.delete') }}" method="post" id="deleteForm">
    @csrf
    <input type="hidden" name="id" id="id" placeholder="Deposit Id">
</form>
@endsection



@section('script')


<script>
    //Process Deposit
    $(document).ready(function() {
        $("#processDeposit").click(function() {
            Swal.fire({
                html: `
                {{-- process form --}}
                <div class="p-2 md:p-4 text-[#bfc9d4]">
                    <form action="{{ route('admin.deposits.process') }}" method="POST">
                        @csrf
                        <h3 class="text-sm lg:text-base font-medium mb-4">Process Deposit </h3>
                        <input type="hidden" name="id" value="{{ $deposit->id }}">
                        <input type="hidden" name="user_id" value="{{ $deposit->user_id }}">
                        <div class="space-y-5">
                            {{-- Action --}}
                            <div class="relative w-full">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    reorder
                                </span>
                                <select name="action" id="action" class="cred-hyip-theme1-text-input" required>
                                    <option value="" selected disabled>Choose Action</option>
                                    <option value="approve">Approve</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>

                            {{-- Addtional comment --}}
                            <div>
                                <textarea name="additional_info" id="additional_info" rows="5" required placeholder="Enter comment" class="cred-hyip-theme1-textarea pl-4">{!! $deposit->additional_info !!}</textarea>
                            </div>
                        </div>

                        <div class="w-full my-5 px-4" align="left">
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