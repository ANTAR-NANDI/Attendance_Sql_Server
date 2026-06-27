@extends('layouts.master')

@section('content')

<div class="w-full">

    <div class="bg-white rounded-xl shadow-lg">

        <div class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">

            <h2 class="text-xl font-semibold">
                Edit Designation
            </h2>

            <a href="{{ route('designations.index') }}"
               class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                Back
            </a>

        </div>

        <form
            action="{{ route('designations.update',$designation->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block font-semibold mb-2">Name</label>
                        <input
                            type="text"
                            name="strName"
                            value="{{ old('strName',$designation->designation) }}"
                            
                            class="w-full border rounded-lg px-4 py-2 bg-gray-100">
                    </div>

                    

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-8 border-t pt-6">

                    <a
                        href="{{ route('designations.index') }}"
                        class="px-6 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Update Designation
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection