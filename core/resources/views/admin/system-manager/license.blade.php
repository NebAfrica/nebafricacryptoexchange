<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <div class="w-full flex justify-between">
                <div>
                    <h3 class="font-medium capitalize">Purchase Code Verification | <a style="color:red;" href="https://weadown.com" target="_blank">weadown.com</a></h3>
                </div>
                
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border my-2">
            <form action="{{ route('admin.system-manager.verify') }}" method="post">
                @csrf
                <div class="w-full flex justify-between">
                    <div class="w-2/3">
                        <div class="relative">
                            <span class="cred-hyip-theme1-input-icon material-icons">
                                lock
                            </span>
                            <input required type="text" id="purchase_code" name="purchase_code" placeholder="Enter random value" value="{{ old('purchase_code') }}" class="cred-hyip-theme1-text-input">
                            <span>@error('purchase_code') {{ $message }} @enderror </span>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600">
                            Verify
                        </button>
                    </div>
                </div>

            </form>
            
        </div>
    </div>
</div>
