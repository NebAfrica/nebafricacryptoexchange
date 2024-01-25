@extends('themes.cryptic.layout.front')
@section('content')

    @if (isPageInSection($view_data, 'about', 'hero'))
        {{--  hero section starts here --}}
        @include('themes.cryptic.includes.front.sections.hero')
        {{--  hero section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'breadcrumb'))
        {{--  breadcrumb section starts here --}}
        @include('themes.cryptic.includes.front.sections.breadcrumb')
        {{--  breadcrumb section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'about'))
        {{--  about section starts here --}}
        @include('themes.cryptic.includes.front.sections.about')
        {{--  about section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'plans'))
        {{--  investment plans starts here --}}
        @include('themes.cryptic.includes.front.sections.plans')
        {{--  investment plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'loan_plans'))
        {{--  loan plans starts here --}}
        @include('themes.cryptic.includes.front.sections.loan_plans')
        {{--  loan plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'why'))
        {{--  why choose us starts here --}}
        @include('themes.cryptic.includes.front.sections.why')
        {{--  why choose us ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'how'))
        {{--  how to invest starts here --}}
        @include('themes.cryptic.includes.front.sections.how')
        {{--  how to invest ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'calculator'))
        {{--  calculator starts here --}}
        @include('themes.cryptic.includes.front.sections.calculator')
        {{--  calculator ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'teams'))
        {{--  teams starts here --}}
        @include('themes.cryptic.includes.front.sections.teams')
        {{--  teams ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'faq'))
        {{--  FAQ starts here --}}
        @include('themes.cryptic.includes.front.sections.faq')
        {{--  FAQ ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'stats'))
        {{--  Stats starts here --}}
        @include('themes.cryptic.includes.front.sections.stats')
        {{--  stats ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'deposit_withdraw'))
        {{--  Deposit Withdraw starts here --}}
        @include('themes.cryptic.includes.front.sections.deposit-withdraw')
        {{--  Deposit Withdrawal ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'testimonials'))
        {{--  testimonials tarts here --}}
        @include('themes.cryptic.includes.front.sections.testimonials')
        {{--  Testimonials ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'deposit_methods'))
        {{--  Deposit methods starts here --}}
        @include('themes.cryptic.includes.front.sections.deposit-methods')
        {{--  Deposit methods ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'blog'))
        {{--  Blog starts here --}}
        @include('themes.cryptic.includes.front.sections.blog')
        {{--  Blogr ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'newsletter'))
        {{--  Newsletter starts here --}}
        @include('themes.cryptic.includes.front.sections.newsletter')
        {{--  Newsletter ends here --}}
    @endif

    @if (isPageInSection($view_data, 'about', 'contact'))
        {{--  contact starts here --}}
        @include('themes.cryptic.includes.front.sections.contact')
        {{--  contact ends here --}}
    @endif

@endsection

@section('script')
    
@endsection