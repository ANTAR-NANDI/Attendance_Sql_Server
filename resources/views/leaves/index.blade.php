@extends('layouts.master')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Leave Management
            </h1>

            <p class="text-sm text-slate-500">
                Manage Leave information
            </p>
        </div>

        <a href="{{ route('leaves.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">

            <span>+</span>
            <span>Add Leave</span>

        </a>

    </div>

    {{-- Search --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

        <form method="GET" action="{{ route('leaves.index') }}">

            <div class="flex flex-col lg:flex-row gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search Leave Type"
                    class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                    Search
                </button>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                            SL
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                            Leave Type
                        </th>
                         <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                            From Date
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                            To Date
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                            Remarks
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                            Status
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-200">

@forelse($leaves as $leave)

<tr>

    <td class="px-4 py-2">
        {{ $loop->iteration }}
    </td>

    <td class="px-4 py-2">
        {{ $leave->name }}
    </td>

    <td class="px-4 py-2">
        {{ \Carbon\Carbon::parse($leave->leave_from)->format('d M Y') }}
    </td>

    <td class="px-4 py-2">
        {{ \Carbon\Carbon::parse($leave->leave_to)->format('d M Y') }}
    </td>

   

    <td class="px-4 py-2">
        {{ $leave->reason }}
    </td>

    <td class="px-4 py-2">

        @if($leave->status=='Approved')

            <span class="px-2 py-1 bg-green-100 text-green-700 rounded">
                Approved
            </span>

        @elseif($leave->status=='Rejected')

            <span class="px-2 py-1 bg-red-100 text-red-700 rounded">
                Rejected
            </span>

        @else

            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">
                Pending
            </span>

        @endif

    </td>

    <td class="px-4 py-3">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('leaves.edit', $leave->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('leaves.destroy', $leave->id) }}"
                                      onsubmit="return confirm('Delete this Leave Type?')">

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

    <td colspan="8" class="text-center py-8 text-slate-500">

        No Leave History Found

    </td>

</tr>

@endforelse

</tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    @if($leaves->hasPages())

        <div class="bg-white rounded-xl shadow border border-slate-200 p-4">

            {{ $leaves->withQueryString()->links() }}

        </div>

    @endif

</div>

@endsection