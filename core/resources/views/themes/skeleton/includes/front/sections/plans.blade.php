@foreach ($view_data['sections']->where('name', 'plans') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>   
        
        <div  >
            @foreach ($view_data['plans'] as $plan)
                <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                    <h3>{{ $plan->name }} <span style="background-color: blue; color: white; font-size: 10px; padding: 5px">{{ $plan->label }}</span></h3>
                    <p style="background-color: blue; color: white">
                        <b> 
                            @if ($plan->return_type == 'fixed')
                                {{ formatAmount($plan->return) }} 
                            @else
                                {{ $plan->return . '%' }} 
                            @endif

                            / @if ($plan->duration < 2) {{ $plan->duration . ' ' . $plan->duration_type }} @else {{ $plan->duration . ' ' . $plan->duration_type . 's' }} @endif
                        </b>
                    </p>

                    @if ($plan->amount_type == 'fixed')
                        <p>
                            <b>Amount: </b> {{ formatAmount($plan->min_amount) }}
                        </p>
                        
                    @else
                        <p>
                            <b>Min Amount: </b> {{ formatAmount($plan->min_amount) }}
                        </p>
                        <p>
                            <b>Max Amount: </b> {{ formatAmount($plan->max_amount) }}
                        </p>

                        
                    @endif
                    <p>
                        <b>Return Interval: </b> {{ ucwords($plan->return_interval) }}
                    </p>

                    <p>
                        <b>Total: </b> @if($plan->return_type == 'fixed') {{ formatAmount($plan->return) . ' +Capital'  }} @else {{ $plan->return . '% +Capital'  }} @endif
                    </p>
                    <p>
                        <a href="{{ route('user.investments.new') }}" style="background-color: blue; color: white; padding: 5px">Invest Now</a>
                    </p>
                </div>
            @endforeach
            
        </div>
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach


