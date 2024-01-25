{{-- deposit methods --}}
@foreach ($view_data['sections']->where('name', 'deposit_methods') as $section)
    <div class="padding-top padding-bottom">
        <div class="container">
            <div class="brand__slider">
                @foreach ($view_data['methods'] as $method)
                    <div class="single-slide">
                        <div class="brand__item">
                            <div style="width: 100px; height: 70px; padding: 5px; background: white;"
                                class="d-flex align-items-center">
                                <img width="100%" src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                                    alt="brand">
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endforeach
