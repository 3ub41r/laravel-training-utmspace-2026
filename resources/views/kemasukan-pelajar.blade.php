@extends('app')

@section('title', 'Kemasukan Pelajar')

@section('content')
<section class="content-area">
    <div class="content-header">
        <h1 class="content-title">Kemasukan Pelajar</h1>
        <p class="content-subtitle">Statistik pelajar baharu mengikut program, fakulti, dan sesi pengambilan.</p>
    </div>




    <form action="{{ route('kemasukan-pelajar') }}" method="GET" class="w-full mb-10 flex flex-wrap gap-4">

        {{-- Course Level Filter --}}
        <div class="flex-1 min-w-[150px]">
            <select name="courseLevel" id="courseLevel"
                class="block w-full py-2 px-3 pr-10 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                <option value="">-- Semua Produk --</option>
                @foreach($courseLevels as $level)
                <option value="{{ $level }}" {{ $level == $courseLevel ? 'selected' : '' }}>
                    {{ $level }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Semester Filter --}}
        <div class="flex-1 min-w-[150px]">
            <select name="semesterName" id="semester"
                class="block w-full py-2 px-3 pr-10 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                <option value="">-- Semua Sesi Pengambilan --</option>
                @foreach($semesters as $semester)
                <option value="{{ $semester }}" {{ $semester == $semesterName ? 'selected' : '' }}>
                    {{ $semester }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Submit Button --}}
        <div class="flex-none">
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow
               hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                Filter
            </button>
        </div>

    </form>




    <p class="mb-8">Statistik <span class="font-bold">{{ $courseLevel ?? 'Semua Produk'}}</span> Bagi Pengambilan <span class="font-bold"> {{ $semesterName ?? 'Semua Sesi Pengambilan' }}</span></p>

    <div class="stats-grid">



        <div class="stat-card">
            <div class="stat-number">
                {{ $registered }}
                <span class="stat-label">
                    Orang Pelajar Telah Mendaftar Pengajian
                </span>
            </div>

        </div>

    </div>

    <div id="page-content">

        <div class="flex flex-wrap gap-6 mt-10">
            <!-- Card 1 -->
            <div class="flex-1 min-w-[300px] md:w-6/12">
                <div class="bg-white shadow-lg rounded-lg p-6 h-full">
                    <h2 class="text-lg font-semibold mb-3">Jantina</h2>
                    <div id="jantina" style="width: 100%; max-width: 400px; height: 400px; margin: auto;"></div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="flex-1 min-w-[300px] md:w-6/12">
                <div class="bg-white shadow-lg rounded-lg p-6 h-full">
                    <h2 class="text-lg font-semibold mb-3">Status Perkahwinan</h2>
                    <div id="perkahwinan" style="width: 100%; height: 400px;"></div>     
            </div>
        </div>

        <div class="w-full mt-10">
            <div class="bg-white shadow-lg rounded-lg p-6 h-full">
                <h2 class="text-lg font-semibold mb-3">Kelayakan Akademik</h2>
                <div id="columnchart_values" style="width: 100%; height: 100%;"></div>
            </div>
        </div>







        <div class="w-full mt-10">
            <div class="bg-white shadow-lg rounded-lg p-4 w-full">
                <h2 class="text-lg font-semibold mb-3">Program</h2>

                <input
                    type="text"
                    id="programSearch"
                    placeholder="Carian..."
                    class="mb-4 p-2 border border-gray-300 rounded w-full text-sm">

                <table id="programTable" class="min-w-full text-xs text-left text-gray-900 border border-gray-300">
                    <thead style="background: #5b74af; color: white; text-transform: uppercase;">
                        <tr>
                            <th class="px-4 py-1 border border-gray-300 text-center">Bil</th>
                            <th class="px-4 py-1 border border-gray-300">Program</th>
                            <th class="px-4 py-1 border border-gray-300 text-center">Jumlah</th>
                            <th class="px-4 py-1 border border-gray-300 text-center">Peratus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        $totalKeseluruhan = $courses->sum();
                        $courses = $courses->sortDesc(); // susun ikut nilai dari besar ke kecil
                        @endphp


                        @foreach($courses as $course => $total)
                        @php
                        // Kira peratus — elak bahagi dengan 0
                        $peratus = $totalKeseluruhan > 0 ? number_format(($total / $totalKeseluruhan) * 100, 2) . '%' : '0%';
                        @endphp
                        <tr class="hover:bg-gray-300">
                            <td class="px-4 py-1 border border-gray-300 text-center">{{ $no++ }}</td>
                            <td class="px-4 py-1 border border-gray-300">{{ $course ? ucwords(strtolower($course)) : 'Tiada Data' }}</td>
                            <td class="px-4 py-1 text-gray-900 border border-gray-300 text-center font-bold" style="background: #eef1f7;">{{ $total }}</td>
                            <td class="px-4 py-1 text-gray-900 border border-gray-300 text-center font-bold" style="background: #dee3ef;">{{ $peratus }}</td>
                        </tr>
                        @endforeach

                        {{-- Jumlah Keseluruhan --}}
                        <tr class="font-semibold" style="background: #5b74af; color: white; text-transform: uppercase;">
                            <td colspan="2" class="px-4 py-1 border border-gray-300 text-right uppercase">Jumlah Keseluruhan Pelajar</td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-bold">{{ $totalKeseluruhan }}</td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-bold">100%</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>


        <div class="w-full mt-10">
            <div class="bg-white shadow-lg rounded-lg p-4 w-full">
                <h2 class="text-lg font-semibold mb-3">Fakulti</h2>

                <input
                    type="text"
                    id="facultySearch"
                    placeholder="Carian..."
                    class="mb-4 p-2 border border-gray-300 rounded w-full text-sm">

                <table id="facultyTable" class="min-w-full text-xs text-left text-gray-900 border border-gray-300">
                    <thead style="background: #5b74af; color: white; text-transform: uppercase;">
                        <tr>
                            <th class="px-4 py-1 border border-gray-300 text-center">Bil</th>
                            <th class="px-4 py-1 border border-gray-300">Program</th>
                            <th class="px-4 py-1 border border-gray-300 text-center">Jumlah</th>
                            <th class="px-4 py-1 border border-gray-300 text-center">Peratus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        // Susun dari jumlah pelajar tertinggi ke terendah
                        $faculties = $faculties->sortDesc();
                        // Jumlah keseluruhan pelajar
                        $totalKeseluruhan = $faculties->sum();
                        @endphp

                        @foreach($faculties as $faculty => $total)
                        @php
                        // Kira peratus (elak bahagi dengan 0)
                        $peratus = $totalKeseluruhan > 0
                        ? number_format(($total / $totalKeseluruhan) * 100, 2) . '%'
                        : '0%';
                        @endphp

                        <tr class="hover:bg-gray-300">
                            <td class="px-4 py-1 border border-gray-300 text-center">{{ $no++ }}</td>
                            <td class="px-4 py-1 border border-gray-300">
                                {{ $faculty ? ucwords(strtolower($faculty)) : 'Tiada Data' }}
                            </td>
                            <td class="px-4 py-1 text-gray-900 border border-gray-300 text-center font-bold" style="background: #eef1f7;">
                                {{ $total }}
                            </td>
                            <td class="px-4 py-1 text-gray-900 border border-gray-300 text-center font-bold" style="background: #dee3ef;">
                                {{ $peratus }}
                            </td>
                        </tr>
                        @endforeach

                        {{-- Jumlah Keseluruhan --}}
                        <tr class="font-semibold" style="background: #5b74af; color: white; text-transform: uppercase;">
                            <td colspan="2" class="px-4 py-1 border border-gray-300 text-right uppercase">
                                Jumlah Keseluruhan
                            </td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-bold">
                                {{ $totalKeseluruhan }}
                            </td>
                            <td class="px-4 py-1 border border-gray-300 text-center font-bold">
                                100%
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>



    </div>
</section>
@endsection

@push('scripts')
@include('scripts.kemasukan-pelajar')
@endpush