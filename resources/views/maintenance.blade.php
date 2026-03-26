<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>
    <link rel="icon" href="{{ $branding_favicon ? asset('storage/' . $branding_favicon) : asset('favicon.ico') }}" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/admin.css'])
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #23272f 0%, #2e323a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', 'Inter', sans-serif;
        }
        .glass-effect {
            background: rgba(36,37,46,0.85);
            border-radius: 24px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.37);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(255,255,255,0.08);
            padding: 48px 32px;
            text-align: center;
            max-width: 420px;
            width: 100%;
        }
        .logo {
            max-width: 100px;
            margin-bottom: 1.5rem;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 2px 12px 0 rgba(255,255,255,0.08);
            padding: 0.5rem;
        }
        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        p {
            font-size: 1.1rem;
            color: #e5e7eb;
            margin-bottom: 1.5rem;
        }
        .fa-tools {
            color: #ff5f56;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .footer {
            margin-top: 2rem;
            color: #888;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="glass-effect">
        <img src="{{ $site_logo ? asset('storage/' . $site_logo) : asset('logo.png') }}" alt="Logo" class="logo animate-pulse-custom">
        <div><i class="fas fa-tools animate-pulse-custom"></i></div>
        <h1>We'll be back soon!</h1>
        <p>{{ $other_maintenance_message ?? 'Our website is currently undergoing scheduled maintenance. Please check back later. Thank you for your patience!' }}</p>
        <div class="footer">
            &copy; {{ date('Y') }} Ready 24h Security. All rights reserved.
        </div>
    </div>
</body>
</html>
