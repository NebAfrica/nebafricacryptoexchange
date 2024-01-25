@php
    use Modules\CryptoTrading\Entities\TradingBotActivation;
    //get current stake
    function getActivation($bot_id)
    {
        $activations = TradingBotActivation::where('bot_id', $bot_id)->count();
        return $activations;
    }    
@endphp

@extends('admin.layout.app')

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
                    <a href="@if (url()->previous() == route('login')) {{ route('user.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
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

@include('cryptotrading::admin.bots.new')
@include('cryptotrading::admin.bots.activate')
@include('cryptotrading::admin.bots.edit')

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            <div class="flex justify-end space-x-3">
                <div>
                    <a role="button" data-type="open" class="new-button flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
                <div>
                    <a role="button" data-type="activate" class="new-button flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <span>Gen Activation Key</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-5">

            @if ($bots->count() > 0)
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>                        
                        <th>Icon</th>                        
                        <th>Name</th>
                        <th>Price</th>
                        <th>L/W</th>
                        <th>Activations</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @foreach ($bots as $bot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('public/assets/imgs/' . $bot->icon) }}" alt="{{ $bot->name }}" width="50px" class="rounded-full"></td>
                        <td>{{ $bot->name }}</td>
                        <td>{{ formatAmount($bot->price) }}</td>
                        <td>{{ $bot->lose_count }}</td>
                        <td>
                            @if (getActivation($bot->id) == 0)  
                                <span class="bg-red-600 rounded px-2">{{ getActivation($bot->id) }}</span>
                            @else
                                <span class="bg-green-600 rounded px-2">{{ getActivation($bot->id) }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($bot->status == 'disabled')  
                                <span class="bg-red-600 rounded px-2">{{ $bot->status }}</span>
                            @else
                                <span class="bg-green-600 rounded px-2">{{ $bot->status }}</span>
                            @endif
                        </td>
                        
                        <td class="flex justify-space-around">
                            <a role="button" class="new-button" data-type="edit" 
                                data-bot_id="{{ $bot->id }}"
                                data-name="{{ $bot->name }}"
                                data-price="{{ $bot->price }}"
                                data-status="{{ $bot->status }}"
                                data-lw="{{ $bot->lose_count }}"
                            >
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.trading.trading-bots.delete', $bot->id) }}" class="text-red-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
                        <b class="font-medium">Empty Record! </b> There are no bots found.
                    </div>
                </div>
            </div>
            @endif


        </div>
    </div>
</div>

@include('cryptotrading::admin.bots.activations')
<style>
    .general-form {
        width: 40vw;
        
        z-index: 10000;
        top: 0;
        right: 0;
        position: fixed;
        
        
    }

    @media only screen and (max-width: 700px) {
        .general-form {
            width: 90vw;
        }
    }

    .box-shadow {
        box-shadow: -7px 3px 3px -3px rgb(100 130 181 / 74%);
        -webkit-box-shadow: -7px 3px 3px -3px rgb(100 130 181 / 74%);
        -moz-box-shadow: -7px 3px 3px -3px rgb(100 130 181 / 74%);
    }

</style>

@endsection

@section('script')
<script>
    //staking starts here
    $(document).ready(function(){
        $('.new-button').on('click', function(){
            var type = $(this).data('type');
            

            if (type == 'open') {
                
                $('.new-form').show('slow');
            } else if (type == 'activate') {
                $('.activate-form').show('slow');
            } else if (type == 'edit') {
                var bot = $(this);
                $('#e_name').val(bot.data('name'));
                $('.edit-form').show('slow');
            } else {
                $('.general-form').hide('slow');
            }
            
        });
    });
    
</script>
@endsection