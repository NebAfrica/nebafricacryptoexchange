@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        User details
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


@section('content')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <div class="">
                <div>
                    <h3 class="font-medium capitalize">Profile Overview</h3>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-2">

            <div class="md:flex md:justify-between md:items-center mt-10 px-0 md:px-10">
                <div class="flex justify-center items-center">
                    <div>
                        <div class="w-36 h-36 rounded-full">
                            <img class="min-h-full min-w-full" src="{{ route('file', ['profile', $user->profile_picture]) }}" alt="profile picture">
                        </div>
    
                        <h3 class="text-[#bfc9d4] font-medium text-center text-base md:text-lg mt-2">{{ $user->first_name .' '.$user->last_name }}</h3>
                        <h4 class="text-[#bfc9d4] text-center text-sm md:text-base mt-1">{{ $user->gender }}</h4>
                    </div>
                </div>

                <div class="mt-10 md:mt-0">
                    <div class="flex space-x-2">
                        <span class="font-medium">Joined:</span>
                        <span>{{ date('M j, Y', strtotime($user->created_at)) }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <span class="font-medium">Status:</span>
                        <span class="@if($user->status == 'active') text-green-500 @else text-red-500 @endif">{{ $user->status }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <span class="font-medium">Email:</span>
                        <span>{{ $user->email_verified }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <span class="font-medium">ID Verification:</span>
                        <span>{{ $user->id_verified }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-[#bfc9d4] text-xs md:text-sm pl-2 md:pl-10 space-y-4">
                <div class="flex space-x-5 items-center hover:font-semibold hover:text-gray-200">
                    <div class="border-l-4 border-l-blue-500 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        <h6 class="">Account ID</h6>
                    </div>
                    <div>
                        <h4 class="text-sm md:text-lg lg:text-xl font-mono break-all">{{ $user->account_id }}</h4>
                    </div>
                </div>

                <div class="flex space-x-5 items-center hover:font-semibold hover:text-gray-200">
                    <div class="border-l-4 border-l-blue-500 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h6 class="">Available Bal</h6>
                    </div>
                    <div>
                        <h4 class="text-sm md:text-lg lg:text-xl font-mono break-all">{{ formatAmount($user->account_bal) }}</h4>
                    </div>
                </div>

                <div class="flex space-x-3 items-center hover:font-semibold hover:text-gray-200">
                    <div class="border-l-4 border-l-blue-500 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <h6 class="">Email address</h6>
                    </div>
                    <div>
                        <h4 class="text-sm md:text-lg lg:text-xl font-mono break-all">{{ $user->email }}</h4>
                    </div>
                </div>

                <div class="flex space-x-3 items-center hover:font-semibold hover:text-gray-200">
                    <div class="border-l-4 border-l-blue-500 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <h6 class="">Phone number</h6>
                    </div>
                    <div>
                        <h4 class="text-sm md:text-lg lg:text-xl font-mono break-all">{{ $user->phone_no }}</h4>
                    </div>
                </div>

                <div class="flex space-x-3 items-center hover:font-semibold hover:text-gray-200">
                    <div class="border-l-4 border-l-blue-500 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h6 class="">Date of birth</h6>
                    </div>
                    <div>
                        <h4 class="text-sm md:text-lg lg:text-xl font-mono break-all">{{ $user->dob }}</h4>
                    </div>
                </div>

                <div class="w-full md:px-2">
                    <div class="w-full flex flex-wrap md:flex-nowrap justify-evenly md:justify-center items-center space-x-0 lg:space-x-5 mt-10 mb-5">
                        @if ($user->status == 'active')
                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-gray-500 hover:bg-gray-600" role="button" id="suspend">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            <h6>Suspend</h6>
                        </a>
                        @else
                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-green-500 hover:bg-green-600" role="button" id="reactivate">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            <h6>Reactivate</h6>
                        </a>
                        @endif

                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-orange-500 hover:bg-orange-600" href="{{ route('admin.users.edit', $user->id ) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <h6>Edit</h6>
                        </a>

                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-blue-500 hover:bg-blue-600 mt-2 md:mt-0" role="button" id="credit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                            </svg>
                            <h6>Credit/Debit</h6>
                        </a>

                        <a class="w-5/12 md:w-auto flex items-center text-xs md:text-sm space-x-1 px-3 py-1 rounded-lg bg-purple-500 hover:bg-purple-600 mt-2 md:mt-0" href="{{ route('admin.users.email').'?email='.urlencode($user->email).'&return_url='.urlencode(url()->current()) }}">
                            <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <h6>Send email</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <div class="">
                <div>
                    <h3 class="font-medium capitalize">Activity Summary</h3>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-2">
            <div>
                <table id="datatable-skeleton-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Deposits:</td>
                            <td>{{ formatAmount($total_deposits) }}</td>
                        </tr>
                        <tr>
                            <td>Withdrawals:</td>
                            <td>{{ formatAmount($total_withdrawals) }}</td>
                        </tr>
                        <tr>
                            <td>Investments:</td>
                            <td>{{ formatAmount($total_investments) }}</td>
                        </tr>
                        <tr>
                            <td>Profits:</td>
                            <td>{{ formatAmount($total_profits) }}</td>
                        </tr>
                        <tr>
                            <td>Referrals:</td>
                            <td>{{ $total_referrals }}</td>
                        </tr>
                        <tr>
                            <td>Referral Earnings:</td>
                            <td>{{ formatAmount($total_referral_earnings) }}</td>
                        </tr>
                        @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
                            <tr>
                                <td>Loans:</td>
                                <td>{{ formatAmount(getLoans($user->id)->sum('amount')) }}</td>
                            </tr>
                        @endif
                        @if (isAddonEnabled('supportticket'))
                            <tr>
                                <td>Support Tickets:</td>
                                <td>{{ getTickets($user->id)->count() }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="w-full px-5 md:px-2">
                    <div class="w-full md:flex md:justify-center md:items-center md:space-x-3 lg:space-x-5 space-y-4 md:space-y-0 mt-10 mb-5">
                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" href="{{ route('admin.transactions.index').'?user_id='.$user->id }}">
                            <h6>Transaction History</h6>
                        </a>

                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" href="{{ route('admin.deposits.index').'?user_id='.$user->id }}">
                            <h6>Deposit History</h6>
                        </a>

                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" href="{{ route('admin.withdrawals.index').'?user_id='.$user->id }}">
                            <h6>Withdrawal History</h6>
                        </a>

                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" href="{{ route('admin.investments.index').'?user_id='.$user->id }}">
                            <h6>Investment History</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <div class="">
                <div>
                    <h3 class="font-medium capitalize">more actions</h3>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-2">
            <div>
                <div class="w-full px-5 md:px-2">
                    <div class="w-full md:flex md:justify-center md:items-center md:space-x-3 lg:space-x-5 space-y-4 md:space-y-0 mt-10 mb-5">
                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" href="{{ route('admin.users.index').'?referred_by='.$user->account_id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            <h6>Referred Users</h6>
                        </a>

                        @if (isAddonEnabled('KYC'))
                            <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" href="{{ route('admin.id.index').'?user_id='.$user->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                                <h6>KYC Record</h6>
                            </a>
                        @endif

                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" role="button" id="password">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <h6>Change Password</h6>
                        </a>

                        <a class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600" role="button" id="loginAsUser">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <h6>Login in as user</h6>
                        </a>
                    </div>
                </div>

                <div class="w-full px-10">
                    <a class="flex justify-center items-center px-3 py-2 rounded-lg bg-red-500 hover:bg-red-600" role="button" id="delete">
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <h6>Delete</h6>
                        </div>
                    </a>
                </div>
                {{--  hidden forms --}}
                <form action="{{ route('admin.users.status') }}" id="{{ 'statusUserForm'.$user->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                    @if ($user->status == 'active')
                    <input type="hidden" name="action" id="action" value="suspend">
                    @else
                    <input type="hidden" name="action" id="action" value="reactivate">
                    @endif
                </form>

                <form action="{{ route('admin.users.delete') }}" id="{{ 'deleteUserForm'.$user->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                </form>

                <form action="{{ route('admin.users.login-as-user', $user->id) }}" id="{{ 'loginUserForm'.$user->id }}" method="POST">
                    @csrf

                    <input type="hidden" name="admin_url" id="admin_url" value="{{ urlencode(url()->current()) }}">
                </form>
                {{--  hidden forms ends here --}}

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

{{--  Credit / Debit --}}
<script>
    $(document).ready(function() {
        $(".dataTables_wrapper .dataTables_length").hide();
        $('.dataTables_filter').hide();
        $('.dataTables_info').hide();
        $('.dataTables_paginate').hide();

        $("#credit").click(function() {
            Swal.fire({
                title: `<h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Credit/Debit {{ $user->first_name }}
                        </h2>`,
                html: `
                    <form action="{{ route('admin.users.credit-debit') }}" method="POST">
                        <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                            <tbody class="p-2 md:p-4"> 
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                @csrf
                                <tr>
                                    <td align="center" class="font-medium">
                                        <label for="amount">Amount {{ websiteInfo('general_currency') }}:</label>
                                    </td>
                                    <td align="center">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="cred-hyip-theme1-input-icon h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <input type="number" step="any" name="amount" id="amount" required value="{{ old('amount') }}"  class=" cred-hyip-theme1-text-input">
                                        </div>
                                        @error('amount') {{ $message }} @enderror
                                    </td>
                                </tr>  
                                
                                <tr>
                                    <td align="center" class="font-medium">
                                        <label for="action">Action:</label>
                                    </td>
                                    <td align="center">
                                        <div class="relative">
                                            <select name="action" id="action" class=" cred-hyip-theme1-text-input">
                                                <option value="" disabled @if (!old('action')) selected  @endif >Choose Action</option>
                                                <option value="credit" @if (old('action')  == 'credit') selected  @endif>Credit</option>
                                                <option value="debit" @if (old('action')  == 'debit') selected  @endif>Debit</option>
                                            </select>
                                            
                                        </div>
                                        @error('action') {{ $message }} @enderror
                                    </td>
                                </tr>  
                                
                                <tr>
                                    <td colspan="2">
                                        <hr class="w-full border-b border-dotted border-gray-600 border">

                                        <div class="w-full mt-5 px-5">
                                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                                Submit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </form>
                `,
                background: "#0e1726",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCloseButton: true,
                color: "#b9bead",
                
            });
        });
    });
</script>

{{--  Credit / Debit Ends --}}

{{--  Suspend /Reactivate --}}
<script>
    $(document).ready(function() {
        $("#suspend").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This User is currently active. {{ $user->first_name }} will be suspended!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Suspend!',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'statusUserForm'.$user->id }}").submit()
                }
            });
        });
    });

    // Reactivate user

    $(document).ready(function() {
        $("#reactivate").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This User is currently suspended. {{ $user->first_name }} will be Reactivated!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reactivate!',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'statusUserForm'.$user->id }}").submit()
                }
            });
        });
    });

    //delete user

    $(document).ready(function() {
        $("#delete").click(function() {
            Swal.fire({
                title: 'Delete User?',
                text: "{{ $user->first_name }} will be deleted, this action can not be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete!',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deleteUserForm'.$user->id }}").submit();
                }
            });
        });
    });

    //change password

    $(document).ready(function() {
        $("#password").click(function() {
            Swal.fire({
                title: `<h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Change Password
                        </h2>`,
                html: `
                    <form action="{{ route('admin.users.password') }}" method="POST">
                        <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                            <tbody class="p-2 md:p-4"> 
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                @csrf
                                <tr>
                                    <td class="font-medium">
                                        <label for="password">New Password:</label>
                                    </td>
                                    <td>
                                        <span class="cred-hyip-theme1-input-icon material-icons">
                                            lock
                                        </span>
                                        <input type="password" name="password" placeholder="Password" class="cred-hyip-theme1-text-input">
                                        <span>@error('password') {{ $message }} @enderror </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="font-medium">
                                        <label for="password_confirmation">Confirm Password:</label>
                                    </td>
                                    <td>
                                        <span class="cred-hyip-theme1-input-icon material-icons">
                                            lock
                                        </span>
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="cred-hyip-theme1-text-input">
                                        <span>@error('password') {{ $message }} @enderror </span>
                                    </td>
                                </tr>
            
                                <tr>
                                    <td colspan="2">
                                        <hr class="w-full border-b border-dotted border-gray-600 border">

                                        <div class="w-full mt-5 px-5">
                                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                                Change
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </form>
                `,
                background: "#0e1726",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCloseButton: true,
                color: "#b9bead",
                
            });
        });
    });

    //login as user
    $(document).ready(function() {
        $("#loginAsUser").click(function() {
            Swal.fire({
                title: 'Login As User',
                text: "Do you want to login as {{ $user->first_name }}?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Login',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'loginUserForm'.$user->id }}").submit();
                }
            });
        });
    });
</script>



@endsection