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
            <span>SQL Server Pipeline Live</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">✓</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Present Today</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-present">--</div>
                <div class="text-[10px] text-slate-400 font-medium">via sprDailyAttendance</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl font-bold">𐄂</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Absent</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-absent">--</div>
                <div class="text-[10px] text-slate-400 font-medium">Calculated Absenteeism</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">⚠️</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Late Deviations</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-late">--</div>
                <div class="text-[10px] text-slate-400 font-medium">via tblGlobal rules</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">✉</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Approved Leave</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-leave">--</div>
                <div class="text-[10px] text-slate-400 font-medium">via spr_employee_Leave_table</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl font-bold">⏱</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Active Shifts</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-shifts">--</div>
                <div class="text-[10px] text-slate-400 font-medium">Mapped from tblShift</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">⏰</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Overtime (OT) Hours</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-ot">--</div>
                <div class="text-[10px] text-slate-400 font-medium">Calculated Live Minutes</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl font-bold">📅</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Holidays Defined</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-holidays">--</div>
                <div class="text-[10px] text-slate-400 font-medium">via tblHolidaySetup</div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-xl font-bold">🔄</div>
            <div>
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">ZKT Logs Pending</div>
                <div class="text-2xl font-black text-slate-900 mt-0.5" id="metric-raw-data">--</div>
                <div class="text-[10px] text-slate-400 font-medium">tblTADwnloadedRawData</div>
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
                <div class="flex items-center space-x-3 text-slate-700">
                    <span class="text-indigo-600">⚡</span>
                    <span>Phase 2: Master Management UI Shell Frame & Dynamic AJAX Employee Processing</span>
                </div>
                <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 px-2 py-0.5 rounded text-[10px] font-bold">In Progress</span>
            </div>
        </div>
    </div>

</div>

<script>
    function refreshDashboardMetrics() {
        fetch('/api/dashboard/metrics')
            .then(res => res.json())
            .then(data => {
                document.getElementById('metric-present').innerText   = data.present   ?? '0';
                document.getElementById('metric-absent').innerText    = data.absent    ?? '0';
                document.getElementById('metric-late').innerText      = data.late      ?? '0';
                document.getElementById('metric-leave').innerText     = data.leave     ?? '0';
                document.getElementById('metric-shifts').innerText    = data.shifts    ?? '0';
                document.getElementById('metric-ot').innerText        = data.ot_hours  ?? '0';
                document.getElementById('metric-holidays').innerText  = data.holidays  ?? '0';
                document.getElementById('metric-raw-data').innerText  = data.raw_count ?? '0';
            })
            .catch(err => console.error('Metrics sync failure:', err));
    }

    // Auto update metrics display every 30 seconds to provide active live tracking
    setInterval(refreshDashboardMetrics, 30000);
    // Execute on initial DOM completion step
    document.addEventListener('DOMContentLoaded', refreshDashboardMetrics);
</script>
@endsection