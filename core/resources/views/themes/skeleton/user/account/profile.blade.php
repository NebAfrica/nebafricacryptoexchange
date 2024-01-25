@extends('themes.skeleton.layout.app')

@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        My Profile
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}"  >
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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

<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    <h6  >
                        Profile Overview
                    </h6>
                </div>
                <div>
                    <a href="{{ route('user.account.edit') }}"  >
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Edit</span>
                    </a>
                </div>
            </div>

            <hr  >

            <div  >
                <div>
                    <div  >
                        <img   src="{{ route('file', ['profile', user('profile_picture')]) }}" alt="">
                    </div>

                    <h3  >{{ user('first_name').' '.user('last_name') }}</h3>
                </div>
            </div>

            <div  >
                <div  >
                    <div  >
                        <h6  >Account ID</h6>
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('account_id') }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >Available Bal</h6>
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ formatAmount(user('account_bal')) }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >Email address</h6>
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('email') }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >Phone number</h6>
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h4>{{ user('phone_no') }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >Date of birth</h6>
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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


<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    <h6  >
                        Account Standings
                    </h6>
                </div>
            </div>

            <hr  >

            <div  >
                <div  >
                    <div  >
                        <h6  >Status:</h6>
                    </div>
                    <div>
                        <h4>{{ user('status') }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >Email Verification:</h6>
                    </div>
                    <div>
                        <h4>{{ user('email_verified') }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >KYC Verification:</h6>
                    </div>
                    <div>
                        <h4>{{ user('id_verified') }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    <h6  >
                        Location Information
                    </h6>
                </div>
            </div>

            <hr  >

            <div  >
                <div  >
                    <div  >
                        <h6  >Address:</h6>
                    </div>
                    <div  >
                        <h4>{{ user('street_address') ?? 'NOT ADDED' }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >State/Region:</h6>
                    </div>
                    <div  >
                        <h4>{{ user('state') }}</h4>
                    </div>
                </div>
                <div  >
                    <div  >
                        <h6  >Country:</h6>
                    </div>
                    <div  >
                        <h4>{{ user('country') }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    <h6  >
                        Referral Details
                    </h6>
                </div>
            </div>

            <hr  >

            <div  >
                <div  >
                    <div  >
                        <div>
                            <h2  >{{ user('referred_by') ?? 'DIRECT SIGN UP' }}</h2>
                            <span  >Referrred By</span>
                        </div>
                    </div>
                    <div  >
                        <div>
                            <h2  >{{ $total_referrals }}</h2>
                            <span  >Total Referrals:</span>
                        </div>
                    </div>
                </div>
            </div>

            <div  >
                <table id="datatable-skeleton-table"  >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Account ID</th>
                            <th>Name</th>
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
                            <td colspan="4">You don't have any referrals</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection