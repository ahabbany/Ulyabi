<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ulyabi - Toko Snack, Cake, Strudel & Catering Rumahan">
    <title>@yield('title', 'Ulyabi') - Ulyabi</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .nav-link { position: relative; transition: color 0.3s ease; }
        .nav-link:hover { color: #DDC3C3 !important; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #DDC3C3;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

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

        .btn-secondary {
            background-color: white;
            color: #A376A2;
            border: 2px solid #A376A2;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-secondary:hover { background-color: #A376A2; color: white; }

        .card-product {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .card-product:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(163, 118, 162, 0.15); }

        .wa-float {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 50;
            width: 56px;
            height: 56px;
            background-color: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            color: white;
        }
        .wa-float:hover { transform: scale(1.1); box-shadow: 0 6px 20px rgba(37, 211, 102, 0.5); }

        .ig-float {
            position: fixed;
            bottom: 92px;
            right: 24px;
            z-index: 50;
            width: 56px;
            height: 56px;
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(225, 48, 108, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            color: white;
        }
        .ig-float:hover { transform: scale(1.1); box-shadow: 0 6px 20px rgba(225, 48, 108, 0.5); }

        .section-title {
            position: relative;
            display: inline-block;
            font-weight: 600;
            color: #6B3F69;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #A376A2, #DDC3C3);
            border-radius: 2px;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #6B3F69 0%, #8D5F8C 30%, #A376A2 70%, #DDC3C3 100%);
        }

        .badge-new {
            background: linear-gradient(135deg, #A376A2, #6B3F69);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-best {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
        <nav style="background-color: #6B3F69 !important;" class="sticky top-0 z-40 shadow-lg">   
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-bold" style="color: #ffffe7;">Ulyabi</span>
                </a>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link text-sm font-medium" style="color: #F7EFE5;">Beranda</a>
                    <a href="{{ route('products.index') }}" class="nav-link text-sm font-medium" style="color: #F7EFE5;">Produk</a>
                    <a href="{{ route('admin.login') }}" class="nav-link text-sm font-medium" style="color: #F7EFE5;">Admin Login</a>
                    <a href="{{ route('cart.index') }}" class="relative nav-link text-sm font-medium cart-target" style="color: #F7EFE5;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 01-8 0"></path>
                        </svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge-desktop absolute -top-2 -right-3 bg-[#DDC3C3] text-[#674188] text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @else
                            <span class="cart-badge-desktop absolute -top-2 -right-3 bg-[#DDC3C3] text-[#674188] text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold hidden">0</span>
                        @endif
                    </a>
                </div>

                <div class="md:hidden flex items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="relative cart-target-mobile">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="color: #F7EFE5;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 01-8 0"></path>
                        </svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge-mobile absolute -top-2 -right-3 bg-[#DDC3C3] text-[#674188] text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @else
                            <span class="cart-badge-mobile absolute -top-2 -right-3 bg-[#DDC3C3] text-[#674188] text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold hidden">0</span>
                        @endif
                    </a>
                    <button id="menu-toggle" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="color: #F7EFE5;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <a href="{{ route('home') }}" class="block py-2 text-sm font-medium" style="color: #F7EFE5;">Beranda</a>
                <a href="{{ route('products.index') }}" class="block py-2 text-sm font-medium" style="color: #F7EFE5;">Produk</a>
                <a href="{{ route('admin.login') }}" class="nav-link text-sm font-medium" style="color: #F7EFE5;">Admin Login</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer style="background-color: #6B3F69;" class="border-t border-[#8D5F8C]/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4" style="color: #ffffe7;">Ulyabi</h3>
                    <p class="text-sm" style="color: #ffffe7;">Toko online yang menyediakan aneka snack, cake, strudel, dan catering rumahan dengan kualitas terbaik.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4" style="color: #F7EFE5;">Menu</h4>
                    <ul class="space-y-2 text-sm" style="color: #F7EFE5;">
                        <li><a href="{{ route('home') }}" class="hover:text-[#DDC3C3] transition">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-[#DDC3C3] transition">Produk</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-[#DDC3C3] transition">Keranjang</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4" style="color: #F7EFE5;">Ikuti Kami</h4>
                    <div class="flex gap-3">
                        <a href="https://www.instagram.com/ulyabi.official/" target="_blank" class="w-10 h-10 rounded-full flex items-center justify-center transition transform hover:scale-110" style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);">                               
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">>
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/6285600552040" target="_blank" class="w-10 h-10 rounded-full bg-[#25D366] flex items-center justify-center transition transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-[#DDC3C3]/30 text-center text-sm" style="color: #F7EFE5;">
                <p>&copy; {{ date('Y') }} Ulyabi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6285600552040" target="_blank" class="wa-float" aria-label="Chat via WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <a href="https://www.instagram.com/ulyabi.official/" target="_blank" class="ig-float" aria-label="Instagram">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
        </svg>
    </a>

    {{-- Tombol Tutorial --}}
    <button id="tutorialBtn" class="tutorial-float" aria-label="Tutorial" title="Cara Belanja">
        ?
    </button>

    {{-- Modal Tutorial --}}
    <div id="tutorialOverlay" class="tutorial-overlay">
        <div class="tutorial-modal">
            <button onclick="tutupTutorial()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="tutorial-dots" id="tutorialDots"></div>

            <div id="tutorialContent" class="text-center">
                {{-- diisi JS --}}
            </div>

            <div class="flex items-center justify-between mt-6">
                <button id="tutorialPrev" onclick="gantiLangkah(-1)" class="px-5 py-2.5 rounded-xl text-sm font-medium text-gray-500 hover:text-[#A376A2] hover:bg-gray-100 transition disabled:opacity-30 disabled:cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Sebelumnya
                </button>
                <span id="tutorialCounter" class="text-sm text-gray-400 font-medium"></span>
                <button id="tutorialNext" onclick="gantiLangkah(1)" class="px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-[#A376A2] hover:bg-[#8D5F8C] transition">
                    Selanjutnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div id="flash-message" class="fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg text-sm font-medium animate-pulse">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-message');
            if (el) { el.style.opacity = '0'; el.style.transition = 'opacity 0.5s'; setTimeout(() => el.remove(), 500); }
        }, 3000);
    </script>
    @endif

    @if(session('error'))
    <div id="flash-error" class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg text-sm font-medium">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-error');
            if (el) { el.style.opacity = '0'; el.style.transition = 'opacity 0.5s'; setTimeout(() => el.remove(), 500); }
        }, 3000);
    </script>
    @endif

    <script>
        document.getElementById('menu-toggle')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <script>
        // ===== TUTORIAL =====
        const langkahTutorial = [
            {
                icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>`,
                judul: 'Jelajahi Produk',
                desc: 'Lihat-lihat dulu semua produk Ulyabi. Bisa dicari pakai kolom pencarian, atau pilih kategori yang kamu suka!'
            },
            {
                icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>`,
                judul: 'Klik + atau Tambah ke Keranjang',
                desc: 'Suka sama produknya? Tinggal klik tombol <b>+</b> atau <b>Tambah ke Keranjang</b>. Nanti ada animasi terbang ke ikon keranjang, tandanya produk berhasil masuk!'
            },
            {
                icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 01-8 0"></path></svg>`,
                judul: 'Cek Keranjang',
                desc: 'Klik ikon <b>keranjang</b> di pojok kanan atas. Di sini kamu bisa lihat semua produk yang sudah dipilih.'
            },
            {
                icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>`,
                judul: 'Atur Pesanan',
                desc: 'Bisa tambah atau kurangi jumlah barang. Kalau mau hapus, tinggal klik ikon <b>tempat sampah</b>. Total belanja otomatis terhitung!'
            },
            {
                icon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path></svg>`,
                judul: 'Checkout via WhatsApp',
                desc: 'Udah puas? Klik <b>Checkout via WhatsApp</b>. Nanti otomatis terbuka WhatsApp dengan daftar pesanan kamu. Tinggal kirim!'
            }
        ];

        let langkahSekarang = 0;

        function renderLangkah(index) {
            const l = langkahTutorial[index];
            const total = langkahTutorial.length;
            document.getElementById('tutorialContent').innerHTML = `
                <div class="tutorial-icon-box">${l.icon}</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">${l.judul}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">${l.desc}</p>
            `;
            const dots = document.getElementById('tutorialDots');
            dots.innerHTML = langkahTutorial.map((_, i) =>
                `<span class="tutorial-dot ${i === index ? 'active' : ''}" onclick="lompatLangkah(${i})"></span>`
            ).join('');
            document.getElementById('tutorialCounter').textContent = `${index + 1} / ${total}`;
            document.getElementById('tutorialPrev').disabled = index === 0;
            document.getElementById('tutorialNext').innerHTML = index === total - 1
                ? 'Selesai <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                : 'Selanjutnya <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>';
        }

        function gantiLangkah(arah) {
            const baru = langkahSekarang + arah;
            if (baru < 0 || baru >= langkahTutorial.length) return;
            langkahSekarang = baru;
            renderLangkah(langkahSekarang);
        }

        function lompatLangkah(index) {
            langkahSekarang = index;
            renderLangkah(langkahSekarang);
        }

        function bukaTutorial() {
            document.getElementById('tutorialOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
            langkahSekarang = 0;
            renderLangkah(0);
        }

        function tutupTutorial() {
            document.getElementById('tutorialOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.getElementById('tutorialBtn')?.addEventListener('click', bukaTutorial);
        document.getElementById('tutorialOverlay')?.addEventListener('click', function(e) {
            if (e.target === this) tutupTutorial();
        });
    </script>

    <script>
        // ===== ANIMASI TAMBAH KE KERANJANG =====
        function animasiTerbangKeKeranjang(buttonEl) {
            const cartIcon = document.querySelector('.cart-target');
            if (!cartIcon) return;

            const btnRect = buttonEl.getBoundingClientRect();
            const cartRect = cartIcon.getBoundingClientRect();

            const flyEl = document.createElement('div');
            flyEl.className = 'cart-fly-el';
            flyEl.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 01-8 0"></path></svg>';
            flyEl.style.left = (btnRect.left + btnRect.width / 2 - 24) + 'px';
            flyEl.style.top = (btnRect.top + btnRect.height / 2 - 24) + 'px';
            document.body.appendChild(flyEl);

            const startX = btnRect.left + btnRect.width / 2 - 24;
            const startY = btnRect.top + btnRect.height / 2 - 24;
            const endX = cartRect.left + cartRect.width / 2 - 24;
            const endY = cartRect.top + cartRect.height / 2 - 24;
            const midX = (startX + endX) / 2;
            const midY = startY - 120;

            let progress = 0;
            const durasi = 500;
            const startTime = performance.now();

            function frame(now) {
                const elapsed = now - startTime;
                progress = Math.min(elapsed / durasi, 1);
                const ease = 1 - Math.pow(1 - progress, 3);
                const x = (1 - ease) * (1 - ease) * startX + 2 * (1 - ease) * ease * midX + ease * ease * endX;
                const y = (1 - ease) * (1 - ease) * startY + 2 * (1 - ease) * ease * midY + ease * ease * endY;
                flyEl.style.left = x + 'px';
                flyEl.style.top = y + 'px';
                flyEl.style.transform = `scale(${1 - progress * 0.3})`;
                flyEl.style.opacity = 1 - progress * 0.5;
                if (progress < 1) {
                    requestAnimationFrame(frame);
                } else {
                    flyEl.remove();
                    updateBadgeKeranjang();
                    tampilkanNotifikasi();
                }
            }
            requestAnimationFrame(frame);
        }

        function updateBadgeKeranjang() {
            const desktopBadge = document.querySelector('.cart-badge-desktop');
            const mobileBadge = document.querySelector('.cart-badge-mobile');
            fetch('{{ route('cart.count') }}')
                .then(r => r.json())
                .then(data => {
                    const count = data.count || 0;
                    [desktopBadge, mobileBadge].forEach(el => {
                        if (el) {
                            if (count > 0) {
                                el.textContent = count;
                                el.classList.remove('hidden');
                                el.classList.remove('badge-bounce');
                                void el.offsetWidth;
                                el.classList.add('badge-bounce');
                            } else {
                                el.classList.add('hidden');
                            }
                        }
                    });
                });
        }

        function tampilkanNotifikasi() {
            let toast = document.getElementById('cartToast');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'cartToast';
                toast.className = 'cart-toast';
                toast.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Berhasil ditambahkan ke keranjang!';
                document.body.appendChild(toast);
            }
            toast.classList.add('show');
            clearTimeout(toast._timer);
            toast._timer = setTimeout(() => toast.classList.remove('show'), 2500);
        }

        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.matches('form.ajax-cart')) {
                e.preventDefault();
                const btn = form.querySelector('button[type="submit"]');
                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        if (btn) animasiTerbangKeKeranjang(btn);
                        else updateBadgeKeranjang();
                    }
                });
            }
        });
    </script>
</body>
</html>
