@extends('layouts.app')

@section('title', 'Dashboard Super Admin')

@section('content')

    <div class="page-header">

        <h1>Dashboard Super Admin</h1>

        <p>
            Selamat datang di dashboard Super Admin MEDALI.
            Gunakan dashboard ini untuk memantau sistem dan administrasi pengguna.
        </p>

    </div>


    <div class="stats-grid">

        <div class="stat-card">
            <div class="label">
                Total User
            </div>

            <div class="value">
                0
            </div>
        </div>


        <div class="stat-card">
            <div class="label">
                Total Admin
            </div>

            <div class="value">
                0
            </div>
        </div>


        <div class="stat-card">
            <div class="label">
                Total Template
            </div>

            <div class="value">
                0
            </div>
        </div>


        <div class="stat-card">
            <div class="label">
                Total Report
            </div>

            <div class="value">
                0
            </div>
        </div>

    </div>


    <div class="card">

        <h3>
            System Overview
        </h3>

        <p>
            Informasi sistem, aktivitas pengguna, dan statistik
            administrasi akan ditampilkan pada tahap pengembangan berikutnya.
        </p>

    </div>

@endsection