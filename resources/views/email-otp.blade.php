<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .otp-code {
            background: #2563eb;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            letter-spacing: 5px;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">SmartSpend</div>
            <h1>Kode Verifikasi OTP</h1>
        </div>
        
        <p>Halo {{ $user->name }},</p>
        
        <p>Terima kasih telah mendaftar di aplikasi kami. Silakan gunakan kode OTP berikut untuk memverifikasi akun Anda:</p>
        
        <div class="otp-code">
            {{ $user->otp_code }}
        </div>
        
        <div class="warning">
            <strong>Penting:</strong>
            <ul>
                <li>Kode OTP ini akan kedaluwarsa dalam <strong>10 menit</strong></li>
                <li>Jangan berikan kode ini kepada siapa pun</li>
                <li>Jika Anda tidak meminta kode ini, abaikan email ini</li>
            </ul>
        </div>
        
        <p>Jika Anda mengalami masalah, silakan hubungi tim support kami.</p>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon jangan membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Your App Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>