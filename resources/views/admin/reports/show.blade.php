@extends('layouts.app')

@section('title', 'Review Report')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<div class="page-header">

    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

        <span>/</span>

        <a href="{{ route('admin.reports.index') }}">
            Review Reports
        </a>

        <span>/</span>

        <span>{{ $submission->document_number }}</span>
    </div>

    <div class="header-row">

        <div>
            <h1>{{ $submission->document_number }}</h1>

            <p>
                {{ $submission->formTemplate->name }}
            </p>
        </div>

        <div class="status-badge">
            {{ ucfirst($submission->status) }}
        </div>

    </div>

</div>


{{-- INFORMASI REPORT --}}

<div class="info-card">

    <div class="info-card-header">
        <h2>Informasi Report</h2>
    </div>

    <div class="info-grid">

        <div class="info-item">
            <span>Nomor Report</span>
            <strong>
                {{ $submission->document_number }}
            </strong>
        </div>

        <div class="info-item">
            <span>Form</span>
            <strong>
                {{ $submission->formTemplate->name }}
            </strong>
        </div>

        <div class="info-item">
            <span>Dibuat Oleh</span>
            <strong>
                {{ $submission->user->name ?? '-' }}
            </strong>
        </div>

        <div class="info-item">
            <span>Tanggal Dibuat</span>
            <strong>
                {{ $submission->created_at->format('d M Y H:i') }}
            </strong>
        </div>

        <div class="info-item">
            <span>Status</span>
            <strong>
                {{ ucfirst($submission->status) }}
            </strong>
        </div>

        <div class="info-item">
            <span>Template</span>
            <strong>
                {{ $submission->formTemplate->form_code }}
            </strong>
        </div>

    </div>

</div>


{{-- ISI REPORT --}}

<div class="report-container">

    @php
        $values = $submission->values->keyBy('form_field_id');
    @endphp

    @foreach ($submission->formTemplate->sections as $section)

        <div class="section-card">

            <div class="section-header">

                <div class="section-number">
                    {{ $loop->iteration }}
                </div>

                <div>
                    <h2>
                        {{ $section->section_title }}
                    </h2>

                    @if ($section->description)
                        <p>
                            {{ $section->description }}
                        </p>
                    @endif
                </div>

            </div>


            <div class="fields-container">

                @foreach ($section->fields as $field)

                    @php
                        $fieldValue = $values[$field->id]->value ?? null;
                    @endphp

                    <div class="field-item">

                        <div class="field-label">
                            {{ $field->field_label }}

                            @if ($field->is_required)
                                <span class="required">*</span>
                            @endif
                        </div>

                        <div class="field-value">

                            @if ($field->field_type === 'checkbox')

                                @if ($fieldValue === '1')
                                    Ya
                                @else
                                    Tidak
                                @endif

                            @elseif ($field->field_type === 'select')

                                {{ $fieldValue ?: '-' }}

                            @elseif ($field->field_type === 'textarea')

                                @if ($fieldValue)
                                    {!! nl2br(e($fieldValue)) !!}
                                @else
                                    -
                                @endif

                            @else

                                {{ $fieldValue ?: '-' }}

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endforeach

</div>


{{-- ACTION --}}

<div class="action-card">

    <a
        href="{{ route('admin.reports.index') }}"
        class="btn-back"
    >
        ← Kembali
    </a>

    <div class="action-right">

        <a
            href="{{ route('amo.reports.pdf', $submission) }}"
            target="_blank"
            class="btn-pdf"
        >
            🖨️ Lihat PDF
        </a>

        @if ($submission->status === 'review')

    <form
        method="POST"
        action="{{ route('admin.reports.approve', $submission) }}"
        style="display: inline;"
    >
        @csrf

        <button
            type="submit"
            class="btn-approve"
            onclick="return confirm('Apakah Anda yakin ingin APPROVE report ini?')"
        >
            ✓ Approve
        </button>
    </form>

    <form
        method="POST"
        action="{{ route('admin.reports.reject', $submission) }}"
        style="display: inline;"
    >
        @csrf

        <button
            type="submit"
            class="btn-reject"
            onclick="return confirm('Apakah Anda yakin ingin REJECT report ini?')"
        >
            ✕ Reject
        </button>
    </form>

@endif
    </div>

</div>

<style>

.page-header {
    margin-bottom: 24px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    font-size: 13px;
    color: #6b7280;
}

.breadcrumb a {
    color: #2563eb;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.header-row h1 {
    margin: 0 0 6px;
    font-size: 30px;
}

.header-row p {
    margin: 0;
    color: #6b7280;
    font-size: 15px;
}

.status-badge {
    padding: 8px 14px;
    border-radius: 999px;
    background: #fef3c7;
    color: #92400e;
    font-size: 13px;
    font-weight: 700;
}

.info-card,
.section-card,
.action-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
}

.info-card {
    margin-bottom: 20px;
}

.info-card-header {
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.info-card-header h2 {
    margin: 0;
    font-size: 18px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}

.info-item {
    padding: 18px 20px;
    border-bottom: 1px solid #f1f5f9;
}

.info-item span {
    display: block;
    margin-bottom: 6px;
    font-size: 12px;
    color: #6b7280;
}

.info-item strong {
    font-size: 14px;
    color: #111827;
}

.section-card {
    margin-bottom: 20px;
    overflow: hidden;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.section-number {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #1d4ed8;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
}

.section-header h2 {
    margin: 0;
    font-size: 17px;
}

.section-header p {
    margin: 4px 0 0;
    font-size: 12px;
    color: #6b7280;
}

.fields-container {
    padding: 0 20px;
}

.field-item {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 20px;
    padding: 16px 0;
    border-bottom: 1px solid #f1f5f9;
}

.field-item:last-child {
    border-bottom: none;
}

.field-label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.required {
    color: #dc2626;
}

.field-value {
    font-size: 14px;
    color: #111827;
    line-height: 1.6;
    word-break: break-word;
}

.action-card {
    padding: 18px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-bottom: 30px;
}

.btn-back,
.btn-pdf {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.btn-back {
    background: #f3f4f6;
    color: #374151;
}

.btn-back:hover {
    background: #e5e7eb;
}

.btn-pdf {
    background: #111827;
    color: #ffffff;
}

.btn-pdf:hover {
    background: #1f2937;
}

@media (max-width: 900px) {

    .info-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .field-item {
        grid-template-columns: 1fr;
        gap: 6px;
    }

}

@media (max-width: 600px) {

    .header-row {
        align-items: flex-start;
        flex-direction: column;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .action-card {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-back,
    .btn-pdf {
        text-align: center;
    }

    .action-right {
    width: 100%;
    flex-direction: column;
}

.action-right > * {
    width: 100%;
}

.action-right a,
.action-right button {
    width: 100%;
    text-align: center;
}
}
.action-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-review-start {
    display: inline-block;
    padding: 10px 16px;
    background: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.btn-review-start:hover {
    background: #1d4ed8;
}

.alert {
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}

.alert-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.btn-approve,
.btn-reject {
    display: inline-block;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.btn-approve {
    background: #166534;
    color: #ffffff;
}

.btn-approve:hover {
    background: #14532d;
}

.btn-reject {
    background: #dc2626;
    color: #ffffff;
}

.btn-reject:hover {
    background: #b91c1c;
}
</style>

@endsection