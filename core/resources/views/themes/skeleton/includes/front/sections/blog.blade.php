@foreach ($view_data['sections']->where('name', 'blog') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div> 

        

        @foreach ($view_data['blogs'] as $blog)
            <div   style="width: calc(25% - 64px); display: inline-block; border: solid 2px blue; margin: 5px;">
                
                
                <div  >
                    @if ($blog->type == 'auto')
                        <img width="100%" src="{{ $blog->img }}" alt="{{ $blog->title }}" title="{{ $blog->title }}">
                    @else
                        <img src="{{ route('file', ['blogs', $blog->img]) }}" alt="{{ $blog->title }}" title="{{ $blog->title }}">
                    @endif
                    <h3>{{ $blog->title }}</h3>
                    <p>{{ $blog->snippet }}</p> 
                    <p>
                        Author: {{ $blog->author }} |  Category: {{ $blog->category }}  | Date: {{ formatPastDate(strtotime($blog->created_at)) }} 
                    </p>  
                    <p>
                        @if ($blog->type == 'auto')
                            <a href="{{ $blog->slug }}" target="_blank" rel="noopener noreferrer nofollow">Read More</a>                            
                        @else
                            <a href="{{ route('blog-detail', [$blog->slug]) }}">Read More</a>
                        @endif    
                    </p> 
                    
                    
                </div>

                
                
                        
            </div>
        @endforeach 

        
        @if (request()->routeIs('blogs'))
            <div  >
                {{ $view_data['blogs']->links() }}
            </div>
            <style>
                svg.w-5.h-5 {                
                    width: 12px;
                }
            </style>
        @else 

        <p>
            <a href="{{ route('blogs') }}">View More</a>
        </p>
        
        @endif
        

    </section>
@endforeach


