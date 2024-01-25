@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Email Templates
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

            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @forelse ($email_templates as $template)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $template->name)) }}</td>
                        <td>{{ str_replace('{$', '{', $template->subject) }}</td>
                        <td>{{ $template->status }}</td>

                        <td class="inline-flex space-x-3 md:space-x-5">

                            <a href="{{ route('admin.settings.email-templates') . '/edit/' . $template->id }}" title="Edit {{ ucwords(str_replace('_', ' ', $template->name)) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">There are email templates</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection