{{-- blog section --}}
@foreach ($view_data['sections']->where('name', 'blog') as $section)
<section class="blog-section padding-top padding-bottom section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="section__header max-p text-center">
                    <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                    <div>
                        {!! json_decode($section->content)->section_text !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center g-4">
            @foreach ($view_data['blogs'] as $blog)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="post__item">
                        <div class="post__item-thumb">
                            @if ($blog->type == 'auto')
                                <img src="{{ $blog->img }}" alt="{{ $blog->title }}"
                                    title="{{ $blog->title }}">
                            @else
                                <img src="{{ route('file', ['blogs', $blog->img]) }}"
                                    alt="{{ $blog->title }}" title="{{ $blog->title }}">
                            @endif
                            <div class="thumb__content">
                                <h3 class="title">
                                    @if ($blog->type !== 'auto')
                                        <a href="{{ route('blog-detail', [$blog->slug]) }}">
                                            {{ $blog->title }}
                                        </a>
                                    @else
                                        <a href="{{ $blog->slug }}" target="_blank"
                                            rel="noopener noreferrer nofollow">
                                            {{ $blog->title }}
                                        </a>
                                    @endif
                                </h3>
                                <ul class="post-meta d-flex flex-wrap m-0 justify-content-between">
                                    <li>
                                        <i class="fas fa-user"></i>
                                        {{ $blog->author }}
                                    </li>
                                    <li>
                                        <i class="fas fa-cog"></i>
                                        {{ $blog->category }}
                                    </li>
                                    <li>
                                        <i class="fas fa-calendar"></i>
                                        {{ formatPastDate(strtotime($blog->created_at)) }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endforeach