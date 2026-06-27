@extends('layouts.master')

@section('content')

<div class="space-y-8">

    <div class="max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold text-slate-800 mb-8">
        HRM Dashboard
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Employees -->
        <div class="bg-white rounded-xl shadow border-l-4 border-blue-600 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Total Employees</p>

                    <h2 class="text-4xl font-bold text-blue-600 mt-2">
                        {{ $totalEmployees }}
                    </h2>
                </div>

                <div class="text-5xl">
                    👥
                </div>
            </div>
        </div>

        <!-- Departments -->
        <div class="bg-white rounded-xl shadow border-l-4 border-green-600 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Departments</p>

                    <h2 class="text-4xl font-bold text-green-600 mt-2">
                        {{ $totalDepartments }}
                    </h2>
                </div>

                <div class="text-5xl">
                    🏢
                </div>
            </div>
        </div>

        <!-- Leave Types -->
        <div class="bg-white rounded-xl shadow border-l-4 border-purple-600 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Leave Types</p>

                    <h2 class="text-4xl font-bold text-purple-600 mt-2">
                        {{ $totalLeaveTypes }}
                    </h2>
                </div>

                <div class="text-5xl">
                    📋
                </div>
            </div>
        </div>

        <!-- Pending Leave -->
        <div class="bg-white rounded-xl shadow border-l-4 border-red-600 p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm">Pending Leaves</p>

                    <h2 class="text-4xl font-bold text-red-600 mt-2">
                        {{ $pendingLeaves }}
                    </h2>
                </div>

                <div class="text-5xl">
                    ⏳
                </div>
            </div>
        </div>

    </div>

</div>


</div>

@endsection