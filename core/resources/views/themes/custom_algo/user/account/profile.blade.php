@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('My Profile', 'c') }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                        Profile Overview
                    </h6>
                </div>
                <div>
                    <a href="{{ route('user.account.edit') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>{{ ct('Edit', 'c') }}</span>
                    </a>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="flex justify-center mt-10">
                <div>
                    <div class="w-36 h-36 rounded-full">
                        <img class="min-h-full min-w-full" src="{{ route('file', ['profile', user('profile_picture')]) }}" alt="">
                    </div>

                    <h3 class="text-[#bfc9d4] font-medium text-center text-base md:text-lg mt-2">{{ user('first_name').' '.user('last_name') }}</h3>
                </div>
            </div>

            <div class="mt-10 text-[#bfc9d4] text-xs md:text-sm pl-10 md:pl-20 space-y-2">
                <div class="flex space-x-3 items-start hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs">{{ ct('Account ID', 'c') }}</h6>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('account_id') }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3 items-start hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs">{{ ct('Available Bal', 'c') }}</h6>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ formatAmount(user('account_bal')) }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3 items-start hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs">{{ ct('Email address', 'c') }}</h6>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('email') }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3 items-start hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs">{{ ct('Phone number', 'c') }}</h6>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('phone_no') }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3 items-start hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs">{{ ct('Date of birth', 'c') }}</h6>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('dob') }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                        {{ ct('Account Standings', 'c') }}
                    </h6>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="mt-10 text-[#bfc9d4] text-sm md:text-base pl-10 md:pl-20 space-y-2">
                <div class="flex space-x-3 items-center hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs font-semibold">{{ ct('Status', 'c') }}:</h6>
                    </div>
                    <div>
                        <h4>{{ user('status') }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3 items-center hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs font-semibold">{{ ct('Email Verification', 'c') }}:</h6>
                    </div>
                    <div>
                        <h4>{{ user('email_verified') }}</h4>
                    </div>
                </div>
                <div class="flex space-x-3 items-center hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-xs font-semibold">{{ ct('KYC Verification', 'c') }}:</h6>
                    </div>
                    <div>
                        <h4>{{ user('id_verified') }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                        {{ ct('Location Information', 'c') }}
                    </h6>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="mt-10 text-[#bfc9d4] text-base md:text-lg pl-10 md:pl-20 space-y-2">
                <div class="hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-base font-semibold">{{ ct('Address', 'c') }}:</h6>
                    </div>
                    <div class="text-sm">
                        <h4>{{ user('street_address') ?? 'NOT ADDED' }}</h4>
                    </div>
                </div>
                <div class="hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-base font-semibold">{{ ct('State', 'c') }}</h6>
                    </div>
                    <div class="text-sm">
                        <h4>{{ user('state') }}</h4>
                    </div>
                </div>
                <div class="hover:font-semibold hover:text-gray-200">
                    <div class="flex space-x-2 items-center">
                        <h6 class="text-base font-semibold">{{ ct('Country') }}:</h6>
                    </div>
                    <div class="text-sm">
                        <h4>{{ user('country') }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                        {{ ct('Referral Details') }}
                    </h6>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="w-full flex justify-center mt-10">
                <div class="w-4/5 flex justify-between">
                    <div class="w-28 h-16 rounded-md bg-[#5f709c] text-[#ebedf2] px-2 pt-1 pb-0 md:px-4 md:pt-2">
                        <div>
                            <h2 class="text-base md:text-lg font-semibold">{{ user('referred_by') ?? 'DIRECT SIGN UP' }}</h2>
                            <span class="text-xs font-light">{{ ct('Referrred By') }}</span>
                        </div>
                    </div>
                    <div class="w-28 h-16 rounded-md bg-[#5f709c] text-[#ebedf2] px-2 pt-1 pb-0 md:px-4 md:pt-2">
                        <div>
                            <h2 class="text-base md:text-lg font-semibold">{{ $total_referrals }}</h2>
                            <span class="text-xs font-light">{{ ct('Total Referrals') }}:</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-2 md:p-4">
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ ct('Date') }}</th>
                            <th>{{ ct('Account ID') }}</th>
                            <th>{{ ct('Name') }}</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @forelse ($referreds as $ref)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('M d, Y', strtotime($ref->created_at)) }}</td>
                            <td>{{ $ref->account_id }}</td>
                            <td>{{ $ref->first_name . ' '. $ref->last_name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{ ct("no referral") }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection