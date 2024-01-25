{{-- calculator section starts here --}}
@foreach ($view_data['sections']->where('name', 'calculator') as $section)
    <section class="profit-calculation padding-bottom padding-top section-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="section__thumb profit__calculation__thumb rtl me-5">
                        <img src="{{ asset('public/assets/themes/prius/assets/images/calculate-profit/thumb.png') }}"
                            alt="profit-calculation">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="profit__calculation__content">
                        <div class="section__header">
                            <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                            <div>
                                {!! json_decode($section->content)->section_text !!}
                            </div>
                        </div>
                        <form class="profit__calculation__form">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-12 col-xl-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Plan</label>
                                        <select name="plan" id="cal_plan" class="nice-select w-100 h-50">
                                            <option value="" selected disabled>Select Plan</option>
                                            @foreach ($view_data['plans'] as $plan)
                                                <option value="{{ $plan->name }}"
                                                    data-amount_type="{{ $plan->amount_type }}"
                                                    data-min_amount="{{ $plan->min_amount }}"
                                                    data-max_amount="{{ $plan->max_amount }}"
                                                    data-return_type="{{ $plan->return_type }}"
                                                    data-return="{{ $plan->return }}"
                                                    data-duration="{{ $plan->duration }}"
                                                    data-duration_type="{{ $plan->duration_type }}">
                                                    {{ $plan->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-12 col-xl-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Amount</label>
                                        <input type="number" step="any" name="amount" id="calc_plan_amount"
                                            class="form-control form--control" placeholder="Enter Amount" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                                    <div class="form-group">
                                        <button id="cal_submit_button" class="cmn--btn">Calculate</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <style>
                            .hidden {
                                display: none;
                            }
                        </style>
                        <div id="result-wrapper" class="hidden">
                            <div>
                                <div id="errorDiv" class="bg-red-500"></div>
                                <div id="calc_result" class="hidden">

                                    <div id="final_result" class="bg-green-500"></div>
                                    <p class="tex-white">
                                        <b>Plan: </b> <span id="calc_result_name"></span> <br>

                                        <b>Amount: </b> <span id="calc_result_min_amount"></span> <span
                                            id="calc_result_max_amount"></span> <br>
                                        <b>ROI: </b> <span id="calc_result_return"></span> <br>
                                        <b>Duration: </b> <span id="calc_result_duration"></span> <span
                                            id="calc_result_duration_type"></span>(s)<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
