@extends('app')

@section('title', 'Tinjauan Akademik')

@section('content')

<main class="main-content">

    <div class="content-header">
        <h1 class="content-title">Tinjauan Akademik</h1>
        <p class="content-subtitle">Prestasi akademik semasa bagi tahun 2025. </p>
    </div>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="icon">👥</div> <!-- Jumlah Keseluruhan -->
            <div class="stat-value">0</div>
            <div class="stat-label">Jumlah Pelajar</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">🆕</div> <!-- Baharu -->
            <div class="stat-value">0</div>
            <div class="stat-label">Pelajar Baharu</div>
            <div class="stat-change negative">↓ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">📚</div> <!-- Aktif -->
            <div class="stat-value">0</div>
            <div class="stat-label">Pelajar Aktif</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">🎓</div> <!-- Graduan -->
            <div class="stat-value">0</div>
            <div class="stat-label">Pelajar Graduan</div>
            <div class="stat-change negative">↓ 0% dari tahun lepas</div>
        </div>



        <div class="stat-card">
            <div class="icon">⚠️</div> <!-- Berisiko -->
            <div class="stat-value">0%</div>
            <div class="stat-label">Pelajar Berisiko</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">🏅</div> <!-- Layak Anugerah Dekan -->
            <div class="stat-value">0%</div>
            <div class="stat-label">Pelajar Layak Anugerah Dekan</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">🌎</div> <!-- Pelajar Antarabangsa -->
            <div class="stat-value">0</div>
            <div class="stat-label">Pelajar Antarabangsa</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">✅</div> <!-- Kadar Kelulusan -->
            <div class="stat-value">0%</div>
            <div class="stat-label">Kadar Kelulusan</div>
            <div class="stat-change negative">↓ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">❌</div> <!-- Kadar Berhenti Belajar -->
            <div class="stat-value">0%</div>
            <div class="stat-label">Kadar Berhenti Belajar</div>
            <div class="stat-change negative">↓ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">🎯</div> <!-- Purata GPA -->
            <div class="stat-value">0</div>
            <div class="stat-label">Purata GPA</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>

        <div class="stat-card">
            <div class="icon">💰</div> <!-- Penerima Biasiswa -->
            <div class="stat-value">0</div>
            <div class="stat-label">Penerima Biasiswa</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>



        <div class="stat-card">
            <div class="icon">📝</div> <!-- Program -->
            <div class="stat-value">0</div>
            <div class="stat-label">Program</div>
            <div class="stat-change positive">↑ 0% dari tahun lepas</div>
        </div>


    </section>

    <section class="card-grid-two">
        <div class="card-two">
            <div class="card-title">
                Demografi Pelajar
            </div>
            <div class="card-subtitle">
                Mengikut Kelayakan Akademik
            </div>
        </div>
        <div class="card-two">
            <div class="card-title">
               Trend Pendaftaran Pelajar
            </div>
            <div class="card-subtitle">
                Bagi 5 Tahun Terakhir
            </div>
        </div>
    </section>


</main>








</section>
@endsection

@push('scripts')
@include('scripts.ringkasan-eksekutif')
@endpush