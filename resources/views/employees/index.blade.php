@extends('layouts.master')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Employee Management
            </h1>

            <p class="text-sm text-slate-500">
                Manage all employee information
            </p>
        </div>

        <a href="{{ route('employees.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">

            <span>+</span>

            <span>Add Employee</span>

        </a>

    </div>

    {{-- Search --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 p-5">

        <form method="GET"
              action="{{ route('employees.index') }}">

            <div class="flex flex-col lg:flex-row gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by Name, Department, Designation, Shift, UserID"
                    class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">

                    Search

                </button>

            </div>

        </form>

    </div>

    {{-- Employee Table --}}
    <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-100">

                <tr>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        SL
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        User ID
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        Card No
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        Name
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        Department
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        Designation
                    </th>

                    <th class="px-4 py-3 text-left text-xs font-bold uppercase">
                        Shift
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                        Status
                    </th>

                    <th class="px-4 py-3 text-center text-xs font-bold uppercase">
                        Action
                    </th>

                </tr>

                </thead>

                <tbody class="divide-y divide-slate-200">

                @forelse($employees as $employee)

                    <tr class="hover:bg-slate-50">

                        <td class="px-4 py-3">
                            {{ $employees->firstItem()+$loop->index }}
                        </td>

                        <td class="px-4 py-3 font-semibold">
                            {{ $employee->User_id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $employee->card_number }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $employee->strName }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $employee->departmentName }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $employee->designation }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $employee->shiftName }}
                        </td>

                        <td class="px-4 py-3 text-center">

                            @if($employee->ysnactive)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    Active
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('employees.edit',$employee->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">

                                    Edit

                                </a>

                                <form method="POST"
                                      action="{{ route('employees.destroy',$employee->id) }}"
                                      onsubmit="return confirm('Delete this employee?')">

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

                            No Employees Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    @if($employees->hasPages())

        <div class="bg-white rounded-xl shadow border border-slate-200 p-4">

            {{ $employees->withQueryString()->links() }}

        </div>

    @endif

</div>

@endsection