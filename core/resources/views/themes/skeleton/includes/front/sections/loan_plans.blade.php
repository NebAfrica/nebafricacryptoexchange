@if (isAddonEnabled('cryptoloan') && websiteInfo('loan') == 'enabled')

    @foreach ($view_data['sections']->where('name', 'loan_plans') as $section)
        <section  >        
            <div  >
                <h2>{!! json_decode($section->content)->section_heading !!}</h2>
            </div>
            <div  >
                {!! json_decode($section->content)->section_text !!}
                
            </div>   
            
            <div  >
                @foreach (getLoanPlans() as $plan)
                    <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                        <h3>{{ $plan->name }}</h3>
                        <p style="background-color: blue; color: white">
                            <b> 
                                @if ($plan->interest_type == 'fixed')
                                    {{ formatAmount($plan->return) }} 
                                @else
                                    {{ $plan->interest . '%' }} 
                                @endif

                                / @if ($plan->duration < 2) {{ $plan->duration . ' ' . $plan->duration_type }} @else {{ $plan->duration . ' ' . $plan->duration_type . 's' }} @endif
                            </b>
                        </p>

                        
                        <p>
                            <b>Min Amount: </b> {{ formatAmount($plan->min_amount) }}
                        </p>
                        <p>
                            <b>Max Amount: </b> {{ formatAmount($plan->max_amount) }}
                        </p>

                        <p>
                            <b>Deposit To Qualify: </b> {{ formatAmount($plan->min_deposit) }}
                        </p>

                        <p>
                            <b>Total: </b> @if($plan->interest_type == 'fixed') {{ formatAmount($plan->interest) . ' +Principal'  }} @else {{ $plan->interest . '% +Principal'  }} @endif
                        </p>
                        <p>
                            <a href="{{ route('user.loan.new') }}" style="background-color: blue; color: white; padding: 5px">Borrow Now</a>
                        </p>
                    </div>
                @endforeach
                
            </div>
            {{--  {{ dd($view_data['loan_plans']) }} --}}
            
            {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

        </section>
    @endforeach

@endif


