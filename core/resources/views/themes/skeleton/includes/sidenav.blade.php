<div data-status='full'>

    {{-- Close button icon --}}
    <div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>

    {{-- navs --}}
    <nav>
        <a href="{{ route('user.dashboard') }}" @if (request()->routeIs('user.dashboard')) @else @endif>
            <div>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
            </div>
            <div>
                <span>Dashboard</span>
            </div>
        </a>

        {{--  KYC --}}
        @if (websiteInfo('id_verification') == 'enabled' && isAddonEnabled('kyc'))
            <a href="{{ route('user.id.status') }}" @if (request()->routeIs('user.id*')) @else @endif>
                <div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span>KYC</span>
                </div>
            </a>
        @endif
        {{--  !KYC --}}

        @if (websiteInfo('trader_mode') == 'enabled' && isAddonEnabled('cryptotrading'))
            <a href="{{ route('user.trading.wallets.index') }}" @if (request()->routeIs('user.trading.wallets.*')) @else @endif>
                <div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 7H7v6h6V7z"></path>
                        <path fill-rule="evenodd"
                            d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span>Trading Wallets</span>
                </div>
            </a>

            <a href="{{ route('user.trading.trade.index') }}" @if (request()->routeIs('user.trading.trade.*')) @else @endif>
                <div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span>Trade</span>
                </div>
            </a>

            <a href="{{ route('user.trading.coin-stakings.index') }}" @if (request()->routeIs('user.trading.coin-staking.*')) @else @endif>
                <div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <span>Staking</span>
                </div>
            </a>

            <a href="{{ route('user.trading.trade.bot', ['symbol1' => 'BTC', 'symbol2' => 'USDT']) }}"
                @if (request()->routeIs('user.trading.trade.bot*')) @else @endif>
                <div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <span>Trading Bots</span>
                </div>
            </a>
        @endif
        {{--  !trading menu --}}


        {{--  deposit starts here --}}
        <div data-menu-id="3">
            <a href="#">
                <div>
                    <div>
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <span>Deposits</span>
                    </div>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div data-menu-id="3">
                <ul>
                    <li>
                        <a href="{{ route('user.deposit.new') }}">New</a>
                    </li>
                    <li>
                        <a href="{{ route('user.deposit.index') }}">History</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  deposit ends here --}}

        {{--  transfer starts here --}}
        @if (websiteInfo('balance_transfer') == 'enabled' && isAddonEnabled('p2ptransfer'))
            <div data-menu-id="4">
                <a href="#">
                    <div>
                        <div>
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span>Transfers</span>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div data-menu-id="4">
                    <ul>
                        <li>
                            <a href="{{ route('user.transfer.new') }}">New</a>
                        </li>
                        <li>
                            <a href="{{ route('user.transfer.index') }}">History</a>
                        </li>

                    </ul>
                </div>
            </div>
        @endif
        {{--  transfer ends here --}}


        {{--  loan starts here --}}
        @if (websiteInfo('loan') == 'enabled' && isAddonEnabled('cryptoloan'))
            <div data-menu-id="5">
                <a href="#">
                    <div>
                        <div>
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <span>Loans</span>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div data-menu-id="5">
                    <ul>
                        <li>
                            <a href="{{ route('user.loan.new') }}">Borrow</a>
                        </li>
                        <li>
                            <a href="{{ route('user.loan.index') }}">History</a>
                        </li>

                    </ul>
                </div>
            </div>
        @endif
        {{--  loan ends here --}}

        {{--  Investment starts here --}}
        <div data-menu-id="6">
            <a href="#">
                <div>
                    <div>
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <span>Investments</span>
                    </div>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="6" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div data-menu-id="6">
                <ul>
                    <li>
                        <a href="{{ route('user.investments.new') }}">New</a>
                    </li>
                    <li>
                        <a href="{{ route('user.investments.index') }}">History</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  wallets ends here --}}

        {{--  Investment starts here --}}
        <div data-menu-id="7">
            <a href="#">
                <div>
                    <div>
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path
                                d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <span>Wallets</span>
                    </div>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="7" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div data-menu-id="7">
                <ul>
                    <li>
                        <a href="{{ route('user.wallets.new') }}">New</a>
                    </li>
                    <li>
                        <a href="{{ route('user.wallets.index') }}">Wallets</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  wallets ends here --}}

        {{--  Withdrawal starts here --}}
        <div data-menu-id="8">
            <a href="#">
                <div>
                    <div>
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <span>Withdrawals</span>
                    </div>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="8" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </a>

            <div data-menu-id="8">
                <ul>
                    <li>
                        <a href="{{ route('user.withdrawals.new') }}">New Request</a>
                    </li>
                    <li>
                        <a href="{{ route('user.wallets.index') }}">History</a>
                    </li>

                </ul>
            </div>
        </div>

        {{--  withdrawal ends here --}}

        {{--  transaction log --}}
        <a href="{{ route('user.transactions') }}" @if (request()->routeIs('user.transactions')) @else @endif>
            <div>
                <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <span>Transactions</span>
            </div>
        </a>
        {{--  transaction logo --}}

        @if (isAddonEnabled('supportticket'))
            {{--  Support ticket starts here --}}
            <div data-menu-id="9">
                <a href="#">
                    <div>
                        <div>
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <span>Support Tickets</span>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" data-menu-id="9" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </a>

                <div data-menu-id="9">
                    <ul>
                        <li>
                            <a href="{{ route('user.tickets.new') }}">New Ticket</a>
                        </li>
                        <li>
                            <a href="{{ route('user.tickets.index') }}">My Tickets</a>
                        </li>

                    </ul>
                </div>
            </div>

            {{--  Support Tickets ends here --}}
        @endif
        {{--  empty space  to assist default scroll --}}
        <div></div>
        {{--  empty space --}}


    </nav>
    {{-- End nav --}}

</div>
