@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('My Trading Wallets') }}
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
{{-- New wallet starts here --}}
@include('themes.cryptic.user.trade.wallets.new')
{{-- New Wallets ends here --}}
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="flex justify-end">
                <div>
                    <a role="button" data-toggle="create-wallet-form" title="Create New Trading Wallet" class="popup-trigger-button flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ ct('New Wallet') }}</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-4">
            @if ($wallets->count() > 0)
                <div id="wallets">
                    <div id="wallets_inner">
                        <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>{{ ct('Symbol') }}</th>
                                    <th>{{ ct('Balance') }}</th>
                                    <th>{{ ct('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody width="100%">
                                @foreach ($wallets as $currency)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                                    
                                    <td class="font-medium">
                                        @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower($currency->symbol) . '.svg'))
                                            <img src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower($currency->symbol) . '.svg') }}" alt="{{ $currency->name }}"  width="50px" class="rounded-full">
                                        @else 
                                            <img src="{{ asset('public/assets/imgs/fallback.png') }}" alt="{{ $currency->name }}"  width="50px" class="rounded-full">
                                        @endif
                                    </td>
                                    <td class="pl-6 md:pl-10">
                                        {{ $currency->symbol }}
                                    </td>
                                    <td>
                                        {{ number_format($currency->balance, 8) }}
                                    </td>
                                    <td>
                                        <a role="button" data-symbol="{{ $currency->symbol }}" class="create-wallet-btn flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                            </svg>
                                            <span>{{ ct('Transactions') }}</span>
                                        </a>
                                    </td>
                                    
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                            <b class="font-medium">{{ ct('Empty Record!') }} </b> {{ ct("You haven't added any wallet.") }}
                        </div>
                    </div>
                </div> 

            @endif

        </div>
    </div>
</div>
@endsection

@section('script')

{{-- create new wallet starts here --}}
<script>
    $('.create-wallet-btn').on('click', function(){
        $('#preloader').show();
        var symbol = $(this).data('symbol');
        
        $.ajax({
            url: "{{  route('user.trading.wallets.create') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                symbol:symbol,
            },
            success: function(response) {
                $('#preloader').hide();
                // get the href
                var reloadUrl = $(location).attr("href");
                $("#wallets").load(reloadUrl + " #wallets_inner");
                $("#create-wallet-form").toggleClass('hidden');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: '{{ ct("Wallet Created successfuly") }}',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });

            },
            error: function(response, status) {
                $('#preloader').hide();
                
                //process validation errors here
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: response.responseJSON.message,
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });

            },
        });
    });
</script>

@endsection