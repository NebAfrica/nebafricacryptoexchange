@foreach ($view_data['sections']->where('name', 'teams') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div> 

        

        @foreach ($view_data['teams'] as $team)
            <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                
                
                <div  >
                    <img src="{{ route('file', ['teams', $team->photo]) }}" alt="{{ $team->name }}" title="{{ $team->name }}">
                    <h3>{{ $team->name }}</h3>
                    <p>{{ $team->role }}</p>            
                </div>
                        
            </div>
        @endforeach 
        

    </section>
@endforeach


