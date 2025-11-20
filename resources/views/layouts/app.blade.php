<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'RME Rawat Inap - PIKSI GANESHA HOSPITAL')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/RME-favicon.png') }}">
    </head>
    <body class="font-sans antialiased bg-background-sidebar">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out" id="sidebar">
                <div class="flex items-center justify-center py-4 border-b">
                    <img src="{{ asset('images/RME-navbar.png') }}" alt="RME Piksi Ganesha Hospital Logo" class="w-auto max-w-full h-14">
                </div>
                
                <!-- Navigation Menu -->
                <nav class="mt-8">
                    <div class="px-4 space-y-2">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }} text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                            Dashboard
                        </a>

                        <!-- Identitas Pasien -->
                        <a href="#identitas-pasien" class="sidebar-item scroll-to-section text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Identitas Pasien
                        </a>

                        <!-- Data Klinis Dokter -->
                        <a href="#data-klinis-dokter" class="sidebar-item scroll-to-section text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Data Klinis Dokter
                        </a>

                        <!-- Data Farmasi & Tindakan -->
                        <a href="#data-farmasi-tindakan" class="sidebar-item scroll-to-section text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            Data Farmasi & Tindakan
                        </a>

                        <!-- SOAP -->
                        <a href="#soap" class="sidebar-item scroll-to-section text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            SOAP
                        </a>

                        <!-- Resume Medis & Kepulangan -->
                        <a href="#resume-medis-kepulangan" class="sidebar-item scroll-to-section text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Resume Medis & Kepulangan
                        </a>

                        <!-- Validasi -->
                        <a href="#validasi" class="sidebar-item scroll-to-section text-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Validasi
                        </a>
                    </div>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col ml-64">
                <!-- Top Navbar -->
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="flex items-center justify-between h-16 px-6">
                        <!-- Left side - Page title -->
                        <div>
                            <h2 class="text-xl font-semibold text-text-primary">@yield('page-title', 'Dashboard')</h2>
                        </div>

                        <!-- Right side - User menu -->
                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <span class="absolute top-1 right-1 block h-2.5 w-2.5 bg-red-500 rounded-full ring-2 ring-white"></span>
                            </button>

                            <!-- User dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-blue">
                                    <div class="w-8 h-8 bg-primary-blue rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-text-primary">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                    <hr class="my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto">
                    <div class="py-6 px-6">
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <div class="mb-4 bg-success text-white px-4 py-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-4 bg-error text-white px-4 py-3 rounded">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-4 bg-error text-white px-4 py-3 rounded">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <!-- Mobile sidebar overlay -->
        <div class="fixed inset-0 z-40 lg:hidden" style="display: none;" id="sidebar-overlay">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="toggleSidebar()"></div>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.style.display = 'block';
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.style.display = 'none';
                }
            }

            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                if (window.innerWidth < 1024 && !sidebar.contains(event.target)) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.style.display = 'none';
                }
            });

            // Smooth scroll functionality for sidebar navigation
            document.addEventListener('DOMContentLoaded', function() {
                const scrollLinks = document.querySelectorAll('.scroll-to-section');
                
                scrollLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        const targetId = this.getAttribute('href').substring(1);
                        const targetElement = document.getElementById(targetId);
                        
                        if (targetElement) {
                            // Calculate offset for fixed header (adjust as needed)
                            const headerHeight = 80; // Approximate header height
                            const targetPosition = targetElement.offsetTop - headerHeight;
                            
                            // Smooth scroll to target
                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                            
                            // Update active sidebar item
                            updateActiveSidebarItem(this);
                        }
                    });
                });
                
                // Function to update active sidebar item
                function updateActiveSidebarItem(activeLink) {
                    // Remove active class from all sidebar items
                    document.querySelectorAll('.sidebar-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    
                    // Add active class to clicked item
                    activeLink.classList.add('active');
                }
                
                // Update active sidebar item based on scroll position
                window.addEventListener('scroll', function() {
                    const sections = document.querySelectorAll('[id]');
                    let currentSection = '';
                    
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop - 100;
                        const sectionHeight = section.offsetHeight;
                        
                        if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                            currentSection = section.getAttribute('id');
                        }
                    });
                    
                    // Update sidebar active state
                    if (currentSection) {
                        document.querySelectorAll('.sidebar-item').forEach(item => {
                            item.classList.remove('active');
                            if (item.getAttribute('href') === '#' + currentSection) {
                                item.classList.add('active');
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
