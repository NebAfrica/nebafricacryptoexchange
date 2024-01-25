@foreach ($view_data['sections']->where('name', 'deposit_methods') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>   
        
        <div  >
            @foreach ($view_data['methods'] as $method)
                <div   style="width: calc(20% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                    <p>
                        <img width="50px" src="{{ route('file', ['deposit-methods', $method->logo]) }}" alt="{{ $method->name }}" title="{{ $method->name }}">
                    </p>
                </div>
            @endforeach
            
        </div>
        

    </section>
@endforeach


