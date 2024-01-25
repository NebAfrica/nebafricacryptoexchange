@foreach ($view_data['sections']->where('name', 'contact') as $section)
    <section class="h-full contact-section bg-[#111f35] text-white pb-28 px-10 lg:px-20">
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
        </div>

        <div class="w-full block md:flex justify-evenly items-top mt-10 relative z-2">
            <div class="w-full md:w-1/2 flex flex-col space-y-4 mb-5">
                <div class="my-7 px-2 md:px-10">
                    <div class="font-semibold text-xl sm-font-4" data-aos="fade-up" data-aos-duration="3000">
                        {!! json_decode($section->content)->section_text !!}
                    </div>
                </div>
                <div class="flex space-x-2 items-center" data-aos="fade-up" data-aos-duration="3000">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10 text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl sm-font-4 font-medium"><a
                                href="{{ 'tel:' . websiteInfo('website_phone_no') }}">{{ websiteInfo('website_phone_no') }}</a>
                        </h4>
                    </div>
                </div>
                <div class="flex space-x-2 items-center" data-aos="fade-up" data-aos-duration="3000">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10 text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl sm-font-4 font-medium"><a
                                href="{{ 'mailto:' . websiteInfo('website_email') }}">{{ websiteInfo('website_email') }}</a>
                        </h4>
                    </div>
                </div>

                <div class="flex space-x-2 items-center" data-aos="fade-up" data-aos-duration="3000">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 h-10 text-orange-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xl sm-font-4 font-medium">
                            {!! websiteInfo('website_contact_address') !!}
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-duration="3000" class="w-full md:w-1/2 md:p-8 border-4 border-orange-500 rounded-2xl flex justify-center bg-[#0e1726] sm:my-3">
                <form action="{{ route('contact-validate') }}" method="post" class="w-10/12">
                    @csrf
                    <div class="w-full">
                        <div class="w-full my-3">
                            <input type="text" name="name" id="name" required placeholder="Name:"
                                value="{{ old('name') }}"
                                class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">
                            <div class="text-red-500 text-xs">
                                <span>
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="w-full my-3">
                            <input type="email" name="email" id="email-1" required value="{{ old('email') }}"
                                placeholder="Email:" class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">
                            <div class="text-red-500 text-xs">
                                <span>
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="w-full my-3">
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                                placeholder="Subject:" class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">
                            <div class="text-red-500 text-xs">
                                <span>
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="w-full my-3">
                            <textarea rows="5" name="message" id="message" placeholder="Message:" required
                                class="w-full py-3 px-5 rounded-md bg-[#111f35] outline-none">{{ old('message') }}</textarea>
                            <div class="text-red-500 text-xs">
                                <span>
                                    @error('message')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        @if (websiteInfo('google_captcha') == 'enabled')
                            <div class="w-full my-3 grid grid-cols-1">
                                <div class="relative">
                                    {!! htmlFormSnippet() !!}
                                    <span>
                                        @error('g-recaptcha-response')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="w-full my-3">
                            <button type="submit"
                                class="uppercase text-sm font-bold rounded-full px-8 py-2 bg-gradient-to-r from-blue-500 hover:from-blue-500 via-[#9A7B86] hover:via-[#9A7B86] to-orange-400 hover:to-orange-500 hover:shadow-lg transition-all">
                                submit
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endforeach
