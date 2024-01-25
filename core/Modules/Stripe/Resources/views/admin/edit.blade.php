{{-- Stripe Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="stripe_key">Stripe Key:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="stripe_key" id="stripe_key" value="{{ old('stripe_key') ?? env('STRIPE_KEY') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('stripe_key') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="stripe_secret">Stripe Secret:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="stripe_secret" id="stripe_secret" value="{{ old('stripe_secret') ?? env('STRIPE_SECRET') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('stripe_secret') {{ $message }} @enderror
    </span>
</div>
{{-- Stripe Gateway ends here here --}}