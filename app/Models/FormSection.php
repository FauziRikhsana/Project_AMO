<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSection extends Model
{
    protected $fillable = [
        'form_template_id',
        'section_title',
        'description',
        'sort_order',
    ];

    /**
     * Section dimiliki oleh satu template form.
     */
    public function formTemplate(): BelongsTo
    {
        return $this->belongsTo(FormTemplate::class, 'form_template_id');
    }

    /**
     * Satu section memiliki banyak field.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class, 'form_section_id')
                    ->orderBy('sort_order');
    }
}