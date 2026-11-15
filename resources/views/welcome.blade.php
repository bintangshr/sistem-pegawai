@php
use App\Models\Employee;

$totalPegawai = Employee::count();
$totalLaki = Employee::where('jenis_kelamin', 'Laki-laki')->count();
$totalPerempuan = Employee::where('jenis_kelamin', 'Perempuan')->count();
$totalSarjana = Employee::whereIn('pendidikan_terakhir', ['D4/S1', 'S2', 'S3'])->count();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS — Sistem Informasi Manajemen Pegawai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col justify-between relative overflow-x-hidden">

    <!-- Background Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-indigo-600/20 blur-[120px] rounded-full pointer-events-none"></div>

    <!-- Navbar -->
    <header class="relative z-10 border-b border-slate-800/80 bg-slate-950/70 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/30">
                    SP
                </div>
                <span class="font-bold text-lg tracking-tight text-white">Sistem<span class="text-indigo-400">Pegawai</span></span>
            </div>
            <a href="{{ url('/admin') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-sm font-semibold text-white transition shadow-md shadow-indigo-600/20">
                Masuk Dashboard
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                </svg>
            </a>
        </div>
    </header>

    <!-- Main Hero Section -->
    <main class="relative z-10 max-w-6xl mx-auto px-6 py-16 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-medium mb-6">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            Database Terhubung • Data Real-Time
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white max-w-3xl mx-auto leading-tight">
            Kelola Data & Analitik <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">SDM Pegawai</span> Secara Terpusat
        </h1>

        <p class="mt-5 text-slate-400 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
            Platform manajemen kepegawaian terintegrasi untuk memantau demografi usia, jenjang pendidikan, dan distribusi tenaga kerja secara akurat.
        </p>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ url('/admin') }}" class="px-6 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-semibold text-white transition shadow-xl shadow-indigo-600/25">
                Buka Panel Admin
            </a>
            <a href="{{ url('/admin/employees') }}" class="px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 font-semibold text-slate-200 transition">
                Lihat Direktori Pegawai
            </a>
        </div>

        <!-- Live Stats Grid -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 text-left">
            <div class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 backdrop-blur-sm">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Total Pegawai Aktif</p>
                <p class="mt-2 text-3xl font-extrabold text-white">{{ $totalPegawai }}</p>
                <p class="mt-1 text-xs text-emerald-400">Tercatat dalam sistem</p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 backdrop-blur-sm">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Pegawai Laki-laki</p>
                <p class="mt-2 text-3xl font-extrabold text-indigo-400">{{ $totalLaki }}</p>
                <p class="mt-1 text-xs text-slate-500">{{ $totalPegawai > 0 ? round(($totalLaki / $totalPegawai) * 100) : 0 }}% dari total SDM</p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 backdrop-blur-sm">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Pegawai Perempuan</p>
                <p class="mt-2 text-3xl font-extrabold text-cyan-400">{{ $totalPerempuan }}</p>
                <p class="mt-1 text-xs text-slate-500">{{ $totalPegawai > 0 ? round(($totalPerempuan / $totalPegawai) * 100) : 0 }}% dari total SDM</p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 backdrop-blur-sm">
                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Lulusan Sarjana (S1–S3)</p>
                <p class="mt-2 text-3xl font-extrabold text-emerald-400">{{ $totalSarjana }}</p>
                <p class="mt-1 text-xs text-slate-500">Kualifikasi pendidikan tinggi</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-slate-900 py-6 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} Sistem Informasi Manajemen Pegawai. Dibangun dengan Laravel & Filament.
    </footer>

</body>

</html>