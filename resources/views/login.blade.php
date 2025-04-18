<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body style="background-color:#0f172a; color:white; display:flex; align-items:center; justify-content:center; height:100vh; flex-direction:column;">
    <h1>🔐 Login</h1>

    @if($errors->any())
        <div style="color: red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">🔓 Login</button>
    </form>
</body>
</html>
