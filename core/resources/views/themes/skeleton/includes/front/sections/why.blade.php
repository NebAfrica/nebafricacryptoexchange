@foreach ($view_data['sections']->where('name', 'why') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div> 

        @foreach (json_decode($section->content)->whys as $why)
            <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                
                <div  >
                    <div   style="width: 50px; color: blue">
                        {!! icon($why->icon) !!}                        
                    </div>                    
                </div>
                <div  >
                    <h3>{!! $why->title !!}</h3>
                    <p>{!! $why->text !!}</p>                    
                </div>
                        
            </div>
        @endforeach 
        {{--  {{ dd(json_decode($section->content)->whys) }} --}}
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach


