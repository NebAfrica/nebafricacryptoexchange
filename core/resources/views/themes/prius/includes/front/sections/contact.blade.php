@foreach ($view_data['sections']->where('name', 'contact') as $section)
    <div class="contact-section section-bg">
        <div class="container">
            <div class="row padding-top padding-bottom gy-4 justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="contact__info__item plan__item">
                        <div class="icon">
                            <i class="las la-map-marker"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">Office Address</h3>
                            <div>
                                {!! websiteInfo('website_contact_address') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="contact__info__item plan__item">
                        <div class="icon">
                            <i class="las la-envelope-open-text"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">Email Address</h3>
                            <ul class="contacts">
                                <li><a
                                        href="{{ 'mailto:' . websiteInfo('website_email') }}">{{ websiteInfo('website_email') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="contact__info__item plan__item">
                        <div class="icon">
                            <i class="las la-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">Phone Number</h3>
                            <ul class="contacts">
                                <li><a
                                        href="{{ 'tel:' . websiteInfo('website_phone_no') }}">{{ websiteInfo('website_phone_no') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative map__area">
            <div class="container padding-top padding-bottom contact__area">
                <div class="contact__form__wrapper mx-auto me-lg-0">
                    <h3 class="title">Send Your Messages</h3>
                    <form class="contact__form form" action="{{ route('contact-validate') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form--control" placeholder="Full Name"
                                name="name" id="name" required value="{{ old('name') }}">
                            <span>
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form--control" name="email" placeholder="Email"
                                id="email" value="{{ old('email') }}" required>
                            <span>
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form--control" name="subject"
                                placeholder="Subject" id="subject" value="{{ old('subject') }}" required>
                            <span>
                                @error('subject')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form--control" name="message" placeholder="Write Your Messages" id="message">{{ old('message') }}</textarea>
                            <span>
                                @error('message')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        @if (websiteInfo('google_captcha') == 'enabled')
                            <div class="form-group">
                                <div class="form-control form--control">
                                    {!! htmlFormSnippet() !!}

                                </div>
                                <span>
                                    @error('g-recaptcha-response')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        @endif
                        <button type="submit" class="cmn--btn btn">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="map__wrapper">
                <div class="overlay01"></div>
                <iframe class="map"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4340.214604426607!2d90.39243230460072!3d23.830298940050135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1638968781774!5m2!1sen!2sbd"
                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
@endforeach
