

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Login</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <style>
            .card-img-container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px; /* Optional: add padding to create space around the image */
            }
            .card-img-top {
                max-width: 30%;
                height: auto;
            }
        </style>
    </head>
    <body class="bg-dark-subtle">
        <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 80vh;">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
             <h3 class="mb-2">learning management simple</h3>
                <div class="card" style="width: 25rem;">
                    <div class="card-img-container">
                        <img src="{{ asset('asset/logokampuss.jpg') }}" class="card-img-top" alt="Gambar">
                    </div>
                        <form action="login" method="post">
                        @csrf
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}" autofocus required>
                                        <label for="email">Email</label>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-lock-fill"></i></span>
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Kata Sandi"  required>
                                        <label for="password">Kata Sandi</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary w-100">Masuk</button>
                                <small>Belum Registrasi? <a href="/register">Registrasi Sekarang!</a></small>
                            </div>
                        </form>
                </div>
            </div>     
            <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>