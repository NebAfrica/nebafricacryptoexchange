@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Installed Themes
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

            <div class="flex justify-end space-x-2">
                <div>
                    <a href="{{ route('admin.settings.theme-manager.new-theme') }}" title="Add Theme" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Create</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.settings.theme-manager.exports') }}" title="Add Theme" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Exports</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($themes as $theme)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $theme)) }}</td>
                            <td>
                                @if (websiteInfo('theme') == $theme )
                                Active
                                @else
                                Inactive
                                @endif
                            </td>

                            <form action="{{ route('admin.settings.theme-manager.export-theme') }}" method="post">
                                @csrf
                                <input type="hidden" name="theme_name" value="{{ $theme }}">
                                <td class="inline-flex space-x-3 md:space-x-5">
                                    @if ($theme != 'cryptic' && $theme != 'skeleton')
                                    <a href="#" title="Edit {{ ucwords(str_replace('_', ' ', $theme)) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <button type="submit" title="Export {{ ucwords(str_replace('_', ' ', $theme)) }}">
                                        Export
                                    </button>

                                    <a href="{{ route('admin.settings.theme-manager.delete-theme', $theme) }}" title="{{ 'Delete ' . ucwords(str_replace('_', ' ', $theme)) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                    @else
                                    <span>Default Theme</span>
                                    @endif
                                </td>
                            </form>
                        </tr>

                        @endforeach
                    </tbody>

                </table>

            </div>


        </div>
    </div>
</div>
@endsection

@section('script')


@endsection