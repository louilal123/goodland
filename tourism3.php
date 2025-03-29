<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Insights PH</title>
    <script src="index.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
        
      
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-content">
            <div class="preloader-text">Tourism Insights PH</div>
            <div class="preloader-line"></div>
        </div>
    </div>
    
    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>
    
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full py-6 z-50 transition-all duration-500" id="navbar">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="#" class="text-xl md:text-2xl font-bold tracking-tight">Tourism<span class="text-emerald-400">Insights</span>PH</a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="link font-medium">Home</a>
                    <a href="destinations.html" class="link font-medium">Destinations</a>
                    <a href="#" class="link font-medium">Occupancy Rates</a>
                    <a href="#" class="link font-medium">Arrivals</a>
                    <div class="search-container ml-4">
                        <input type="text" placeholder="Search" class="search-input">
                        <button class="search-button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <div class="md:hidden menu-toggle" id="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu md:hidden z-20">
        <a href="#" class="link text-2xl font-medium mb-6">Home</a>
        <a href="#" class="link text-2xl font-medium mb-6">Destinations</a>
        <a href="#" class="link text-2xl font-medium mb-6">Occupancy Rates</a>
        <a href="#" class="link text-2xl font-medium mb-6">Arrivals</a>
        <div class="search-container mt-6">
            <input type="text" placeholder="Search" class="search-input w-full">
            <button class="search-button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Hero Section -->

<!-- Hero Section -->
<section class="hero flex items-center">
    <div class="page-header-bg" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwMCIgaGVpZ2h0PSI1MDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjEwMDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjMEYxNzJBIi8+PGNpcmNsZSBjeD0iNTAwIiBjeT0iMjUwIiByPSIyMDAiIGZpbGw9IiMxRTI5M0IiLz48cGF0aCBkPSJNMjAwIDI1MEw0MDAgMTUwTDYwMCAzNTBMODAwIDI1MCIgc3Ryb2tlPSIjMTBCOTgxIiBzdHJva2Utd2lkdGg9IjIiIGZpbGw9Im5vbmUiLz48L3N2Zz4=');"></div>
  
    <div class="container mx-auto px-4 md:px-8 hero-content">
        <div class="max-w-4xl">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight fade-up">Discover the Beauty of <span class="text-emerald-400">Philippine Tourism</span></h1>
            <p class="mt-6 text-lg md:text-xl text-gray-300 max-w-2xl fade-up">Comprehensive insights into tourism trends, statistics, and destinations across the Philippine archipelago.</p>
            <div class="mt-10 fade-up">
                <a href="#" class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-full text-lg font-medium transition-all duration-300 inline-block">Explore Destinations</a>
                <a href="#" class="ml-4 text-white border border-white hover:border-emerald-400 hover:text-emerald-400 px-8 py-3 rounded-full text-lg font-medium transition-all duration-300 inline-block">View Statistics</a>
            </div>
        </div>
    </div>
    
    <div class="rotate-text">
        <svg viewBox="0 0 100 100">
            <path id="circle" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="none"/>
            <text>
                <textPath xlink:href="#circle" class="text-xs tracking-wider fill-emerald-400">
                    TOURISM • INSIGHTS • PHILIPPINES
                </textPath>
            </text>
        </svg>
    </div>
