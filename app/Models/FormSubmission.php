<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_template_id',
        'user_id',
        'document_number',
        'status',
        'pdf_path',
    ];

    public function formTemplate(): BelongsTo
    {
        return $this->belongsTo(
            FormTemplate::class,
            'form_template_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function values(): HasMany
    {
        return $this->hasMany(
            SubmissionValue::class,
            'form_submission_id'
        );
    }
}