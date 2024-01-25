@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Send Email
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
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
                <div class="">
                    <div>
                        <h3 class="font-medium capitalize">Enter email data</h3>
                        <h6 class="text-blue-400 text-xs">
                            most hosting providers limit the number of emails that can be bulk sent per hour. Check with your hosting provider
                        </h6>
                    </div>
                </div>
                <hr class="w-full border-b border-dotted border-gray-600 border my-2">

                <form class="px-3 md:px-5 mt-8" action="{{ route('admin.users.email-validate') }}" method="POST">
                    @csrf
                    <div class="h-44 overflow-y-scroll overflow-x-hidden mb-3">
                        @if (request()->has('email'))
                            <input type="hidden" name="email" id="email" value="{{ urldecode(request()->email) }}">
                        @elseif (session()->has('emails'))
                            <table class="mb-3">
                                @foreach (session()->get('emails') as $email)
                                    <tr>
                                        <td><label for="{{ $email }}">{{ $email }}</label></td>
                                        <td class="px-2"></td>
                                        <td><input type="checkbox" name="emails[]" checked value="{{ $email }}"
                                                id="{{ $email }}"></td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <table class="mb-3">
                                @foreach ($users as $user)
                                    <tr>
                                        <td><label for="{{ $user->email }}">{{ $user->email }}</label></td>
                                        <td class="px-2"></td>
                                        <td><input type="checkbox" name="emails[]" checked value="{{ $user->email }}"
                                                id="{{ $user->email }}"></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif

                    </div>



                    @if (request()->has('return_url'))
                        <input type="hidden" name="return_url" id="return_url"
                            value="{{ urldecode(request()->return_url) }}">
                    @endif

                    <div class="grid grid-cols-1">
                        <div class="relative">
                            <span class="cred-hyip-theme1-input-icon material-icons">
                                mail
                            </span>
                            <input class="cred-hyip-theme1-text-input" type="text" name="subject" id="subject"
                                placeholder="Email subject" required>
                            <span>
                                @error('subject')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <textarea class="cred-hyip-theme1-textarea pl-3" name="message" id="message" placeholder="Email message"
                            rows="10" required>{{ old('message') }}</textarea>
                        <span>
                            @error('message')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit"
                            class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Send email
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
