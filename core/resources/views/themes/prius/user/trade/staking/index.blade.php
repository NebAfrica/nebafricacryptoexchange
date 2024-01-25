@php
    use Modules\CryptoTrading\Entities\Staking;
    //get current stake
    function getCurrentStake($coin_id)
    {
        $stake = Staking::where('user_id', user('id'))->where('coin_id', $coin_id)->sum('amount');
        return $stake;
    }    
@endphp

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

@include('themes.cryptic.user.trade.staking.new')

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            @if ($coins->count() > 0)
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>                        
                        <th>{{ ct('Icon') }}</th>                        
                        <th>{{ ct("Coin") }}</th>
                        <th>{{ ct('Staking Period') }}</th>
                        <th>{{ ct('APR') }}</th>
                        <th>{{ ct('Stake Rate') }}</th>
                        <th>{{ ct('Coin Distrbution') }}</th>
                        <th>{{ ct('Your Stake') }}</th>
                        <th>{{ ct("Action") }}</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @foreach ($coins as $coin)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('public/assets/imgs/' . $coin->icon) }}" alt="{{ $coin->coin }}" width="50px" class="rounded-full"></td>
                        <td>{{ $coin->coin }} ({{ $coin->symbol }})</td>
                        <td>{{ $coin->duration . ' days' }}</td>
                        <td>{{ $coin->apr }} %</td>
                        <td>{{ $coin->staked / $coin->total * 100 }}%</td>
                        <td>{{ $coin->total  }}</td>
                        <td>
                            @if (getCurrentStake($coin->id) == 0)  
                                <span class="bg-red-600 rounded px-2">{{ getCurrentStake($coin->id) }}</span>
                            @else
                                <span class="bg-green-600 rounded px-2">{{ getCurrentStake($coin->id) }}</span>
                            @endif
                        </td>                       

                        
                        <td class="inline-flex space-x-3 md:space-x-5 @if (getCurrentStake($coin->id) <= $coin->max_stake) stake-button @endif" 
                                data-type="open" 
                                data-coin_id="{{ $coin->id }}"
                                data-coin="{{ $coin->coin }}"
                                data-symbol="{{ $coin->symbol }}"
                                data-duration="{{ $coin->duration }}"
                                data-total="{{ $coin->total }}"
                                data-staked="{{ $coin->staked }}"
                                data-apr="{{ $coin->apr }}"
                                data-daily_return="{{ $coin->daily_return }}"
                                data-min_stake="{{ $coin->min_stake }}"
                                data-max_stake="{{ $coin->max_stake }}"
                                data-price="{{ $coin->price }}"
                                >
                                <a role="button" title="Stake {{ $coin->coin }}">
                                    @if (getCurrentStake($coin->id) <= $coin->max_stake) 
                                        <span class="bg-green-500 p-2 rounded text-white">{{ ct('Stake Now') }}</span>
                                    @else
                                        <span class="bg-gray-500 p-2 rounded text-white">{{ ct('Maxed') }}</span>
                                    @endif
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
                        <b class="font-medium">{{ ct('Empty Record!') }} </b> {{ ct('There are no user coins found.') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
@foreach ($coins as $coin)
<script>
    //staking starts here
    $(document).ready(function(){
        $('.stake-button').on('click', function(){
            var type = $(this).data('type');

            if (type == 'open') {
                var coin = $(this).data('coin');
                var coin_id = $(this).data('coin_id');
                var symbol = $(this).data('symbol');
                var price = $(this).data('price');
                var duration = $(this).data('duration');
                var total = $(this).data('total');
                var apr = $(this).data('apr');
                var staked = $(this).data('staked');
                var min_stake = $(this).data('min_stake');
                var max_stake = $(this).data('max_stake');
                var daily_return = $(this).data('daily_return');
                $('.staking-form').show('slow');
                
                //update the form
                $("#coin").html(coin);
                $("#coin_id").val(coin_id);
                $("#symbol").html(symbol);
                $("#price").html(price);
                $("#duration").html(duration);
                $("#total").html(total);
                $("#apr").html(apr);
                $("#staked").html(staked);
                $("#min_stake").html(min_stake);
                $("#max_stake").html(max_stake);
                $("#daily_return").html(daily_return);
                $("#amount_unit").html(symbol);
                $('#amount').attr('min', min_stake).attr('max', max_stake);
            } else {
                $('.staking-form').hide('slow');
            }
            
        });
    });
    
    //Delete Wallet
    $(document).ready(function() {
        $("{{ '#deleteCoin'.$coin->id }}").click(function() {
            Swal.fire({
                title: '{{ ct("Delete Wallet!") }}',
                text: "{{ ct('Do you want to delete this coins? It cant be reversed') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ct("Yes, Delete") }}',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deleteCoinForm'.$coin->id }}").submit();
                }
            });
        });
    });
</script>
@endforeach

@endsection