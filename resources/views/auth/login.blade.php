<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sandana TrackFlow</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="h-full antialiased overflow-hidden bg-white">

    <div class="min-h-screen grid lg:grid-cols-12 bg-white">
        
        <div class="lg:col-span-5 flex flex-col justify-between p-8 sm:p-12 md:p-16 bg-white z-10 overflow-y-auto">
            
            <div class="flex items-center justify-between pt-2">
                <div class="flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-blue-900 rounded-full block"></span>
                    <div class="flex flex-col">
                        <span class="font-black text-blue-900 text-base tracking-wide leading-none">SAMATOR</span>
                        <span class="text-[10px] text-gray-400 font-semibold tracking-wider mt-0.5">HEALTHCARE</span>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md mx-auto my-auto py-10 space-y-7">
                
                <div>
                    <a href="/" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-blue-900 transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 transform group-hover:-translate-x-1 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Back to Home
                    </a>
                </div>

                <div class="space-y-1.5">
                    <h2 class="text-3xl font-black text-blue-900 tracking-tight">
                        Welcome Back
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">
                        Log in to your Samator Healthcare portal account.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-1">
                        <label for="email" class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block">Email Address</label>
                        
                        <input 
                            id="email" 
                            class="block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 transition-all duration-200 text-sm py-3 px-4 shadow-inner outline-none border" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username" 
                            placeholder="name@company.com" />
                        
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block">Password</label>
                            
                            @if (Route::has('password.request'))
                                <a class="text-xs text-blue-600 hover:text-blue-800 hover:underline transition font-semibold" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <input 
                            id="password" 
                            class="block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 transition-all duration-200 text-sm py-3 px-4 shadow-inner outline-none border"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••" />

                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group select-none">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-blue-900 shadow-sm focus:ring-blue-900/20 w-4 h-4 transition duration-150" 
                                name="remember">
                            <span class="ms-2.5 text-xs text-gray-500 group-hover:text-gray-700 transition font-medium">
                                Keep me logged in
                            </span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold text-sm py-3.5 px-4 rounded-xl shadow-lg shadow-blue-900/10 hover:shadow-xl hover:shadow-blue-900/20 transition-all duration-200 transform active:scale-[0.99] flex justify-center items-center tracking-wide">
                            Log In to Portal
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-left pt-4">
                <p class="text-[11px] text-gray-400 font-medium">
                    &copy; {{ date('Y') }} Sandana Samator Healthcare. All rights reserved.
                </p>
            </div>
        </div>

        <div class="hidden lg:block lg:col-span-7 relative bg-blue-950">
            <img 
                src="{{ asset('images/login-bg.jpg') }}" 
                alt="Samator Gas Industri" 
                class="absolute inset-0 w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-950/95 via-blue-900/80 to-blue-950/40 mix-blend-multiply"></div>
            
            <div class="absolute bottom-16 left-16 right-16 z-10 text-white space-y-3 max-w-lg">
                <span class="inline-block px-3 py-1 rounded-full bg-white/10 border border-white/10 backdrop-blur-md text-[10px] font-bold uppercase tracking-widest text-blue-200">
                    SaaS Platform
                </span>
                <h3 class="text-3xl font-black tracking-tight leading-tight">
                    Sandana <span class="text-blue-300 font-normal">TrackFlow</span>
                </h3>
                <p class="text-sm text-gray-300/90 leading-relaxed font-medium">
                    Efisiensi birokrasi, transparansi pelacakan, dan kemudahan persetujuan dokumen antar departemen dalam satu ekosistem digital terintegrasi.
                </p>
            </div>
        </div>

    </div>

</body>
</html>