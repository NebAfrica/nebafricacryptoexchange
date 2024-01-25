<div class="whatsapp">
    <div class="whatsapp-min">
        <div class="icon">
            <img src="{{ asset('public/assets/imgs/whatsapp.png') }}" alt="whatsapp logo">
        </div>
    </div>
    <div class="whatsapp-max">
        <div class="whatsapp-content">
            <div class="whatsapp-main">
                <div class="whatsapp-main-inner">
                    <div class="whatsapp-heading">
                        <div class="whatsapp-logo">
                            <img src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo) }}"
                                alt="logo">
                        </div>
                        <div class="whatsapp-heading-text">
                            <p>
                                <b>{{ websiteInfo('website_name') }}</b> <br>
                                <i>Typically replies within a day</i>
                            </p>
                        </div>

                    </div>
                    <div class="whatsapp-message-body">
                        <p>
                            Hi! <span id="whatsapp-greeting"></span>
                            <span id="whatsapp-time-1"></span>
                        </p>
                        <br>
                        <p id="second-message">
                            {!! str_replace("\r\n", '<br>', json_decode(websiteInfo('whatsapp'))->message) !!}
                            <span id="whatsapp-time-2"></span>
                        </p>
                        <textarea name="whatsapp-message" id="whatsapp-message" rows="3"></textarea>
                        <span id="whatsapp-message-error"></span>
                    </div>

                    <div class="whatsapp-chat-btn">
                        <span class="whatsapp-trigger-btn">Start Chat</span>
                    </div>
                </div>
            </div>

        </div>


        <div class="whatsapp-close-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>

    </div>
</div>

<script>
    // Whatsapp
    $(".whatsapp-min").on('click', function() {
        $(".whatsapp-max").show('slow');
        $(".whatsapp-min").hide();
        var date = new Date();
        var hours = date.getHours();
        var time = hours + ':' + date.getMinutes();
        $('#whatsapp-time-1').html(time);

        if (hours < 12) {
            var greeting = 'Good morning!';
        } else if (hours >= 12 && hours < 16) {
            var greeting = 'Good afternoon!';
        } else {
            var greeting = 'Good evening!';
        }
        $("#whatsapp-greeting").html(greeting);
        $("#second-message").hide().delay(5000).show(0);
        var time_stamp = parseInt(date.getTime()) + 5000;
        var n_date = new Date(time_stamp);
        var n_hours = n_date.getHours();
        var n_time = n_hours + ':' + n_date.getMinutes();
        $('#whatsapp-time-2').html(n_time);

    });

    $(".whatsapp-close-btn").on('click', function() {
        $(".whatsapp-min").show('slow');
        $(".whatsapp-max").hide('slow');

    });

    $(".whatsapp-trigger-btn").on('click', function() {
        var whatsappMessage = $("#whatsapp-message").val();
        var length = whatsappMessage.length
        if (length > 5) {
            $("#whatsapp-message-error").html('');
            $("#whatsapp-message").val('');
            $(".whatsapp-min").show('slow');
            $(".whatsapp-max").hide('slow');
            var redirectToLink = "/whatsapp?message=" + whatsappMessage;
            var redirectTo = encodeURI(redirectToLink);
            window.open(redirectTo, "_blank");
        } else {
            $("#whatsapp-message-error").html('Message too short');

        }

    });
</script>
