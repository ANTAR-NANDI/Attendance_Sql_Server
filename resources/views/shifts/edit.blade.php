@extends('layouts.master')

@section('content')

<div class="w-full">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">

            <h2 class="text-xl font-semibold">
                Edit Shift
            </h2>

            <a href="{{ route('shifts.index') }}"
               class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                Back
            </a>

        </div>

        <form action="{{ route('shifts.update',$shift->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full">
        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Shift Name -->
                <div>
                    <label class="block font-semibold mb-2">
                        Shift Name
                    </label>

                    <input
                        type="text"
                        name="shiftName"
                        value="{{ old('shiftName',$shift->shiftName) }}"
                        required
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Start Time -->
                <div>
                    <label class="block font-semibold mb-2">
                        Start Time
                    </label>

                    <input
                        type="time"
                        name="startTime"
                        value="{{ old('startTime',$shift->startTime) }}"
                        required
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Working Hour -->
                <div>
                    <label class="block font-semibold mb-2">
                        Working Hour
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="workinghour"
                        value="{{ old('workinghour',$shift->workinghour) }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Day Start -->
                <div>
                    <label class="block font-semibold mb-2">
                        Day Start
                    </label>

                    <input
                        type="time"
                        name="daystart"
                        value="{{ old('daystart',$shift->daystart) }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Day Hour -->
                <div>
                    <label class="block font-semibold mb-2">
                        Day Hour
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="dayhour"
                        value="{{ old('dayhour',$shift->dayhour) }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="ysnActive"
                        class="w-full border rounded-lg px-4 py-2">

                        <option value="1"
                            {{ old('ysnActive',$shift->ysnActive)==1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('ysnActive',$shift->ysnActive)==0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

            </div>

        </div>

    </div>

    <div class="flex justify-end gap-3 mt-8">

        <a href="{{ route('shifts.index') }}"
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
            Update Shift
        </button>

    </div>

</form>

    </div>

</div>

@endsection