@extends('admin.layouts')

@section('judul')
| Dashboard
@endsection

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Admin Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Jumlah Author</h5>
            <p>Total Author: {{ $authorCount }}</p>

            <h6>Daftar Author:</h6>
            <ul>
              @foreach($authors as $author)
                <li>{{ $author->name }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection
