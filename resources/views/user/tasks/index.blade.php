@extends('user.layouts') <!-- Ganti dengan layout yang sesuai -->

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Tugas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Daftar Tugas</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tugas yang Tersedia</h5>

            @if ($tugas->isEmpty())
              <p>Tidak ada tugas yang tersedia.</p>
            @else
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">File</th>
                    <th scope="col">Admin</th> <!-- Kolom baru -->
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tugas as $index => $tugasItem)
                    <tr>
                      <th scope="row">{{ $index + 1 }}</th>
                      <td>{{ $tugasItem->judul }}</td>
                      <td>{{ $tugasItem->deskripsi }}</td>
                      <td>
                        {{ $tugasItem->type == 'upload' ? 'Upload Gambar' : 'Unduh File' }}
                      </td>
                      <td>
                        @if($tugasItem->type == 'upload')
                          Gambar
                        @elseif($tugasItem->type == 'file')
                          {{ $tugasItem->file ? 'File' : 'Tidak ada file' }}
                        @else
                          Tidak ada file
                        @endif
                      </td>
                      <td>
                        {{ $tugasItem->creator ? $tugasItem->creator->name : 'Tidak tersedia' }}
                      </td>
                      <td>
                        <a href="{{ route('user.tasks.show', $tugasItem->id) }}" class="btn btn-info">Lihat Tugas</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection
