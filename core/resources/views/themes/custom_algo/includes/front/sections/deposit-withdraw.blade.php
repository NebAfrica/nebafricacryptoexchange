@foreach ($view_data['sections']->where('name', 'deposit_withdraw') as $section)
    <section class="w-full h-full faq-section bg-[#0e1726] text-white pb-28">
        <div class="pt-32">
            <div class="flex justify-center" data-aos="fade-up" data-aos-duration="3000">
                <div class="flex justify-center items-center">
                    <div>
                        <h2 class="capitalize text-6xl sm-font-6 font-bold">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div
                            class="mt-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                        </div>
                    </div>
                </div>
            </div>

            <div  class="flex justify-center items-center my-7 px-10" data-aos="fade-up" data-aos-duration="3000">
                <div class="font-semibold text-xl sm-font-4">
                    {!! json_decode($section->content)->section_text !!}
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center my-7" data-aos="fade-up" data-aos-duration="3000">
            <div class="bg-[#111f35] rounded-3xl w-11/12 md:w-3/5 p-5">
                <div class="w-full">
                    <div class="w-full relative flex mb-4 bg-[#0e1726] rounded-lg">
                        <div class="w-1/2 py-5 bg-orange-500 rounded-lg dw-toggle" role="button"
                            data-target="deposits">
                            <div class="font-semibold text-xl sm-font-4 flex justify-center">
                                Deposits
                            </div>
                        </div>
                        <div class="w-1/2 py-5 rounded-lg dw-toggle" role="button" data-target="deposits">
                            <div class="font-semibold text-xl sm-font-4 flex justify-center">
                                Withdrawals
                            </div>
                        </div>
                    </div>
                    <div class="w-full relative dw-table">
                        <div
                            class="w-full flex justify-evenly sm-font-1 space-x-2 py-5 header bg-orange-500 text-white font-bold capitalize rounded-lg">
                            <div class="cell">
                                User
                            </div>
                            <div class="cell">
                                Date
                            </div>
                            <div class="cell">
                                Amount
                            </div>
                            <div class="cell">
                                Status
                            </div>

                        </div>
                        @foreach ($view_data['deposits'] as $deposit)
                            <div
                                class="table-row w-full flex justify-evenly space-x-2  py-5 rounded-lg text-white sm-font-1">
                                <div class="cell" data-title="{{ adminUser($deposit->user_id, 'first_name') }}">
                                    {{ adminUser($deposit->user_id, 'first_name') }}
                                </div>
                                <div class="cell" data-title="{{ formatAmount($deposit->amount) }}">
                                    {{ formatAmount($deposit->amount) }}
                                </div>
                                <div class="cell" data-title="{{ formatPastDate(strtotime($deposit->created_at)) }}">
                                    {{ formatPastDate(strtotime($deposit->created_at)) }}
                                </div>
                                <div class="cell" data-title="approved">
                                    Approved
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="w-full relative dw-table hidden">
                        <div
                            class="w-full flex justify-evenly sm-font-1 space-x-2 py-5 header bg-orange-500 text-white font-bold capitalize rounded-lg">
                            <div class="cell">
                                User
                            </div>
                            <div class="cell">
                                Date
                            </div>
                            <div class="cell">
                                Amount
                            </div>
                            <div class="cell">
                                Status
                            </div>

                        </div>
                        @foreach ($view_data['withdrawals'] as $withdrawal)
                            <div
                                class="table-row w-full flex justify-evenly space-x-2  py-5 rounded-lg text-white sm-font-1">
                                <div class="cell" data-title="{{ adminUser($withdrawal->user_id, 'first_name') }}">
                                    {{ adminUser($withdrawal->user_id, 'first_name') }}
                                </div>
                                <div class="cell" data-title="{{ formatAmount($withdrawal->amount) }}">
                                    {{ formatAmount($withdrawal->amount) }}
                                </div>
                                <div class="cell"
                                    data-title="{{ formatPastDate(strtotime($withdrawal->created_at)) }}">
                                    {{ formatPastDate(strtotime($withdrawal->created_at)) }}
                                </div>
                                <div class="cell" data-title="approved">
                                    Approved
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('.dw-toggle').on('click', function() {
            $('.dw-toggle').removeClass('bg-orange-500');
            $(this).addClass('bg-orange-500');
            $('.dw-table').toggleClass('hidden');
        });
    </script>
@endforeach
