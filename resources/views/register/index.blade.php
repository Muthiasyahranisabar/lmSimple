<!DOCTYPE html>
<html>
<head>
    <title>Halaman Registrasi</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .form-registrasi .form-floating:focus-within {
            z-index: 2; 
        }

        .form-registrasi input {
            border-radius: 0; 
            margin-bottom: -1px;
        }
    </style>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <main class="form-registrasi">
                <h1 class="h3 mb-3 mt-5 fw-normal text-center">Registrasi Form</h1>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Nama" required value="{{ old('name') }}">
                        <label for="name">Nama</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="nama@gmail.com" required value="{{ old('email') }}">
                        <label for="email">Email</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Kata Sandi" required>
                        <label for="password">Kata Sandi</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password_confirmation" class="form-control rounded-bottom @error('password_confirmation') is-invalid @enderror" id="password" placeholder="Kata Sandi" required>
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mt-3 @error('role') is-invalid @enderror">
                        <select name="role" class="">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="author">Author</option>
                            <option value="editor">Editor</option>
                        </select><br>
                    </div>
                    <button class="w-100 btn btn-md btn-outline-primary mt-3" type="submit">Registrasi</button>
                    <small>Sudah Registrasi? <a href="/login">Login</a></small>
                </form>
            </main>
        </div>
    </div>   
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>  
</body>
</html>
