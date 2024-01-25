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
                    <a href="#" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('Cancel') }}</span>
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
            <form class="pt-2 md:pt-4" action="{{ route('user.tickets.new-validate') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mt-5 text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <input class="cred-hyip-theme1-text-input pl-5" type="text" name="title" id="title" placeholder="{{ ct('Subject') }}" required value="{{ old('title') }}">
                    </div>
                    <span class="p-1 text-red-600">
                        @error('title') {{ $message }} @enderror
                    </span>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    {{--  reply textarea  --}}
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <textarea class="cred-hyip-theme1-textarea p-8" name="message" id="message" required cols="30" rows="5" placeholder="{{ ct('Add a message') }}...">{{ old('message') }}</textarea>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('message') {{ $message }} @enderror
                        </span>
                    </div>
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

                <div class="w-full my-5 px-5">
                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md" href="{{ route('user.id.upload') }}">
                        {{ ct('Submit Ticket') }}
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
        $(".attachment-list").append(names)
    })
</script>

@endsection