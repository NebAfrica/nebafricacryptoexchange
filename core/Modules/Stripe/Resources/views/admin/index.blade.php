@foreach ($gateways->where('type', 'stripe') as $method)
    <tr>
        <td><img class="w-16 h-16 rounded-full" src="{{ route('file', ['deposit-methods', $method->logo]) }}"
                alt="{{ $method->name }}"></td>
        <td>{{ $method->name }}</td>
        <td>{{ $method->status }}</td>
        <td class="flex items-center space-x-3 md:space-x-5 mt-6">
            <a href="{{ route('admin.settings.gateways.edit', $method->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
            @if ($method->status == 'active')
                <a role="button" class='gateway_action_btn' data-id="{{ $method->id }}" data-action="disable">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </a>
            @elseif($method->status == 'inactive')
                <a role="button" class='gateway_action_btn' data-id="{{ $method->id }}" data-action="enable">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            @endif

        </td>
    </tr>
@endforeach
