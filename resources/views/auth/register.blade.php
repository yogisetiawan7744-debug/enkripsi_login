<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <main>
        <h1>Buat akun</h1>
        <p>Isi data berikut untuk mendaftar.</p>

        @if ($errors->any())
            <div role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <label for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" autocomplete="name">

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">

            <label for="password">Password (minimal 8 karakter)</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">

            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">

            <button type="submit">Daftar</button>
        </form>

        <p>Sudah memiliki akun? <a href="{{ route('login') }}">Login</a></p>
    </main>
</body>
</html>
