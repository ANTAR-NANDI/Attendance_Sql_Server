@extends('layouts.master')

@section('content')

<div class="w-full">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Edit Leave Type
            </h1>

            <p class="text-slate-500 mt-1">
                Update Leave Type Information
            </p>
        </div>

        <a href="{{ route('leave_types.index') }}"
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

    <form action="{{ route('leave_types.update', $leave_type->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <!-- Card Header -->
            <div class="bg-slate-800 text-white px-6 py-4">

                <h2 class="text-lg font-semibold">
                    Leave Type Information
                </h2>

            </div>

            <!-- Card Body -->
            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Leave Type Name -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Leave Type Name
                        </label>

                        <input
                            type="text"
                            name="LeaveName"
                            value="{{ old('LeaveName', $leave_type->name) }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    </div>

                    <!-- Allowed Leave Days -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Allowed Leave Days
                        </label>

                        <input
                            type="number"
                            min="0"
                            name="AllowedDays"
                            value="{{ old('AllowedDays', $leave_type->days) }}"
                            required
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    </div>

                    <!-- Paid Status -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Paid Leave
                        </label>

                        <select
                            name="IsPaid"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                            <option value="1" {{ old('IsPaid', $leave_type->IsPaid) == 1 ? 'selected' : '' }}>
                                Yes (Paid)
                            </option>

                            <option value="0" {{ old('IsPaid', $leave_type->IsPaid) == 0 ? 'selected' : '' }}>
                                No (Unpaid)
                            </option>

                        </select>

                    </div>

                    <!-- Remarks -->
                    <div class="md:col-span-2">

                        <label class="block font-semibold mb-2">
                            Remarks / Details
                        </label>

                        <textarea
                            name="Remarks"
                            rows="4"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('Remarks', $leave_type->Remarks) }}</textarea>

                    </div>

                </div>

            </div>

        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-8">

            <a href="{{ route('leave_types.index') }}"
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
                class="px-8 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                Update Leave Type

            </button>

        </div>

    </form>

</div>

@endsection