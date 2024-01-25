@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Manage users
                        </h2>
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}"
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
    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
                <div class="w-full py-5">
                    <div
                        class="w-full lg:grid lg:grid-cols-3 lg:gap-3 lg:place-content-evenly space-y-3 lg:space-y-0 text-[#bfc9d4]">
                        <div
                            class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $total_users }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">Total Users</h4>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $active_users }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">Active Users</h4>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $suspended_users }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">Suspended Users</h4>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div
                                    class="flex justify-center items-center h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="lg:col-span-2 flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#922e9b] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $email_verified }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">Email Verified Users</h4>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#922e9b] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $pending_email_verification }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">Pending Email Verification</h4>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#2355b3] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $id_verified }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">ID Verified</h4><br>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#2355b3] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div
                            class="lg:col-span-2 flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                            <div class="hidden lg:block relative w-full">
                                <div
                                    class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#911f1b] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="lg:pr-14">
                                <div>
                                    <h2 class="text-sm lg:text-base font-semibold">{{ $pending_id_verification }}</h2>
                                </div>
                                <div class="mt-2">
                                    <h4 class="text-xs lg:text-sm font-medium">Pending ID Verification</h4>
                                </div>
                            </div>
                            <div class="lg:hidden opacity-50">
                                <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#911f1b] text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex justify-center items-center mt-5">
                    <div class="w-full flex justify-center items-center lg:w-2/3">
                        <canvas id="myChart" width="100" height="100"></canvas>
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
                <form action="{{ route('admin.users.action') }}" method="POST">
                    @csrf
                    <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="all" id="all">
                                </th>
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
                            @foreach ($users as $user)
                                <tr>
                                    <td><input type="checkbox" name="emails[]" value="{{ $user->email }}"
                                            id="{{ 'user' . $user->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->account_id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ formatAmount($user->account_bal) }}</td>
                                    <td>{{ $user->status }}</td> {{--  acitve / suspended --}}
                                    <td class="inline-flex space-x-2 md:space-x-4">
                                        <a href="{{ route('admin.users.view', $user->id) }}" title="View user info">
                                            <svg xmlns=" http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit user info">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-orange-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        @if ($user->status == 'active')
                                            <a role="button" class="status_button" data-action="suspend"
                                                data-user_id="{{ $user->id }}" title="Suspend user">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-gray-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            </a>
                                        @else
                                            <a role="button" class="status_button" data-action="reactivate"
                                                data-user_id="{{ $user->id }}" title="Reactivate suspended user">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-green-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.users.email') . '?email=' . urlencode($user->email) . '&return_url=' . urlencode(url()->current()) }}"
                                            title="Send email">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-sky-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </a>
                                        <a role="button" class="delete_btn" data-value="{{ $user->id }}" title="Delete user" data-title="User">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
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
                    <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                        <div class="text-xs lg:text-sm">
                            <label for="action">With Selected:</label>
                        </div>
                        <div>
                            <select name="action" id="action1"
                                class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                                <option value="" selected disabled>Choose Action</option>
                                <option value="send_email">Send Email</option>
                                <option value="suspend">Suspend</option>
                                <option value="reactivate">Reactivate</option>
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
                </form>

                {{--  start of suspend / reactivate form --}}
                <form action="{{ route('admin.users.status') }}" id="statusForm" method="POST">
                    @csrf
                    <input type="hidden" name="action" id="status_action" value="">
                    <input type="hidden" name="user_id" id="status_user_id" value="">

                </form>
                {{--  end of suspend / reactiavate form --}}

                {{--  Delete forms here --}}
                <form action="{{ route('admin.users.delete') }}" id="deleteForm"
                    method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="id" value="">
                </form>
                {{--  delete forms ends here --}}
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
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
    </script>
    <script>
        let totalUsers = "{{ $total_users }}"
        let activeUsers = "{{ $active_users }}"
        let suspendedUsers = "{{ $suspended_users }}"
        let emailVerifiedUsers = "{{ $email_verified }}"
        let pendingEmailVerificationUsers = "{{ $pending_email_verification }}"
        let idVerifiedUsers = "{{ $id_verified }}"
        let pendingIdVerificationUsers = "{{ $pending_id_verification }}"
        const data = {
            labels: [
                'TOTAL USERS',
                'ACTIVE USERS',
                'SUSPENDED USERS',
                "Verified = " + emailVerifiedUsers + " Pending = " + pendingEmailVerificationUsers,
                "Verified = " + idVerifiedUsers + " Pending = " + pendingIdVerificationUsers,
            ],
            datasets: [{
                type: 'pie',
                label: "Total Users",
                data: [parseInt(parseInt(totalUsers))],
                backgroundColor: ['rgb(46, 112, 55)'],
                hoverOffset: 2
            }, {
                type: 'pie',
                label: "Active Users",
                data: [0, parseInt(parseInt(activeUsers))],
                backgroundColor: ['rgb(78, 58, 170)'],
                hoverOffset: 2
            }, {
                type: 'pie',
                label: "Suspended Users",
                data: [0, 0, parseInt(parseInt(activeUsers))],
                backgroundColor: ['rgba(223, 151, 43, 0.97)'],
                hoverOffset: 2
            }, {
                type: 'pie',
                label: ["Email Verification"],
                data: [0, 0, 0, parseInt(emailVerifiedUsers), parseInt(pendingEmailVerificationUsers)],
                backgroundColor: [
                    'rgb(146, 46, 155)',
                    'rgb(165, 79, 40)',
                ],
                hoverOffset: 2
            }, {
                type: 'pie',
                label: ["ID Verification"],
                data: [0, 0, 0, 0, parseInt(idVerifiedUsers), parseInt(pendingIdVerificationUsers)],
                backgroundColor: [
                    'rgb(35, 85, 179)',
                    'rgb(145, 31, 27)',
                ],
                hoverOffset: 2
            }, ]
        };
        const config = {
            data: data,
            options: {
                layout: {
                    padding: 20
                }
            }
        };
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, config)
    </script>
@endsection

