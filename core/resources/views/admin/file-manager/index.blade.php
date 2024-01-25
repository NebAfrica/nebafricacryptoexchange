@php
    //format file size
    if (!function_exists('fileSizeConvert')) {
        function fileSizeConvert($bytes)
        {
            $bytes = floatval($bytes);
                $arBytes = array(
                    0 => array(
                        "UNIT" => "TB",
                        "VALUE" => pow(1024, 4)
                    ),
                    1 => array(
                        "UNIT" => "GB",
                        "VALUE" => pow(1024, 3)
                    ),
                    2 => array(
                        "UNIT" => "MB",
                        "VALUE" => pow(1024, 2)
                    ),
                    3 => array(
                        "UNIT" => "KB",
                        "VALUE" => 1024
                    ),
                    4 => array(
                        "UNIT" => "B",
                        "VALUE" => 1
                    ),
                );

            foreach($arBytes as $arItem)
            {
                if($bytes >= $arItem["VALUE"])
                {
                    $result = $bytes / $arItem["VALUE"];
                    $result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
                    break;
                }
            }
            return $result ?? 000;
        }
    }
    // format folder name
    if (!function_exists('formatItemName')) {
        function formatItemName($item) {            
            $n_item = pathinfo($item);
            $n_item = $n_item['basename'];            
            return $n_item;
        }
    }

    //folder size 
    if (!function_exists('getFolderSize')) {
        function getFolderSize($folder) 
        {
            $files = \File::files($folder);
            $folder_size = 0;
            foreach ($files as $file) {
                $folder_size += filesize($file);
            }

            //if the folder is empty
            if ($folder_size == 0) {
                $folder_size = 5;
            }

            return $folder_size;            
        }
    }

    //determine file type
    if(!function_exists('getFileType')) {
        function getFileType($item) {
            $is_code = ['js', 'php', 'html', 'css', 'py', 'md', 'txt', 'json', 'NULL', 'xml', 'log'];
            $is_image = ['png', 'svg', 'jpg', 'jpeg', 'gif'];

            $extension = pathinfo($item);
            $extension = $extension['extension'] ?? 'NULL';
            
            if (in_array($extension, $is_code)) {
                return 'code';
            } elseif (in_array($extension, $is_image)) {
                return 'image';
            } else {
                return 'none';
            }
            
        }
    }

    //formt  image link
    if (!function_exists('formatImageLink')) {
        function formatImageLink($item) 
        {
            $n_item  = str_replace('\\', '/', $item);
            //check where is a private or public image
            if (str()->contains($n_item, '/public/assets')) {
                //public image
                $n_item = explode('/public/assets', $n_item);
                $n_item = $n_item[1];
                $image_link = asset('public/assets' . $n_item);
            } else {
                //private image
                $n_item = explode('app/public/', $n_item);
                $n_item = $n_item[1] ?? null;
                $item_name = formatItemName($item);
                $item_folder = str_replace('/' . $item_name, '', $n_item);

                $image_link = route('image', ['folder' => $item_folder, 'file' => $item_name]);
            
            }            

            return $image_link;
        }
    }
@endphp


