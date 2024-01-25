{{-- Cashmaal Gateway starts here --}}
<div class="text-[#bfc9d4] text-xs md:text-sm">
    <div class="w-full">
        <label class="font-medium" for="cm_web_id">CashMaal Web ID:</label>
        <input
            class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500"
            type="text" name="cm_web_id" id="cm_web_id" value="{{ old('cm_web_id') ?? env('CM_WEB_ID') }}" required>
    </div>
    <span class="p-1 text-red-600">
        @error('cm_web_id')
            {{ $message }}
        @enderror
    </span>
</div>
{{-- Cashmaal Gateway ends here here --}}
