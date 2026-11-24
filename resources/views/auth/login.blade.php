<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main>
        <h1>Login</h1>
        <p>Masuk dengan email dan password Anda.</p>

        @if (session('status'))
            <p role="status">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">

            <button type="submit">Login</button>
        </form>

        <p>Belum memiliki akun? <a href="{{ route('register') }}">Daftar</a></p>
    </main>
</body>
</html>
