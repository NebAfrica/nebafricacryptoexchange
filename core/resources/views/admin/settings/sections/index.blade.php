@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{--  Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Manage Sections
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
            <form action="{{ route('admin.settings.sections.ajax') }}" id="hiddenForm" method="post">
                <input type="hidden" name="section" id="section" placeholder="section">
                <input type="hidden" name="page" id="page" placeholder="page"> 
                <input type="hidden" name="status" id="status" placeholder="status"> 
                @csrf    
            </form>    
            
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>   
                        <th></th>                  
                        <th></th>
                        <th colspan="6">Pages</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th >Sections</th>
                        <th>About</th>
                        <th>Blog</th>
                        <th>Blog Detail</th>
                        <th>Contact</th>
                        <th>Home</th>
                        <th>Plans</th>
                        <th >Action</th>
                         
                    </tr>
                    
                </thead>
                <tbody width="100%">
                    @foreach ($sections as $section)
                    <tr class="hidden-checkbox">  
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $section->name)) }}</td>

                        <td>
                            <label for="{{ $section->name . '-about-' . $loop->iteration }}" data-section="{{ $section->name }}" data-page="about" class="toggle @if(in_array('about', json_decode($section->pages))) toggle--on @else toggle--off  @endif"></label>
                            <input type="checkbox" id="{{ $section->name . '-about-' . $loop->iteration }}"  @if(in_array('about', json_decode($section->pages))) checked @endif>
                        </td>

                        <td>
                            <label for="{{ $section->name . '-blog-' . $loop->iteration }}" data-section="{{ $section->name }}" data-page="blog" class="toggle @if(in_array('blog', json_decode($section->pages))) toggle--on @else toggle--off  @endif"></label>
                            <input type="checkbox" id="{{ $section->name . '-blog-' . $loop->iteration }}"  @if(in_array('blog', json_decode($section->pages))) checked @endif>
                        </td>

                        <td>
                            <label for="{{ $section->name . '-blog_detail-' . $loop->iteration }}" data-section="{{ $section->name }}" data-page="blog_detail" class="toggle @if(in_array('blog_detail', json_decode($section->pages))) toggle--on @else toggle--off  @endif"></label>
                            <input type="checkbox" id="{{ $section->name . '-blog_detail-' . $loop->iteration }}"  @if(in_array('blog_detail', json_decode($section->pages))) checked @endif>
                        </td>

                        <td>
                            <label for="{{ $section->name . '-contact-' . $loop->iteration }}" data-section="{{ $section->name }}" data-page="contact" class="toggle @if(in_array('contact', json_decode($section->pages))) toggle--on @else toggle--off  @endif"></label>
                            <input type="checkbox" id="{{ $section->name . '-contact-' . $loop->iteration }}"  @if(in_array('contact', json_decode($section->pages))) checked @endif>
                        </td>

                        <td>
                            <label for="{{ $section->name . '-home-' . $loop->iteration }}" data-section="{{ $section->name }}" data-page="home" class="toggle @if(in_array('home', json_decode($section->pages))) toggle--on @else toggle--off  @endif"></label>
                            <input type="checkbox" id="{{ $section->name . '-home-' . $loop->iteration }}"  @if(in_array('home', json_decode($section->pages))) checked @endif>
                        </td>

                        <td>
                            <label for="{{ $section->name . '-plans-' . $loop->iteration }}" data-section="{{ $section->name }}" data-page="plans" class="toggle @if(in_array('plans', json_decode($section->pages))) toggle--on @else toggle--off  @endif"></label>
                            <input type="checkbox" id="{{ $section->name . '-plans-' . $loop->iteration }}"  @if(in_array('plans', json_decode($section->pages))) checked @endif>
                        </td>
                        
                        <td class="inline-flex space-x-3 md:space-x-5">                           

                            <a href="{{ route('admin.settings.sections.edit', $section->id )  }}" title="Edit {{ ucwords(str_replace('_', ' ', $section->name)) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </td>              
                        
                    </tr>
                    
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')



<script>
    $(document).ready(function() {
        $("#datatable-skeleton-table").on("click", ".toggle", function(){
            var toggle = this;            
            $(toggle).toggleClass('toggle--on').toggleClass('toggle--off').addClass('toggle--moving');            
            
            setTimeout(function() {
                $(toggle).removeClass('toggle--moving');
            }, 200);

            var section = $(this).data("section");
            var page = $(this).data('page');
            jQuery("#section").val(section);
            jQuery("#page").val(page);

            var input = "#" + $(this).attr('for');

            if ($(input).is(":checked")) {                
                jQuery("#status").val("disabled");               
                
            } else {
                jQuery("#status").val("enabled");
            }
            //submit form
            
            var page = $('#page').val();  
            var section = $('#section').val(); 
            var status = $('#status').val();  
                        
            $.ajax({
                url: "{{ route('admin.settings.sections.ajax') }}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    page:page,
                    section:section,
                    status:status
                },
                success:function(response){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: section + ' section ' + status + ' on ' + page + ' page',
                        showConfirmButton: false,
                        timer: 4500,
                        background: "#0e1726",
                        color: "#b9bead",
                        toast: true,
                        
                    });
                    
                },
                error: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'Failed to update',
                        showConfirmButton: false,
                        timer: 4500,
                        background: "#0e1726",
                        color: "#b9bead",
                        toast: true,
                        
                    });
                },
            });
        });
        
    });
</script>

    
@endsection