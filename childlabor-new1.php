<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Child Labor: Data Analytics Perspective</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            overflow-x: hidden;
        }
        
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loader-text {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            overflow: hidden;
            color: #4F46E5;
        }
        
        .loader-progress {
            position: absolute;
            bottom: 30%;
            width: 30%;
            height: 2px;
            background: rgba(79, 70, 229, 0.2);
        }
        
        .loader-progress-fill {
            height: 100%;
            width: 0;
            background: #4F46E5;
        }
        
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #4F46E5;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .magnetic-cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(79, 70, 229, 0.3);
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
            display: none;
        }

        @media (min-width: 768px) {
            .magnetic-cursor {
                display: block;
            }
        }
        
        .data-section {
            position: relative;
            overflow: hidden;
        }
        
        .chart-container {
            width: 100%;
            height: 400px;
            position: relative;
        }
        
        .reveal-text {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .scroll-indicator {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(79, 70, 229, 0.3);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
        }
        
        .scroll-circle {
            width: 5px;
            height: 5px;
            background: #4F46E5;
            border-radius: 50%;
        }
        
        /* Mobile menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            height: 100%;
            background: white;
            z-index: 999;
            transition: right 0.3s ease-in-out;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            overflow-y: auto;
        }
        
        .mobile-menu.active {
            right: 0;
        }
        
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }
        
        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-nav-link {
            display: block;
            padding: 1rem 0;
            font-size: 1.25rem;
            border-bottom: 1px solid #eee;
            transition: color 0.2s ease;
        }
        
        .mobile-nav-link:hover {
            color: #4F46E5;
        }
        
        /* Stats counter animation */
        .stat-counter {
            font-weight: 700;
            font-size: 2.5rem;
            color: #4F46E5;
        }
        
        .stat-card {
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        /* Feature cards */
        .feature-card {
            border-radius: 0.75rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(79, 70, 229, 0.1);
            color: #4F46E5;
            margin-bottom: 1rem;
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 2px;
            background-color: rgba(79, 70, 229, 0.3);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
        }
        
        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: white;
            border: 4px solid #4F46E5;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }
        
        .left {
            left: 0;
        }
        
        .right {
            left: 50%;
        }
        
        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid #f8f9fa;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent #f8f9fa;
        }
        
        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid #f8f9fa;
            border-width: 10px 10px 10px 0;
            border-color: transparent #f8f9fa transparent transparent;
        }
        
        .right::after {
            left: -10px;
        }
        
        .timeline-content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        /* Responsive adjustments for timeline */
        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }
            
            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-container::before {
                left: 60px;
                border: medium solid #f8f9fa;
                border-width: 10px 10px 10px 0;
                border-color: transparent #f8f9fa transparent transparent;
            }
            
            .left::after, .right::after {
                left: 21px;
            }
            
            .right {
                left: 0%;
            }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .loader-progress {
                width: 70%;
            }
            
            .scroll-indicator {
                bottom: 20px;
                right: 20px;
            }
        }

        /* D3 chart styles */
        .axis path,
        .axis line {
            stroke: rgba(79, 70, 229, 0.2);
        }
        
        .axis text {
            fill: #555;
            font-size: 10px;
        }
        
        .chart-title {
            font-size: 18px;
            font-weight: 500;
            fill: #333;
        }
        
        .data-bar {
            fill: #4F46E5;
            opacity: 0.8;
        }
        
        .data-bar:hover {
            opacity: 1;
        }
        
        .tooltip {
            position: absolute;
            padding: 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            pointer-events: none;
            color: #333;
            font-size: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Action buttons */
        .action-btn {
            background-color: #4F46E5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        
        .action-btn:hover {
            background-color: #4338CA;
            transform: translateY(-2px);
        }
        
        .action-btn-outline {
            border: 2px solid #4F46E5;
            color: #4F46E5;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }
        
        .action-btn-outline:hover {
            background-color: #4F46E5;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="relative">
    <!-- Preloader -->
    <div class="loader">
        <div class="loader-text">CHILD LABOR DATA</div>
        <div class="loader-progress">
            <div class="loader-progress-fill"></div>
        </div>
    </div>
    
    <!-- Custom cursor -->
    <div class="magnetic-cursor"></div>
    
    <!-- Mobile menu overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    
    <!-- Mobile menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="flex justify-between items-center mb-8">
            <div class="text-xl font-medium tracking-wide">CHILD<span class="text-indigo-500">.DATA</span></div>
            <button id="closeMenu" class="text-2xl">&times;</button>
        </div>
        <nav>
            <a href="#overview" class="mobile-nav-link">Overview</a>
            <a href="#trends" class="mobile-nav-link">Trends</a>
            <a href="#sectors" class="mobile-nav-link">Sectors</a>
            <a href="#regions" class="mobile-nav-link">Regions</a>
            <a href="#solutions" class="mobile-nav-link">Solutions</a>
            <a href="#timeline" class="mobile-nav-link">Timeline</a>
        </nav>
        <div class="mt-8 pt-8 border-t border-gray-200">
            <a href="#" class="action-btn block text-center">Download Full Report</a>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 px-6 md:px-12 py-4 flex justify-between items-center bg-white shadow-md">
        <div class="text-xl font-medium tracking-wide">CHILD<span class="text-indigo-500">.DATA</span></div>
        <div class="hidden md:flex space-x-8">
            <a href="#overview" class="nav-link">Overview</a>
            <a href="#trends" class="nav-link">Trends</a>
            <a href="#sectors" class="nav-link">Sectors</a>
            <a href="#regions" class="nav-link">Regions</a>
            <a href="#solutions" class="nav-link">Solutions</a>
            <a href="#timeline" class="nav-link">Timeline</a>
        </div>
        <div class="md:hidden">
            <button id="openMenu" class="text-2xl">≡</button>
        </div>
    </nav>
    
    <!-- Hero section -->
    <section class="pt-28 pb-16 md:pb-24 px-6 md:px-12 relative overflow-hidden bg-gradient-to-b from-indigo-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight reveal-text">Child Labor:<br><span class="text-indigo-600">A Data Analytics Perspective</span></h1>
                    <p class="text-gray-600 max-w-xl text-lg md:text-xl mb-8 reveal-text">Examining the global crisis through data insights from 2020-2022. Uncovering patterns, trends, and potential solutions.</p>
                    <div class="flex flex-wrap gap-4 reveal-text">
                        <a href="#overview" class="action-btn">Explore Data</a>
                        <a href="#" class="action-btn-outline">Download Report</a>
                    </div>
                </div>
                <div class="reveal-text">
                    <div class="relative h-96 rounded-lg overflow-hidden shadow-xl">
                        <div id="hero-chart" class="absolute inset-0 bg-white"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-indigo-300/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-300/10 rounded-full blur-3xl"></div>
    </section>
    
    <!-- Key stats section -->
    <section class="py-16 px-6 md:px-12 bg-white relative">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-12 text-center reveal-text">The Global Reality in Numbers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="stat-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="stat-counter" data-target="160">0</div>
                    <div class="text-gray-600 font-medium">Million Children</div>
                    <div class="text-sm text-gray-500 mt-2">In child labor globally</div>
                </div>
                <div class="stat-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="stat-counter" data-target="79">0</div>
                    <div class="text-gray-600 font-medium">Million Children</div>
                    <div class="text-sm text-gray-500 mt-2">In hazardous work</div>
                </div>
                <div class="stat-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="stat-counter" data-target="72">0</div>
                    <div class="text-gray-600 font-medium">Percent</div>
                    <div class="text-sm text-gray-500 mt-2">In rural areas</div>
                </div>
                <div class="stat-card bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="stat-counter" data-target="8.4">0</div>
                    <div class="text-gray-600 font-medium">Million Increase</div>
                    <div class="text-sm text-gray-500 mt-2">Since COVID-19</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features section -->
    <section class="py-16 px-6 md:px-12 bg-indigo-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 text-center reveal-text">Why This Data Matters</h2>
            <p class="text-gray-600 text-center max-w-3xl mx-auto mb-12 reveal-text">Our data analytics approach provides unique insights that can help shape more effective interventions and policies.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 shadow-md reveal-text">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Data-Driven Decisions</h3>
                    <p class="text-gray-600">Our analysis provides critical insights for policymakers to develop evidence-based interventions that address root causes effectively.</p>
                </div>
                
                <div class="feature-card bg-white p-8 shadow-md reveal-text">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Regional Insights</h3>
                    <p class="text-gray-600">Understanding geographical variations helps target resources where they're most needed and can have the greatest impact.</p>
                </div>
                
                <div class="feature-card bg-white p-8 shadow-md reveal-text">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Trend Analysis</h3>
                    <p class="text-gray-600">By tracking changes over time, we can identify which interventions work and adapt strategies to emerging challenges.</p>
                </div>
                
                <div class="feature-card bg-white p-8 shadow-md reveal-text">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Demographic Patterns</h3>
                    <p class="text-gray-600">Understanding how child labor affects different age groups and genders enables more targeted and effective protection programs.</p>
                </div>
                
                <div class="feature-card bg-white p-8 shadow-md reveal-text">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Impact Measurement</h3>
                    <p class="text-gray-600">Our analytics help measure the real impact of interventions, allowing for continuous improvement in child protection efforts.</p>
                </div>
                
                <div class="feature-card bg-white p-8 shadow-md reveal-text">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Advocacy Support</h3>
                    <p class="text-gray-600">Data-backed advocacy is more persuasive, helping raise awareness and drive policy change at local and global levels.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Overview section -->
    <section id="overview" class="py-20 px-6 md:px-12 data-section bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 reveal-text">The Global Landscape</h2>
            <p class="text-gray-600 max-w-3xl mb-12 reveal-text">Understanding the scale and scope of child labor is essential for developing effective interventions.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8 reveal-text">Child labor remains a persistent global challenge, with approximately 160 million children engaged in child labor as of 2021. This represents nearly 1 in 10 children worldwide, with almost half involved in hazardous work that directly threatens their health and development.</p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8 reveal-text">The data reveals concerning trends following the COVID-19 pandemic, with progress against child labor stalling and, in many regions, reversing for the first time in two decades.</p>
                    <div class="flex gap-4 reveal-text">
                        <a href="#sectors" class="action-btn-outline">Explore Sectors</a>
                        <a href="#regions" class="action-btn-outline">View Regional Data</a>
                    </div>
                </div>
                <div class="chart-container rounded-lg shadow-lg bg-white p-4" id="overview-chart">
                    <!-- D3 chart will be rendered here -->
                </div>
            </div>
        </div>
    </section>
    
    <!-- Trends section -->
    <section id="trends" class="py-20 px-6 md:px-12 data-section bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 reveal-text">Key Trends (2020-2022)</h2>
            <p class="text-gray-600 max-w-3xl mb-12 reveal-text">Analysis of how child labor patterns have evolved during and after the global pandemic.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">COVID-19 Impact</h3>
                    <p class="text-gray-600">The pandemic reversed years of progress, pushing an additional 8.4 million children into labor by the end of 2022, primarily due to school closures and economic pressures on vulnerable households.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Age Distribution</h3>
                    <p class="text-gray-600">The data shows a concerning increase in child labor among children aged 5-11, highlighting the need for targeted early intervention programs and educational support.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Gender Patterns</h3>
                    <p class="text-gray-600">Boys remain more likely to be engaged in child labor globally (11.2% vs. 7.8% for girls), though girls' participation in domestic work is often underreported in official statistics.</p>
                </div>
            </div>
            
            <div class="mt-16 chart-container rounded-lg shadow-lg bg-white p-4" id="trends-chart">
                <!-- D3 chart will be rendered here -->
            </div>
        </div>
    </section>
    
    <!-- Timeline section -->
    <section id="timeline" class="py-20 px-6 md:px-12 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center reveal-text">Child Labor Trends Timeline</h2>
            <p class="text-gray-600 text-center max-w-3xl mx-auto mb-16 reveal-text">How the global situation has evolved over the past decade, with a focus on recent developments.</p>
            
            <div class="timeline reveal-text">
                <div class="timeline-container left">
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">2012</h3>
                        <p class="text-gray-600">Global estimate: 168 million child laborers. International organizations set goal to eliminate worst forms of child labor by 2016.</p>
                    </div>
                </div>
                <div class="timeline-container right">
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">2016</h3>
                        <p class="text-gray-600">Numbers decrease to 152 million. Target date for elimination of worst forms not met, but significant progress made in many regions.</p>
                    </div>
                </div>
                <div class="timeline-container left">
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">2019</h3>
                        <p class="text-gray-600">Slow but steady progress continues with estimated 150 million children in labor. UN designates 2021 as International Year for the Elimination of Child Labour.</p>
                    </div>
                </div>
                <div class="timeline-container right">
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">2020</h3>
                        <p class="text-gray-600">COVID-19 pandemic begins. School closures and economic instability immediately impact vulnerable families. Early data shows concerning trends.</p>
                    </div>
                </div>
                <div class="timeline-container left">
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">2021</h3>
                        <p class="text-gray-600">New global estimate reveals first increase in two decades: 160 million children in labor, representing a significant setback in global efforts.</p>
                    </div>
                </div>
                <div class="timeline-container right">
                    <div class="timeline-content">
                        <h3 class="text-xl font-semibold mb-2 text-indigo-600">2022</h3>
                        <p class="text-gray-600">Data shows continued negative impact of pandemic, with an estimated 168 million children in labor. New focus on resilient protection systems emerges.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Sectors section -->
    <section id="sectors" class="py-20 px-6 md:px-12 data-section bg-gray-50 relative">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 reveal-text">Sectors with Highest Prevalence</h2>
            <p class="text-gray-600 max-w-3xl mb-12 reveal-text">Where child labor is most concentrated and what factors drive this distribution.</p>
            
            <div class="chart-container rounded-lg shadow-lg bg-white p-4 mb-12" id="sectors-chart">
                <!-- D3 chart will be rendered here -->
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Agricultural Sector</h3>
                    <p class="text-gray-600 mb-4">Accounting for 70% of child labor globally, agriculture remains the largest employing sector. Children often work in hazardous conditions with exposure to pesticides, dangerous equipment, and extreme weather.</p>
                    <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 transition">Read agricultural sector deep dive →</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Mining & Raw Materials</h3>
                    <p class="text-gray-600 mb-4">Despite representing a smaller percentage of total child labor, this sector poses extreme risks. Children working in artisanal mining face severe physical harm and toxic exposure, with data showing limited progress in reducing prevalence.</p>
                    <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 transition">Read mining sector analysis →</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Regional section -->
    <section id="regions" class="py-20 px-6 md:px-12 data-section bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 reveal-text">Regional Distribution</h2>
            <p class="text-gray-600 max-w-3xl mb-12 reveal-text">How child labor patterns vary by geography and what this means for targeted interventions.</p>
            
            <div class="chart-container rounded-lg shadow-lg bg-white p-4 mb-12" id="regions-chart">
                <!-- D3 chart will be rendered here -->
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Sub-Saharan Africa</h3>
                    <p class="text-gray-600 mb-4">With 23.9% of children engaged in labor, this region has both the highest percentage and absolute number of working children. Data from 2020-2022 shows limited improvement, with economic shocks reversing previous gains.</p>
                    <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 transition">View detailed region report →</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">South Asia</h3>
                    <p class="text-gray-600 mb-4">While showing some improvement, South Asia still accounts for a significant portion of global child labor. The data reveals particular challenges in informal sectors and family-based work arrangements.</p>
                    <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800 transition">View detailed region report →</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Solutions section -->
    <section id="solutions" class="py-20 px-6 md:px-12 data-section bg-gray-50 relative">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 reveal-text">Data-Driven Solutions</h2>
            <p class="text-gray-600 max-w-3xl mb-12 reveal-text">How analytics can inform more effective interventions and policy responses.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Education Accessibility</h3>
                    <p class="text-gray-600">Analysis shows that regions with increased educational investment saw a 15-20% reduction in child labor rates. Data supports focusing on transitional years (ages 10-14) when dropout risk increases.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Social Protection Systems</h3>
                    <p class="text-gray-600">Cash transfer programs with education conditions demonstrate the strongest statistical correlation with reduced child labor, showing an average 30% reduction in participating communities.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Supply Chain Monitoring</h3>
                    <p class="text-gray-600">Advanced data analytics and blockchain technologies have helped identify high-risk supply chain nodes with 73% accuracy, enabling targeted interventions and enforcement.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md reveal-text">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-600">Predictive Modeling</h3>
                    <p class="text-gray-600">Machine learning algorithms analyzing economic, social, and environmental factors can now predict child labor risk with up to 82% accuracy, allowing for proactive prevention strategies.</p>
                </div>
            </div>
            
            <div class="mt-12 text-center reveal-text">
                <a href="#" class="action-btn inline-block">Download Full Solutions Report</a>
            </div>
        </div>
    </section>
    
    <!-- CTA section -->
    <section class="py-16 px-6 md:px-12 bg-indigo-600">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white reveal-text">Join the Effort to End Child Labor</h2>
            <p class="text-indigo-100 text-lg md:text-xl mb-8 reveal-text">Our data is freely available to researchers, policy makers, and organizations working to combat child labor. Together, we can make progress.</p>
            <div class="flex flex-wrap justify-center gap-4 reveal-text">
                <a href="#" class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition">Request Data Access</a>
                <a href="#" class="border-2 border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white/10 transition">Partner With Us</a>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="px-6 md:px-12 py-16 bg-gray-800 text-white">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div>
                    <div class="text-xl font-medium tracking-wide mb-6">CHILD<span class="text-indigo-400">.DATA</span></div>
                    <p class="text-gray-300">A data analytics perspective on global child labor trends and solutions from 2020-2022.</p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-medium mb-6">Navigation</h4>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="#overview" class="text-gray-300 hover:text-white transition py-1">Overview</a>
                        <a href="#trends" class="text-gray-300 hover:text-white transition py-1">Trends</a>
                        <a href="#sectors" class="text-gray-300 hover:text-white transition py-1">Sectors</a>
                        <a href="#regions" class="text-gray-300 hover:text-white transition py-1">Regions</a>
                        <a href="#solutions" class="text-gray-300 hover:text-white transition py-1">Solutions</a>
                        <a href="#timeline" class="text-gray-300 hover:text-white transition py-1">Timeline</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-medium mb-6">Resources</h4>
                    <div class="flex flex-col space-y-2">
                        <a href="#" class="text-gray-300 hover:text-white transition">Download Full Report</a>
                        <a href="#" class="text-gray-300 hover:text-white transition">Research Methodology</a>
                        <a href="#" class="text-gray-300 hover:text-white transition">Data Sources</a>
                        <a href="#" class="text-gray-300 hover:text-white transition">Contact Research Team</a>
                    </div>
                </div>
            </div>
            <div class="text-gray-400 text-sm pt-8 border-t border-gray-700">
                © 2025 Child Labor Data Analytics Project. All data visualizations based on research from 2020-2022.
            </div>
        </div>
    </footer>
    
    <!-- Scroll indicator -->
    <div class="scroll-indicator">
        <div class="scroll-circle"></div>
    </div>

    <script>
        // Preloader animation
        document.addEventListener('DOMContentLoaded', () => {
            const loader = document.querySelector('.loader');
            const loaderFill = document.querySelector('.loader-progress-fill');
            const loaderText = document.querySelector('.loader-text');
            
            // Animate loader
            gsap.to(loaderFill, {
                width: '100%',
                duration: 2.5,
                ease: 'power2.inOut'
            });
            
            gsap.to(loaderText, {
                opacity: 0,
                y: -20,
                delay: 2,
                duration: 0.5
            });
            
            gsap.to(loader, {
                opacity: 0,
                duration: 0.8,
                delay: 2.5,
                onComplete: () => {
                    loader.style.display = 'none';
                    initAnimations();
                    initCharts();
                    initMobileMenu();
                    initCounters();
                }
            });
        });
        
        // Mobile menu
        function initMobileMenu() {
            const openMenu = document.getElementById('openMenu');
            const closeMenu = document.getElementById('closeMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
            
            openMenu.addEventListener('click', () => {
                mobileMenu.classList.add('active');
                mobileMenuOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            
            const closeMenuFunction = () => {
                mobileMenu.classList.remove('active');
                mobileMenuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            };
            
            closeMenu.addEventListener('click', closeMenuFunction);
            mobileMenuOverlay.addEventListener('click', closeMenuFunction);
            
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    closeMenuFunction();
                    
                    // Smooth scroll to section
                    const href = link.getAttribute('href');
                    if (href.startsWith('#')) {
                        const section = document.querySelector(href);
                        if (section) {
                            window.scrollTo({
                                top: section.offsetTop - 80,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        }
        
        // Stats counter animation
        function initCounters() {
            const counters = document.querySelectorAll('.stat-counter');
            const speed = 200; // The lower the faster
            
            const observerOptions = {
                threshold: 0.5
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseFloat(counter.getAttribute('data-target'));
                        const increment = target / speed;
                        
                        let currentCount = 0;
                        
                        const updateCount = () => {
                            currentCount += increment;
                            
                            if (currentCount < target) {
                                if (Number.isInteger(target)) {
                                    counter.innerText = Math.ceil(currentCount);
                                } else {
                                    counter.innerText = currentCount.toFixed(1);
                                }
                                requestAnimationFrame(updateCount);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        
                        updateCount();
                        observer.unobserve(counter);
                    }
                });
            }, observerOptions);
            
            counters.forEach(counter => {
                observer.observe(counter);
            });
        }
        
        // Custom cursor animation
        function initCursor() {
            const cursor = document.querySelector('.magnetic-cursor');
            
            document.addEventListener('mousemove', (e) => {
                gsap.to(cursor, {
                    x: e.clientX,
                    y: e.clientY,
                    duration: 0.1
                });
            });
            
            // Make cursor grow on interactive elements
            const interactiveElements = document.querySelectorAll('a, button');
            
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    gsap.to(cursor, {
                        scale: 2.5,
                        duration: 0.3
                    });
                });
                
                el.addEventListener('mouseleave', () => {
                    gsap.to(cursor, {
                        scale: 1,
                        duration: 0.3
                    });
                });
            });
        }
        
        // Scroll animations
        function initAnimations() {
            // Init cursor
            initCursor();
            
            // Animate scroll indicator
            gsap.to('.scroll-circle', {
                y: 10,
                opacity: 0.5,
                duration: 1,
                repeat: -1,
                yoyo: true
            });
            
            // Reveal text elements on scroll
            const revealElements = document.querySelectorAll('.reveal-text');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        gsap.to(entry.target, {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            stagger: 0.1,
                            ease: 'power2.out'
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            revealElements.forEach(el => {
                observer.observe(el);
            });
            
            // Animate navigation on scroll
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    document.querySelector('nav').classList.add('shadow-md');
                } else {
                    document.querySelector('nav').classList.remove('shadow-md');
                }
            });
            
            // Animate menu links to scroll smoothly
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const href = link.getAttribute('href');
                    if (href.startsWith('#')) {
                        const section = document.querySelector(href);
                        if (section) {
                            window.scrollTo({
                                top: section.offsetTop - 80,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        }
        
        // D3 Charts
        function initCharts() {
            // Hero Chart - Special bubble chart
            createBubbleChart('#hero-chart');
            
            // Overview Chart - Line chart showing child labor trends
            const overviewData = [
                { year: 2010, value: 215 },
                { year: 2012, value: 200 },
                { year: 2014, value: 185 },
                { year: 2016, value: 170 },
                { year: 2018, value: 160 },
                { year: 2020, value: 160 },
                { year: 2022, value: 168 }
            ];
            
            createLineChart('#overview-chart', overviewData, 'Global Child Labor (Millions)', 'Year', 'Children in Labor (Millions)');
            
            // Trends Chart - Multi-line chart with age groups
            const trendsData = [
                { year: 2018, group: '5-11 years', value: 70 },
                { year: 2020, group: '5-11 years', value: 72 },
                { year: 2022, group: '5-11 years', value: 78 },
                { year: 2018, group: '12-14 years', value: 50 },
                { year: 2020, group: '12-14 years', value: 49 },
                { year: 2022, group: '12-14 years', value: 53 },
                { year: 2018, group: '15-17 years', value: 40 },
                { year: 2020, group: '15-17 years', value: 39 },
                { year: 2022, group: '15-17 years', value: 37 }
            ];
            
            createMultiLineChart('#trends-chart', trendsData, 'Child Labor by Age Group', 'Year', 'Children (Millions)');
            
            // Sectors Chart - Bar chart
            const sectorsData = [
                { sector: 'Agriculture', value: 70 },
                { sector: 'Services', value: 19 },
                { sector: 'Industry', value: 11 }
            ];
            
            createBarChart('#sectors-chart', sectorsData, 'Child Labor by Sector (2022)', 'Sector', '% of Child Labor');
            
            // Regions Chart - Horizontal bar chart
            const regionsData = [
                { region: 'Sub-Saharan Africa', value: 23.9 },
                { region: 'Central/South Asia', value: 5.5 },
                { region: 'East/Southeast Asia', value: 3.8 },
                { region: 'Northern Africa', value: 5.0 },
                { region: 'Latin America', value: 4.3 },
                { region: 'Europe/North America', value: 2.3 }
            ];
            
            createHorizontalBarChart('#regions-chart', regionsData, 'Child Labor by Region (2022)', 'Region', '% of Children');
        }
        
        // Bubble Chart for Hero
        function createBubbleChart(container) {
            const width = document.querySelector(container).clientWidth;
            const height = document.querySelector(container).clientHeight;
            
            const svg = d3.select(container)
                .append('svg')
                .attr('width', width)
                .attr('height', height);
                
            // Create data for bubbles
            const bubbleData = [];
            for (let i = 0; i < 40; i++) {
                bubbleData.push({
                    id: i,
                    x: Math.random() * width,
                    y: Math.random() * height,
                    radius: Math.random() * 20 + 5,
                    color: d3.interpolateBlues(Math.random() * 0.7 + 0.3)
                });
            }
            
            // Add bubbles
            const bubbles = svg.selectAll('.bubble')
                .data(bubbleData)
                .enter()
                .append('circle')
                .attr('class', 'bubble')
                .attr('cx', d => d.x)
                .attr('cy', d => d.y)
                .attr('r', 0)
                .attr('fill', d => d.color)
                .attr('opacity', 0.7);
                
            // Animate bubbles
            bubbles.transition()
                .delay((d, i) => i * 50)
                .duration(1000)
                .attr('r', d => d.radius);
                
            // Add animation
            function animateBubbles() {
                bubbles.transition()
                    .duration(3000)
                    .attr('cx', d => d.x + (Math.random() * 100 - 50))
                    .attr('cy', d => d.y + (Math.random() * 100 - 50))
                    .on('end', animateBubbles);
            }
            
            animateBubbles();
            
            // Add text
            svg.append('text')
                .attr('x', width / 2)
                .attr('y', height / 2)
                .attr('text-anchor', 'middle')
                .attr('dominant-baseline', 'middle')
                .attr('font-size', '24px')
                .attr('font-weight', 'bold')
                .attr('fill', '#4F46E5')
                .text('160 Million Children');
                
            svg.append('text')
                .attr('x', width / 2)
                .attr('y', height / 2 + 30)
                .attr('text-anchor', 'middle')
                .attr('dominant-baseline', 'middle')
                .attr('font-size', '16px')
                .attr('fill', '#666')
                .text('in child labor globally');
        }
        
        // Line Chart Function
        function createLineChart(container, data, title, xLabel, yLabel) {
            const margin = { top: 50, right: 30, bottom: 60, left: 60 };
            const width = document.querySelector(container).clientWidth - margin.left - margin.right;
            const height = 400 - margin.top - margin.bottom;
            
            const svg = d3.select(container)
                .append('svg')
                .attr('width', width + margin.left + margin.right)
                .attr('height', height + margin.top + margin.bottom)
                .append('g')
                .attr('transform', `translate(${margin.left},${margin.top})`);
                
            // Add title
            svg.append('text')
                .attr('class', 'chart-title')
                .attr('x', width / 2)
                .attr('y', -20)
                .attr('text-anchor', 'middle')
                .text(title);
                
            // X scale
            const x = d3.scaleLinear()
                .domain(d3.extent(data, d => d.year))
                .range([0, width]);
                
            // Y scale
            const y = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.value) * 1.1])
                .range([height, 0]);
                
            // X axis
            svg.append('g')
                .attr('class', 'axis')
                .attr('transform', `translate(0,${height})`)
                .call(d3.axisBottom(x).tickFormat(d => d.toString()));
                
            // Y axis
            svg.append('g')
                .attr('class', 'axis')
                .call(d3.axisLeft(y));
                
            // X label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('x', width / 2)
                .attr('y', height + 40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(xLabel);
                
            // Y label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('transform', 'rotate(-90)')
                .attr('x', -height / 2)
                .attr('y', -40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(yLabel);
                
            // Line generator
            const line = d3.line()
                .x(d => x(d.year))
                .y(d => y(d.value))
                .curve(d3.curveMonotoneX);
                
            // Add path with animation
            const path = svg.append('path')
                .datum(data)
                .attr('fill', 'none')
                .attr('stroke', '#4F46E5')
                .attr('stroke-width', 3)
                .attr('d', line);
                
            // Get path length for animation
            const pathLength = path.node().getTotalLength();
            
            // Set up animation
            path.attr('stroke-dasharray', pathLength)
                .attr('stroke-dashoffset', pathLength)
                .transition()
                .duration(2000)
                .attr('stroke-dashoffset', 0);
                
            // Add dots
            svg.selectAll('.dot')
                .data(data)
                .enter()
                .append('circle')
                .attr('class', 'dot')
                .attr('cx', d => x(d.year))
                .attr('cy', d => y(d.value))
                .attr('r', 0)
                .attr('fill', '#4F46E5')
                .transition()
                .delay((d, i) => i * 300)
                .duration(500)
                .attr('r', 5);
                
            // Tooltip
            const tooltip = d3.select('body')
                .append('div')
                .attr('class', 'tooltip')
                .style('opacity', 0);
                
            svg.selectAll('.dot-hover')
                .data(data)
                .enter()
                .append('circle')
                .attr('class', 'dot-hover')
                .attr('cx', d => x(d.year))
                .attr('cy', d => y(d.value))
                .attr('r', 15)
                .attr('fill', 'transparent')
                .on('mouseover', function(event, d) {
                    tooltip.transition()
                        .duration(200)
                        .style('opacity', 0.9);
                    tooltip.html(`Year: ${d.year}<br>Children: ${d.value} million`)
                        .style('left', (event.pageX + 10) + 'px')
                        .style('top', (event.pageY - 28) + 'px');
                    d3.select(this.previousSibling)
                        .transition()
                        .duration(300)
                        .attr('r', 8);
                })
                .on('mouseout', function(event, d) {
                    tooltip.transition()
                        .duration(500)
                        .style('opacity', 0);
                    d3.select(this.previousSibling)
                        .transition()
                        .duration(300)
                        .attr('r', 5);
                });
        }
        
        // Multi-line Chart Function
        function createMultiLineChart(container, data, title, xLabel, yLabel) {
            const margin = { top: 50, right: 150, bottom: 60, left: 60 };
            const width = document.querySelector(container).clientWidth - margin.left - margin.right;
            const height = 400 - margin.top - margin.bottom;
            
            const svg = d3.select(container)
                .append('svg')
                .attr('width', width + margin.left + margin.right)
                .attr('height', height + margin.top + margin.bottom)
                .append('g')
                .attr('transform', `translate(${margin.left},${margin.top})`);
                
            // Add title
            svg.append('text')
                .attr('class', 'chart-title')
                .attr('x', width / 2)
                .attr('y', -20)
                .attr('text-anchor', 'middle')
                .text(title);
                
            // X scale
            const x = d3.scaleLinear()
                .domain(d3.extent(data, d => d.year))
                .range([0, width]);
                
            // Y scale
            const y = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.value) * 1.1])
                .range([height, 0]);
                
            // Color scale
            const colorScale = d3.scaleOrdinal()
                .domain(['5-11 years', '12-14 years', '15-17 years'])
                .range(['#4F46E5', '#10B981', '#F59E0B']);
                
            // X axis
            svg.append('g')
                .attr('class', 'axis')
                .attr('transform', `translate(0,${height})`)
                .call(d3.axisBottom(x).tickFormat(d => d.toString()));
                
            // Y axis
            svg.append('g')
                .attr('class', 'axis')
                .call(d3.axisLeft(y));
                
            // X label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('x', width / 2)
                .attr('y', height + 40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(xLabel);
                
            // Y label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('transform', 'rotate(-90)')
                .attr('x', -height / 2)
                .attr('y', -40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(yLabel);
                
            // Group data by age group
            const groupedData = Array.from(
                d3.group(data, d => d.group),
                ([group, values]) => ({ group, values })
            );
            
            // Line generator
            const line = d3.line()
                .x(d => x(d.year))
                .y(d => y(d.value))
                .curve(d3.curveMonotoneX);
                
            // Add lines with animation
            const lines = svg.selectAll('.line')
                .data(groupedData)
                .enter()
                .append('path')
                .attr('class', 'line')
                .attr('fill', 'none')
                .attr('stroke', d => colorScale(d.group))
                .attr('stroke-width', 3)
                .attr('d', d => line(d.values));
                
            // Animate lines
            lines.each(function() {
                const pathLength = this.getTotalLength();
                d3.select(this)
                    .attr('stroke-dasharray', pathLength)
                    .attr('stroke-dashoffset', pathLength)
                    .transition()
                    .duration(2000)
                    .attr('stroke-dashoffset', 0);
            });
            
            // Add dots
            groupedData.forEach(group => {
                svg.selectAll(`.dot-${group.group.replace(/\s+/g, '')}`)
                    .data(group.values)
                    .enter()
                    .append('circle')
                    .attr('class', `dot-${group.group.replace(/\s+/g, '')}`)
                    .attr('cx', d => x(d.year))
                    .attr('cy', d => y(d.value))
                    .attr('r', 0)
                    .attr('fill', colorScale(group.group))
                    .transition()
                    .delay((d, i) => i * 300)
                    .duration(500)
                    .attr('r', 5);
            });
            
            // Legend
            const legend = svg.append('g')
                .attr('class', 'legend')
                .attr('transform', `translate(${width + 20}, 0)`);
                
            groupedData.forEach((group, i) => {
                const legendRow = legend.append('g')
                    .attr('transform', `translate(0, ${i * 25})`);
                    
                legendRow.append('rect')
                    .attr('width', 15)
                    .attr('height', 15)
                    .attr('fill', colorScale(group.group));
                    
                legendRow.append('text')
                    .attr('x', 25)
                    .attr('y', 12)
                    .attr('fill', '#666')
                    .style('font-size', '14px')
                    .text(group.group);
            });
            
            // Tooltip
            const tooltip = d3.select('body')
                .append('div')
                .attr('class', 'tooltip')
                .style('opacity', 0);
                
            // Add invisible hover areas
            groupedData.forEach(group => {
                svg.selectAll(`.dot-hover-${group.group.replace(/\s+/g, '')}`)
                    .data(group.values)
                    .enter()
                    .append('circle')
                    .attr('class', `dot-hover-${group.group.replace(/\s+/g, '')}`)
                    .attr('cx', d => x(d.year))
                    .attr('cy', d => y(d.value))
                    .attr('r', 15)
                    .attr('fill', 'transparent')
                    .on('mouseover', function(event, d) {
                        tooltip.transition()
                            .duration(200)
                            .style('opacity', 0.9);
                        tooltip.html(`Year: ${d.year}<br>Age: ${d.group}<br>Children: ${d.value} million`)
                            .style('left', (event.pageX + 10) + 'px')
                            .style('top', (event.pageY - 28) + 'px');
                        d3.select(this.previousSibling)
                            .transition()
                            .duration(300)
                            .attr('r', 8);
                    })
                    .on('mouseout', function(event, d) {
                        tooltip.transition()
                            .duration(500)
                            .style('opacity', 0);
                        d3.select(this.previousSibling)
                            .transition()
                            .duration(300)
                            .attr('r', 5);
                    });
            });
        }
        
        // Bar Chart Function
        function createBarChart(container, data, title, xLabel, yLabel) {
            const margin = { top: 50, right: 30, bottom: 60, left: 60 };
            const width = document.querySelector(container).clientWidth - margin.left - margin.right;
            const height = 400 - margin.top - margin.bottom;
            
            const svg = d3.select(container)
                .append('svg')
                .attr('width', width + margin.left + margin.right)
                .attr('height', height + margin.top + margin.bottom)
                .append('g')
                .attr('transform', `translate(${margin.left},${margin.top})`);
                
            // Add title
            svg.append('text')
                .attr('class', 'chart-title')
                .attr('x', width / 2)
                .attr('y', -20)
                .attr('text-anchor', 'middle')
                .text(title);
                
            // X scale
            const x = d3.scaleBand()
                .domain(data.map(d => d.sector))
                .range([0, width])
                .padding(0.3);
                
            // Y scale
            const y = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.value) * 1.1])
                .range([height, 0]);
                
            // Color scale
            const colorScale = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.value)])
                .range(['#4F46E5', '#312E81']);
                
            // X axis
            svg.append('g')
                .attr('class', 'axis')
                .attr('transform', `translate(0,${height})`)
                .call(d3.axisBottom(x));
                
            // Y axis
            svg.append('g')
                .attr('class', 'axis')
                .call(d3.axisLeft(y));
                
            // X label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('x', width / 2)
                .attr('y', height + 40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(xLabel);
                
            // Y label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('transform', 'rotate(-90)')
                .attr('x', -height / 2)
                .attr('y', -40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(yLabel);
                
            // Add bars with animation
            svg.selectAll('.bar')
                .data(data)
                .enter()
                .append('rect')
                .attr('class', 'data-bar')
                .attr('x', d => x(d.sector))
                .attr('width', x.bandwidth())
                .attr('y', height)
                .attr('height', 0)
                .attr('fill', d => colorScale(d.value))
                .transition()
                .delay((d, i) => i * 300)
                .duration(1000)
                .attr('y', d => y(d.value))
                .attr('height', d => height - y(d.value));
                
            // Add values on top of bars
            svg.selectAll('.bar-label')
                .data(data)
                .enter()
                .append('text')
                .attr('class', 'bar-label')
                .attr('x', d => x(d.sector) + x.bandwidth() / 2)
                .attr('y', d => y(d.value) - 10)
                .attr('text-anchor', 'middle')
                .attr('fill', '#333')
                .text(d => `${d.value}%`)
                .style('opacity', 0)
                .transition()
                .delay((d, i) => i * 300 + 1000)
                .duration(500)
                .style('opacity', 1);
                
            // Tooltip
            const tooltip = d3.select('body')
                .append('div')
                .attr('class', 'tooltip')
                .style('opacity', 0);
                
            // Add hover areas
            svg.selectAll('.bar-hover')
                .data(data)
                .enter()
                .append('rect')
                .attr('class', 'bar-hover')
                .attr('x', d => x(d.sector))
                .attr('width', x.bandwidth())
                .attr('y', 0)
                .attr('height', height)
                .attr('fill', 'transparent')
                .on('mouseover', function(event, d) {
                    tooltip.transition()
                        .duration(200)
                        .style('opacity', 0.9);
                    tooltip.html(`Sector: ${d.sector}<br>Percentage: ${d.value}%`)
                        .style('left', (event.pageX + 10) + 'px')
                        .style('top', (event.pageY - 28) + 'px');
                    d3.select(this.previousSibling.previousSibling)
                        .transition()
                        .duration(300)
                        .attr('fill', '#6366F1');
                })
                .on('mouseout', function(event, d) {
                    tooltip.transition()
                        .duration(500)
                        .style('opacity', 0);
                    d3.select(this.previousSibling.previousSibling)
                        .transition()
                        .duration(300)
                        .attr('fill', colorScale(d.value));
                });
        }
        
        // Horizontal Bar Chart Function
        function createHorizontalBarChart(container, data, title, xLabel, yLabel) {
            const margin = { top: 50, right: 30, bottom: 60, left: 180 };
            const width = document.querySelector(container).clientWidth - margin.left - margin.right;
            const height = 400 - margin.top - margin.bottom;
            
            const svg = d3.select(container)
                .append('svg')
                .attr('width', width + margin.left + margin.right)
                .attr('height', height + margin.top + margin.bottom)
                .append('g')
                .attr('transform', `translate(${margin.left},${margin.top})`);
                
            // Add title
            svg.append('text')
                .attr('class', 'chart-title')
                .attr('x', width / 2)
                .attr('y', -20)
                .attr('text-anchor', 'middle')
                .text(title);
                
            // Sort data
            data.sort((a, b) => b.value - a.value);
                
            // Y scale
            const y = d3.scaleBand()
                .domain(data.map(d => d.region))
                .range([0, height])
                .padding(0.3);
                
            // X scale
            const x = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.value) * 1.1])
                .range([0, width]);
                
            // Color scale
            const colorScale = d3.scaleLinear()
                .domain([0, d3.max(data, d => d.value)])
                .range(['#4F46E5', '#312E81']);
                
            // Y axis
            svg.append('g')
                .attr('class', 'axis')
                .call(d3.axisLeft(y));
                
            // X axis
            svg.append('g')
                .attr('class', 'axis')
                .attr('transform', `translate(0,${height})`)
                .call(d3.axisBottom(x));
                
            // X label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('x', width / 2)
                .attr('y', height + 40)
                .attr('text-anchor', 'middle')
                .attr('fill', '#666')
                .text(yLabel);
                
            // Add bars with animation
            svg.selectAll('.bar')
                .data(data)
                .enter()
                .append('rect')
                .attr('class', 'data-bar')
                .attr('y', d => y(d.region))
                .attr('height', y.bandwidth())
                .attr('x', 0)
                .attr('width', 0)
                .attr('fill', d => colorScale(d.value))
                .transition()
                .delay((d, i) => i * 200)
                .duration(1000)
                .attr('width', d => x(d.value));
                
            // Add values at end of bars
            svg.selectAll('.bar-label')
                .data(data)
                .enter()
                .append('text')
                .attr('class', 'bar-label')
                .attr('y', d => y(d.region) + y.bandwidth() / 2)
                .attr('x', d => x(d.value) + 10)
                .attr('dominant-baseline', 'middle')
                .attr('fill', '#333')
                .text(d => `${d.value}%`)
                .style('opacity', 0)
                .transition()
                .delay((d, i) => i * 200 + 1000)
                .duration(500)
                .style('opacity', 1);
                
            // Tooltip
            const tooltip = d3.select('body')
                .append('div')
                .attr('class', 'tooltip')
                .style('opacity', 0);
                
            // Add hover areas
            svg.selectAll('.bar-hover')
                .data(data)
                .enter()
                .append('rect')
                .attr('class', 'bar-hover')
                .attr('y', d => y(d.region))
                .attr('height', y.bandwidth())
                .attr('x', 0)
                .attr('width', width)
                .attr('fill', 'transparent')
                .on('mouseover', function(event, d) {
                    tooltip.transition()
                        .duration(200)
                        .style('opacity', 0.9);
                    tooltip.html(`Region: ${d.region}<br>Percentage: ${d.value}%`)
                        .style('left', (event.pageX + 10) + 'px')
                        .style('top', (event.pageY - 28) + 'px');
                    d3.select(this.previousSibling.previousSibling)
                        .transition()
                        .duration(300)
                        .attr('fill', '#6366F1');
                })
                .on('mouseout', function(event, d) {
                    tooltip.transition()
                        .duration(500)
                        .style('opacity', 0);
                    d3.select(this.previousSibling.previousSibling)
                        .transition()
                        .duration(300)
                        .attr('fill', colorScale(d.value));
                });
        }
    </script>
</body>
</html>
