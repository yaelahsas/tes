<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Error - RSUD Genteng</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: #f0f8ff;
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
            font-size: 4rem;
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
            max-width: 600px;
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
        /* Animation container */
        .animation-container {
            width: 300px;
            height: 300px;
            margin-bottom: 30px;
            position: relative;
        }
        .lost-person {
            margin-bottom: 30px;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        @keyframes moveUpDown {
            0%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }
        /* Loading dots animation */
        .loading-dots::after {
            content: '.';
            animation: dots 2s steps(4, end) infinite;
        }
        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60% { content: '...'; }
            80%, 100% { content: ''; }
        }
    </style>
</head>
<body>
    <div class="lost-person">
        <img src="/assets/front/img/500_images.webp" alt="Error" style="max-width: 400px; width: 100%; height: auto; border-radius: 15px; box-shadow: 0 0 20px rgba(25, 119, 204, 0.2);" />
    </div>
    <h1>Oops!</h1>
    <h2>Terjadi Kesalahan<span class="loading-dots"></span></h2>
    <p>Mohon maaf, sistem kami sedang mengalami gangguan. Tim kami sedang bekerja untuk memperbaiki masalah ini. Silakan coba beberapa saat lagi.</p>
    <a href="/" class="button">Kembali ke Beranda</a>
</body>
</html>
