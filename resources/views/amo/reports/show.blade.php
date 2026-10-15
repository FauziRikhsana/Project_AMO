@extends('layouts.app')

@section('title', 'Detail Report - ' . $submission->document_number)

@section('content')

<div class="report-page">

    {{-- Header --}}
    <div class="page-header">

        <div>

            <div class="breadcrumb">

                <a href="{{ route('amo.reports.index') }}">
                    Reports
                </a>

                <span>/</span>

                <a href="{{ route(
                    'amo.reports.folder',
                    $submission->formTemplate
                ) }}">
                    {{ $submission->formTemplate->name }}
                </a>

                <span>/</span>

                <span>
                    {{ $submission->document_number }}
                </span>

            </div>

            <h1>
                {{ $submission->document_number }}
            </h1>

            <p>
                Detail data hasil pengisian form
                {{ $submission->formTemplate->name }}
            </p>

        </div>

    </div>


    {{-- Pesan sukses --}}
    @if (session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Informasi Report --}}
    <div class="info-card">

        <div class="info-item">

            <span class="info-label">
                Report Number
            </span>

            <span class="info-value">
                {{ $submission->document_number }}
            </span>

        </div>


        <div class="info-item">

            <span class="info-label">
                Form
            </span>

            <span class="info-value">
                {{ $submission->formTemplate->form_code }}
                -
                {{ $submission->formTemplate->name }}
            </span>

        </div>


        <div class="info-item">

            <span class="info-label">
                Created By
            </span>

            <span class="info-value">
                {{ $submission->user->name ?? '-' }}
            </span>

        </div>


        <div class="info-item">

            <span class="info-label">
                Status
            </span>

            <span class="status-badge">
                {{ ucfirst($submission->status) }}
            </span>

        </div>


        <div class="info-item">

            <span class="info-label">
                Created At
            </span>

            <span class="info-value">
                {{ $submission->created_at->format('d-m-Y H:i') }}
            </span>

        </div>

    </div>


    {{-- Data Form --}}
    @foreach ($submission->formTemplate->sections as $section)

        <div class="section-card">

            <div class="section-header">

                <div class="section-number">
                    {{ $loop->iteration }}
                </div>

                <h2>
                    {{ $section->section_title }}
                </h2>

            </div>


            <div class="fields-container">

                @foreach ($section->fields as $field)

                    @php

                        $submissionValue = $submission->values
                            ->firstWhere(
                                'form_field_id',
                                $field->id
                            );

                    @endphp


                    <div class="field-group">

                        <div class="field-label">
                            {{ $field->field_label }}
                        </div>

                        <div class="field-value">

                            @if (
                                $submissionValue &&
                                $submissionValue->value !== null &&
                                $submissionValue->value !== ''
                            )

                                {{ $submissionValue->value }}

                            @else

                                <span class="empty-value">
                                    -
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endforeach


    {{-- Action --}}
    <div class="form-actions">

        <a
            href="{{ route(
                'amo.reports.folder',
                $submission->formTemplate
            ) }}"
            class="btn-cancel"
        >
            ← Kembali
        </a>


        <a
            href="{{ route(
                'amo.reports.edit',
                $submission
            ) }}"
            class="btn-edit"
        >
            ✎ Edit Report
        </a>

         <a
        href="{{ route('amo.reports.pdf', $submission) }}"
        target="_blank"
        class="btn-pdf"
    >
        🖨️ Cetak PDF
    </a>
@if (
    $submission->status === 'draft' &&
    $submission->user_id === auth()->id()
)
    <form method="POST"
          action="{{ route('amo.reports.submit', $submission) }}"
          style="display: inline;">
        @csrf

        <button type="submit"
                class="btn-submit"
                onclick="return confirm('Apakah Anda yakin ingin mengirim report ini untuk direview Admin?')">
            ✓ Submit Report
        </button>
    </form>
@endif
    </div>

</div>


<style>

    .report-page {
        max-width: 1100px;
        margin: 0 auto;
    }


    /* Header */

    .page-header {
        margin-bottom: 25px;
    }

    .breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
        margin-bottom: 12px;
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

    .page-header h1 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 700;
        color: #111827;
    }

    .page-header p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }


    /* Success */

    .alert-success {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 13px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 600;
    }


    /* Information */

    .info-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;

        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .info-label {
        color: #64748b;
        font-size: 12px;
    }

    .info-value {
        color: #111827;
        font-size: 14px;
        font-weight: 600;
    }


    /* Status */

    .status-badge {
        display: inline-flex;
        width: fit-content;
        padding: 4px 10px;
        border-radius: 999px;
        background: #fef3c7;
        color: #92400e;
        font-size: 12px;
        font-weight: 600;
    }


    /* Section */

    .section-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-number {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        background: #2563eb;
        color: #ffffff;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 700;
        font-size: 13px;
    }

    .section-header h2 {
        margin: 0;
        font-size: 17px;
        color: #111827;
    }


    /* Fields */

    .fields-container {
        padding: 20px;

        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .field-group {
        padding-bottom: 12px;
    }

    .field-label {
        margin-bottom: 6px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
    }

    .field-value {
        min-height: 20px;
        color: #111827;
        font-size: 14px;
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .empty-value {
        color: #94a3b8;
    }


    /* Actions */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        margin-bottom: 30px;
    }

    .btn-cancel,
    .btn-edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 11px 20px;

        border-radius: 8px;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;
        text-decoration: none;
    }

    .btn-cancel {
        background: #ffffff;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .btn-cancel:hover {
        background: #f8fafc;
    }

    .btn-edit {
        background: #111827;
        color: #ffffff;
        border: 1px solid #111827;
    }

    .btn-edit:hover {
        background: #374151;
        border-color: #374151;
    }


    @media (max-width: 750px) {

        .info-card {
            grid-template-columns: 1fr;
        }

        .fields-container {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-edit {
            width: 100%;
        }

        .btn-pdf {
    display: inline-block;
    padding: 11px 18px;
    background: #b91c1c;
    color: #ffffff;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.btn-pdf:hover {
    background: #991b1b;
}

    }

    .btn-submit {
    display: inline-block;
    padding: 11px 18px;
    background: #166534;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.btn-submit:hover {
    background: #14532d;
}

</style>

@endsection