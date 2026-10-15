@extends('layouts.app')

@section('content')

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Edit Template</h1>
            <p>Perbarui informasi template form.</p>
        </div>

        <a href="{{ route('admin.templates.index') }}" class="btn-back">
            ← Kembali
        </a>
    </div>

    <div class="form-card">

        <form method="POST"
              action="{{ route('admin.templates.update', $formTemplate) }}">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="form_code">
                    Form Code <span>*</span>
                </label>

                <input
                    type="text"
                    id="form_code"
                    name="form_code"
                    value="{{ old('form_code', $formTemplate->form_code) }}"
                    required
                >

                @error('form_code')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">
                    Nama Template <span>*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $formTemplate->name) }}"
                    required
                >

                @error('name')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                >{{ old('description', $formTemplate->description) }}</textarea>

                @error('description')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="version">
                        Version <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="version"
                        name="version"
                        value="{{ old('version', $formTemplate->version) }}"
                        required
                    >

                    @error('version')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">
                        Status <span>*</span>
                    </label>

                    <select id="status" name="status" required>

                        <option value="active"
                            {{ old('status', $formTemplate->status) === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $formTemplate->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="form-actions">

                <a href="{{ route('admin.templates.index') }}"
                   class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-save">
                    ✓ Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<style>

.page-container {
    padding: 24px;
    max-width: 1000px;
    margin: auto;
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

.btn-back {
    padding: 9px 14px;
    background: #f3f4f6;
    color: #374151;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
}

.form-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 28px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;
    font-size: 14px;
    font-weight: 600;
}

.form-group label span {
    color: #dc2626;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    box-sizing: border-box;
    padding: 11px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
}

.form-group textarea {
    resize: vertical;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.error {
    display: block;
    margin-top: 5px;
    color: #dc2626;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
}

.btn-cancel,
.btn-save {
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.btn-cancel {
    background: #f3f4f6;
    color: #374151;
}

.btn-save {
    border: none;
    background: #2563eb;
    color: white;
}

</style>

@endsection