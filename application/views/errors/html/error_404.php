<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>404 Not Found - RSUD Genteng</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: #ffffff;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-size: 6rem;
            margin: 0;
            color: #1977cc;
        }
        h2 {
            font-size: 2rem;
            margin: 10px 0 20px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        a.button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #1977cc;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        a.button:hover {
            background-color: #145a9e;
        }
        .lost-person {
            margin-bottom: 30px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <div class="lost-person">
        <img src="/assets/front/img/404_images.webp" alt="404 Not Found" style="max-width: 400px; width: 100%; height: auto; border-radius: 15px; box-shadow: 0 0 20px rgba(25, 119, 204, 0.2);" />
    </div>
  
    <h1>Halaman Tidak Ditemukan</h1>
    <p>Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
    <a href="/" class="button">Kembali ke Beranda</a>
</body>
</html>
