@foreach ($view_data['sections']->where('name', 'calculator') as $section)
    <section  >        
        <div  >
            <h2>{!! json_decode($section->content)->section_heading !!}</h2>
        </div>
        <div  >
            {!! json_decode($section->content)->section_text !!}
            
        </div>   
        
        <div  >
            <form>
                
                <select name="plan" id="cal_plan">
                    <option value="" selected disabled>Choose Plan</option>
                    @foreach ($view_data['plans'] as $plan)
                       <option 
                            value="{{ $plan->name }}" 
                            data-amount_type="{{ $plan->amount_type }}"
                            data-min_amount="{{ $plan->min_amount }}"
                            data-max_amount="{{ $plan->max_amount }}"
                            data-return_type="{{ $plan->return_type }}"
                            data-return="{{ $plan->return }}"
                            data-duration="{{ $plan->duration }}"
                            data-duration_type="{{ $plan->duration_type }}"                            
                            >{{ $plan->name }}
                        </option> 
                    @endforeach
                </select>
                <input type="number" step="any" name="" id="calc_plan_amount" placeholder="Enter Amount" required>
                <button id="cal_submit_button">Calculate</button>
            </form>
            <div id="errorDiv" style="background: red"></div>
            <div id="calc_result" style="display: none">

                <div id="final_result" style="background: green"></div>
                <b>Plan: </b>  <span id="calc_result_name"></span> <br>
                
                <b>Amount: </b> <span id="calc_result_min_amount"></span> <span id="calc_result_max_amount"></span> <br>
                <b>ROI: </b>  <span id="calc_result_return"></span> <br>
                <b>Duration: </b>  <span id="calc_result_duration"></span>  <span id="calc_result_duration_type"></span>(s)<br>
                
            </div>
        </div>
        
        <script>
            $(document).ready(function(){
                //disable amount field
                $("#calc_plan_amount").prop('readonly', true);
                $("#cal_submit_button").on('click', function(e){
                    e.preventDefault();
                });
                $("#cal_plan").on('change', function(){
                    var calc_result_name = $("#cal_plan").val();
                    var calc_result_amount_type = $("#cal_plan").find(':selected').data('amount_type');
                    var calc_result_min_amount = $("#cal_plan").find(':selected').data('min_amount');
                    var calc_result_max_amount = $("#cal_plan").find(':selected').data('max_amount');
                    var calc_result_return = $("#cal_plan").find(':selected').data('return');
                    var calc_result_return_type = $("#cal_plan").find(':selected').data('return_type');
                    var calc_result_duration = $("#cal_plan").find(':selected').data('duration');
                    var calc_result_duration_type = $("#cal_plan").find(':selected').data('duration_type');

                    //show selected plan details to the user
                    $("#calc_result_name").html(calc_result_name);
                    $("#calc_result_min_amount").html("{{ websiteInfo('general_currency') }}" + calc_result_min_amount);
                    
                    $("#calc_result_return_type").html(calc_result_return_type);
                    $("#calc_result_duration").html(calc_result_duration);
                    $("#calc_result_duration_type").html(calc_result_duration_type);
                    if (calc_result_amount_type === 'range') {
                        $("#calc_result_max_amount").html(' - ' + " {{ websiteInfo('general_currency') }}" +  calc_result_max_amount);
                    }

                    //hide error and results
                    $("#errorDiv").html('');
                    $("#final_result").html('');
                    
                    //check return type 
                    if (calc_result_return_type === 'fixed') {
                        $("#calc_result_return").html("{{ websiteInfo('general_currency') }}" + calc_result_return);
                    } else {
                        $("#calc_result_return").html(calc_result_return + "%");
                    }

                    $('#calc_result').show();

                    

                    //for fixed plan, set amount value and make it ready only
                    if (calc_result_amount_type === 'fixed') {
                        $("#calc_plan_amount").val(calc_result_max_amount).prop('readonly', true); 
                        var start_calculation = true;
                    } else {
                        //remove readonly
                        $("#calc_plan_amount").prop('readonly', false).val('');
                        //set min and max
                        $("#calc_plan_amount").attr({
                            'max' : calc_result_max_amount,
                            'min' : calc_result_min_amount,
                        });

                    } 

                    $("#cal_submit_button").on('click', function(e){
                        //check if the min and max followed                        
                        var calc_entered_amount = $("#calc_plan_amount").val();
                        if (calc_entered_amount > calc_result_max_amount|| calc_entered_amount < calc_result_min_amount) {
                            var start_calculation = false;
                            var error_message = "Maximum and minumum amount for selected plan is {{ websiteInfo('general_currency') }}" + calc_result_max_amount + " and {{ websiteInfo('general_currency') }}" + calc_result_min_amount + " respectively";
                        } else {
                            var start_calculation = true;
                        }                      


                        if (start_calculation === false) {
                            $("#errorDiv").html(error_message);
                            $("#final_result").html('');
                            
                        } else {
                            //calculate profit
                            if (calc_result_return_type === 'fixed') {
                                let result = +calc_entered_amount + +calc_result_return;
                                $('#calc_result').show();
                                $('#final_result').html('You will earn {{ websiteInfo("general_currency") }}' + result + ' after '  + calc_result_duration + calc_result_duration_type + '(s)');
                            } else {
                                let calculated = calc_result_return / 100 * calc_entered_amount;
                                let result = +calc_entered_amount + +calculated;
                                $("#errorDiv").html('');
                                $('#final_result').html('You will earn {{ websiteInfo("general_currency") }}' + result + ' after '  + calc_result_duration + calc_result_duration_type + '(s)');
                            }
                        }
                        
                    })
                });

                
            });
        </script>
        
        

    </section>
@endforeach

