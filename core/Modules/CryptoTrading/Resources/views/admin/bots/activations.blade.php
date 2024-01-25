@php
    function getBot($bot_id)
    {
        $bot = Modules\CryptoTrading\Entities\TradingBot::where('id', $bot_id)->first();
        return $bot;
    }
@endphp

<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">

            <div class="flex justify-start space-x-3">
                <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                    Bot Activations
                </h2>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border mb-5">

            @if ($bots->count() > 0)
            <table id="datatable-skeleton-table-2" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th></th> 
                        <th>Date Activate</th> 
                        <th>Key</th>         
                        <th>Account ID</th>
                        <th>User</th>
                        <th>Bot</th>                        
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">
                    @foreach ($activations as $activation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d.m.Y', strtotime($activation->created_at)) }}</td>
                        <td>{{ $activation->key }}</td>
                        <td>{{ adminUser($activation->user_id, 'account_id') }}</td>
                        <td>
                            <a class="underline" href="{{ route('admin.users.view', $activation->user_id) }}">{{ adminUser($activation->user_id, 'first_name') .' ' .adminUser($activation->user_id, 'last_name') }}</a>
                        </td>
                        <td>
                            {{ getBot($activation->bot_id)->name }}
                        </td>
                        <td>
                            @if ($activation->status == 'disabled')  
                                <span class="bg-red-600 rounded px-2">{{ $activation->status }}</span>
                            @else
                                <span class="bg-green-600 rounded px-2">{{ $activation->status }}</span>
                            @endif
                        </td>
                        
                        <td class="flex justify-between">
                            <a href="{{ route('admin.trading.trading-bots.delete-key', $activation->id) }}" class="text-red-600">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </td>

                    </tr>

                    @endforeach
                </tbody>

            </table>
            @else
            {{--  disclaimer notification --}}
            <div class="w-full p-6 md:p-10 flex justify-center">
                <div class="w-full flex space-x-2 rounded-lg bg-[#131d2c] text-[#d3d6df] p-2 md:p-4 text-xs md:text-sm">
                    <div class="text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                        </svg>
                    </div>
                    <div>
                        <b class="font-medium">Empty Record! </b> There are no bots found.
                    </div>
                </div>
            </div>
            @endif

            
        </div>
    </div>
</div>