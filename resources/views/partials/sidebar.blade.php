<aside class="w-64 bg-slate-900 text-slate-300 flex flex-col h-full shadow-xl z-20">
    <div class="p-5 bg-slate-950 flex items-center border-b border-slate-800 h-16 shrink-0">
        <div class="flex items-center space-x-3">
            <div class="h-8 w-8 rounded-lg bg-indigo-600 flex items-center justify-center font-black text-white tracking-wider">H</div>
            <span class="text-lg font-bold tracking-wider text-white">HRM Core</span>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-lg text-sm font-semibold {{ Route::currentRouteName() == 'dashboard' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100 transition' }}">
            <span class="text-base">📊</span>
            <span>Dashboard</span>
        </a>
        
        <div  class="pt-5 pb-1 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Master Registry</div>
        <a onclick="window.location.href='{{ route('employees.index') }}'" href="#" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-100 transition">
            <span class="text-sm">🏢</span>
            <span>Employees</span>
        </a>
        <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-100 transition">
            <span class="text-sm">📁</span>
            <span>Departments</span>
        </a>
        <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-100 transition">
            <span class="text-sm">🎓</span>
            <span>Designations</span>
        </a>

        <div class="pt-5 pb-1 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Biometric Engines</div>
        <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-100 transition">
            <span class="text-sm">👥</span>
            <span>Employee Records</span>
        </a>
        <a href="#" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-100 transition">
            <span class="text-sm">⏱️</span>
            <span>Attendance Log</span>
        </a>
    </nav>
</aside>