@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        File Manager
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
            <div class="file-upload-panel @if (!request()->has('folder')) hidden @endif">
                <form class="mt-5" action="{{ route('admin.file-manager.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="folder" id="folder" value="{{ urlencode(request()->folder) }}">
    
                    <div class="w-full">
                        <div class="flex space-x-5">
                            <div class="w2/3 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                                        <div class="w-full">
                                            <label class="font-medium" for="file">Select file to upload:</label>
                                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="file" type="file"  required>
                                        </div>
                                        <span class="p-1 text-red-600">
                                            @error('file') {{ $message }} @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="w-1/3 pt-2">
                                <div class="text-[#bfc9d4] text-xs md:text-sm mb-3">
                                    <div class="w-full mb-5 px-5">
                                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                            Upload
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>  
                    
                </form>
    
                <div class="flex justify-end space-x-2" >
                            
                    <div class="manager-nav-panel-btn">
                        <a href="{{ route('admin.file-manager.index') }}" title="Back to file manager" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="manager-nav-panel-btn">
                        <a href="{{ request()->return_to }}" title="Back" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>                        
                    
                </div>
    
                <hr class="w-full border-b border-dotted border-gray-600 border my-4">
            </div>

            
            {{--  root content --}}
            <div class="root-content">
                <div class="p-3 my-5 rounded-sm text-[#ebedf2] text-xs md:text-sm">                 
                    
                    <div class="root-content-public">
                        
                        <table  class="datatable-skeleton-table text-[#bfc9d4] text-xs md:text-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Last Modified</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody width="100%">
                                @foreach ($root_folders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span data-folder="{{ urlencode($item) }}" class="folder-btn flex justify-start">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd"></path>
                                                <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"></path>
                                            </svg>
                                            {{ ' ' . formatItemName($item) }}
                                        </span>                                        
                                    </td>
                                    <td>{{ fileSizeConvert(getFolderSize($item))  }}</td>
                                    <td>{{ date('d.m.Y H:i:s', stat($item)['mtime']) }}</td>
                                    <td>{{ substr(sprintf('%o', fileperms($item)), -4) }}</td>                                    
                                    
                                    <td class="inline-flex space-x-3 md:space-x-5">
                                                                               
            
                                    </td>
                                </tr>
            
                                @endforeach
                                @foreach ($root_files as $item)
                                <tr id="{{ 'file-' . $loop->iteration }}">
                                    <td>{{ $loop->iteration + count($root_folders) }}</td>
                                    <td  class="flex justify-start">                                        
                                        {{ formatItemName($item) }}
                                    </td>
                                    <td>{{ fileSizeConvert(filesize($item)) }}</td>
                                    <td>{{ date('d.m.Y H:i:s', filemtime($item)) }}</td>  
                                    <td>{{ substr(sprintf('%o', fileperms($item)), -4) }}</td>                                  
                                    
                                    <td class="inline-flex space-x-3 md:space-x-5">
                                        <a href="{{ route('admin.file-manager.download', ['file' => urlencode($item)])  }}">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                        @if (getFileType($item) == 'code')
                                            <a href="{{ 'vscode://file/' . urlencode($item) }}" target="_blank">
                                                <img src="{{ asset('public/assets/imgs/vscode.svg') }}" class="h-5 w-5" alt="">                                                                                                      
                                            </a>
                                            <a href="{{ route('admin.file-manager.editor', ['file' => urlencode($item)])  }}" target="_blank">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        @elseif (getFileType($item) == 'image')
                                            <a href="{{ formatImageLink($item) }}" target="_blank">
                                                <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a> 
                                            <button type="button" class="file_delete_btn" data-hide="{{ 'file-' . $loop->iteration }}" data-file="{{ urlencode($item) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>

                                        @endif
                                        
            
                                    </td>
                                </tr>
            
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                   
                </div>
            </div>
            {{--  root content --}}

        </div>
    </div>
</div>

<style>
    .folder-btn {
        cursor: pointer;
    }
</style>
@endsection


@section('script')
<script>
    $('.folder-btn').on('click', function(){
        var folder = $(this).data('folder');
        var url = "{{ route('admin.file-manager.index') }}?folder=" + folder + "&return_to={{ urlencode(request()->fullUrl()) }}"; 
        window.location.href = url;
        //alert(url);
    });

  

    



   

    
    
</script>

{{--  datatable --}}

<script>
    $('.datatable-skeleton-table').DataTable({
        scrollX: true,
        "sScrollXInner": "100%",
    });
</script>



{{--  delete file --}}

<script>
    $(".datatable-skeleton-table").on("click", ".file_delete_btn", function(){
        let path_to_file = $(this).data('file');
        let to_hide = '#' + $(this).data('hide');
        
        Swal.fire({
            title: 'Delete File!',
            text: "Do you really want to delete this file? This action can't be reversed",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b2e4b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete',
            background: "#0e1726",
            color: "#d1d5db",
            
        }).then((result) => {
            if (result.isConfirmed) {
                $('#preloader').show();
                $.ajax({
                    url: "{{ route('admin.file-manager.delete') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        path_to_file: path_to_file,
                    },
                    success: function(response) {
                        $('#preloader').hide();
                        $(to_hide).hide();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            text: 'File Deleted',
                            showConfirmButton: false,
                            timer: 4500,
                            background: "#0e1726",
                            color: "#b9bead",
                            toast: true,
                            
                        });
                    },
                    error: function(response) {
                        $('#preloader').hide();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            text: 'Failed to Delete file',
                            showConfirmButton: false,
                            timer: 4500,
                            background: "#0e1726",
                            color: "#b9bead",
                            toast: true,
                            
                        });
                    },
                });
            }
        });
    });
</script>



@endsection