@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ $page_title }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('back') }}</span>
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
            @if ($fees->count() > 0)
                <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Blockchain</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody width="100%">
                        @foreach ($fees as $fee)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fee->blockchain }}</td>
                            <td>{{ $fee->fee }}%</td>
                            <td class="inline-flex space-x-3 md:space-x-5">
                                <a role="button" 
                                    data-id="{{ $fee->id }}"
                                    data-blockchain="{{ $fee->blockchain }}"
                                    data-fee="{{ $fee->fee }}"
                                    class="editButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-orange-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
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
                            <b class="font-medium">{{ ct('Empty Record!') }} </b> .
                        </div>
                    </div>
                </div> 
            @endif
        </div>
    </div>
</div>

<div>
    
</div>
@endsection

@section('script')
    <script>
        $('.editButton').on('click', function(){
            

            Swal.fire({
                title: 'Edit Gas Fee',
                html: `
                    <form action="{{ route('admin.nft.edit-gas-fee') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="mb-5 text-[#d1d5db]">
                            <label style="float:left !important;" for="blockchain" class="w-full text-xs lg:text-sm text-left mb-1">Blockchain: <span class="text-xs text-red-500">@error('blockchain') {{ $message }} @enderror</span></label>
                            <input class="cred-hyip-theme1-text-input pl-4" id="blockchain" type="text"  placeholder="BlockChain" name="blockchain" required value="{{ old('blockchain')  }}">

                        </div>
                        <div class="mb-5 text-[#d1d5db]">
                            <label style="float:left !important;" for="fee" class="w-full text-xs lg:text-sm text-left mb-1">Fee(%): <span class="text-xs text-red-500">@error('fee') {{ $message }} @enderror</span></label>
                            <input class="cred-hyip-theme1-text-input pl-4" id="fee" type="number" step="any" placeholder="Fee" name="fee" required value="{{ old('fee')  }}">

                        </div>
                        <div class="w-full">
                            <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Save
                            </button>
                        </div>
                    </form>
                `,
                
                showCancelButton: false,
                showCloseButton: true,
                showConfirmButton: false,
                background: "#0e1726",
                color: "#d1d5db",
                
            });

            $('#id').val($(this).data('id'));
            $('#fee').val($(this).data('fee'));
            $('#blockchain').val($(this).data('blockchain'));
            
        });
    </script>
@endsection