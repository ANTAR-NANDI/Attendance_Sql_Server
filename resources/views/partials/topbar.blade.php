<header class="bg-white border-b border-slate-200 h-16 px-6 flex items-center justify-between shadow-sm shrink-0 z-10">
    <div class="text-xs font-semibold text-slate-400 tracking-wider uppercase flex items-center space-x-2">
        <span class="h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
        <span>System Date: <span class="text-slate-700 font-bold ml-1">{{ date('Y-m-d') }}</span></span>
    </div>

    <div class="flex items-center space-x-6">
        <div class="flex flex-col text-right">
            <span class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</span>
            <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest bg-slate-100 px-1.5 py-0.5 rounded mt-0.5">System Admin</span>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-white hover:bg-red-50 text-slate-600 hover:text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold border border-slate-200 hover:border-red-200 shadow-xs transition cursor-pointer">
                Sign Out
            </button>
        </form>
    </div>
</header>