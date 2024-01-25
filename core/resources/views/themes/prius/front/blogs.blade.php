@extends('themes.prius.layout.front')
@section('content')
    @include('themes.prius.includes.front.sections.header')

    @if (isPageInSection($view_data, 'blog', 'breadcrumb'))
        {{--  breadcrumb section starts here --}}
        @include('themes.prius.includes.front.sections.breadcrumb')
        {{--  breadcrumb section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'blog'))
        {{--  Blog starts here --}}
        @include('themes.prius.includes.front.sections.blog')
        {{--  Blog ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'about'))
        {{--  about section starts here --}}
        @include('themes.prius.includes.front.sections.about')
        {{--  about section ends here --}}
    @endif


    @if (isPageInSection($view_data, 'blog', 'plans'))
        {{--  investment plans starts here --}}
        @include('themes.prius.includes.front.sections.plans')
        {{--  investment plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'loan_plans'))
        {{--  loan plans starts here --}}
        @include('themes.prius.includes.front.sections.loan_plans')
        {{--  loan plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'why'))
        {{--  why choose us starts here --}}
        @include('themes.prius.includes.front.sections.why')
        {{--  why choose us ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'how'))
        {{--  how to invest starts here --}}
        @include('themes.prius.includes.front.sections.how')
        {{--  how to invest ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'calculator'))
        {{--  calculator starts here --}}
        @include('themes.prius.includes.front.sections.calculator')
        {{--  calculator ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'teams'))
        {{--  teams starts here --}}
        @include('themes.prius.includes.front.sections.teams')
        {{--  teams ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'faq'))
        {{--  FAQ starts here --}}
        @include('themes.prius.includes.front.sections.faq')
        {{--  FAQ ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'stats'))
        {{--  Stats starts here --}}
        @include('themes.prius.includes.front.sections.stats')
        {{--  stats ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'deposit_withdraw'))
        {{--  Deposit Withdraw starts here --}}
        @include('themes.prius.includes.front.sections.deposit-withdraw')
        {{--  Deposit Withdrawal ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'testimonials'))
        {{--  testimonials tarts here --}}
        @include('themes.prius.includes.front.sections.testimonials')
        {{--  Testimonials ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'deposit_methods'))
        {{--  Deposit methods starts here --}}
        @include('themes.prius.includes.front.sections.deposit-methods')
        {{--  Deposit methods ends here --}}
    @endif

    

    @if (isPageInSection($view_data, 'blog', 'newsletter'))
        {{--  Newsletter starts here --}}
        @include('themes.prius.includes.front.sections.newsletter')
        {{--  Newsletter ends here --}}
    @endif

    @if (isPageInSection($view_data, 'blog', 'contact'))
        {{--  contact starts here --}}
        @include('themes.prius.includes.front.sections.contact')
        {{--  contact ends here --}}
    @endif

@endsection

@section('script')
    
@endsection