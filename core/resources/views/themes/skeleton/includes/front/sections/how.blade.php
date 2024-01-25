@foreach ($view_data['sections']->where('name', 'how') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>  

        <div  >
            @foreach (json_decode($section->content)->steps as $step_name => $step)
                <div   style="width: 50px; color: blue">
                    {!! icon($step->icon) !!}                    
                </div>
                <h3>{!! ucwords(str_replace('_', ' ', $step_name)) !!}</h3>
                <p>{!! $step->text !!}</p>
            @endforeach    
        </div> 
        
        {{--  {{ dd($view_data['plans']) }} --}}
        
        

    </section>
    {{--  <section>
        @foreach (listIcons() as $icon)
            <label for="{{ 'icon'.$loop->iteration }}">
                
                <div style="width: 50px; border: solid 1px black; float: left; margin: 2px">
                    <input type="radio" name="icon" value="{{ $icon }}" id="{{ 'icon'.$loop->iteration }}">
                    {!! icon($icon) !!}
                </div>
                
            </label>           
            
        @endforeach        
    </section> --}}



@endforeach

