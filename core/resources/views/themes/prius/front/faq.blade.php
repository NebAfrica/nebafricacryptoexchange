@extends('themes.prius.layout.front')
@section('content')
    @include('themes.prius.includes.front.sections.header')

    {{--  breadcrumb section starts here --}}
    @include('themes.prius.includes.front.sections.breadcrumb')
    {{--  breadcrumb section ends here --}}

    {{--  FAQ starts here --}}
    @include('themes.prius.includes.front.sections.faq')
    {{--  FAQ ends here --}}

    {{--  COntact starts here --}}
    @include('themes.prius.includes.front.sections.contact')
    {{--  Contact ends here --}}

    

@endsection

@section('script')
    
@endsection