@extends('themes.skeleton.layout.app')
@section('title')
<div  >
    <div  >
        <div  >
            <div  >
                <div>
                    {{--  Card header --}}
                    <h2  >
                        My Withdrawal Wallets
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}"  >
                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
<div  >
    <div  >
        <div  >
            @if ($wallets->count() > 0)
                <table id="datatable-skeleton-table"  >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Wallet Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($wallets as $wallet)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d.m.Y H:i:s', strtotime($wallet->created_at)) }}</td>
                            <td>{{ $wallet->name }}</td>
                            <td>{{ $wallet->type }}</td>
                            <form action="{{ route('user.wallets.delete', $wallet->id) }}" id="{{ 'deleteWalletForm'.$wallet->id }}" method="POST">
                                @csrf   
                                <td  >
                                    <a href="{{ route('user.wallets.view', $wallet->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('user.wallets.edit', $wallet->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a role="button"  id="{{ 'delete'.$wallet->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
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

                {{-- disclaimer notification --}}
                <div  >
                    <div  >
                        <div  >
                            <svg xmlns="http://www.w3.org/2000/svg"   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        </div>
                        <div>
                            <b  >Empty Record! </b> You haven't added any wallet.
                        </div>
                    </div>
                </div> 

            @endif

        </div>
    </div>
</div>
@endsection

@section('script')
@foreach ($wallets as $wallet)
<script>
    document.getElementById("{{ 'delete'.$wallet->id }}").addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b2e4b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete',
            background: "#0e1726", 
            color: "#d1d5db",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("{{ 'deleteWalletForm'.$wallet->id }}").submit();
            }
        })

    })
</script>
@endforeach
@endsection