@extends('layouts.master')

@section('content')

<script>
    function leaveForm() {
        return {
            employees: [],
            empID: '',
            empType: '',
            from: '',
            to: '',

            get totalDays() {
                if (!this.from || !this.to) return '';
                const f = new Date(this.from);
                const t = new Date(this.to);
                const diff = Math.round((t - f) / 86400000) + 1;
                return diff > 0 ? diff : '';
            },

            init() {
                this.employees = JSON.parse(this.$el.dataset.employees || '[]');
                this.empID = this.$el.dataset.oldEmpid || '';
                this.empType = this.$el.dataset.oldEmptype || '';
                this.from = this.$el.dataset.oldFrom || '';
                this.to = this.$el.dataset.oldTo || '';

                this.$watch('empID', (value) => {
                    const emp = this.employees.find(e => e.id === value);
                    this.empType = emp ? emp.designation : '';
                });
            }
        };
    }
</script>

<div class="w-full">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Add Leave
            </h1>

            <p class="text-slate-500 mt-1">
                Submit a new leave application
            </p>
        </div>

        <a href="{{ route('leaves.index') }}"
           class="px-5 py-2 rounded-lg bg-slate-700 text-white hover:bg-slate-800">
            ← Back
        </a>

    </div>

    <!-- Validation -->
    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4">

            <ul class="list-disc ml-5 text-red-600">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('leaves.store') }}"
        method="POST"
        x-data="leaveForm()">

        @csrf

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <div class="bg-slate-800 text-white px-6 py-4">

                <h2 class="text-lg font-semibold">
                    Leave Information
                </h2>

            </div>

            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Employee -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Employee
                        </label>

                        <select
                            name="empID"
                            x-model="empID"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="">Select Employee</option>

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}">
                                    {{ $employee->strName }} ({{ $employee->User_id }})
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Employee Type -->

                    <!-- Leave Type -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Leave Type
                        </label>

                        <select
                            name="leave_type_id"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="">Select Leave Type</option>

                            @foreach($leaveTypes as $leaveType)

                                <option
                                    value="{{ $leaveType->id }}"
                                    {{ old('leave_type_id')==$leaveType->id ? 'selected' : '' }}>

                                    {{ $leaveType->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Status -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="Pending" {{ old('status','Pending')=='Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ old('status')=='Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ old('status')=='Rejected' ? 'selected' : '' }}>Rejected</option>

                        </select>

                    </div>

                    <!-- Leave From -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Leave From
                        </label>

                        <input
                            type="date"
                            name="leave_from"
                            x-model="from"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>

                    <!-- Leave To -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Leave To
                        </label>

                        <input
                            type="date"
                            name="leave_to"
                            x-model="to"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                    </div>

                    <!-- Total Days (auto-calculated, editable as fallback) --

                    <!-- Reason -->
                    <div class="md:col-span-2">

                        <label class="block font-semibold mb-2">
                            Reason
                        </label>

                        <textarea
                            name="reason"
                            rows="3"
                            class="w-full border rounded-lg px-4 py-2">{{ old('reason') }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-8 border-t pt-6">

            <a href="{{ route('leaves.index') }}"
               class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">

                Cancel

            </a>

            <button
                type="reset"
                class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">

                Reset

            </button>

            <button
                type="submit"
                class="px-8 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">

                Save Leave

            </button>

        </div>

    </form>

</div>

@endsection