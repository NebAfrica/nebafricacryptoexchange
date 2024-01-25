@foreach ($view_data['sections']->where('name', 'plans') as $section)
    <section class="w-full h-full plans-section bg-[#0e1726] text-white lg:px-20 pb-28">
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

        <div class="w-full grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 place-items-center z-10">
            @foreach ($view_data['plans'] as $plan)
                <div data-aos="fade-up" data-aos-duration="3000"
                    class="h-80 w-10/12 md:w-56 border-4 border-orange-500 rounded-lg bg-[#0A091B] bg-[url('../../../../../../../../public/assets/ifront/plan.png')] bg-cover bg-no-repeat">
                    <div class="w-full flex justify-center mt-5">
                        <h4 class="capitalize font-bold text-xl sm-font-4">{{ $plan->name }}</h4>
                        <span class="text-xs text-orange-500">{{ $plan->label }}</span>
                    </div>

                    <div class="flex justify-center items-center w-full h-12 mt-4 bg-orange-500">
                        <h5 class="text-lg sm-font-3 font-extrabold">
                            @if ($plan->return_type == 'fixed')
                                {{ formatAmount($plan->return) }}
                            @else
                                {{ $plan->return . '%' }}
                            @endif

                            / @if ($plan->duration < 2)
                                {{ $plan->duration . ' ' . $plan->duration_type }}
                            @else
                                {{ $plan->duration . ' ' . $plan->duration_type . 's' }}
                            @endif
                        </h5>
                    </div>

                    <div class="mt-5">
                        <ul class="flex flex-col space-y-1 justify-center px-4">
                            <li class="h-1 bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl"></li>
                            @if ($plan->amount_type == 'fixed')
                                <li class="text-xs font-semibold text-center">{{ formatAmount($plan->min_amount) }}</li>
                            @else
                                <li class="text-xs font-semibold text-center">{{ formatAmount($plan->min_amount) }} -
                                    {{ formatAmount($plan->max_amount) }}</li>
                            @endif

                            <li class="h-1 bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl"></li>
                            <li class="text-xs font-semibold text-center">{{ ucwords($plan->return_interval) }}</li>
                            <li class="h-1 bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl"></li>
                            <li class="text-xs font-semibold text-center">
                                @if ($plan->return_type == 'fixed')
                                    {{ formatAmount($plan->return) . ' +Capital' }}
                                @else
                                    {{ $plan->return . '% +Capital' }}
                                @endif
                            </li>
                            <li class="h-1 bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl"></li>
                        </ul>
                    </div>

                    <div class="w-full flex justify-center items-center mt-5 relative z-2">
                        <a href="{{ route('user.investments.new') }}"
                            class="uppercase text-sm font-bold rounded-full px-8 py-2 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                            invest
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endforeach
