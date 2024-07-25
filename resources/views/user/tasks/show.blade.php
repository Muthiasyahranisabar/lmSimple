@extends('user.layouts')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Detail Tugas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.tasks.index') }}">Daftar Tugas</a></li>
        <li class="breadcrumb-item active">Detail Tugas</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Detail Tugas</h5>

            <!-- Menampilkan pesan jika tugas telah selesai -->
            @if($penyelesaianTugas)
              <div class="alert alert-success">
                Anda telah berhasil menyelesaikan tugas.
              </div>
            @endif

            <!-- Menampilkan detail tugas dengan format yang lebih rapi -->
            <div class="mb-4">
              <div class="row">
                <div class="col-md-3">
                  <strong>Judul:</strong>
                </div>
                <div class="col-md-9">
                  <p>{{ $tugas->judul }}</p>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <div class="row">
                <div class="col-md-3">
                  <strong>Deskripsi:</strong>
                </div>
                <div class="col-md-9">
                  <p>{{ $tugas->deskripsi }}</p>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <div class="row">
                <div class="col-md-3">
                  <strong>Tipe:</strong>
                </div>
                <div class="col-md-9">
                  <p>{{ $tugas->type == 'upload' ? 'Upload Gambar' : 'Upload File' }}</p>
                </div>
              </div>
            </div>

            <!-- Link untuk mengunduh file jika ada -->
            @if($tugas->file)
              <div class="mb-4">
                <a href="{{ route('user.tasks.downloadPdf', $tugas->id) }}" class="btn btn-primary" download>Unduh File</a>
              </div>
            @endif

            <!-- Menampilkan gambar yang telah diunggah -->
            @if($penyelesaianTugas)
              @if($penyelesaianTugas->file)
                <div class="mb-4">
                  <img src="{{ Storage::url($penyelesaianTugas->file) }}" class="img-preview img-fluid mb-3 col-sm-6" alt="Gambar Tugas">
                </div>
              @elseif(!$penyelesaianTugas->file)
                <div class="mb-4">
                  <a href="{{ Storage::url($penyelesaianTugas->file) }}" target="_blank" class="btn btn-secondary">Lihat File PDF</a>
                </div>
              @endif
            @endif

            <!-- Form untuk menyelesaikan tugas jika belum selesai -->
            @if(!$penyelesaianTugas && $tugas->type == 'upload')
              <form action="{{ route('user.tasks.complete', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                  <label for="file" class="form-label">Upload Gambar</label>
                  <img id="img-preview" class="img-preview img-fluid mb-3 col-sm-6">
                  <input type="file" id="file" name="file" class="form-control @error('file') is-invalid @enderror" onchange="previewImage()">
                  @error('file')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-success">Selesaikan Tugas</button>
              </form>
            @endif

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection

@section('scripts')
<script>
function previewImage() {
    const file = document.querySelector('#file');
    const imgPreview = document.querySelector('#img-preview');

    const fileReader = new FileReader();
    fileReader.readAsDataURL(file.files[0]);

    fileReader.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}
</script>
@endsection
