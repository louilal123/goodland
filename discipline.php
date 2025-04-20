<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discipline Estimate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'primary': '#6366f1',
                        'primary-dark': '#4f46e5',
                        'secondary': '#10b981',
                        'dark': '#0f172a',
                        'darker': '#0a0f1c',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'display': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');
        
        html {
            scroll-behavior: smooth;
        }
        
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #6366f1, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1e293b;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 10px;
        }
        
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
        }
        
        .team-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
        }
        
        .team-card:hover .team-overlay {
            opacity: 1;
        }
        
        .filter-button.active {
            background-color: #6366f1;
            color: white;
        }
    </style>
</head>
<body class="bg-dark text-gray-200 font-sans custom-scrollbar">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-darker/80 backdrop-blur-lg border-b border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="#" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-display font-bold gradient-text">D|E</span>
                        <span class="ml-3 text-lg font-medium text-white hidden sm:block">Discipline Estimate</span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#hero" class="text-gray-300 hover:text-white transition-colors duration-200">Home</a>
                    <a href="#overview" class="text-gray-300 hover:text-white transition-colors duration-200">Overview</a>
                    <a href="#data" class="text-gray-300 hover:text-white transition-colors duration-200">Analytics</a>
                    <a href="#about" class="text-gray-300 hover:text-white transition-colors duration-200">About</a>
                    <button class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition-colors duration-200">Get Started</button>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-button" class="text-gray-300 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-darker border-b border-gray-800 py-2">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col space-y-4 py-2">
                    <a href="#hero" class="text-gray-300 hover:text-white transition-colors duration-200">Home</a>
                    <a href="#overview" class="text-gray-300 hover:text-white transition-colors duration-200">Overview</a>
                    <a href="#data" class="text-gray-300 hover:text-white transition-colors duration-200">Analytics</a>
                    <a href="#about" class="text-gray-300 hover:text-white transition-colors duration-200">About</a>
                    <button class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition-colors duration-200 w-full">Get Started</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="hero-bg" id="hero-canvas"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 mt-16 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block mb-4 px-4 py-1 bg-primary/10 rounded-full">
                    <span class="text-primary">Future of Data Analytics</span>
                </div>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold mb-6 leading-tight">
                    Transform Data into <span class="gradient-text">Disciplined Action</span>
                </h1>
                <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">
                    Leverage our cutting-edge platform to analyze patterns, estimate outcomes, and build disciplined strategies that drive results.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#" class="px-8 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg transition-colors duration-200 font-medium flex items-center justify-center">
                        <span>Get Started</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="#overview" class="px-8 py-3 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors duration-200 font-medium flex items-center justify-center">
                        <span>Learn More</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="mt-20 flex justify-center">
                <div class="animate-bounce">
                    <a href="#overview" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview Section -->
    <section id="overview" class="py-20 bg-gradient-to-b from-darker to-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <span class="text-primary font-semibold">Overview</span>
                <h2 class="text-3xl sm:text-4xl font-display font-bold mt-2 mb-6">Streamlined Data Processing</h2>
                <p class="text-gray-400">Our platform provides comprehensive analytics tools to help you make disciplined, data-driven decisions.</p>
            </div>
            
            <!-- Filters -->
            <div class="mb-10">
                <div class="flex flex-wrap justify-center gap-3 mb-6">
                    <button class="filter-button active px-4 py-2 rounded-lg border border-gray-700 hover:border-primary transition-colors duration-200">All</button>
                    <button class="filter-button px-4 py-2 rounded-lg border border-gray-700 hover:border-primary transition-colors duration-200">Analytics</button>
                    <button class="filter-button px-4 py-2 rounded-lg border border-gray-700 hover:border-primary transition-colors duration-200">Estimation</button>
                    <button class="filter-button px-4 py-2 rounded-lg border border-gray-700 hover:border-primary transition-colors duration-200">Planning</button>
                    <button class="filter-button px-4 py-2 rounded-lg border border-gray-700 hover:border-primary transition-colors duration-200">Execution</button>
                </div>
            </div>
            
            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="card bg-darker border border-gray-800 rounded-xl p-6 h-full">
                    <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Advanced Analytics</h3>
                    <p class="text-gray-400 mb-6">Powerful data analysis tools that provide deep insights and reveal hidden patterns in your data.</p>
                    <div class="mt-auto">
                        <a href="#" class="text-primary hover:text-primary-dark transition-colors duration-200 flex items-center">
                            <span>Learn more</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="card bg-darker border border-gray-800 rounded-xl p-6 h-full">
                    <div class="w-12 h-12 bg-secondary/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Precision Estimates</h3>
                    <p class="text-gray-400 mb-6">AI-powered forecasting that delivers accurate predictions based on historical and real-time data.</p>
                    <div class="mt-auto">
                        <a href="#" class="text-secondary hover:text-green-500 transition-colors duration-200 flex items-center">
                            <span>Learn more</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="card bg-darker border border-gray-800 rounded-xl p-6 h-full">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Strategic Planning</h3>
                    <p class="text-gray-400 mb-6">Transform insights into actionable plans with our comprehensive planning tools and templates.</p>
                    <div class="mt-auto">
                        <a href="#" class="text-purple-500 hover:text-purple-400 transition-colors duration-200 flex items-center">
                            <span>Learn more</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="card bg-darker border border-gray-800 rounded-xl p-6 h-full">
                    <div class="w-12 h-12 bg-pink-500/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Real-time Tracking</h3>
                    <p class="text-gray-400 mb-6">Monitor your progress with live dashboards that update in real-time as your data changes.</p>
                    <div class="mt-auto">
                        <a href="#" class="text-pink-500 hover:text-pink-400 transition-colors duration-200 flex items-center">
                            <span>Learn more</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Card 5 -->
                <div class="card bg-darker border border-gray-800 rounded-xl p-6 h-full">
                    <div class="w-12 h-12 bg-amber-500/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Team Collaboration</h3>
                    <p class="text-gray-400 mb-6">Collaborative tools that help your entire team stay aligned and work together effectively.</p>
                    <div class="mt-auto">
                        <a href="#" class="text-amber-500 hover:text-amber-400 transition-colors duration-200 flex items-center">
                            <span>Learn more</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Card 6 -->
                <div class="card bg-darker border border-gray-800 rounded-xl p-6 h-full">
                    <div class="w-12 h-12 bg-cyan-500/20 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Data Integration</h3>
                    <p class="text-gray-400 mb-6">Seamlessly connect with your existing tools and data sources for a unified analytics experience.</p>
                    <div class="mt-auto">
                        <a href="#" class="text-cyan-500 hover:text-cyan-400 transition-colors duration-200 flex items-center">
                            <span>Learn more</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Graphs Section -->
    <section id="data" class="py-20 bg-dark">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <span class="text-primary font-semibold">Analytics</span>
                <h2 class="text-3xl sm:text-4xl font-display font-bold mt-2 mb-6">Powerful Data Visualization</h2>
                <p class="text-gray-400">Our platform transforms complex data into clear, actionable visualizations that help you make better decisions.</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <div class="bg-darker border border-gray-800 rounded-xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Performance Metrics</h3>
                        <div class="flex space-x-2">
                            <button class="p-2 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                            </button>
                            <button class="p-2 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
                
                <div class="bg-darker border border-gray-800 rounded-xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Resource Allocation</h3>
                        <div class="flex space-x-2">
                            <button class="p-2 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                            </button>
                            <button class="p-2 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="resourceChart"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="bg-darker border border-gray-800 rounded-xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Trend Analysis</h3>
                    <div class="flex space-x-3">
                        <button class="px-3 py-1 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200 text-sm">Daily</button>
                        <button class="px-3 py-1 bg-primary text-white rounded-lg transition-colors duration-200 text-sm">Weekly</button>
                        <button class="px-3 py-1 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200 text-sm">Monthly</button>
                        <button class="px-3 py-1 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors duration-200 text-sm">Yearly</button>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gradient-to-b from-dark to-darker">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <span class="text-primary font-semibold">Who We Are</span>
                <h2 class="text-3xl sm:text-4xl font-display font-bold mt-2 mb-6">Meet Our Team</h2>
                <p class="text-gray-400">A dedicated group of data scientists, engineers, and analysts building the future of disciplined analytics.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="team-card bg-darker border border-gray-800 rounded-xl overflow-hidden">
                    <div class="h-60 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/70 to-secondary/70"></div>
                        <svg class="absolute inset-0 w-full h-full text-white opacity-30" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#person-pattern)" />
                        </svg>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">Alex Morgan</h3>
                            <p class="text-white/80">Chief Data Scientist</p>
                        </div>
                        <div class="team-overlay absolute inset-0 bg-primary/80 opacity-0 flex items-center justify-center transition-opacity duration-300">
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-400 text-sm">Specializes in predictive modeling and machine learning algorithms.</p>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="team-card bg-darker border border-gray-800 rounded-xl overflow-hidden">
                    <div class="h-60 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/70 to-pink-500/70"></div>
                        <svg class="absolute inset-0 w-full h-full text-white opacity-30" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#person-pattern)" />
                        </svg>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">Sarah Chen</h3>
                            <p class="text-white/80">VP of Engineering</p>
                        </div>
                        <div class="team-overlay absolute inset-0 bg-purple-500/80 opacity-0 flex items-center justify-center transition-opacity duration-300">
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-400 text-sm">Leads our engineering team in building scalable data platforms.</p>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="team-card bg-darker border border-gray-800 rounded-xl overflow-hidden">
                    <div class="h-60 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-500/70 to-orange-500/70"></div>
                        <svg class="absolute inset-0 w-full h-full text-white opacity-30" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#person-pattern)" />
                        </svg>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">James Wilson</h3>
                            <p class="text-white/80">UX Director</p>
                        </div>
                        <div class="team-overlay absolute inset-0 bg-amber-500/80 opacity-0 flex items-center justify-center transition-opacity duration-300">
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-400 text-sm">Creates intuitive user experiences that make data analysis accessible.</p>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="team-card bg-darker border border-gray-800 rounded-xl overflow-hidden">
                    <div class="h-60 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/70 to-blue-500/70"></div>
                        <svg class="absolute inset-0 w-full h-full text-white opacity-30" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#person-pattern)" />
                        </svg>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">Maya Patel</h3>
                            <p class="text-white/80">Chief Analytics Officer</p>
                        </div>
                        <div class="team-overlay absolute inset-0 bg-cyan-500/80 opacity-0 flex items-center justify-center transition-opacity duration-300">
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors duration-200">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-400 text-sm">Develops analytical frameworks that drive business growth.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 text-center">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-gray-700 hover:border-primary rounded-lg transition-colors duration-200">
                    <span>View Full Team</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-darker py-12 border-t border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <a href="#" class="flex items-center mb-4">
                        <span class="text-2xl font-display font-bold gradient-text">D|E</span>
                        <span class="ml-3 text-lg font-medium text-white">Discipline Estimate</span>
                    </a>
                    <p class="text-gray-400 mb-6">Transforming data into disciplined strategies for success.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Solutions</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Analytics</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Data Management</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">AI Integration</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Forecasting</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Strategic Planning</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Press</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Stay Updated</h4>
                    <p class="text-gray-400 mb-4">Subscribe to our newsletter for the latest updates.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="bg-gray-800 border border-gray-700 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary w-full">
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-r-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">© 2025 Discipline Estimate. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-gray-400 text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-gray-400 text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-500 hover:text-gray-400 text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Filter buttons
        document.querySelectorAll('.filter-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Initialize Three.js background
        function initThreeBackground() {
            const container = document.getElementById('hero-canvas');
            const width = container.clientWidth;
            const height = container.clientHeight;

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
            camera.position.z = 5;

            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(width, height);
            container.appendChild(renderer.domElement);

            // Create particles
            const particlesGeometry = new THREE.BufferGeometry();
            const particlesCount = 1500;
            const posArray = new Float32Array(particlesCount * 3);

            for (let i = 0; i < particlesCount * 3; i++) {
                posArray[i] = (Math.random() - 0.5) * 15;
            }

            particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

            // Materials
            const particlesMaterial = new THREE.PointsMaterial({
                size: 0.02,
                color: 0x6366f1,
                transparent: true,
                opacity: 0.8
            });

            // Mesh
            const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
            scene.add(particlesMesh);

            // Animation
            function animate() {
                requestAnimationFrame(animate);
                particlesMesh.rotation.x += 0.0005;
                particlesMesh.rotation.y += 0.0005;
                renderer.render(scene, camera);
            }

            animate();

            // Handle window resize
            window.addEventListener('resize', () => {
                const newWidth = container.clientWidth;
                const newHeight = container.clientHeight;
                
                camera.aspect = newWidth / newHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(newWidth, newHeight);
            });
        }

        // Initialize charts
        function initCharts() {
            // Performance Chart
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            const performanceChart = new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                    datasets: [{
                        label: 'Performance',
                        data: [65, 59, 80, 81, 56, 55, 40, 65, 75, 90],
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Resource Chart
            const resourceCtx = document.getElementById('resourceChart').getContext('2d');
            const resourceChart = new Chart(resourceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Research', 'Development', 'Marketing', 'Operations', 'Support'],
                    datasets: [{
                        data: [30, 25, 15, 20, 10],
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(14, 165, 233, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)',
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });

            // Trend Chart
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            const trendChart = new Chart(trendCtx, {
                type: 'bar',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7', 'Week 8'],
                    datasets: [{
                        label: 'Actual',
                        data: [120, 150, 180, 170, 160, 190, 210, 230],
                        backgroundColor: 'rgba(99, 102, 241, 0.8)',
                        borderRadius: 4
                    }, {
                        label: 'Forecast',
                        data: [100, 140, 160, 180, 190, 200, 220, 240],
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)',
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
        }

        // Initialize everything when the DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initThreeBackground();
            initCharts();
            
            // Create SVG pattern for team member cards
            const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
            svg.setAttribute('width', '0');
            svg.setAttribute('height', '0');
            svg.innerHTML = `
                <defs>
                    <pattern id="person-pattern" width="100" height="100" patternUnits="userSpaceOnUse">
                        <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="white" />
                        <circle cx="50" cy="35" r="20" fill="white" />
                        <path d="M30,70 C30,50 70,50 70,70 L70,100 L30,100 Z" fill="white" />
                    </pattern>
                </defs>
            `;
            document.body.appendChild(svg);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    const navbarHeight = document.querySelector('nav').offsetHeight;
                    const y = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                    
                    window.scrollTo({
                        top: y,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>
</html>
