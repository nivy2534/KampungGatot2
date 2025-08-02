<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            text-align: center;
            padding: 2rem;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            font-size: 2rem;
            margin-top: 2rem;
            margin-bottom: 0.5rem;
        }

        p {
            margin-bottom: 1.5rem;
            color: #555;
        }

        .btn-home {
            background-color: #1d4ed8;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .btn-home:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/img/404.png') }}" width="600" height="600" alt="404 Not Found Illustration">
    <h1>Ooops… 404!</h1>
    <p>Maaf, halaman yang Anda cari tidak ada.</p>
    <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>
</body>
</html>
