@extends('admin.layout.app')
@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            {{ $page_title }}
                        </h2>
                    </div>

                    <div>
                        <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-end">
                    <div>
                        <a href="{{ route('admin.blogs.index') }}" title="Add New Blog"
                            class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z"></path>
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span>View All</span>
                        </a>
                    </div>
                </div>
                <hr class="w-full border-b border-dotted border-gray-600 border mb-4">
                <div class="p-2 md:p-4">
                    <form class="mt-2 p-2 md:p-4" action="{{ route('admin.blogs.new') }}" method="post"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full">
                                <label class="font-medium" for="title">Title:</label>
                                <input
                                    class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                    type="text" name="title" id="title" value="{{ old('title') }}" required>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full">
                                <label class="font-medium" for="snippet">Snippet:</label>
                                <textarea
                                    class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                    name="snippet" id="snippet">{{ old('snippet') }}</textarea>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('snippet')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full ck-h-400">
                                <label class="font-medium" for="detail">Post Body:</label>
                                <textarea
                                    class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                    name="detail" id="detail">{{ old('detail') }}</textarea>
                            </div>

                            <span class="p-1 text-red-600">
                                @error('detail')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm">
                            <div class="w-full">
                                <label class="font-medium" for="category">Category:</label>
                                <input
                                    class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                                    type="text" name="category" id="category" value="{{ old('category') }}" required>
                            </div>
                            <span class="p-1 text-red-600">
                                @error('category')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-[#bfc9d4] text-xs md:text-sm mt-2">
                            <div class="w-full flex items-center space-x-2">
                                <label class="font-medium overflow-hidden" for="cover_image">Cover Image:</label>
                                <label
                                    class="font-medium flex flex-grow justify-center items-center space-x-2 border rounded-sm border-slate-800 hover:border-slate-600 cursor-pointer"
                                    for="cover_image">
                                    
                                    <span id="cover-image-preview"
                                        class="uploadIcon w-full h-28 md:h-64 flex justify-center items-center"
                                        style="background-image: url({{ asset('public/assets/imgs/fallback.png') }}); background-size: contain; background-repeat: no-repeat;">
                                        <span class="bg-gray-500 border p-2 text-white rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                        </span>
                                    </span>
                                </label>
                                <input class="hidden" type="file" accept="image/*" name="cover_image"
                                    id="cover_image" data-preview="cover-image-preview">
                            </div>
                            <span class="p-1 text-red-600">
                                @error('cover_image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="w-full my-5 px-5">
                            <button type="submit"
                                class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Publish
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
        //classic editor editor

        ClassicEditor
            .create(document.querySelector('#detail'))
            .catch(error => {
                console.error(error);
            });

        //classic editor ends here
    </script>
@endsection
