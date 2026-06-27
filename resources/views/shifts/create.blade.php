@extends('layouts.master')

@section('content')

<div class="w-full">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Add Shift
            </h1>

            <p class="text-slate-500 mt-1">
                Create a New SHift
            </p>
        </div>

        <a href="{{ route('shifts.index') }}"
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

<form action="{{ route('shifts.store') }}"
      method="POST">

    @csrf

    <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full">

        <!-- Header -->
        <div class="bg-slate-800 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">
                Shift Information
            </h2>
        </div>

        <!-- Body -->
        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Shift Name -->
                <div>
                    <label class="block font-semibold mb-2">
                        Shift Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="shiftName"
                        value="{{ old('shiftName') }}"
                        required
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

                    @error('shiftName')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Start Time -->
                <div>
                    <label class="block font-semibold mb-2">
                        Start Time <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="time"
                        name="startTime"
                        value="{{ old('startTime') }}"
                        required
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

                    @error('startTime')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Working Hour -->
                <div>
                    <label class="block font-semibold mb-2">
                        Working Hour
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="workinghour"
                        value="{{ old('workinghour') }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                        placeholder="8.00">

                    @error('workinghour')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Day Start -->
                <div>
                    <label class="block font-semibold mb-2">
                        Day Start
                    </label>

                    <input
                        type="time"
                        name="daystart"
                        value="{{ old('daystart') }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

                    @error('daystart')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Day Hour -->
                <div>
                    <label class="block font-semibold mb-2">
                        Day Hour
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="dayhour"
                        value="{{ old('dayhour') }}"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                        placeholder="24.00">

                    @error('dayhour')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-semibold mb-2">
                        Status
                    </label>

                    <select
                        name="ysnActive"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

                        <option value="1" {{ old('ysnActive',1)=='1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('ysnActive')=='0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('ysnActive')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

            </div>

        </div>

    </div>

    <!-- Buttons -->
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
            class="px-8 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Save Shift
        </button>

    </div>

</form>



</div>

@endsection