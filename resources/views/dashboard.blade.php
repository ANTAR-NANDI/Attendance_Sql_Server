@extends('layouts.master')

@section('content')
<div class="space-y-6">
    
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-xs flex justify-between items-center">
        <div>
            <h3 class="text-xl font-black text-slate-900 tracking-tight">Operational Control Panel</h3>
            <p class="text-xs font-medium text-slate-400 mt-0.5">Interface Target: Active instance connection <span class="text-slate-600 font-semibold">[HRM_Attendance_System]</span></p>
        </div>
        <div class="bg-indigo-50 text-indigo-700 px-3 py-1.5 rounded-xl text-xs font-bold border border-indigo-100 flex items-center space-x-1.5">
            <span class="h-1.5 w-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
            <span>Pipeline Verified</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">✓</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Present Today</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5">--</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl font-bold">𐄂</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Absent</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5">--</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">⚠️</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Late Deviations</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5">--</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">✉</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Approved Leave</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5">--</div>
            </div>
        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/70 p-5">
            <h4 class="font-bold text-sm text-slate-900 uppercase tracking-wider">System Implementation Blueprint Roadmap</h4>
        </div>
        <div class="p-5 divide-y divide-slate-100 text-xs font-semibold text-slate-600">
            <div class="pb-3 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-emerald-500 font-bold">✔</span>
                    <span>Phase 1: Native SQL Server Integration Framework & Custom Security Layer</span>
                </div>
                <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded text-[10px] font-bold">Active</span>
            </div>
            <div class="py-3 flex items-center justify-between">
                <div class="flex items-center space-x-3 text-slate-400">
                    <span>⚡</span>
                    <span>Phase 2: Registry Master Management (Branches, Departments, Designations)</span>
                </div>
                <span class="bg-slate-100 text-slate-500 border border-slate-200 px-2 py-0.5 rounded text-[10px] font-bold">Pending View Construction</span>
            </div>
        </div>
    </div>

</div>
@endsection