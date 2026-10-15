@extends('layouts.app')

@section('title', 'Edit ' . $submission->document_number)

@section('content')

<div class="page-header">

    <div class="breadcrumb">

        <a href="{{ route('amo.reports.index') }}">
            Reports
        </a>

        <span> / </span>

        <a href="{{ route(
            'amo.reports.folder',
            $submission->formTemplate
        ) }}">
            {{ $submission->formTemplate->name }}
        </a>

        <span> / </span>

        <span>
            {{ $submission->document_number }}
        </span>

    </div>

    <h1>
        Edit Report {{ $submission->document_number }}
    </h1>

    <p>
        Perbarui data report sebelum diproses lebih lanjut.
    </p>

</div>


@if ($errors->any())

    <div class="alert-error">

        <strong>
            Terdapat kesalahan pada form:
        </strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<form
    method="POST"
    action="{{ route(
        'amo.reports.update',
        $submission
    ) }}"
>

    @csrf

    @method('PUT')


    @foreach ($submission->formTemplate->sections as $section)

        <div class="section-card">

            <div class="section-header">

                <h2>
                    {{ $section->section_title }}
                </h2>

                @if ($section->description)

                    <p>
                        {{ $section->description }}
                    </p>

                @endif

            </div>


            <div class="fields-grid">

                @foreach ($section->fields as $field)

                    @php

                        $submissionValue =
                            $submission->values
                                ->firstWhere(
                                    'form_field_id',
                                    $field->id
                                );

                        $value =
                            $submissionValue
                                ? $submissionValue->value
                                : '';

                    @endphp


                    <div class="field-group">

                        <label>

                            {{ $field->field_label }}

                            @if ($field->is_required)

                                <span class="required">
                                    *
                                </span>

                            @endif

                        </label>


                        {{-- REPORT NUMBER --}}

                        @if ($field->field_name === 'report_number')

                            <input
                                type="text"
                                value="{{ $submission->document_number }}"
                                readonly
                                class="readonly-input"
                            >

                            <small>
                                Nomor report dibuat otomatis oleh sistem.
                            </small>


                        {{-- TEXT --}}

                        @elseif ($field->field_type === 'text')

                            <input
                                type="text"
                                name="{{ $field->field_name }}"
                                value="{{ old(
                                    $field->field_name,
                                    $value
                                ) }}"
                                {{ $field->is_required ? 'required' : '' }}
                            >


                        {{-- DATE --}}

                        @elseif ($field->field_type === 'date')

                            <input
                                type="date"
                                name="{{ $field->field_name }}"
                                value="{{ old(
                                    $field->field_name,
                                    $value
                                ) }}"
                                {{ $field->is_required ? 'required' : '' }}
                            >


                        {{-- NUMBER --}}

                        @elseif ($field->field_type === 'number')

                            <input
                                type="number"
                                step="any"
                                name="{{ $field->field_name }}"
                                value="{{ old(
                                    $field->field_name,
                                    $value
                                ) }}"
                                {{ $field->is_required ? 'required' : '' }}
                            >


                        {{-- TEXTAREA --}}

                        @elseif ($field->field_type === 'textarea')

                            <textarea
                                name="{{ $field->field_name }}"
                                rows="5"
                                {{ $field->is_required ? 'required' : '' }}
                            >{{ old(
                                $field->field_name,
                                $value
                            ) }}</textarea>


                        {{-- SELECT --}}

                        @elseif ($field->field_type === 'select')

                            <select
                                name="{{ $field->field_name }}"
                                {{ $field->is_required ? 'required' : '' }}
                            >

                                <option value="">
                                    -- Pilih --
                                </option>

                                @foreach ($field->options ?? [] as $option)

                                    <option
                                        value="{{ $option }}"
                                        {{ old(
                                            $field->field_name,
                                            $value
                                        ) == $option
                                            ? 'selected'
                                            : '' }}
                                    >
                                        {{ $option }}
                                    </option>

                                @endforeach

                            </select>


                        {{-- CHECKBOX --}}

                        @elseif ($field->field_type === 'checkbox')

                            <label class="checkbox-field">

                                <input
                                    type="checkbox"
                                    name="{{ $field->field_name }}"
                                    value="1"
                                    {{ $value == '1'
                                        ? 'checked'
                                        : '' }}
                                >

                                <span>
                                    Ya
                                </span>

                            </label>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>

    @endforeach


    <div class="form-actions">

        <a
            href="{{ route(
                'amo.reports.show',
                $submission
            ) }}"
            class="btn-cancel"
        >
            Batal
        </a>

        <button
            type="submit"
            class="btn-save"
        >
            Simpan Perubahan
        </button>

    </div>

</form>


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

.section-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    margin-bottom: 20px;
    overflow: hidden;
}

.section-header {
    padding: 20px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.section-header h2 {
    margin: 0;
    font-size: 18px;
    color: #111827;
}

.section-header p {
    margin: 6px 0 0;
    color: #64748b;
    font-size: 13px;
}

.fields-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
    padding: 24px;
}

.field-group {
    display: flex;
    flex-direction: column;
}

.field-group label {
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

.required {
    color: #dc2626;
}

.field-group input,
.field-group textarea,
.field-group select {
    width: 100%;
    padding: 11px 13px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #ffffff;
    color: #111827;
    font-family: inherit;
    font-size: 14px;
    outline: none;
}

.field-group input:focus,
.field-group textarea:focus,
.field-group select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.field-group textarea {
    resize: vertical;
    min-height: 110px;
}

.readonly-input {
    background: #f3f4f6 !important;
    color: #6b7280 !important;
    cursor: not-allowed;
}

.field-group small {
    margin-top: 5px;
    color: #6b7280;
    font-size: 11px;
}

.checkbox-field {
    display: flex !important;
    flex-direction: row !important;
    align-items: center;
    gap: 8px;
    margin-top: 28px;
}

.checkbox-field input {
    width: auto;
}

.alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #991b1b;
    padding: 15px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.alert-error ul {
    margin: 8px 0 0;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-bottom: 30px;
}

.btn-cancel,
.btn-save {
    display: inline-block;
    padding: 11px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.btn-cancel {
    background: #e5e7eb;
    color: #374151;
}

.btn-cancel:hover {
    background: #d1d5db;
}

.btn-save {
    background: #111827;
    color: #ffffff;
}

.btn-save:hover {
    background: #374151;
}

@media (max-width: 768px) {

    .fields-grid {
        grid-template-columns: 1fr;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .btn-cancel,
    .btn-save {
        width: 100%;
        text-align: center;
    }

}

</style>

@endsection