{{-- Paypal Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_mode">PayPal Mode:</label>
        <div class="">
            <select class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="paypal_mode" id="paypal_mode" required>
                <option value="live" @if (old('paypal_mode') ?? websiteInfo('paypal_mode')=='live' ) selected @endif>Live</option>
                <option value="sandbox" @if (old('paypal_mode') ?? websiteInfo('paypal_mode')=='sandbox' ) selected @endif>SandBox</option>
            </select>
        </div>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_mode') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_sand_box_client_id">Paypal Sandbox Client ID:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paypal_sand_box_client_id" id="paypal_sand_box_client_id" value="{{ old('paypal_sand_box_client_id') ??  websiteInfo('paypal_sand_box_client_id') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_sand_box_client_id') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_sand_box_client_secret">Paypal Sandbox Client Secret:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paypal_sand_box_client_secret" id="paypal_sand_box_client_secret" value="{{ old('paypal_sand_box_client_secret') ??  websiteInfo('paypal_sand_box_client_secret') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_sand_box_client_secret') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_sand_box_app_id">Paypal Sandbox App ID:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paypal_sand_box_app_id" id="paypal_sand_box_app_id" value="{{ old('paypal_sand_box_app_id') ??  websiteInfo('paypal_sand_box_app_id') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_sand_box_app_id') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_live_client_id">Paypal Live Client ID:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paypal_live_client_id" id="paypal_live_client_id" value="{{ old('paypal_live_client_id') ??  websiteInfo('paypal_live_client_id') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_live_client_id') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_live_client_secret">Paypal Live Client Secret:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paypal_live_client_secret" id="paypal_live_client_secret" value="{{ old('paypal_live_client_secret') ??  websiteInfo('paypal_live_client_secret') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_live_client_secret') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="paypal_live_app_id">Paypal Live App ID:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="paypal_live_app_id" id="paypal_live_app_id" value="{{ old('paypal_live_app_id') ??  websiteInfo('paypal_live_app_id') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('paypal_live_app_id') {{ $message }} @enderror
    </span>
</div>
{{-- Paypal Gateway ends here here --}}