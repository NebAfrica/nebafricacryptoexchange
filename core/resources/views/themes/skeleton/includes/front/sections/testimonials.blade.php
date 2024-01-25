@foreach ($view_data['sections']->where('name', 'testimonials') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div> 

        

        @foreach ($view_data['testimonials'] as $testimonial)
            <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                
                
                <div  >
                    <img src="{{ route('file', ['testimonials', $testimonial->photo]) }}" alt="{{ $testimonial->name }}" title="{{ $testimonial->name }}">
                    <h3>{{ $testimonial->name }}</h3>
                    <p>{{ $testimonial->comment }}</p> 
                    <p>{{ $testimonial->star_rating . '/5' }}</p>            
                </div>
                        
            </div>
        @endforeach 
        

    </section>
@endforeach


