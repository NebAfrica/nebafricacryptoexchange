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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-end">
                <div>
                    <a href="{{ route('admin.blogs.new') }}" title="Add New Blog" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-4">

            @if ($blogs->count() > 0)


            <form action="{{ route('admin.blogs.action') }}" method="POST">
                @csrf
                <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                    <div class="text-xs lg:text-sm">
                        <label for="action">With Selected:</label>
                    </div>
                    <div>
                        <select name="action" id="action1" class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                            <option value="" selected disabled>Choose Action</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Go
                        </button>
                    </div>
                </div>
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="all" id="all"></th>
                            <th></th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($blogs as $blog)
                        <tr>
                            <td><input type="checkbox" name="ids[]" id="{{ 'id'.$blog->id }}" class="checkSingle" value="{{ $blog->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.y H:i:s', strtotime($blog->created_at)) }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->type }}</td>

                            <td class="inline-flex space-x-3 md:space-x-5">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <a role="button" class="delete_btn" data-value="{{ $blog->id }}" data-title="blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                    <div class="text-xs lg:text-sm">
                        <label for="action2">With Selected:</label>
                    </div>
                    <div>
                        <select name="action" id="action2" class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                            <option value="" selected disabled>Choose Action</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Go
                        </button>
                    </div>
                </div>

            </form>


            {{--  delete form --}}

            <form action="{{ route('admin.blogs.delete') }}" method="post" id="deleteForm">
                @csrf
                <input type="hidden" name="id" id="id" placeholder="blog Id">
            </form>

            @else
            {{-- disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Empty Record! </b> You have not added any blog posts.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection