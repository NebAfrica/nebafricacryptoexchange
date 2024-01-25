@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        All Investments
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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

@section('infographics')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="w-full py-5">
                <div class="w-full lg:grid lg:grid-cols-3 lg:gap-3 lg:place-content-evenly space-y-3 lg:space-y-0 text-[#bfc9d4]">
                    <div class="lg:col-span-2 flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($investments->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Total Investments</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($investments->sum('total_profit_earned')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Total ROI</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($investments->where('status', 'active')->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Active Investments</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#922e9b] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($investments->where('status', 'suspended')->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Suspended Investments</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#922e9b] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ formatAmount($investments->where('status', 'expired')->sum('amount')) }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Expired Investments</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center items-center mt-5">
                <div class="w-full flex justify-center items-center lg:w-2/3">
                    <canvas id="myChart" width="100" height="100"></canvas>
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

            @if ($investments->count() > 0)
            <form action="{{ route('admin.investments.action') }}" method="POST">
                @csrf
                <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                    <div class="text-xs lg:text-sm">
                        <label for="action">With Selected:</label>
                    </div>
                    <div>
                        <select name="action" id="action1" class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                            <option value="" selected disabled>Choose Action</option>
                            <option value="suspend">Suspend</option>
                            <option value="reactivate">Reactivate</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Go
                        </button>
                    </div>
                </div>

                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="all" id="all"></th>
                            <th></th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Expected ROI</th>
                            <th>Earned ROI</th>
                            <th>Last Profit</th>
                            <th>Next Profit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($investments as $invt)
                        <tr>
                            <td><input type="checkbox" name="ids[]" id="{{ 'id'.$invt->id }}" class="checkSingle" value="{{ $invt->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($invt->created_at)) }}</td>
                            <td><a class="underline" href="{{ route('admin.users.view', $invt->user_id) }}">{{ adminUser($invt->user_id, 'account_id') }}</a></td>
                            <td>{{ $invt->plan_name }}</td>
                            <td>{{ formatAmount($invt->amount) }}</td>
                            <td>{{ formatAmount($invt->profit_per_interval * $invt->total_intervals) }}</td>
                            <td>{{ formatAmount($invt->total_profit_earned) }}</td>
                            <td>
                                @if ($invt->last_profit_time == $invt->next_profit_time)
                                NILL
                                @else
                                {{ formatPastDate($invt->last_profit_time) }}
                                @endif
                            </td>
                            <td>
                                @if ($invt->status == 'active')
                                {{ formatFutureDate($invt->next_profit_time ?? 34) }}
                                @else
                                {{ $invt->status }}
                                @endif

                            </td>
                            <td>{{ $invt->status }}</td>
                            <td class="flex justify-end items-center space-x-3 md:space-x-4">
                                @if ($invt->status == 'active')
                                <a role="button" id="{{ 'suspendInvestment'.$invt->id }}" title="Suspend Investment">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </a>
                                @elseif($invt->status == 'suspended')
                                <a role="button" id="{{ 'reactivateInvestment'.$invt->id }}" title="Reactivate Investment">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </a>
                                @endif
                                <a role="button" id="{{ 'deleteInvestment'.$invt->id }}" title="Delete Investment">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="my-3 text-[#bfc9d4] font-semibold w-full lg:w-3/4 flex items-center space-x-2">
                    <div class="text-xs lg:text-sm">
                        <label for="action">With Selected:</label>
                    </div>
                    <div>
                        <select name="action" id="action1" class="w-full h-9 pl-3 py-1 text-sm text-gray-300 outline-gray-500 outline-1 rounded-md shadow-md bg-transparent border border-gray-600 hover:bg-gray-700 focus:outline-none">
                            <option value="" selected disabled>Choose Action</option>
                            <option value="suspend">Suspend</option>
                            <option value="reactivate">Reactivate</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Go
                        </button>
                    </div>
                </div>
            </form>

            {{--  Delete forms here --}}
            @foreach ($investments as $invt)
            <form action="{{ route('admin.investments.delete', $invt->id) }}" id="{{ 'deleteInvestmentForm'.$invt->id }}" method="POST">
                @csrf
            </form>
            @if ($invt->status == 'active')
            <form action="{{ route('admin.investments.suspend', $invt->id) }}" id="{{ 'suspendInvestmentForm'.$invt->id }}" method="POST">
                @csrf
            </form>
            @elseif ($invt->status == 'suspended')
            <form action="{{ route('admin.investments.reactivate', $invt->id) }}" id="{{ 'reactivateInvestmentForm'.$invt->id }}" method="POST">
                @csrf
            </form>
            @endif
            @endforeach
            {{--  delete forms ends here --}}
            @else
            {{-- disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Empty Record! </b> There are no inevestment records found.
                    </div>
                </div>
            </div>
            @endif



        </div>
    </div>
</div>
@endsection


@section('script')
{{--  Sweet alert --}}
{{--  //Delete investment plan --}}
@foreach ($investments as $invt)
<script>
    //Delete Investment plan
    $(document).ready(function() {
        $("{{ '#deleteInvestment'.$invt->id }}").click(function() {
            Swal.fire({
                title: 'Delete Investment!',
                text: "Do you want to delete this investment? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deleteInvestmentForm'.$invt->id }}").submit();
                }
            });
        });
    });

    //Suspend Investment plan
    $(document).ready(function() {
        $("{{ '#suspendInvestment'.$invt->id }}").click(function() {
            Swal.fire({
                title: 'Suspend Investment!',
                text: "Do you want to suspend this investment?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, suspend',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'suspendInvestmentForm'.$invt->id }}").submit();
                }
            });
        });
    });

    //Reactivate Investment plan
    $(document).ready(function() {
        $("{{ '#reactivateInvestment'.$invt->id }}").click(function() {
            Swal.fire({
                title: 'Reactivate Investment!',
                text: "Do you want to reactivate this investment?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, suspend',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'reactivateInvestmentForm'.$invt->id }}").submit();
                }
            });
        });
    });
</script>
@endforeach

<script>
    let totalInv = "{{ $investments->count() }}"
    let totalRoi = "{{ $investments->count() }}"
    let activeInv = "{{ $investments->where('status', 'active')->count() }}"
    let suspendedInv = "{{ $investments->where('status', 'suspended')->count() }}"
    let expiredInv = "{{ $investments->where('status', 'expired')->count() }}"
    const data = {
        labels: [
            'TOTAL INVESTMENTS',
            'TOTAL ROI',
            'ACTIVE INVESTMENTS',
            'SUSPENDED INVESTMENTS',
            'EXPIRED INVESTMENTS',
        ],
        datasets: [{
            type: 'pie',
            label: "Total Investments",
            data: [parseInt(totalInv)],
            backgroundColor: ['rgb(46, 112, 55)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Total ROI",
            data: [0, parseInt(totalRoi)],
            backgroundColor: ['rgb(78, 58, 170)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Active Investments",
            data: [0, 0, parseInt(activeInv)],
            backgroundColor: ['rgba(223, 151, 43, 0.99)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Suspended Investments",
            data: [0, 0, 0, parseInt(suspendedInv)],
            backgroundColor: ['rgb(146, 46, 155)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Expired Investments",
            data: [0, 0, 0, parseInt(expiredInv)],
            backgroundColor: ['rgb(165, 79, 40)'],
            hoverOffset: 2
        }, ]
    };
    const config = {
        data: data,
        options: {
            layout: {
                padding: 20
            }
        }
    };
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, config)
</script>

@endsection