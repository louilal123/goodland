<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Labor: A Data Analytics Perspective</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }
        
        .stats-item {
            transition: transform 0.3s ease;
        }
        
        .stats-item:hover {
            transform: translateY(-5px);
        }
        
        .cursor-follow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(229, 62, 62, 0.3);
            position: fixed;
            pointer-events: none;
            mix-blend-mode: difference;
            z-index: 9999;
            transform: translate(-50%, -50%);
        }
        
        .scroll-indicator {
            height: 3px;
            background-color: #e53e3e;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            width: 0%;
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #e53e3e;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .parallax {
            transition: transform 0.1s ease-out;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .text-gradient {
            background: linear-gradient(to right, #e53e3e, #dd6b20);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Custom Cursor -->
    <div class="cursor-follow hidden lg:block"></div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator"></div>
    
    <!-- Mobile Navigation -->
    <div class="mobile-menu fixed top-0 left-0 h-full w-4/5 bg-gray-900 z-50 p-6">
        <div class="flex justify-end">
            <button id="close-menu" class="text-white text-2xl">&times;</button>
        </div>
        <nav class="mt-10">
            <ul class="space-y-6 text-white">
                <li><a href="#hero" class="text-xl font-medium block">Home</a></li>
                <li><a href="#about" class="text-xl font-medium block">About</a></li>
                <li><a href="#statistics" class="text-xl font-medium block">Statistics</a></li>
                <li><a href="#insights" class="text-xl font-medium block">Insights</a></li>
                <li><a href="#solutions" class="text-xl font-medium block">Solutions</a></li>
                <li><a href="#contact" class="text-xl font-medium block">Contact</a></li>
            </ul>
        </nav>
    </div>
    
    <!-- Navbar -->
    <header class="fixed top-0 left-0 w-full bg-white bg-opacity-95 shadow-sm z-40 backdrop-blur-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-gradient">ChildLabor<span class="text-gray-900">.Data</span></a>
                
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="#hero" class="nav-link font-medium">Home</a></li>
                        <li><a href="#about" class="nav-link font-medium">About</a></li>
                        <li><a href="#statistics" class="nav-link font-medium">Statistics</a></li>
                        <li><a href="#insights" class="nav-link font-medium">Insights</a></li>
                        <li><a href="#solutions" class="nav-link font-medium">Solutions</a></li>
                        <li><a href="#contact" class="nav-link font-medium">Contact</a></li>
                    </ul>
                </nav>
                
                <button id="open-menu" class="md:hidden text-2xl">☰</button>
            </div>
        </div>
    </header>
    
    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero-gradient text-white min-h-screen flex items-center pt-20">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                            <span class="block opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-1">Child Labor:</span>
                            <span class="block opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-2">A Data Analytics</span>
                            <span class="block opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-3">Perspective</span>
                        </h1>
                        <p class="text-lg md:text-xl opacity-90 opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-4">
                            Leveraging data science to understand, analyze and combat child labor globally through actionable insights.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-5">
                            <a href="#statistics" class="px-8 py-3 bg-red-600 text-white font-medium rounded-lg transition-all hover:bg-red-700 text-center">
                                View Statistics
                            </a>
                            <a href="#about" class="px-8 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg transition-all hover:bg-white hover:text-gray-900 text-center">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="rounded-2xl overflow-hidden opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-6">
                            <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-blue-900 to-indigo-900 relative">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="grid grid-cols-3 gap-4 parallax" data-depth="0.2">
                                        <div class="h-32 bg-blue-800 bg-opacity-30 rounded-lg floating"></div>
                                        <div class="h-32 bg-indigo-800 bg-opacity-30 rounded-lg floating" style="animation-delay: 0.5s"></div>
                                        <div class="h-32 bg-purple-800 bg-opacity-30 rounded-lg floating" style="animation-delay: 1s"></div>
                                        <div class="h-32 bg-red-800 bg-opacity-30 rounded-lg floating" style="animation-delay: 1.5s"></div>
                                        <div class="h-32 bg-yellow-800 bg-opacity-30 rounded-lg floating" style="animation-delay: 2s"></div>
                                        <div class="h-32 bg-green-800 bg-opacity-30 rounded-lg floating" style="animation-delay: 2.5s"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-red-600 rounded-full opacity-0 transform transition-all duration-1000 translate-y-10" data-sr-id="hero-7"></div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- About Section -->
        <section id="about" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Understanding <span class="text-gradient">Child Labor</span> Through Data</h2>
                    <p class="text-lg text-gray-700">We combine advanced analytics with global datasets to provide meaningful insights into child labor issues around the world.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Data Collection</h3>
                        <p class="text-gray-600">We gather comprehensive data from global sources, NGOs, and government entities to create a holistic view of child labor.</p>
                    </div>
                    
                    <div class="card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Analysis & Insights</h3>
                        <p class="text-gray-600">Our team applies advanced analytical methods to identify patterns, causes, and potential solutions to child labor.</p>
                    </div>
                    
                    <div class="card bg-white p-8 rounded-2xl shadow-lg">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Action Framework</h3>
                        <p class="text-gray-600">We develop data-driven recommendations and frameworks for organizations working to eliminate child labor.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Statistics Section -->
        <section id="statistics" class="py-20 bg-gray-100">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Global <span class="text-gradient">Statistics</span></h2>
                    <p class="text-lg text-gray-700">The data reveals the scale and impact of child labor around the world.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="stats-item bg-white p-8 rounded-2xl shadow-lg text-center">
                        <span class="text-5xl font-bold text-red-600 block mb-2 counter" data-target="160">0</span>
                        <span class="text-xl text-gray-700">Million Children</span>
                        <p class="mt-3 text-gray-600">Engaged in child labor globally</p>
                    </div>
                    
                    <div class="stats-item bg-white p-8 rounded-2xl shadow-lg text-center">
                        <span class="text-5xl font-bold text-blue-600 block mb-2 counter" data-target="72">0</span>
                        <span class="text-xl text-gray-700">Million Children</span>
                        <p class="mt-3 text-gray-600">In hazardous work conditions</p>
                    </div>
                    
                    <div class="stats-item bg-white p-8 rounded-2xl shadow-lg text-center">
                        <span class="text-5xl font-bold text-green-600 block mb-2 counter" data-target="70">0</span>
                        <span class="text-xl text-gray-700">Percent</span>
                        <p class="mt-3 text-gray-600">In agricultural sector</p>
                    </div>
                    
                    <div class="stats-item bg-white p-8 rounded-2xl shadow-lg text-center">
                        <span class="text-5xl font-bold text-purple-600 block mb-2 counter" data-target="48">0</span>
                        <span class="text-xl text-gray-700">Percent</span>
                        <p class="mt-3 text-gray-600">Are between ages 5-11</p>
                    </div>
                </div>
                
                <div class="mt-16 bg-white p-8 rounded-2xl shadow-lg">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg">
                        <div class="p-4 flex items-center justify-center">
                            <div class="w-full max-w-4xl">
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold mb-4">Regional Distribution of Child Labor</h3>
                                    <div class="h-64 relative">
                                        <div class="absolute inset-0 flex items-end">
                                            <div class="w-1/5 h-[85%] bg-red-500 mx-1 rounded-t-lg relative">
                                                <div class="absolute bottom-full left-0 right-0 text-center mb-2">
                                                    <span class="text-sm font-medium">Africa</span>
                                                    <span class="block text-xs text-gray-600">72.1M</span>
                                                </div>
                                            </div>
                                            <div class="w-1/5 h-[45%] bg-blue-500 mx-1 rounded-t-lg relative">
                                                <div class="absolute bottom-full left-0 right-0 text-center mb-2">
                                                    <span class="text-sm font-medium">Asia</span>
                                                    <span class="block text-xs text-gray-600">62.1M</span>
                                                </div>
                                            </div>
                                            <div class="w-1/5 h-[23%] bg-green-500 mx-1 rounded-t-lg relative">
                                                <div class="absolute bottom-full left-0 right-0 text-center mb-2">
                                                    <span class="text-sm font-medium">Americas</span>
                                                    <span class="block text-xs text-gray-600">10.7M</span>
                                                </div>
                                            </div>
                                            <div class="w-1/5 h-[10%] bg-yellow-500 mx-1 rounded-t-lg relative">
                                                <div class="absolute bottom-full left-0 right-0 text-center mb-2">
                                                    <span class="text-sm font-medium">Europe</span>
                                                    <span class="block text-xs text-gray-600">5.5M</span>
                                                </div>
                                            </div>
                                            <div class="w-1/5 h-[5%] bg-purple-500 mx-1 rounded-t-lg relative">
                                                <div class="absolute bottom-full left-0 right-0 text-center mb-2">
                                                    <span class="text-sm font-medium">Oceania</span>
                                                    <span class="block text-xs text-gray-600">2.9M</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Insights Section -->
        <section id="insights" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Key <span class="text-gradient">Insights</span></h2>
                    <p class="text-lg text-gray-700">Data-driven findings about the causes and impacts of child labor worldwide.</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="bg-gray-100 p-8 rounded-2xl">
                        <h3 class="text-2xl font-semibold mb-6">Root Causes</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500 flex items-center justify-center mt-1">
                                    <span class="text-white text-xs font-bold">1</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium">Poverty</h4>
                                    <p class="text-gray-600 mt-1">Families in extreme poverty often rely on children's income for basic survival.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500 flex items-center justify-center mt-1">
                                    <span class="text-white text-xs font-bold">2</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium">Lack of Education Access</h4>
                                    <p class="text-gray-600 mt-1">Limited or expensive education forces children into labor instead of schooling.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500 flex items-center justify-center mt-1">
                                    <span class="text-white text-xs font-bold">3</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium">Cultural Factors</h4>
                                    <p class="text-gray-600 mt-1">Traditional practices and views on child work perpetuate child labor in some regions.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-gray-100 p-8 rounded-2xl">
                        <h3 class="text-2xl font-semibold mb-6">Long-term Impacts</h3>
                        <div class="space-y-6">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-300 rounded-full h-2.5">
                                    <div class="bg-red-600 h-2.5 rounded-full" style="width: 83%"></div>
                                </div>
                                <span class="ml-4 font-medium text-gray-700">83%</span>
                            </div>
                            <p class="text-gray-600">Child laborers who experience stunted physical development.</p>
                            
                            <div class="flex items-center">
                                <div class="w-full bg-gray-300 rounded-full h-2.5">
                                    <div class="bg-red-600 h-2.5 rounded-full" style="width: 67%"></div>
                                </div>
                                <span class="ml-4 font-medium text-gray-700">67%</span>
                            </div>
                            <p class="text-gray-600">Children who continue in poverty cycles into adulthood.</p>
                            
                            <div class="flex items-center">
                                <div class="w-full bg-gray-300 rounded-full h-2.5">
                                    <div class="bg-red-600 h-2.5 rounded-full" style="width: 92%"></div>
                                </div>
                                <span class="ml-4 font-medium text-gray-700">92%</span>
                            </div>
                            <p class="text-gray-600">Reduction in lifetime earnings compared to educated peers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Solutions Section -->
        <section id="solutions" class="py-20 bg-gray-900 text-white">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Data-Driven <span class="text-gradient">Solutions</span></h2>
                    <p class="text-lg text-gray-300">How data analytics can guide effective interventions to combat child labor.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gray-800 p-8 rounded-2xl transition-all hover:bg-gray-700">
                        <div class="w-16 h-16 bg-red-900 bg-opacity-30 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Targeted Education Programs</h3>
                        <p class="text-gray-400">Data analytics identifies regions with highest need for educational interventions and tracks program effectiveness.</p>
                    </div>
                    
                    <div class="bg-gray-800 p-8 rounded-2xl transition-all hover:bg-gray-700">
                        <div class="w-16 h-16 bg-blue-900 bg-opacity-30 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Economic Support Systems</h3>
                        <p class="text-gray-400">Predictive models identify families at risk and optimize resource allocation for economic assistance programs.</p>
                    </div>
                    
                    <div class="bg-gray-800 p-8 rounded-2xl transition-all hover:bg-gray-700">
                        <div class="w-16 h-16 bg-green-900 bg-opacity-30 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Policy Development</h3>
                        <p class="text-gray-400">Data-driven policy recommendations that address root causes based on regional and sectoral analysis.</p>
                    </div>
                </div>
                
                <div class="mt-16 text-center">
                    <a href="#contact" class="inline-block px-8 py-4 bg-red-600 text-white font-medium rounded-lg transition-all hover:bg-red-700">
                        Join Our Efforts
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Contact Section -->
        <section id="contact" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <div>
                            <h2 class="text-3xl font-bold mb-6">Get <span class="text-gradient">Involved</span></h2>
                            <p class="text-gray-700 mb-8">
                                Join our network of researchers, policy makers, and advocates working to eliminate child labor through data-driven approaches.
                            </p>
                            
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium">Email</h4>
                                        <p class="text-gray-600">contact@childlabordata.org</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium">Phone</h4>
                                        <p class="text-gray-600">+1 (555) 123-4567</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium">Location</h4>
                                        <p class="text-gray-600">Global Analytics Hub, New York, NY</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <form class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" placeholder="Your name">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" placeholder="your@email.com">
                                </div>
                                
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                    <textarea id="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" placeholder="How would you like to contribute?"></textarea>
                                </div>
                                
                                <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white font-medium rounded-lg transition-all hover:bg-red-700">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">ChildLabor<span class="text-red-500">.Data</span></h3>
                    <p class="text-gray-400">Using data analytics to combat child labor and create a better future for children worldwide.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#hero" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#statistics" class="text-gray-400 hover:text-white transition-colors">Statistics</a></li>
                        <li><a href="#insights" class="text-gray-400 hover:text-white transition-colors">Insights</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Research Papers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Data Sets</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Case Studies</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Policy Briefs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2025 ChildLabor.Data. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Custom cursor
        document.addEventListener('DOMContentLoaded', function() {
            const cursor = document.querySelector('.cursor-follow');
            
            document.addEventListener('mousemove', function(e) {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
            });
            
            // Scroll indicator
            const scrollIndicator = document.querySelector('.scroll-indicator');
            
            window.addEventListener('scroll', function() {
                const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (scrollTop / scrollHeight) * 100;
                
                scrollIndicator.style.width = scrolled + '%';
            });
            
            // Parallax effect
            const parallaxElements = document.querySelectorAll('.parallax');
            
            document.addEventListener('mousemove', function(e) {
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;
                
                parallaxElements.forEach(element => {
                    const depth = element.getAttribute('data-depth') || 0.1;
                    const moveX = (x - 0.5) * depth * 100;
                    const moveY = (y - 0.5) * depth * 100;
                    
                    element.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            });
            
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            const speed = 200;
            
            const startCounters = () => {
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    let count = 0;
                    
                    const updateCount = () => {
                        const increment = target / speed;
                        
                        if (count < target) {
                            count += increment;
                            counter.innerText = Math.floor(count);
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    
                    updateCount();
                });
            };
            
            // Scroll reveal
            ScrollReveal().reveal('[data-sr-id]', {
                delay: 200,
                distance: '50px',
                duration: 800,
                easing: 'cubic-bezier(0.5, 0, 0, 1)',
                interval: 100,
                opacity: 0,
                origin: 'bottom',
                reset: false
            });
            
            // Activate counters when statistics section is in view
            const statsSection = document.querySelector('#statistics');
            
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.5
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            observer.observe(statsSection);
            
            // Mobile menu
            const openMenuBtn = document.getElementById('open-menu');
            const closeMenuBtn = document.getElementById('close-menu');
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');
            
            openMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.add('open');
            });
            
            closeMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.remove('open');
            });
            
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('open');
                });
            });
            
            // GSAP animations for hero section
            gsap.to('[data-sr-id="hero-1"]', {opacity: 1, y: 0, duration: 0.8, delay: 0.2});
            gsap.to('[data-sr-id="hero-2"]', {opacity: 1, y: 0, duration: 0.8, delay: 0.4});
            gsap.to('[data-sr-id="hero-3"]', {opacity: 1, y: 0, duration: 0.8, delay: 0.6});
            gsap.to('[data-sr-id="hero-4"]', {opacity: 1, y: 0, duration: 0.8, delay: 0.8});
            gsap.to('[data-sr-id="hero-5"]', {opacity: 1, y: 0, duration: 0.8, delay: 1.0});
            gsap.to('[data-sr-id="hero-6"]', {opacity: 1, y: 0, duration: 0.8, delay: 1.2});
            gsap.to('[data-sr-id="hero-7"]', {opacity: 1, y: 0, duration: 0.8, delay: 1.4});
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>
