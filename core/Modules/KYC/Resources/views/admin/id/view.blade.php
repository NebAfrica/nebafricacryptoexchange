@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ adminUser($id_document->user_id, 'first_name') }}&apos;s KYC Documents
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
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-end">
                <div>
                    <a href="{{ route('admin.id.index') }}" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>All Records</span>
                    </a>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                <table class="w-full text-[#bfc9d4] text-xs md:text-sm table-fixed border-separate border-spacing-x-2 border-spacing-y-1 overflow-x-scroll">
                    <tbody class="p-2 md:p-4">
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                    <div>Full Name:</div>
                                </div>
                            </td>
                            <td>
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        @if (adminUser($id_document->user_id, 'id_verified') == 'verified')
                                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-green-500 shadow-lg shadow-green-300"></h6>
                                        @elseif (adminUser($id_document->user_id, 'id_verified') == 'admin_review')
                                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-orange-500 shadow-lg shadow-orange-300"></h6>
                                        @elseif (adminUser($id_document->user_id, 'id_verified') == 'rejected')
                                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-red-600 shadow-lg shadow-red-400"></h6>
                                        @elseif (adminUser($id_document->user_id, 'id_verified') == 'pending')
                                        <h6 class="h-3 w-3 rounded-full animate-pulse bg-gray-500 shadow-lg shadow-gray-300"></h6>
                                        @endif
                                    </div>
                                    <div>
                                        {{ adminUser($id_document->user_id, 'first_name') }} {{ adminUser($id_document->user_id, 'last_name') }}
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                    </div>
                                    <div>Address:</div>
                                </div>
                            </td>
                            <td>{{ adminUser($id_document->user_id, 'street_address') }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                    </div>
                                    <div>State/Region:</div>
                                </div>
                            </td>
                            <td>{{ adminUser($id_document->user_id, 'state') }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                                        </svg>
                                    </div>
                                    <div>Country:</div>
                                </div>
                            </td>
                            <td>{{ adminUser($id_document->user_id, 'country') }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <span class="h-6 w-6 material-icons">male</span>
                                    </div>
                                    <div>Gender:</div>
                                </div>
                            </td>
                            <td>{{ adminUser($id_document->user_id, 'gender') }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <div>Date Of Birth:</div>
                                </div>
                            </td>
                            <td>{{ adminUser($id_document->user_id, 'dob') }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                    </div>
                                    <div>Marital Status:</div>
                                </div>
                            </td>
                            <td>{{ $id_document->marital_status }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                        </svg>
                                    </div>
                                    <div>Document Type:</div>
                                </div>
                            </td>
                            <td>{{ $id_document->id_type }}</td>
                        </tr>
                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                        </svg>
                                    </div>
                                    <div>Front ID:</div>
                                </div>
                            </td>
                            <td>
                                <a role="button" id="frontId">
                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                        </svg>
                                    </div>
                                    <div>Back ID:</div>
                                </div>
                            </td>
                            <td>
                                <a role="button" id="backId">
                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-medium">
                                <div class="flex space-x-2 items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                    <div>Selfie:</div>
                                </div>
                            </td>
                            <td>
                                <a role="button" id="selfie">
                                    <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-medium bg-green-400 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                <a role="button" id="processId" class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Process</span>
                                </a>
                            </td>
                            <td class="font-medium bg-red-500 rounded-md transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
                                <a role="button" id="{{ 'deleteId'.$id_document->id }}" class="flex justify-center items-center space-x-1 text-xs text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Delete</span>
                                </a>
                            </td>
                            <form action="{{ route('admin.id.delete', $id_document->id) }}" method="post" id="{{ 'deleteIdForm'.$id_document->id }}">
                                @csrf
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    //Delete ID
    $(document).ready(function() {
        $("{{ '#deleteId'.$id_document->id }}").click(function() {
            Swal.fire({
                title: 'Delete ID!',
                text: "Do you want to delete this ID Document? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    //submit the hidden form
                    document.getElementById("{{ 'deleteIdForm'.$id_document->id }}").submit();
                }
            });
        });
    });

    //Front ID
    $(document).ready(function() {
        $("#frontId").click(function() {
            Swal.fire({
                title: 'Front ID',
                html: `<img src="{{ route('file', ['id', $id_document->front_id]) }}" alt="Front ID">`,
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'New Tab',
                cancelButtonText: 'Close',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("{{ asset('public/storage/id').'/'.$id_document->front_id }}", '_blank').focus();

                }
            });
        });
    });

    //Back ID
    $(document).ready(function() {
        $("#backId").click(function() {
            Swal.fire({
                title: 'Back ID',
                html: `<img src="{{ route('file', ['id', $id_document->back_id]) }}" alt="Back ID">`,
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'New Tab',
                cancelButtonText: 'Close',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("{{ asset('public/storage/id').'/'.$id_document->back_id }}", '_blank').focus();

                }
            });
        });
    });

    //Selfie
    $(document).ready(function() {
        $("#selfie").click(function() {
            Swal.fire({
                title: 'Selfie',
                html: `<img src="{{ route('file', ['id', $id_document->selfie]) }}" alt="Front ID">`,
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'New Tab',
                cancelButtonText: 'Close',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("{{ asset('public/storage/id').'/'.$id_document->selfie }}", '_blank').focus();

                }
            });
        });
    });

    //Process ID
    $(document).ready(function() {
        $("#processId").click(function() {
            Swal.fire({
                html: `
                {{--  process form --}}
                <div class="p-2 md:p-4 text-[#bfc9d4]">
                    <form action="{{ route('admin.id.process') }}" method="POST">
                        @csrf
                        <h3 class="text-sm lg:text-base font-medium mb-4">Process KYC </h3>
                        <input type="hidden" name="document_id" value="{{ $id_document->id }}">
                        <div class="space-y-5">
                            {{--  Action --}}
                            <div class="relative w-full">
                                <span class="cred-hyip-theme1-input-icon material-icons">
                                    reorder
                                </span>
                                <select name="action" id="action" class="cred-hyip-theme1-text-input" required>
                                    <option value="" selected disabled>Choose Action</option>
                                    <option value="approve">Approve</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div> 

                            {{--  Addtional comment --}}
                            <div>
                                <textarea name="comment" id="comment" rows="5" required placeholder="Enter comment" class="cred-hyip-theme1-textarea pl-4">{!! $id_document->comment !!}</textarea>
                            </div>
                        </div>

                        <div class="w-full my-5" align="left">
                            <button type="submit" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Process
                            </button>
                        </div>
                    </form>
                </div>
                `,
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                background: "#0e1726",
                color: "#d1d5db",
                
            });
        });
    });
</script>

@endsection