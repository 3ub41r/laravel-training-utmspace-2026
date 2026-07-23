@extends('app')

@section('title', 'Status Pelajar')

@section('content')
<section class="content-area">
    <div class="content-header">
        <h1 class="content-title">Status Pelajar</h1>
        <p class="content-subtitle">
            Jumlah pelajar aktif, tangguh, berhenti, tamat pengajian dan dibuang mengikut semester & program.
        </p>
    </div>

    <form action="{{ route('status-pelajar') }}" method="GET" class="w-full mb-10 flex flex-wrap gap-4">

        {{-- Course Level Filter --}}
        <div class="flex-1 min-w-[150px]">
            <select name="course" id="course"
                class="block w-full py-2 px-3 pr-10 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                <option value="">-- Semua Program --</option>
                @foreach($courses as $course)
                <option value="{{ $course->courseCode }}" @selected($course->courseCode == $selectedCourse)>
                    {{ $course->courseCode }} - {{ $course->courseNameBM }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Semester Filter --}}
        <div class="flex-1 min-w-[150px]">
            <select name="semester" id="semester"
                class="block w-full py-2 px-3 pr-10 rounded-lg border border-gray-300 bg-white text-gray-700 shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                <option value="">-- Semua Semester --</option>
                @foreach($semesters as $semester)
                <option value="{{ $semester->sesSemNo }}" @selected($semester->sesSemNo == $selectedSemester)>
                    {{ $semester->sesName }} {{ $semester->semNo }}
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




    <p class="mb-8">
        Statistik
        <span class="font-bold">{{ $courseLevel ?? 'Semua Program'}}</span>
        Bagi Semester
        <span class="font-bold"> {{ $semesterName ?? 'Semua Semester' }}</span>
    </p>

    <div class="stats-grid">



        <div class="stat-card">
            <div class="stat-number">
                {{ $registered }}
                <span class="stat-label">
                    Pelajar Aktif, Tangguh, Berhenti, Tamat Pengajian & Dibuang
                </span>
            </div>

        </div>

    </div>

    <div id="page-content">
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Bilangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stats as $stat)
                    <tr>
                        <td>{{ $stat->courseCode }}</td>
                        <td>{{ $stat->status }}</td>
                        <td>{{ $stat->jumlah }}</td>
                        <td>{{ $stat->kemasukan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex flex-wrap gap-6 mt-10">
            <!-- Card 1 -->
            <div class="flex-1 min-w-[300px] md:w-6/12">
                <div class="bg-white shadow-lg rounded-lg p-6 h-full">
                    <h2 class="text-lg font-semibold mb-3">Status</h2>
                    <canvas id="status-pie"></canvas>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="flex-1 min-w-[300px] md:w-6/12">
                <div class="bg-white shadow-lg rounded-lg p-6 h-full">
                    <h2 class="text-lg font-semibold mb-3">Status</h2>
                    <canvas id="status-bar"></canvas>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
{{-- @include('scripts.kemasukan-pelajar') --}}
<script>
    const ctx = document.getElementById('status-pie');

    const data = {
        labels: [
            'Aktif',
            'Tangguh',
            'Berhenti'
        ],
        datasets: [{
            label: 'Bilangan Pelajar',
            data: [
                {{ collect($stats)->where('status', 'A')->sum('jumlah') }},
                {{ collect($stats)->where('status', 'H')->sum('jumlah') }},
                {{ collect($stats)->where('status', 'E')->sum('jumlah') }}
            ],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            // hoverOffset: 4
        }]
    };

    const config = {
        type: 'pie',
        data: data,
    };

    new Chart(ctx, config);

    const ctxBar = document.getElementById('status-bar');

    const configBar = {
        type: 'bar',
        data: data,
    };

    new Chart(ctxBar, configBar);
</script>
@endpush