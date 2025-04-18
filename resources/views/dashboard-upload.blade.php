,<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Upload</title>
    <style>
        body {
            background-color: #1f2937;
            color: white;
            font-family: sans-serif;
            text-align: center;
            padding-top: 60px;
            margin: 0;
        }

        h1 {
            font-size: 48px;
            margin-bottom: 40px;
        }

        .button {
            display: inline-block;
            padding: 20px 40px;
            margin: 0 10px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
        }

        .btn-upload-gambar {
            background-color: #3b82f6;
            color: white;
        }

        .btn-upload-excel {
            background-color: #10b981;
            color: white;
        }

        .btn-lihat-file {
            background-color: #38bdf8;
            color: black;
        }

        .logout-container {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .logout-btn {
            background-color: #ef4444;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>

    {{-- 🔒 Tombol Logout di kanan atas --}}
    <div class="logout-container">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">🔒 Logout</button>
        </form>
    </div>

    <h1>Dashboard Upload</h1>

    {{-- Tombol khusus untuk admin --}}
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('upload.image.form') }}" class="button btn-upload-gambar">Upload Gambar</a>
        <a href="{{ route('upload.excel.form') }}" class="button btn-upload-excel">Upload Excel</a>
    @endif

    {{-- Tombol umum untuk semua user --}}
    <a href="{{ route('file-list') }}" class="button btn-lihat-file">Lihat Semua File</a>

</body>
</html>
