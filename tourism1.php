<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Insights PH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;600&display=swap">
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #e2e8f0;
            --accent: #3b82f6;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--primary);
            color: white;
            overflow-x: hidden;
        }
        
        .playfair {
            font-family: 'Playfair Display', serif;
        }
        
        .hero-text {
            line-height: 1.2;
            letter-spacing: -1px;
        }
        
        .cursor {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: var(--accent);
            position: fixed;
            pointer-events: none;
            mix-blend-mode: difference;
            z-index: 999;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out;
        }
        
        .cursor-follower {
            width: 40px;
            height: 40px;
            border: 1px solid rgba(255, 255, 255, 0.3);
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
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background-color: white;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .card {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        }
        
        .search-container {
            overflow: hidden;
        }
        
        .search-input {
            width: 0;
            transition: width 0.3s ease;
            background: transparent;
            border: none;
            color: white;
            outline: none;
        }
        
        .search-container:hover .search-input,
        .search-input:focus {
            width: 150px;
            border-bottom: 1px solid white;
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
                background-color: var(--primary);
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
                font-size: 1.5rem;
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
<body class="text-gray-50">
    <div class="cursor"></div>
    <div class="cursor-follower"></div>
    
    <!-- Navbar -->
    <nav class="fixed w-full p-6 z-50 mix-blend-difference">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold playfair tracking-wider">Tourism<span class="text-blue-400">Insights</span>PH</a>
            
            <div class="menu-toggle cursor-pointer">
                <div class="w-6 h-0.5 bg-white mb-1.5"></div>
                <div class="w-6 h-0.5 bg-white mb-1.5"></div>
                <div class="w-6 h-0.5 bg-white"></div>
            </div>
            
            <div class="nav-links flex items-center">
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Home</a>
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Destinations</a>
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Occupancy Rates</a>
                <a href="#" class="nav-link text-sm uppercase font-medium tracking-wider">Arrivals</a>
                
                <div class="search-container ml-4 flex items-center">
                    <input type="text" class="search-input text-sm mr-2" placeholder="Search...">
                    <i class="fas fa-search text-sm"></i>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="h-screen flex items-center relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
            <div class="bg-[url('/images/bg3.jpg')] bg-cover bg-center h-full"></div>
        </div>
        
        <div class="container mx-auto px-6 z-10">
            <div class="max-w-3xl">
                <h5 class="text-blue-400 text-sm tracking-widest uppercase font-medium mb-4 fade-in">Discover the Philippines</h5>
                <h1 class="hero-text text-6xl md:text-8xl font-bold playfair mb-6 split-text">Explore <br>Paradise Islands</h1>
                <p class="text-lg text-gray-300 max-w-lg mb-10 fade-in">Uncover trends, insights, and statistics about the flourishing tourism industry in the Philippines.</p>
                <a href="#" class="inline-block bg-blue-500 text-white py-3 px-8 rounded-sm font-medium hover:bg-blue-600 transition fade-in">Explore Data</a>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 fade-in">
            <div class="float flex flex-col items-center">
                <span class="text-sm mb-2">Scroll down</span>
                <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>
    
    <!-- Featured Destinations -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <h5 class="text-blue-400 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Amazing Places</h5>
                    <h2 class="text-4xl md:text-5xl font-bold playfair fade-in">Featured Destinations</h2>
                </div>
                <a href="#" class="text-sm text-blue-400 font-medium mt-4 md:mt-0 fade-in">
                    View All Destinations 
                    <span class="ml-2">→</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Destination Card 1 -->
                <div class="card bg-gray-800 rounded-lg overflow-hidden fade-in">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1569201529241-f96205e2f2c6')] bg-cover bg-center parallax" data-speed="0.1"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold playfair mb-2">Boracay Island</h3>
                        <p class="text-gray-400 text-sm mb-4">White Beach, Aklan</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="text-sm text-gray-400 ml-1">(4.8)</span>
                            </div>
                            <span class="text-blue-400 text-sm font-medium">View details →</span>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Card 2 -->
                <div class="card bg-gray-800 rounded-lg overflow-hidden fade-in" data-delay="0.2">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1570789210967-2cac24afeb00')] bg-cover bg-center parallax" data-speed="0.15"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold playfair mb-2">El Nido</h3>
                        <p class="text-gray-400 text-sm mb-4">Palawan</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="text-sm text-gray-400 ml-1">(4.7)</span>
                            </div>
                            <span class="text-blue-400 text-sm font-medium">View details →</span>
                        </div>
                    </div>
                </div>
                
                <!-- Destination Card 3 -->
                <div class="card bg-gray-800 rounded-lg overflow-hidden fade-in" data-delay="0.4">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1656520223886-bfd2da763d73')] bg-cover bg-center parallax" data-speed="0.2"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold playfair mb-2">Chocolate Hills</h3>
                        <p class="text-gray-400 text-sm mb-4">Bohol</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-yellow-400">★★★★☆</span>
                                <span class="text-sm text-gray-400 ml-1">(4.6)</span>
                            </div>
                            <span class="text-blue-400 text-sm font-medium">View details →</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Statistics Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-indigo-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h5 class="text-blue-400 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Our Data</h5>
                <h2 class="text-4xl md:text-5xl font-bold playfair fade-in">Tourism Statistics</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-lg text-center fade-in">
                    <div class="text-5xl font-bold playfair text-white mb-4 counter">8.26M</div>
                    <h3 class="text-xl font-medium text-gray-200 mb-2">Visitor Arrivals</h3>
                    <p class="text-gray-400 text-sm">International tourists visiting the Philippines annually</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-lg text-center fade-in" data-delay="0.2">
                    <div class="text-5xl font-bold playfair text-white mb-4 counter">72%</div>
                    <h3 class="text-xl font-medium text-gray-200 mb-2">Average Occupancy Rate</h3>
                    <p class="text-gray-400 text-sm">Hotel and accommodation occupancy across major destinations</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-lg text-center fade-in" data-delay="0.4">
                    <div class="text-5xl font-bold playfair text-white mb-4 counter">$9.3B</div>
                    <h3 class="text-xl font-medium text-gray-200 mb-2">Tourism Revenue</h3>
                    <p class="text-gray-400 text-sm">Annual contribution of tourism to the Philippine economy</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Insights Section -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <h5 class="text-blue-400 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Analysis</h5>
                    <h2 class="text-4xl md:text-5xl font-bold playfair fade-in">Latest Insights</h2>
                </div>
                <a href="#" class="text-sm text-blue-400 font-medium mt-4 md:mt-0 fade-in">
                    View All Insights
                    <span class="ml-2">→</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-800 rounded-lg overflow-hidden fade-in">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1533105079780-92b9be482077')] bg-cover bg-center parallax" data-speed="0.1"></div>
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-blue-400 font-medium">March 23, 2025</span>
                        <h3 class="text-2xl font-bold playfair my-3">Tourism Recovery Exceeds Pre-Pandemic Levels</h3>
                        <p class="text-gray-400 text-sm mb-4">Philippine tourism has made a remarkable recovery, with visitor arrivals now surpassing pre-pandemic levels in key destinations.</p>
                        <a href="#" class="text-blue-400 text-sm font-medium">Read More →</a>
                    </div>
                </div>
                
                <div class="bg-gray-800 rounded-lg overflow-hidden fade-in" data-delay="0.2">
                    <div class="h-64 overflow-hidden">
                        <div class="h-full w-full bg-[url('https://images.unsplash.com/photo-1566559532512-004a6df74db5')] bg-cover bg-center parallax" data-speed="0.15"></div>
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-blue-400 font-medium">March 15, 2025</span>
                        <h3 class="text-2xl font-bold playfair my-3">Sustainable Tourism Initiatives Drive Growth</h3>
                        <p class="text-gray-400 text-sm mb-4">New eco-friendly practices and sustainable tourism policies have contributed to increasing visitor satisfaction and longer stays.</p>
                        <a href="#" class="text-blue-400 text-sm font-medium">Read More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Newsletter Section -->
    <section class="py-20 bg-black">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h5 class="text-blue-400 text-sm tracking-widest uppercase font-medium mb-2 fade-in">Stay Updated</h5>
                <h2 class="text-4xl md:text-5xl font-bold playfair mb-6 fade-in">Subscribe to Our Newsletter</h2>
                <p class="text-gray-400 mb-8 fade-in">Get the latest tourism data, insights, and trends delivered directly to your inbox.</p>
                
                <form class="flex flex-col md:flex-row gap-4 fade-in">
                    <input type="email" placeholder="Enter your email" class="flex-grow bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-sm focus:outline-none focus:border-blue-500 transition">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-sm font-medium hover:bg-blue-600 transition">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="py-12 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-bold playfair mb-4">Tourism<span class="text-blue-400">Insights</span>PH</h3>
                    <p class="text-gray-400 text-sm">Providing comprehensive data and insights on the Philippine tourism industry.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Explore</h4>
                    <ul class="text-gray-400 text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#" class="hover:text-white transition">Destinations</a></li>
                        <li><a href="#" class="hover:text-white transition">Occupancy Rates</a></li>
                        <li><a href="#" class="hover:text-white transition">Arrivals</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Resources</h4>
                    <ul class="text-gray-400 text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Reports</a></li>
                        <li><a href="#" class="hover:text-white transition">Statistics</a></li>
                        <li><a href="#" class="hover:text-white transition">Infographics</a></li>
                        <li><a href="#" class="hover:text-white transition">Case Studies</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Connect</h4>
                    <ul class="text-gray-400 text-sm space-y-2">
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">About</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">© 2025 Tourism Insights PH. All rights reserved.</p>
                
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
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
        
        const links = document.querySelectorAll('a, button, .card, input');
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
