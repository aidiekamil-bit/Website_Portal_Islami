<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuoteVerse - Warm Earth & Brown Inspiration</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- html2canvas for exporting quote cards -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Outfit"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                        body: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        espresso: {
                            50: '#f7f4f2',
                            100: '#eee8e3',
                            200: '#dbcfc6',
                            300: '#c5b1a3',
                            500: '#8e6c58',
                            800: '#432a1e',
                            900: '#2c1810',
                            950: '#1a0d08',
                        },
                        caramel: {
                            400: '#d99d6c',
                            500: '#c88a58',
                            600: '#b27343',
                        },
                        ochre: {
                            400: '#e2b385',
                            500: '#d4a373',
                            600: '#be8c5c',
                        },
                        sage: {
                            300: '#a3b19c',
                            400: '#81937a',
                            500: '#687a61',
                            700: '#43513e',
                        },
                        cream: {
                            50: '#fdfbf7',
                            100: '#f5efe6',
                            200: '#e8dfd1',
                            300: '#d7c8b2',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'soft-pulse': 'softPulse 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-8px)' },
                        },
                        softPulse: {
                            '0%, 100%': { opacity: 0.8 },
                            '50%': { opacity: 1 },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Glassmorphism with Warm Brown Tint */
        .glass-warm {
            background: rgba(253, 251, 247, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(212, 163, 115, 0.25);
        }
        .glass-dark-warm {
            background: rgba(44, 24, 16, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(200, 138, 88, 0.3);
        }
        .glass-card {
            background: rgba(245, 239, 230, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 163, 115, 0.3);
        }

        /* Earth Themes Palette Classes */
        .palette-espresso {
            background: linear-gradient(135deg, #fdfbf7 0%, #f5efe6 50%, #e8dfd1 100%);
            color: #2c1810;
        }
        .palette-sage {
            background: linear-gradient(135deg, #f4f6f3 0%, #e8eee6 50%, #d8e2d4 100%);
            color: #233020;
        }
        .palette-caramel {
            background: linear-gradient(135deg, #fffbf7 0%, #fbf1e5 50%, #f3dfc8 100%);
            color: #381e13;
        }
        .palette-vintage {
            background: linear-gradient(135deg, #fcf9f2 0%, #f3ebd9 50%, #e4d5b7 100%);
            color: #312111;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f5efe6;
        }
        ::-webkit-scrollbar-thumb {
            background: #c5b1a3;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #8e6c58;
        }

        /* Quote transition animation */
        .quote-transition {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .quote-hide {
            opacity: 0;
            transform: translateY(12px) scale(0.98);
        }
        .quote-show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    </style>
</head>
<body id="app-body" class="palette-espresso min-h-screen font-sans antialiased selection:bg-caramel-500 selection:text-white flex flex-col justify-between transition-colors duration-500">

    <header class="sticky top-0 z-40 glass-warm shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo -->
            <div class="flex items-center space-x-3 cursor-pointer group" onclick="switchView('hero')">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-espresso-900 via-caramel-500 to-ochre-500 flex items-center justify-center shadow-lg shadow-caramel-500/20 group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="quote" class="w-5 h-5 text-cream-50"></i>
                </div>
                <div>
                    <span class="text-2xl font-serif font-bold tracking-tight text-espresso-900 block leading-none">
                        QuoteVerse
                    </span>
                    <span class="text-[10px] font-semibold tracking-widest text-caramel-600 uppercase">Warm Earth Wisdom</span>
                </div>
            </div>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden md:flex items-center space-x-1.5 bg-espresso-900/5 p-1.5 rounded-2xl border border-espresso-900/10">
                <button onclick="switchView('hero')" id="nav-hero" class="nav-btn px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-200 text-cream-50 bg-espresso-900 shadow-sm flex items-center gap-2">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Utama
                </button>
                <button onclick="switchView('explore')" id="nav-explore" class="nav-btn px-4 py-2 rounded-xl text-xs font-semibold text-espresso-800 hover:text-espresso-950 hover:bg-espresso-900/10 transition-all duration-200 flex items-center gap-2">
                    <i data-lucide="compass" class="w-4 h-4"></i> Jelajah
                </button>
                <button onclick="switchView('favorites')" id="nav-favorites" class="nav-btn px-4 py-2 rounded-xl text-xs font-semibold text-espresso-800 hover:text-espresso-950 hover:bg-espresso-900/10 transition-all duration-200 flex items-center gap-2 relative">
                    <i data-lucide="bookmark" class="w-4 h-4"></i> Favorit
                    <span id="fav-badge" class="px-1.5 py-0.5 text-[10px] font-bold bg-caramel-500 text-white rounded-full hidden">0</span>
                </button>
            </nav>

            <!-- Actions Header -->
            <div class="flex items-center space-x-3">
                <!-- Brown Sub-Palette Selector -->
                <div class="relative">
                    <button id="theme-menu-btn" onclick="toggleThemeDropdown()" class="px-3 py-2 rounded-xl glass-card hover:bg-white/80 text-espresso-900 transition-all flex items-center gap-2 border border-ochre-500/30 text-xs font-semibold shadow-xs" title="Ganti Suasana Warna">
                        <i data-lucide="palette" class="w-4 h-4 text-caramel-600"></i>
                        <span class="hidden sm:inline">Tema Earth</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-espresso-500"></i>
                    </button>

                    <!-- Theme Selector Dropdown -->
                    <div id="theme-dropdown" class="hidden absolute right-0 mt-2 w-52 glass-dark-warm rounded-2xl shadow-2xl p-2 z-50 text-cream-100 animate-fade-in">
                        <div class="text-[10px] font-bold text-ochre-400 px-3 py-1.5 uppercase tracking-wider">Pilih Suasana Warna</div>
                        <button onclick="setPalette('palette-espresso')" class="w-full flex items-center space-x-3 px-3 py-2 rounded-xl text-xs font-medium hover:bg-white/10 transition-colors text-left">
                            <span class="w-4 h-4 rounded-full bg-gradient-to-tr from-espresso-900 to-caramel-500 border border-cream-200/20"></span>
                            <span>Warm Espresso</span>
                        </button>
                        <button onclick="setPalette('palette-caramel')" class="w-full flex items-center space-x-3 px-3 py-2 rounded-xl text-xs font-medium hover:bg-white/10 transition-colors text-left">
                            <span class="w-4 h-4 rounded-full bg-gradient-to-tr from-caramel-500 to-ochre-400 border border-cream-200/20"></span>
                            <span>Caramel Cream</span>
                        </button>
                        <button onclick="setPalette('palette-sage')" class="w-full flex items-center space-x-3 px-3 py-2 rounded-xl text-xs font-medium hover:bg-white/10 transition-colors text-left">
                            <span class="w-4 h-4 rounded-full bg-gradient-to-tr from-sage-500 to-espresso-800 border border-cream-200/20"></span>
                            <span>Sage & Chocolate</span>
                        </button>
                        <button onclick="setPalette('palette-vintage')" class="w-full flex items-center space-x-3 px-3 py-2 rounded-xl text-xs font-medium hover:bg-white/10 transition-colors text-left">
                            <span class="w-4 h-4 rounded-full bg-gradient-to-tr from-ochre-600 to-cream-300 border border-cream-200/20"></span>
                            <span>Vintage Gold</span>
                        </button>
                    </div>
                </div>

                <!-- Add Custom Quote Button -->
                <button onclick="openAddModal()" class="hidden sm:flex items-center space-x-1.5 px-4 py-2 rounded-xl bg-espresso-900 hover:bg-espresso-800 text-cream-50 text-xs font-semibold shadow-md shadow-espresso-900/20 transition-all hover:scale-105 active:scale-95">
                    <i data-lucide="plus" class="w-4 h-4 text-ochre-400"></i>
                    <span>Tulis Kutipan</span>
                </button>

                <!-- Mobile Menu Toggle -->
                <button onclick="toggleMobileNav()" class="md:hidden p-2.5 rounded-xl glass-card text-espresso-900">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-menu" class="hidden md:hidden glass-warm border-t border-espresso-900/10 px-4 pt-3 pb-5 space-y-2">
            <button onclick="switchView('hero'); toggleMobileNav();" class="w-full text-left px-4 py-2.5 rounded-xl font-medium text-espresso-900 hover:bg-espresso-900/10 flex items-center space-x-3">
                <i data-lucide="sparkles" class="w-5 h-5 text-caramel-600"></i>
                <span>Utama</span>
            </button>
            <button onclick="switchView('explore'); toggleMobileNav();" class="w-full text-left px-4 py-2.5 rounded-xl font-medium text-espresso-900 hover:bg-espresso-900/10 flex items-center space-x-3">
                <i data-lucide="compass" class="w-5 h-5 text-sage-500"></i>
                <span>Jelajah Kutipan</span>
            </button>
            <button onclick="switchView('favorites'); toggleMobileNav();" class="w-full text-left px-4 py-2.5 rounded-xl font-medium text-espresso-900 hover:bg-espresso-900/10 flex items-center space-x-3">
                <i data-lucide="bookmark" class="w-5 h-5 text-ochre-500"></i>
                <span>Kutipan Favorit</span>
            </button>
            <button onclick="openAddModal(); toggleMobileNav();" class="w-full text-left px-4 py-2.5 rounded-xl font-medium text-caramel-600 hover:bg-espresso-900/10 flex items-center space-x-3">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                <span>Tambah Kutipan Sendiri</span>
            </button>
        </div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col justify-center">

        <!-- VIEW 1: HERO / GENERATOR UTAMA -->
        <section id="view-hero" class="view-section space-y-8">

            <!-- Hero Main Interactive Display Card -->
            <div class="glass-warm rounded-3xl p-6 sm:p-12 relative overflow-hidden shadow-xl border border-ochre-500/20">
                
                <!-- Background Decorative Watermark Icon -->
                <i data-lucide="quote" class="absolute -top-6 -left-6 w-40 h-40 text-espresso-900/5 pointer-events-none"></i>
                <i data-lucide="sparkles" class="absolute -bottom-10 -right-10 w-48 h-48 text-caramel-500/10 pointer-events-none"></i>

                <!-- Top Meta Row -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-espresso-900/10 border border-espresso-900/15 text-espresso-900 text-xs font-semibold tracking-wider uppercase">
                        <i data-lucide="sun" class="w-3.5 h-3.5 text-caramel-600"></i>
                        <span id="hero-tag">Inspirasi Hari Ini</span>
                    </div>

                    <!-- Quick Action Tool Buttons -->
                    <div class="flex items-center space-x-2">
                        <button onclick="speakCurrentQuote()" id="btn-speak" class="p-2.5 rounded-xl glass-card hover:bg-white text-espresso-800 hover:text-caramel-600 transition-all shadow-xs" title="Dengarkan (Text-to-Speech)">
                            <i data-lucide="volume-2" class="w-5 h-5"></i>
                        </button>
                        <button onclick="toggleCurrentFavorite()" id="btn-hero-fav" class="p-2.5 rounded-xl glass-card hover:bg-white text-espresso-800 hover:text-caramel-600 transition-all shadow-xs" title="Simpan ke Favorit">
                            <i data-lucide="bookmark" class="w-5 h-5"></i>
                        </button>
                        <button onclick="copyCurrentQuote()" class="p-2.5 rounded-xl glass-card hover:bg-white text-espresso-800 hover:text-sage-500 transition-all shadow-xs" title="Salin Teks">
                            <i data-lucide="copy" class="w-5 h-5"></i>
                        </button>
                        <button onclick="exportCurrentQuoteCard()" class="p-2.5 rounded-xl glass-card hover:bg-white text-espresso-800 hover:text-ochre-500 transition-all shadow-xs" title="Unduh Kartu Gambar (Export Canvas)">
                            <i data-lucide="image" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Interactive Quote Text Box -->
                <div id="quote-card-container" class="relative my-6 py-2 px-1 min-h-[180px] flex flex-col justify-center">
                    <p id="quote-text" class="text-2xl sm:text-4xl md:text-5xl font-serif italic leading-relaxed sm:leading-snug text-espresso-900 font-semibold quote-transition quote-show">
                        "Loading inspirasi indah..."
                    </p>
                    
                    <!-- Quote Author & Category -->
                    <div class="mt-8 flex items-center justify-between flex-wrap gap-4 pt-6 border-t border-espresso-900/10">
                        <div>
                            <h3 id="quote-author" class="text-lg sm:text-xl font-bold text-espresso-900 font-sans tracking-tight">
                                Penulis
                            </h3>
                            <p id="quote-category" class="text-xs font-semibold text-caramel-600 uppercase tracking-widest mt-1">
                                Kategori
                            </p>
                        </div>

                        <!-- Next Quote Trigger Button -->
                        <button onclick="nextRandomQuote()" class="group px-7 py-3.5 rounded-2xl bg-espresso-900 hover:bg-espresso-800 text-cream-50 font-semibold text-sm shadow-lg shadow-espresso-900/25 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center space-x-2.5">
                            <span>Kutipan Selanjutnya</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Pills Bar -->
            <div class="space-y-3">
                <div class="flex items-center justify-between px-1">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-espresso-800/70">Pilih Topik Kutipan</h4>
                    <span class="text-xs text-caramel-600 font-medium">Klik topik untuk memfilter</span>
                </div>
                <div class="flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-none" id="hero-category-pills">
                    <!-- Category pills populated by JS -->
                </div>
            </div>
        </section>

        <!-- VIEW 2: JELAJAH & PENCARIAN -->
        <section id="view-explore" class="view-section hidden space-y-6">
            <!-- Search & Filter Controls -->
            <div class="glass-warm rounded-2xl p-4 sm:p-6 space-y-4 shadow-sm border border-ochre-500/20">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <!-- Search Input Bar -->
                    <div class="relative w-full md:w-96">
                        <i data-lucide="search" class="absolute left-3.5 top-3.5 w-4 h-4 text-espresso-500"></i>
                        <input type="text" id="search-input" oninput="filterQuotes()" placeholder="Cari kutipan, tokoh, kata kunci..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/80 border border-espresso-900/15 text-espresso-900 text-sm placeholder-espresso-500/60 focus:outline-none focus:ring-2 focus:ring-caramel-500/50 transition-all">
                    </div>

                    <!-- Category & Sort Selectors -->
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <select id="category-select" onchange="filterQuotes()" class="w-full md:w-48 px-3.5 py-2.5 rounded-xl bg-white/80 border border-espresso-900/15 text-espresso-900 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-caramel-500/50">
                            <option value="ALL">Semua Kategori</option>
                            <!-- Options JS -->
                        </select>
                        <select id="sort-select" onchange="filterQuotes()" class="w-full md:w-40 px-3.5 py-2.5 rounded-xl bg-white/80 border border-espresso-900/15 text-espresso-900 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-caramel-500/50">
                            <option value="newest">Terbaru</option>
                            <option value="author">Nama Tokoh (A-Z)</option>
                            <option value="length">Teks Terpendek</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Quotes Masonry Grid -->
            <div id="quotes-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Quote cards injected by JS -->
            </div>

            <!-- Empty Results State -->
            <div id="no-results" class="hidden text-center py-16 glass-warm rounded-3xl p-8 border border-espresso-900/10">
                <i data-lucide="search-x" class="w-12 h-12 text-espresso-500 mx-auto mb-3"></i>
                <h3 class="text-lg font-bold text-espresso-900">Kutipan Tidak Ditemukan</h3>
                <p class="text-xs text-espresso-700 mt-1">Coba kata kunci lain atau pilih kategori yang berbeda.</p>
            </div>
        </section>

        <!-- VIEW 3: FAVORIT / BOOKMARKS -->
        <section id="view-favorites" class="view-section hidden space-y-6">
            <div class="flex items-center justify-between border-b border-espresso-900/10 pb-4">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-espresso-900">Kutipan Favorit Anda</h2>
                    <p class="text-xs text-espresso-700 mt-0.5">Kumpulan kalimat inspiratif yang tersimpan di perangkat Anda.</p>
                </div>
                <button onclick="clearAllFavorites()" id="btn-clear-favs" class="hidden px-3.5 py-2 rounded-xl bg-red-900/10 hover:bg-red-900/20 text-red-900 border border-red-900/20 text-xs font-semibold transition-all">
                    Hapus Semua
                </button>
            </div>

            <!-- Favorites Grid Container -->
            <div id="favorites-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Cards injected JS -->
            </div>

            <!-- Empty Favorites Placeholder -->
            <div id="no-favorites" class="text-center py-16 glass-warm rounded-3xl p-8 border border-espresso-900/10">
                <div class="w-16 h-16 bg-caramel-500/10 border border-caramel-500/20 rounded-full flex items-center justify-center mx-auto mb-4 text-caramel-600">
                    <i data-lucide="bookmark" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold text-espresso-900">Belum Ada Favorit</h3>
                <p class="text-xs text-espresso-700 max-w-md mx-auto mt-2 leading-relaxed">
                    Klik ikon penanda (bookmark) pada kutipan mana saja untuk menyimpannya di sini.
                </p>
                <button onclick="switchView('hero')" class="mt-6 px-5 py-2.5 rounded-xl bg-espresso-900 hover:bg-espresso-800 text-cream-50 text-xs font-semibold shadow-md transition-all">
                    Jelajahi Kutipan Sekarang
                </button>
            </div>
        </section>

    </main>

    <!-- Modal: Add Custom Quote -->
    <div id="add-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-espresso-950/60 backdrop-blur-md">
        <div class="glass-dark-warm rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative border border-caramel-500/30 text-cream-50">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-cream-200/10">
                <div class="flex items-center space-x-2">
                    <i data-lucide="pen-tool" class="w-5 h-5 text-ochre-400"></i>
                    <h3 class="text-xl font-serif font-bold text-cream-50">Tulis Kutipan Anda</h3>
                </div>
                <button onclick="closeAddModal()" class="p-2 rounded-xl hover:bg-white/10 text-cream-200">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Form -->
            <form id="add-quote-form" onsubmit="handleCreateQuote(event)" class="mt-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ochre-400 mb-2">Teks Kutipan *</label>
                    <textarea id="modal-quote-text" required rows="4" placeholder="Tuliskan kata-kata mutiara atau inspirasi Anda..." class="w-full p-3.5 rounded-xl bg-espresso-900/60 border border-cream-200/20 text-cream-50 text-sm placeholder-cream-200/40 focus:outline-none focus:border-caramel-500 resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ochre-400 mb-2">Penulis / Tokoh *</label>
                    <input type="text" id="modal-quote-author" required placeholder="Contoh: Soekarno, Pramoedya, atau Anonim" class="w-full p-3.5 rounded-xl bg-espresso-900/60 border border-cream-200/20 text-cream-50 text-sm placeholder-cream-200/40 focus:outline-none focus:border-caramel-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ochre-400 mb-2">Kategori *</label>
                    <select id="modal-quote-category" required class="w-full p-3.5 rounded-xl bg-espresso-900 border border-cream-200/20 text-cream-50 text-xs font-semibold focus:outline-none">
                        <option value="Motivasi">Motivasi</option>
                        <option value="Kehidupan">Kehidupan</option>
                        <option value="Cinta">Cinta</option>
                        <option value="Filosofi">Filosofi</option>
                        <option value="Sukses">Sukses</option>
                        <option value="Kedamaian">Kedamaian</option>
                    </select>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-cream-200/10">
                    <button type="button" onclick="closeAddModal()" class="px-5 py-2.5 rounded-xl hover:bg-white/10 text-cream-200 text-xs font-semibold">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-caramel-500 hover:bg-caramel-600 text-white text-xs font-semibold shadow-lg transition-all">
                        Simpan Kutipan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden Export Card Element (Target for html2canvas Export) -->
    <div id="export-card-hidden" class="fixed -top-[9999px] -left-[9999px] w-[540px] min-h-[540px] p-12 bg-gradient-to-br from-espresso-950 via-espresso-900 to-caramel-600 text-cream-50 rounded-3xl shadow-2xl flex flex-col justify-between border-4 border-ochre-500/30">
        <div class="flex items-center justify-between border-b border-cream-200/15 pb-4">
            <span class="text-xs font-bold tracking-widest text-ochre-400 uppercase">QuoteVerse • Warm Collection</span>
            <i data-lucide="quote" class="w-8 h-8 text-ochre-400/40"></i>
        </div>
        <div class="my-auto py-8">
            <p id="export-text" class="text-3xl font-serif italic leading-relaxed text-cream-50">
                ""
            </p>
        </div>
        <div class="pt-4 flex items-center justify-between border-t border-cream-200/15">
            <span id="export-author" class="text-lg font-bold text-cream-100 font-sans"></span>
            <span id="export-category" class="text-xs font-semibold uppercase px-3 py-1 rounded-full bg-ochre-500/20 text-ochre-300 border border-ochre-500/30"></span>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 hidden flex items-center space-x-3 px-5 py-3.5 rounded-2xl glass-dark-warm text-cream-50 border border-caramel-500/40 shadow-2xl transition-all duration-300 transform translate-y-10 opacity-0">
        <i data-lucide="check-circle" id="toast-icon" class="w-5 h-5 text-caramel-500"></i>
        <span id="toast-message" class="text-xs font-semibold">Pesan notifikasi</span>
    </div>

    <!-- Footer -->
    <footer class="glass-warm border-t border-espresso-900/10 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-espresso-700 text-center sm:text-left">
                © <span id="current-year"></span> QuoteVerse. Dirancang dengan kehangatan warna bumi.
            </p>
            <div class="flex items-center space-x-4 text-xs font-semibold text-espresso-800">
                <span class="hover:text-caramel-600 cursor-pointer" onclick="switchView('hero')">Utama</span>
                <span>•</span>
                <span class="hover:text-caramel-600 cursor-pointer" onclick="switchView('explore')">Jelajah</span>
                <span>•</span>
                <span class="hover:text-caramel-600 cursor-pointer" onclick="switchView('favorites')">Favorit</span>
            </div>
        </div>
    </footer>

    <script>
        // Default Initial Indonesian & English Quotes Collection
        const INITIAL_QUOTES = [
            {
                id: 'q1',
                text: "Bermimpilah setinggi langit. Jika engkau jatuh, engkau akan jatuh di antara bintang-bintang.",
                author: "Ir. Soekarno",
                category: "Motivasi"
            },
            {
                id: 'q2',
                text: "Berbuat baiklah tanpa perlu alasan, karena kebaikan yang tulus selalu menemukan jalannya kembali.",
                author: "Pramoedya Ananta Toer",
                category: "Kehidupan"
            },
            {
                id: 'q3',
                text: "Hidup yang tidak dipertaruhkan tidak akan pernah dimenangkan.",
                author: "Sutan Sjahrir",
                category: "Sukses"
            },
            {
                id: 'q4',
                text: "The only way to do great work is to love what you do.",
                author: "Steve Jobs",
                category: "Sukses"
            },
            {
                id: 'q5',
                text: "Cinta tidak berupa tatapan satu sama lain, melainkan melihat bersama ke arah yang sama.",
                author: "B.J. Habibie",
                category: "Cinta"
            },
            {
                id: 'q6',
                text: "Dalam kedamaian dan ketenangan pikiran, terdapat kekuatan terbesar manusia.",
                author: "Lao Tzu",
                category: "Kedamaian"
            },
            {
                id: 'q7',
                text: "In the middle of difficulty lies opportunity.",
                author: "Albert Einstein",
                category: "Filosofi"
            },
            {
                id: 'q8',
                text: "Jadilah perubahan yang ingin kamu lihat di dunia ini.",
                author: "Mahatma Gandhi",
                category: "Motivasi"
            },
            {
                id: 'q9',
                text: "Kecantikan sejati tidak terlihat oleh mata, melainkan dirasakan oleh hati.",
                author: "Helen Keller",
                category: "Cinta"
            },
            {
                id: 'q10',
                text: "Kedamaian dimulai dengan sebuah senyuman yang tulus.",
                author: "Bunda Teresa",
                category: "Kedamaian"
            },
            {
                id: 'q11',
                text: "Happiness is not something ready made. It comes from your own actions.",
                author: "Dalai Lama",
                category: "Filosofi"
            },
            {
                id: 'q12',
                text: "Pendidikan adalah senjata paling mematikan untuk mengubah dunia.",
                author: "Nelson Mandela",
                category: "Kehidupan"
            }
        ];

        let quotes = [];
        let favorites = [];
        let currentQuote = null;
        let activeCategory = 'ALL';
        let activeView = 'hero';

        window.onload = function() {
            document.getElementById('current-year').innerText = new Date().getFullYear();
            loadLocalData();
            lucide.createIcons();
            renderCategories();
            nextRandomQuote();
            renderExploreGrid();
            renderFavoritesGrid();
        };

        function loadLocalData() {
            const storedQuotes = localStorage.getItem('qv_earth_quotes');
            if (storedQuotes) {
                try {
                    quotes = JSON.parse(storedQuotes);
                } catch(e) {
                    quotes = [...INITIAL_QUOTES];
                }
            } else {
                quotes = [...INITIAL_QUOTES];
                localStorage.setItem('qv_earth_quotes', JSON.stringify(quotes));
            }

            const storedFavs = localStorage.getItem('qv_earth_favs');
            if (storedFavs) {
                try {
                    favorites = JSON.parse(storedFavs);
                } catch(e) {
                    favorites = [];
                }
            }
            updateFavBadge();
        }

        function saveLocalQuotes() {
            localStorage.setItem('qv_earth_quotes', JSON.stringify(quotes));
        }

        function saveLocalFavs() {
            localStorage.setItem('qv_earth_favs', JSON.stringify(favorites));
            updateFavBadge();
        }

        function updateFavBadge() {
            const badge = document.getElementById('fav-badge');
            if (favorites.length > 0) {
                badge.innerText = favorites.length;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        function switchView(viewName) {
            activeView = viewName;
            
            document.querySelectorAll('.view-section').forEach(el => el.classList.add('hidden'));

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('bg-espresso-900', 'text-cream-50', 'shadow-sm');
                btn.classList.add('text-espresso-800');
            });

            const targetView = document.getElementById(`view-${viewName}`);
            if (targetView) targetView.classList.remove('hidden');

            const activeNavBtn = document.getElementById(`nav-${viewName}`);
            if (activeNavBtn) {
                activeNavBtn.classList.add('bg-espresso-900', 'text-cream-50', 'shadow-sm');
                activeNavBtn.classList.remove('text-espresso-800');
            }

            if (viewName === 'explore') renderExploreGrid();
            if (viewName === 'favorites') renderFavoritesGrid();

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function toggleMobileNav() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }

        function toggleThemeDropdown() {
            document.getElementById('theme-dropdown').classList.toggle('hidden');
        }

        function setPalette(paletteClass) {
            const body = document.getElementById('app-body');
            body.className = `min-h-screen font-sans antialiased selection:bg-caramel-500 selection:text-white flex flex-col justify-between transition-colors duration-500 ${paletteClass}`;
            toggleThemeDropdown();
            showToast('Suasana warna diperbarui');
        }

        function nextRandomQuote() {
            let pool = quotes;
            if (activeCategory !== 'ALL') {
                pool = quotes.filter(q => q.category.toLowerCase() === activeCategory.toLowerCase());
            }

            if (pool.length === 0) pool = quotes;

            let randomIndex = Math.floor(Math.random() * pool.length);
            if (currentQuote && pool.length > 1 && pool[randomIndex].id === currentQuote.id) {
                randomIndex = (randomIndex + 1) % pool.length;
            }

            currentQuote = pool[randomIndex];

            const quoteText = document.getElementById('quote-text');
            quoteText.classList.remove('quote-show');
            quoteText.classList.add('quote-hide');

            setTimeout(() => {
                document.getElementById('quote-text').innerText = `"${currentQuote.text}"`;
                document.getElementById('quote-author').innerText = `— ${currentQuote.author}`;
                document.getElementById('quote-category').innerText = currentQuote.category;

                quoteText.classList.remove('quote-hide');
                quoteText.classList.add('quote-show');

                updateHeroFavButtonState();
            }, 200);
        }

        function updateHeroFavButtonState() {
            const btn = document.getElementById('btn-hero-fav');
            if (!currentQuote) return;

            const isFav = favorites.some(f => f.id === currentQuote.id);
            if (isFav) {
                btn.innerHTML = `<i data-lucide="bookmark" class="w-5 h-5 fill-caramel-500 text-caramel-600"></i>`;
            } else {
                btn.innerHTML = `<i data-lucide="bookmark" class="w-5 h-5 text-espresso-800"></i>`;
            }
            lucide.createIcons();
        }

        function toggleCurrentFavorite() {
            if (!currentQuote) return;
            toggleFavoriteById(currentQuote.id);
            updateHeroFavButtonState();
        }

        function renderCategories() {
            const categories = ['ALL', ...new Set(quotes.map(q => q.category))];
            
            const heroPillsContainer = document.getElementById('hero-category-pills');
            heroPillsContainer.innerHTML = categories.map(cat => `
                <button onclick="selectCategoryPill('${cat}')" class="px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap transition-all border ${activeCategory === cat ? 'bg-espresso-900 text-cream-50 border-espresso-900 shadow-md' : 'glass-card border-espresso-900/10 text-espresso-900 hover:bg-espresso-900/10'}">
                    ${cat === 'ALL' ? '🌟 Semua Topik' : cat}
                </button>
            `).join('');

            const selectContainer = document.getElementById('category-select');
            selectContainer.innerHTML = categories.map(cat => `
                <option value="${cat}">${cat === 'ALL' ? 'Semua Kategori' : cat}</option>
            `).join('');
        }

        function selectCategoryPill(category) {
            activeCategory = category;
            renderCategories();
            nextRandomQuote();
        }

        function renderExploreGrid() {
            const grid = document.getElementById('quotes-grid');
            const noResults = document.getElementById('no-results');

            const searchVal = document.getElementById('search-input').value.toLowerCase().trim();
            const selectedCat = document.getElementById('category-select').value;
            const sortBy = document.getElementById('sort-select').value;

            let filtered = quotes.filter(q => {
                const matchesSearch = q.text.toLowerCase().includes(searchVal) || q.author.toLowerCase().includes(searchVal);
                const matchesCat = selectedCat === 'ALL' || q.category === selectedCat;
                return matchesSearch && matchesCat;
            });

            if (sortBy === 'author') {
                filtered.sort((a, b) => a.author.localeCompare(b.author));
            } else if (sortBy === 'length') {
                filtered.sort((a, b) => a.text.length - b.text.length);
            }

            if (filtered.length === 0) {
                grid.innerHTML = '';
                noResults.classList.remove('hidden');
                return;
            } else {
                noResults.classList.add('hidden');
            }

            grid.innerHTML = filtered.map(quote => createQuoteCardHTML(quote)).join('');
            lucide.createIcons();
        }

        function filterQuotes() {
            renderExploreGrid();
        }

        function renderFavoritesGrid() {
            const grid = document.getElementById('favorites-grid');
            const noFavs = document.getElementById('no-favorites');
            const clearBtn = document.getElementById('btn-clear-favs');

            if (favorites.length === 0) {
                grid.innerHTML = '';
                noFavs.classList.remove('hidden');
                clearBtn.classList.add('hidden');
                return;
            }

            noFavs.classList.add('hidden');
            clearBtn.classList.remove('hidden');

            grid.innerHTML = favorites.map(quote => createQuoteCardHTML(quote)).join('');
            lucide.createIcons();
        }

        function createQuoteCardHTML(quote) {
            const isFav = favorites.some(f => f.id === quote.id);
            return `
                <div class="glass-warm rounded-2xl p-6 flex flex-col justify-between space-y-4 hover:border-caramel-500/50 transition-all duration-300 transform hover:-translate-y-1 group border border-espresso-900/10 shadow-xs">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full bg-espresso-900/10 text-espresso-900 border border-espresso-900/10">
                                ${quote.category}
                            </span>
                            <button onclick="toggleFavoriteById('${quote.id}')" class="p-2 rounded-xl glass-card hover:bg-white transition-all">
                                <i data-lucide="bookmark" class="w-4 h-4 ${isFav ? 'fill-caramel-500 text-caramel-600' : 'text-espresso-500 group-hover:text-caramel-600'}"></i>
                            </button>
                        </div>
                        <p class="font-serif italic text-espresso-900 leading-relaxed text-base">
                            "${quote.text}"
                        </p>
                    </div>

                    <div class="pt-4 border-t border-espresso-900/10 flex items-center justify-between">
                        <span class="text-xs font-bold text-espresso-900 font-sans">— ${quote.author}</span>
                        <div class="flex items-center space-x-1">
                            <button onclick="copyQuoteText('${quote.text.replace(/'/g, "\\'")}', '${quote.author.replace(/'/g, "\\'")}')" class="p-2 rounded-lg hover:bg-espresso-900/10 text-espresso-700 hover:text-sage-500 transition-colors" title="Salin Teks">
                                <i data-lucide="copy" class="w-4 h-4"></i>
                            </button>
                            <button onclick="speakText('${quote.text.replace(/'/g, "\\'")}')" class="p-2 rounded-lg hover:bg-espresso-900/10 text-espresso-700 hover:text-caramel-600 transition-colors" title="Dengarkan">
                                <i data-lucide="volume-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        function toggleFavoriteById(id) {
            const target = quotes.find(q => q.id === id);
            if (!target) return;

            const existingIndex = favorites.findIndex(f => f.id === id);
            if (existingIndex > -1) {
                favorites.splice(existingIndex, 1);
                showToast('Dihapus dari favorit');
            } else {
                favorites.push(target);
                showToast('Disimpan ke favorit!');
            }

            saveLocalFavs();

            if (activeView === 'explore') renderExploreGrid();
            if (activeView === 'favorites') renderFavoritesGrid();
            if (currentQuote && currentQuote.id === id) updateHeroFavButtonState();
        }

        function clearAllFavorites() {
            favorites = [];
            saveLocalFavs();
            renderFavoritesGrid();
            showToast('Semua favorit dihapus');
        }

        function copyCurrentQuote() {
            if (!currentQuote) return;
            copyQuoteText(currentQuote.text, currentQuote.author);
        }

        function copyQuoteText(text, author) {
            const copyContent = `"${text}" — ${author}`;
            const dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = copyContent;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);

            showToast('Teks berhasil disalin!');
        }

        function speakCurrentQuote() {
            if (!currentQuote) return;
            speakText(currentQuote.text);
        }

        function speakText(text) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.rate = 0.9;
                utterance.pitch = 1.0;
                window.speechSynthesis.speak(utterance);
                showToast('Memutar suara kutipan...');
            } else {
                showToast('Fitur suara tidak didukung peramban ini');
            }
        }

        function exportCurrentQuoteCard() {
            if (!currentQuote) return;

            document.getElementById('export-text').innerText = `"${currentQuote.text}"`;
            document.getElementById('export-author').innerText = `— ${currentQuote.author}`;
            document.getElementById('export-category').innerText = currentQuote.category;

            const exportNode = document.getElementById('export-card-hidden');

            showToast('Memproses gambar kartu...');

            html2canvas(exportNode, {
                backgroundColor: null,
                scale: 2
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = `Quote-${currentQuote.author.replace(/\s+/g, '-')}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                showToast('Gambar berhasil diunduh!');
            }).catch(err => {
                showToast('Gagal mengunduh gambar');
            });
        }

        function openAddModal() {
            document.getElementById('add-modal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('add-modal').classList.add('hidden');
            document.getElementById('add-quote-form').reset();
        }

        function handleCreateQuote(event) {
            event.preventDefault();
            const text = document.getElementById('modal-quote-text').value.trim();
            const author = document.getElementById('modal-quote-author').value.trim();
            const category = document.getElementById('modal-quote-category').value;

            if (!text || !author) return;

            const newQuote = {
                id: 'custom-' + Date.now(),
                text,
                author,
                category
            };

            quotes.unshift(newQuote);
            saveLocalQuotes();
            renderCategories();

            closeAddModal();
            showToast('Kutipan baru berhasil ditambahkan!');

            if (activeView === 'explore') renderExploreGrid();
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');

            toastMessage.innerText = message;
            toast.classList.remove('hidden');
            
            setTimeout(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            }, 10);

            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>