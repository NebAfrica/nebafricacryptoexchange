{{-- team section --}}
@foreach ($view_data['sections']->where('name', 'teams') as $section)
    <section class="investor-section padding-bottom padding-top section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section__header text-center">
                        <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gy-5">
                @foreach ($view_data['teams'] as $team)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="investor__item">
                            <div class="investor__item-thumb">
                                <img src="{{ route('file', ['teams', $team->photo]) }}" alt="{{ $team->name }}">
                            </div>
                            <div class="investor__item-content">
                                <h3 class="name">{{ $team->name }}</h3>
                                <p class="invest-amount">{{ $team->role }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endforeach
