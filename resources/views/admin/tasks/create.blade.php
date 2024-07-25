@extends('admin.layouts')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Pembuatan Tugas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.tasks.index') }}">Tugas</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('admin.tasks.create') }}">Buat Tugas</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Buat Tugas</h5>

              <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                  <label for="judul" class="form-label">Judul Tugas</label>
                  <input type="text" id="judul" name="judul" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                </div>

                <div class="col-md-6">
                  <label for="type" class="form-label">Tipe Tugas</label>
                  <select id="type" name="type" class="form-control" required>
                    <option value="upload">Upload Gambar</option>
                    <option value="file">Unduh File</option>
                  </select>
                </div>

                <div class="col-md-6" id="file-upload" style="display: none;">
                  <label for="file" class="form-label">Unduh File (PDF, DOC, DOCX, ZIP)</label>
                  <input type="file" id="file" name="file" class="form-control">
                </div>

                <div class="col-12 mt-3">
                  <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>
    document.getElementById('type').addEventListener('change', function() {
        var fileUpload = document.getElementById('file-upload');
        if (this.value === 'file') {
            fileUpload.style.display = 'block';
        } else {
            fileUpload.style.display = 'none';
        }
    });
  </script>
@endsection
