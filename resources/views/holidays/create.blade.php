@extends('layouts.master')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Create Holiday
            </h1>

            <p class="text-sm text-slate-500">
                Add new holiday information
            </p>
        </div>

        <a href="{{ route('holidays.index') }}"
           class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg shadow">

            Back

        </a>

    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-6">

        <form action="{{ route('holidays.store') }}" method="POST" class="space-y-5">

            @csrf

            {{-- Holiday Name --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Holiday Name
                </label>

                <input type="text"
                       name="HolidayName"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Enter holiday name"
                       required>
            </div>

            {{-- Holiday Date --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Holiday Date
                </label>

                <input type="date"
                       name="holidaydate"
                       class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       required>
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Type
                </label>

                <select name="type"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    <option value="national">National</option>
                    <option value="company">Company</option>
                    <option value="optional">Optional</option>

                </select>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Description
                </label>

                <textarea name="strDescription"
                          rows="3"
                          class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                          placeholder="Enter description"></textarea>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-2">

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">

                    Save Holiday

                </button>

                <a href="{{ route('holidays.index') }}"
                   class="bg-slate-500 hover:bg-slate-600 text-white px-5 py-2 rounded-lg shadow">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection