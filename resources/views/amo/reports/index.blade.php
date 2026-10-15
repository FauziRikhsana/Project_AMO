@extends('layouts.app')

@section('title', 'Reports')

@section('content')

<div class="page-header">
    <h1>Reports</h1>

    <p>
        Pilih folder laporan berdasarkan template form.
    </p>
</div>


{{-- SEARCH --}}
<div class="search-container">

    <form method="GET" action="{{ route('amo.reports.index') }}">

        <div class="search-box">

            <span class="search-icon">🔍</span>

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari berdasarkan kode, nama, atau deskripsi..."
            >

            @if(!empty($search))

                <a
                    href="{{ route('amo.reports.index') }}"
                    class="btn-clear-search"
                >
                    ✕
                </a>

            @endif

            <button
                type="submit"
                class="btn-search"
            >
                Cari
            </button>

        </div>

    </form>

</div>


<div class="reports-grid">

    @forelse ($templates as $template)

        <div class="report-folder">

            <div class="folder-icon">
                📁
            </div>

            <div class="folder-content">

                <div class="folder-code">
                    {{ $template->form_code }}
                </div>

                <h2>
                    {{ $template->name }}
                </h2>

                <p class="folder-description">
                    {{ $template->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="folder-bottom">

                    <span class="report-count">

                        {{ $template->submissions_count }}

                        {{ $template->submissions_count == 1 ? 'Report' : 'Reports' }}

                    </span>


                    <a
                        href="{{ route('amo.reports.folder', $template) }}"
                        class="btn-open-folder"
                    >
                        Buka Folder →
                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                🔍
            </div>

            @if(!empty($search))

                <h2>
                    Template tidak ditemukan
                </h2>

                <p>
                    Tidak ada template yang cocok dengan pencarian
                    "<strong>{{ $search }}</strong>".
                </p>

                <a
                    href="{{ route('amo.reports.index') }}"
                    class="btn-create-report"
                >
                    Tampilkan Semua Template
                </a>

            @else

                <h2>
                    Belum ada template
                </h2>

                <p>
                    Belum terdapat template form yang aktif.
                </p>

                <a
                    href="{{ route('amo.forms.index') }}"
                    class="btn-create-report"
                >
                    Buat Report
                </a>

            @endif

        </div>

    @endforelse

</div>


<style>

/* =========================
   SEARCH
========================= */

.search-container {
    margin-bottom: 24px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;

    background: #ffffff;

    border: 1px solid #e5e7eb;
    border-radius: 10px;

    padding: 7px 8px 7px 14px;
}

.search-icon {
    font-size: 17px;
}

.search-box input {
    flex: 1;

    border: none;
    outline: none;

    font-size: 14px;

    color: #111827;

    background: transparent;
}

.search-box input::placeholder {
    color: #9ca3af;
}

.btn-search {
    border: none;

    padding: 9px 16px;

    background: #111827;
    color: #ffffff;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;
}

.btn-search:hover {
    background: #374151;
}

.btn-clear-search {
    color: #6b7280;

    text-decoration: none;

    font-size: 14px;

    padding: 5px;
}

.btn-clear-search:hover {
    color: #111827;
}


/* =========================
   REPORT GRID
========================= */

.reports-grid {
    display: grid;

    grid-template-columns:
        repeat(auto-fill, minmax(330px, 1fr));

    gap: 20px;
}

.report-folder {
    background: #ffffff;

    border: 1px solid #e5e7eb;

    border-radius: 14px;

    padding: 24px;

    display: flex;

    gap: 18px;

    transition: 0.2s;
}

.report-folder:hover {
    border-color: #cbd5e1;

    box-shadow:
        0 8px 25px rgba(15, 23, 42, 0.08);

    transform: translateY(-2px);
}

.folder-icon {
    width: 55px;
    height: 55px;

    min-width: 55px;

    border-radius: 12px;

    background: #f1f5f9;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 28px;
}

.folder-content {
    flex: 1;

    min-width: 0;
}

.folder-code {
    font-size: 12px;

    font-weight: 700;

    color: #64748b;

    margin-bottom: 5px;
}

.folder-content h2 {
    margin: 0 0 8px;

    font-size: 18px;

    color: #111827;
}

.folder-description {
    margin: 0 0 18px;

    color: #6b7280;

    font-size: 13px;

    line-height: 1.5;
}

.folder-bottom {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;
}

.report-count {
    font-size: 13px;

    font-weight: 600;

    color: #64748b;
}

.btn-open-folder {
    display: inline-block;

    padding: 9px 14px;

    background: #111827;

    color: white;

    text-decoration: none;

    border-radius: 8px;

    font-size: 13px;

    font-weight: 600;
}

.btn-open-folder:hover {
    background: #374151;
}


/* =========================
   EMPTY STATE
========================= */

.empty-state {
    grid-column: 1 / -1;

    background: white;

    border: 1px dashed #d1d5db;

    border-radius: 14px;

    padding: 60px 20px;

    text-align: center;
}

.empty-icon {
    font-size: 40px;

    margin-bottom: 15px;
}

.empty-state h2 {
    margin: 0 0 8px;

    color: #1f2937;
}

.empty-state p {
    margin: 0;

    color: #6b7280;
}

.btn-create-report {
    display: inline-block;

    margin-top: 15px;

    padding: 10px 18px;

    background: #111827;

    color: white;

    text-decoration: none;

    border-radius: 8px;

    font-size: 13px;

    font-weight: 600;
}

.btn-create-report:hover {
    background: #374151;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {

    .reports-grid {
        grid-template-columns: 1fr;
    }

    .report-folder {
        padding: 20px;
    }

}

</style>

@endsection