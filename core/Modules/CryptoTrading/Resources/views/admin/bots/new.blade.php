<div class="general-form new-form  hidden">
    {{-- {{ dd($errors->all()) }} --}}
    <div class="w-full py-5">    
        <div class="w-full flex justify-center">
            <div class="w-11/12 md:w-12/12 rounded-md bg-[#0e1726] text-[#d3d6df] p-2 md:p-4 box-shadow">
                <div class="w-full flex justify-between mb-2">
                    <div>
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            New Trading Bot
                         </h2>
                    </div>
                    <div>
                        <a role="button" class="new-button text-red-600" data-type="close">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
                 <hr class="w-full border-b border-dotted border-gray-600 border mb-4"> 
                 <div class="p-2 md:p-4">
                    <form class="mt-2 p-2 md:p-4" action="{{ route('admin.trading.trading-bots.create') }}"  method="post" enctype="multipart/form-data">
    
                        @csrf
                       
    
                        <div class="w-full md:flex md:justify-space-around">
                            <div class="text-[#bfc9d4] text-xs md:text-sm p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="name">Name:</label>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="name" id="name" value="{{ old('name') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('name') {{ $message }} @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="price">Price({{ websiteInfo('general_currency') }}):</label>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="price" id="price" value="{{ old('price') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('price') {{ $message }} @enderror
                                </span>
                            </div>
    
                            
                            
                        </div>
    
                        <div class="w-full md:flex md:justify-space-around">
                            <div class="text-[#bfc9d4] text-xs md:text-sm p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="min_return">Min Return(%)</label>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="min_return" id="min_return" value="{{ old('min_return') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('min_return') {{ $message }} @enderror
                                </span>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm p-2">
                                <div class="w-full">
                                    <label class="font-medium" for="max_return">Max Return(%)</label>
                                    <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="max_return" id="max_return" value="{{ old('max_return') }}" required>
                                </div>
                                <span class="p-1 text-red-600">
                                    @error('max_return') {{ $message }} @enderror
                                </span>
                            </div>

                            
                            
                        </div>
                        <div class="w-full md:flex md:justify-space-around"> 
                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="lose_count">Lose per Win </label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="max_stake">number of losses before a win</span>
                                        </h6>
                                        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="lose_count" id="lose_count" value="{{ old('lose_count') }}" required>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('max_return') {{ $message }} @enderror
                                    </span>

                                </div>
                            </div>

                            <div class="text-[#bfc9d4] text-xs md:text-sm">
                                <div class="p-2">
                                    <div class="w-full">
                                        <label class="font-medium" for="icon">Icon </label>
                                        <h6 class="text-xs text-blue-400">
                                            <span id="">...</span>
                                        </h6>
                                        <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="file" name="icon" id="icon" value="{{ old('icon') }}" required>
                                    </div>
                                    <span class="p-1 text-red-600">
                                        @error('max_return') {{ $message }} @enderror
                                    </span>

                                </div>
                            </div>
                            
                        </div>

                        <div class="relative w-full">
                            <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                                Save Bot
                            </button>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
    
</div>

