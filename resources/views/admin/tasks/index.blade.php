@extends('admin.layouts')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Tugas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item">Tugas</li>
        <li class="breadcrumb-item active">Daftar Tugas</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tugas yang Telah Dibuat</h5>

            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary mb-3">Tambah Tugas</a>

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
                    <th scope="col">Penyelesaian</th>
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
                        @if($tugasItem->penyelesaianTugas->isEmpty())
                          <p>Belum ada yang menyelesaikan</p>
                        @else
                          <ul>
                            @foreach($tugasItem->penyelesaianTugas as $penyelesaian)
                              <li>{{ $penyelesaian->user->name }}
                                @if($penyelesaian->file)
                                  <a href="{{ Storage::url($penyelesaian->file) }}" target="_blank">Lihat...</a>
                                @endif
                              </li>
                            @endforeach
                          </ul>
                        @endif
                      </td>
                      <td>
                        @if(!$tugasItem->penyelesaianTugas->isNotEmpty())
                          <a href="{{ route('admin.tasks.edit', $tugasItem->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                        <form action="{{ route('admin.tasks.destroy', $tugasItem->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                            Hapus
                          </button>
                        </form>
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
