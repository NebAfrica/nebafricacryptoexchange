@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Livechat Settings
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
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.livechat-validate') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                        <div class="w-full">
                            <label class="font-medium" for="">Livechat:</label>                            
                            <div class="flex mt-1 items-center">
                                <label for="livechat" class="hidden-radio toggle @if(old('livechat') ?? websiteInfo('livechat') == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                <input type="hidden"  name="livechat" id="livechat" @if(old('livechat') ?? websiteInfo('livechat') == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                            </div>
                        </div>

                        <span class="p-1 text-red-600">
                            @error('livechat') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <textarea name="livechat_script" id="livechat_script" cols="30" rows="10" required>{{old('livechat_script') ?? websiteInfo('livechat_script') }}</textarea>
                        </div>

                        <span class="p-1 text-red-600">
                            @error('livechat_script') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                        <div class="w-full">
                            <label class="font-medium">WhatsApp Chat:</label>
                            
                            <div class="flex mt-1 items-center">
                                <label for="whatsapp" class="hidden-radio toggle @if(old('whatsapp') ?? $whatsapp->status == 'enabled' ) toggle--on @else toggle--off @endif"></label>
                                <input type="hidden"  name="whatsapp" id="whatsapp" @if(old('whatsapp') ?? $whatsapp->status == 'enabled' ) value="enabled" @else value="disabled" @endif required>
                            </div>
                        </div>

                        <span class="p-1 text-red-600">
                            @error('whatsapp') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="whatsapp_no">WhatsApp No:</label>
                            <h6 class="text-xs text-blue-400">
                                Enter WhatsApp no with country code
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="whatsapp_no" id="whatsapp_no" value="{{ old('whatsapp_no') ?? $whatsapp->no }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('whatsapp_no') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="whatsapp_message">WhatsApp Message:</label>
                            <textarea class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" cols="30" rows="7" name="whatsapp_message" id="whatsapp_message" required>{!! old('whatsapp_message') ?? $whatsapp->message !!}</textarea>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('whatsapp_message') {{ $message }} @enderror
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

{{--  Live chat --}}
@if (websiteInfo('livechat') == 'enabled')
{!! websiteInfo('livechat_script') !!}
@endif

<script src="{{ asset('public/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('public/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closetag.js') }}"></script>
<script src="{{ asset('public/codemirror/addon/edit/closebrackets.js') }}"></script>
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById('livechat_script'), {
        mode: "javascript",
        theme: "cobalt",
        autoCloseTags: true,
        autoCloseBrackets: true,
        lineNumbers: true
    });

    editor.setSize("600", "300");
</script>


@endsection