@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')

<div class="page-header">

    <h1>Dashboard</h1>

    <p>
        Selamat datang di MEDALI.
        Silakan gunakan menu yang tersedia
        untuk mengelola dokumen AMO.
    </p>

    <a
        href="{{ route('amo.forms.index') }}"
        class="btn-forms"
    >
        Lihat Forms AMO
    </a>

</div>


<div class="stats-grid">

    {{-- Total Form --}}
    <div class="stat-card">

        <div class="label">
            Total Form
        </div>

        <div class="value">
            {{ $totalForms }}
        </div>

    </div>


    {{-- Total Report --}}
    <div class="stat-card">

        <div class="label">
            Total Report
        </div>

        <div class="value">
            {{ $totalReports }}
        </div>

    </div>


    {{-- Draft --}}
    <div class="stat-card">

        <div class="label">
            Draft
        </div>

        <div class="value">
            {{ $totalDraft }}
        </div>

    </div>


    {{-- Submitted --}}
    <div class="stat-card">

        <div class="label">
            Submitted
        </div>

        <div class="value">
            {{ $totalSubmitted }}
        </div>

    </div>

</div>


<div class="card">

    <div class="activity-header">

        <div>
            <h3>
                Report Terbaru
            </h3>

            <p>
                Lima report terakhir yang dibuat oleh Anda.
            </p>
        </div>

        <a
            href="{{ route('amo.reports.index') }}"
            class="btn-view-all"
        >
            Lihat Semua
        </a>

    </div>


    @forelse ($recentReports as $report)

        <div class="report-item">

            <div class="report-icon">
                📄
            </div>

            <div class="report-content">

                <div class="report-number">
                    {{ $report->document_number }}
                </div>

                <div class="report-name">
                    {{ $report->formTemplate->name }}
                </div>

                <div class="report-date">
                    {{ $report->created_at->format('d-m-Y H:i') }}
                </div>

            </div>


            <div class="report-action">

                <span
                    class="status-badge status-{{ $report->status }}"
                >
                    {{ ucfirst($report->status) }}
                </span>

                <a
                    href="{{ route('amo.reports.show', $report) }}"
                    class="btn-detail"
                >
                    Lihat
                </a>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                📄
            </div>

            <h3>
                Belum ada report
            </h3>

            <p>
                Silakan buat report melalui Forms AMO.
            </p>

            <a
                href="{{ route('amo.forms.index') }}"
                class="btn-forms"
            >
                Buat Report
            </a>

        </div>

    @endforelse

</div>


<style>

.btn-forms {
    display: inline-block;
    margin-top: 16px;
    padding: 10px 16px;
    border-radius: 7px;
    background: #2563eb;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
}

.btn-forms:hover {
    background: #1d4ed8;
}


/* =========================
   ACTIVITY HEADER
========================= */

.activity-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 18px;
}

.activity-header h3 {
    margin: 0 0 5px;
}

.activity-header p {
    margin: 0;
    color: #64748b;
    font-size: 13px;
}

.btn-view-all {
    padding: 8px 13px;
    border-radius: 7px;
    background: #f1f5f9;
    color: #374151;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

.btn-view-all:hover {
    background: #e2e8f0;
}


/* =========================
   REPORT ITEM
========================= */

.report-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 15px 0;
    border-top: 1px solid #e5e7eb;
}

.report-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 9px;
    background: #f1f5f9;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 20px;
}

.report-content {
    flex: 1;
    min-width: 0;
}

.report-number {
    font-size: 13px;
    font-weight: 700;
    color: #2563eb;
}

.report-name {
    margin-top: 3px;
    font-size: 14px;
    font-weight: 600;
    color: #111827;
}

.report-date {
    margin-top: 3px;
    font-size: 11px;
    color: #64748b;
}

.report-action {
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-badge {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
}

.status-draft {
    background: #fef3c7;
    color: #92400e;
}

.status-submitted {
    background: #dbeafe;
    color: #1d4ed8;
}

.status-review {
    background: #ede9fe;
    color: #6d28d9;
}

.status-approved {
    background: #dcfce7;
    color: #166534;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.btn-detail {
    padding: 7px 11px;
    border-radius: 7px;
    background: #111827;
    color: white;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
}

.btn-detail:hover {
    background: #374151;
}


/* =========================
   EMPTY STATE
========================= */

.empty-state {
    padding: 40px 20px;
    text-align: center;
    border-top: 1px solid #e5e7eb;
}

.empty-icon {
    font-size: 35px;
    margin-bottom: 10px;
}

.empty-state h3 {
    margin: 0 0 5px;
    color: #1f2937;
}

.empty-state p {
    margin: 0 0 15px;
    color: #64748b;
    font-size: 13px;
}


@media (max-width: 768px) {

    .activity-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .report-item {
        align-items: flex-start;
    }

    .report-action {
        flex-direction: column;
        align-items: flex-end;
    }

}

</style>

@endsection