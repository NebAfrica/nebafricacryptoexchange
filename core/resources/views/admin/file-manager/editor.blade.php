<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>
    <style>
        body {
            background: #002240;
        }
        .code-box {
            min-height: 100vh;
        }

        #close_btn {
            color: white;
            background: red;
            text-transform: uppercase;
            bottom: 1px;
            right: 1px;
            position: fixed;
            display: block;
            cursor: pointer;
            border: solid 1px white;
            padding: 5px;
        }

        #save_btn {
            color: white;
            background: green;
            text-transform: uppercase;
            top: 1px;
            right: 1px;
            position: fixed;
            display: block;
            cursor: pointer;
            border: solid 1px white;
            padding: 5px;
            
        }
    </style>
</head>
<body>
    @include('preloaders.action')

    <form id="editorForm" action="{{ route('admin.file-manager.editor-validate') }}" method="POST">
        @csrf
        <div class="code-box">
            <input type="hidden" name="path_to_file" id="path_to_file" value="{{ urlencode($path_to_file) }}">
            <textarea name="code" id="code" required>{!! $file !!}</textarea>
            <button id="save_btn" type="submit">Save Changes</button>
            <button id="close_btn" type="button">Close</button>
        </div>

    </form>

{{--  general --}}
{{-- Scripts CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{--  google captcah --}}
{!! ReCaptcha::htmlScriptTagJsApi() !!}

{{--  Sweet alert cdn --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--  Owl carousel cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{--  classic editor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

{{--  code mirror --}}

<link href="{{ asset('public/codemirror/lib/codemirror.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/codemirror/theme/cobalt.css') }}" rel="stylesheet" type="text/css">
{{--  general --}}


@if ($extension == 'js')
{{--  javascript --}}
<script src="{{ asset('public/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closetag.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closebrackets.js') }}"></script>
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
        mode: "javascript",
        theme: "cobalt",
        autoCloseTags: true,
        autoCloseBrackets: true,
        lineNumbers: true
    });

    editor.setSize("100%", "100%");
</script>

{{--  css --}}
@elseif ($extension == 'css')
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

    editor.setSize("100%", "100%");
</script>
@else
{{--  php and others --}}
<script src="{{ asset('public/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/clike/clike.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/php/php.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closetag.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/comment/comment.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/comment/continuecomment.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closebrackets.js') }}"></script>
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
        mode: "application/x-httpd-php",
        theme: "cobalt",
        autoCloseTags: true,
        autoCloseBrackets: true,
        comment: true,
        continueComment: true,
        lineNumbers: true
    });

    editor.setSize("100%", "100%");
</script>

@endif

<script>
    
    $('#close_btn').on('click', function(){
        window.close();
    });

    $('#editorForm').on('submit', function(e) {
        e.preventDefault();
        $('#preloader').show();

        let code = $('#code').val();
        let path_to_file = $('#path_to_file').val();
        $.ajax({
            url: "{{ route('admin.file-manager.editor-validate') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                code: code,
                path_to_file: path_to_file,
            },
            success: function(response) {
                $('#preloader').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: 'Changes saved',
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




</body>
</html>