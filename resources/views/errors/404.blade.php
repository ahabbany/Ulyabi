<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan - Ulyabi</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .btn-primary {
            background-color: #A376A2;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary:hover { background-color: #8D5F8C; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(163, 118, 162, 0.4); }
    </style>
</head>
<body class="bg-[#DDC3C3] min-h-screen flex flex-col">
    <nav class="bg-[#674188] sticky top-0 z-40 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-bold" style="color: #F7EFE5;">Ulyabi</span>
                </a>
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium transition" style="color: #F7EFE5;" onmouseover="this.style.color='#DDC3C3'" onmouseout="this.style.color='#F7EFE5'">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-sm font-medium transition" style="color: #F7EFE5;" onmouseover="this.style.color='#DDC3C3'" onmouseout="this.style.color='#F7EFE5'">Produk</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-1 flex items-center justify-center px-4">
        <div class="text-center max-w-lg">
            <div class="text-[150px] md:text-[200px] font-bold leading-none mb-4" style="color: #A376A2;">404</div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4" style="color: #6B3F69;">Halaman Tidak Ditemukan</h1>
            <p class="text-gray-600 mb-8 text-lg">
                Maaf, halaman yang kamu cari tidak ada atau telah dipindahkan.
            </p>
            <a href="{{ route('home') }}" class="btn-primary text-lg px-8 py-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <footer class="bg-[#674188] py-6">
        <div class="text-center text-sm" style="color: #F7EFE5;">
            <p>&copy; {{ date('Y') }} Ulyabi. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
