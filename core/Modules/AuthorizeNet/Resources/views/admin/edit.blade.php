<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="authorize_api_id">Authorize API ID:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="authorize_api_id" id="authorize_api_id" value="{{ old('authorize_api_id') ?? env('AUTHORIZE_API_ID') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('authorize_api_id') {{ $message }} @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="authorize_transaction_key">Authorize Transaction Key:</label>
        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="authorize_transaction_key" id="authorize_transaction_key" value="{{ old('authorize_transaction_key') ?? env('AUTHORIZE_TRANSACTION_KEY') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('authorize_transaction_key') {{ $message }} @enderror
    </span>
</div>