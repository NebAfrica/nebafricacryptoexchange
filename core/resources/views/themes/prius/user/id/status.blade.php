@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                       {{ ct(' user status') }}
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

@section('content')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between">
                <div class="flex justify-start items-center space-x-2">
                    <div>
                        {{-- Display status --}}
                        <h2 class="bg-transparent text-[#ebedf2] md:text-lg font-medium capitalize">
                            {{ ct('Hi') }} <span class="">{{ user('first_name') }}</span>!
                        </h2>
                    </div>

                    <div>
                        @if (user('id_verified') == 'verified')
                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-green-500 shadow-lg shadow-green-300"></h6>
                        @elseif (user('id_verified') == 'admin_review')
                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-orange-500 shadow-lg shadow-orange-300"></h6>
                        @elseif (user('id_verified') == 'rejected')
                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-red-600 shadow-lg shadow-red-400"></h6>
                        @elseif (user('id_verified') == 'pending')
                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-gray-500 shadow-lg shadow-gray-300"></h6>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Display message --}}
            <p class="text-xs md:text-sm font-normal text-[#d1d5db] text-center p-5 md:ml-4 mt-5 bg-[#1b2e4b] rounded-md">
                {{ $id_comment }}
            </p>

            {{-- Display additional message to the user --}}
            @if (user('id_verified') == 'rejected')
            <p class="text-[#ebedf2] text-xs md:text-sm p-3 md:p-5">
                {{ $additional_id_comment }}
            </p>
            @endif

            {{-- display this button to 'pending' && 'reject' --}}
            @if (user('id_verified') == 'pending' || user('id_verified') == 'rejected')
            <h4 class="text-[#ebedf2] text-xs md:text-sm mt-5 px-5">
                {{ ct('To begin your id verification') }}:
            </h4>
            <div class="w-full my-5 px-5">
                <a class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md" href="{{ route('user.id.upload') }}">
                    {{ ct('Click here') }}
                </a>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection