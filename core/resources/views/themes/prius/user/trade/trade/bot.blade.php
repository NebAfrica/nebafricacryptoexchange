@php
    use Modules\CryptoTrading\Entities\TradingBot;
    function botName($bot_id) 
    {
        $bot = TradingBot::where('id', $bot_id)->first();
        return $bot->name;
    }
@endphp


<!DOCTYPE html>
<html lang="en">

<head class="crypt-dark">
    {{--  Site Metas --}}
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ $page_title }} | {{ websiteInfo('website_name') }}</title>
    <meta name="author" content="support@credcrypto.net">
    <meta name="author" content="support@credcrypto.net">
    <meta name="description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta name="keywords" content="{{ json_decode(websiteInfo('meta'))->keywords }}">
    {{--  Open Graph / Facebook --}}
    <meta property="og:type" content="Crypto Trading">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="og:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="og:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner ) }}">
    {{--  Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="twitter:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="twitter:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner ) }}">
    <meta name="robots" content="noindex">
    <meta name="robots" content="none">

    {{--  Favicon --}}
    <link rel="apple-touch-icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <link rel="icon" href="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->favicon) }}">
    <meta name="msapplication-TileColor" content="#060818">
    <meta name="theme-color" content="#060818">
    

    {{-- assets starts --}}
    <link rel="stylesheet" href="{{ asset('public/assets/trading/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/trading/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/trading/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/trading/css/ui.css') }}">
</head>

