@extends('user.layouts')

@section('judul')
| Dashboard
@endsection

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard Pengguna</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <!-- Div untuk total tugas -->
              <div class="col-md-6">
                <div class="info-box">
                  <h5 class="card-title">Jumlah Tugas</h5>
                  <p>Total Tugas: {{ $tugasCount }}</p>
                </div>
              </div>

              <!-- Div untuk tugas yang telah diselesaikan -->
              <div class="col-md-6">
                <div class="info-box">
                  <h5 class="card-title">Tugas yang Telah Diselesaikan</h5>
                  <p>{{ $tugasCompletedCount }}</p>
                </div>
              </div>
            </div>

            <h6>Tugas dan Admin yang Memberikan:</h6>
            <ul>
              @foreach($tugas as $tugasItem)
                <li>
                  Tugas: {{ $tugasItem->judul }}
                  <br> Diberikan oleh: {{ $tugasItem->creator ? $tugasItem->creator->name : 'Tidak tersedia' }}
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection
