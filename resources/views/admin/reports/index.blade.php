@extends('layouts.app')

@section('title', 'Review Reports')

@section('content')

<div class="page-header">
    <h1>Review Reports</h1>
    <p>Daftar report yang menunggu review Admin.</p>
</div>

<div class="report-list">

    @forelse ($reports as $report)

        <div class="report-card">

            <div class="report-main">

                <div class="report-icon">
                    📄
                </div>

                <div class="report-info">

                    <div class="report-number">
                        {{ $report->document_number }}
                    </div>

                    <h2>
                        {{ $report->formTemplate->name }}
                    </h2>

                    <p>
                        Dibuat oleh:
                        <strong>{{ $report->user->name ?? '-' }}</strong>
                    </p>

                    <p>
                        Dibuat:
                        {{ $report->created_at->format('d M Y H:i') }}
                    </p>

                </div>

            </div>

            <div class="report-action">

                <span class="status-badge">
                    Submitted
                </span>

                <a
                    href="{{ route('admin.reports.show', $report) }}"
                    class="btn-review"
                >
                    Review Report →
                </a>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <div class="empty-icon">
                ✓
            </div>

            <h2>Tidak ada report</h2>

            <p>
                Saat ini tidak ada report yang menunggu review.
            </p>

        </div>

    @endforelse

</div>

<style>

.page-header {
    margin-bottom: 24px;
}

.page-header h1 {
    margin: 0 0 6px;
    font-size: 28px;
}

.page-header p {
    margin: 0;
    color: #6b7280;
}

.report-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.report-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.report-main {
    display: flex;
    align-items: center;
    gap: 16px;
}

.report-icon {
    width: 48px;
    height: 48px;
    background: #f3f4f6;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}

.report-number {
    font-size: 13px;
    font-weight: 700;
    color: #6b7280;
    margin-bottom: 4px;
}

.report-info h2 {
    margin: 0 0 8px;
    font-size: 17px;
}

.report-info p {
    margin: 3px 0;
    font-size: 13px;
    color: #6b7280;
}

.report-action {
    display: flex;
    align-items: center;
    gap: 12px;
}

.status-badge {
    padding: 6px 10px;
    border-radius: 999px;
    background: #fef3c7;
    color: #92400e;
    font-size: 12px;
    font-weight: 600;
}

.btn-review {
    display: inline-block;
    padding: 10px 16px;
    background: #1d4ed8;
    color: #ffffff;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.btn-review:hover {
    background: #1e40af;
}

.empty-state {
    text-align: center;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 60px 20px;
}

.empty-icon {
    font-size: 40px;
    margin-bottom: 12px;
}

.empty-state h2 {
    margin: 0 0 8px;
}

.empty-state p {
    color: #6b7280;
}

@media (max-width: 768px) {

    .report-card {
        flex-direction: column;
        align-items: stretch;
    }

    .report-action {
        justify-content: space-between;
    }

}

</style>

@endsection