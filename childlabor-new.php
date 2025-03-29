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
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #0f0f0f;
            color: #f1f1f1;
            overflow-x: hidden;
        }
        
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0f0f0f;
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
        }
        
        .loader-progress {
            position: absolute;
            bottom: 30%;
            width: 30%;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }
        
        .loader-progress-fill {
            height: 100%;
            width: 0;
            background: #f1f1f1;
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
            height: 1px;
            background: #f1f1f1;
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
            background: rgba(255, 255, 255, 0.2);
            pointer-events: none;
            z-index: 9998;
            mix-blend-mode: difference;
            transform: translate(-50%, -50%);
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
        
        .data-point {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #f1f1f1;
            transform: scale(0);
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
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
        }
        
        .scroll-circle {
            width: 5px;
            height: 5px;
            background: #f1f1f1;
            border-radius: 50%;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .loader-progress {
                width: 70%;
            }
            
            .hidden-mobile {
                display: none;
            }
            
            .scroll-indicator {
                bottom: 20px;
                right: 20px;
            }
        }

        /* D3 chart styles */
        .axis path,
        .axis line {
            stroke: rgba(255, 255, 255, 0.2);
        }
        
        .axis text {
            fill: rgba(255, 255, 255, 0.7);
            font-size: 10px;
        }
        
        .chart-title {
            font-size: 18px;
            font-weight: 300;
            fill: rgba(255, 255, 255, 0.8);
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
            background: rgba(25, 25, 25, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            pointer-events: none;
            color: #f1f1f1;
            font-size: 12px;
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
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 px-6 md:px-12 py-8 flex justify-between items-center bg-gradient-to-b from-black/80 to-transparent backdrop-blur-sm">
        <div class="text-xl font-medium tracking-wide">CHILD<span class="text-indigo-500">.DATA</span></div>
        <div class="hidden md:flex space-x-8">
            <a href="#overview" class="nav-link">Overview</a>
            <a href="#trends" class="nav-link">Trends</a>
            <a href="#sectors" class="nav-link">Sectors</a>
            <a href="#regions" class="nav-link">Regions</a>
            <a href="#solutions" class="nav-link">Solutions</a>
        </div>
        <div class="md:hidden">
            <button class="text-2xl">≡</button>
        </div>
    </nav>
    
    <!-- Hero section -->
    <section class="h-screen flex flex-col justify-center px-6 md:px-12 relative overflow-hidden">
        <h1 class="text-4xl md:text-7xl font-bold mb-6 leading-tight reveal-text">Child Labor:<br><span class="text-indigo-500">A Data Analytics Perspective</span></h1>
        <p class="text-gray-300 max-w-xl text-lg md:text-xl reveal-text">Examining the global crisis through data insights from 2020-2022. Uncovering patterns, trends, and potential solutions.</p>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
    </section>
    
    <!-- Overview section -->
    <section id="overview" class="min-h-screen px-6 md:px-12 py-24 data-section">
        <h2 class="text-3xl md:text-5xl font-bold mb-12 reveal-text">The Global Landscape</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <p class="text-gray-300 text-lg leading-relaxed mb-8 reveal-text">Child labor remains a persistent global challenge, with approximately 160 million children engaged in child labor as of 2021. This represents nearly 1 in 10 children worldwide, with almost half involved in hazardous work that directly threatens their health and development.</p>
                <p class="text-gray-300 text-lg leading-relaxed reveal-text">The data reveals concerning trends following the COVID-19 pandemic, with progress against child labor stalling and, in many regions, reversing for the first time in two decades.</p>
            </div>
            <div class="chart-container" id="overview-chart">
                <!-- D3 chart will be rendered here -->
            </div>
        </div>
    </section>
    
    <!-- Trends section -->
    <section id="trends" class="min-h-screen px-6 md:px-12 py-24 data-section bg-black/50">
        <h2 class="text-3xl md:text-5xl font-bold mb-12 reveal-text">Key Trends (2020-2022)</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">COVID-19 Impact</h3>
                <p class="text-gray-300">The pandemic reversed years of progress, pushing an additional 8.4 million children into labor by the end of 2022, primarily due to school closures and economic pressures on vulnerable households.</p>
            </div>
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">Age Distribution</h3>
                <p class="text-gray-300">The data shows a concerning increase in child labor among children aged 5-11, highlighting the need for targeted early intervention programs and educational support.</p>
            </div>
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">Gender Patterns</h3>
                <p class="text-gray-300">Boys remain more likely to be engaged in child labor globally (11.2% vs. 7.8% for girls), though girls' participation in domestic work is often underreported in official statistics.</p>
            </div>
        </div>
        <div class="mt-16 chart-container" id="trends-chart">
            <!-- D3 chart will be rendered here -->
        </div>
    </section>
    
    <!-- Sectors section -->
    <section id="sectors" class="min-h-screen px-6 md:px-12 py-24 data-section relative">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
        <h2 class="text-3xl md:text-5xl font-bold mb-12 reveal-text">Sectors with Highest Prevalence</h2>
        <div class="chart-container mb-12" id="sectors-chart">
            <!-- D3 chart will be rendered here -->
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-medium mb-4 reveal-text">Agricultural Sector</h3>
                <p class="text-gray-300 reveal-text">Accounting for 70% of child labor globally, agriculture remains the largest employing sector. Children often work in hazardous conditions with exposure to pesticides, dangerous equipment, and extreme weather.</p>
            </div>
            <div>
                <h3 class="text-2xl font-medium mb-4 reveal-text">Mining & Raw Materials</h3>
                <p class="text-gray-300 reveal-text">Despite representing a smaller percentage of total child labor, this sector poses extreme risks. Children working in artisanal mining face severe physical harm and toxic exposure, with data showing limited progress in reducing prevalence.</p>
            </div>
        </div>
    </section>
    
    <!-- Regional section -->
    <section id="regions" class="min-h-screen px-6 md:px-12 py-24 data-section bg-black/50">
        <h2 class="text-3xl md:text-5xl font-bold mb-12 reveal-text">Regional Distribution</h2>
        <div class="chart-container mb-12" id="regions-chart">
            <!-- D3 chart will be rendered here -->
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-medium mb-4 reveal-text">Sub-Saharan Africa</h3>
                <p class="text-gray-300 reveal-text">With 23.9% of children engaged in labor, this region has both the highest percentage and absolute number of working children. Data from 2020-2022 shows limited improvement, with economic shocks reversing previous gains.</p>
            </div>
            <div>
                <h3 class="text-2xl font-medium mb-4 reveal-text">South Asia</h3>
                <p class="text-gray-300 reveal-text">While showing some improvement, South Asia still accounts for a significant portion of global child labor. The data reveals particular challenges in informal sectors and family-based work arrangements.</p>
            </div>
        </div>
    </section>
    
    <!-- Solutions section -->
    <section id="solutions" class="min-h-screen px-6 md:px-12 py-24 data-section relative">
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
        <h2 class="text-3xl md:text-5xl font-bold mb-12 reveal-text">Data-Driven Solutions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">Education Accessibility</h3>
                <p class="text-gray-300">Analysis shows that regions with increased educational investment saw a 15-20% reduction in child labor rates. Data supports focusing on transitional years (ages 10-14) when dropout risk increases.</p>
            </div>
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">Social Protection Systems</h3>
                <p class="text-gray-300">Cash transfer programs with education conditions demonstrate the strongest statistical correlation with reduced child labor, showing an average 30% reduction in participating communities.</p>
            </div>
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">Supply Chain Monitoring</h3>
                <p class="text-gray-300">Advanced data analytics and blockchain technologies have helped identify high-risk supply chain nodes with 73% accuracy, enabling targeted interventions and enforcement.</p>
            </div>
            <div class="p-6 border border-white/10 rounded-lg reveal-text">
                <h3 class="text-2xl font-medium mb-4">Predictive Modeling</h3>
                <p class="text-gray-300">Machine learning algorithms analyzing economic, social, and environmental factors can now predict child labor risk with up to 82% accuracy, allowing for proactive prevention strategies.</p>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="px-6 md:px-12 py-16 bg-black border-t border-white/10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <div class="text-xl font-medium tracking-wide mb-6">CHILD<span class="text-indigo-500">.DATA</span></div>
                <p class="text-gray-400">A data analytics perspective on global child labor trends and solutions from 2020-2022.</p>
            </div>
            <div>
                <h4 class="text-sm uppercase tracking-wider text-gray-400 mb-6">Navigation</h4>
                <div class="flex flex-col space-y-3">
                    <a href="#overview" class="text-gray-300 hover:text-white transition">Overview</a>
                    <a href="#trends" class="text-gray-300 hover:text-white transition">Trends</a>
                    <a href="#sectors" class="text-gray-300 hover:text-white transition">Sectors</a>
                    <a href="#regions" class="text-gray-300 hover:text-white transition">Regions</a>
                    <a href="#solutions" class="text-gray-300 hover:text-white transition">Solutions</a>
                </div>
            </div>
            <div>
                <h4 class="text-sm uppercase tracking-wider text-gray-400 mb-6">Sources</h4>
                <div class="flex flex-col space-y-3">
                    <a href="#" class="text-gray-300 hover:text-white transition">ILO Reports</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">UNICEF Data</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">World Bank Statistics</a>
                    <a href="#" class="text-gray-300 hover:text-white transition">Research Methodology</a>
                </div>
            </div>
        </div>
        <div class="text-gray-400 text-sm pt-8 border-t border-white/10">
            © 2025 Child Labor Data Analytics Project. All data visualizations based on research from 2020-2022.
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
                }
            });
        });
        
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
                    document.querySelector('nav').classList.add('bg-black/80');
                    document.querySelector('nav').classList.remove('bg-gradient-to-b');
                } else {
                    document.querySelector('nav').classList.remove('bg-black/80');
                    document.querySelector('nav').classList.add('bg-gradient-to-b');
                }
            });
        }
        
        // D3 Charts
        function initCharts() {
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
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
                .text(xLabel);
                
            // Y label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('transform', 'rotate(-90)')
                .attr('x', -height / 2)
                .attr('y', -40)
                .attr('text-anchor', 'middle')
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
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
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
                .text(xLabel);
                
            // Y label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('transform', 'rotate(-90)')
                .attr('x', -height / 2)
                .attr('y', -40)
                .attr('text-anchor', 'middle')
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
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
                    .attr('fill', 'rgba(255, 255, 255, 0.7)')
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
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
                .text(xLabel);
                
            // Y label
            svg.append('text')
                .attr('class', 'axis-label')
                .attr('transform', 'rotate(-90)')
                .attr('x', -height / 2)
                .attr('y', -40)
                .attr('text-anchor', 'middle')
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
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
                .attr('fill', 'rgba(255, 255, 255, 0.9)')
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
                .attr('fill', 'rgba(255, 255, 255, 0.7)')
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
                .attr('fill', 'rgba(255, 255, 255, 0.9)')
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
