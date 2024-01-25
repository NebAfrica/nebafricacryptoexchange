@php
    //check if a user has bot activated
    function isActivated($bot_id)
    {
        $check = \Modules\CryptoTrading\Entities\TradingBotActivation::where('bot_id', $bot_id)->where('user_id', user('id'))->where('user_activated', 'yes')->first();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }
@endphp

<div class="bots-popup hidden">
    <div class="bots-inner">
        <div align="right">
            <span class="bg-danger p-1 rounded popup-close-btn">{{ ct('Close') }}</span>
        </div>
        @foreach ($bots as $bot)
            <div class="bot">
                <div class=""><img src="{{ asset('public/assets/imgs/' . $bot->icon) }}" alt="bot" width="35px" class="rounded rounded-circle"></div>
                <div class="">{{ $bot->name }}</div>
                <div class="">{{ formatAmount($bot->price) }}</div>
                <div class="px-3">
                    @if (isActivated($bot->id))
                        <span class="is_activated btn btn-success rounded" data-bot_id="{{ $bot->id }}" data-bot_name="{{ $bot->name }}">{{ ct('Select') }}</span>
                    @else
                        <span class="is_not_activated btn btn-primary rounded" data-bot_id="{{ $bot->id }}" >{{ ct('Activate') }}</span>
                    @endif
                </div>
              
            </div>  
        @endforeach
        
    </div>
    
</div>

<div class="form-popup hidden">
    <div class="bots-inner">        
        <form action="{{ route('user.trading.trade.bot-activate') }}" method="post">
            @csrf
            <input class="form-control" type="hidden" name="bot_id" id="bot_id" placeholder="bot_id"> 
            <div align="right">
                <span class="bg-danger p-1 rounded form-close-btn">{{ ct('Close') }}</span>
            </div>
            <div class="bot">
                <input class="form-control" required type="text" name="key" id="key" placeholder="Enter Activation Key">    
            </div> 
            
            <div class="bot">
                <button type="submit" class="form-control btn btn-primary rounded bg-primary" >{{ ct('Activate Now') }}</button>
            </div>
        </form>
    </div>
    
</div>

<style>
    .bots-popup, .form-popup {
        position: fixed;
        top:0;
        right: 0;
        z-index: 9999999999999;
        width: 50vh;
        background: #060818;
        padding: 15px;
        margin-top: 10px;
        margin-right: 10px;
    }

    .bots-inner {
        
    }

    .bot {
        display: flex;
        justify-content: space-between;
        background: #0e1726;
        margin-top: 5px;
        padding: 10px;
        border-radius: 5px;
    }

    .form-close-btn, .popup-close-btn  {
        cursor: pointer;
    }

    
</style>