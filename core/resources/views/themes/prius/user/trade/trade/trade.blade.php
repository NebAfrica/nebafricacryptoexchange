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
    <meta property="og:image" content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
    {{--  Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta property="twitter:title" content="{{ $page_title }} | {{ websiteInfo('website_name') }}">
    <meta property="twitter:description" content="{{ json_decode(websiteInfo('meta'))->description }}">
    <meta property="twitter:image"
        content="{{ asset('public/assets/imgs/' . json_decode(websiteInfo('meta'))->banner) }}">
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
                                <input type="text" name="" id="filter-input" class="form-control"
                                    placeholder="{{ ct('Search Pair') }}">
                            </div>

                        </ul>
                        <div class="tab-content crypt-tab-content" style="max-height: 900px;overflow-y: scroll"
                            id="filter-div">
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
                                                @if (file_exists(root_path() .
                                                        'public/assets/imgs/crypto-svg-icons/' .
                                                        strtolower(str_replace('_USDT', '', $price->symbol)) .
                                                        '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="crypt-star pr-1" alt="star"
                                                                src="{{ '/public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_USDT', '', $price->symbol)) . '.svg' }}"
                                                                width="15">
                                                            <a
                                                                href="{{ '/user/trading/trade/' . str_replace('_', '/', $price->symbol) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td>
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>
                                                        </td>

                                                        <td class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span
                                                                class="@if (str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
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
                                                                src="{{ asset( 'public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_BTC', '', $price->symbol)) . '.svg')}}"
                                                                width="15">
                                                            <a
                                                                href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td>
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>
                                                        </td>

                                                        <td class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span
                                                                class="@if (str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
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
                                                                src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_ETH', '', $price->symbol)) . '.svg') }}"
                                                                width="15">
                                                            <a
                                                                href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td>
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>
                                                        </td>

                                                        <td class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span
                                                                class="@if (str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
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
                                                                src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_TRX', '', $price->symbol)) . '.svg') }}"
                                                                width="15">
                                                            <a
                                                                href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td>
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>
                                                        </td>

                                                        <td class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span
                                                                class="@if (str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
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
                                                @if (file_exists(root_path() .
                                                        'public/assets/imgs/crypto-svg-icons/' .
                                                        strtolower(str_replace('_USDD', '', $price->symbol)) .
                                                        '.svg'))
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="crypt-star pr-1" alt="star"
                                                                src="{{ asset('public/assets/imgs/crypto-svg-icons/' . strtolower(str_replace('_USDD', '', $price->symbol)) . '.svg') }}"
                                                                width="15">
                                                            <a
                                                                href="{{ url('/user/trading/trade/' . str_replace('_', '/', $price->symbol)) }}">{{ str()->replace('_', '/', $price->symbol) }}</a>
                                                        </td>
                                                        <td>
                                                            <span class="d-block">
                                                                {{ $price->price }}
                                                            </span>
                                                        </td>

                                                        <td class="flash" data-flash="{{ rand(1, 20) }}">
                                                            <span
                                                                class="@if (str()->contains($price->dailyChange, '-')) crypt-down @else crypt-up @endif">
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
                <div class="crypt-dark-segment">
                    <div class="">
                        <div class="crypt-boxed-area">
                            <h6 class="crypt-bg-head">
                                <b class="crypt-up">{{ ct('BUY', 'u') }}</b> / <b class="crypt-down">{{ ct('SELL', 'u') }}</b>

                            </h6>

                            <ul class="nav nav-tabs">
                                <li role="presentation"><a href="#limit" data-toggle="tab" class="active">{{ ct('Limit') }}</a>
                                </li>
                                <li role="presentation"><a href="#market"
                                        data-toggle="tab">{{ ct('Market') }}</a>
                                </li>
                                

                                {{-- <li role="presentation"><a href="#stop-limit" data-toggle="tab">{{ ct('Stop Limit') }}</a>
                                </li> --}}
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane" id="market">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <div class="crypt-buy-sell-form">
                                                <p>{{ ct('Buy') }} <span class="crypt-up"
                                                        id="base_coin">{{ $symbol_1 }}</span> <span
                                                        class="fright">Available: <b class="crypt-up"><span
                                                                class="quote_bal">
                                                                @if ($quote)
                                                                    {{ number_format($quote->balance, 8) ?? 0 }}
                                                                @else
                                                                    0.00000000
                                                                @endif
                                                            </span> {{ $symbol_2 }}</b></span></p>

                                                <div class="crypt-buy">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Price') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $pair_info->close }}" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text"
                                                                id="quote_coin">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Amount') }}</span>
                                                        </div>
                                                        <input type="number" step="any"
                                                            class="form-control amount-field"
                                                            data-total="market-buy-total" data-type="buy">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_1 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text"
                                                                >
                                                                <span>Leverage: &nbsp;</span>
                                                                <span id="market-buy-range">25%</span>
                                                            </span>
                                                        </div>
                                                        <div class="input-group-prepend">
                                                            <input type="range" min="1" max="100"
                                                                value="25" class="range-input"
                                                                data-target="market-buy-range">
                                                        </div>

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><input type="checkbox"
                                                                class="toggle-tp" checked
                                                                data-toggle="market-buy-tp">{{ ct('TP/SL', 'u') }}</span>

                                                    </div>

                                                    <div id="market-buy-tp" class="">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend"> <span
                                                                    class="input-group-text">{{ ct('Take Profit') }}</span>
                                                            </div>
                                                            <input type="number" step="any"
                                                                class="form-control tp">
                                                        </div>


                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend"> <span
                                                                    class="input-group-text">{{ ct('Stop Loss') }}</span>
                                                            </div>
                                                            <input type="number" step="any"
                                                                class="form-control sl">

                                                        </div>
                                                    </div>



                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Total') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control" readonly
                                                            id="market-buy-total">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="menu-green order-button" data-order="market"
                                                        data-type="buy"><a href=""
                                                            class="crypt-button-green-full">{{ ct('Buy/Long') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="crypt-buy-sell-form">
                                                <p>{{ ct('Sell') }} <span class="crypt-down">{{ $symbol_1 }}</span> <span
                                                        class="fright">{{ ct('Available') }}: <b class="crypt-down"><span
                                                                class="base_bal" id="base_bal">
                                                                @if ($base)
                                                                    {{ number_format($base->balance, 8) ?? 0 }}
                                                                @else
                                                                    0.00000000
                                                                @endif
                                                            </span> {{ $symbol_1 }}</b></span></p>
                                                <div class="crypt-sell">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Price') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $pair_info->close }}" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Amount') }}</span>
                                                        </div>
                                                        <input type="number" step="any"
                                                            class="form-control amount-field"
                                                            data-total="market-sell-total" data-type="sell">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_1 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"><span
                                                                class="input-group-text"
                                                                >
                                                                <span>Leverage: &nbsp;</span>
                                                                <span id="market-sell-range">25%</span>
                                                            </span>
                                                        </div>
                                                        <div class="input-group-prepend">
                                                            <input type="range" min="1" max="100"
                                                                value="25" class="range-input"
                                                                data-target="market-sell-range">
                                                        </div>

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><input type="checkbox"
                                                                class="toggle-tp"
                                                                data-toggle="market-sell-tp" checked>{{ ct('TP/SL', 'u') }}</span>

                                                    </div>

                                                    <div id="market-sell-tp" class="">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend"> <span
                                                                    class="input-group-text">{{ ct('Take Profit') }}</span>
                                                            </div>
                                                            <input type="number" step="any"
                                                                class="form-control tp">

                                                        </div>


                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend"> <span
                                                                    class="input-group-text">{{ ct('Stop Loss') }}</span>
                                                            </div>
                                                            <input type="number" step="any"
                                                                class="form-control sl">

                                                        </div>
                                                    </div>



                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Total') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control" readonly
                                                            id="market-sell-total">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="order-button" data-order="market" data-type="sell"><a
                                                            href="" class="crypt-button-red-full">{{ ct('Sell/Short') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane active" id="limit">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <div class="crypt-buy-sell-form">
                                                <p>{{ ct('Buy') }} <span class="crypt-up">{{ $symbol_1 }}</span> <span
                                                        class="fright">Available: <b class="crypt-up"> <span
                                                                class="quote_bal" id="quote_bal">
                                                                @if ($quote)
                                                                    {{ number_format($quote->balance, 8) ?? 0 }}
                                                                @else
                                                                    0.00000000
                                                                @endif
                                                            </span> {{ $symbol_2 }}</b></span></p>

                                                <div class="crypt-buy">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Price') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $pair_info->close }}" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Amount') }}</span>
                                                        </div>
                                                        <input type="number" step="any"
                                                            class="form-control amount-field"
                                                            data-total="limit-buy-total"
                                                            data-total_pay="limit-buy-total-pay" data-type="buy">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_1 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3 hidden">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text" id="limit-buy-range">0</span>
                                                        </div>
                                                        <div class="input-group-prepend">
                                                            <input type="range" min="0" max="100"
                                                                value="0" class="range-input"
                                                                data-target="limit-buy-range">
                                                        </div>

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Total') }}</span>
                                                        </div>
                                                        <input type="text" id="limit-buy-total"
                                                            class="form-control" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="order-button" data-order="limit" data-type="buy"><a href=""
                                                            class="crypt-button-green-full">{{ ct('Buy') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="crypt-buy-sell-form">
                                                <p>{{ ct('Sell') }} <span class="crypt-down">{{ $symbol_1 }}</span> <span
                                                        class="fright">{{ ct('Available') }}: <b class="crypt-down"> <span
                                                                class="base_bal">
                                                                @if ($base)
                                                                    {{ number_format($base->balance ?? 0, 8) }}
                                                                @else
                                                                    0.00000000
                                                                @endif
                                                            </span> {{ $symbol_1 }}</b></span></p>
                                                <div class="crypt-sell">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Price') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $pair_info->close }}" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Amount') }}</span>
                                                        </div>
                                                        <input type="number" step="any"
                                                            class="form-control amount-field"
                                                            data-total="limit-sell-total"
                                                            data-total_pay="limit-sell-total-pay" data-type="sell">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_1 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3 hidden">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text"
                                                                id="limit-sell-range">0</span>
                                                        </div>
                                                        <div class="input-group-prepend">
                                                            <input type="range" min="0" max="100"
                                                                value="0" class="range-input"
                                                                data-target="limit-sell-range">
                                                        </div>

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Total') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            id="limit-sell-total" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="order-button" data-order="limit" data-type="sell"><a
                                                            href="" class="crypt-button-red-full">{{ ct('Sell') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="stop-limit">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <div class="crypt-buy-sell-form">
                                                <p>{{ ct('Buy') }} <span class="crypt-up">{{ $symbol_1 }}</span> <span
                                                        class="fright">{{ ct('Available') }}: <b class="crypt-up"> <span
                                                                class="quote_bal">
                                                                @if ($quote)
                                                                    {{ number_format($quote->balance, 8) ?? 0 }}
                                                                @else
                                                                    0.00000000
                                                                @endif
                                                            </span> {{ $symbol_2 }}</b></span></p>

                                                <div class="crypt-buy">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Price') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $pair_info->close }}" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Amount') }}</span>
                                                        </div>
                                                        <input type="number" step="any"
                                                            class="form-control amount-field"
                                                            data-total="stop-limit-buy-total"
                                                            data-total_pay="stop-limit-buy-total-pay" data-type="buy">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_1 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text"
                                                                id="stop-limit-buy-range">0</span>
                                                        </div>
                                                        <div class="input-group-prepend">
                                                            <input type="range" min="0" max="100"
                                                                value="0" class="range-input"
                                                                data-target="stop-limit-buy-range">
                                                        </div>

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Total') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control" readonly
                                                            id="stop-limit-buy-total">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="menu-green order-button" data-order="stop-limit"
                                                        data-type="buy"><a href=""
                                                            class="crypt-button-green-full">{{ ct('Buy') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="crypt-buy-sell-form">
                                                <p>{{ ct('Sell') }} <span class="crypt-down">{{ $symbol_1 }}</span> <span
                                                        class="fright">{{ ct('Available') }}: <b class="crypt-down"><span
                                                                class="base_bal">
                                                                @if ($base)
                                                                    {{ number_format($base->balance, 8) ?? 0 }}
                                                                @else
                                                                    0.00000000
                                                                @endif
                                                            </span> {{ $symbol_1 }}</b></span></p>
                                                <div class="crypt-sell">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Price') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ $pair_info->close }}" readonly>
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Amount') }}</span>
                                                        </div>
                                                        <input type="number" class="form-control amount-field"
                                                            step="any" data-total="stop-limit-sell-total"
                                                            data-total_pay="stop-limit-sell-total-pay"
                                                            data-type="sell">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_1 }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text"
                                                                id="stop-limit-sell-range">0</span>
                                                        </div>
                                                        <div class="input-group-prepend">
                                                            <input type="range" min="0" max="100"
                                                                value="0" class="range-input"
                                                                data-target="stop-limit-sell-range">
                                                        </div>

                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend"> <span
                                                                class="input-group-text">{{ ct('Total') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control" readonly
                                                            id="stop-limit-sell-total">
                                                        <div class="input-group-append"> <span
                                                                class="input-group-text">{{ $symbol_2 }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="order-button" data-order="stop-limit"
                                                        data-type="sell"><a href=""
                                                            class="crypt-button-red-full">{{ ct('Sell') }}</a></div>
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
            <div class="col-md-6 col-lg-6 col-xl-3 col-xxl-2">
                <div class="crypt-market-status mt-4">
                    <div>
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
                                                <td class="flash @if ($candle[3] > $candle[4]) crypt-down @else crypt-up @endif"
                                                    data-flash="{{ rand(1, 20) }}">{{ $candle[4] }}</td>
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
                                                <td class="flash @if ($trade->takerSide == 'SELL') crypt-down @else crypt-up @endif"
                                                    data-flash="{{ rand(1, 20) }}">{{ $trade->price }}</td>
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
                                        data-toggle="tab">{{ ct('Active Orders') }}</a></li>
                                <li role="presentation"><a href="#closed-orders" data-toggle="tab">{{ ct('Closed Orders') }}</a>
                                </li>
                                <li role="presentation"><a href="#balance" data-toggle="tab">{{ ct('Balance') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="active-orders">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ct('Time') }}</th>
                                                <th scope="col">{{ ct('Buy/sell') }}</th>
                                                <th scope="col">{{ ct('Price') }} {{ $symbol_2 }}</th>
                                                <th scope="col">{{ ct('Take Profit') }}</th>
                                                <th scope="col">{{ ct('Stop Loss') }}</th>
                                                <th scope="col">{{ ct('Leverage') }}</th>
                                                <th scope="col">{{ ct('Action') }}</th>
                                            </tr>
                                        </thead>

                                        @if ($trades->where('status', 'active')->count() > 0)
                                            <tbody>
                                                @foreach ($trades->where('status', 'active') as $trade)
                                                    <tr>
                                                        <td>
                                                            {{ date('H:i:s', $trade->trade_start) }} <br>
                                                            {{ date('d.m.Y', $trade->trade_start) }}
                                                        </td>
                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            @if ($trade->order_type == 'buy')
                                                                <svg class="w-6 h-6" fill="none" width="15"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                                </svg>
                                                            @else
                                                                <svg class="w-6 h-6" fill="none" width="15"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                                </svg>
                                                            @endif

                                                            {{ ct($trade->order_type) }}
                                                        </td>

                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            {{ $trade->price }}</td>

                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            {{ $trade->tp }}</td>
                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            {{ $trade->sl }}</td>
                                                        <td>{{ $trade->leverage }}</td>
                                                        <td><a href=""
                                                                data-id="{{ Crypt::encryptString($trade->id) }}"
                                                                class="btn btn-primary rounded p-1 stop-trade">stop</a>
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
                                <div role="tabpanel" class="tab-pane" id="closed-orders">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ct('Time') }}</th>
                                                <th scope="col">{{ ct('Buy/sell') }}</th>
                                                <th scope="col">{{ ct('Price') }} {{ $symbol_2 }}</th>
                                                <th scope="col">{{ ct('Take Profit') }}</th>
                                                <th scope="col">{{ ct('Stop Loss') }}</th>
                                                <th scope="col">{{ ct('Leverage') }}</th>
                                                <th scope="col">{{ ct('Status') }}</th>
                                            </tr>
                                        </thead>

                                        @if ($trades->where('status', '!=', 'active')->count() > 0)
                                            <tbody>
                                                @foreach ($trades->where('status', '!=', 'active') as $trade)
                                                    <tr>
                                                        <td>
                                                            {{ date('H:i:s', $trade->trade_start) }} <br>
                                                            {{ date('d.m.Y', $trade->trade_start) }}
                                                        </td>
                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            @if ($trade->order_type == 'buy')
                                                                <svg class="w-6 h-6" fill="none" width="15"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                                                </svg>
                                                            @else
                                                                <svg class="w-6 h-6" fill="none" width="15"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                                                </svg>
                                                            @endif

                                                            {{ ct($trade->order_type) }}
                                                        </td>

                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            {{ $trade->price }}</td>

                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            {{ $trade->tp }}</td>
                                                        <td
                                                            @if ($trade->order_type == 'buy') class="crypt-up" @else class="crypt-down" @endif>
                                                            {{ $trade->sl }}</td>
                                                        <td>{{ $trade->leverage }}</td>
                                                        <td><a role="button"
                                                                class="btn @if ($trade->status == 'win') btn-success @else btn-danger @endif  rounded p-1">{{ $trade->status }}</a>
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

    </footer>

    <script src="{{ asset('public/assets/trading/amc/core.js') }}"></script>
    <script src="{{ asset('public/assets/trading/amc/charts.js') }}"></script>
    <script src="{{ asset('public/assets/trading/amc/dark.js') }}"></script>
    <script src="{{ asset('public/assets/trading/amc/animated.js') }}"></script>
    <script src="{{ asset('public/assets/trading/js/jquery.js') }}"></script>
    <script src="{{ asset('public/assets/trading/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/trading/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/trading/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/trading/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/trading/js/amc.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://s3.tradingview.com/tv.js"></script>

    <script>
        //flash starts
        $(document).ready(function() {

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

        });

        $(".amount-field").on('input', function() {
            var target_total = '#' + $(this).data('total');
            var target_total_pay = '#' + $(this).data('total_pay');
            var price = "{{ $pair_info->close }}";
            var quote_bal = $('#quote_bal').html();
            var base_bal = $('#base_bal').html();
            var amount = $(this).val();
            var total = amount * price;
            var order_type = $(this).data('type');
            $(target_total).val(total);

            if (order_type == 'buy') {

                if (+quote_bal < total) {
                    $('.order-button').hide();
                    $(this).addClass('error-border');
                    $('.quote_bal').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                } else {
                    $('.order-button').show();
                    $(this).removeClass('error-border');
                }

            } else {
                if (+base_bal < +amount) {
                    $('.order-button').hide();
                    $(this).addClass('error-border');
                    $('.base_bal').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                } else {
                    $('.order-button').show();
                    $(this).removeClass('error-border');
                }
            }
        });

        //toggle  tp
        $('.toggle-tp').on('click', function() {
            var target_toggle = '#' + $(this).data('toggle');
            $(target_toggle).toggleClass('hidden');
        });

        //range input
        $('.range-input').on('input', function() {
            var target_range = '#' + $(this).data('target');
            var value = $(this).val() + '%';
            $(target_range).html(value);
        });



        //filter starts here
        $(document).ready(function() {
            $("#filter-input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#filter-div tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        //trading starts here
        $('.order-button').on('click', function(e) {
            e.preventDefault();

            var clicked = $(this);
            $(clicked).addClass('loading');
            var target = $('.loading > a').eq(0);
            var html = target.html();
            var order = $(this).data('order');
            var order_type = $(this).data('type');
            var amount = '';
            var base = $('#base_coin').html();
            var quote = $('#quote_coin').html();
            var tp = '';
            var sl = '';
            var leverage = '';
            var amount_target = '';
            var error = false;


            if (order == 'market' && order_type == 'buy') {
                amount = $('.amount-field').eq(0).val();
                amount_target = 0;
                tp = $('.tp').eq(0).val();
                sl = $('.sl').eq(0).val();
                leverage = $('#market-buy-range').html();
            } else if (order == 'market' && order_type == 'sell') {
                amount = $('.amount-field').eq(1).val();
                amount_target = 1;
                tp = $('.tp').eq(1).val();
                sl = $('.sl').eq(1).val();
                leverage = $('#market-sell-range').html();
            } else if (order == 'limit' && order_type == 'buy') {
                amount = $('.amount-field').eq(2).val();
                amount_target = 2;
                leverage = $('#limit-buy-range').html();
            } else if (order == 'limit' && order_type == 'sell') {
                amount = $('.amount-field').eq(3).val();
                amount_target = 3;
                leverage = $('#limit-sell-range').html();
            } else if (order == 'stop-limit' && order_type == 'buy') {
                amount = $('.amount-field').eq(4).val();
                amount_target = 4;
                leverage = $('#stop-limit-buy-range').html();
            } else if (order == 'stop-limit' && order_type == 'sell') {
                amount = $('.amount-field').eq(0).val(5);
                amount_target = 5;
                leverage = $('#stop-limit-sell-range').html();
            }

            if (+amount < 0.000000001) {
                error = true;
                $('.amount-field').eq(amount_target).addClass('error-border');

            } else {
                //submit
                // $('#preloader').show();
                $(target).html('Wait...').fadeOut(300).fadeIn(200);
                $.ajax({
                    url: "{{ route('user.trading.trade.trade-validate') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        order: order,
                        order_type: order_type,
                        amount: amount,
                        base: base,
                        quote: quote,
                        tp: tp,
                        sl: sl,
                        leverage: leverage

                    },
                    success: function(response) {
                        target.html('Successful');
                        Swal.fire({
                            title: '',
                            text: "Trade Place",
                            icon: 'success',
                            background: "#0e1726",
                            color: "#d1d5db",

                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });

                    },
                    error: function(response) {
                        // $('#preloader').hide(); 
                        Swal.fire({
                            title: '',
                            text: "Failed to place trade",
                            icon: 'error',
                            background: "#0e1726",
                            color: "#d1d5db",

                        });
                        $(target).html(html);


                    },
                });
            }

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

    <script>
        $('.stop-trade').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('user.trading.trade.end-trade') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,


                },
                success: function(response) {

                    Swal.fire({
                        title: '',
                        text: "Trade Stopped",
                        icon: 'success',
                        background: "#0e1726",
                        color: "#d1d5db",

                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });

                },
                error: function(response) {
                    // $('#preloader').hide(); 
                    Swal.fire({
                        title: '',
                        text: "Failed to stop trade",
                        icon: 'error',
                        background: "#0e1726",
                        color: "#d1d5db",

                    });


                },
            });

        })
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
