@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Create New Support Ticket
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
            <form class="mt-3 mx-0 md:mx-5 lg:mx-10" action="{{ route('admin.tickets.new-validate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            user
                        </span>
                        <select class="cred-hyip-theme1-text-input" name="user_id" id="user_id" required>
                            <option value="" @if(!old('user_id')) selected @endif disabled>Select User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if(old('user_id')==$user->id) selected @endif>{{ $user->first_name . ' '. $user->last_name }}</option>
                            @endforeach
                        </select>
                        <span>@error('user_id') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <div class="relative">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            mail
                        </span>
                        <input class="cred-hyip-theme1-text-input" type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Ticket title/subject" required>
                        <span>@error('title') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <textarea class="cred-hyip-theme1-textarea pl-3" name="message" id="message" placeholder="Ticket message" required>{{ old('message') }}</textarea>
                    <span>@error('message') {{ $message }} @enderror</span>
                </div>

                {{--  attachment btn  --}}
                <div class="text-[#bfc9d4] text-xs md:text-sm mt-5">
                    <div class="w-full flex items-center space-x-2">
                        <div>
                            <label title="click to add attachments" class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer" for="attachments">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <h5>Add attachment(s)</h5>
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

                <div class="w-full my-5 px-5">
                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        Save Ticket
                    </button>
                </div>
            </form>
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