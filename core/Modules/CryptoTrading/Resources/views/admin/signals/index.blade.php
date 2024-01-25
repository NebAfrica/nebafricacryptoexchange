@extends('admin.layout.app')




@section('content')

<div class="w-full py-5" id="content">    
    <div class="w-full flex justify-center">
        <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
            
            <div class="w-full flex justify-between">
                <div>
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Trading Signals
                    </h2>
                </div>
                <div>
                    <a href="{{ route('admin.trading.signals.create') }}" title="Add New Loan Plan" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Generate</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-5">

            @if ($signals->count() > 0)
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Generated</th>
                        <th>User</th>
                        <th>Pair</th>
                        <th>Expires</th>
                        <th>Amount</th>
                        <th>Leverage</th>
                        <th>Take Profit</th>
                        <th>Stop Loss</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @foreach ($signals as $signal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d.m.Y H:i:s', strtotime($signal->created_at)) }}</td>
                        <td><a class="underline" href="{{ route('admin.users.view', $signal->user_id) }}">{{ adminUser($signal->user_id, 'account_id') }} </a></td>
                        <td>{{ str_replace('_', '/', $signal->pair) }}</td>                        
                        <td>
                            @if ($signal->end_time > time())
                                {{ formatFutureDate($signal->end_time) }}
                            @else
                                {{ formatPastDate($signal->end_time) }}
                            @endif    
                        </td>
                        <td>{{ formatAmount($signal->amount) }}</td>
                        <td>{{ $signal->leverage }}</td>
                        <td>{{ $signal->tp }}</td>
                        <td>{{ $signal->sl }}</td>
                        <td class="flex justify-between">
                            @if ($signal->type == 'buy')
                                <span class="text-green-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                </span>
                            @else
                                <span class="text-red-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                    </svg>
                                </span>  
                            @endif
                            <span>{{ $signal->type }}</span>
                        </td>
                        <td>
                            @if ($signal->end_time  > time())
                                active
                            @else
                                expired
                            @endif
                        </td>
                        <td class="inline-flex space-x-3 md:space-x-5">

                            @csrf
                            <a role="button" id="" title="delete signal" class="delete_btn" data-value="{{ $signal->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </td>

                    </tr>

                    @endforeach
                </tbody>

            </table>
            @else
            {{--  disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Empty Record! </b> There are no signals found.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


<form action="{{ route('admin.trading.signals.delete') }}" id="deleteForm" method="POST">
    @csrf
    <input type="hidden" name="id" id="id">
</form>

<style>

    

</style>
@endsection

@section('script')
    
@endsection