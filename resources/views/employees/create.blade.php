@extends('layouts.master')

@section('content')

<div class="w-full">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Add Employee
            </h1>

            <p class="text-slate-500 mt-1">
                Create a new employee profile
            </p>
        </div>

        <a href="{{ route('employees.index') }}"
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

    <form action="{{ route('employees.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full">

            <div class="bg-slate-800 text-white px-6 py-4">

                <h2 class="text-lg font-semibold">
                    Employee Information
                </h2>

            </div>

            <div class="p-8 w-full">

                <div class="w-full">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- User ID -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    User ID
                                </label>

                                <input
                                    type="text"
                                    name="User_id"
                                    value="{{ old('User_id') }}"
                                    required
                                    class="w-full border rounded-lg px-4 py-2">

                            </div>

                            <!-- Card -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Card Number
                                </label>

                                <input
                                    type="text"
                                    name="card_number"
                                    value="{{ old('card_number') }}"
                                    class="w-full border rounded-lg px-4 py-2">

                            </div>

                            <!-- Name -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Employee Name
                                </label>

                                <input
                                    type="text"
                                    name="strName"
                                    value="{{ old('strName') }}"
                                    required
                                    class="w-full border rounded-lg px-4 py-2">

                            </div>

                            <!-- Department -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Department
                                </label>

                                <select
                                    name="strdepartment"
                                    required
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option value="">
                                        Select Department
                                    </option>

                                    @foreach($departments as $department)

                                        <option
                                            value="{{ $department->departmentName }}"
                                            {{ old('strdepartment')==$department->departmentName ? 'selected' : '' }}>

                                            {{ $department->departmentName }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <!-- Designation -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Designation
                                </label>

                                <select
                                    name="strdesignation"
                                    required
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option value="">
                                        Select Designation
                                    </option>

                                    @foreach($designations as $designation)

                                        <option
                                            value="{{ $designation->designation }}"
                                            {{ old('strdesignation')==$designation->designation ? 'selected' : '' }}>

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
                                            value="{{ $shift->shiftName }}"
                                            {{ old('shiftName') == $shift->shiftName ? 'selected' : '' }}>

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
                                            value="{{ $supervisor->strName }}"
                                            {{ old('reporting_boss') == $supervisor->strName ? 'selected' : '' }}>

                                            {{ $supervisor->strName }}
                                            ({{ $supervisor->User_id }})

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Join Date -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Join Date
                                </label>

                                <input
                                    type="date"
                                    name="join_Date"
                                    value="{{ old('join_Date',date('Y-m-d')) }}"
                                    class="w-full border rounded-lg px-4 py-2">

                            </div>

                            <!-- Religion -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Religion
                                </label>

                                <select
                                    name="RelioGion"
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option>Islam</option>
                                    <option>Hinduism</option>
                                    <option>Christianity</option>
                                    <option>Buddhism</option>

                                </select>

                            </div>

                            <!-- Blood Group -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Blood Group
                                </label>

                                <select
                                    name="bloodGroup"
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option>A+</option>
                                    <option>O+</option>
                                    <option>B+</option>
                                    <option>AB+</option>
                                    <option>A-</option>
                                    <option>B-</option>
                                    <option>O-</option>
                                    <option>AB-</option>

                                </select>

                            </div>

                            <!-- Gender -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Gender
                                </label>

                                <select
                                    name="Gender"
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option>Male</option>
                                    <option>Female</option>

                                </select>

                            </div>

                            <!-- Admin -->
                            <div>

                                <label class="block font-semibold mb-2">
                                    Admin
                                </label>

                                <select
                                    name="ysnAdmin"
                                    class="w-full border rounded-lg px-4 py-2">

                                    <option value="0">No</option>
                                    <option value="1">Yes</option>

                                </select>

                            </div>            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium mb-1">Status</label>
                                <select
                                    name="ysnactive"
                                    class="w-full border rounded-lg px-3 py-2">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <!-- Inactive Reason -->
                            <div>
                                <label class="block text-sm font-medium mb-1">
                                    Inactive Reason
                                </label>

                                <input
                                    type="text"
                                    name="inactiveReason"
                                    class="w-full border rounded-lg px-3 py-2"
                                    placeholder="Inactive Reason">
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">
                                    Employee Image
                                </label>

                                <input
                                    type="file"
                                    name="image_file"
                                    class="w-full border rounded-lg px-3 py-2">
                            </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-8 pt-6">

            <a href="{{ route('employees.index') }}"
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

                Save Employee

            </button>

        </div>

    </form>

</div>

@endsection