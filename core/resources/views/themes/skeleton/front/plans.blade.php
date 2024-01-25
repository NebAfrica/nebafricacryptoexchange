@extends('themes.skeleton.layout.front')
@section('content')

    @if (isPageInSection($view_data, 'plans', 'breadcrumb'))
        {{--  breadcrumb section starts here --}}
        @include('themes.skeleton.includes.front.sections.breadcrumb')
        {{--  breadcrumb section ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'plans'))
        {{--  investment plans starts here --}}
        @include('themes.skeleton.includes.front.sections.plans')
        {{--  investment plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'loan_plans'))
        {{--  loan plans starts here --}}
        @include('themes.skeleton.includes.front.sections.loan_plans')
        {{--  loan plans ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'about'))
        {{--  about section starts here --}}
        @include('themes.skeleton.includes.front.sections.about')
        {{--  about section ends here --}}
    @endif



    @if (isPageInSection($view_data, 'plans', 'why'))
        {{--  why choose us starts here --}}
        @include('themes.skeleton.includes.front.sections.why')
        {{--  why choose us ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'how'))
        {{--  how to invest starts here --}}
        @include('themes.skeleton.includes.front.sections.how')
        {{--  how to invest ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'calculator'))
        {{--  calculator starts here --}}
        @include('themes.skeleton.includes.front.sections.calculator')
        {{--  calculator ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'teams'))
        {{--  teams starts here --}}
        @include('themes.skeleton.includes.front.sections.teams')
        {{--  teams ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'faq'))
        {{--  FAQ starts here --}}
        @include('themes.skeleton.includes.front.sections.faq')
        {{--  FAQ ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'stats'))
        {{--  Stats starts here --}}
        @include('themes.skeleton.includes.front.sections.stats')
        {{--  stats ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'deposit_withdraw'))
        {{--  Deposit Withdraw starts here --}}
        @include('themes.skeleton.includes.front.sections.deposit-withdraw')
        {{--  Deposit Withdrawal ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'testimonials'))
        {{--  testimonials tarts here --}}
        @include('themes.skeleton.includes.front.sections.testimonials')
        {{--  Testimonials ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'deposit_methods'))
        {{--  Deposit methods starts here --}}
        @include('themes.skeleton.includes.front.sections.deposit-methods')
        {{--  Deposit methods ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'blog'))
        {{--  Blog starts here --}}
        @include('themes.skeleton.includes.front.sections.blog')
        {{--  Blogr ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'newsletter'))
        {{--  Newsletter starts here --}}
        @include('themes.skeleton.includes.front.sections.newsletter')
        {{--  Newsletter ends here --}}
    @endif

    @if (isPageInSection($view_data, 'plans', 'contact'))
        {{--  contact starts here --}}
        @include('themes.skeleton.includes.front.sections.contact')
        {{--  contact ends here --}}
    @endif

@endsection

@section('script')
    
@endsection