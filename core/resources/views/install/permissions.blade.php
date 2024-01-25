<?php
function getIcon($condition)
{
    if ($condition === false)
        return '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>';

    return '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>';
}
?>
@extends('install.app')

@section('content')

<div class="w-full flex justify-center">
    <div class="w-11/12 md:w-3/4 mt-16 md:mt-9">
        {{-- Step indicator --}}
        <div class="w-full flex justify-center">
            <div class="w-full flex justify-center items-center">
                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">1</h2>
                </div>
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">2</h2>
                </div>
                <div class="h-3 w-12 bg-[#5457b6]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#5457b6] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">3</h2>
                </div>
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">4</h2>
                </div>
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">5</h2>
                </div>
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
                    <h2 class="md:text-xl text-gray-100 font-bold">6</h2>
                </div>

            </div>
        </div>
        {{-- End step indicator --}}
    </div>
</div>

<div class="w-full flex justify-center">
    <div class="w-5/6 md:w-3/4 mt-7">
        <div class="w-full bg-[#5457b6] p-3 md:p-5 h-[29rem] md:h-[26rem] overflow-y-scroll">

            <div class="w-full flex justify-center mt-8 md:mt-0">
                <div class="w-20 h-20 bg-white rounded-full flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                </div>
            </div>

            {{-- info --}}
            <div class="w-full">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">Folder Permissions & File Requirements</h3>
            </div>

            {{-- permissions list & check --}}
            <div class="w-full flex justify-evenly items-start text-[#dae0f5] text-sm md:text-base mt-5 md:mt-0 p-2 md:p-5">
                <table class="table-fixed">
                    @foreach ($permissions as $folder)
                    <tr>
                        <td class="px-3 font-medium">
                            {{ $folder['folder'] }}
                        </td>
                        <td class="px-3 font-medium">
                            <span class="hidden md:inline-block">Permission</span>: 0775
                        </td>
                        <td class="px-3 font-medium">
                            <?php echo getIcon($folder['status']) ?>
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($required_files as $file => $check)
                    <tr>
                        <td class="px-3 font-medium">
                            {{ $file }}
                        </td>
                        <td class="px-3 font-medium">
                            Required
                        </td>
                        <td class="px-3 font-medium">
                            <?php echo getIcon($check) ?>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="w-full flex justify-between mt-6">
            {{-- Prev button --}}
            <div>
                <a href="{{ route('install.server') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            {{-- Reload button --}}
            <div>
                @if ($permission_check == false)
                <a href="{{ route('install.permissions') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </a>
                    
                @endif
            </div>

            {{-- Next button --}}
            <div>
                @if ($permission_check == true)
                <a href="{{ route('install.database') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection