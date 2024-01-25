@extends('admin.layout.app')

@section('title')
    <div class="w-full py-5">
        <div class="w-full flex justify-center">
            <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
                <div class="flex justify-between items-center">
                    <div>
                        {{--  Card header --}}
                        <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                            System Manager
                        </h2>
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}"
                            class="flex justify-start items-center text-xs text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
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


@section('content')
    {{--  license manager --}}
    @include('admin.system-manager.license')

    @if (isAddonEnabled('updater'))
        @include('updater::index')
    @endif

    {{--  env --}}
    @include('admin.system-manager.env')

    {{--  extensions --}}
    @include('admin.system-manager.extensions')

    {{--  permissions --}}
    @include('admin.system-manager.permissions')
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.datatable-skeleton-table').DataTable({
                scrollX: true,
                "sScrollXInner": "100%",
                "pageLength": 50,
            });

            $(".dataTables_wrapper .dataTables_length").hide();
            $('.dataTables_filter').hide();
            $('.dataTables_info').hide();
            $('.dataTables_paginate').hide();

            $('#purchase_code').inputmask("********-****-****-****-************");
        });
    </script>
@endsection
