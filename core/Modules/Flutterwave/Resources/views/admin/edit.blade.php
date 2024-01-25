{{-- Flutterwave Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="flw_pub_key">Public Key:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="flw_pub_key" id="flw_pub_key" value="{{ old('flw_pub_key') ?? env('FLW_PUB_KEY') }}"
            required>
    </div>
    <span class="p-1 text-red-600">
        @error('flw_pub_key')
            {{ $message }}
        @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="flw_sec_key">Secret Key:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="flw_sec_key" id="flw_sec_key" value="{{ old('flw_sec_key') ?? env('FLW_SEC_KEY') }}"
            required>
    </div>
    <span class="p-1 text-red-600">
        @error('flw_sec_key')
            {{ $message }}
        @enderror
    </span>
</div>
{{-- Flutterwave Gateway ends here here --}}
