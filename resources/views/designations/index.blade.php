@extends('layouts.master')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Designation Management
            </h1>

            <p class="text-sm text-slate-500">
                Manage all Designation information
            </p>
        </div>

        <a href="{{ route('designations.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">

            <span>+</span>

            <span>Add Designation</span>

        </a>

    </div>

    {{-- Search --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

        <form method="GET"
              action="{{ route('designations.index') }}">

            <div class="flex flex-col lg:flex-row gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by User ID, Card No or Name..."
                    class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">

                    Search

                </button>

            </div>

        </form>

    </div>

    {{-- Designation Table --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-100">

                <tr>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        SL
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        Name
                    </th>

                   
                    <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                        Action
                    </th>

                </tr>

                </thead>

                <tbody class="divide-y divide-slate-200">

                @forelse($designations as $designation)

                    <tr class="hover:bg-slate-50">

                        <td class="px-4 py-3">
                            {{ $designations->firstItem()+$loop->index }}
                        </td>


                        <td class="px-4 py-3">
                            {{ $designation->designation }}
                        </td>


                        <td class="px-4 py-3">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('designations.edit',$designation->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">

                                    Edit

                                </a>

                                <form method="POST"
                                      action="{{ route('designations.destroy',$designation->id) }}"
                                      onsubmit="return confirm('Delete this Designation?')">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9"
                            class="text-center py-10 text-slate-500">

                            No Designations Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    @if($designations->hasPages())

        <div class="bg-white rounded-xl shadow border border-slate-200 p-4">

            {{ $designations->withQueryString()->links() }}

        </div>

    @endif

</div>

@endsection