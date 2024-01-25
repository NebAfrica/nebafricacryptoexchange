@extends('themes.cryptic.layout.front')
@section('content')

    {{--  breadcrumb section starts here --}}
    @include('themes.cryptic.includes.front.sections.breadcrumb')
    {{--  breadcrumb section ends here --}}

    {{--  FAQ starts here --}}
    @include('themes.cryptic.includes.front.sections.faq')
    {{--  FAQ ends here --}}

    {{--  COntact starts here --}}
    @include('themes.cryptic.includes.front.sections.contact')
    {{--  Contact ends here --}}

    

@endsection

@section('script')
    
@endsection