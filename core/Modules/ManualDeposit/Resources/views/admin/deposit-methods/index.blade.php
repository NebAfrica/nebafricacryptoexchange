@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Manual Deposit Methods
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
            <div class="flex justify-end space-x-3">
                <div>
                    <a href="{{ route('admin.deposit-method.new') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.settings.gateways.index') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <span>Gateways</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-5">

            @if ( $methods->count() > 0)
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @foreach ($methods as $method)
                    <tr>
                        <td><img src="{{ route('file', ['deposit-methods', $method->logo]) }}" alt="{{ $method->name }}" width="50px" class="rounded-full"></td>
                        <td>{{ $method->name }}</td>
                        <td class="@if($method->status == 'active') text-green-600 @else text-red-600 @endif">{{ $method->status }}</td>
                        <td class="inline-flex space-x-3 md:space-x-5">
                            <a href="{{ route('admin.deposit-method.edit-method', $method->id)  }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            @if ($method->status == 'active')

                            <form action="{{ route('admin.deposit-method.disable', $method->id) }}" id="{{ 'disableMethod'.$method->id }}" method="POST">
                                @csrf
                                <div id="{{ 'disableMethod'.$method->id }}" class="text-red-400 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </div>
                            </form>
                            @elseif($method->status == 'inactive')

                            <form action="{{ route('admin.deposit-method.enable', $method->id) }}" id="{{ 'enableMethodForm'.$method->id }}" method="POST">
                                @csrf
                                <div id="{{ 'enableMethod'.$method->id }}" class="text-green-500 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </form>
                            @endif
                            @if ($method->class == 'manual')

                            <form action="{{ route('admin.deposit-method.delete', $method->id) }}" id="{{ 'deleteMethodForm'.$method->id }}" method="POST">
                                @csrf

                                <a role="button" id="{{ 'deleteMethod'.$method->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </form>
                            @endif
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
                        <b class="font-medium">Empty Record! </b> You haven't added any manual deposit methods.
                    </div>
                </div>
            </div>
            @endif



        </div>
    </div>
</div>
@endsection

@section('script')
{{-- Sweet alert --}}

{{-- //delete deposit --}}
@foreach ($methods as $method)
<script>
    //Delete deposit
    $(document).ready(function() {
        $("{{ '#deleteMethod'.$method->id }}").click(function() {
            Swal.fire({
                title: 'Delete Deposit!',
                text: "Do you want to delete this Deposit method? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    //delete deposit method
                    document.getElementById("{{ 'deleteMethodForm'. $method->id }}").submit();
                }
            });
        });
    });
</script>

@if($method->status == 'active')
<script>
    // <a href="deposit-method/disable/{{ $method->id }}">Disable</a>
    //Disable deposit method
    $(document).ready(function() {
        $("{{ '#disableMethod'.$method->id }}").click(function() {
            Swal.fire({
                title: 'Disbale Deposit Method!',
                text: "Do you want disable this Deposit method? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Disable',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    //submit hidden disable form
                    document.getElementById("{{ 'disableMethodForm'.$method->id }}").submit();
                }
            });
        });
    });
</script>

@elseif($method->status == 'inactive')
<script>
    // <a href="deposit-method/enable/{{ $method->id }}">Enable</a>
    //Enable deposit method
    $(document).ready(function() {
        $("{{ '#enableMethod'.$method->id }}").click(function() {
            Swal.fire({
                title: 'Enable Depost Method!',
                text: "Do you want enable this Deposit method? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Enable',
                background: "#0e1726",
                color: "#d1d5db",
               
            }).then((result) => {
                if (result.isConfirmed) {
                    //submit hidden enable form
                    document.getElementById("{{ 'enableMethodForm'.$method->id }}").submit();
                }
            });
        });
    });
</script>
@endif
@endforeach

@endsection