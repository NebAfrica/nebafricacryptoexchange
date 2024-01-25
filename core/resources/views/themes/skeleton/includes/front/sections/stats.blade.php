@foreach ($view_data['sections']->where('name', 'stats') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div> 

        @foreach (json_decode($section->content)->counters as $counter)
            <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                
                <div  >
                    <div   style="width: 50px; color: blue">
                        {!! icon($counter->icon) !!}                        
                    </div>                    
                </div>
                <div  >
                    <h3>{!! $counter->title !!}</h3>
                    <p>{!! formatAmount($counter->count) !!}</p>                    
                </div>
                        
            </div>
        @endforeach 
        {{--  {{ dd(json_decode($section->content)->whys) }} --}}
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach


