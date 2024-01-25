@extends('themes.cryptic.layout.app')
@section('title')
<div class="w-full py-5">
   <div class="w-full flex justify-center">
      <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
         <div class="flex justify-between items-center">
            <div>
               {{-- Card header --}}
               <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                  {{ ct('Pay With') }} {{ $payment_method->name }}
               </h2>
            </div>

            <div>
               <a href="{{ url()->previous() }}" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                  </svg>
                  <span>{{ ct('back', 'l') }}</span>
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
      <div class="w-11/12 md:w-2/3 rounded-sm bg-[#0e1726] text-[#d3d6df] p-3 md:p-10">

         {{--  payment details confirmation --}}
         <div class="w-full my-6 md:my-10 flex justify-center">
            <div class="space-y-2">
               <div align="center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#dfb05b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
               </div>
               <div class="text-xs md:text-sm font-medium text-center">
                  <p>{{ ct('You have selected to deposit') }} <b>{{ formatAmount($amount) }}</b> {{ ct('via') }} <b>{{ $payment_method->name }}</b> . {{ ct('A depsoit charge of') }} <b>{{ formatAmount($charge) }}</b> {{ ct('has been applied to your deposit. Follow the payment instruction to complete your payment') }} </p>
               </div>
            </div>
         </div>

         <div class="w-full">
            <div class="flex space-x-2 font-medium">
               <div>
                  <h3 class="text-sm md:text-base">{{ ct('Amount') }}:</h3>
               </div>
               <div>{{ strtoupper($currency) }} {{ number_format($converted_amount, 2) }}</div>
            </div>

            <div class="">
               <div class="font-medium">
                  <h3 class="text-xs md:text-sm">{{ ct('Payment Instruction') }}:</h3>
               </div>
               <div class="text-xs md:text-sm">{!! $payment_method->payment_instruction !!}</div>
            </div>

            <form role="form" action="{{ route('gateway.stripe.pay') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
               @csrf
               <div class="grid grid-cols-1 mt-3">
                  <div class="relative">
                     <span class="cred-hyip-theme1-input-icon material-icons">
                        credit_card
                     </span>
                     <input type="text" placeholder="{{ ct('Name on card') }}" class="cred-hyip-theme1-text-input" size="4">
                  </div>
               </div>

               <div class="grid grid-cols-1 mt-3">
                  <div class="relative">
                     <span class="cred-hyip-theme1-input-icon material-icons">
                        credit_card
                     </span>
                     <input type="text" placeholder="{{ ct('Card Number') }}" autocomplete="off" class="cred-hyip-theme1-text-input card-number" size="20">
                  </div>
               </div>

               <div class="grid grid-cols-1 mt-3">
                  <div class="relative">
                     <span class="cred-hyip-theme1-input-icon font-bold text-xs lg:text-sm">
                        CVC
                     </span>
                     <input type="text" placeholder="{{ ct('CVC') }}" autocomplete="off" class="cred-hyip-theme1-text-input card-cvc" size="4">
                  </div>
               </div>

               <div class="grid grid-cols-1 mt-3">
                  <div class="relative expiration required">
                     <span class="cred-hyip-theme1-input-icon material-icons">
                        calendar_month
                     </span>
                     <input type="text" placeholder="MM" class="cred-hyip-theme1-text-input card-expiry-month" size="2">
                  </div>
               </div>

               <div class="grid grid-cols-1 mt-3">
                  <div class="relative expiration required">
                     <span class="cred-hyip-theme1-input-icon material-icons">
                        calendar_month
                     </span>
                     <input type="text" placeholder="YYYY" class="cred-hyip-theme1-text-input card-expiry-year" size="4">
                  </div>
               </div>

               <div class="form-row row grid grid-cols-1">
                  <div class='col-md-12 error form-group hidden p-5 bg-red-200'>
                     <div class='alert-danger alert text-red-600'>
                        {{ ct('Please correct the errors and try again.') }}
                     </div>
                  </div>
               </div>

               {{--  preview confirm/cancel confirm button --}}
               <div class="w-full flex justify-start items-center space-x-5 mt-5">
                  {{--  confirm --}}
                  <div>
                     <button type="submit" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        {{ ct('Pay now') }}
                     </button>
                  </div>

                  {{--  cancel --}}
                  <div>
                     <button type="button" class="text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 bg-red-600 hover:bg-red-400 rounded-md cancel-payment">
                        {{ ct('Cancel') }}
                     </button>
                  </div>
               </div>

            </form>
         </div>
      </div>
   </div>
</div>

<form id="stripe-cancel-form" action="{{ route('user.deposit.pay.manual.cancel') }}" method="POST">
   @csrf
</form>
@endsection
@section('script')
<script>
   jQuery(function() {
      $(".cancel-payment").click(function() {
         Swal.fire({
            title: '{{ ct("Cancel payment?") }}',
            text: "{{ ct('Are you sure you want to cancel your payment?') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b2e4b',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ ct("Yes, cancel") }}',
            cancelButtonText: '{{ ct("No") }}',
            background: "#0e1726",
            color: "#d1d5db",
            
         }).then((result) => {
            if (result.isConfirmed) {
               $("#stripe-cancel-form").submit();
            }
         });
      });
   });
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
   $(function() {
      var $form = $(".require-validation");
      $('form.require-validation').bind('submit', function(e) {
         var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
               'input[type=text]', 'input[type=file]',
               'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
         $errorMessage.addClass('hidden');
         $('.has-error').removeClass('has-error');
         $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
               $input.parent().addClass('has-error');
               $errorMessage.removeClass('hidden');
               e.preventDefault();
            }
         });
         if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
               number: $('.card-number').val(),
               cvc: $('.card-cvc').val(),
               exp_month: $('.card-expiry-month').val(),
               exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
         }
      });

      function stripeResponseHandler(status, response) {
         if (response.error) {
            $('.error')
               .removeClass('hidden')
               .find('.alert')
               .text(response.error.message);
         } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
         }
      }
   });
</script>
@endsection