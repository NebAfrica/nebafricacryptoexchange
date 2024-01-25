{{-- investment plans starts here --}}
@foreach ($view_data['sections']->where('name', 'plans') as $section)
    <section class="plan-section padding-top padding-bottom section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section__header text-center">
                        <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($view_data['plans'] as $plan)
                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                        <div class="plan__item">
                            <div class="plan__item-footer mt-1">
                                <p class="footer-info mb-3">{{ $plan->name }}</p>
                            </div>
                            <div class="plan__item-header">
                                <h2 class="plan-parcent">
                                    @if ($plan->return_type == 'fixed')
                                        {{ formatAmount($plan->return) }}
                                    @else
                                        {{ $plan->return . '%' }}
                                    @endif
                                </h2>
                                <p class="plan-parcent-info"> After
                                    @if ($plan->duration < 2)
                                        {{ $plan->duration . ' ' . $plan->duration_type }}
                                    @else
                                        {{ $plan->duration . ' ' . $plan->duration_type . 's' }}
                                    @endif
                                </p>
                            </div>
                            <div class="plan__item-body">
                                <ul class="plan__info">
                                    @if ($plan->amount_type == 'fixed')
                                        <li>
                                            <span class="title">Amount: </span>
                                            <span class="value">{{ formatAmount($plan->min_amount) }}</span>
                                        </li>
                                    @else
                                        <li>
                                            <span class="title">Min: </span>
                                            <span class="value">{{ formatAmount($plan->min_amount) }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Max: </span>
                                            <span class="value">{{ formatAmount($plan->max_amount) }}</span>
                                        </li>
                                    @endif
                                    <li>
                                        <span class="title">Interval:</span>
                                        <span class="value">{{ ucwords($plan->return_interval) }}</span>
                                    </li>
                                    <li>
                                        <span class="title">Total:</span>
                                        <span class="value">
                                            @if ($plan->return_type == 'fixed')
                                                {{ formatAmount($plan->return) . ' +Capital' }}
                                            @else
                                                {{ $plan->return . '% +Capital' }}
                                            @endif
                                        </span>
                                    </li>

                                </ul>
                            </div>
                            <div class="plan__item-footer">
                                <a href="{{ route('user.investments.new') }}" class="cmn--btn">Invest</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endforeach
