<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sandana TrackFlow</title>

    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    {{-- Navbar --}}
    <nav class="bg-white/90 backdrop-blur-md border-b border-gray-100 fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">

            <div class="flex items-center gap-2">
                <span class="w-1 h-5 bg-blue-900 rounded-full block"></span>
                <h1 class="font-bold text-blue-900 text-lg tracking-wide">
                    SAMATOR HEALTHCARE
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-blue-900 text-white rounded-xl hover:bg-blue-800 transition-all duration-200 font-medium text-xs tracking-wide shadow-md shadow-blue-900/10">
                    Login Portal
                </a>
            </div>

        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="pt-24 pb-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="relative overflow-hidden rounded-[30px] shadow-xl shadow-gray-200/80 min-h-[440px] flex items-center bg-blue-950">
                
                <img
                    src="{{ asset('images/login-bg.jpg') }}"
                    alt="Sandana TrackFlow"
                    class="absolute inset-0 w-full h-full object-cover object-right sm:object-center">
                
                <div class="absolute inset-0 bg-gradient-to-r from-blue-950 via-blue-950/80 to-transparent"></div>

                <div class="relative z-10 max-w-xl p-8 sm:p-14 text-white space-y-5">
                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight tracking-tight">
                        Sandana <span class="text-blue-300 font-medium">TrackFlow</span>
                    </h1>

                    <p class="text-sm sm:text-base text-gray-200/90 leading-relaxed font-normal">
                        Sistem digital terintegrasi untuk mempermudah proses
                        pengajuan, persetujuan, dan pelacakan dokumen
                        antar departemen secara efisien dan transparan.
                    </p>

                    <div class="pt-2 flex gap-3">
                        <a href="{{ route('login') }}"
                           class="bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs uppercase tracking-wider px-6 py-3.5 rounded-xl shadow-md shadow-blue-600/20 transition-all duration-200 transform active:scale-95">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold text-xs uppercase tracking-wider px-6 py-3.5 rounded-xl backdrop-blur-sm transition-all duration-200 transform active:scale-95">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DEPARTEMEN SISTEM SECTION --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12 space-y-1">
                <h2 class="text-3xl font-extrabold text-blue-900 tracking-tight">
                    Departemen Sistem
                </h2>
                <p class="text-blue-500/80 text-xs sm:text-sm font-medium tracking-wide">
                    Pilar utama integrasi operasional Samator Healthcare
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100 flex flex-col items-start transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 group">
                    <div class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 text-xs font-bold flex items-center justify-center mb-6 group-hover:bg-blue-900 group-hover:text-white transition-all duration-300">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 mb-2.5 tracking-tight">Sales & Marketing</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">
                        Bertanggung jawab dalam pengajuan permintaan proyek (BRD) dan koordinasi kebutuhan klien untuk diproses lebih lanjut oleh tim Finance.
                    </p>
                </div>

                <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100 flex flex-col items-start transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 group">
                    <div class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 mb-2.5 tracking-tight">Finance & Accounting</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">
                        Melakukan validasi anggaran, persetujuan biaya (Sign BRD), serta pembuatan invoice resmi berdasarkan Berita Acara dari tim Teknik.
                    </p>
                </div>

                <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100 flex flex-col items-start transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 group">
                    <div class="w-9 h-9 rounded-full bg-amber-50 text-amber-600 text-xs font-bold flex items-center justify-center mb-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 mb-2.5 tracking-tight">Engineering (Teknik)</h3>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">
                        Menganalisis teknis proyek, menjalankan instalasi di lapangan, dan menerbitkan Berita Acara (BA) sebagai syarat penagihan.
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- PROFIL DIREKTUR SECTION --}}
    <section class="py-14 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col items-center mb-14">
                <h2 class="text-2xl sm:text-3xl font-black text-blue-900 tracking-widest italic uppercase">
                    Profil Direktur
                </h2>
                <div class="w-56 h-[2px] bg-blue-900 mt-3.5 relative">
                    <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-2.5 h-2.5 bg-white border-2 border-blue-900 rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white rounded-[24px] overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1">
                    <div class="h-[320px] overflow-hidden bg-gray-50 p-2 pb-0">
                        <img src="{{ asset('images/Mingyu.png') }}" alt="Mingyu Abraham" class="w-full h-full object-cover rounded-t-[22px]">
                    </div>
                    <div class="p-5 text-center">
                        <h4 class="text-base font-bold text-blue-900 tracking-tight">Mingyu Abraham</h4>
                        <p class="text-[9px] font-bold text-blue-400 mt-1 uppercase tracking-[0.25em]">Managing Director</p>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1">
                    <div class="h-[320px] overflow-hidden bg-gray-50 p-2 pb-0">
                        <img src="{{ asset('images/shelvia.jpg') }}" alt="Shelvia Retha Sofiana" class="w-full h-full object-cover rounded-t-[22px]">
                    </div>
                    <div class="p-5 text-center">
                        <h4 class="text-base font-bold text-blue-900 tracking-tight">Shelvia Retha Sofiana</h4>
                        <p class="text-[9px] font-bold text-blue-400 mt-1 uppercase tracking-[0.25em]">Head of Finance</p>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1">
                    <div class="h-[320px] overflow-hidden bg-gray-50 p-2 pb-0">
                        <img src="{{ asset('images/nafiisha.jpg') }}" alt="Nafisha Nuurfatnina" class="w-full h-full object-cover rounded-t-[22px]">
                    </div>
                    <div class="p-5 text-center">
                        <h4 class="text-base font-bold text-blue-900 tracking-tight">Nafisha Nuurfatnina</h4>
                        <p class="text-[9px] font-bold text-blue-400 mt-1 uppercase tracking-[0.25em]">Head of Sales Marketing</p>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 hover:shadow-xl hover:shadow-blue-900/5 hover:-translate-y-1">
                    <div class="h-[320px] overflow-hidden bg-gray-50 p-2 pb-0">
                        <img src="{{ asset('images/nadia.jpg') }}" alt="Nadia Ardiyanti Sutrisno" class="w-full h-full object-cover rounded-t-[22px]">
                    </div>
                    <div class="p-5 text-center">
                        <h4 class="text-base font-bold text-blue-900 tracking-tight">Nadia Ardiyanti Sutrisno</h4>
                        <p class="text-[9px] font-bold text-blue-400 mt-1 uppercase tracking-[0.25em]">Head of Engineering</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-blue-950 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center space-y-2">
            <h3 class="font-bold text-base tracking-wider uppercase">Sandana TrackFlow</h3>
            <p class="text-xs text-blue-200/90 font-medium">Workflow Management System - Sandana Samator Healthcare</p>
            <div class="w-8 h-[1px] bg-blue-800 mx-auto my-3"></div>
            <p class="text-[11px] text-blue-300/60">© {{ date('Y') }} Sandana Samator Healthcare</p>
        </div>
    </footer>

</body>
</html>