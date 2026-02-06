<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'HealthLife') }} - Login</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex">
        <!-- Left Column - Blue Section -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 flex-col justify-between p-12 text-white">
            <!-- Top Content -->
            <div>
                <h1 class="text-4xl font-bold mb-6">Welcome to Rekam Medis Elektronik</h1>
                <p class="text-blue-100 text-lg leading-relaxed">
                    Sistem Rekam Medis Elektronik Rawat Inap PIKSI GANESHA HOSPITAL dirancang untuk meningkatkan efisiensi dan kualitas pelayanan kesehatan. Dengan platform digital ini, Anda dapat mengelola data pasien dengan lebih cepat, akurat, dan terorganisir. Mari bergabung dengan ribuan profesional kesehatan yang telah merasakan manfaat transformasi digital.
                </p>
            </div>

            <!-- Testimonial Card -->
            <div class="bg-white rounded-lg shadow-lg p-8 text-gray-800 mb-12">
                <h3 class="text-xl font-bold mb-4">Sistem yang Efisien dan Andal!</h3>
                <p class="text-gray-600 mb-6 italic">
                    "Sistem RME ini sangat membantu mempercepat pencatatan data pasien dan mengurangi kesalahan input. Pekerjaan kami menjadi jauh lebih mudah dan terorganisir. Akses data yang cepat dan user interface yang intuitif membuat seluruh tim dapat beradaptasi dengan cepat. Sangat direkomendasikan untuk semua fasilitas kesehatan!"
                </p>
                
                <!-- Author Section -->
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <span class="text-white font-bold text-lg">AG</span>
                    </div>
        <div>
                        <p class="font-semibold text-gray-800">Abraham Gingsul</p>
                        <p class="text-sm text-gray-500">Social Tech</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between text-sm text-blue-100">
                <p>&copy; 2026 All Rights Reserved</p>
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
            </div>
        </div>

        <!-- Right Column - White Section -->
        <div class="w-full lg:w-1/2 bg-white flex flex-col p-8 lg:p-12">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between mb-12">
                <!-- Logo -->
                <img src="{{ asset('images/RME-navbar.png') }}" alt="RME Piksi Ganesha Hospital Logo" class="w-auto h-12">
            </div>

            <!-- Form Container -->
            <div class="flex-1 flex items-center justify-center">
                <div class="w-full max-w-md">
                    <!-- Session Status -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-red-700 font-semibold text-sm mb-2">{{ __('Whoops! Something went wrong.') }}</p>
                            <ul class="text-red-600 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-green-700 text-sm">{{ session('status') }}</p>
                        </div>
                    @endif

                    <!-- Welcome Title -->
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">Hi, Welcome Back!</h2>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email Address Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus 
                                    autocomplete="username"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                                    placeholder="Enter your email"
                                >
                            </div>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input 
                                    id="password" 
                            type="password"
                            name="password"
                                    required 
                                    autocomplete="current-password"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"
                                    placeholder="Enter your password"
                                >
                            </div>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label for="remember" class="flex items-center cursor-pointer">
                                <input 
                                    id="remember" 
                                    type="checkbox" 
                                    name="remember" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer"
                                >
                                <span class="ml-2 text-sm text-gray-700">Keep me signed in</span>
            </label>

            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                    Forgot Password?
                </a>
            @endif
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors duration-200 mt-6"
                        >
                            Login
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center my-8">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <span class="px-3 text-sm text-gray-500">OR</span>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="space-y-3">
                        <!-- Google Button -->
                        <button 
                            type="button" 
                            class="w-full border border-gray-300 hover:border-gray-400 bg-white text-gray-700 font-semibold py-3 rounded-lg flex items-center justify-center space-x-2 transition-colors hover:bg-gray-50"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            <span>Authorize with Google</span>
                        </button>

                        <!-- Facebook Button -->
                        <button 
                            type="button" 
                            class="w-full border border-gray-300 hover:border-gray-400 bg-white text-gray-700 font-semibold py-3 rounded-lg flex items-center justify-center space-x-2 transition-colors hover:bg-gray-50"
                        >
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span>Sign in with Facebook</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
