@extends('layouts.app')

@section('title', 'Isi Form - ' . $form->name)

@section('content')

<div class="form-page">

    {{-- Header --}}
    <div class="page-header">

        <div>
            <div class="breadcrumb">
                <a href="{{ route('amo.forms.index') }}">
                    Forms
                </a>

                <span>/</span>

                <span>
                    {{ $form->form_code }}
                </span>
            </div>

            <h1>
                {{ $form->name }}
            </h1>

            <p>
                {{ $form->description }}
            </p>
        </div>

    </div>


    {{-- Informasi Template --}}
    <div class="template-info">

        <div class="template-info-item">
            <span class="info-label">
                Form Code
            </span>

            <span class="info-value">
                {{ $form->form_code }}
            </span>
        </div>


        <div class="template-info-item">
            <span class="info-label">
                Version
            </span>

            <span class="info-value">
                {{ $form->version }}
            </span>
        </div>


        <div class="template-info-item">
            <span class="info-label">
                Status
            </span>

            <span class="status-active">
                Active
            </span>
        </div>

    </div>


    {{-- Form --}}
    <form method="POST" action="{{ route('amo.forms.store', $form) }}">

        @csrf


        @foreach ($form->sections as $section)

            <div class="section-card">

                {{-- Section Header --}}
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


                {{-- Fields --}}
                <div class="fields-container">

                    @foreach ($section->fields as $field)

                        <div class="field-group">

                            <label for="{{ $field->field_name }}">

                                {{ $field->field_label }}

                                @if ($field->is_required)
                                    <span class="required">
                                        *
                                    </span>
                                @endif

                            </label>


                            {{-- TEXT --}}
                            @if ($field->field_type === 'text')

                                <input
                                    type="text"
                                    id="{{ $field->field_name }}"
                                    name="{{ $field->field_name }}"
                                    class="form-input"
                                    placeholder="Masukkan {{ strtolower($field->field_label) }}"
                                    {{ $field->is_required ? 'required' : '' }}
                                >


                            {{-- DATE --}}
                            @elseif ($field->field_type === 'date')

                                <input
                                    type="date"
                                    id="{{ $field->field_name }}"
                                    name="{{ $field->field_name }}"
                                    class="form-input"
                                    {{ $field->is_required ? 'required' : '' }}
                                >


                            {{-- NUMBER --}}
                            @elseif ($field->field_type === 'number')

                                <input
                                    type="number"
                                    id="{{ $field->field_name }}"
                                    name="{{ $field->field_name }}"
                                    class="form-input"
                                    min="0"
                                    step="any"
                                    placeholder="Masukkan {{ strtolower($field->field_label) }}"
                                    {{ $field->is_required ? 'required' : '' }}
                                >


                            {{-- TEXTAREA --}}
                            @elseif ($field->field_type === 'textarea')

                                <textarea
                                    id="{{ $field->field_name }}"
                                    name="{{ $field->field_name }}"
                                    class="form-textarea"
                                    rows="4"
                                    placeholder="Masukkan {{ strtolower($field->field_label) }}"
                                    {{ $field->is_required ? 'required' : '' }}
                                ></textarea>


                            {{-- SELECT --}}
                            @elseif ($field->field_type === 'select')

                                <select
                                    id="{{ $field->field_name }}"
                                    name="{{ $field->field_name }}"
                                    class="form-input"
                                    {{ $field->is_required ? 'required' : '' }}
                                >

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    @if ($field->options)

                                        @foreach ($field->options as $option)

                                            <option value="{{ $option }}">
                                                {{ $option }}
                                            </option>

                                        @endforeach

                                    @endif

                                </select>


                            {{-- CHECKBOX --}}
                            @elseif ($field->field_type === 'checkbox')

                                <div class="checkbox-wrapper">

                                    <input
                                        type="checkbox"
                                        id="{{ $field->field_name }}"
                                        name="{{ $field->field_name }}"
                                        value="1"
                                    >

                                    <label
                                        for="{{ $field->field_name }}"
                                        class="checkbox-label"
                                    >
                                        Ya
                                    </label>

                                </div>

                            @endif


                            @if ($field->is_required)

                                <small class="field-help">
                                    Field ini wajib diisi.
                                </small>

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        @endforeach


        {{-- Action --}}
        <div class="form-actions">

            <a
                href="{{ route('amo.forms.index') }}"
                class="btn-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn-submit"
            >
                Simpan Form
            </button>

        </div>

    </form>

</div>


<style>

    .form-page {
        max-width: 1100px;
        margin: 0 auto;
    }


    /* Header */

    .page-header {
        margin-bottom: 25px;
    }

    .breadcrumb {
        display: flex;
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


    /* Template Information */

    .template-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .template-info-item {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 15px 18px;
    }

    .info-label {
        display: block;
        margin-bottom: 5px;
        color: #64748b;
        font-size: 12px;
    }

    .info-value {
        color: #111827;
        font-size: 14px;
        font-weight: 600;
    }


    /* Status */

    .status-active {
        display: inline-flex;
        padding: 4px 10px;
        border-radius: 999px;
        background: #dcfce7;
        color: #166534;
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
        padding: 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-number {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 50%;
        background: #2563eb;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

    .section-header h2 {
        margin: 0 0 4px;
        font-size: 17px;
        color: #111827;
    }

    .section-header p {
        margin: 0;
        font-size: 12px;
        color: #64748b;
    }


    /* Fields */

    .fields-container {
        padding: 22px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
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
        margin-left: 2px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
        color: #111827;
        background: #ffffff;
        outline: none;
        transition: 0.2s;
        font-family: inherit;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .field-help {
        margin-top: 5px;
        font-size: 11px;
        color: #94a3b8;
    }


    /* Checkbox */

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: 40px;
    }

    .checkbox-wrapper input {
        width: 17px;
        height: 17px;
    }

    .checkbox-label {
        margin: 0 !important;
        font-weight: 400 !important;
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
    .btn-submit {
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

    .btn-submit {
        border: none;
        background: #2563eb;
        color: #ffffff;
    }

    .btn-submit:hover {
        background: #1d4ed8;
    }


    /* Responsive */

    @media (max-width: 750px) {

        .template-info {
            grid-template-columns: 1fr;
        }

        .fields-container {
            grid-template-columns: 1fr;
        }

        .form-page {
            width: 100%;
        }

    }

</style>

@endsection