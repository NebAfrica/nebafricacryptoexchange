@extends('admin.layout.app')
@section('title')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-between items-center">
                <div>
                    {{-- Card header --}}
                    <h2 class="bg-transparent text-[#ebedf2] font-medium capitalize">
                        Edit Loan Plan
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

@section('content')
<div class="w-full py-5">
    <div class="w-full flex justify-center">
        <div class="w-11/12 rounded-md bg-[#0e1726] p-2 md:p-4">
            <div class="flex justify-end space-x-2 items-center">
                <div>
                    <a href="{{ route('admin.loans-plans.index') }}" title="View All Loan Plans" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>View All</span>
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.loans-plans.new') }}" title="Add New Loan Plan" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
                <div>
                    <form action="{{ route('admin.loans-plans.delete', $loan_plan->id) }}" method="post" id="{{ 'deletePlanForm' . $loan_plan->id }}">
                        @csrf
                        <a role="button" id="{{ 'deletePlan'.$loan_plan->id }}" title="Delete Loan Plan" class="flex justify-start items-center space-x-1 text-xs md:text-sm text-[#d1d5db] text-center px-5 py-2 my-2 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Delete</span>
                        </a>
                    </form>
                </div>
            </div>
            <hr class="w-full border-b border-dotted border-gray-600 border">

            <div class="p-2 md:p-4">
                <form action="{{ route('admin.loans-plans.edit-validate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $loan_plan->id }}">

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="name">Name:</label>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="text" name="name" id="name" value="{{ old('name') ?? $loan_plan->name }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('name') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="min_amount">Minimum Loan Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <h6 class="text-xs text-blue-400">
                                minimum amount of loan users can take on this plan
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_amount" id="min_amount" value="{{ old('min_amount') ?? $loan_plan->min_amount }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('min_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="max_amount">Maximum Loan Amount ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <h6 class="text-xs text-blue-400">
                                maximum amount of loan users can take on this plan
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="max_amount" id="max_amount" value="{{ old('max_amount') ?? $loan_plan->max_amount }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('max_amount') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="min_deposit">Min Deposit ({{ strtoupper(websiteInfo('general_currency')) }}):</label>
                            <h6 class="text-xs text-blue-400">
                                total amount of deposits [in {{ websiteInfo('general_currency') }}] a user must have made to qualify to take loan from this plan
                            </h6>
                            <input class="w-full pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" step="any" name="min_deposit" id="min_deposit" value="{{ old('min_deposit') ?? $loan_plan->min_deposit }}" required>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('min_deposit') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="interest">Interest:</label>
                            <div class="flex space-x-5">
                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="interest" step="any" value="{{ old('interest') ?? $loan_plan->interest }}" required>
                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="interest_type" id="interest_type" required>
                                    <option value="percent" @if (old('interest_type') ?? $loan_plan->interest_type == 'percent') selected @endif>%</option>
                                    <option value="fixed" @if ( old('interest_type') ?? $loan_plan->interest_type == 'fixed') selected @endif>{{ websiteInfo('general_currency') }}</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('interest') {{ $message }} @enderror @error('interest_type') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="text-[#bfc9d4] text-xs md:text-sm">
                        <div class="w-full">
                            <label class="font-medium" for="duration">Duration:</label>
                            <div class="flex space-x-5">
                                <input class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" type="number" name="duration" step="any" value="{{ old('duration') ?? $loan_plan->duration }}" required>
                                <select class="w-1/2 pt-2 bg-[#0e1726] transition-colors duration-200 transform focus:outline-none border-b-2 border-slate-800 focus:border-b-slate-500" name="duration_type" id="duration_type" required>
                                    <option value="hour" @if (old('duration_type') ?? $loan_plan->duration_type == 'hour') selected @endif>Hour(s)</option>
                                    <option value="day" @if (old('duration_type') ?? $loan_plan->duration_type == 'day') selected @endif>Day(s)</option>
                                    <option value="week" @if (old('duration_type') ?? $loan_plan->duration_type == 'week') selected @endif>Week(s)</option>
                                    <option value="month" @if (old('duration_type') ?? $loan_plan->duration_type == 'month') selected @endif>Month(s)</option>
                                    <option value="year" @if (old('duration_type') ?? $loan_plan->duration_type == 'year') selected @endif>Year(s)</option>
                                </select>
                            </div>
                        </div>
                        <span class="p-1 text-red-600">
                            @error('duration') {{ $message }} @enderror @error('duration_type') {{ $message }} @enderror
                        </span>
                    </div>

                    <div class="w-full my-5 px-5">
                        <button type="submit" class="w-full text-xs md:text-sm text-[#d1d5db] text-center px-5 py-3 my-5 bg-[#1b2e4b] hover:bg-gray-700 rounded-md">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    //Delete Investment plan
    $(document).ready(function() {
        $("{{ '#deletePlan'.$loan_plan->id }}").click(function() {
            Swal.fire({
                title: 'Delete Loan Plan!',
                text: "Do you want to delete this loan plan? It can't be reversed",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b2e4b',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete',
                background: "#0e1726",
                color: "#d1d5db",
                
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("{{ 'deletePlanForm' . $loan_plan->id }}").submit();
                }
            });
        });
    });
</script>
@endsection