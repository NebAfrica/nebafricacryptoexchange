{{-- Coinbase Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm mb-2">
    <div class="w-full">
        <label class="font-medium" for="">Coinbase Webhook Url:</label>
        <div class="flex space-x-5 items-baseline">
            <input
                class="to-copy w-5/6 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                type="text" value="{{ route('gateway.coinbase-webhook') }}">
            <button class="w-1/6 p-3 bg-blue-500 hover:bg-blue-600 text-xs lg:text-sm rounded-md" type="button"
                onclick="copyToClipboard(this)">copy</button>
        </div>
    </div>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="coin_base_api_key">Coinbase API KEY:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="coin_base_api_key" id="coin_base_api_key"
            value="{{ old('coin_base_api_key') ?? env('COIN_BASE_API_KEY') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('coin_base_api_key')
            {{ $message }}
        @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="coin_base_web_hook_sec">Coinbase Webhook Secrect:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="coin_base_web_hook_sec" id="coin_base_web_hook_sec"
            value="{{ old('coin_base_web_hook_sec') ?? env('COIN_BASE_WEB_HOOK_SEC') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('coin_base_web_hook_sec')
            {{ $message }}
        @enderror
    </span>
</div>
{{-- Coinbase Gateway ends here here --}}
