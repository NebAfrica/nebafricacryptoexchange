@foreach ($view_data['sections']->where('name', 'newsletter') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>   
        
        <div  >
            <form action="{{ route('subscribe') }}" method="post" id="subForm">
                @csrf
                <input type="email" name="email" id="email" placeholder="email@exaple.com" required>
                <button type="submit" id="submit">subscrible</button>
            </form>
            
        </div>
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
        
    <script>
        $("#subForm").on("submit", function(e){
            e.preventDefault();
            let email = $('#email').val();               
            $.ajax({
                url: "{{ route('subscribe') }}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    email:email,
                },
                success:function(response){
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     text: 'Custom JS updated',
                    //     showConfirmButton: false,
                    //     timer: 4500,
                    //     background: "#0e1726",
                    //     color: "#b9bead",
                    //     toast: true,
                    //    
                    // });
                    $('#email').val('').prop('readonly', true);
                    $('#subForm').hide();
                    
                    
                    alert('success');
                },
                error: function(response) {
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'error',
                    //     text: 'Failed to update',
                    //     showConfirmButton: false,
                    //     timer: 4500,
                    //     background: "#0e1726",
                    //     color: "#b9bead",
                    //     toast: true,
                    //     
                    // });
                    alert('fail');
                },
            });
        });
    </script>
@endforeach
