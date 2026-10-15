<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\FormSubmission;

class FormTemplate extends Model
{
    protected $fillable = [
        'form_code',
        'name',
        'description',
        'version',
        'status',
    ];

    /**
     * Satu template memiliki banyak section.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(FormSection::class, 'form_template_id')
                    ->orderBy('sort_order');
    }

    public function submissions(): HasMany
{
    return $this->hasMany(FormSubmission::class, 'form_template_id');
}
}