@extends('layouts.master')

@section('content')

<div class="w-full">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">

            <h2 class="text-xl font-semibold">
                Edit Leave
            </h2>

            <a href="{{ route('leaves.index') }}"
               class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                Back
            </a>

        </div>

        <!-- Validation -->
        @if ($errors->any())

            <div class="m-6 rounded-lg border border-red-300 bg-red-50 p-4">

                <ul class="list-disc ml-5 text-red-600">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

         <form action="{{ route('leaves.update', $leave->id) }}"
          method="POST">

        @csrf
        @method('PUT')


            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Employee -->
                    <div>

                        <label class="block font-semibold mb-2">Employee</label>

                        <select
                            name="empID"
                            x-model="empID"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                            @foreach($employees as $employee)

                                <option value="{{ $employee->User_id }}">
                                    {{ $employee->strName }} ({{ $employee->User_id }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                   

                    <!-- Leave Type -->
                    <div>

                        <label class="block font-semibold mb-2">Leave Type</label>

                        <select
                            name="leave_type_id"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                            @foreach($leaveTypes as $leaveType)

                                <option
                                    value="{{ $leaveType->id }}"
                                    {{ old('leave_type_id',$leave->leave_type_id)==$leaveType->id ? 'selected' : '' }}>

                                    {{ $leaveType->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Status -->
                    <div>

                        <label class="block font-semibold mb-2">Status</label>

                        <select
                            name="status"
                            x-model="status"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>

                        </select>

                    </div>

                    <!-- Leave From -->
                    <div>

                        <label class="block font-semibold mb-2">Leave From</label>

                        <input
                            type="date"
                            name="leave_from"
                            x-model="from"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>

                    <!-- Leave To -->
                    <div>

                        <label class="block font-semibold mb-2">Leave To</label>

                        <input
                            type="date"
                            name="leave_to"
                            x-model="to"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>

                    <!-- Total Days -->

                    <!-- Approved By (only meaningful once status isn't Pending) -->
                    <div x-show="status !== 'Pending'">

                        <label class="block font-semibold mb-2">Approved / Rejected By</label>

                        <input
                            type="text"
                            name="approved_by"
                            value="{{ old('approved_by', $leave->approved_by) }}"
                            placeholder="Approver name"
                            class="w-full border rounded-lg px-4 py-2">

                    </div>

                    <!-- Reason -->
                    <div class="md:col-span-2">

                        <label class="block font-semibold mb-2">Reason</label>

                        <textarea
                            name="reason"
                            rows="3"
                            class="w-full border rounded-lg px-4 py-2">{{ old('reason', $leave->reason) }}</textarea>

                    </div>

                    @if($leave->approved_at)
                        <div class="md:col-span-2 text-sm text-slate-500">
                            Last actioned at: {{ \Carbon\Carbon::parse($leave->approved_at)->format('d M Y, h:i A') }}
                        </div>
                    @endif

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-8 border-t pt-6">

                    <a
                        href="{{ route('leaves.index') }}"
                        class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Update Leave
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection