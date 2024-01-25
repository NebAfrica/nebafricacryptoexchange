@foreach ($view_data['sections']->where('name', 'breadcrumb') as $section)
    <section     style="background: url({{ asset('public/assets/imgs/' . json_decode($section->content)->section_bg_img) }})">        
        <div  >
            <h3><a href="{{ route('index') }}">Home</a>/<a href="{{ request()->url }}"> @if (!request()->is('blog/*')) {{ $page_title }} @else Blog Detail @endif</a></h3>
        </div>
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach

