@extends('layouts.app')

@section('title', 'Forms')

@section('content')

<div class="page-header">
    <h1>Forms</h1>

    <p>
        Pilih template form yang ingin digunakan untuk membuat laporan.
    </p>
</div>

<div class="search-container">

    <form method="GET" action="{{ route('amo.forms.index') }}">

        <div class="search-box">

            <span class="search-icon">
                🔍
            </span>

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari form berdasarkan kode, nama, atau deskripsi..."
            >

            @if(!empty($search))
                <a
                    href="{{ route('amo.forms.index') }}"
                    class="btn-clear-search"
                >
                    ✕
                </a>
            @endif

            <button type="submit" class="btn-search">
                Cari
            </button>

        </div>

    </form>

</div>

<div class="forms-grid">

    @forelse ($forms as $form)

        <div class="form-card">

            <div class="form-icon">
                📄
            </div>

            <div class="form-content">

                <div class="form-code">
                    {{ $form->form_code }}
                </div>

                <h2>
                    {{ $form->name }}
                </h2>

                <p class="form-description">
                    {{ $form->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="form-meta">

                    <span>
                        Version {{ $form->version }}
                    </span>

                    <span class="status-active">
                        Active
                    </span>

                </div>

               <a
    href="{{ route('amo.forms.show', $form) }}"
    class="btn-fill-form"
>
    Isi Form
</a>

            </div>

        </div>

    @empty

    <div class="empty-state">

        <div class="empty-icon">
            🔍
        </div>

        @if(!empty($search))

            <h2>Form tidak ditemukan</h2>

            <p>
                Tidak ada form yang cocok dengan pencarian
                "<strong>{{ $search }}</strong>".
            </p>

            <a
                href="{{ route('amo.forms.index') }}"
                class="btn-reset-search"
            >
                Tampilkan Semua Form
            </a>

        @else

            <h2>Belum ada form</h2>

            <p>
                Belum terdapat template form yang aktif.
            </p>

        @endif

    </div>

@endforelse

</div>


<style>

.forms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
    gap: 20px;
}

.form-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    display: flex;
    gap: 18px;
    transition: 0.2s;
}

.form-card:hover {
    border-color: #cbd5e1;
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
    transform: translateY(-2px);
}

.form-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    border-radius: 12px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
}

.form-content {
    flex: 1;
}

.form-code {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 5px;
}

.form-content h2 {
    margin: 0 0 8px;
    font-size: 18px;
    color: #111827;
}

.form-description {
    margin: 0 0 15px;
    color: #6b7280;
    font-size: 13px;
    line-height: 1.6;
}

.form-meta {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 18px;
    font-size: 12px;
    color: #64748b;
}

.status-active {
    padding: 4px 9px;
    border-radius: 999px;
    background: #dcfce7;
    color: #166534;
    font-weight: 600;
}

.btn-fill-form {
    display: inline-block;
    padding: 9px 16px;
    background: #111827;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

.btn-fill-form:hover {
    background: #374151;
}

.empty-state {
    grid-column: 1 / -1;
    background: white;
    border: 1px dashed #d1d5db;
    border-radius: 14px;
    padding: 60px 20px;
    text-align: center;
}

.empty-icon {
    font-size: 40px;
    margin-bottom: 15px;
}

.empty-state h2 {
    margin: 0 0 8px;
    color: #1f2937;
}

.empty-state p {
    margin: 0;
    color: #6b7280;
}

.search-container {
    margin-bottom: 24px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 7px 8px 7px 14px;
}

.search-icon {
    font-size: 17px;
}

.search-box input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 14px;
    color: #111827;
    background: transparent;
}

.search-box input::placeholder {
    color: #9ca3af;
}

.btn-search {
    border: none;
    padding: 9px 16px;
    background: #111827;
    color: white;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

.btn-search:hover {
    background: #374151;
}

.btn-clear-search {
    color: #6b7280;
    text-decoration: none;
    font-size: 14px;
    padding: 5px;
}

.btn-clear-search:hover {
    color: #111827;
}

.btn-reset-search {
    display: inline-block;
    margin-top: 15px;
    padding: 9px 15px;
    background: #111827;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}
</style>

@endsection