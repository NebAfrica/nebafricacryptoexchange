@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Edit Ticket - {{ $ticket->ticket_id }}
                    </h2>
                </div>
                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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
            <form action="{{ route('admin.tickets.edit-validate') }}" method="POST">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div class="grid grid-cols-1">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            mail
                        </span>
                        <input class="cred-hyip-theme1-text-input" type="text" name="title" id="title" value="{{ old('title') ?? $ticket->title }}" placeholder="Ticket title/subject" required>
                        <span>@error('title') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <textarea class="cred-hyip-theme1-textarea pl-3" name="message" id="message" placeholder="Ticket message" required>{{ old('message') ?? json_decode($ticket->message) }}</textarea>
                    <span>@error('message') {{ $message }} @enderror</span>
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

@endsection