@extends('layouts.master')

@section('content')

<div class="w-full">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">

            <h2 class="text-xl font-semibold">
                Edit Employee
            </h2>

            <a href="{{ route('employees.index') }}"
               class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                Back
            </a>

        </div>

        <form
            action="{{ route('employees.update',$employee->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block font-semibold mb-2">User ID</label>
                        <input
                            type="text"
                            name="User_id"
                            value="{{ old('User_id',$employee->User_id) }}"
                            readonly
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Card Number</label>
                        <input
                            type="text"
                            name="card_number"
                            value="{{ old('card_number',$employee->card_number) }}"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Employee Name</label>
                        <input
                            type="text"
                            name="strName"
                            value="{{ old('strName',$employee->strName) }}"
                            class="w-full border rounded-lg px-4 py-2"
                            required>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Department</label>

                        <select
                            name="strdepartment"
                            class="w-full border rounded-lg px-4 py-2">

                            @foreach($departments as $department)

                            <option
                                value="{{ $department->id }}"
                                {{ old('id',$employee->id)==$department->id?'selected':'' }}>

                                {{ $department->departmentName }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Designation</label>

                        <select
                            name="strdesignation"
                            class="w-full border rounded-lg px-4 py-2">

                            @foreach($designations as $designation)

                            <option
                                value="{{ $designation->id }}"
                                {{ old('strdesignation',$employee->id)==$designation->id?'selected':'' }}>

                                {{ $designation->designation }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="block font-semibold mb-2">
                            Shift
                        </label>

                        <select
                            name="shiftName"
                            required
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="">
                                Select Shift
                            </option>

                            @foreach($shifts as $shift)

                                <option
                                    value="{{ $shift->id }}"
                                    {{ old('shiftName', $employee->id) == $shift->id ? 'selected' : '' }}>

                                    {{ $shift->shiftName }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="block font-semibold mb-2">
                            Reporting To
                        </label>

                        <select
                            name="reporting_boss"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="">
                                Select Supervisor
                            </option>

                            @foreach($supervisors as $supervisor)

                                <option
                                    value="{{ $supervisor->id }}"
                                    {{ old('id', $employee->id) == $supervisor->id ? 'selected' : '' }}>

                                    {{ $supervisor->strName }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Join Date</label>

                        <input
                            type="date"
                            name="join_Date"
                            value="{{ old('join_Date',date('Y-m-d',strtotime($employee->join_Date))) }}"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Religion</label>

                        <select
                            name="RelioGion"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="Islam" {{ $employee->RelioGion=='Islam'?'selected':'' }}>Islam</option>
                            <option value="Hinduism" {{ $employee->RelioGion=='Hinduism'?'selected':'' }}>Hinduism</option>
                            <option value="Christianity" {{ $employee->RelioGion=='Christianity'?'selected':'' }}>Christianity</option>
                            <option value="Buddhism" {{ $employee->RelioGion=='Buddhism'?'selected':'' }}>Buddhism</option>

                        </select>

                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Blood Group</label>

                        <input
                            type="text"
                            name="bloodGroup"
                            value="{{ old('bloodGroup',$employee->bloodGroup) }}"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Gender</label>

                        <select
                            name="Gender"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="Male" {{ $employee->Gender=='Male'?'selected':'' }}>Male</option>
                            <option value="Female" {{ $employee->Gender=='Female'?'selected':'' }}>Female</option>

                        </select>

                    </div>

                    <div>
                        <label class="block font-semibold mb-2">Admin</label>

                        <select
                            name="ysnAdmin"
                            class="w-full border rounded-lg px-4 py-2">

                            <option value="0" {{ $employee->ysnAdmin==0?'selected':'' }}>No</option>
                            <option value="1" {{ $employee->ysnAdmin==1?'selected':'' }}>Yes</option>

                        </select>

                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>

                        <select
                            name="ysnactive"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">

                            <option value="1"
                                {{ $employee->ysnactive == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ $employee->ysnactive == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
                    </div>

                    <!-- Inactive Reason -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Inactive Reason
                        </label>

                        <input
                            type="text"
                            name="inactiveReason"
                            value="{{ old('inactiveReason', $employee->inactiveReason) }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2">
                    </div>

                    <!-- Photo -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Employee Photo
                        </label>

                        @if($employee->image)
                             <img
                                src="{{ asset('employees/' . $employee->image) }}"
                                class="w-32 h-32 rounded-lg border object-cover mb-3">
                        @endif

                        <input
                            placeholder="Upload Image"
                            type="file"
                            name="image_file"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-8 border-t pt-6">

                    <a
                        href="{{ route('employees.index') }}"
                        class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Update Employee
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection