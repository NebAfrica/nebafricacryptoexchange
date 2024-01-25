@extends('themes.cryptic.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ ct('User status') }}
                    </h2>
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>{{ ct('back') }}</span>
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
            {{--  disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">{{ ct('DISCLOSURE') }}: </b> {{ ct('You are about to start your account verfication. If any of the gray out fields do not reflect your intended value,') }} <a href="{{ route('user.account.edit') }}">{{ ct('CLICK HERE') }}</a> {{ ct('to edit your account before proceeding.') }}
                        <br> <br>
                        <button id="start-button" type="button" class="w-1/3 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            {{ ct('START NOW') }}
                        </button>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>

<form action="{{ route('user.id.upload-validate') }}" method="POST" id="kyc_form" enctype="multipart/form-data">
    @csrf
    <div class="w-full py-5" id="step-1">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                            {{ ct('Step 1') }}: {{ ct('PERSONAL INFORMATION', 'u') }}
                        </h6>
                    </div>
                </div>

                <hr class="w-full border-b border-dotted border-gray-600 border mt-1 mb-10">

                <div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm mb-1">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="first_name">{{ ct('First Name') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="first_name" id="first_name" value="{{ user('first_name') }} " disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="last_name">{{ ct('Last Name') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="last_name" id="last_name" value="{{ user('last_name') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="gender">{{ ct('Gender') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="gender" id="gender" value="{{ user('gender') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="marital_status">{{ ct('Marital Status') }}:</label>
                            <div class="flex-grow pt-4">
                                <div>
                                    <select class="w-full px-2 md:px-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="marital_status" id="marital_status" required">
                                        <option selected disabled>{{ ct('Select status') }}</option>
                                        <option value="married">{{ ct('Married') }}</option>
                                        <option value="single">{{ ct('Single') }}</option>
                                        <option value="divorced">{{ ct('Divorced') }}</option>
                                    </select>
                                </div>
                                <div>
                                    <small class="text-red-500 text-xs">{{ ct('This field needs your attention', 'l') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="dob">{{ ct('D.O.B') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="dob" id="dob" value="{{ user('dob') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="country">{{ ct('Nationality') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="country" id="country" value="{{ user('country') }}" disabled>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="w-full py-5" id="step-2">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                            {{ ct('Step 2') }}: {{ ct('Address Details') }}
                        </h6>
                    </div>
                </div>

                <hr class="w-full border-b border-dotted border-gray-600 border mt-1 mb-10">

                <div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="country">{{ ct('Address') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="address" id="address" value="{{ user('street_address') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="addrstateess">{{ ct('State') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="state" id="state" value="{{ user('state') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="country">{{ ct('Country') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="country" id="country" value="{{ user('country') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="phone_no">{{ ct('Phone No') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="phone_no" id="phone_no" value="{{ user('phone_no') }}" disabled>
                        </div>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-28 overflow-hidden" for="email">{{ ct('Email') }}:</label>
                            <input class="flex-grow px-2 md:px-4 pt-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="email" id="email" value="{{ user('email') }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full py-5" id="step-3">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                            {{ ct('Step 3') }}: {{ ct('ID Document Upload') }}
                        </h6>
                    </div>
                </div>

                <hr class="w-full border-b border-dotted border-gray-600 border mt-1 mb-10">

                <div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            <label class="font-medium w-32 overflow-hidden" for="id_type">{{ ct('Id Document Type') }}:</label>
                            <select class="flex-grow pt-4 px-2 md:px-4 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="id_type" id="id_type" required">
                                <option selected disabled>{{ ct('Select type') }}</option>
                                <option value="Passport">{{ ct('Passport') }}</option>
                                <option value="Driving License">{{ ct('Driving License') }}</option>
                                <option value="Votor Card">{{ ct('Voter Card') }}</option>
                                <option value="National ID Card">{{ ct('National ID Card') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-32 overflow-hidden" for="front_id">{{ ct('Front ID') }}:</label>
                        <div class="lg:flex-grow pt-4 lg:flex items-center space-x-2">
                            <div class="w-full lg:w-1/3">
                                <label title="click to add file" class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer" for="front_id">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>

                                    <h5>{{ ct('Choose file') }}</h5>
                                </label>
                                <input class="hidden attachment-input" type="file" name="front_id" id="front_id" data-preview="front-preview" accept="image/png, image/jpg, image/jpeg" required>
                            </div>

                            <div class="attachment-list w-full lg:w-2/3"></div>
                            <div><img id="front-preview" class="hidden" src="{{ asset('public/assets/imgs/placeholder.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-32 overflow-hidden" for="back_id">{{ ct('Back ID') }}:</label>
                        <div class="lg:flex-grow pt-4 lg:flex items-center space-x-2">
                            <div class="w-full lg:w-1/3">
                                <label title="click to add file" class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer" for="back_id">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>

                                    <h5>{{ ct('Choose file') }}</h5>
                                </label>
                                <input class="hidden attachment-input" type="file" name="back_id" id="back_id" data-preview="back-preview" accept="image/png, image/jpg, image/jpeg" required>
                            </div>

                            <div class="attachment-list w-full lg:w-2/3"></div>
                            <div><img id="back-preview" class="hidden" src="{{ asset('public/assets/imgs/placeholder.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="text-[#bfc9d4] text-xs md:text-sm">
                    <div class="w-full flex items-baseline space-x-1">
                        <label class="font-medium w-32 overflow-hidden" for="selfie">{{ ct('Selfie') }}:</label>
                        <div class="lg:flex-grow pt-4 lg:flex items-center space-x-2">
                            <div class="w-full lg:w-1/3">
                                <label title="click to add file" class="font-medium py-1 px-3 flex flex-grow justify-center items-center space-x-2 border rounded-md border-slate-800 hover:border-slate-600 cursor-pointer" for="selfie">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>

                                    <h5>{{ ct('Choose file') }}</h5>
                                </label>
                                <input class="hidden attachment-input" type="file" name="selfie" id="selfie" accept="image/png, image/jpg, image/jpeg" data-preview="selfie-preview" required>
                            </div>

                            <div class="attachment-list w-full lg:w-2/3"></div>
                            <div><img id="selfie-preview" class="hidden" src="{{ asset('public/assets/imgs/placeholder.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full py-5" id="step-4">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h6 class="bg-transparent text-center text-[#ebedf2] text-xs md:text-sm capitalize">
                            {{ ct('Step 4') }}: {{ ct('TERMS', 'u') }}
                        </h6>
                    </div>
                </div>

                <hr class="w-full border-b border-dotted border-gray-600 border mt-1 mb-10">

                <div>
                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full flex items-baseline space-x-1">
                            {{ ct('By Proceeding to submit your provided KYC Documents, you agree to that all information provided are accurate and represent you.') }}
                            <br><br>
                            <input type="checkbox" name="agree" id="agree" required>
                            <label class="font-medium w-28 overflow-hidden" for="country">{{ ct('Agree') }}</label>
                            
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>

        
    
    <div class="w-full py-5 id-navigate">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div align="left">
                        <button type="button" value="0"  class="back-button text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                            </svg>
                        </button>
                    </div>
                    <div align="right">
                        <button type="button" value="1" class="next-button text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>  
                </div>
            </div>
        </div>
    </div>   
</form>

@endsection

@section('script')
<script>
    $(".attachment-input").change(function() {
        // first empty whatever is innit
        $(this).parent().siblings(".attachment-list").html("")

        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            if (names.length < 1)
                names.push($(this).get(0).files[i].name);
            else {
                names.push(", " + $(this).get(0).files[i].name);

            }
        }

        // let chosenDoc = $(this).val().split('\\').pop()
        $(this).parent().siblings(".attachment-list").append(names)
    })
</script>

{{-- kYC Form --}}
<script>
    //hide all steps on page load
    $(document).ready(function(){
        $("#step-1").hide();
        $("#step-2").hide();
        $("#step-3").hide();
        $("#step-4").hide();
        $(".id-navigate").hide();
    });

    //show step 1 when 
    $("#start-button").on('click', function(){
        $("#step-1").show();
        $('html,body').animate({scrollTop: $("#step-1").offset().top}, 2000);
        $(this).hide();
        $(".id-navigate").show();
        $(".back-button").hide();
    });
    
    $(".id-navigate").on('click', function(){
        if( parseInt($(".back-button").val()) >= 1) {
            $(".back-button").show();
        } else {
            $(".back-button").hide();
        }

        if ( parseInt($(".next-button").val()) === 4 ){
            $(".next-button").html('SUBMIT');
        } else if ( parseInt($(".next-button").val()) === 5 ) {
            $("#kyc_form").submit()
        } else {
            $(".next-button").html('<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>');
        }
    });

    //action for next button 
    $(".next-button").on('click', function(){
        
        var current_step = parseInt($(this).val());
        var next_step = current_step + 1;
        var next_to = '#step-' + next_step;
        $("#step-" + current_step).hide();
        $(next_to).show('slow');
        $(this).val(next_step); //update next step
        $(".back-button").val(current_step); //update back step
        
        if (current_step <= 4) {
            $('html,body').animate({scrollTop: $(next_to).offset().top}, 2000);
        }
        
        
    });

    //action for back button
    $(".back-button").on('click', function(){
        var current_back_step = parseInt($(this).val());
        var forward = current_back_step + 1;
        var to_show = "#step-" + current_back_step;
        var to_hide = "#step-" + forward;
        
        $(to_hide).hide();
        $(to_show).show('slow');
        $('html,body').animate({scrollTop: $(to_show).offset().top}, 2000);
        //decrease the values for back and next
        $(this).val(current_back_step - 1);
        $(".next-button").val(current_back_step);
        
    });

</script>

@endsection