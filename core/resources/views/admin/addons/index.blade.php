@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Addons
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

            @if (session()->has('upload_errors'))
            {{-- disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Failed! </b> An error Occured. <br>
                        <b class="font-medium">ERROR LOG: </b> <br>
                        @foreach (session()->get('upload_errors') as $upload_error)
                        {{ $loop->iteration . '. ' . $upload_error}} <br>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <form class="mt-5" action="{{ route('admin.addons.upload') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <input type="hidden" name="action" value="install">

                <div class="w-full md:flex md:justify-between items-center space-x-2  cred-hyip-theme1-bg rounded-lg mb-2 p-3">
                    <div class="relative w-full md:w-2/3">
                        <span class="cred-hyip-theme1-input-icon material-icons">
                            upload_file
                        </span>
                        <input class="cred-hyip-theme1-text-input" type="file" name="addon" id="addon" accept=".zip" required>
                        <span>@error('addon') {{ $message }} @enderror</span>
                    </div>
    
                    <div class="w-full md:w-1/3">
                        <button id="upload-button" type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Upload
                        </button>
                    </div>
                </div>
            </form>
            <div class="w-full flex justify-end">
                <a href="https://credcrypto.net/addons" target="_blank" class="flex text-xs text-blue-400">
                    <span>
                        Visit CredCrypto Addon Download Center to download more addons
                    </span>
                    <span>
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                        </svg> 
                    </span>
                    
                </a>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border my-4">
            
            <div class="p-2 md:p-4">
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
                        @foreach ($addons as $addon)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords(str()->of( $addon['name'])->snake()->replace('_', ' ')) }}</td>
                            <td>
                                <span class="p-1 rounded @if ($addon['status'] == 'enabled') bg-green-600 @else bg-red-600 @endif">
                                    {{ $addon['status'] }}
                                </span>  
                            </td>
                            <td class="inline-flex space-x-3 md:space-x-5">

                                @if ($addon['status'] == 'disabled')
                                    <button data-action="enable" data-name="{{ $addon['name'] }}" class="addons-button" title="{{ 'Enable ' . $addon['name'] }}">
                                        <svg class="w-6 h-6 text-cyan-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                @else
                                    <button data-action="disable" data-name="{{ $addon['name'] }}" class="addons-button" title="{{ 'Disable ' . $addon['name'] }}">
                                        <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"></path><path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"></path>
                                        </svg>
                                    </button>
 
                                @endif
                                <button data-action="delete" data-name="{{ $addon['name'] }}" class="addons-button"  title="{{ 'Delete ' . $addon['name'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <a role="button" data-name="{{ $addon['name'] }}"  class="update-button w-full flex item-center justify-between space-x-2 bg-blue-500 px-2 py-1 rounded-full">
                                    <span>
                                        <svg fill="none" class="w-6 h-6" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"></path>
                                        </svg>
                                    </span>
                                    <span>Update</span>
                                </a>

                            </td>
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                    

                </table>
                <form action="{{ route('admin.addons.action') }}" method="post" id="action-form">
                    @csrf
                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="name" id="addon_name">
                </form>

            </div>


        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#upload-form').submit(function(){
            $('#preloader').show();
        });

        $('.addons-button').on('click', function(e){
            e.preventDefault();
            var action = $(this).data('action');
            var name = $(this).data('name');
            $('#action').val(action);
            $('#addon_name').val(name);

            //fire popup
            Swal.fire({
                    title: action + ' ' + name + '?',
                    text: "Do you want to " + action + " this Addon?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1b2e4b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ' + action,
                    background: "#0e1726", 
                    color: "#d1d5db",              
                }).then((result) => {
                if (result.isConfirmed) {                            
                    document.getElementById("action-form").submit();
                }
            });
        })
    </script>

    {{-- Update addons --}}
    <script>
        $('.update-button').on('click', function(e){
            e.preventDefault();
            var addon_name = $(this).data('name');
            Swal.fire({
                title: `<h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            Update ` +  addon_name + `
                        </h2>`,
                html: `
                    <form action="{{ route('admin.addons.upload') }}" method="POST">
                        <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                            <tbody class="p-2 md:p-4">                               
                                <input type="hidden" name="action" value="update">

                                @csrf
                                  
                                
                                <tr>
                                    <td align="center" class="font-medium" colspan="2">
                                        <div class="relative w-full md:w-2/3">
                                            <span class="cred-hyip-theme1-input-icon material-icons">
                                                upload_file
                                            </span>
                                            <input class="cred-hyip-theme1-text-input" type="file" name="addon" id="addon" accept=".zip" required>
                                            <span>@error('addon') {{ $message }} @enderror</span>
                                        </div>
                                    </td>
                                    
                                </tr>  
                                
                                <tr>
                                    <td colspan="2">
                                        <hr class="w-full border-b border-dotted border-gray-600 border">

                                        <div class="w-full mt-5 px-5">
                                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                                Update
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </form>
                `,
                background: "#0e1726",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCloseButton: true,
                color: "#b9bead",
                
            });
        });
    </script>
@endsection