<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <div class="w-full flex justify-between">
                <div>
                    <h3 class="font-medium capitalize">Required Folder Permissions</h3>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border my-2">

            @if (in_array(false, $file_permissions))
                <div class="w-full mb-3">
                    <div class="w-full flex justify-center">
                        <div class="w-full rounded-lg bg-[#131d2c] p-2 md:p-4">
                            <div class="flex justify-between items-center ">
                                <div>
                                    <div class="w-full flex space-x-2  text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                        <div class="text-orange-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <b class="font-medium">Warning! </b> Some of your folders are missing the
                                            recommended folder permission.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                <table class="datatable-skeleton-table">
                    <thead>
                        <tr>
                            <th>Folder</th>
                            <th>Current Perm</th>
                            <th>Required Perm</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($file_permissions as $perm)
                            <tr>
                                <td>
                                    {{$perm['folder'] }}
                                </td>
                                
                                <td>
                                    @if ($perm['status'])
                                        <span class="bg-green-500 text-white p-1 rounded">
                                            {{ $perm['perm'] }}
                                        </span>
                                    @else
                                        <span class="bg-red-500 p-1 rounded">
                                            {{ $perm['perm'] }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    0775
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
