 {{-- Razorpay Gateway starts here --}}
 <div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="rzp_key_id">Razorpay Key ID:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="rzp_key_id" id="rzp_key_id" value="{{ old('rzp_key_id') ?? env('RZP_KEY_ID') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('rzp_key_id') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="rzp_key_secret">Razorpay Key Secret:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="rzp_key_secret" id="rzp_key_secret" value="{{ old('rzp_key_secret') ?? env('RZP_KEY_SECRET') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('rzp_key_secret') {{ $message }} @enderror
    </span>
</div>
{{-- Razorpay Gateway ends here here --}}