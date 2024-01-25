@foreach ($view_data['sections']->where('name', 'hero') as $section)
    <section   style="background: url({{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }})">        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            <a href="{{ json_decode($section->content)->section_button_url }}">{{ json_decode($section->content)->section_button_text }}</a>
        </div>           
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach

