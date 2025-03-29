<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Insights PH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap">
    <style>
        :root {
            --primary: #f8fafc;
            --secondary: #f1f5f9;
            --accent: #3b82f6;
            --text: #0f172a;
            --text-light: #475569;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary);
            color: var(--text);
            overflow-x: hidden;
        }
        
        .playfair {
            font-family: 'Playfair Display', serif;
        }
        
        .hero-text {
            line-height: 1.1;
            letter-spacing: -1px;
        }
        
        .cursor {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--accent);
            position: fixed;
            pointer-events: none;
            z-index: 999;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out;
        }
        
        .cursor-follower {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 998;
            transform: translate(-50%, -50%);
            transition: transform 0.3s ease-out, width 0.3s ease, height 0.3s ease;
        }
        
        .nav-link {
            position: relative;
            display: inline-block;
            padding: 5px 0;
            margin: 0 15px;
            color: var(--text);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .card {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.05);
        }
        
        .search-container {
            overflow: hidden;
        }
        
        .search-input {
            width: 0;
            transition: width 0.3s ease;
            background: transparent;
            border: none;
            color: var(--text);
            outline: none;
        }
        
        .search-container:hover .search-input,
        .search-input:focus {
            width: 150px;
            border-bottom: 1px solid var(--accent);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .float {
            animation: float 6s ease-in-out infinite;
        }
        
        .split-text span {
            display: inline-block;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .parallax {
            transition: transform 0.1s ease-out;
        }
        
        .menu-toggle {
            display: none;
            z-index: 1000;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .chart-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        
        .stat-card {
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                height: 100vh;
                width: 70%;
                background-color: white;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                transition: right 0.3s ease;
                z-index: 999;
            }
            
            .nav-links.open {
                right: 0;
            }
            
            .nav-link {
                margin: 15px 0;
                font-size: 1.25rem;
            }
            
            .search-container {
                position: absolute;
                bottom: 20%;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</head>
<body class="text-gray-900">
    <div class="cursor"></div>
    <div class="cursor-follower"></div>
    
    <!-- Navbar -->
    <nav class="fixed w-full p-6 z-50 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold playfair tracking-wider">Tourism<span class="text-blue-500">Insights</span>PH</a>
            
            <div class="menu-toggle cursor-pointer">
                <div class="w-6 h-0.5 bg-gray-800 mb-1.5"></div>
                <div class="w-6 h-0.5 bg-gray-800 mb-1.5"></div>
                <div class="w-6 h-0.5 bg-gray-800"></div>
            </div>
            
            <div class="nav-links flex items-center">
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Home</a>
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Destinations</a>
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Occupancy Rates</a>
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Arrivals</a>
                
                <div class="search-container ml-4 flex items-center">
                    <input type="text" class="search-input text-sm mr-2" placeholder="Search...">
                    <i class="fas fa-search text-sm text-gray-600"></i>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="h-screen pt-24 flex items-center relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-indigo-50">
        <div class="absolute -right-64 -top-64 w-[800px] h-[800px] bg-blue-100 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute -left-64 -bottom-64 w-[800px] h-[800px] bg-indigo-100 rounded-full opacity-30 blur-3xl"></div>
        
        <div class="container mx-auto px-6 z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 mb-10 md:mb-0">
                    <h5 class="text-blue-500 text-sm tracking-widest uppercase font-medium mb-4 fade-in">Insights & Analytics</h5>
                    <h1 class="hero-text text-5xl md:text-7xl font-bold playfair mb-6 split-text">Discover <br>Philippine Tourism <span class="gradient-text">Trends</span></h1>
                    <p class="text-gray-600 max-w-lg mb-10 fade-in">Interactive data visualization and analytics platform for understanding tourism patterns, occupancy rates, and visitor arrivals across the Philippines.</p>
                    <a href="#insights" class="inline-block bg-blue-500 text-white py-3 px-8 rounded-full font-medium hover:bg-blue-600 transition fade-in shadow-lg hover:shadow-xl hover:shadow-blue-100">Explore Insights</a>
                </div>
                
                <div class="w-full md:w-1/2 float flex justify-center relative">
                    <div class="relative">
                        <svg class="w-full max-w-xl" viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <rect x="50" y="50" width="400" height="300" rx="20" fill="white" stroke="#e2e8f0" stroke-width="2"/>
                            <text x="70" y="90" font-family="Inter, sans-serif" font-weight="600" font-size="16" fill="#0f172a">Tourism Growth by Region (2020-2025)</text>
                            
                            <!-- Chart Bars -->
                            <rect class="chart-bar" x="70" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="180" dur="1s" fill="freeze" />
                            </rect>
                            <rect class="chart-bar" x="120" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="150" dur="1s" fill="freeze" begin="0.1s" />
                            </rect>
                            <rect class="chart-bar" x="170" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="220" dur="1s" fill="freeze" begin="0.2s" />
                            </rect>
                            <rect class="chart-bar" x="220" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="110" dur="1s" fill="freeze" begin="0.3s" />
                            </rect>
                            <rect class="chart-bar" x="270" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="190" dur="1s" fill="freeze" begin="0.4s" />
                            </rect>
                            <rect class="chart-bar" x="320" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="160" dur="1s" fill="freeze" begin="0.5s" />
                            </rect>
                            <rect class="chart-bar" x="370" y="120" width="30" height="0" fill="url(#grad1)">
                                <animate attributeName="height" from="0" to="200" dur="1s" fill="freeze" begin="0.6s" />
                            </rect>
                            
                            <!-- X Axis labels -->
                            <text x="85" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">Luzon</text>
                            <text x="135" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">NCR</text>
                            <text x="185" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">Cebu</text>
                            <text x="235" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">Davao</text>
                            <text x="285" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">Bohol</text>
                            <text x="335" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">Palawan</text>
                            <text x="385" y="320" font-family="Inter, sans-serif" font-size="12" fill="#64748b" text-anchor="middle">Boracay</text>
                            
                            <!-- Y Axis line -->
                            <line x1="50" y1="300" x2="50" y2="120" stroke="#e2e8f0" stroke-width="1"/>
                            
                            <!-- Horizontal grid lines -->
                            <line x1="50" y1="120" x2="450" y2="120" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="5,5"/>
                            <line x1="50" y1="170" x2="450" y2="170" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="5,5"/>
                            <line x1="50" y1="220" x2="450" y2="220" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="5,5"/>
                            <line x1="50" y1="270" x2="450" y2="270" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="5,5"/>
                            <line x1="50" y1="300" x2="450" y2="300" stroke="#e2e8f0" stroke-width="1"/>
                        </svg>
                        
                        <div class="absolute -top-5 -right-5 w-20 h-20 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                            <span class="text-sm">+24%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 fade-in">
            <div class="float flex flex-col items-center">
                <span class="text-sm text-gray-600 mb-2">Scroll down</span>
                <svg class="w-6 h-6 animate-bounce text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>
    
    <!-- Key Statistics Section -->
    <section id="insights" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h5 class="text-blue-500 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Tourism Snapshot</h5>
                <h2 class="text-4xl md:text-5xl font-bold playfair fade-in">Key Statistics</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4 fade-in">Current insights into the Philippines tourism industry performance and growth metrics.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="stat-card bg-white p-8 rounded-lg text-center fade-in shadow-lg border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-users text-blue-500 text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold playfair text-gray-800 mb-2 counter">8.26M</div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Visitor Arrivals</h3>
                    <p class="text-gray-500 text-sm">International tourists visiting annually</p>
                </div>
                
                <div class="stat-card bg-white p-8 rounded-lg text-center fade-in shadow-lg border border-gray-100" data-delay="0.2">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 flex items-center justify-center">
                        <i class="fas fa-bed text-indigo-500 text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold playfair text-gray-800 mb-2 counter">72%</div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Occupancy Rate</h3>
                    <p class="text-gray-500 text-sm">Average hotel occupancy nationwide</p>
                </div>
                
                <div class="stat-card bg-white p-8 rounded-lg text-center fade-in shadow-lg border border-gray-100" data-delay="0.4">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-50 flex items-center justify-center">
                        <i class="fas fa-coins text-purple-500 text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold playfair text-gray-800 mb-2 counter">$9.3B</div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Tourism Revenue</h3>
                    <p class="text-gray-500 text-sm">Annual economic contribution</p>
                </div>
                
                <div class="stat-card bg-white p-8 rounded-lg text-center fade-in shadow-lg border border-gray-100" data-delay="0.6">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-calendar-day text-blue-500 text-2xl"></i>
                    </div>
                    <div class="text-4xl font-bold playfair text-gray-800 mb-2 counter">8.7</div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Average Stay</h3>
                    <p class="text-gray-500 text-sm">Days spent per international visitor</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Data Visualization Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <h5 class="text-blue-500 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Interactive Data</h5>
                    <h2 class="text-4xl md:text-5xl font-bold playfair fade-in">Tourism Insights</h2>
                    <p class="text-gray-600 max-w-2xl mt-4 fade-in">Explore interactive visualizations of tourism data across different regions and years.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <select class="px-4 py-2 border border-gray-200 rounded-md text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 fade-in">
                        <option>2025 (Current)</option>
                        <option>2024</option>
                        <option>2023</option>
                        <option>2022</option>
                        <option>2021</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Chart 1: Annual Visitor Arrivals -->
                <div class="chart-container bg-white p-6 rounded-lg shadow-md fade-in">
                    <h3 class="text-xl font-bold mb-6">Annual Visitor Arrivals (2020-2025)</h3>
                    <div class="relative h-64">
                        <canvas id="visitorsChart"></canvas>
                    </div>
                </div>
                
                <!-- Chart 2: Top Source Countries -->
                <div class="chart-container bg-white p-6 rounded-lg shadow-md fade-in" data-delay="0.2">
                    <h3 class="text-xl font-bold mb-6">Top Source Countries (2025)</h3>
                    <div class="relative h-64">
                        <canvas id="countriesChart"></canvas>
                    </div>
                </div>
                
                <!-- Chart 3: Occupancy Rates -->
                <div class="chart-container bg-white p-6 rounded-lg shadow-md fade-in" data-delay="0.3">
                    <h3 class="text-xl font-bold mb-6">Hotel Occupancy Rates by Region</h3>
                    <div class="relative h-64">
                        <canvas id="occupancyChart"></canvas>
                    </div>
                </div>
                
                <!-- Chart 4: Seasonal Tourism Patterns -->
                <div class="chart-container bg-white p-6 rounded-lg shadow-md fade-in" data-delay="0.4">
                    <h3 class="text-xl font-bold mb-6">Seasonal Tourism Patterns (2025)</h3>
                    <div class="relative h-64">
                        <canvas id="seasonalChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Top Destinations Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <h5 class="text-blue-500 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Popular Locations</h5>
                    <h2 class="text-4xl md:text-5xl font-bold playfair fade-in">Top Destinations</h2>
                    <p class="text-gray-600 max-w-2xl mt-4 fade-in">The most visited tourist destinations in the Philippines with current visitor data.</p>
                </div>
                <a href="#" class="text-sm text-blue-500 font-medium mt-4 md:mt-0 fade-in">
                    View All Destinations 
                    <span class="ml-2">→</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Destination Card 1 -->
                <div class="card bg-white shadow-md fade-in">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1569201529241-f96205e2f2c6')] bg-cover bg-center parallax" data-speed="0.1"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-2xl font-bold playfair">Boracay Island</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">1.2M visitors</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">White Beach, Aklan</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="text-sm text-gray-500 ml-1">(4.8)</span>
                            </div>
                            <span class="text-blue-500 text-sm font-medium cursor-pointer">View details →</span>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Card 2 -->
                <div class="card bg-white shadow-md fade-in" data-delay="0.2">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1570789210967-2cac24afeb00')] bg-cover bg-center parallax" data-speed="0.15"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-2xl font-bold playfair">El Nido</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">986K visitors</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Palawan</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="text-sm text-gray-500 ml-1">(4.7)</span>
                            </div>
                            <span class="text-blue-500 text-sm font-medium cursor-pointer">View details →</span>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Card 3 -->
                <div class="card bg-white shadow-md fade-in" data-delay="0.4">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1656520223886-bfd2da763d73')] bg-cover bg-center parallax" data-speed="0.2"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-2xl font-bold playfair">Chocolate Hills</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">873K visitors</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Bohol</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-yellow-400">★★★★☆</span>
                                <span class="text-sm text-gray-500 ml-1">(4.6)</span>
                            </div>
                            <span class="text-blue-500 text-sm font-medium cursor-pointer">View details →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h5 class="text-blue-200 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Stay Updated</h5>
                <h2 class="text-4xl md:text-5xl font-bold playfair mb-6 fade-in">Subscribe to Our Newsletter</h2>
                <p class="text-blue-100 mb-8 fade-in">Get the latest tourism data, insights, and trends delivered directly to your inbox.</p>
                
                <form class="flex flex-col md:flex-row gap-4 fade-in">
                    <input type="email" placeholder="Enter your email" class="flex-grow bg-white/10 backdrop-blur-md border border-white/20 text-white px-4 py-3 rounded-md focus:outline-none focus:border-white transition">
                    <button type="submit" class="bg-white text-blue-600 px-6 py-3 rounded-md font-medium hover:bg-blue-50 transition">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="py-12 bg-white border-t border-gray-100">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-bold playfair mb-4">Tourism<span class="text-blue-500">Insights</span>PH</h3>
                    <p class="text-gray-600 text-sm">Providing comprehensive data and insights on the Philippine tourism industry.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Explore</h4>
                    <ul class="text-gray-600 text-sm space-y-2">
                        <li><a href="#" class="hover:text-blue-500 transition">Home</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Destinations</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Occupancy Rates</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Arrivals</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Resources</h4>
                    <ul class="text-gray-600 text-sm space-y-2">
                        <li><a href="#" class="hover:text-blue-500 transition">Reports</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Statistics</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Infographics</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Case Studies</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Connect</h4>
                    <ul class="text-gray-600 text-sm space-y-2">
                        <li><a href="#" class="hover:text-blue-500 transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">About</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-blue-500 transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">© 2025 Tourism Insights PH. All rights reserved.</p>
                
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-blue-500 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-500 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-500 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-500 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Custom cursor
        const cursor = document.querySelector('.cursor');
        const cursorFollower = document.querySelector('.cursor-follower');
        
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            
            setTimeout(() => {
                cursorFollower.style.left = e.clientX + 'px';
                cursorFollower.style.top = e.clientY + 'px';
            }, 100);
        });
        
        document.addEventListener('mousedown', () => {
            cursor.style.transform = 'translate(-50%, -50%) scale(0.7)';
            cursorFollower.style.transform = 'translate(-50%, -50%) scale(0.7)';
        });
        
        document.addEventListener('mouseup', () => {
            cursor.style.transform = 'translate(-50%, -50%) scale(1)';
            cursorFollower.style.transform = 'translate(-50%, -50%) scale(1)';
        });
        
        const links = document.querySelectorAll('a, button, .card, input, select');
        links.forEach(link => {
            link.addEventListener('mouseenter', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
                cursorFollower.style.width = '60px';
                cursorFollower.style.height = '60px';
                cursorFollower.style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
            });
            
            link.addEventListener('mouseleave', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                cursorFollower.style.width = '40px';
                cursorFollower.style.height = '40px';
                cursorFollower.style.backgroundColor = 'transparent';
            });
        });
        
        // Split text animation
        const heroText = document.querySelector('.split-text');
        if (heroText) {
            const text = heroText.textContent;
            heroText.textContent = '';
            
            for (let i = 0; i < text.length; i++) {
                const span = document.createElement('span');
                span.textContent = text[i] === ' ' ? '\u00A0' : text[i];
                span.style.transitionDelay = `${i * 0.03}s`;
                heroText.appendChild(span);
            }
            
            // Trigger animation after a short delay
            setTimeout(() => {
                const spans = document.querySelectorAll('.split-text span');
                spans.forEach(span => {
                    span.style.opacity = '1';
                    span.style.transform = 'translateY(0)';
                });
            }, 500);
        }
        
        // Fade-in animations
        const fadeElements = document.querySelectorAll('.fade-in');
        
        const fadeIn = () => {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                const delay = element.getAttribute('data-delay') || 0;
                
                if (elementTop < windowHeight - 50) {
                    setTimeout(() => {
                        element.classList.add('visible');
                    }, delay * 1000);
                }
            });
        };
        
        // Parallax effect
        const parallaxElements = document.querySelectorAll('.parallax');
        
        const parallax = () => {
            parallaxElements.forEach(element => {
                const speed = element.getAttribute('data-speed') || 0.1;
                const elementTop = element.parentElement.getBoundingClientRect().top;
                element.style.transform = `translateY(${elementTop * speed}px)`;
            });
        };
        
        // Counter animation
        const counters = document.querySelectorAll('.counter');
        
        const runCounter = () => {
            counters.forEach(counter => {
                const elementTop = counter.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 50 && !counter.classList.contains('counted')) {
                    counter.classList.add('counted');
                    
                    const target = counter.textContent;
                    let isPercentage = target.includes('%');
                    let isMoney = target.includes('$');
                    let isMillions = target.includes('M');
                    
                    let value = parseFloat(target.replace(/[^0-9.]/g, ''));
                    let initialValue = 0;
                    
                    const duration = 2000; // in milliseconds
                    const increment = value / (duration / 16);
                    
                    const updateCounter = () => {
                        initialValue += increment;
                        
                        if (initialValue < value) {
                            let displayValue = initialValue.toFixed(isPercentage || isMoney ? 1 : 0);
                            
                            if (isMoney) {
                                counter.textContent = '$' + displayValue + (isMillions ? 'M' : '');
                            } else if (isPercentage) {
                                counter.textContent = displayValue + '%';
                            } else if (isMillions) {
                                counter.textContent = displayValue + 'M';
                            } else {
                                counter.textContent = displayValue;
                            }
                            
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target;
                        }
                    };
                    
                    updateCounter();
                }
            });
        };
        
        // Mobile menu toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');
        
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('open');
        });
        
        // Initialize Charts
        window.addEventListener('load', () => {
            // Visitors Chart
            const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
            const visitorsChart = new Chart(visitorsCtx, {
                type: 'line',
                data: {
                    labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
                    datasets: [{
                        label: 'Visitor Arrivals (millions)',
                        data: [1.5, 3.2, 5.9, 7.1, 7.8, 8.26],
                        fill: true,
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: '#3b82f6',
                        tension: 0.4,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
            
            // Source Countries Chart
            const countriesCtx = document.getElementById('countriesChart').getContext('2d');
            const countriesChart = new Chart(countriesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['South Korea', 'USA', 'China', 'Japan', 'Australia', 'Others'],
                    datasets: [{
                        data: [25, 21, 17, 12, 9, 16],
                        backgroundColor: [
                            '#3b82f6', 
                            '#8b5cf6', 
                            '#ec4899', 
                            '#f59e0b', 
                            '#10b981',
                            '#6b7280'
                        ],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                padding: 15
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        animateRotate: true
                    }
                }
            });
            
            // Occupancy Chart
            const occupancyCtx = document.getElementById('occupancyChart').getContext('2d');
            const occupancyChart = new Chart(occupancyCtx, {
                type: 'bar',
                data: {
                    labels: ['Manila', 'Cebu', 'Boracay', 'Palawan', 'Bohol', 'Davao', 'Siargao'],
                    datasets: [{
                        label: 'Occupancy Rate (%)',
                        data: [76, 82, 88, 74, 71, 68, 79],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(139, 92, 246, 0.7)',
                            'rgba(236, 72, 153, 0.7)',
                            'rgba(245, 158, 11, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(6, 182, 212, 0.7)',
                            'rgba(99, 102, 241, 0.7)'
                        ],
                        borderRadius: 4,
                        hoverBackgroundColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(139, 92, 246, 1)',
                            'rgba(236, 72, 153, 1)',
                            'rgba(245, 158, 11, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(6, 182, 212, 1)',
                            'rgba(99, 102, 241, 1)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart',
                        delay: (context) => {
                            return context.dataIndex * 100;
                        }
                    }
                }
            });
            
            // Seasonal Chart
            const seasonalCtx = document.getElementById('seasonalChart').getContext('2d');
            const seasonalChart = new Chart(seasonalCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Domestic Tourism',
                        data: [620, 640, 760, 850, 720, 780, 880, 910, 790, 730, 780, 950],
                        fill: false,
                        borderColor: '#3b82f6',
                        tension: 0.3,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointRadius: 4
                    },
                    {
                        label: 'International Tourism',
                        data: [540, 580, 620, 710, 670, 640, 720, 750, 680, 630, 710, 810],
                        fill: false,
                        borderColor: '#8b5cf6',
                        tension: 0.3,
                        pointBackgroundColor: '#8b5cf6',
                        pointBorderColor: '#fff',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 15
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
        
        // Event listeners
        window.addEventListener('scroll', () => {
            fadeIn();
            parallax();
            runCounter();
        });
        
        window.addEventListener('load', () => {
            fadeIn();
            parallax();
            runCounter();
        });
    </script>
</body>
</html>
