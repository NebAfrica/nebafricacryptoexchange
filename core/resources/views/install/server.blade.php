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
                <div class="h-3 w-12 bg-[#6571aa3d]"></div>

                <div class="w-10 h-10 md:w-14 md:h-14 rounded-full bg-[#6571aa3d] flex justify-center items-center">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                    </svg>
                </div>
            </div>

            {{-- info --}}
            <div class="w-full">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3">Server Requirements</h3>
            </div>

            {{-- requirements list & check --}}
            <div class="w-full flex justify-evenly items-start text-[#dae0f5] text-sm md:text-base mt-5 md:mt-0 p-2 md:p-5">
                <?php
                $halfArr = round(count($extensions) / 2);
                ?>
                @if($halfArr > 5)
                <table class="table-fixed">
                    <tr>
                        <td class="px-3 font-medium">
                            PHP
                            <span class="hidden md:inline-block">version</span><span class="md:hidden">v</span>8.x.x
                        </td>
                        {{-- <td class="py-2 px-3">PHP VERSION 8.1.x is required. You have {{ phpversion() }}</td> --}}
                        <td class="px-3 font-medium">
                            <?php echo getIcon($php_version) ?>
                        </td>
                    </tr>
                    @foreach (array_slice($extensions, 0, $halfArr-1) as $extension => $loaded)
                    <tr>
                        <td class="px-3 font-medium">{{ $extension }}</td>
                        {{-- <td>{{ strtoupper($extension) }} php extension is required</td> --}}
                        <td class="px-3 font-medium">
                            <?php echo getIcon($loaded) ?>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <table class="table-fixed">
                    @foreach (array_slice($extensions, $halfArr-1, count($extensions)) as $extension => $loaded)
                    <tr>
                        <td class="px-3 font-medium">{{ $extension }}</td>
                        <td class="px-3 font-medium">
                            <?php echo getIcon($loaded) ?>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @else
                <table class="table-auto">
                    <tr>
                        <td class="px-3 font-medium">Php Version(8.1.x)</td>
                        <td class="px-3 font-medium">
                            <?php echo getIcon($php_version) ?>
                        </td>
                    </tr>
                    @foreach ($extensions as $extension => $loaded)
                    <tr>
                        <td class="px-3 font-medium">{{ $extension }}</td>
                        <td class="px-3 font-medium">
                            <?php echo getIcon($loaded) ?>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>

            {{-- optional checks --}}
            <div class="w-full items-center">
                <h3 class="w-full text-center text-[#eaecf1] font-bold md:text-lg mt-3 "> <span class="border-b-2">Optional Checks</span> </h3>
                <div class="flex justify-center">
                    <p class="w-full md:w-2/3 text-center text-[#eaecf1]  mt-3">
                        Below checks are optional, however, if you are experiencing any  problems with installation, kindly ensure the recommended values are met by your hosting provider.
                    </p>
                </div>
                
            </div>
            <div class="w-full flex justify-evenly items-start text-[#dae0f5] text-sm md:text-base mt-5 md:mt-0 p-2 md:p-5">
                <table class="w-full md:w-2/3">
                    <tr class="border-b-2">
                        <td class="px-3 font-medium">Check</td>
                        <td class="px-3 font-medium">Current</td>
                        <td class="px-3 font-medium">Recommended</td>
                    </tr>
                    
                    @foreach ($execution_sizes as $check => $ex)
                        <tr>
                            <td class="px-3 ">{{ $check }}</td>                            
                            <td class="flex">
                                <span class="rounded px-2 @if ($ex['status'] !== true) bg-red-500 @else bg-green-500 @endif">
                                    {{ $ex['current'] }}
                                </span>                                
                            </td>
                            <td class="px-3">
                                {{ $ex['recommended'] }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="w-full flex justify-between mt-6">
            {{-- Prev button --}}
            <div>
                <a href="{{ route('install.index') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            </div>

            {{-- Reload button --}}
            <div>
                @if ($server == false)
                <a href="{{ route('install.server') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </a>
                @endif
            </div>

            {{-- Next button --}}
            <div>
                @if ($server == true)
                <a href="{{ route('install.permissions') }}" class="trigger flex justify-center items-center cursor-pointer bg-[#5457b6] hover:bg-[#c3c4ef] text-white font-semibold h-10 md:h-16 w-10 md:w-16 rounded-full">
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