@extends('layouts.master')

@section('content')
<div class="w-full min-h-screen flex flex-col md:flex-row bg-white">
    
    <div class="hidden md:flex md:w-1/2 bg-gradient-to-tr from-slate-900 via-blue-950 to-indigo-950 justify-center items-center p-12 text-white relative overflow-hidden">
        <div class="z-10 max-w-md space-y-6">
            <div class="h-12 w-12 rounded-2xl bg-indigo-600 flex items-center justify-center font-black text-2xl shadow-xl shadow-indigo-600/30">H</div>
            <div class="space-y-2">
                <h1 class="text-4xl font-black tracking-tight leading-none">Enterprise HRM & Biometrics</h1>
                <p class="text-slate-400 text-base leading-relaxed">Precision corporate human resource governance, automated transactional leaves, and direct SQL server execution pipelines.</p>
            </div>
            <div class="inline-flex items-center space-x-3 text-xs text-indigo-200 bg-indigo-950/60 p-4 rounded-xl border border-indigo-800/40 backdrop-blur-xs">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="font-semibold tracking-wide">Biometric Engine: Operational & awaiting ZKT Network sync.</span>
            </div>
        </div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-indigo-600 rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>
        <div class="absolute -top-24 -right-24 w-80 h-80 bg-blue-500 rounded-full mix-blend-screen filter blur-3xl opacity-10"></div>
    </div>

    <div class="flex flex-1 items-center justify-center p-8 sm:p-16 bg-white">
        <div class="w-full max-w-sm space-y-8">
            <div class="space-y-2">
                <h2 class="text-3xl font-black text-slate-950 tracking-tight">System Access</h2>
                <p class="text-sm text-slate-500">Provide your organizational security credentials below.</p>
            </div>

            @if($errors->any())
                <div class="bg-rose-50 text-rose-700 p-4 rounded-xl border border-rose-100 text-xs font-semibold space-y-1 shadow-xs">
                    <div class="font-bold text-sm">Authentication Failed</div>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">Corporate Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="username@corporate.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:border-indigo-600 focus:bg-white text-sm shadow-xs transition duration-150">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">Security Password</label>
                    <input type="password" name="password" required placeholder="••••••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:outline-hidden focus:border-indigo-600 focus:bg-white text-sm shadow-xs transition duration-150">
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded-sm transition cursor-pointer">
                    <label Skinner for="remember" class="ml-2 block text-xs font-medium text-slate-600 select-none cursor-pointer">Maintain active user session</label>
                </div>

                <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-hidden transform active:scale-98 transition duration-150 cursor-pointer">
                    Sign In to Dashboard
                </button>
            </form>
        </div>
    </div>

</div>
@endsection