@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Edit Email Template
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
                <form class="mt-2 p-2 md:p-4" action="{{ route('admin.settings.edit-email-template-validate') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $template->id }}">

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="name">Template:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="name" id="name" value="{{ ucwords(str_replace('_', ' ', $template->name)) }}" readonly>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="subject">Subject:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="subject" value="{{ str_replace('{$', '{', $template->subject) }}">
                        </div>
                        <h6 class="text-xs text-blue-400 mt-1">
                            @if (!$shortcodes_subject)
                            <span class="mb-1 text-xs">No shortcodes are allowed in the subject for this email template</span>
                            @else
                            <span class="font-medium mb-1 text-xs">ALLOWED SHORTCODES</span>
                            <ol>
                                @foreach ($shortcodes_subject as $shortcode)
                                <li><code>{{ str_replace('{$', '{', $shortcode) }}</code></li>
                                @endforeach
                            </ol>
                            @endif
                        </h6>
                        <span class="p-1 text-red-600">
                            @error('subject') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="message">Message:</label>
                            <h6 class="text-xs text-blue-400 mb-1">
                                <b class="font-medium">Allowed:</b> {{ str_replace('{$', '{', $template->shortcodes_body) }}
                            </h6>
                            <textarea name="message" id="message" required>{!! str_replace('{$', '{', $template->body) !!}</textarea>
                        </div>
                        <h6 class="text-xs text-blue-400 mt-1">
                            <span class="font-medium mb-1 text-xs">ALLOWED SHORTCODES</span>
                            <ol class="flex flex-wrap space-x-2">
                                @foreach ($shortcodes_body as $shortcode)
                                <li><code>{{ str_replace('{$', '{',$shortcode) }}</code></li>
                                @endforeach
                            </ol>
                        </h6>
                        <span class="p-1 text-red-600">
                            @error('message') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="theme">Theme:</label>
                            <div class="flex space-x-5">
                                <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="status" id="status" required>
                                    <option value="enabled" @if (old('status') ?? $template->status == 'enabled') selected @endif>Enabled</option>
                                    <option value="disabled" @if (old('status') ?? $template->status == 'disabled') selected @endif>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('theme') {{ $message }} @enderror
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
<script>
    ClassicEditor
        .create(document.querySelector('#message'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection