@foreach ($view_data['sections']->where('name', 'faq') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>  

        <div  >
            @foreach ($view_data['faqs'] as $faq)                
                <h3>{{ $faq->question }}</h3>
                {!! $faq->answer !!}
            @endforeach    
        </div> 
        
        {{--  {{ dd($view_data['plans']) }} --}}
        
        
        

    </section>



@endforeach

