{{-- stats starts here --}}
@php
    function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }
        return ['number' => round($num, 1), 'unit' => $units[$i]];
    }
@endphp

@foreach ($view_data['sections']->where('name', 'stats') as $section)
    <section class="download-section padding-bottom section-bg-two overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="section__header">
                        <h2 class="section__header-title">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div>
                            {!! json_decode($section->content)->section_text !!}
                        </div>
                    </div>

                    <div class="counter__wrapper row gy-4 gy-sm-5 pt-4 pt-sm-5">
                        @foreach (json_decode($section->content)->counters as $counter)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                                <div class="counter__item">
                                    <div class="counter__item-header d-flex align-items-center">
                                        <div class="icon text-warning">
                                            {!! icon($counter->icon) !!}
                                        </div>
                                        <h2 class="title"><span class="odometer"
                                                data-odometer-final="{{ shortNumber($counter->count)['number'] }}">0</span>{{ shortNumber($counter->count)['unit'] }}
                                        </h2>
                                    </div>
                                    <p class="info">{!! $counter->title !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="section__thumb profit__calculation__thumb ">
                        <img src="{{ asset('public/assets/themes/prius/assets/images/download/thumb.png') }}"
                            alt="download">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
