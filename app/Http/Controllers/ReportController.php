<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\FormTemplate;
use App\Models\SubmissionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Menampilkan daftar folder/template report.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $templates = FormTemplate::where('status', 'active')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('form_code', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
        ->withCount('submissions')
        ->orderBy('id')
        ->get();

    return view('amo.reports.index', compact('templates', 'search'));
}

    /**
     * Menampilkan isi folder report berdasarkan template.
     */
    public function folder(FormTemplate $formTemplate)
    {
        $reports = FormSubmission::with([
            'formTemplate',
            'user',
        ])
        ->where('form_template_id', $formTemplate->id)
        ->orderByDesc('id')
        ->get();

        return view('amo.reports.folder', compact(
            'formTemplate',
            'reports'
        ));
    }

    /**
     * Menampilkan detail report.
     */
    public function show(FormSubmission $submission)
    {
        $submission->load([
            'formTemplate',
            'user',
            'values.formField.section',
        ]);

        return view('amo.reports.show', compact('submission'));
    }

    public function pdf(FormSubmission $submission)
{
    $submission->load([
        'formTemplate',
        'user',
        'values.formField.section',
    ]);

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'amo.reports.pdf',
        compact('submission')
    );

    $pdf->setPaper('A4', 'portrait');

    return $pdf->stream(
        $submission->document_number . '.pdf'
    );
}

    /**
     * Menampilkan halaman edit report.
     */
    public function edit(FormSubmission $submission)
    {
        $submission->load([
            'formTemplate.sections.fields',
            'values',
        ]);

        return view('amo.reports.edit', compact('submission'));
    }

    /**
     * Menyimpan perubahan report.
     */
    public function update(Request $request, FormSubmission $submission)
    {
        $submission->load([
            'formTemplate.sections.fields',
        ]);

        $form = $submission->formTemplate;

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $rules = [];

        foreach ($form->sections as $section) {

            foreach ($section->fields as $field) {

                /*
                 * Nomor report dibuat oleh sistem.
                 * Tidak boleh diubah oleh user.
                 */
                if ($field->field_name === 'report_number') {
                    continue;
                }

                $fieldName = $field->field_name;

                if ($field->is_required) {
                    $rules[$fieldName] = 'required';
                } else {
                    $rules[$fieldName] = 'nullable';
                }

                if ($field->field_type === 'date') {
                    $rules[$fieldName] .= '|date';
                }

                if ($field->field_type === 'number') {
                    $rules[$fieldName] .= '|numeric';
                }

                if (
                    $field->field_type === 'select' &&
                    $field->options
                ) {
                    $rules[$fieldName] .= '|in:' .
                        implode(',', $field->options);
                }
            }
        }

        $validated = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Update Report
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $submission,
            $form,
            $validated
        ) {

            foreach ($form->sections as $section) {

                foreach ($section->fields as $field) {

                    /*
                     * report_number selalu menggunakan
                     * nomor report dari database.
                     */
                    if ($field->field_name === 'report_number') {

                        $value = $submission->document_number;

                    } else {

                        $value = $validated[$field->field_name] ?? null;

                        if ($field->field_type === 'checkbox') {
                            $value = $value ? '1' : '0';
                        }
                    }

                    SubmissionValue::updateOrCreate(
                        [
                            'form_submission_id' => $submission->id,
                            'form_field_id' => $field->id,
                        ],
                        [
                            'value' => $value,
                        ]
                    );
                }
            }
        });

        return redirect()
            ->route('amo.reports.show', $submission)
            ->with(
                'success',
                'Report ' . $submission->document_number .
                ' berhasil diperbarui.'
            );
    }
    public function submit(FormSubmission $submission)
{
   $userId = request()->user()->id;

if ($submission->user_id !== $userId) {
    abort(403);
}

    if ($submission->status !== 'draft') {
        return redirect()
            ->route('amo.reports.show', $submission)
            ->with('error', 'Report ini tidak dapat dikirim.');
    }

    $submission->update([
        'status' => 'submitted',
    ]);

    return redirect()
        ->route('amo.reports.show', $submission)
        ->with(
            'success',
            'Report ' . $submission->document_number .
            ' berhasil dikirim untuk direview Admin.'
        );
}

public function adminIndex()
{
    $reports = FormSubmission::with([
        'formTemplate',
        'user',
    ])
    ->where('status', 'submitted')
    ->orderByDesc('id')
    ->get();

    return view('admin.reports.index', compact('reports'));
}

public function adminShow(FormSubmission $submission)
{
    $submission->load([
        'formTemplate',
        'user',
        'values.formField.section',
    ]);

    return view('admin.reports.show', compact('submission'));
}

public function startReview(FormSubmission $submission)
{
    if ($submission->status !== 'submitted') {
        return redirect()
            ->route('admin.reports.show', $submission)
            ->with(
                'error',
                'Report ini tidak dapat dimulai untuk review.'
            );
    }

    $submission->update([
        'status' => 'review',
    ]);

    return redirect()
        ->route('admin.reports.show', $submission)
        ->with(
            'success',
            'Report ' . $submission->document_number .
            ' sekarang sedang direview.'
        );
}

public function approve(FormSubmission $submission)
{
    if ($submission->status !== 'review') {
        return redirect()
            ->route('admin.reports.show', $submission)
            ->with(
                'error',
                'Report ini tidak dapat di-approve.'
            );
    }

    $submission->update([
        'status' => 'approved',
    ]);

    return redirect()
        ->route('admin.reports.show', $submission)
        ->with(
            'success',
            'Report ' . $submission->document_number .
            ' berhasil di-approve.'
        );
}

public function reject(FormSubmission $submission)
{
    if ($submission->status !== 'review') {
        return redirect()
            ->route('admin.reports.show', $submission)
            ->with(
                'error',
                'Report ini tidak dapat di-reject.'
            );
    }

    $submission->update([
        'status' => 'rejected',
    ]);

    return redirect()
        ->route('admin.reports.show', $submission)
        ->with(
            'success',
            'Report ' . $submission->document_number .
            ' berhasil di-reject.'
        );
}
}