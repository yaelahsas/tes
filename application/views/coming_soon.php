<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon - Detail Dokter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .coming-soon-wrapper {
            background: white;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        /* Pulse Animation for Heart Icon */
        .medical-icon-wrapper {
            margin-bottom: 2rem;
        }

        .pulse-icon {
            font-size: 5rem;
            color: #dc3545;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        /* Medical Icons Row */
        .medical-icons-row {
            margin: 2rem 0;
            display: flex;
            justify-content: center;
            gap: 3rem;
        }

        .medical-icons-row i {
            font-size: 2.5rem;
            color: #0d6efd;
            animation: float 3s infinite;
        }

        .medical-icons-row i:nth-child(2) { animation-delay: 0.25s; }
        .medical-icons-row i:nth-child(3) { animation-delay: 0.5s; }
        .medical-icons-row i:nth-child(4) { animation-delay: 0.75s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        h1 {
            color: #2d3436;
            margin-bottom: 1rem;
        }

        .lead {
            color: #636e72;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Progress Bar */
        .progress-wrapper {
            max-width: 400px;
            margin: 2rem auto;
        }

        .progress-bar {
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
            margin: 1rem 0;
        }

        .progress-fill {
            height: 100%;
            background: #0d6efd;
            border-radius: 4px;
            animation: progress 2s infinite;
        }

        @keyframes progress {
            0% { width: 0; }
            100% { width: 90%; }
        }

        /* Features List */
        .features-list {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .feature-item {
            flex: 1;
            min-width: 200px;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-item i {
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }

        .btn-back {
            display: inline-block;
            padding: 1rem 2rem;
            margin-top: 2rem;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        @media (max-width: 768px) {
            .medical-icons-row {
                gap: 1.5rem;
            }
            
            .features-list {
                flex-direction: column;
            }
            
            .feature-item {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="coming-soon-wrapper">
            <!-- Animated Medical Icon -->
            <div class="medical-icon-wrapper">
                <i class="fas fa-heartbeat pulse-icon"></i>
            </div>
            
            <h1>Coming Soon</h1>
            
            <!-- Medical Icons Animation -->
            <div class="medical-icons-row">
                <i class="fas fa-stethoscope"></i>
                <i class="fas fa-user-md"></i>
                <i class="fas fa-hospital"></i>
                <i class="fas fa-ambulance"></i>
            </div>
            
            <h2>Detail Informasi Dokter</h2>
            <p class="lead">Sedang dalam pengembangan untuk memberikan layanan terbaik</p>
            
            <!-- Progress Bar -->
            <div class="progress-wrapper">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <p>Mohon tunggu beberapa saat...</p>
            </div>
            
            <!-- Features Coming -->
            <div class="features-list">
                <div class="feature-item">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Jadwal Praktik Detail</h3>
                    <p>Informasi lengkap jadwal praktik dokter</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Riwayat Pendidikan</h3>
                    <p>Latar belakang pendidikan dan spesialisasi</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-certificate"></i>
                    <h3>Sertifikasi Profesi</h3>
                    <p>Kualifikasi dan sertifikasi profesional</p>
                </div>
            </div>
            
            <a href="<?= site_url('medis') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Dokter
            </a>
        </div>
    </div>
</body>
</html>
