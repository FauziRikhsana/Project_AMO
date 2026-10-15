@extends('layouts.app')

@section('content')

<div class="page-container">

    <div class="page-header">

        <div>
            <div class="breadcrumb">
                <a href="{{ route('admin.templates.index') }}">
                    Template Management
                </a>

                <span>›</span>

                <span>{{ $formTemplate->form_code }}</span>
            </div>

            <h1>{{ $formTemplate->name }}</h1>

            <p>
                {{ $formTemplate->description ?? 'Tidak ada deskripsi.' }}
            </p>
        </div>

        <div class="header-actions">

            <a href="{{ route('admin.templates.index') }}"
               class="btn-secondary">
                ← Kembali
            </a>

            <a href="{{ route('admin.templates.edit', $formTemplate) }}"
               class="btn-edit">
                ✎ Edit Template
            </a>

        </div>

    </div>


    {{-- TEMPLATE INFORMATION --}}

    <div class="info-card">

        <div class="info-item">
            <small>Form Code</small>
            <strong>{{ $formTemplate->form_code }}</strong>
        </div>

        <div class="info-item">
            <small>Version</small>
            <strong>{{ $formTemplate->version }}</strong>
        </div>

        <div class="info-item">
            <small>Status</small>

            @if($formTemplate->status === 'active')

                <span class="status-active">
                    Active
                </span>

            @else

                <span class="status-inactive">
                    Inactive
                </span>

            @endif
        </div>

        <div class="info-item">
            <small>Total Section</small>
            <strong>{{ $formTemplate->sections->count() }}</strong>
        </div>

    </div>


    {{-- SECTION HEADER --}}

    <div class="section-header">

        <div>
            <h2>Form Sections</h2>

            <p>
                Kelola bagian-bagian yang terdapat pada template ini.
            </p>
        </div>

        <a href="#" class="btn-primary">
            + Tambah Section
        </a>

    </div>


    {{-- SECTION LIST --}}

    <div class="sections-list">

        @forelse($formTemplate->sections as $section)

            <div class="section-card">

                <div class="section-number">
                    {{ $section->sort_order }}
                </div>

                <div class="section-content">

                    <h3>
                        {{ $section->section_title }}
                    </h3>

                    @if($section->description)

                        <p>
                            {{ $section->description }}
                        </p>

                    @else

                        <p class="text-muted">
                            Tidak ada deskripsi section.
                        </p>

                    @endif

                    <div class="section-meta">

                        <span>
                            {{ $section->fields->count() }} Field
                        </span>

                    </div>

                </div>

                <div class="section-actions">

                    <a href="#" class="btn-small">
                        Detail
                    </a>

                    <a href="#" class="btn-small">
                        Edit
                    </a>

                </div>

            </div>

        @empty

            <div class="empty-state">

                <div class="empty-icon">
                    📂
                </div>

                <h3>Belum ada section</h3>

                <p>
                    Template ini belum memiliki section.
                </p>

            </div>

        @endforelse

    </div>

</div>


<style>

.page-container {
    padding: 24px;
    max-width: 1100px;
    margin: auto;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 24px;
}

.breadcrumb {
    display: flex;
    gap: 8px;
    font-size: 13px;
    margin-bottom: 10px;
    color: #6b7280;
}

.breadcrumb a {
    color: #2563eb;
    text-decoration: none;
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
}

.page-header p {
    margin-top: 6px;
    color: #6b7280;
}

.header-actions {
    display: flex;
    gap: 10px;
}

.btn-secondary,
.btn-edit,
.btn-primary,
.btn-small {
    display: inline-block;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
}

.btn-secondary {
    padding: 9px 14px;
    background: #f3f4f6;
    color: #374151;
}

.btn-edit {
    padding: 9px 14px;
    background: #2563eb;
    color: white;
}

.btn-primary {
    padding: 10px 16px;
    background: #2563eb;
    color: white;
}

.info-card {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
}

.info-item small {
    display: block;
    color: #9ca3af;
    margin-bottom: 5px;
}

.info-item strong {
    font-size: 15px;
}

.status-active,
.status-inactive {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.section-header h2 {
    margin: 0;
    font-size: 21px;
}

.section-header p {
    margin-top: 5px;
    color: #6b7280;
    font-size: 14px;
}

.sections-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.section-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 18px;
}

.section-number {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #2563eb;
    border-radius: 10px;
    font-weight: 700;
    flex-shrink: 0;
}

.section-content {
    flex: 1;
}

.section-content h3 {
    margin: 0;
    font-size: 17px;
}

.section-content p {
    margin: 6px 0;
    color: #6b7280;
    font-size: 13px;
}

.text-muted {
    font-style: italic;
}

.section-meta {
    margin-top: 8px;
}

.section-meta span {
    display: inline-block;
    background: #f3f4f6;
    color: #4b5563;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
}

.section-actions {
    display: flex;
    gap: 7px;
}

.btn-small {
    padding: 7px 11px;
    background: #f3f4f6;
    color: #374151;
    font-size: 12px;
}

.empty-state {
    background: white;
    border: 1px dashed #d1d5db;
    border-radius: 12px;
    padding: 50px 20px;
    text-align: center;
}

.empty-icon {
    font-size: 35px;
    margin-bottom: 10px;
}

.empty-state h3 {
    margin: 0;
}

.empty-state p {
    color: #6b7280;
}

</style>

@endsection