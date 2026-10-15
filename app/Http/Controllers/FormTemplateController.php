<?php

namespace App\Http\Controllers;

use App\Models\FormTemplate;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormTemplateController extends Controller
{
    public function index()
    {
        $templates = FormTemplate::withCount('sections')
            ->orderByDesc('id')
            ->get();

        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'form_code' => 'required|string|max:100|unique:form_templates,form_code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'version' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        FormTemplate::create($validated);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil ditambahkan.');
    }

    public function edit(FormTemplate $formTemplate)
    {
        return view('admin.templates.edit', compact('formTemplate'));
    }

    public function update(Request $request, FormTemplate $formTemplate)
    {
        $validated = $request->validate([
            'form_code' => 'required|string|max:100|unique:form_templates,form_code,' . $formTemplate->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'version' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        $formTemplate->update($validated);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    public function show(FormTemplate $formTemplate)
    {
        $formTemplate->load(['sections.fields']);

        return view('admin.templates.show', compact('formTemplate'));
    }

    public function destroy(FormTemplate $formTemplate)
    {
        // Cegah penghapusan template yang sudah memiliki report.
        $hasReports = FormSubmission::where(
            'form_template_id',
            $formTemplate->id
        )->exists();

        if ($hasReports) {
            return redirect()
                ->route('admin.templates.index')
                ->with(
                    'error',
                    'Template tidak dapat dihapus karena sudah memiliki report. Nonaktifkan template jika tidak ingin digunakan lagi.'
                );
        }

        $formTemplate->delete();

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil dihapus.');
    }
}