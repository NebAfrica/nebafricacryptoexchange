@extends('admin.layout.app')




@section('content')

    <div class="w-full py-5" id="content">
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                <div class="parent-row">
                    <div class="trade-section">


                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4" id="content-right">
                            <div
                                class="w-full space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    Select Users
                                </h2>
                                <hr class="w-full border-b border-dotted border-gray-600 border my-5">

                                <div class="mt-5"></div>
                                @if ($users)
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div>
                                            NAME
                                        </div>
                                        <div>
                                            ACCOUNT ID
                                        </div>
                                        <div>
                                            FIAT BAL
                                        </div>
                                        <div>

                                        </div>
                                        <div class="inline-flex space-x-3 md:space-x-5">
                                            ACTION
                                        </div>
                                    </div>
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full">
                                            <input type="text" name="" class="w-full bg-gray-100 rounded  p-2" id="filter-input" placeholder="Search Users">
                                        </div>
                                    </div>

                                    <div id="filter-users" class="text-xs">
                                        @foreach ($users as $user)
                                            <div class="w-full users flex justify-evenly space-x-3 items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                                <div >
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </div>
                                                
                                                <div>

                                                </div>
                                                <div class="inline-flex space-x-3 md:space-x-5">
                                                    <input type="checkbox" class="select_users_button"  id="" data-user_id="{{ $user->id }}" data-name="{{ $user->first_name . ' ' . $user->last_name }}" data-target="{{ 'user_'. $user->id }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="">
                                        <b class="font-medium text-orange-500">Empty! </b>
                                        You don't have any wallets
                                    </p>
                                @endif
                            </div>


                        </div>
                    </div>
                    <div class="wallet-section" id="content-left">
                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            
                            <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    Selected Users
                                </h2>
                                <div id="market-orders" class="orders">
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full">
                                            <p id="selected_users_id"></p>
                                            <p id="selected_users">                                                
                                                
                                            </p>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        <div class="w-full  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                            
                            <div class="w-full rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                                    Generate Signal
                                </h2>
                                <hr class="w-full border-b border-dotted border-gray-600 border my-5">
                                <div id="market-orders" class="orders">
                                    <div
                                        class="w-full flex justify-between items-center  mt-2  rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4">
                                        <div class="w-full">
                                            <form class="mt-2 p-2 md:p-4" id="signal_form">
                                                @csrf
                                                <div class="w-full">
                                                    <div class="grid grid-cols-1 md-grid-cols-2 g-3">
                                                        <div class="full pt-2">
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full">
                                                                    <label class="font-medium" for="amount">Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>                                        
                                                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="amount" id="amount" value="{{ old('amount') }}" required>
                                                                    <h6 class="text-xs text-blue-400">
                                                                        amount the user is required to trade with
                                                                    </h6>
                                                                </div>
                                                                
                                                            </div>
                                        
                                                        </div>
                            
                                                        <div class="w-full pt-2">
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full">
                                                                    <label class="font-medium" for="leverage">Leverage (%) :</label>                                        
                                                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_amount" id="max_amount" value="{{ old('max_amount') }}" required>
                                                                    <h6 class="text-xs text-blue-400">
                                                                        the leverage the user should set
                                                                    </h6>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>

                                                <div class="w-full">
                                                    <div class="flex space-x-5">
                                                        <div class="w-full pt-2">
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full">
                                                                    <label class="font-medium" for="tp">Take Profit :</label>                                        
                                                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="tp" id="tp"  required>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                        
                                                        </div>
                            
                                                        
                                                    </div>    
                                                </div>

                                                <div class="w-full">
                                                    <div class="flex space-x-5">
                                                        <div class="w-full pt-2">
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full">
                                                                    <label class="font-medium" for="sl">Stop Loss:</label>                                        
                                                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="sl" id="sl"  required>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                        
                                                        </div>
                            
                                                        
                                                    </div>    
                                                </div>

                                                <div class="w-full">
                                                    <div class="flex space-x-5">
                                                        <div class="w-full pt-2">
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full">
                                                                    <label class="font-medium" for="type">Type:</label>                                        
                                                                    <select class="flex-grow px-2 md:px-4 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="type" id="type" required>
                                                                        <option value="crypto" @if (old('type')=='buy' ) selected @endif>Buy</option>
                                                                        <option value="bank" @if (old('type')=='sell' ) selected @endif>Sell</option>
                                                                        
                                                                    </select>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                        
                                                        </div>
                            
                                                        
                                                    </div>    
                                                </div>
                                                <div class="w-full">
                                                    <div class="flex space-x-5">
                                                        <div class="w-full pt-2">
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full">
                                                                    <label class="font-medium" for="time">Timing:</label>                                        
                                                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="datetime-local" name="time" id="time"  required>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                        
                                                        </div>
                            
                                                        
                                                    </div>    
                                                </div>

                                                <div class="w-full">
                                                    <div class="flex space-x-5">
                                                        <div class="w-full pt-2">
                                                            
                                                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                                                <div class="w-full mb-2">
                                                                    <label class="font-medium" for="">Trading Pair:</label>
                                                                    <span id="selected_trading_pairs"></span>
                                                                </div>
                                                                
                                                                <div id="trading-pairs">
                                                                    <input id="trading-pairs-search" type="search" placeholder="Search Pair" class="mb-2 h-10 w-full px-4 rounded-md overflow-x-hidden border-0 bg-gray-800 outline-gray-800 ring-gray-800">
                                                                    @foreach ($pairs as $pair)
                                                                        <div class="w-full">
                                                                            <input  type="checkbox" class="pairs_checkbox" data-pair="{{ $pair }}">
                                                                            <span>{{ str_replace('_', '/', $pair) }}</span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>

                                                
                                                
                                                
                                                <div class="w-full my-5 px-5">
                                                    <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                                        Generate
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        


                    </div>


                </div>





            </div>
        </div>
    </div>


    

    <style>
        .parent-row {
            display: flex;
            justify-content: space-between;
        }

        .trade-section {
            position: relative;
            width: 40%;

        }

        .wallet-section {
            position: relative;
            width: 60%;

        }

        @media only screen and (max-width: 600px) {
            .parent-row {
                display: block;

            }

            .trade-section,
            .wallet-section {
                width: 100%;
                display: block;
                margin-top: 10px;
            }
        }

        .wallet-section .wallet-heading {
            cursor: pointer;
        }

        .wallet-section .current {
            border-bottom: solid 5px #d3d6df;
        }

        #filter-users {
            max-height: 400px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        #trading-pairs {
            max-height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        
    </style>
