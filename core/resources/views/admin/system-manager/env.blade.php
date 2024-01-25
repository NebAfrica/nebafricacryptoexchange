<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] text-[#bfc9d4] p-3 md:p-5">
            <div class="w-full flex justify-between">
                <div>
                    <h3 class="font-medium capitalize">System Environment</h3>
                </div>
                <div>
                    <form action="{{ route('admin.system-manager.change-env') }}" method="post">
                        @csrf
                        <div class="flex justify-end item-center space-x-1">
                            @if (env('APP_DEBUG'))
                                <button name="action" value="disable"
                                    class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600">
                                    Disable Debug
                                </button>
                            @else
                                <button name="action" value="enable"
                                    class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600">
                                    Enable Debug
                                </button>
                            @endif

                            <a href="{{ route('clear-cache') }}"
                                class="flex items-center space-x-1 px-3 py-2 rounded-lg bg-gray-500 hover:bg-gray-600">
                                Clear Cache
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <hr class="w-full border-b border-dotted border-gray-600 border my-2">

            @if (env('APP_DEBUG'))
                <div class="w-full mb-3">
                    <div class="w-full flex justify-center">
                        <div class="w-full rounded-lg bg-[#131d2c] p-2 md:p-4">
                            <div class="flex justify-between items-center ">
                                <div>
                                    <div class="w-full flex space-x-2  text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                                        <div class="text-orange-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <b class="font-medium">Warning! </b> You have enabled Debug Mode on your
                                            server. This makes your website vulnurable. Disable DEBUG Mode if this
                                            website is on a live server.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                <table class="datatable-skeleton-table">
                    <thead>
                        <tr>
                            <th>ENV Variable</th>
                            <th>ENV Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Environment</td>
                            <td>{{ env('APP_ENV') }}</td>
                        </tr>
                        <tr>
                            <td>Debug Mode</td>
                            <td>
                                @if (env('APP_DEBUG'))
                                    <span class="bg-red-500 p-1 rounded">
                                        ON
                                    </span>
                                @else
                                    <span class="bg-green-500 text-white p-1 rounded">
                                        OFF
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>PHP Version</td>
                            <td>
                                @if ($php_version)
                                    <span class="bg-green-500 text-white p-1 rounded">
                                        {{ phpversion() }}
                                    </span>
                                @else
                                    <span class="bg-red-500 p-1 rounded">
                                        {{ phpversion() }}
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>SSL Certificate</td>
                            <td>
                                @if ($is_https)
                                    <span class="bg-green-500 text-white p-1 rounded">
                                        Yes
                                    </span>
                                @else
                                    <span class="bg-red-500 p-1 rounded">
                                        No
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>Last Cron Job</td>
                            <td>
                                @if (websiteInfo('cron') < \Illuminate\Support\Carbon::now()->addMinutes(-15)->timestamp)
                                    <span class="bg-red-500 p-1 rounded">
                                        {{ formatPastDate(websiteInfo('cron')) }}
                                    </span>
                                @else
                                    <span class="bg-green-500 text-white p-1 rounded">
                                        {{ formatPastDate(websiteInfo('cron')) }}
                                    </span>
                                @endif
                            </td>
                        </tr>



                    </tbody>
                </table>

                <table class="datatable-skeleton-table mt-3">
                    <thead>
                        <tr>
                            <th>Others</th>
                            <th>Current</th>
                            <th>Recommended</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($execution_sizes as $name => $ex)
                            <tr>
                                <td>{{ $name }}</td>
                                <td>
                                    @if ($ex['status'])
                                        <span class="bg-green-500 text-white p-1 rounded">
                                            {{ $ex['current'] }}
                                        </span>
                                    @else
                                        <span class="bg-red-500 p-1 rounded">
                                            {{ $ex['current'] }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $ex['recommended'] }}+</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
