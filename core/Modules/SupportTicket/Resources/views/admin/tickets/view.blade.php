@php
    function isImage($file)
    {
        $extension = explode('.', $file);
        $extension = $extension[1];
        $images = ['jpg', 'svg', 'jpeg', 'png'];
        $is_image = false;
        if (in_array($extension, $images)) {
            $is_image = true;
        }
    
        return $is_image;
    }
@endphp

@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{-- Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            view ticket
                        </h2>
                    </div>

                    <div>
                        <a href="{{ url()->previous() }}"
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
    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

                <div id="ticket">
                    <div id="ticketBody"
                        class="bg-gray-800 border border-gray-600 p-3 my-5 rounded-sm text-[#ebedf2] text-xs md:text-sm">
                        {{--  ticket title --}}
                        <div class="flex justify-between items-center">
                            <div class="text-sm md:text-base font-medium">
                                <h3>{{ $ticket->title }}</h3>
                            </div>

                            {{--  ticket status --}}
                            <div
                                class="@if ($ticket->status == 'new') bg-blue-600 @elseif ($ticket->status == 'open') bg-green-600 @elseif ($ticket->status == 'pending') bg-orange-600 @elseif ($ticket->status == 'resolved') bg-gray-500 @endif px-3 py-1 rounded-md">
                                <span>
                                    <span>{{ $ticket->status }}</span>
                                </span>
                            </div>
                        </div>

                        {{--  Ticket created date  --}}
                        <div class="mt-1">
                            <div class="flex items-center space-x-1">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 md:h-4 w-3 md:w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    {{ $ticket->created_at }}
                                </div>
                            </div>
                        </div>

                        {{--  Display first message and attachment if any --}}
                        <div class="bg-gray-700 p-4 mt-6 rounded-sm">
                            <p class="italic">{{ json_decode($ticket->message) }}</p>

                            <div class="mt-3">
                                @foreach ($files as $file)
                                    @if (isImage($file->hash_name))
                                        <a href="{{ route('image', ['tickets', $file->hash_name]) }}" target="_blank"
                                            class="flex space-x-1 items-center hover:underline">
                                        @else
                                            <a href="{{ route('file', ['tickets', $file->hash_name]) }}"
                                                class="flex space-x-1 items-center hover:underline">
                                    @endif

                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                    </div>
                                    <div class="italic">
                                        {{ json_decode($file->original_name) }}
                                    </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{--  Display name and date of reply  --}}
                        @foreach ($replies as $reply)
                            @if ($reply->role == 'admin')
                                <div class="mt-6">
                                    <div class="flex space-x-3 items-center">
                                        <div>{{ $reply->reply_by }}</div>
                                        <div class="flex items-center space-x-1">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 md:h-4 w-3 md:w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                {{ formatPastDate(strtotime($reply->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-700 p-4 rounded-sm">
                                        <p class="italic">{!! $reply->reply !!}</p>
                                    </div>
                                </div>
                            @else
                                <div class="mt-6">
                                    <div class="flex space-x-3 items-center">
                                        <div>{{ $reply->reply_by }}</div>
                                        <div class="flex items-center space-x-1">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 md:h-4 w-3 md:w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                {{ formatPastDate(strtotime($reply->created_at)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-700 p-4 rounded-sm">
                                        <p class="italic">{!! $reply->reply !!}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div>
                            <form id="submitForm" class="pt-2 md:pt-4" action="{{ route('admin.tickets.reply') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}">

                                {{--  reply textarea  --}}
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full">
                                        <textarea class="cred-hyip-theme1-textarea p-8" name="message" id="message" required cols="30" rows="5"
                                            placeholder="Add a reply...">{{ old('message') }}</textarea>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('message')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                {{--  attachment btn  --}}
                                <div class="text-[#bfc9d4] text-xs md:text-sm">
                                    <div class="w-full flex items-center space-x-2">
                                        <div>
                                            <label title="click to add attachments"
                                                class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer"
                                                for="attachments">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                <h5>Add attachment(s)</h5>
                                            </label>
                                            <input class="hidden attachment-input" type="file" name="attachments[]"
                                                id="attachments" multiple>
                                        </div>

                                        <div class="attachment-list">

                                        </div>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('attachments')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="w-full my-3 px-5">
                                    <button type="submit"
                                        class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md"
                                        href="{{ route('user.id.upload') }}">
                                        Send Reply
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="w-full my-3 px-5">
                            <form action="{{ route('admin.tickets.delete', $ticket->id) }}"
                                id="{{ 'deleteTicketForm' . $ticket->id }}" method="POST">
                                @csrf
                                <div class="flex items-center space-x-3">
                                    <a class="flex items-center space-x-1 px-3 py-1 rounded-lg bg-red-500 hover:bg-red-600"
                                        role="button" id="{{ 'deleteTicket' . $ticket->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <h6>Delete</h6>
                                    </a>
                                    @if ($ticket->status != 'resolved')
                                        <a class="flex items-center space-x-1 px-3 py-1 rounded-lg bg-gray-500 hover:bg-gray-600"
                                            role="button" id="{{ 'closeTicket' . $ticket->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h6>Close</h6>
                                        </a>
                                    @else
                                        <a class="flex items-center space-x-1 px-3 py-1 rounded-lg bg-green-500 hover:bg-green-600"
                                            role="button" id="{{ 'reopenTicket' . $ticket->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <h6>Reopen</h6>
                                        </a>
                                    @endif
                                    <a class="flex items-center space-x-1 px-3 py-1 rounded-lg bg-orange-500 hover:bg-orange-600"
                                        href="{{ route('admin.tickets.edit', $ticket->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        <h6>Edit</h6>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".attachment-input").change(function() {
            // first empty whatever is innit
            $(".attachment-list").html("")
        })

        $(".attachment-input").change(function() {
            var names = [];
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                if (names.length < 1)
                    names.push($(this).get(0).files[i].name);
                else {
                    names.push(", " + $(this).get(0).files[i].name);

                }
            }

            // let chosenDoc = $(this).val().split('\\').pop()
            $(".attachment-list").append(names);
        });

        //Delete ticket
        $(document).ready(function() {
            $("{{ '#deleteTicket' . $ticket->id }}").click(function() {
                Swal.fire({
                    title: 'Delete Ticket!',
                    text: "Do you want to delete this ticket? It can't be reversed",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b2e4b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete',
                    background: "#0e1726",
                    color: "#d1d5db",
                    
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("{{ 'deleteTicketForm' . $ticket->id }}").submit();
                    }
                });
            });
        });
    </script>

    @if ($ticket->status != 'resolved')
        <script>
            //Close Ticket ticket
            $(document).ready(function() {
                $("{{ '#closeTicket' . $ticket->id }}").click(function() {
                    Swal.fire({
                        title: 'Close Ticket!',
                        text: "Do you want to mark this ticket as resolved?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1b2e4b',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Delete',
                        background: "#0e1726",
                        color: "#d1d5db",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                "{{ route('admin.tickets.index') . '/status/' . $ticket->id }}?status=resolved";
                        }
                    });
                });
            });
        </script>
    @else
        <script>
            //Close Ticket ticket
            $(document).ready(function() {
                $("{{ '#reopenTicket' . $ticket->id }}").click(function() {
                    Swal.fire({
                        title: 'Reopen Ticket!',
                        text: "Do you want to reopen this ticket?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1b2e4b',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Delete',
                        background: "#0e1726",
                        color: "#d1d5db",
                        
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                "{{ route('admin.tickets.index') . '/status/' . $ticket->id }}?status=open";
                        }
                    });
                });
            });
        </script>
    @endif
@endsection
