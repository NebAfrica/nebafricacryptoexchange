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


@section('content')

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="w-full flex justify-end space-x-1">
                <div>
                    <a href="{{ route('admin.trading.staking-coins.new') }}" title="Add new Staking Coin" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
            
                <div>
                    <a href="{{ route('admin.trading.staking-coins.log') }}" title="Staking Log" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Staking Log</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-5">
            @if ($coins->count() > 0)
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Created</th>
                        <th>Icon</th>                        
                        <th>Coin</th>
                        <th>Staking Period</th>
                        <th>APR</th>
                        <th>Daily Return</th>
                        <th>Min Stake</th>
                        <th>Max Stake</th>
                        <th>Total</th>
                        <th>Staked</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @foreach ($coins as $coin)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d.m.Y H:i:s', strtotime($coin->created_at)) }}</td>
                        <td><img src="{{ asset('public/assets/imgs/' . $coin->icon) }}" alt="{{ $coin->coin }}" width="50px" class="rounded-full"></td>
                        <td>{{ $coin->coin }}</td>
                        <td>{{ $coin->duration . ' days' }}</td>
                        <td>{{ $coin->apr }} %</td>                                             
                        
                        <td>{{ $coin->daily_return }}%</td>
                        <td>{{ $coin->min_stake }}{{ $coin->symbol }}</td>
                        <td>{{ $coin->max_stake }}{{ $coin->symbol }}</td>
                        <td>{{ $coin->total }}{{ $coin->symbol }}</td>
                        <td>{{ $coin->staked }}{{ $coin->symbol }}</td>
                        <td>{{ formatAmount($coin->price) }}</td> 
                        <form action="{{ route('admin.trading.staking-coins.delete', $coin->id) }}" id="{{ 'deleteCoinForm'.$coin->id }}" method="POST">
                            <td class="inline-flex space-x-3 md:space-x-5">

                                @csrf

                                <a href="{{ route('admin.trading.staking-coins.edit', $coin->id) }}" title="Edit {{ $coin->name }}">
                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a role="button" id="{{ 'deleteCoin'.$coin->id }}" title="delete coins">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>

                            </td>
                        </form>

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
                        <b class="font-medium">Empty Record! </b> There are no user coins found.
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
    //Delete Wallet
    $(document).ready(function() {
        $("{{ '#deleteCoin'.$coin->id }}").click(function() {
            Swal.fire({
                title: 'Delete Wallet!',
                text: "Do you want to delete this coins? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
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