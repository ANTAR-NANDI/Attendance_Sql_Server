<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Administration Control Workspace</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="h-full font-sans antialiased text-slate-900">

    @auth
        <header class="bg-slate-800 text-white h-14 px-6 flex items-center justify-between shadow-md">
            <div class="flex items-center space-x-3">
                <div class="h-7 w-7 rounded bg-indigo-600 flex items-center justify-center font-black text-sm">E</div>
                <span class="text-sm font-bold tracking-wide">Employee Setup Workspace</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-slate-300 font-semibold">Active: {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-slate-700 hover:bg-rose-700 text-white px-3 py-1 text-xs font-bold rounded transition cursor-pointer">
                        Sign Out
                    </button>
                </form>
            </div>
        </header>

        <main class="p-6">
            @yield('content')
        </main>
    @else
        <div class="min-h-screen flex items-center justify-center bg-slate-900">
            @yield('content')
        </div>
    @endauth

</body>
</html>