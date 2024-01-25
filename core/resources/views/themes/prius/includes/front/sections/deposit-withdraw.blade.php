{{-- deposit and withdraw --}}
@foreach ($view_data['sections']->where('name', 'deposit_withdraw') as $section)
    <section class="transection-section section-bg padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="section__header max-p text-center">
                        <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <ul class="transection__tab__menu nav-tabs nav border-0 justify-content-center">
                        <li><a data-bs-toggle="tab" href="#deposit" class="cmn--btn2 active">Last Deposit</a>
                        </li>
                        <li><a data-bs-toggle="tab" href="#widthdraw" class="cmn--btn2">Last Widthdraw</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show fade active" id="deposit">
                            <table class="table transection__table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_data['deposits'] as $deposit)
                                        <tr>
                                            <td data-label="User">
                                                <div class="user d-flex flex-wrap align-items-center">
                                                    <p class="name">
                                                        {{ adminUser($deposit->user_id, 'first_name') }}</p>
                                                </div>
                                            </td>
                                            <td data-label="Date"><span
                                                    class="date">{{ formatPastDate(strtotime($deposit->created_at)) }}</span>
                                            </td>
                                            <td data-label="Amount"><span
                                                    class="amount">{{ formatAmount($deposit->amount) }}</span>
                                            </td>

                                            <td data-label="Status"><span class="wallet">Approved</span></td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane show fade" id="widthdraw">
                            <table class="table transection__table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($view_data['withdrawals'] as $deposit)
                                        <tr>
                                            <td data-label="User">
                                                <div class="user d-flex flex-wrap align-items-center">
                                                    <p class="name">
                                                        {{ adminUser($deposit->user_id, 'first_name') }}</p>
                                                </div>
                                            </td>
                                            <td data-label="Date"><span
                                                    class="date">{{ formatPastDate(strtotime($deposit->created_at)) }}</span>
                                            </td>
                                            <td data-label="Amount"><span
                                                    class="amount">{{ formatAmount($deposit->amount) }}</span>
                                            </td>

                                            <td data-label="Status"><span class="wallet">Approved</span></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
