@if (session()->has('fail') || session()->has('success'))
    <div>
        <div>
            <div>
                <div>
                    <div>
                        @if (session()->has('fail'))
                            <div>
                                <div>
                                    <div>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <b>Error! </b> {{ session()->get('fail') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div>
                                <div>
                                    <div>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <b>Success! </b> {{ session()->get('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div>
                            <a role="button">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
