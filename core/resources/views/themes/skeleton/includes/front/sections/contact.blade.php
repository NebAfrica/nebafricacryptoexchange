@foreach ($view_data['sections']->where('name', 'contact') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>   
        
        <div   style="width: calc(40% - 20px); display: inline-block; border: solid 2px blue; margin: 5px;">
            <p>
                <b>Phone: </b> <a href="{{ 'tel:' . websiteInfo('website_phone_no') }}">{{ websiteInfo('website_phone_no') }}</a> <br>
                <b>Email: </b> <a href="{{ 'mailto:' . websiteInfo('website_email') }}">{{ websiteInfo('website_email') }}</a> <br>
                <b>Contact Address: </b> {!! websiteInfo('website_contact_address') !!}
            </p>

            
        </div>


        <div   style="width: calc(40% - 20px); display: inline-block; border: solid 2px blue; margin: 5px;">
            
            <form action="{{ route('contact-validate') }}" method="post">
                @csrf
                <p>
                    <label for="name">Name:</label>
                    <input type="text" required name="name" id="name" value="{{ old('name') }}">
                    <span>@error('name') {{ $message }} @enderror </span>
                </p>

                <p>
                    <label for="Email">Email:</label>
                    <input type="email" required name="email" id="email" value="{{ old('email') }}">
                    <span>@error('email') {{ $message }} @enderror </span>
                </p>

                <p>
                    <label for="subject">Subject:</label>
                    <input type="text" required name="subject" id="subject" value="{{ old('subject') }}">
                    <span>@error('subject') {{ $message }} @enderror </span>
                </p>

                <p>
                    <label for="messsage">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10" required>{{ old('message') }}</textarea>
                    <span>@error('message') {{ $message }} @enderror </span>
                </p>
                @if (websiteInfo('google_captcha') == 'enabled')
                <div  >
                    <div  >
                        {!! htmlFormSnippet() !!}
                        <span>@error('g-recaptcha-response') {{ $message }} @enderror </span>
                    </div>
                </div>
                @endif
                <p>
                    <button type="submit">Send</button>
                </p>

                
            </form>
            

            
        </div>
        
        {{--  <h2>{{ dd($view_data['sections']) }}</h2> --}}

    </section>
@endforeach
