{{-- Monnify Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="monnify_api_key">Monnify API KEY:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="monnify_api_key" id="monnify_api_key"
            value="{{ old('monnify_api_key') ?? env('MONNIFY_API_KEY') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('monnify_api_key')
            {{ $message }}
        @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="monnify_secret_key">Monnify Secret KEY:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="monnify_secret_key" id="monnify_secret_key"
            value="{{ old('monnify_secret_key') ?? env('MONNIFY_SECRET_KEY') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('monnify_secret_key')
            {{ $message }}
        @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="monnify_base_url">Monnify Base URL:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="monnify_base_url" id="monnify_base_url"
            value="{{ old('monnify_base_url') ?? env('MONNIFY_BASE_URL') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('monnify_secret_key')
            {{ $message }}
        @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="monnify_contract_code">Monnify Contract Code:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="monnify_contract_code" id="monnify_contract_code"
            value="{{ old('monnify_contract_code') ?? env('MONNIFY_CONTRACT_CODE') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('monnify_contract_code')
            {{ $message }}
        @enderror
    </span>
</div>
{{-- Monnify Gateway ends here here --}}
