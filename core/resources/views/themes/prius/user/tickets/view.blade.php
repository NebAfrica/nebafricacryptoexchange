@php
function isImage($file)
{
$extension = explode('.', $file);
$extension = $extension[1];
$images = ['jpg', 'svg', 'jpeg', 'png'];
$is_image = false;
if(in_array($extension, $images)){
$is_image = true;
}

return $is_image;
}
@endphp

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
                        <span>{{ ct('back') }}</span>
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

            <div id="ticket">
                <div id="ticketBody" class="bg-gray-800 border border-gray-600 p-3 my-5 rounded-sm text-[#ebedf2] text-xs md:text-sm">
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

                    {{--  Display first message and attachment if any --}}
                    <div class="bg-gray-700 p-4 mt-6 rounded-sm">
                        <p class="italic">{{ json_decode($ticket->message) }}</p>

                        <div class="mt-3">
                            @foreach ($attachments as $file)
                            @if (isImage($file->hash_name))
                            <a href="{{ route('image', ['tickets', $file->hash_name]) }}" target="_blank" class="flex space-x-1 items-center hover:underline">
                                @else
                                <a href="{{ route('file', ['tickets', $file->hash_name]) }}" class="flex space-x-1 items-center hover:underline">
                                    @endif

                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
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
                            <div>{{ ct('Admin') }}</div>
                            <div class="flex items-center space-x-1">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 md:h-4 w-3 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                            <div>{{ adminUser($ticket->user_id, 'first_name') }}</div>
                            <div class="flex items-center space-x-1">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 md:h-4 w-3 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
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

                </div>
            </div>



            <div>
                <form id="submitForm" class="pt-2 md:pt-4" action="{{ route('user.tickets.reply') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->ticket_id }}">

                    {{--  reply textarea  --}}
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <textarea class="cred-hyip-theme1-textarea p-8" name="message" id="message" required cols="30" rows="5" placeholder="{{ ct('Add a reply') }}...">{{ old('message') }}</textarea>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('message') {{ $message }} @enderror
                        </span>
                    </div>

                    {{--  attachment btn  --}}
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-center space-x-2">
                            <div>
                                <label title="click to add attachments" class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer" for="attachments">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                    <h5>{{ ct('Add attachment(s)') }}</h5>
                                </label>
                                <input class="hidden attachment-input" type="file" name="attachments[]" id="attachments" multiple>
                            </div>

                            <div class="attachment-list">

                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('attachments') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-3 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md" href="{{ route('user.id.upload') }}">
                            {{ ct('Send Reply') }}
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

</script>

@endsection