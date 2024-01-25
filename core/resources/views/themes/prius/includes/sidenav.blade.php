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
        <a href="{{ route('user.dashboard') }}"
            @if (request()->routeIs('user.dashboard')) class="sidenav-link-active" @else class="sidenav-link" @endif>
            <div class="opacity-100">
                <svg  class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
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

        {{--  KYC --}}
        @if (websiteInfo('id_verification') == 'enabled' && isAddonEnabled('kyc'))
            <a href="{{ route('user.id.status') }}"
                @if (request()->routeIs('user.id*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">KYC</span>
                </div>
            </a>
        @endif
        {{--  KYC --}}

        @if (websiteInfo('trader_mode') == 'enabled' && isAddonEnabled('cryptotrading'))
            <a href="{{ route('user.trading.wallets.index') }}"
                @if (request()->routeIs('user.trading.wallets.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
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

            <a href="{{ route('user.trading.trade.trade', ['symbol1' => 'BTC', 'symbol2' => 'USDT']) }}"
                @if (request()->routeIs('user.trading.trade.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">Trade</span>
                </div>
            </a>

            <a href="{{ route('user.trading.demo.index') }}" @if (request()->routeIs('user.trading.demo.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
                <div class="opacity-100">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="opacity-100 nav-text">
                    <span class="font-semibold">Demo Trade</span>
                </div>
            </a>

            <a href="{{ route('user.trading.coin-stakings.index') }}"
                @if (request()->routeIs('user.trading.coin-staking.*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
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

            <a href="{{ route('user.trading.trade.bot', ['symbol1' => 'BTC', 'symbol2' => 'USDT']) }}"
                @if (request()->routeIs('user.trading.trade.bot*')) class="sidenav-link-active" @else class="sidenav-link" @endif>
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
        {{--  trading menu --}}


        {{--  deposit starts here --}}
        <div class="dropdown-with-caret" data-menu-id="3">
            <a href="#"
                class="@if (request()->routeIs('user.deposit*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100 nav-text">
                        <span class="font-semibold">Deposits</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="3"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('user.deposit*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="3">
                <ul class="space-y-2 text-sm nav-text">
                    <li>
                        <a class="text-gray-400 hover:text-gray-500" href="{{ route('user.deposit.new') }}">New</a>
                    </li>
                    <li>
                        <a class="text-gray-400 hover:text-gray-500"
                            href="{{ route('user.deposit.index') }}">History</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  deposit ends here --}}

        {{--  transfer starts here --}}
        @if (websiteInfo('balance_transfer') == 'enabled' && isAddonEnabled('p2ptransfer'))
            <div class="dropdown-with-caret" data-menu-id="4">
                <a href="#"
                    class="@if (request()->routeIs('user.transfer*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z">
                                </path>
                            </svg>
                        </div>
                        <div class="opacity-100 nav-text">
                            <span class="font-semibold">Transfers</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="4"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('user.transfer*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="4">
                    <ul class="space-y-2 text-sm nav-text">
                        <li>
                            <a class="text-gray-400 hover:text-gray-500"
                                href="{{ route('user.transfer.new') }}">New</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500"
                                href="{{ route('user.transfer.index') }}">History</a>
                        </li>

                    </ul>
                </div>
            </div>
        @endif
        {{--  transfer ends here --}}


        {{--  loan starts here --}}
        @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
            <div class="dropdown-with-caret" data-menu-id="5">
                <a href="#"
                    class="@if (request()->routeIs('user.loan*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="opacity-100 nav-text">
                            <span class="font-semibold">Loans</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="5"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('user.loan*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="5">
                    <ul class="space-y-2 text-sm nav-text">
                        <li>
                            <a class="text-gray-400 hover:text-gray-500"
                                href="{{ route('user.loan.new') }}">Borrow</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500"
                                href="{{ route('user.loan.index') }}">History</a>
                        </li>

                    </ul>
                </div>
            </div>
        @endif
        {{--  loan ends here --}}

        {{--  Investment starts here --}}
        <div class="dropdown-with-caret" data-menu-id="6">
            <a href="#"
                class="@if (request()->routeIs('user.investments*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100 nav-text">
                        <span class="font-semibold">Investments</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="6"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('user.investments*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="6">
                <ul class="space-y-2 text-sm nav-text">
                    <li>
                        <a class="text-gray-400 hover:text-gray-500"
                            href="{{ route('user.investments.new') }}">New</a>
                    </li>
                    <li>
                        <a class="text-gray-400 hover:text-gray-500"
                            href="{{ route('user.investments.index') }}">History</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  wallets ends here --}}

        {{--  Investment starts here --}}
        <div class="dropdown-with-caret" data-menu-id="7">
            <a href="#"
                class="@if (request()->routeIs('user.wallets*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100 nav-text">
                        <span class="font-semibold">Wallets</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="7"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('user.wallets*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="7">
                <ul class="space-y-2 text-sm nav-text">
                    <li>
                        <a class="text-gray-400 hover:text-gray-500" href="{{ route('user.wallets.new') }}">New</a>
                    </li>
                    <li>
                        <a class="text-gray-400 hover:text-gray-500"
                            href="{{ route('user.wallets.index') }}">Wallets</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  wallets ends here --}}

        {{--  Withdrawal starts here --}}
        <div class="dropdown-with-caret" data-menu-id="8">
            <a href="#"
                class="@if (request()->routeIs('user.withdrawals*')) sidenav-link-active @else sidenav-link @endif justify-between">
                <div class="sidenav-link-inner">
                    <div class="opacity-100">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z">
                            </path>
                        </svg>
                    </div>
                    <div class="opacity-100 nav-text">
                        <span class="font-semibold">Withdrawals</span>
                    </div>
                </div>
                <div class="nav-text">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="8"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div class="@if (!request()->routeIs('user.withdrawals*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                data-menu-id="8">
                <ul class="space-y-2 text-sm nav-text">
                    <li>
                        <a class="text-gray-400 hover:text-gray-500" href="{{ route('user.withdrawals.new') }}">New
                            Request</a>
                    </li>
                    <li>
                        <a class="text-gray-400 hover:text-gray-500"
                            href="{{ route('user.wallets.index') }}">History</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  withdrawal ends here --}}

        {{--  transaction log --}}
        <a href="{{ route('user.transactions') }}"
            @if (request()->routeIs('user.transactions')) class="sidenav-link-active" @else class="sidenav-link" @endif>
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

        @if (isAddonEnabled('supportticket'))
            {{--  Support ticket starts here --}}
            <div class="dropdown-with-caret" data-menu-id="9">
                <a href="#"
                    class="@if (request()->routeIs('user.tickets*')) sidenav-link-active @else sidenav-link @endif justify-between">
                    <div class="sidenav-link-inner">
                        <div class="opacity-100">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="opacity-100 nav-text">
                            <span class="font-semibold">Support Tickets</span>
                        </div>
                    </div>
                    <div class="nav-text">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-right transition ease-in-out delay-150 the-caret" data-menu-id="9"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div class="@if (!request()->routeIs('user.tickets*')) hidden @endif mt-2 pl-5 transition ease-in-out delay-150 the-menu"
                    data-menu-id="9">
                    <ul class="space-y-2 text-sm nav-text">
                        <li>
                            <a class="text-gray-400 hover:text-gray-500" href="{{ route('user.tickets.new') }}">New
                                Ticket</a>
                        </li>
                        <li>
                            <a class="text-gray-400 hover:text-gray-500" href="{{ route('user.tickets.index') }}">My
                                Tickets</a>
                        </li>

                    </ul>
                </div>
            </div>

            {{--  Support Tickets ends here --}}
        @endif
        {{--  empty space  to assist default scroll --}}
        <div class="h-44"></div>
        {{--  empty space --}}


    </nav>
    {{-- End nav --}}

</div>