@endsection

@section('script')
<script>
    //filter starts here
    $(document).ready(function(){
        $("#filter-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();            
            $("#filter-users .users").filter(function() {                
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        //filter 
        $("#trading-pairs-search").on("keyup", function() {
            var value = $(this).val().toLowerCase();            
            $("#trading-pairs div").filter(function() {                
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        //trading pairs
        $('.pairs_checkbox').on('click', function(){
            var pair = $(this).data('pair');
            var target = '#selected_trading_pairs';
            if ($(this).is(":checked")) {                
                $(target).append(pair + ', ');
            } else {                
                var selected_trading_pairs = $(target).html();
                selected_trading_pairs = selected_trading_pairs.replace(pair + ', ', '');
                $(target).html(selected_trading_pairs);
            }
            
        });

        //users
        $('.select_users_button').on('click', function(){
            var user_id = $(this).data('user_id');
            var target = $(this).data('target');
            var name = $(this).data('name');
            var to_append = "<span id='" + target + "'>" + name + ",</span> ";
            var to_remove =  "#selected_users #" + target;

            if ($(this).is(":checked")) {
                $('#selected_users').append(to_append);
                $('#selected_users_id').append(user_id + ',').hide();
            } else {
                $(to_remove).remove();
                var selected_users_id = $('#selected_users_id').html();
                selected_users_id = selected_users_id.replace(user_id + ',', '');
                $('#selected_users_id').html(selected_users_id).hide();
            }
            
        });

        $('#signal_form').on('submit', function(e){
            e.preventDefault();
            var users = $('#selected_users_id').html();
            var pairs = $('#selected_trading_pairs').html();
            var min_amount = $('#min_amount').val();
            var max_amount = $('#max_amount').val();
            var signal_count = $('#signal_count').val();
            var error = '';
            var error_message = ''; 
            //check if users are actually selected
            if (users.length < 1) {
                error = true;
                error_message = 'Please select users(s)';
            } else if (pairs.length < 5 ) {
                error = true;
                error_message = 'Please select trading pairs';
            } else if ( parseInt(min_amount) > parseInt(max_amount)) {
                error = true;
                error_message = 'Maximum amount must be greater than minimum amount';
            } else {
                error = false;
            }

            if (error == true) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: error_message,
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });
            } else {
                $('#preloader').show();
                $.ajax({
                    url: "{{  route('admin.trading.signals.create-validate') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        users: users,
                        pairs: pairs,
                        min_amount: min_amount,
                        max_amount: max_amount,
                        signal_count:signal_count
                    },
                    success: function(response) {
                                                
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            text: 'Signals generated',
                            showConfirmButton: false,
                            timer: 4500,
                            background: "#0e1726",
                            color: "#b9bead",
                            toast: true,
                            
                        });

                        window.location.href = "{{ route('admin.trading.signals.index') }}"; 

                    },
                    error: function(response) {                    
                        $('#preloader').hide(); 
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            text: 'An Error Occured Reload this page and try again',
                            showConfirmButton: false,
                            timer: 4500,
                            background: "#0e1726",
                            color: "#b9bead",
                            toast: true,
                            
                        });

                    },
                });
            }
        })
    });


</script>
@endsection
