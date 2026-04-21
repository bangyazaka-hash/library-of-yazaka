<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Landing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-up': 'fadeUp 0.8s ease-out forwards',
                        'fade-up-1': 'fadeUp 0.8s ease-out 0.2s forwards',
                        'fade-up-2': 'fadeUp 0.8s ease-out 0.4s forwards',
                        'fade-up-3': 'fadeUp 0.8s ease-out 0.6s forwards',
                        'slide-down': 'slideDown 0.6s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'bg-zoom': 'bgZoom 20s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        },
                        bgZoom: {
                            '0%': { transform: 'scale(1)' },
                            '100%': { transform: 'scale(1.05)' },
                        },
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-black text-white">

<!-- HERO -->
<!-- Diubah jadi flex-col biar konten tidak nabrak -->
<section class="relative min-h-screen w-full overflow-hidden flex flex-col">

    <!-- BACKGROUND IMAGE -->
    <img src="{{ asset('/library.jpg') }}"
         class="absolute w-full h-full object-cover animate-bg-zoom">

    <!-- DARK OVERLAY -->
    <div class="absolute inset-0 bg-black/70"></div>

    <!-- FLOATING PARTICLES -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-20 left-10 w-2 h-2 bg-orange-400 rounded-full animate-float opacity-60"></div>
        <div class="absolute top-40 right-20 w-3 h-3 bg-orange-300 rounded-full animate-float-slow opacity-40"></div>
        <div class="absolute bottom-40 left-1/4 w-2 h-2 bg-white rounded-full animate-float opacity-30"></div>
        <div class="absolute top-1/3 right-1/3 w-1.5 h-1.5 bg-orange-400 rounded-full animate-float-slow opacity-50"></div>
    </div>

    <!-- NAVBAR -->
    <!-- Fixed biar tetap di atas, atau relative biasa -->
    <nav class="relative z-20 flex justify-between items-center px-6 md:px-10 py-6 opacity-0 animate-slide-down">
        <h1 class="text-2xl font-bold text-orange-400 transition-transform duration-300 hover:scale-105 cursor-pointer">
            Yazaka.
        </h1>

        <div class="hidden md:flex gap-8 text-sm">
            <a href="#" class="hover:text-orange-400 transition-colors duration-300 relative group">
                Beranda
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-400 transition-all duration-300 group-hover:w-full"></span>
            </a>
            <a href="/siswa/dashboard" class="hover:text-orange-400 transition-colors duration-300 relative group">
                Jelajahi
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-400 transition-all duration-300 group-hover:w-full"></span>
            </a>
        </div>

        <a href="{{ route('login') }}"
           class="bg-orange-400 text-white px-5 py-2 rounded-xl text-sm font-medium
                  hover:bg-orange-500 transition-all duration-300 hover:scale-105 
                  hover:shadow-lg hover:shadow-orange-400/30 active:scale-95">
            Masuk
        </a>
    </nav>

    <!-- CONTENT WRAPPER (Flex Grow biar nutup space tengah) -->
    <div class="relative z-10 flex-grow flex items-center px-6 md:px-10">
        <div class="max-w-6xl mx-auto w-full py-10 md:py-0">
            
            <h2 class="text-4xl md:text-6xl font-bold leading-tight opacity-0 animate-fade-up">
                Tempat Ilmu <br>
                <span class="text-orange-400">
                    Bertumbuh, Masa Depan Terbentuk.
                </span>
            </h2>

            <p class="mt-6 text-gray-300 max-w-xl text-sm md:text-base opacity-0 animate-fade-up-1">
               Baca buku nggak harus ribet. Di sini, semua ada dalam genggaman. 
               Nikmati dan pinjamlah koleksi buku favoritmu secara simpel, dan efisien.
            </p>
            
            <!-- CTA BUTTON -->
            <a href="/siswa/dashboard" 
               class="inline-block mt-8 bg-orange-400 text-white px-8 py-3 rounded-xl font-medium
                      opacity-0 animate-fade-up-2
                      transition-all duration-300 hover:bg-orange-500 hover:scale-105 
                      hover:shadow-xl hover:shadow-orange-400/30 active:scale-95">
                Mulai Jelajahi
            </a>
        </div>
    </div>

    <!-- FEATURES (Di bawah, nggak absolute lagi biar ga nabrak) -->
    <div class="relative z-10 w-full px-6 md:px-10 pb-10 mt-auto">
        
        <!-- Fixed width container biar card ga melar -->
        <div class="max-w-5xl mx-auto">
            <div class="grid md:grid-cols-3 gap-4 md:gap-6 bg-white/10 backdrop-blur-md p-6 rounded-3xl opacity-0 animate-fade-up-3">

                <!-- Card 1 -->
                <div class="p-4 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] 
                            hover:shadow-lg hover:shadow-orange-400/10 cursor-pointer group">
                    <div class="w-10 h-10 bg-orange-400/20 rounded-lg flex items-center justify-center mb-3
                                transition-all duration-300 group-hover:bg-orange-400">
                        <svg class="w-5 h-5 text-orange-400 transition-colors duration-300 group-hover:text-white" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-orange-400 font-bold text-base md:text-lg">Koleksi Menarik</h3>
                    <p class="text-gray-400 text-xs md:text-sm mt-1">
                       Banyak buku yang sangat menarik untuk dibaca.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-4 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] 
                            hover:shadow-lg hover:shadow-orange-400/10 cursor-pointer group">
                    <div class="w-10 h-10 bg-orange-400/20 rounded-lg flex items-center justify-center mb-3
                                transition-all duration-300 group-hover:bg-orange-400">
                        <svg class="w-5 h-5 text-orange-400 transition-colors duration-300 group-hover:text-white" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-orange-400 font-bold text-base md:text-lg">Peminjaman Mudah</h3>
                    <p class="text-gray-400 text-xs md:text-sm mt-1">
                        Pinjam buku kapan saja secara online dan praktis.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-4 rounded-2xl transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] 
                            hover:shadow-lg hover:shadow-orange-400/10 cursor-pointer group">
                    <div class="w-10 h-10 bg-orange-400/20 rounded-lg flex items-center justify-center mb-3
                                transition-all duration-300 group-hover:bg-orange-400">
                        <svg class="w-5 h-5 text-orange-400 transition-colors duration-300 group-hover:text-white" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-orange-400 font-bold text-base md:text-lg">Kelola Terstruktur</h3>
                    <p class="text-gray-400 text-xs md:text-sm mt-1">
                        Data buku, anggota, dan transaksi dikelola dengan rapi.
                    </p>
                </div>

            </div>

            <!-- QUOTE -->
            <p class="text-center text-gray-400 mt-6 text-sm italic opacity-0 animate-fade-up-3">
                "Membaca adalah jendela dunia. Perpustakaan adalah kuncinya."
            </p>
        </div>
    </div>

</section>

</body>
</html>