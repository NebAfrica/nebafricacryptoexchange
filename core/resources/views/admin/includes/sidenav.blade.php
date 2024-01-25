<div data-status='full'
    class="sidenav-content z-40 cred-hyip-theme1-bg border-r border-gray-800 fixed top-0 md:top-32 left-0 bottom-0 mt-2 text-sm text-blue-100 min-h-screen w-64 2xl:w-1/5 space-y-3 md:space-y-6 2xl:space-y-8 pt-0 pb-4 px-2 2xl:pl-10 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out overflow-y-scroll">

    {{-- Close button icon --}}
    <div class="md:hidden flex justify-end p-3">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="sidebar-toggle-btn h-5 w-5 cursor-pointer text-white"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>

    {{-- navs --}}
    <nav class="w-full flex flex-col space-y-2 lg:space-y-3">
        <a href="{{ route('admin.dashboard') }}"
            @if (request()->routeIs('admin.dashboard')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Dashboard</span>
            </div>
        </a>

        {{--  users starts here --}}
        <div class="dropdown-with-caret" data-menu-id="10">
            <a role="button"
                class="@if (request()->routeIs('admin.users*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Users</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.users*')) rotate-90 @endif"
                        data-menu-id="10" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.users*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="10">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.users.index') && !request()->users_query) active-submenu @endif"
                            href="{{ route('admin.users.index') }}">All Users</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'status' && request()->users_by == 'active') active-submenu @endif"
                            href="{{ route('admin.users.index', ['users_query' => 'status', 'users_by' => 'active']) }}">Active
                            Users</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'status' && request()->users_by == 'suspended') active-submenu @endif"
                            href="{{ route('admin.users.index', ['users_query' => 'status', 'users_by' => 'suspended']) }}">Suspended
                            Users</a>
                    </li>

                    @if (websiteInfo('email_verification') == 'enabled')
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'email_verified' && request()->users_by == 'pending') active-submenu @endif"
                                href="{{ route('admin.users.index', ['users_query' => 'email_verified', 'users_by' => 'pending']) }}">Pending
                                Email V</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'email_verified' && request()->users_by == 'verified') active-submenu @endif"
                                href="{{ route('admin.users.index', ['users_query' => 'email_verified', 'users_by' => 'verified']) }}">Email
                                Verified</a>
                        </li>
                    @endif

                    @if (websiteInfo('id_verification') == 'enabled' && isAddonEnabled('kyc'))
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'id_verified' && request()->users_by == 'pending') active-submenu @endif"
                                href="{{ route('admin.users.index', ['users_query' => 'id_verified', 'users_by' => 'pending']) }}">Pending
                                KYC</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'id_verified' && request()->users_by == 'verified') active-submenu @endif"
                                href="{{ route('admin.users.index', ['users_query' => 'id_verified', 'users_by' => 'verified']) }}">KYC
                                Verified</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->users_query == 'id_verified' && request()->users_by == 'rejected') active-submenu @endif"
                                href="{{ route('admin.users.index', ['users_query' => 'id_verified', 'users_by' => 'rejected']) }}">Rejected
                                KYC</a>
                        </li>
                    @endif

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.users.email')) active-submenu @endif"
                            href="{{ route('admin.users.email') }}">Email Users</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  users ends here --}}

        {{--  KYC --}}
        @if (websiteInfo('id_verification') == 'enabled' && isAddonEnabled('kyc'))
            <a href="{{ route('admin.id.index') }}"
                @if (request()->routeIs('admin.id*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">KYC Records</span>
                </div>
            </a>
        @endif
        {{--  !KYC --}}

        {{--  trading menu --}}
        @if (websiteInfo('trader_mode') == 'enabled' && isAddonEnabled('cryptotrading'))
            <a href="{{ route('admin.trading.wallets.index') }}"
                @if (request()->routeIs('admin.trading.wallets.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 7H7v6h6V7z"></path>
                        <path fill-rule="evenodd"
                            d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">Trading Wallets</span>
                </div>
            </a>

            <a href="{{ route('admin.trading.signals.index') }}"
                @if (request()->routeIs('admin.trading.signals.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">Trading Signals</span>
                </div>
            </a>

            <a href="{{ route('admin.trading.staking-coins.index') }}"
                @if (request()->routeIs('admin.trading.staking-coins.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z">
                        </path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">Staking</span>
                </div>
            </a>

            <a href="{{ route('admin.trading.trading-bots.index') }}"
                @if (request()->routeIs('admin.trading.trading-bots.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">Trading Bots</span>
                </div>
            </a>
        @endif
        {{--  !trading menu --}}

        {{--  deposits starts here --}}
        <div class="dropdown-with-caret" data-menu-id="3">
            <a role="button"
                class="@if (request()->routeIs('admin.deposit*') && !request()->routeIs('admin.settings.gateway*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Deposits</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.deposit*') || request()->routeIs('admin.settings.gateway*')) rotate-90 @endif"
                        data-menu-id="3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.deposit*') && !request()->routeIs('admin.settings.gateway*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="3">
                <ul class="space-y-2 text-sm nav-text">
                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.deposits.index')) active-submenu @endif"
                            href="{{ route('admin.deposits.index') }}">All</a>
                    </li>

                    @if (isAddonEnabled('manualdeposit'))
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.deposit-method.index')) active-submenu @endif"
                                href="{{ route('admin.deposit-method.index') }}">Manual Methods</a>
                        </li>


                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.deposit-method.new')) active-submenu @endif"
                                href="{{ route('admin.deposit-method.new') }}">Add New Method</a>
                        </li>
                    @endif

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.settings.gateways.index')) active-submenu @endif"
                            href="{{ route('admin.settings.gateways.index') }}">Automatic Gateways</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  deposits ends here --}}

        {{--  withdrawals starts here --}}
        <div class="dropdown-with-caret" data-menu-id="11">
            <a role="button"
                class="@if (request()->routeIs('admin.withdrawals*') || request()->routeIs('admin.wallets*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Withdrawals</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.withdrawals*') || request()->routeIs('admin.wallets*')) rotate-90 @endif"
                        data-menu-id="11" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.withdrawals*') && !request()->routeIs('admin.wallets*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="11">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.withdrawals.index')) active-submenu @endif"
                            href="{{ route('admin.withdrawals.index') }}">All Withdrawals</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.withdrawals.pending')) active-submenu @endif"
                            href="{{ route('admin.withdrawals.pending') }}">Pending Withdrawals</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.wallets.index')) active-submenu @endif"
                            href="{{ route('admin.wallets.index') }}">User Wallets</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  withdrawals ends here --}}

        {{--  investments starts here --}}
        <div class="dropdown-with-caret" data-menu-id="5">
            <a role="button"
                class="@if (request()->routeIs('admin.investment*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Investments</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.investment*')) rotate-90 @endif"
                        data-menu-id="5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.investment*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="5">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.investments.index')) active-submenu @endif"
                            href="{{ route('admin.investments.index') }}">All Investments</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.investment-plans.index')) active-submenu @endif"
                            href="{{ route('admin.investment-plans.index') }}">Plans</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.investment-plans.new')) active-submenu @endif"
                            href="{{ route('admin.investment-plans.new') }}">Add New Plan</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  investment ends here --}}

        @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
            {{--  loans starts here --}}
            <div class="dropdown-with-caret" data-menu-id="6">
                <a role="button"
                    class="@if (request()->routeIs('admin.loan*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="opacity-100  nav-text">
                            <span class="font-semibold">Loans</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.loan*')) rotate-90 @endif"
                            data-menu-id="6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('admin.loan*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="6">
                    <ul class="space-y-2 text-sm nav-text">

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.loans.index')) active-submenu @endif"
                                href="{{ route('admin.loans.index') }}">All Loans</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.loans.pending')) active-submenu @endif"
                                href="{{ route('admin.loans.pending') }}">Pending Loans</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.loans.unpaid')) active-submenu @endif"
                                href="{{ route('admin.loans.unpaid') }}">Unpaid Loans</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.loans.overdue')) active-submenu @endif"
                                href="{{ route('admin.loans.overdue') }}">Overdue Loans</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.loans-plans.index')) active-submenu @endif"
                                href="{{ route('admin.loans-plans.index') }}">Loan Plans</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.loans-plans.new')) active-submenu @endif"
                                href="{{ route('admin.loans-plans.new') }}">Add New Plan</a>
                        </li>

                    </ul>
                </div>
            </div>

            {{--  loan ends here --}}
        @endif

        {{-- nft starts here --}}
        @if (isAddonEnabled('nft'))
            
            <div class="dropdown-with-caret" data-menu-id="151">
                <a role="button"
                    class="@if (request()->routeIs('admin.nft*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-input-cursor-text w-6 h-6" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M5 2a.5.5 0 0 1 .5-.5c.862 0 1.573.287 2.06.566.174.099.321.198.44.286.119-.088.266-.187.44-.286A4.165 4.165 0 0 1 10.5 1.5a.5.5 0 0 1 0 1c-.638 0-1.177.213-1.564.434a3.49 3.49 0 0 0-.436.294V7.5H9a.5.5 0 0 1 0 1h-.5v4.272c.1.08.248.187.436.294.387.221.926.434 1.564.434a.5.5 0 0 1 0 1 4.165 4.165 0 0 1-2.06-.566A4.561 4.561 0 0 1 8 13.65a4.561 4.561 0 0 1-.44.285 4.165 4.165 0 0 1-2.06.566.5.5 0 0 1 0-1c.638 0 1.177-.213 1.564-.434.188-.107.335-.214.436-.294V8.5H7a.5.5 0 0 1 0-1h.5V3.228a3.49 3.49 0 0 0-.436-.294A3.166 3.166 0 0 0 5.5 2.5.5.5 0 0 1 5 2z"/> <path d="M10 5h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4v1h4a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-4v1zM6 5V4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v-1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4z"/> </svg>

                        </div>
                        <div class="opacity-100  nav-text">
                            <span class="font-semibold">NFT</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.nft*')) rotate-90 @endif"
                            data-menu-id="151" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('admin.nft*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="151">
                    <ul class="space-y-2 text-sm nav-text">

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.nft.index')) active-submenu @endif"
                                href="{{ route('admin.nft.index') }}">All NFTs</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.nft.gas-fee')) active-submenu @endif"
                                href="{{ route('admin.nft.gas-fee') }}">Gas Fee Setting</a>
                        </li>
                        

                    </ul>
                </div>
            </div>

            
        @endif
        {{-- nft ends here --}}

        @if (websiteInfo('balance_transfer') == 'enabled' && isAddonEnabled('p2ptransfer'))
            {{--  transfers starts here --}}
            <div class="dropdown-with-caret" data-menu-id="15">
                <a role="button"
                    class="@if (request()->routeIs('admin.transfers*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z">
                                </path>
                            </svg>
                        </div>
                        <div class="opacity-100  nav-text">
                            <span class="font-semibold">Transfers</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.transfers*')) rotate-90 @endif"
                            data-menu-id="15" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('admin.transfers*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="15">
                    <ul class="space-y-2 text-sm nav-text">

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.transfers.index')) active-submenu @endif"
                                href="{{ route('admin.transfers.index') }}">All Transfers</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.transfers.pending')) active-submenu @endif"
                                href="{{ route('admin.transfers.pending') }}">Pending Transfers</a>
                        </li>


                    </ul>
                </div>
            </div>

            {{--  transfers ends here --}}
        @endif

        {{--  transaction log --}}
        <a href="{{ route('admin.transactions.index') }}"
            @if (request()->routeIs('admin.transactions.index')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Transactions</span>
            </div>
        </a>
        {{--  transaction logo --}}


        {{--  faq starts here --}}
        <div class="dropdown-with-caret" data-menu-id="4">
            <a role="button"
                class="@if (request()->routeIs('admin.faqs*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">FAQs</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.faqs*')) rotate-90 @endif"
                        data-menu-id="4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.faqs*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="4">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.faqs.index')) active-submenu @endif"
                            href="{{ route('admin.faqs.index') }}">Questions</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.faqs.new')) active-submenu @endif"
                            href="{{ route('admin.faqs.new') }}">Add New</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  faq methods ends here --}}

        @if (isAddonEnabled('supportticket'))
            {{--  tickets starts here --}}
            <div class="dropdown-with-caret" data-menu-id="7">
                <a role="button"
                    class="@if (request()->routeIs('admin.ticket*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="opacity-100  nav-text">
                            <span class="font-semibold">Support Tickets</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.tickets*')) rotate-90 @endif"
                            data-menu-id="7" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('admin.tickets*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="7">
                    <ul class="space-y-2 text-sm nav-text">

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.tickets.index')) active-submenu @endif"
                                href="{{ route('admin.tickets.index') }}">All Tickets</a>
                        </li>

                        <li>
                            <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.tickets.new')) active-submenu @endif"
                                href="{{ route('admin.tickets.new') }}">Create Ticket</a>
                        </li>

                    </ul>
                </div>
            </div>

            {{--  tickets ends here --}}
        @endif

        {{--  testimonial starts here --}}
        <div class="dropdown-with-caret" data-menu-id="8">
            <a role="button"
                class="@if (request()->routeIs('admin.testimonials*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Reviews</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.testimonials*')) rotate-90 @endif"
                        data-menu-id="8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.testimonials*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="8">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.testimonials.index')) active-submenu @endif"
                            href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.testimonials.new')) active-submenu @endif"
                            href="{{ route('admin.testimonials.new') }}">Add New</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  testimonial ends here --}}

        {{--  teams starts here --}}
        <div class="dropdown-with-caret" data-menu-id="9">
            <a role="button"
                class="@if (request()->routeIs('admin.teams*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Team Members</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.teams*')) rotate-90 @endif"
                        data-menu-id="9" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.teams*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="9">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.teams.index')) active-submenu @endif"
                            href="{{ route('admin.teams.index') }}">Members</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.teams.new')) active-submenu @endif"
                            href="{{ route('admin.teams.new') }}">Add New</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  teams ends here --}}

        {{--  blog starts here --}}
        <div class="dropdown-with-caret" data-menu-id="20">
            <a role="button"
                class="@if (request()->routeIs('admin.blogs*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Blogs</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.blogs*')) rotate-90 @endif"
                        data-menu-id="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.blogs*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="20">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.blogs.index')) active-submenu @endif"
                            href="{{ route('admin.blogs.index') }}">Published Posts</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.blogs.new')) active-submenu @endif"
                            href="{{ route('admin.blogs.new') }}">Add New Post</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  blogs ends here --}}

        {{--  file manager --}}
        <a href="{{ route('admin.file-manager.index') }}"
            @if (request()->routeIs('admin.file-manager.index')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                        clip-rule="evenodd"></path>
                    <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">File Manager</span>
            </div>
        </a>
        {{--  file manager --}}

        <hr class="w-full border-b border-dotted border-gray-600 border my-5">
        <h6 @if (request()->routeIs('admin.settings*') && !request()->routeIs('admin.settings.gateway*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                    clip-rule="evenodd"></path>
            </svg>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Settings</span>
            </div>
        </h6>
        <hr class="w-full border-b border-dotted border-gray-600 border my-5">
        {{--  System Manager setting --}}
        <a href="{{ route('admin.system-manager.index') }}"
            @if (request()->routeIs('admin.system-manager.index')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">System</span>
            </div>
        </a>
        {{--  core setting --}}

        {{--  core setting --}}
        <a href="{{ route('admin.settings.core') }}"
            @if (request()->routeIs('admin.settings.core')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor"
                    class="bi bi-app-indicator" viewBox="0 0 16 16">
                    <path
                        d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z" />
                    <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Core</span>
            </div>
        </a>
        {{--  core setting --}}



        {{--  logo and seo setting --}}
        <a href="{{ route('admin.settings.logo-seo') }}"
            @if (request()->routeIs('admin.settings.logo-seo')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Logo & SEO</span>
            </div>
        </a>
        {{--  logo and seo setting --}}

        {{--  sections setting --}}
        <a href="{{ route('admin.settings.sections.index') }}"
            @if (request()->routeIs('admin.settings.sections*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z">
                    </path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Sections</span>
            </div>
        </a>
        {{--  sections setting --}}

        {{--  security setting --}}
        <a href="{{ route('admin.settings.security-otp') }}"
            @if (request()->routeIs('admin.settings.security-otp*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Security & OTP</span>
            </div>
        </a>
        {{--  security setting --}}

        {{--  email starts here --}}
        <div class="dropdown-with-caret" data-menu-id="12">
            <a role="button"
                class="@if (request()->routeIs('admin.settings.email*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Email Setting</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.settings.email*')) rotate-90 @endif"
                        data-menu-id="12" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.settings.email*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="12">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.settings.email-config')) active-submenu @endif"
                            href="{{ route('admin.settings.email-config') }}">Email Config</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.settings.email-templates')) active-submenu @endif"
                            href="{{ route('admin.settings.email-templates') }}">Email Templates</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  email ends here --}}

        {{--  livechat setting --}}
        <a href="{{ route('admin.settings.livechat') }}"
            @if (request()->routeIs('admin.settings.livechat')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                    <path
                        d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z">
                    </path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Livechat</span>
            </div>
        </a>
        {{--  livechat setting --}}

        {{--  Addons --}}
        <a href="{{ route('admin.addons.index') }}"
            @if (request()->routeIs('admin.addons.index')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z">
                    </path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Addons</span>
            </div>
        </a>
        {{--  Addons --}}

        {{--  theme manager setting --}}
        <div class="dropdown-with-caret" data-menu-id="13">
            <a role="button"
                class="@if (request()->routeIs('admin.settings.theme-manager*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                        </path>
                    </svg>
                    <div class="opacity-100  nav-text">
                        <span class="font-semibold">Theme Manager</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret @if (request()->routeIs('admin.settings.theme-manager*')) rotate-90 @endif"
                        data-menu-id="13" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('admin.settings.theme-manager*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="13">
                <ul class="space-y-2 text-sm nav-text">

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.settings.theme-manager.themes')) active-submenu @endif"
                            href="{{ route('admin.settings.theme-manager.themes') }}">Active Themes</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.settings.theme-manager.exports')) active-submenu @endif"
                            href="{{ route('admin.settings.theme-manager.exports') }}">Upload & Archives</a>
                    </li>

                    <li>
                        <a class="text-gray-400 hover:text-gray-500 @if (request()->routeIs('admin.settings.theme-manager.new-theme')) active-submenu @endif"
                            href="{{ route('admin.settings.theme-manager.new-theme') }}">Create New Theme</a>
                    </li>

                </ul>
            </div>
        </div>
        {{--  theme manager setting --}}

        {{--  misc setting --}}
        <a href="{{ route('admin.settings.misc') }}"
            @if (request()->routeIs('admin.settings.misc')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.649 3.084A1 1 0 015.163 4.4 13.95 13.95 0 004 10c0 1.993.416 3.886 1.164 5.6a1 1 0 01-1.832.8A15.95 15.95 0 012 10c0-2.274.475-4.44 1.332-6.4a1 1 0 011.317-.516zM12.96 7a3 3 0 00-2.342 1.126l-.328.41-.111-.279A2 2 0 008.323 7H8a1 1 0 000 2h.323l.532 1.33-1.035 1.295a1 1 0 01-.781.375H7a1 1 0 100 2h.039a3 3 0 002.342-1.126l.328-.41.111.279A2 2 0 0011.677 14H12a1 1 0 100-2h-.323l-.532-1.33 1.035-1.295A1 1 0 0112.961 9H13a1 1 0 100-2h-.039zm1.874-2.6a1 1 0 011.833-.8A15.95 15.95 0 0118 10c0 2.274-.475 4.44-1.332 6.4a1 1 0 11-1.832-.8A13.949 13.949 0 0016 10c0-1.993-.416-3.886-1.165-5.6z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Miscellaneous</span>
            </div>
        </a>
        {{--  misc setting --}}

        {{--  custom css setting --}}
        <a href="{{ route('admin.settings.custom-css') }}"
            @if (request()->routeIs('admin.settings.custom-css')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Custom CSS</span>
            </div>
        </a>
        {{--  custom css setting --}}

        {{--  custom js setting --}}
        <a href="{{ route('admin.settings.custom-js') }}"
            @if (request()->routeIs('admin.settings.custom-js')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Custom JS</span>
            </div>
        </a>
        {{--  custom js setting --}}

        {{--  custom js setting --}}
        <a href="{{ route('admin.settings.custom-php') }}"
            @if (request()->routeIs('admin.settings.custom-php')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="opacity-100 nav-text">
                <span class="font-semibold">Custom PHP</span>
            </div>
        </a>
        {{--  custom js setting --}}

        {{--  empty space  to assist default scroll --}}
        <div class="h-44"></div>
        {{--  empty space --}}

    </nav>
    {{-- End nav --}}

</div>
