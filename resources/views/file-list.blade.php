<!DOCTYPE html>
<html>
<head>
    <title>Daftar File</title>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #0f172a;
            color: #fff;
            font-family: sans-serif;
            position: relative;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .dashboard-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6366f1;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .file-card {
            background-color: #1e293b;
            padding: 15px 20px;
            border-radius: 8px;
            margin-top: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        .file-card p {
            font-weight: bold;
            margin: 0 0 6px 0;
            font-size: 16px;
        }

        .file-card a {
            color: #60a5fa;
            text-decoration: none;
            font-size: 14px;
        }

        .file-card a:hover {
            text-decoration: underline;
        }

        .no-files {
            margin-top: 20px;
            color: #94a3b8;
            font-style: italic;
        }

        button.delete-btn {
            background-color: #ef4444;
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            margin-top: 10px;
        }

        button.delete-btn:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>


    <div class="top-right">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button style="background-color: #ef4444; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer;">
                🔒 Logout
            </button>
        </form>
    </div>


    <div style="text-align: center;">
        <a href="{{ route('upload.dashboard') }}" class="dashboard-link">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>


    <h1>📁 Daftar File Yang Sudah Di Upload</h1>


    @if(session('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500
                });
            });
        </script>
    @endif


    <div style="display: flex; flex-direction: column; align-items: center;">
        @if(!empty($files) && count($files) > 0)
            @foreach($files as $file)
                <div class="file-card">
                    <p>{{ $file->filename }}</p>
                    <a href="{{ asset('/storage/' . $file->filepath) }}" target="_blank">📄 Lihat File</a>

                    {{-- 🔒 Tombol Hapus hanya untuk admin --}}
                    @if(auth()->user()->role === 'admin')
                        <form method="POST" 
                              action="{{ route('file.delete', $file->id) }}" 
                              onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">🗑️ Hapus</button>
                        </form>
                    @endif
                </div>
            @endforeach
        @else
            <div class="no-files">Belum ada file yang diupload.</div>
        @endif
    </div>

</body>
</html>