</section>
    
    <!-- Featured Destinations Section -->
    <section class="py-20">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold fade-up">Featured Destinations</h2>
                    <p class="mt-4 text-gray-400 max-w-2xl fade-up">Explore the most visited and trending destinations across the Philippine islands.</p>
                </div>
                <a href="#" class="link text-emerald-400 mt-4 md:mt-0 fade-up">View all destinations</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Destination Card 1 -->
                <div class="destination-card fade-up">
                    <div class="relative overflow-hidden h-80 rounded-lg">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent z-10"></div>
                        <div class="w-full h-full bg-emerald-800" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgZmlsbD0iIzA2OTA2QSIvPjxjaXJjbGUgY3g9IjIwMCIgY3k9IjIwMCIgcj0iMTAwIiBmaWxsPSIjMDRCNDgxIi8+PHBhdGggZD0iTTEwMCAzMDBMMzAwIDEwMEwzNTAgMTUwTDE1MCAzNTBaIiBmaWxsPSIjMzREMzk5Ii8+PC9zdmc+'); background-size: cover; background-position: center;"></div>
                        <div class="absolute bottom-0 left-0 p-6 z-20">
                            <h3 class="text-2xl font-bold">Boracay Island</h3>
                            <p class="text-gray-300 mt-2">World-renowned white sand beaches</p>
                            <div class="flex mt-4">
                                <span class="bg-emerald-500 text-xs px-2 py-1 rounded">4.9/5 Rating</span>
                                <span class="bg-white bg-opacity-20 text-xs px-2 py-1 rounded ml-2">Western Visayas</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Card 2 -->
                <div class="destination-card fade-up">
                    <div class="relative overflow-hidden h-80 rounded-lg">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent z-10"></div>
                        <div class="w-full h-full bg-blue-800" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgZmlsbD0iIzA1NTY5MCIvPjxjaXJjbGUgY3g9IjIwMCIgY3k9IjIwMCIgcj0iMTAwIiBmaWxsPSIjMDc3N0IzIi8+PHBhdGggZD0iTTEwMCAxNTBMMzAwIDI1MEwzNTAgMjAwTDE1MCAxMDBaIiBmaWxsPSIjMzlBOUREIi8+PC9zdmc+'); background-size: cover; background-position: center;"></div>
                        <div class="absolute bottom-0 left-0 p-6 z-20">
                            <h3 class="text-2xl font-bold">Palawan</h3>
                            <p class="text-gray-300 mt-2">Home to the Underground River</p>
                            <div class="flex mt-4">
                                <span class="bg-emerald-500 text-xs px-2 py-1 rounded">4.8/5 Rating</span>
                                <span class="bg-white bg-opacity-20 text-xs px-2 py-1 rounded ml-2">MIMAROPA</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Card 3 -->
                <div class="destination-card fade-up">
                    <div class="relative overflow-hidden h-80 rounded-lg">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent z-10"></div>
                        <div class="w-full h-full bg-amber-800" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgZmlsbD0iIzc4MzQwRiIvPjxwYXRoIGQ9Ik0xMDAgMjAwTDIwMCAxMDBMMzAwIDIwMEwyMDAgMzAwWiIgZmlsbD0iI0I0NTMwOSIvPjxwYXRoIGQ9Ik01MCAyMDBMMTAwIDE1MEwxNTAgMjAwTDEwMCAyNTBaIiBmaWxsPSIjRDY3RDJEIi8+PHBhdGggZD0iTTI1MCAyMDBMMzAwIDE1MEwzNTAgMjAwTDMwMCAyNTBaIiBmaWxsPSIjRDY3RDJEIi8+PC9zdmc+'); background-size: cover; background-position: center;"></div>
                        <div class="absolute bottom-0 left-0 p-6 z-20">
                            <h3 class="text-2xl font-bold">Chocolate Hills</h3>
                            <p class="text-gray-300 mt-2">Iconic geological formation</p>
                            <div class="flex mt-4">
                                <span class="bg-emerald-500 text-xs px-2 py-1 rounded">4.7/5 Rating</span>
                                <span class="bg-white bg-opacity-20 text-xs px-2 py-1 rounded ml-2">Bohol</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Tourism Statistics Section -->
    <section class="py-20 bg-slate-900">
        <div class="container mx-auto px-4 md:px-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center fade-up">Tourism Statistics</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Stat Card 1 -->
                <div class="bg-slate-800 p-8 rounded-lg fade-up">
                    <div class="text-emerald-400 text-4xl font-bold mb-2">8.26M</div>
                    <div class="text-xl font-semibold mb-4">International Arrivals</div>
                    <p class="text-gray-400">Total international tourist arrivals recorded in the most recent year, showing a 15% increase from the previous year.</p>
                    <div class="mt-6">
                        <div class="h-2 bg-slate-700 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-400 rounded-full" style="width: 85%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm text-gray-400">
                            <span>Previous Year</span>
                            <span>Current Year</span>
                        </div>
                    </div>
                </div>
                
                <!-- Stat Card 2 -->
                <div class="bg-slate-800 p-8 rounded-lg fade-up">
                    <div class="text-emerald-400 text-4xl font-bold mb-2">72.1%</div>
                    <div class="text-xl font-semibold mb-4">Occupancy Rate</div>
                    <p class="text-gray-400">Average hotel occupancy rate across major tourist destinations, indicating strong accommodation demand.</p>
                    <div class="mt-6">
                        <div class="h-2 bg-slate-700 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-400 rounded-full" style="width: 72%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm text-gray-400">
                            <span>0%</span>
                            <span>100%</span>
                        </div>
                    </div>
                </div>
                
                <!-- Stat Card 3 -->
                <div class="bg-slate-800 p-8 rounded-lg fade-up">
                    <div class="text-emerald-400 text-4xl font-bold mb-2">₱396B</div>
                    <div class="text-xl font-semibold mb-4">Tourism Revenue</div>
                    <p class="text-gray-400">Annual contribution of tourism to the Philippine economy, representing approximately 12.7% of GDP.</p>
                    <div class="mt-6">
                        <div class="h-2 bg-slate-700 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-400 rounded-full" style="width: 68%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm text-gray-400">
                            <span>Previous Year</span>
                            <span>Current Year</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12 fade-up">
                <a href="#" class="border border-emerald-400 text-emerald-400 hover:bg-emerald-400 hover:text-white px-8 py-3 rounded-full text-lg font-medium transition-all duration-300 inline-block">View Detailed Statistics</a>
            </div>
        </div>
    </section>
    
    <!-- Call to Action Section -->
    <section class="py-24 bg-gradient-to-r from-emerald-900 to-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="none" stroke="#fff" stroke-width="0.2"></path>
                <path d="M0,0 L100,100 M100,0 L0,100" stroke="#fff" stroke-width="0.2"></path>
            </svg>
        </div>
        
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-5xl font-bold mb-6 fade-up">Ready to Explore Philippine Tourism?</h2>
                <p class="text-xl text-gray-300 mb-10 fade-up">Access comprehensive data, trends, and insights about tourism across the Philippine archipelago.</p>
                <div class="fade-up">
                    <a href="#" class="bg-white text-slate-900 hover:bg-emerald-400 hover:text-white px-8 py-4 rounded-full text-lg font-medium transition-all duration-300 inline-block">Start Exploring</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-slate-950 py-12">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <a href="#" class="text-2xl font-bold tracking-tight mb-6 md:mb-0">Tourism<span class="text-emerald-400">Insights</span>PH</a>
                
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">About Us</h3>
                        <p class="text-gray-400">Tourism Insights PH provides comprehensive data and analysis on tourism trends across the Philippines.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-300">Home</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-300">Destinations</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-300">Occupancy Rates</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors duration-300">Arrivals</a></li>
                        </ul>
                    </div>
                    
                 
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li>Manila, Philippines</li>
                            <li>info@tourisminsightsph.com</li>
                            <li>+63 2 8888 8888</li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-12 text-center text-gray-500 text-sm">
                    <p>&copy; 2025 Tourism Insights PH. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    
  
    <script src="script.js"></script>
</body>
</html>
