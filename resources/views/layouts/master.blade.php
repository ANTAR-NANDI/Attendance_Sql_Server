<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise HRM & Attendance Matrix</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="h-full font-sans antialiased text-slate-900 selection:bg-indigo-500 selection:text-white">

    @auth
        <div class="flex h-screen overflow-hidden">
            
            @include('partials.sidebar')

            <div class="flex flex-col flex-1 min-w-0 bg-slate-50">
                
                @include('partials.topbar')

                <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                    @yield('content')
                </main>

                @include('partials.footer')
            </div>

        </div>
    @else
        <div class="min-h-screen flex items-center justify-center">
            @yield('content')
        </div>
    @endauth

</body>
</html>