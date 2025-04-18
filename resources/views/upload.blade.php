<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body
  style="background-color:#0f172a; color:white; font-family:sans-serif; text-align:center; padding-top:50px;">
    <h1>📊 Upload File</h1>

    @if(session('success'))
        <p style="color: #22c55e;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('upload.image') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".jpg,.jpeg,.png,.webp" required>
        <br><br>
        <button type="submit" style="background-color: #10b981; color:white; padding:10px 20px; border:none; border-radius:5px;">Upload</button>
    </form>

    <br>
    <a href="{{ route('upload.dashboard') }}" style="color:#60a5fa;">~ Kembali ke Dashboard</a>
</body>
</html>
