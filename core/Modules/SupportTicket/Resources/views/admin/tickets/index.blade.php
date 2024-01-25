@extends('admin.layout.app')

@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        {{ $page_title }}
                    </h2>
                </div>

                <div>
                    <a href="@if (url()->previous() == route('admin.login')) {{ route('admin.dashboard') }} @else {{ url()->previous() }} @endif" class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        <span>back</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('infographics')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <div class="w-full py-5">
                <div class="w-full lg:grid lg:grid-cols-3 lg:gap-3 lg:place-content-evenly space-y-3 lg:space-y-0 text-[#bfc9d4]">
                    <div class="lg:col-span-2 flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ $total_tickets }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Total Tickets</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#2e7037] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ $new_tickets }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">New Tickets</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#4e3aaa] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ $open_tickets }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Open Tickets</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#df972bf8] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#922e9b] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ $pending_tickets }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Pending Tickets</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#922e9b] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex lg:block justify-between items-center bg-[#152136] px-3 lg:px-6 py-2 lg:py-3 hover:text-white cursor-pointer rounded-md">
                        <div class="hidden lg:block relative w-full">
                            <div class="absolute flex justify-center items-center -top-7 -right-7 h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                        </div>
                        <div class="lg:pr-14">
                            <div>
                                <h2 class="text-sm lg:text-base font-semibold">{{ $resolved_tickets }}</h2>
                            </div>
                            <div class="mt-2">
                                <h4 class="text-xs lg:text-sm font-medium">Resolved Tickets</h4>
                            </div>
                        </div>
                        <div class="lg:hidden opacity-50">
                            <div class="flex justify-center items-center h-9 w-9 rounded-full bg-[#a54f28] text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center items-center mt-5">
                <div class="w-full flex justify-center items-center lg:w-2/3">
                    <canvas id="myChart" width="100" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-sm bg-[#0e1726] p-1 md:p-4">
            <table id="datatable-skeleton-table" class="text-[#bfc9d4] text-xs md:text-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Replies</th>
                        <th>Files</th>
                        <th>Ticket ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody width="100%">

                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td><a class="underline" href="{{ route('admin.users.view', $ticket->user_id) }}">{{ adminUser($ticket->user_id, 'account_id') }}</a></td>
                        <td>{{ $ticket->status }}</td> {{-- Status are: 'new', 'pending', 'open', 'resolved' --}}
                        <td>{{ ticketInfo($ticket->id, 'reply')->count() }}</td>
                        <td>{{ ticketInfo($ticket->id, 'attachment')->count() }}</td>
                        <td>{{ $ticket->ticket_id }}</td>
                        <form action="{{ route('admin.tickets.delete', $ticket->id) }}" id="{{ 'deleteTicketForm'.$ticket->id }}" method="POST">
                            @csrf
                            <td>
                                <div class="flex space-x-2 text-center">
                                    <a title="View Ticket" href="{{ route('admin.tickets.view', $ticket->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>

                                    <a title="Edit Ticket" href="{{ route('admin.tickets.edit', $ticket->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-orange-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    @if ($ticket->status != 'resolved')
                                    <a title="Close Ticket" role="button" id="{{ 'closeTicket'.$ticket->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    @else
                                    <a title="Reopen Ticket" role="button" id="{{ 'reopenTicket'.$ticket->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    @endif
                                    <a title="Delete Ticket" role="button" id="{{ 'deleteTicket'.$ticket->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </form>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
@foreach ($tickets as $ticket)
<script>
    //Delete ticket
    $(document).ready(function() {
        $("{{ '#deleteTicket'.$ticket->id }}").click(function() {
            Swal.fire({
                title: 'Delete Ticket!',
                text: "Do you want to delete this ticket? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deleteTicketForm'.$ticket->id }}").submit();
                }
            });
        });
    });
</script>

@if ($ticket->status != 'resolved')
<script>
    //Close Ticket ticket
    $(document).ready(function() {
        $("{{ '#closeTicket'.$ticket->id }}").click(function() {
            Swal.fire({
                title: 'Close Ticket!',
                text: "Do you want to mark this ticket as resolved?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.tickets.index').'/status/'.$ticket->id }}?status=resolved";
                }
            });
        });
    });
</script>
@else
<script>
    //Close Ticket ticket
    $(document).ready(function() {
        $("{{ '#reopenTicket'.$ticket->id }}").click(function() {
            Swal.fire({
                title: 'Reopen Ticket!',
                text: "Do you want to reopen this ticket?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.tickets.index').'/status/'.$ticket->id }}?status=open";
                }
            });
        });
    });
</script>
@endif
@endforeach

<script>
    let totalTkt = "{{ $total_tickets }}"
    let newTkt = "{{ $new_tickets }}"
    let openTkt = "{{ $open_tickets }}"
    let pendingTkt = "{{ $pending_tickets }}"
    let resolvedTkt = "{{ $resolved_tickets }}"
    const data = {
        labels: [
            'TOTAL TICKETS',
            'NEW TICKETS',
            'OPEN TICKETS',
            'PENDING TICKETS',
            'RESOLVED TICKETS',
        ],
        datasets: [{
            type: 'pie',
            label: "Total Tickets",
            data: [parseInt(totalTkt)],
            backgroundColor: ['rgb(46, 112, 55)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "New Tickects",
            data: [0, parseInt(newTkt)],
            backgroundColor: ['rgb(78, 58, 170)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Open Tickets",
            data: [0, 0, parseInt(openTkt)],
            backgroundColor: ['rgba(223, 151, 43, 0.99)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Pending Tickets",
            data: [0, 0, 0, parseInt(pendingTkt)],
            backgroundColor: ['rgb(146, 46, 155)'],
            hoverOffset: 2
        }, {
            type: 'pie',
            label: "Resolved Tickets",
            data: [0, 0, 0, parseInt(resolvedTkt)],
            backgroundColor: ['rgb(165, 79, 40)'],
            hoverOffset: 2
        }, ]
    };
    const config = {
        data: data,
        options: {
            layout: {
                padding: 20
            }
        }
    };
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, config)
</script>

@endsection