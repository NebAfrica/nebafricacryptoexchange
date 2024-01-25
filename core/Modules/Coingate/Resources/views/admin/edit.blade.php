{{-- Coingate Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="cg_auth_token">Coingate Auth Token:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="cg_auth_token" id="cg_auth_token"
            value="{{ old('cg_auth_token') ?? env('CG_AUTH_TOKEN') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('cg_auth_token')
            {{ $message }}
        @enderror
    </span>
</div>

<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="cg_mode">Mode:</label>
        <div class="">
            <select
                class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
                name="cg_mode" id="cg_mode" required>
                <option value="live" @if (old('cg_mode') ?? env('CG_MODE') == 'live') selected @endif>Live</option>
                <option value="sandbox" @if (old('cg_mode') ?? env('CG_MODE') != 'live') selected @endif>Sandbox</option>
            </select>
        </div>
    </div>
    <span class="p-1 text-red-600">
        @error('cg_mode')
            {{ $message }}
        @enderror
    </span>
</div>
{{-- Coingate Gateway ends here here --}}
