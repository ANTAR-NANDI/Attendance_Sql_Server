@extends('layouts.master')

@section('content')

<div class="w-full">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Add Department
            </h1>

            <p class="text-slate-500 mt-1">
                Create a new Department
            </p>
        </div>

        <a href="{{ route('departments.index') }}"
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

    <form action="{{ route('departments.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full">

            <div class="bg-slate-800 text-white px-6 py-4">

                <h2 class="text-lg font-semibold">
                    Department Information
                </h2>

            </div>

            <div class="p-8 w-full">

                <div class="w-full">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>

                                <label class="block font-semibold mb-2">
                                    Department Name
                                </label>

                                <input
                                    type="text"
                                    name="strName"
                                    value="{{ old('strName') }}"
                                    required
                                    class="w-full border rounded-lg px-4 py-2">
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-8 pt-6">

            <a href="{{ route('departments.index') }}"
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

                Save Department

            </button>

        </div>

    </form>

</div>

@endsection