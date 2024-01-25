@foreach ($view_data['sections']->where('name', 'newsletter') as $section)
    <section class="h-full hero-section bg-[#0e1726] text-white pb-28">
        <div class="pt-32">
            <div class="flex justify-center" data-aos="fade-up" data-aos-duration="3000">
                <div class="flex justify-center items-center">
                    <div>
                        <h2 class="capitalize text-6xl sm-font-6 font-bold">{!! json_decode($section->content)->section_heading !!}</h2>
                        <div
                            class="mt-4 h-1 w-full bg-gradient-to-r from-blue-500 via-[#9A7B86] to-orange-400 rounded-xl">
                        </div>
                    </div>
                </div>
            </div>

            <div  class="flex justify-center items-center my-7 px-10" data-aos="fade-up" data-aos-duration="3000">
                <div class="font-semibold text-xl sm-font-4">
                    {!! json_decode($section->content)->section_text !!}
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center" data-aos="fade-up" data-aos-duration="3000">
            <div class="w-11/12 md:w-3/5 h-60 flex justify-center items-center bg-[#111f35] border-4 border-orange-500 rounded-xl">
                <form action="{{ route('subscribe') }}" method="post" id="subForm">
                    @csrf
                    <div class="w-full md:w-9/12 block md:flex justify-center items-center md:space-x-3 relative z-2">
                        <div class="w-full md:w-2/3">
                            <input type="email" name="email" id="email" placeholder="example@email.com"
                                class="w-full px-10 py-5 text-xl sm-font-4 bg-[#0e1726] rounded-xl outline-none">
                        </div>

                        <div class="w-full md:w-1/3 sm:my-3">
                            <button id="submit"
                                class="uppercase text-xl sm-font-4 font-bold rounded-full px-14 py-4 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                                subscribe
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        $("#subForm").on("submit", function(e) {
            e.preventDefault();
            let email = $('#email').val();
            $.ajax({
                url: "{{ route('subscribe') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email,
                },
                success: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        text: 'Thanks for subscribing',
                        showConfirmButton: false,
                        timer: 4500,
                        background: "#ffffff",
                        color: "#0e1726",
                        toast: true,
                        
                    });
                    $('#email').val('').prop('readonly', true);
                    $('#submit').prop('disabled', true);

                },
                error: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        text: 'Failed to suscribe',
                        showConfirmButton: false,
                        timer: 4500,
                        background: "#ffffff",
                        color: "#0e1726",
                        toast: true,
                        
                    });
                },
            });
        });
    </script>
@endforeach
