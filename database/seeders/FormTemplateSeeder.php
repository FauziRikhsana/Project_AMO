<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormTemplate;
use App\Models\FormSection;
use App\Models\FormField;

class FormTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | FORM TEMPLATE
        |--------------------------------------------------------------------------
        */

        $formTemplate = FormTemplate::create([
            'form_code' => 'QC-AS-0128',
            'name' => 'JOB EVALUATION (JE)',
            'description' => 'Form Job Evaluation untuk melakukan evaluasi pekerjaan maintenance.',
            'version' => '1.0',
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SECTION 1 - DOCUMENT INFORMATION
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Document Information',
            'description' => 'Informasi dasar dokumen Job Evaluation.',
            'sort_order' => 1,
        ]);

        $fields = [
            [
                'field_name' => 'report_number',
                'field_label' => 'Report Number',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'field_name' => 'date',
                'field_label' => 'Date',
                'field_type' => 'date',
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'field_name' => 'department',
                'field_label' => 'Department',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 3,
            ],
            [
                'field_name' => 'prepared_by',
                'field_label' => 'Prepared By',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION 2 - JOB INFORMATION
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Job Information',
            'description' => 'Informasi mengenai pekerjaan yang akan dievaluasi.',
            'sort_order' => 2,
        ]);

        $fields = [
            [
                'field_name' => 'aircraft_registration',
                'field_label' => 'Aircraft Registration',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'field_name' => 'aircraft_type',
                'field_label' => 'Aircraft Type',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'field_name' => 'job_task_number',
                'field_label' => 'Job / Task Number',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 3,
            ],
            [
                'field_name' => 'job_title',
                'field_label' => 'Job Title',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 4,
            ],
            [
                'field_name' => 'job_description',
                'field_label' => 'Job Description',
                'field_type' => 'textarea',
                'is_required' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION 3 - REFERENCE
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Reference',
            'description' => 'Dokumen referensi yang digunakan dalam pekerjaan.',
            'sort_order' => 3,
        ]);

        $fields = [
            [
                'field_name' => 'reference_document',
                'field_label' => 'Reference Document',
                'field_type' => 'text',
                'is_required' => false,
                'sort_order' => 1,
            ],
            [
                'field_name' => 'reference_number',
                'field_label' => 'Reference Number',
                'field_type' => 'text',
                'is_required' => false,
                'sort_order' => 2,
            ],
            [
                'field_name' => 'maintenance_manual',
                'field_label' => 'Maintenance Manual / Document',
                'field_type' => 'text',
                'is_required' => false,
                'sort_order' => 3,
            ],
            [
                'field_name' => 'revision',
                'field_label' => 'Revision',
                'field_type' => 'text',
                'is_required' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION 4 - JOB EVALUATION
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Job Evaluation',
            'description' => 'Evaluasi terhadap kebutuhan dan karakteristik pekerjaan.',
            'sort_order' => 4,
        ]);

        $fields = [
            [
                'field_name' => 'special_tooling',
                'field_label' => 'Job requires special tooling?',
                'field_type' => 'select',
                'options' => [
                    'Yes',
                    'No',
                ],
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'field_name' => 'special_equipment',
                'field_label' => 'Job requires special equipment?',
                'field_type' => 'select',
                'options' => [
                    'Yes',
                    'No',
                ],
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'field_name' => 'special_skill',
                'field_label' => 'Job requires special skill?',
                'field_type' => 'select',
                'options' => [
                    'Yes',
                    'No',
                ],
                'is_required' => true,
                'sort_order' => 3,
            ],
            [
                'field_name' => 'additional_personnel',
                'field_label' => 'Job requires additional maintenance personnel?',
                'field_type' => 'select',
                'options' => [
                    'Yes',
                    'No',
                ],
                'is_required' => true,
                'sort_order' => 4,
            ],
            [
                'field_name' => 'additional_safety',
                'field_label' => 'Job requires additional safety precautions?',
                'field_type' => 'select',
                'options' => [
                    'Yes',
                    'No',
                ],
                'is_required' => true,
                'sort_order' => 5,
            ],
            [
                'field_name' => 'evaluation_result',
                'field_label' => 'Evaluation Result',
                'field_type' => 'textarea',
                'is_required' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION 5 - WORK REQUIREMENT
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Work Requirement',
            'description' => 'Kebutuhan pekerjaan dalam pelaksanaan maintenance.',
            'sort_order' => 5,
        ]);

        $fields = [
            [
                'field_name' => 'estimated_man_hours',
                'field_label' => 'Estimated Man Hours',
                'field_type' => 'number',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'field_name' => 'number_of_personnel',
                'field_label' => 'Number of Personnel',
                'field_type' => 'number',
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'field_name' => 'required_skill',
                'field_label' => 'Required Skill / Qualification',
                'field_type' => 'textarea',
                'is_required' => true,
                'sort_order' => 3,
            ],
            [
                'field_name' => 'special_tools_equipment',
                'field_label' => 'Special Tools / Equipment',
                'field_type' => 'textarea',
                'is_required' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION 6 - REMARKS
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Remarks',
            'description' => 'Catatan tambahan mengenai Job Evaluation.',
            'sort_order' => 6,
        ]);

        $fields = [
            [
                'field_name' => 'remarks',
                'field_label' => 'Remarks',
                'field_type' => 'textarea',
                'is_required' => false,
                'sort_order' => 1,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION 7 - APPROVAL
        |--------------------------------------------------------------------------
        */

        $section = FormSection::create([
            'form_template_id' => $formTemplate->id,
            'section_title' => 'Approval',
            'description' => 'Informasi persetujuan dokumen.',
            'sort_order' => 7,
        ]);

        $fields = [
            [
                'field_name' => 'prepared_by_name',
                'field_label' => 'Prepared By - Name',
                'field_type' => 'text',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'field_name' => 'prepared_by_date',
                'field_label' => 'Prepared By - Date',
                'field_type' => 'date',
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'field_name' => 'reviewed_by_name',
                'field_label' => 'Reviewed By - Name',
                'field_type' => 'text',
                'is_required' => false,
                'sort_order' => 3,
            ],
            [
                'field_name' => 'reviewed_by_date',
                'field_label' => 'Reviewed By - Date',
                'field_type' => 'date',
                'is_required' => false,
                'sort_order' => 4,
            ],
            [
                'field_name' => 'approved_by_name',
                'field_label' => 'Approved By - Name',
                'field_type' => 'text',
                'is_required' => false,
                'sort_order' => 5,
            ],
            [
                'field_name' => 'approved_by_date',
                'field_label' => 'Approved By - Date',
                'field_type' => 'date',
                'is_required' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($fields as $field) {
            $section->fields()->create($field);
        }
    }
}