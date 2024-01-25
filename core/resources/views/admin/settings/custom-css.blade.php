@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Custom CSS
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>back</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            {{--  setting pannel --}}

            @include('admin.includes.settings-panel')
            {{--  setting pannel ends --}}

            <div class="p-2 md:p-4">
                <form id="submitForm" class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.custom-css-validate') }}" method="post" enctype="multipart/form-data">
                    <a id="expand_btn" role="button" style="color: white; background-color: green; padding: 5px">Full Screen</a>
                    <a id="collapse_btn" role="button" style="display: none; background-color: yellow; padding: 5px">Minimize</a>
                    <button id="expanded_submit_btn" type="submit"  style="display: none; background-color: green; padding: 5px">Save Changes</button>
                    @csrf

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <textarea cols="30" rows="10" name="custom_css" id="custom_css" required>{!! json_decode(websiteInfo('custom_css')) !!}</textarea>


                        </div>
                        <span class="p-1 text-red-600">
                            @error('custom_css') {{ $message }} @enderror
                        </span>
                    </div>



                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>


        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ asset('public/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closetag.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closebrackets.js') }}"></script>
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById('custom_css'), {
        mode: "css",
        theme: "cobalt",
        autoCloseTags: true,
        autoCloseBrackets: true,
        lineNumbers: true
    });

    editor.setSize("600", "300");
</script>

{{--  ajax form  --}}
<script type="text/javascript">
    //expand to full screen
    $("#expand_btn").on('click', function() {
        $(".CodeMirror").css({
            "position": "absolute",
            "width": "100vw",
            "height": "100vh",
            "z-index": 1050,
            "top": "0px",
            "left": "0px",
            "right": "0px",
            "bottom": "0px",
        });

        $("#collapse_btn").css({
            "position": "fixed",
            "display": "block",
            "z-index": 1051,
            "top": "10px",
            "right": "5px",

        });

        $("#expanded_submit_btn").css({
            "position": "fixed",
            "display": "block",
            "z-index": 1051,
            "top": "40px",
            "right": "5px",

        });
    });
    $("#collapse_btn").on("click", function() {
        $("#collapse_btn").css({
            "display": "none",

        });

        $("#expanded_submit_btn").css({
            "display": "none",

        });

        $(".CodeMirror").css({
            "position": "relative",
            "width": "600",
            "height": "300",
            "z-index": 1,
            "top": " ",
            "left": " ",
            "right": " ",
            "bottom": " ",
        });
    })

    $("#expanded_submit_btn").on('click', function() {
        $('#submitForm').submit();
    });


    $('#submitForm').on('submit', function(e) {
        e.preventDefault();
        $('#preloader').show();
        let custom_css = $('#custom_css').val();
        $.ajax({
            url: "{{ route('admin.settings.custom-css-validate') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                custom_css: custom_css,
            },
            success: function(response) {
                $('#preloader').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: 'Custom CSS updated',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });
            },
            error: function(response) {
                $('#preloader').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: 'Failed to update',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });
            },
        });
    });
</script>
@endsection