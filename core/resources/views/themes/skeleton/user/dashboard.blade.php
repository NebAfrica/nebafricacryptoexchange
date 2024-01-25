@if (websiteInfo('trader_mode') == 'enabled' && isAddonEnabled('cryptotrading'))
    @include('cryptotrading::themes.cryptic.trade.index')    
@else
    @include('themes.skeleton.user.dashboard-content')
@endif