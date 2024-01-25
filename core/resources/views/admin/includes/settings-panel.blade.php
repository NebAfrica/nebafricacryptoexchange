{{--  setting pannel --}}
<div class="w-full flex justify-start">
    <div class="relative w-1/2">
        <span class="cred-hyip-theme1-input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
        </span>
        <select name="action" id="action" class="cred-hyip-theme1-text-input" onChange="window.location.href=this.value">
            <option value="" selected disabled>Select setting</option>
            <option value="{{ route('admin.settings.core') }}" @if (request()->is('admin/settings/core') || request()->is('admin/settings/core/*')) selected @endif>Core</option>
            <option value="{{ route('admin.settings.email-config') }}" @if (request()->is('admin/settings/email-config') || request()->is('admin/settings/email-config/*')) selected @endif>Email Config</option>
            <option value="{{ route('admin.settings.email-templates') }}" @if (request()->is('admin/settings/email-templates') || request()->is('admin/settings/email-templates/*')) selected @endif>Email Templates</option>
            <option value="{{ route('admin.settings.security-otp') }}" @if (request()->is('admin/settings/security-otp') || request()->is('admin/settings/security-otp/*')) selected @endif>Security & OTP</option>
            <option value="{{ route('admin.settings.gateways.index') }}" @if (request()->is('admin/settings/gateways') || request()->is('admin/settings/gateways/*')) selected @endif>Payment GateWays</option>
            <option value="{{ route('admin.settings.misc') }}" @if (request()->is('admin/settings/misc') || request()->is('admin/settings/misc/*')) selected @endif>Misc</option>
            <option value="{{ route('admin.settings.livechat') }}" @if (request()->is('admin/settings/livechat') || request()->is('admin/settings/livechat/*')) selected @endif>Livechat</option>
            <option value="{{ route('admin.settings.custom-css') }}" @if (request()->is('admin/settings/custom-css') || request()->is('admin/settings/custom-css/*')) selected @endif>Custom CSS</option>
            <option value="{{ route('admin.settings.custom-js') }}" @if (request()->is('admin/settings/custom-js') || request()->is('admin/settings/custom-js/*')) selected @endif>Custom JS</option>
            <option value="{{ route('admin.settings.custom-php') }}" @if (request()->is('admin/settings/custom-php') || request()->is('admin/settings/custom-php/*')) selected @endif>Custom PHP</option>
        </select>
    </div>
</div>
<hr class="w-full border-b border-dotted border-gray-600 border my-5">
{{--  setting pannel ends --}}