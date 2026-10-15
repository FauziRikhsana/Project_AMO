@extends('layouts.app')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Template Management</h1>
            <p>Kelola template form yang digunakan dalam sistem MEDALI.</p>
        </div>

       <a href="{{ route('admin.templates.create') }}" class="btn-primary">
    + Tambah Template
</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>
@endif

    <div class="template-grid">

        @forelse($templates as $template)

            <div class="template-card">

                <div class="template-card-header">

                    <div>
                        <span class="template-code">
                            {{ $template->form_code }}
                        </span>

                        <h2>
                            {{ $template->name }}
                        </h2>
                    </div>

                    @if($template->status === 'active')
                        <span class="status-active">
                            Active
                        </span>
                    @else
                        <span class="status-inactive">
                            Inactive
                        </span>
                    @endif

                </div>

                <p class="template-description">
                    {{ $template->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="template-info">

                    <div>
                        <small>Version</small>
                        <strong>{{ $template->version }}</strong>
                    </div>

                    <div>
                        <small>Section</small>
                        <strong>{{ $template->sections_count }}</strong>
                    </div>

                    <div>
                        <small>Dibuat</small>
                        <strong>
                            {{ $template->created_at->format('d M Y') }}
                        </strong>
                    </div>

                </div>

                
<div class="template-actions">

    <a href="{{ route('admin.templates.show', $template) }}" class="btn-detail">
        Detail
    </a>

    <a href="{{ route('admin.templates.edit', $template) }}" class="btn-edit">
        Edit
    </a>

    <form
        action="{{ route('admin.templates.destroy', $template) }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus template ini?');"
    >
        @csrf
        @method('DELETE')

        <button type="submit" class="btn-delete">
            Delete
        </button>
    </form>

</div>


        @empty

            <div class="empty-state">
                <h3>Belum ada template</h3>
                <p>Belum terdapat template form di sistem.</p>
            </div>

        @endforelse

    </div>

</div>

<style>

.page-container {
    padding: 24px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
}

.page-header p {
    margin-top: 6px;
    color: #6b7280;
}

.btn-primary {
    display: inline-block;
    padding: 10px 16px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
}

.alert-success {
    background: #dcfce7;
    color: #166534;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.template-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
}

.template-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.template-card-header {
    display: flex;
    justify-content: space-between;
    gap: 15px;
}

.template-code {
    font-size: 12px;
    font-weight: 700;
    color: #2563eb;
}

.template-card h2 {
    margin: 6px 0 0;
    font-size: 19px;
}

.template-description {
    color: #6b7280;
    line-height: 1.5;
    margin: 16px 0;
}

.status-active,
.status-inactive {
    height: fit-content;
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

.template-info {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    padding: 14px 0;
    border-top: 1px solid #f3f4f6;
    border-bottom: 1px solid #f3f4f6;
}

.template-info small {
    display: block;
    color: #9ca3af;
    margin-bottom: 4px;
}

.template-info strong {
    font-size: 14px;
}

.template-actions {
    display: flex;
    gap: 10px;
    margin-top: 16px;
}

.btn-detail,
.btn-edit {
    flex: 1;
    text-align: center;
    padding: 9px;
    border-radius: 7px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
}

.btn-detail {
    background: #f3f4f6;
    color: #374151;
}

.btn-edit {
    background: #2563eb;
    color: white;
}

.empty-state {
    background: white;
    border: 1px dashed #d1d5db;
    padding: 40px;
    text-align: center;
    border-radius: 12px;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
}


.template-actions form {
    flex: 1;
    display: flex;
}

.btn-delete {
    width: 100%;
    border: none;
    text-align: center;
    padding: 9px;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 600;
    background: #dc2626;
    color: white;
    cursor: pointer;
}

.btn-delete:hover {
    background: #b91c1c;
}

</style>

@endsection