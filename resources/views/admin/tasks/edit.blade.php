@extends('admin.layouts')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Tugas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.tasks.index') }}">Daftar Tugas</a></li>
        <li class="breadcrumb-item active">Edit Tugas</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Tugas</h5>

            <form action="{{ route('admin.tasks.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $tugas->judul }}" required>
              </div>

              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $tugas->deskripsi }}</textarea>
              </div>

              <div class="mb-3">
                <label for="type" class="form-label">Tipe Tugas</label>
                <select class="form-control" id="type" name="type" required>
                  <option value="upload" {{ $tugas->type == 'upload' ? 'selected' : '' }}>Upload Gambar</option>
                  <option value="file" {{ $tugas->type == 'file' ? 'selected' : '' }}>Upload File</option>
                </select>
              </div>

              @if($tugas->file)
                <div class="mb-3">
                  <label for="currentFile" class="form-label">File Saat Ini</label>
                  <a href="{{ Storage::url($tugas->file) }}" download>Unduh File</a>
                </div>
              @endif

              <div class="mb-3">
                <label for="file" class="form-label">Ganti File (Optional)</label>
                <input type="file" class="form-control" id="file" name="file">
              </div>

              <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection
