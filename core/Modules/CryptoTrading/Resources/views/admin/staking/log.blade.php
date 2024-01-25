<?php
use Modules\CryptoTrading\Entities\StakingCoin;
//get the coin name
function coin($id)
{
    $coin = StakingCoin::where('id', $id)->first();
    return $coin;
}
?>

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
                        <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif"
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

    <div class="py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
                <div class="w-full flex justify-end space-x-1">
                    <div>
                        <a href="{{ route('admin.trading.staking-coins.new') }}" title="Add new Staking Coin"
                            class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Add New</span>
                        </a>
                    </div>

                    <div>
                        <a role="button" title="Staking Log"
                            class="cancelAllStake flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-red-500 hover:bg-gray-700 rounded-md">
                            
                            <span>Cancel All</span>
                        </a>
                    </div>
                </div>
                <hr class="w-full border-b border-dotted border-gray-600 border my-5">
                @if ($stakings->count() > 0)
                    <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Coin</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Staked</th>
                                <th>Daily Return</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody width="100%">
                            @foreach ($stakings as $staking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d.m.Y H:i:s', strtotime($staking->created_at)) }}</td>
                                    <td>{{ coin($staking->coin_id)->coin ?? 'Nill' }}</td>
                                    <td><a href="{{ route('admin.users.index', ['user_id' => $staking->user_id]) }}">{{ adminUser($staking->user_id, 'first_name') }}
                                            {{ adminUser($staking->user_id, 'last_name') }}</a></td>
                                    <td>{{ formatAmount($staking->staked) }}</td>
                                    <td>{{ $staking->amount }}{{ coin($staking->coin_id)->symbol ?? 'Nill' }}</td>

                                    <td>{{ $staking->daily_return }}%</td>
                                    <td>{{ $staking->returnable . ' days' }}</td>



                                    <td class="inline-flex space-x-3 md:space-x-5">


                                        <a role="button" class="cancelStake" title="Cancel Staking"
                                            data-id="{{ $staking->id }}" >
                                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-6 w-6 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
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
                        <div
                            class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                            <div class="text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                </svg>
                            </div>
                            <div>
                                <b class="font-medium">Empty Record! </b> There are no stakings.
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <form action="" method="post" id="cancelForm">
        @csrf
        <input type="hidden" name="id" id="id">
    </form>
    <form action="{{ route('admin.trading.staking-coins.cancel-all') }}" method="post" id="cancelForm">
        @csrf
        
    </form>
@endsection

@section('script')
    <script>
        $('.cancelStake').on('click', function(){
            var id = $(this).data('id');
            $('#id').val(id);
            Swal.fire({
                title: 'Cancel Staking!',
                text: "Do you want to cancel this staking? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel',
                cancelButtonText: 'No',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("cancelForm").submit();
                }
            });
        })
    </script>
    <script>
        $('.cancelAllStake').on('click', function(){
            
            Swal.fire({
                title: 'Cancel All Staking!',
                text: "Do you want to cancel all stakings? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel',
                cancelButtonText: 'No',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("cancelAllForm").submit();
                }
            });
        })
    </script>
@endsection
