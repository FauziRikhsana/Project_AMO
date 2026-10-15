<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Models\FormTemplate;
use App\Models\SubmissionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FormController extends Controller
{
    /**
     * Menampilkan daftar form yang tersedia.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $forms = FormTemplate::where('status', 'active')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('form_code', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('id')
        ->get();

    return view('amo.forms.index', compact('forms', 'search'));
}

    /**
     * Menampilkan halaman pengisian form.
     */
    public function show(FormTemplate $form)
    {
        // Hanya form yang aktif yang boleh digunakan
        if ($form->status !== 'active') {
            abort(404);
        }

        // Ambil section beserta field-nya
        $form->load([
            'sections.fields'
        ]);

        return view('amo.forms.show', compact('form'));
    }

    /**
     * Menyimpan hasil pengisian form menjadi report.
     */
    public function store(Request $request, FormTemplate $form)
    {
        // Pastikan hanya form aktif yang dapat digunakan
        if ($form->status !== 'active') {
            abort(404);
        }

        // Ambil semua field dari template
        $form->load([
            'sections.fields'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $rules = [];

        foreach ($form->sections as $section) {
            foreach ($section->fields as $field) {

                $fieldName = $field->field_name;

                if ($field->is_required) {
                    $rules[$fieldName] = 'required';
                } else {
                    $rules[$fieldName] = 'nullable';
                }

                // Validasi berdasarkan tipe field
                if ($field->field_type === 'date') {
                    $rules[$fieldName] .= '|date';
                }

                if ($field->field_type === 'number') {
                    $rules[$fieldName] .= '|numeric';
                }

                if ($field->field_type === 'select' && $field->options) {
                    $rules[$fieldName] .= '|in:' . implode(',', $field->options);
                }
            }
        }

        $validated = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Simpan Report
        |--------------------------------------------------------------------------
        */

        $submission = DB::transaction(function () use ($form, $validated) {

            /*
             * Tentukan prefix nomor report.
             *
             * Untuk JOB EVALUATION kita gunakan:
             * JE-001
             * JE-002
             * JE-003
             */
            $prefix = 'JE';

            // Cari nomor report terakhir dengan prefix tersebut
            $lastSubmission = FormSubmission::where(
                'document_number',
                'like',
                $prefix . '-%'
            )
            ->orderByDesc('id')
            ->first();

            if ($lastSubmission) {

                $lastNumber = (int) str_replace(
                    $prefix . '-',
                    '',
                    $lastSubmission->document_number
                );

                $nextNumber = $lastNumber + 1;

            } else {

                $nextNumber = 1;
            }

            $documentNumber = $prefix . '-' . str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );

            /*
             * Buat data submission/report.
             */
            $submission = FormSubmission::create([
                'form_template_id' => $form->id,
                'user_id' => Auth::id(),
                'document_number' => $documentNumber,
                'status' => 'draft',
            ]);

            /*
             * Simpan seluruh nilai field.
             */
            foreach ($form->sections as $section) {

                foreach ($section->fields as $field) {

                    $value = $validated[$field->field_name] ?? null;

                    // Checkbox yang tidak dicentang tidak mengirim value
                    if ($field->field_type === 'checkbox') {
                        $value = $value ? '1' : '0';
                    }

                    SubmissionValue::create([
                        'form_submission_id' => $submission->id,
                        'form_field_id' => $field->id,
                        'value' => $value,
                    ]);
                }
            }

            return $submission;
        });

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('amo.reports.show', $submission)
            ->with('success', 'Form berhasil disimpan sebagai report ' . $submission->document_number . '.');
    }
}