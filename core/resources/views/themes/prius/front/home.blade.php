@extends('themes.prius.layout.front')
@section('content')
    @include('themes.prius.includes.front.sections.header')
    @if (isPageInSection($view_data, 'home', 'hero')) 
        {{--  hero section starts here --}}
        @include('themes.prius.includes.front.sections.hero')
        {{--  hero section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'breadcrumb'))
        {{--  breadcrumb section starts here --}}
        @include('themes.prius.includes.front.sections.breadcrumb')
        {{--  breadcrumb section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'about'))
        {{--  about section starts here --}}
        @include('themes.prius.includes.front.sections.about')
        {{--  about section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'plans'))
        {{--  investment plans starts here --}}
        @include('themes.prius.includes.front.sections.plans')
        {{--  investment plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'loan_plans'))
        {{--  loan plans starts here --}}
        @include('themes.prius.includes.front.sections.loan_plans')
        {{--  loan plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'why'))
        {{--  why choose us starts here --}}
        @include('themes.prius.includes.front.sections.why')
        {{--  why choose us ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'how'))
        {{--  how to invest starts here --}}
        @include('themes.prius.includes.front.sections.how')
        {{--  how to invest ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'calculator'))
        {{--  calculator starts here --}}
        @include('themes.prius.includes.front.sections.calculator')
        {{--  calculator ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'teams'))
        {{--  teams starts here --}}
        @include('themes.prius.includes.front.sections.teams')
        {{--  teams ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'faq'))
        {{--  FAQ starts here --}}
        @include('themes.prius.includes.front.sections.faq')
        {{--  FAQ ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'stats'))
        {{--  Stats starts here --}}
        @include('themes.prius.includes.front.sections.stats')
        {{--  stats ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'deposit_withdraw'))
        {{--  Deposit Withdraw starts here --}}
        @include('themes.prius.includes.front.sections.deposit-withdraw')
        {{--  Deposit Withdrawal ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'testimonials'))
        {{--  testimonials tarts here --}}
        @include('themes.prius.includes.front.sections.testimonials')
        {{--  Testimonials ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'deposit_methods'))
        {{--  Deposit methods starts here --}}
        @include('themes.prius.includes.front.sections.deposit-methods')
        {{--  Deposit methods ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'blog'))
        {{--  Blog starts here --}}
        @include('themes.prius.includes.front.sections.blog')
        {{--  Blogr ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'newsletter'))
        {{--  Newsletter starts here --}}
        @include('themes.prius.includes.front.sections.newsletter')
        {{--  Newsletter ends here --}}
    @endif

    @if (isPageInSection($view_data, 'home', 'contact'))
        {{--  contact starts here --}}
        @include('themes.prius.includes.front.sections.contact')
        {{--  contact ends here --}}
    @endif

@endsection

@section('script')
    
@endsection