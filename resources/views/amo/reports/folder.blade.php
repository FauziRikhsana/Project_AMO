@extends('layouts.app')

@section('title', 'Reports - ' . $formTemplate->name)

@section('content')

<div class="page-header">

    <div class="breadcrumb">
        <a href="{{ route('amo.reports.index') }}">
            Reports
        </a>

        <span> / </span>

        <span>
            {{ $formTemplate->name }}
        </span>
    </div>

    <h1>
        {{ $formTemplate->name }}
    </h1>

    <p>
        {{ $formTemplate->form_code }}
        @if ($formTemplate->description)
            — {{ $formTemplate->description }}
        @endif
    </p>

</div>


<div class="reports-list">

    @forelse ($reports as $report)

        <div class="report-card">

            <div class="report-icon">
                📄
            </div>

            <div class="report-content">

                <div class="report-number">
                    {{ $report->document_number }}
                </div>

                <h2>
                    {{ $formTemplate->name }}
                </h2>

                <div class="report-info">

                    <div>
                        <span class="info-label">
                            Dibuat oleh
                        </span>

                        <span class="info-value">
                            {{ $report->user->name }}
                        </span>
                    </div>

                    <div>
                        <span class="info-label">
                            Tanggal
                        </span>

                        <span class="info-value">
                            {{ $report->created_at->format('d-m-Y H:i') }}
                        </span>
                    </div>

                </div>

                <div class="report-bottom">

                    <span class="status-draft">
                        {{ ucfirst($report->status) }}
                    </span>

                    <a
                        href="{{ route('amo.reports.show', $report) }}"
                        class="btn-view-report"
                    >
                        Lihat Report
                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                📄
            </div>

            <h2>
                Belum ada report
            </h2>

            <p>
                Belum terdapat report untuk template ini.
            </p>

        </div>

    @endforelse

</div>


<style>

.breadcrumb {
    margin-bottom: 15px;
    font-size: 13px;
    color: #64748b;
}

.breadcrumb a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 600;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.reports-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.report-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px;
    display: flex;
    gap: 18px;
    transition: 0.2s;
}

.report-card:hover {
    border-color: #cbd5e1;
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
    transform: translateY(-1px);
}

.report-icon {
    width: 55px;
    height: 55px;
    min-width: 55px;
    border-radius: 12px;
    background: #f1f5f9;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 27px;
}

.report-content {
    flex: 1;
    min-width: 0;
}

.report-number {
    font-size: 13px;
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 5px;
}

.report-content h2 {
    margin: 0 0 15px;
    font-size: 18px;
    color: #111827;
}

.report-info {
    display: flex;
    flex-direction: column;
    gap: 7px;
    margin-bottom: 18px;
}

.report-info > div {
    display: flex;
    justify-content: space-between;
    max-width: 500px;
    gap: 20px;
    font-size: 13px;
}

.info-label {
    color: #64748b;
}

.info-value {
    color: #374151;
    font-weight: 600;
}

.report-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.status-draft {
    padding: 5px 10px;
    border-radius: 999px;
    background: #fef3c7;
    color: #92400e;
    font-size: 12px;
    font-weight: 600;
}

.btn-view-report {
    display: inline-block;
    padding: 9px 16px;
    background: #111827;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.btn-view-report:hover {
    background: #374151;
}

.empty-state {
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

@media (max-width: 768px) {

    .report-card {
        padding: 18px;
    }

    .report-bottom {
        flex-direction: column;
        align-items: flex-start;
    }

    .report-info > div {
        flex-direction: column;
        gap: 3px;
    }

}

</style>

@endsection