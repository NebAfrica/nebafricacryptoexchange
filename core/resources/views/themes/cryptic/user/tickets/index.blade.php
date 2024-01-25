@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ $page_title }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('back', 'l') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('infographics')
{{-- infograpics for this page should be here
    1. Total TIckets = {{ $total_tickets }}
2. New Tickets = {{ $new_tickets }}
3. Open Tickets = {{ $open_tickets }}
4. Resolved Ticket = {{ $resolved_tickets }}

NB: This page doesn't need chart --}}
@endsection

@section('content')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="flex justify-end">
                <div>
                    <a href="{{ route('user.tickets.new') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ ct('Create Ticket') }}</span>
                    </a>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border mb-10">

            @if ($tickets->count() > 0)
                @foreach ($tickets as $ticket)
                    <div class="bg-gray-800 border border-gray-600 p-3 my-5 rounded-sm text-[#ebedf2] text-xs md:text-sm">
                        {{--  ticket title --}}
                        <div class="flex justify-between items-center">
                            <div class="text-sm md:text-base font-medium">
                                <h3>{{$ticket->title}}</h3>
                            </div>

                            {{--  ticket status --}}
                            <div class="@if($ticket->status == 'new') bg-blue-600 @elseif ($ticket->status == 'open') bg-green-600 @elseif ($ticket->status == 'pending') bg-orange-600 @elseif ($ticket->status == 'resolved') bg-gray-500 @endif px-3 py-1 rounded-md">
                                <span>
                                    <span>{{ ct($ticket->status) }}</span>
                                </span>
                            </div>
                        </div>

                        {{--  Ticket created date  --}}
                        <div class="mt-1">
                            <div class="flex items-center space-x-1">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 md:h-4 w-3 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    {{ $ticket->created_at }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex space-x-5 items-center">
                            {{--  replies count  --}}
                            <div class="flex space-x-1 items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                </div>
                                <div class="font-medium">
                                    {{ ticketInfo($ticket->id, 'reply')->count() }}
                                </div>
                            </div>

                            {{--  attachments count  --}}
                            <div class="flex space-x-1 items-center">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </div>
                                <div class="font-medium">
                                    {{ ticketInfo($ticket->id, 'attachment')->count() }}
                                </div>
                            </div>
                        </div>

                        {{--  action buttons --}}
                        <div class="flex space-x-5 items-center mt-10">
                            {{--  reply button  --}}
                            <a href="{{ route('user.tickets.view', $ticket->ticket_id) }}" class="flex items-center space-x-1 hover:text-white hover:underline">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                </div>
                                <div>
                                    {{ ct('Reply') }}
                                </div>
                            </a>

                            @if($ticket->status != 'resolved')
                            {{--  mark as resolved button  --}}
                            <a href="{{ route('user.tickets.resolve', $ticket->ticket_id) }}" class="flex items-center space-x-1 hover:text-white hover:underline">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    {{ ct('Mark as resolved') }}
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else 
                {{--  disclaimer notification --}}
                <div class="w-full p-6 md:p-10 flex justify-center">
                    <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                        <div class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>
                        <div>
                            <b class="font-medium">{{ ct('Empty Record!') }} </b> {{ ct("You don't have any support tickets.") }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@section('script')

@endsection