<body class="crypt-dark" id="body">
    <header>
        <div class="container-full-width">
            <div class="crypt-header">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5">
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="crypt-logo"><img
                                        src="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->logo_rec) }}"
                                        alt=""></div>
                            </div>
                            <div class="col-xs-2">
                                <div class="crypt-mega-dropdown-menu"> <a href=""
                                        class="crypt-mega-dropdown-toggle">{{ $symbol_1 . '/' . $symbol_2 }}</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 d-none d-md-block d-lg-block">
                        <ul class="crypt-heading-menu fright">
                            <li><a href="{{ route('user.dashboard') }}">{{ ct('Dashboard') }}</a></li>


                        </ul>
                    </div><i class="menu-toggle pe-7s-menu d-xs-block d-sm-block d-md-none d-sm-none"></i>
                </div>
            </div>
        </div>
        <div class="crypt-mobile-menu">
            <ul class="crypt-heading-menu">
                <li><a href="{{ route('user.dashboard') }}">{{ ct('Dashboard') }}</a></li>

            </ul>
            
        </div>
    </header>
    <div class="container-fluid">
        <div class="row sm-gutters">
            <div class="col-md-6 col-lg-6 col-xl-3 col-xxl-2">
                <div class="crypt-market-status mt-4">
                    <div>
                        <ul class="nav nav-tabs" id="crypt-tab">
                            <li role="presentation"><a href="#usdt" class="active" data-toggle="tab">USDT</a></li>
                            <li role="presentation"><a href="#btc" data-toggle="tab">btc</a></li>
                            <li role="presentation"><a href="#eth" data-toggle="tab">eth</a></li>
                            <li role="presentation"><a href="#trx" data-toggle="tab">trx</a></li>
                            <li role="presentation"><a href="#usdd" data-toggle="tab">usdd</a></li>
                        </ul>
                        <ul class="nav nav-tabs">
                            
                            <div>
                                <input type="text" name="" id="filter-input" class="form-control" placeholder="Search Pair">
                            </div>
                            
                        </ul>
                        <div class="tab-content crypt-tab-content" style="max-height: 900px;overflow-y: scroll" id="filter-div">
                            <div role="tabpanel" class="tab-pane active" id="usdt">
                                <table class="table table-striped" id="usdt-table"> 
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Coin') }}</th>
                                            <th scope="col">{{ ct('Price') }}</th>
                                            <th scope="col">{{ ct('Change') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crypt-table-hover">
                                        @foreach ($prices as $price)
                                            @if (str()->endsWith($price->symbol, 'USDT'))
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_USDT', '', $price->symbol)) . '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="crypt-star pr-1" alt="star"
                                                            src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_USDT', '', $price->symbol)) . '.svg') }}" width="15">                                                        
                                                            <a href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td> 
                                                        <td >
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>                                                        
                                                        </td>

                                                        <td class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span class="@if(str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                                                {{ $price->dailyChange }}%
                                                            </span>
                                                        </td>
                                                    </tr>                                                
                                                @endif                                                
                                            @endif                                       
                                            
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="btc">
                                <table class="table table-striped" id="btc-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Coin') }}</th>
                                            <th scope="col">{{ ct('Price') }}</th>
                                            <th scope="col">{{ ct('Change') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crypt-table-hover">
                                        @foreach ($prices as $price)
                                            @if (str()->endsWith($price->symbol, 'BTC'))
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_BTC', '', $price->symbol)) . '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="crypt-star pr-1" alt="star"
                                                        src="{{ asset( 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_BTC', '', $price->symbol)) . '.svg') }}" width="15">
                                                            <a href="{{ url('/user/trading/trade/bot/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td> 
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>                                                        
                                                        </td>

                                                        <td  class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span class="@if(str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                                                {{ $price->dailyChange }}%
                                                            </span>
                                                        </td>
                                                    </tr>                                                
                                                @endif                                                
                                            @endif                                       
                                            
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="eth">
                                <table class="table table-striped" id="eth-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Coin') }}</th>
                                            <th scope="col">{{ ct('Price') }}</th>
                                            <th scope="col">{{ ct('Change') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crypt-table-hover">
                                        @foreach ($prices as $price)
                                            @if (str()->endsWith($price->symbol, 'ETH'))
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_ETH', '', $price->symbol)) . '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="crypt-star pr-1" alt="star"
                                                            src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_ETH', '', $price->symbol)) . '.svg') }}" width="15">                                                       
                                                            <a href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td> 
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>                                                        
                                                        </td>

                                                        <td  class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span class="@if(str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                                                {{ $price->dailyChange }}%
                                                            </span>
                                                        </td>
                                                    </tr>                                                
                                                @endif                                                
                                            @endif                                      
                                            
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="trx">
                                <table class="table table-striped" id="trx-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Coin') }}</th>
                                            <th scope="col">{{ ct('Price') }}</th>
                                            <th scope="col">{{ ct('Change') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crypt-table-hover">
                                        @foreach ($prices as $price)
                                            @if (str()->endsWith($price->symbol, 'TRX'))
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_TRX', '', $price->symbol)) . '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            
                                                            <img class="crypt-star pr-1" alt="star"
                                                            src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_TRX', '', $price->symbol)) . '.svg') }}" width="15">
                                                            <a href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td> 
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>                                                        
                                                        </td>

                                                        <td  class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span class="@if(str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                                                {{ $price->dailyChange }}%
                                                            </span>
                                                        </td>
                                                    </tr>                                                   
                                                @endif                                               
                                            @endif                                   
                                            
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="usdd">
                                <table class="table table-striped" id="usdd-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Coin') }}</th>
                                            <th scope="col">{{ ct('Price') }}</th>
                                            <th scope="col">{{ ct('Change') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="crypt-table-hover">
                                        @foreach ($prices as $price)
                                            @if (str()->endsWith($price->symbol, 'USDD'))
                                                @if (file_exists(root_path() . 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_USDD', '', $price->symbol)) . '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="crypt-star pr-1" alt="star"
                                                            src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_USDD', '', $price->symbol)) . '.svg') }}" width="15">                                                        
                                                            <a href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td> 
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>                                                        
                                                        </td>

                                                        <td  class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span class="@if(str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                                                {{ $price->dailyChange }}%
                                                            </span>
                                                        </td>
                                                    </tr>                                                
                                                @endif
                                                
                                            @endif                                       
                                            
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-8">
                <div class="crypt-gross-market-cap mt-4">
                    <div class="row">
                        <div class="col-3 col-sm-6 col-md-6 col-lg-6">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <p>{{ ct('Last Price') }} {{ $symbol_2 }}</p>
                                    <p id="last-price">{{ $pair_info->close }}</p>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <p>{{ ct('Change') }} {{ $symbol_2 }}</p>
                                    <p class="@if (str()->contains($pair_info->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                        {{ $pair_info->dailyChange }}%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-2 col-md-3 col-lg-2">
                            <p>{{ ct('High') }} {{ $symbol_2 }}</p>
                            <p class="crypt-up">{{ $pair_info->high }}</p>
                        </div>
                        <div class="col-3 col-sm-2 col-md-3 col-lg-2">
                            <p>{{ ct('Low') }} {{ $symbol_2 }}</p>
                            <p class="crypt-down">{{ $pair_info->high }}</p>
                        </div>
                        <div class="col-3 col-sm-2 col-md-3 col-lg-2">
                            <p>{{ ct('Volume 24Hr') }}</p>
                            <p class="@if (str()->contains($pair_info->dailyChange, '-')) crypt-down @else crypt-up @endif">
                                {{ $pair_info->tradeCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="tradingview-widget-container mb-3">
                    <div id="crypt-candle-chart"></div>
                </div>
                <div  class="crypt-dark-segment">
                    <div class="">
                        <div class="crypt-boxed-area">
                            <h6 class="crypt-bg-head">
                                <b>{{ ct('BOT', 'u') }} </b><b class="crypt-up">{{ ct('BUY', 'u') }}</b> / <b class="crypt-down">{{ ct('SELL', 'u') }}</b>
                                
                            </h6>

                            <ul class="nav nav-tabs">
                                <li role="presentation"><a href="#market" class="active" data-toggle="tab">{{ ct('Market') }}</a>
                                </li>
                                
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="market">
                                    <div role="tabpanel" class="tab-pane active" id="market">
                                        {{-- bots --}}
                                        @include('themes.cryptic.user.trade.trade.bots')
                                        {{-- bots --}}
                                        <div class="row no-gutters">
                                            <div class="col-md-12">
                                                <div class="crypt-buy-sell-form">
                                                    <p>{{ ct('Available') }}: <span class="crypt-up"><span class="quote_bal"> @if($quote)  {{ number_format($quote->balance, 8) ?? 0 }} @else 0.00000000  @endif </span> {{ $symbol_2 }}</b></span></span> <span class="fright">{{ ct('Available') }}: <b
                                                                class="crypt-down"><span class="base_bal"> @if($quote)  {{ number_format($base->balance, 8) ?? 0 }} @else 0.00000000  @endif </span> {{ $symbol_1 }}</b></span></p>
                                                    <div class="crypt-buy">
                                                        @if (session()->has('success'))
                                                            <div class="alert alert-success alert-dismissible fade show text-white bg-success" role="alert">
                                                                <strong>{{ ct('Success') }}!</strong> {{ session()->get('success') }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @elseif(session()->has('fail'))
                                                            <div class="alert alert-danger alert-dismissible fade show text-white bg-danger" role="alert">
                                                                <strong>{{ ct('Error') }}!</strong> {{ session()->get('fail') }}
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif

                                                        
                                                        

                                                        @if ($bot_status)
                                                            <input type="hidden" name="selected_bot_id" id="selected_bot_id" value="{{ $running_bot->id }}">
                                                            <div class="bot">
                                                                <div class="">
                                                                    <img src="{{ asset('public/assets/imgs/' . $running_bot->icon) }}" alt="bot" width="35px" class="rounded rounded-circle">
                                                                
                                                                    {{ $running_bot->name }}
                                                                </div>
                                                                    
                                                                
                                                                <div class="px-3">
                                                                    <span class="btn btn-success rounded">{{ ct('RUNNING', 'u') }}</span>
                                                                </div>
                                                            
                                                            </div> 
                                                        @else
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend"> <span class="input-group-text">{{ ct('BOT') }}</span>
                                                                </div>
                                                                <input type="hidden" name="selected_bot_id" id="selected_bot_id" >
                                                                <input type="text" class="form-control" placeholder="choose bot" readonly id="selected_bot_name">
                                                                <div class="input-group-append"> <span class="input-group-text" id="bot-change-button">{{ ct('Change') }}</span>
                                                                </div>
                                                            </div> 
                                                        @endif
                                                        
                                                        
                                                        @if ($bot_status)
                                                            <div class="menu-green order-button" data-type="stop"><a href="" class="crypt-button-red-full">{{ ct('Stop Bot') }}</a>
                                                            </div>
                                                        @else
                                                            <div class="menu-green order-button" data-type="start"><a href="" class="crypt-button-green-full">{{ ct('Start Bot') }}</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-md-12">
                                            <div id="preloader">
                                                <div id="loading-bar-spinner" class="spinner"><div class="spinner-icon"></div></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>


                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 col-xxl-2">
                <div class="crypt-market-status mt-4">
                    <div >
                        <ul class="nav nav-tabs">
                            <li role="presentation"><a href="#history" class="active" data-toggle="tab">{{ ct('history') }}</a>
                            </li>
                            <li role="presentation"><a href="#market-trading" data-toggle="tab">{{ ct('market trading') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="history">
                                <table class="table table-striped" id="history-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Time') }}</th>
                                            <th scope="col">{{ ct('Price') }}</th>
                                            <th scope="col">{{ ct('Volume') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($candles as $candle)
                                            <tr>
                                                <td>{{ date('H:i:s', $candle[12]) }}</td>
                                                <td class="flash @if ($candle[3] > $candle[4]) crypt-down @else crypt-up @endif" data-flash="{{ rand(1, 20) }}">{{ $candle[4] }}</td>
                                                <td>{{ $candle[6] }}</td>
                                            </tr>                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="market-trading">
                                <table class="table table-striped" id="market-trading-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ ct('Time') }}</th>
                                            <th scope="col">{{ ct('Amount') }}</th>
                                            <th scope="col">{{ ct('Volume') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($market_trades as $trade)
                                            <tr>
                                                <td>{{ date('H:i:s', $trade->createTime) }}</td>
                                                <td class="flash @if ($trade->takerSide == "SELL") crypt-down @else crypt-up @endif" data-flash="{{ rand(1, 20) }}">{{ $trade->price }}</td>
                                                <td>{{ $trade->amount }}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row sm-gutters">
            
            <div class="col-xl-12">
                <div>
                    <div class="crypt-market-status">
                        <div>
                            <ul class="nav nav-tabs">
                                <li role="presentation"><a href="#active-orders" class="active"
                                        data-toggle="tab">{{ ct('Bot Trades') }}</a></li>
                                <li role="presentation"><a href="#closed-orders" data-toggle="tab">{{ ct('Bot History') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="active-orders">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ct('Bot') }}</th>
                                                <th scope="col">{{ ct('Pair') }} </th>
                                                <th scope="col">{{ ct('Next Exit') }} </th>
                                                <th scope="col">{{ ct('Status') }}</th>
                                                
                                            </tr>
                                        </thead>
                                        
                                        @if ($trades->count() > 0)
                                            <tbody>
                                                @foreach ($trades as $trade)
                                                    <tr>
                                                        <td>{{ botName($trade->bot_id) }}</td>
                                                        <td>{{ str_replace('_', '/', $trade->pair) }}</td>
                                                        <td>
                                                            {{ date('H:i:s', $trade->next_trade_time) }} <br> 
                                                            {{ date('d.m.Y', $trade->next_trade_time) }}
                                                        </td>
                                                        <td>{{ $trade->status }}</td>
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else
                                            <div class="no-orders text-center">
                                                <img src="{{ asset('public/assets/trading/images/empty.png') }}" alt="no-orders">
                                            </div> 
                                        @endif
                                    </table>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane" id="closed-orders">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ct('Time') }}</th>
                                                <th scope="col">{{ ct('Amount') }}</th>
                                                <th scope="col">{{ ct('Status') }}</th>
                                            </tr>
                                        </thead>
                                        
                                        @if ($bot_history->count() > 0)
                                            <tbody>
                                                @foreach ($bot_history as $history)
                                                    <tr>
                                                        <td>
                                                            {{ date('H:i:s', strtotime($history->created_at)) }} <br> 
                                                            {{ date('d.m.Y', strtotime($history->created_at)) }}
                                                        </td>
                                                        <td>
                                                            {{ formatAmount($history->amount) }}
                                                        </td>
                                                        <td @if ($history->type == 'credit') class="crypt-up" @else class="crypt-down" @endif>
                                                            @if ($history->type == 'credit')
                                                            <svg class="w-6 h-6" fill="none" width="15" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                            </svg>
                                                            win
                                                            @else 
                                                            <svg class="w-6 h-6" fill="none" width="15" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                            </svg>
                                                            lose
                                                            @endif
                                                            
                                                            
                                                        </td>

                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else
                                            <div class="no-orders text-center">
                                                <img src="{{ asset('public/assets/trading/images/empty.png') }}" alt="no-orders">
                                            </div> 
                                        @endif
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="balance">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ct('Currency') }}</th>
                                                <th scope="col">{{ ct('Amount') }}</th>
                                                <th scope="col">{{ ct('Volume') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wallets as $wallet)
                                                <tr>
                                                    <td>{{ $wallet->symbol }}</td> 
                                                    <td>{{ $wallet->balance }}</td> 
                                                    <td>0</td>     
                                                </tr>                                             
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <style>
            #preloader {
                background: rgb(14, 23, 38, 0.9);
                position: fixed;
                top: 0px;
                right: 0px;
                bottom: 0px;
                left: 0px;
                z-index: 9999999999999;
                display: flex;
                justify-content: center;
            }

            #loading-bar-spinner.spinner {
                left: 50%;
                margin-left: -20px;
                top: 50%;
                margin-top: -20px;
                position: absolute;
                z-index: 19 !important;
                -webkit-animation: loading-bar-spinner 400ms linear infinite;
                animation: loading-bar-spinner 400ms linear infinite;
            }

            #loading-bar-spinner.spinner .spinner-icon {
                width: 40px;
                height: 40px;
                border: solid 4px transparent;
                border-top-color: rgb(234, 88, 12) !important;
                border-left-color: rgb(234, 88, 12) !important;
                border-radius: 50%;
            }

            @-webkit-keyframes loading-bar-spinner {
                0% {
                    transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            @keyframes loading-bar-spinner {
                0% {
                    transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            #bot-change-button {
                cursor: pointer;
            }
        </style>
    </footer>

    <script src="/public/assets/trading/amc/core.js"></script>
    <script src="/public/assets/trading/amc/charts.js"></script>
    <script src="/public/assets/trading/amc/dark.js"></script>
    <script src="/public/assets/trading/amc/animated.js"></script>
    <script src="/public/assets/trading/js/jquery.js"></script>
    <script src="/public/assets/trading/js/popper.min.js"></script>
    <script src="/public/assets/trading/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/public/assets/trading/bootstrap/js/bootstrap.js"></script>
    <script src="/public/assets/trading/js/main.js"></script>
    <script src="/public/assets/trading/js/amc.js"></script>
    <script src="https://s3.tradingview.com/tv.js"></script>
    
    <script>       


        //flash starts
        $(document).ready(function(){           

            setInterval(function(){
                $('.flash').each(function(i, obj) {
                    
                    var interval = $(obj).data('flash');
                    var flashTime = "{{ rand(1, 20) }}";
                    var time = 1000;
                    if (interval > flashTime) {
                        setTimeout( function(){ 
                            $('.flash:eq('+ i +')').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                         }, time);
                        time += 1000;                       
                        
                    }                    
                });
                
                // get the href
                var reloadUrl = $(location).attr("href");
                $.get(reloadUrl).done(function(r) {
                    var newDom = $(r);
                    $('#history-table').replaceWith($('#history-table',newDom));
                    $('#market-trading-table').replaceWith($('#market-trading-table',newDom));
                    $('#last-price').replaceWith($('#last-price',newDom));
                    $('#usdt-table').replaceWith($('#usdt-table',newDom));
                    $('#btc-table').replaceWith($('#btc-table',newDom));
                    $('#eth-table').replaceWith($('#eth-table',newDom));
                    $('#trx-table').replaceWith($('#trx-table',newDom));
                    $('#usdd-table').replaceWith($('#usdd-table',newDom));
                });
            }, 5000);


            $('#preloader').hide();
            
        });

        $('#bot-change-button').on('click', function(){
            $('.bots-popup').toggleClass('hidden');
        });

        $('.is_not_activated').on('click', function(){
            var bot_id = $(this).data('bot_id');
            $('.bots-popup').toggleClass('hidden');
            $('.form-popup').toggleClass('hidden');
            $('#bot_id').val(bot_id);
        });


        //close  activation form
        $('.form-close-btn').on('click', function(){
            $('.bots-popup').toggleClass('hidden');
            $('.form-popup').toggleClass('hidden');
        });

         //close  popup form
         $('.popup-close-btn').on('click', function(){
            $('.bots-popup').toggleClass('hidden');
        });
        

        //select the bot
        $('.is_activated').on('click', function(){
            var bot_name  = $(this).data('bot_name');
            var bot_id = $(this).data('bot_id');
            $('#selected_bot_id').val(bot_id);
            $('#selected_bot_name').val(bot_name);
            $('.bots-popup').toggleClass('hidden');
        });

       

       

        //range input
        


        //filter starts here
        $(document).ready(function(){
            $("#filter-input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filter-div tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        //trading starts here
        $('.order-button').on('click', function(e){
            e.preventDefault();
            
            var  clicked = $(this);
            $(clicked).addClass('loading');
            var target  = $('.loading > a').eq(0);
            var html = target.html();            
            var bot_id = $('#selected_bot_id').val();
            var pairs = "{{ $symbol_1 . '_' . $symbol_2 }}";
            var type  = $(this).data('type');

            $(target).html('Wait...').fadeOut(300).fadeIn(200);
            $.ajax({
                url: "{{  route('user.trading.trade.bot-trade-validate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    bot_id:bot_id,
                    pairs:pairs,
                    type:type
                    
                },
                success: function(response) {
                    target.html('Successful');
                    alert('Success ' + type + ' bot');
                    window.location.reload();                        
                },
                error: function(response) {                    
                    // $('#preloader').hide(); 
                    alert('Failed to ' + type + ' bot');
                    $(target).html(html);  
                    console.log(response);                     

                },
            });
            
        });

        
    </script>


    <script>
        if (document.getElementById('crypt-candle-chart')) {
            new TradingView.widget({
                "autosize": true,
                "symbol": "POLONIEX:" + "{{ $symbol_1 . $symbol_2 }}",
                "interval": "1",
                "timezone": "Etc/UTC",
                "theme": "Dark",
                "style": "1",
                "locale": "en",
                "toolbar_bg": "rgba(0, 0, 0, 1)",
                "enable_publishing": false,
                "allow_symbol_change": true,
                "container_id": "crypt-candle-chart"
            });
        }
    </script>




    <style>
        input[type=checkbox] {
            accent-color: #49c279;
        }

        input[type=range] {
            accent-color: #f7614e;
        }

        progress {
            accent-color: black;
        }

        .hidden {
            display: none;
        }

        .error-border {
            border-color: red !important;
        }
    </style>
    
</body>

</html>
