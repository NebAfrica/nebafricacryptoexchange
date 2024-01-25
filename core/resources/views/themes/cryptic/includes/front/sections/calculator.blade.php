@foreach ($view_data['sections']->where('name', 'calculator') as $section)
    <section class="h-full hero-section bg-[#0e1726] text-white pb-28">
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

        <div class="w-full flex justify-center z-10" data-aos="fade-up" data-aos-duration="3000">
            <div class="w-11/12 md:w-3/5 h-60 flex justify-center items-center bg-[#111f35] border-4 border-orange-500 rounded-xl">
                <div class="w-11/12 block md:flex justify-center items-center md:space-x-3 relative z-2">
                    <div class="">
                        <select name="plan" id="cal_plan"
                            class="w-full px-10 py-5 text-xl sm-font-4 bg-[#0e1726] rounded-xl outline-none">
                            <option value="" selected disabled>Select Plan</option>
                            @foreach ($view_data['plans'] as $plan)
                                <option value="{{ $plan->name }}" data-amount_type="{{ $plan->amount_type }}"
                                    data-min_amount="{{ $plan->min_amount }}" data-max_amount="{{ $plan->max_amount }}"
                                    data-return_type="{{ $plan->return_type }}" data-return="{{ $plan->return }}"
                                    data-duration="{{ $plan->duration }}"
                                    data-duration_type="{{ $plan->duration_type }}">{{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:my-3">
                        <input type="number" step="any" name="amount" id="calc_plan_amount"
                            placeholder="Enter Amount"
                            class="w-full px-10 py-5 text-xl sm-font-4 bg-[#0e1726] rounded-xl outline-none" required>
                    </div>

                    <div class="">
                        <button id="cal_submit_button"
                            class="uppercase text-xl sm-font-4 font-bold rounded-full px-14 py-4 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">Calculate</button>
                    </div>

                </div>

            </div>
        </div>
        <div class="w-full flex justify-center mt-5 hidden" id="result-wrapper">
            <div class="w-11/12 md:w-3/5 h-60 flex justify-center items-center bg-[#111f35] border-4 border-orange-500 rounded-xl">
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
    </section>
@endforeach
