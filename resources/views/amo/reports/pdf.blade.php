<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <title>
        {{ $submission->document_number }}
    </title>

    <style>

        @page {
            margin: 25px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #111827;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #111827;
            padding-bottom: 12px;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
        }

        .header h2 {
            margin: 5px 0 0;
            font-size: 13px;
            font-weight: normal;
        }

        .document-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .document-info td {
            padding: 5px 7px;
            border: 1px solid #d1d5db;
        }

        .document-info .label {
            width: 25%;
            font-weight: bold;
            background: #f3f4f6;
        }

        .section {
            margin-bottom: 18px;
        }

        .section-title {
            background: #111827;
            color: white;
            padding: 7px 9px;
            font-size: 11px;
            font-weight: bold;
        }

        .fields {
            width: 100%;
            border-collapse: collapse;
        }

        .fields td {
            border: 1px solid #d1d5db;
            padding: 6px 7px;
            vertical-align: top;
        }

        .field-label {
            width: 35%;
            background: #f9fafb;
            font-weight: bold;
        }

        .empty {
            color: #9ca3af;
        }

        .footer {
            margin-top: 30px;
            padding-top: 8px;
            border-top: 1px solid #d1d5db;
            text-align: center;
            font-size: 8px;
            color: #6b7280;
        }

    </style>

</head>

<body>

    {{-- HEADER --}}
    <div class="header">

        <h1>
            {{ $submission->formTemplate->name }}
        </h1>

        <h2>
            {{ $submission->formTemplate->form_code }}
        </h2>

    </div>


    {{-- DOCUMENT INFORMATION --}}
    <table class="document-info">

        <tr>

            <td class="label">
                Report Number
            </td>

            <td>
                {{ $submission->document_number }}
            </td>

        </tr>

        <tr>

            <td class="label">
                Created By
            </td>

            <td>
                {{ $submission->user->name ?? '-' }}
            </td>

        </tr>

        <tr>

            <td class="label">
                Status
            </td>

            <td>
                {{ ucfirst($submission->status) }}
            </td>

        </tr>

        <tr>

            <td class="label">
                Created At
            </td>

            <td>
                {{ $submission->created_at->format('d-m-Y H:i') }}
            </td>

        </tr>

    </table>


    {{-- FORM SECTIONS --}}
    @foreach ($submission->formTemplate->sections as $section)

        <div class="section">

            <div class="section-title">

                {{ $loop->iteration }}.
                {{ $section->section_title }}

            </div>


            <table class="fields">

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
                                : null;

                        if (
                            $field->field_name === 'report_number'
                        ) {
                            $value =
                                $submission->document_number;
                        }

                    @endphp

                    <tr>

                        <td class="field-label">

                            {{ $field->field_label }}

                        </td>

                        <td>

                            @if (
                                $value !== null &&
                                $value !== ''
                            )

                                {{ $value }}

                            @else

                                <span class="empty">
                                    -
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </table>

        </div>

    @endforeach


    {{-- FOOTER --}}
    <div class="footer">

        {{ $submission->formTemplate->name }}
        -
        {{ $submission->document_number }}

    </div>

</body>
</html>