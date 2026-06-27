<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Enterprise HRM')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @stack('styles')
</head>

<body class="h-full bg-slate-100 text-slate-800 antialiased">

@auth

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div class="flex flex-1 flex-col overflow-hidden">

        {{-- Topbar --}}
        @include('partials.topbar')

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto p-6">

            @if(session('success'))
                <div class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 rounded-lg border border-red-300 bg-red-100 px-4 py-3 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-300 bg-red-100 p-4">
                    <ul class="list-disc pl-5 text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>

        {{-- Footer --}}
        @include('partials.footer')

    </div>

</div>

@else

<div class="flex min-h-screen items-center justify-center bg-slate-100">

    @yield('content')

</div>

@endauth

@stack('scripts')

</body>
</html>