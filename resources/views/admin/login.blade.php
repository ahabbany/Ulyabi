<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Ulyabi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #DDC3C3 0%, #F7EFE5 50%, #DDC3C3 100%);
            padding: 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            box-shadow: 0 20px 60px rgba(107, 63, 105, 0.15);
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #A376A2, #DDC3C3, #6B3F69);
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #6B3F69;
            text-align: center;
        }

        .login-subtitle {
            color: #9CA3AF;
            text-align: center;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .logo-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #A376A2, #6B3F69);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 8px 24px rgba(163, 118, 162, 0.3);
        }

        .logo-circle span {
            font-size: 2rem;
            font-weight: 700;
            color: white;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 2px solid #E5E7EB;
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: #F9FAFB;
            font-size: 0.875rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #A376A2;
            box-shadow: 0 0 0 4px rgba(163, 118, 162, 0.1);
            background: white;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #A376A2, #6B3F69);
            color: white;
            border: none;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(163, 118, 162, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .input-group {
            position: relative;
            margin-top: 0.5rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            pointer-events: none;
            width: 20px;
            height: 20px
        }

        .input-group .form-input {
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .error-message {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: #DC2626;
            font-size: 0.8125rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .floating-shape {
            position: fixed;
            border-radius: 50%;
            opacity: 0.15;
            pointer-events: none;
        }

        .floating-shape:nth-child(1) {
            width: 300px;
            height: 300px;
            background: #A376A2;
            top: -100px;
            left: -100px;
        }

        .floating-shape:nth-child(2) {
            width: 200px;
            height: 200px;
            background: #DDC3C3;
            bottom: -50px;
            right: -50px;
        }

        .floating-shape:nth-child(3) {
            width: 150px;
            height: 150px;
            background: #6B3F69;
            bottom: 30%;
            left: -30px;
        }
    </style>
</head>
<body>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>

    <div class="login-card">
        <div class="logo-circle">
            <span>U</span>
        </div>

        <h1 class="login-title">Admin Ulyabi</h1>
        <p class="login-subtitle">Masuk untuk mengelola toko</p>

        @if($errors->any())
        <div class="error-message mt-6">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ $errors->first('email') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="mt-6 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <div class="input-group">
                    <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                    <input type="email" name="email" id="email" class="form-input" placeholder="admin@ulyabi.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
           <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Password
            </label>

            <div style="position: relative;">

                <!-- ICON GEMBOK -->
                <svg 
                    xmlns="http://www.w3.org/2000/svg"
                    style="
                        position:absolute;
                        left:16px;
                        top:50%;
                        transform:translateY(-50%);
                        width:20px;
                        height:20px;
                        color:#9CA3AF;
                    "
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>

                <!-- INPUT -->
                <input 
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    required
                    class="form-input"
                    style="
                        padding-left:50px;
                        padding-right:50px;
                    "
                >

                <!-- ICON MATA -->
                <button 
                    type="button"
                    onclick="togglePassword()"
                    style="
                        position:absolute;
                        right:16px;
                        top:50%;
                        transform:translateY(-50%);
                        border:none;
                        background:none;
                        cursor:pointer;
                        color:#9CA3AF;
                        font-size:18px;
                    "
                >
                    👁️
                </button>

            </div>
        </div>

            <button type="submit" class="btn-login">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk
                </span>
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-[#A376A2] hover:text-[#6B3F69] transition flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke website
            </a>
        </div>
    </div>
<script>
function togglePassword() {
    const password = document.getElementById('password');

    if (password.type === 'password') {
        password.type = 'text';
    } else {
        password.type = 'password';
    }
}
</script>
</body>
</html>
