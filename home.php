<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRIMSON CYCLES | Premium Red Bikes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Nunito:wght@300;400;700&display=swap');
        
        :root {
            --red-primary: #e63946;
            --red-dark: #9d0208;
            --off-white: #f8f9fa;
            --dark: #1a1a1a;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--dark);
            color: var(--off-white);
            overflow-x: hidden;
        }
        
        .heading {
            font-family: 'Syncopate', sans-serif;
        }
        
        .bike-image {
            filter: drop-shadow(0 0 30px rgba(230, 57, 70, 0.6));
            transition: all 0.5s ease;
        }
        
        .bike-container:hover .bike-image {
            transform: translateY(-15px);
            filter: drop-shadow(0 0 40px rgba(230, 57, 70, 0.8));
        }
        
        .custom-cursor {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: var(--red-primary);
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: difference;
            transform: translate(-50%, -50%);
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--red-primary);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--dark);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .marquee {
            white-space: nowrap;
            overflow: hidden;
        }
        
        .marquee-content {
            display: inline-block;
            animation: marquee 20s linear infinite;
        }
        
        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        
        .scroll-down {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-15px); }
            60% { transform: translateY(-7px); }
        }
        
        .gallery-item {
            overflow: hidden;
        }
        
        .gallery-image {
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover .gallery-image {
            transform: scale(1.05);
        }
        
        .bike-specs {
            position: relative;
            overflow: hidden;
        }
        
        .spec-item {
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.5s ease;
        }
        
        .bike-specs:hover .spec-item {
            transform: translateY(0);
            opacity: 1;
        }
        
        .spec-item:nth-child(2) {
            transition-delay: 0.1s;
        }
        
        .spec-item:nth-child(3) {
            transition-delay: 0.2s;
        }
        
        .spec-item:nth-child(4) {
            transition-delay: 0.3s;
        }
    </style>
</head>
<body class="relative">
    <!-- Custom cursor -->
    <div class="custom-cursor hidden md:block"></div>
    
    <!-- Loader -->
    <div class="loader">
        <h1 class="heading text-5xl md:text-7xl font-bold text-red-600">CRIMSON<span class="text-white">CYCLES</span></h1>
    </div>
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full p-6 z-50 flex justify-between items-center mix-blend-difference">
        <div class="heading text-2xl font-bold">CRIMSON CYCLES</div>
        <div class="hidden md:flex space-x-8">
            <a href="#" class="nav-link">MODELS</a>
            <a href="#" class="nav-link">TECHNOLOGY</a>
            <a href="#" class="nav-link">GALLERY</a>
            <a href="#" class="nav-link">CONTACT</a>
        </div>
        <div class="md:hidden">
            <div class="w-8 h-0.5 bg-white mb-2"></div>
            <div class="w-8 h-0.5 bg-white mb-2"></div>
            <div class="w-8 h-0.5 bg-white"></div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="min-h-screen flex flex-col justify-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-red-900/30 to-black/50 z-0"></div>
        <div class="container mx-auto px-6 z-10 pt-24">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-12 md:mb-0">
                    <h1 class="heading text-4xl md:text-7xl font-bold mb-6" id="hero-title">
                        EXPERIENCE<br/>
                        <span class="text-red-600">RED</span> POWER
                    </h1>
                    <p class="mb-8 text-lg md:pr-12 opacity-90">
                        Discover the thrill of riding our precision-engineered crimson machines. 
                        Where design meets performance in perfect harmony.
                    </p>
                    <div class="flex space-x-4">
                        <button class="px-8 py-3 bg-red-600 hover:bg-red-700 transition-colors heading text-white">
                            EXPLORE MODELS
                        </button>
                        <button class="px-8 py-3 border border-white hover:border-red-600 hover:text-red-600 transition-colors heading">
                            BOOK TEST RIDE
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center bike-container">
                    <svg width="500" height="300" viewBox="0 0 500 300" class="bike-image">
                        <path d="M113,106 L141,106 L141,100 C141,97.790861 142.790861,96 145,96 L167,96 C169.209139,96 171,97.790861 171,100 L171,106 L179,106" stroke="#E63946" stroke-width="4" fill="none"/>
                        <path d="M179,106 L203,106 C205.209139,106 207,107.790861 207,110 L207,125 C207,127.209139 205.209139,129 203,129 L143,129 C140.790861,129 139,127.209139 139,125 L139,110 C139,107.790861 140.790861,106 143,106 L151,106" stroke="#E63946" stroke-width="4" fill="none"/>
                        <circle cx="125" cy="175" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                        <circle cx="125" cy="175" r="35" stroke="#E63946" stroke-width="1" fill="none"/>
                        <circle cx="125" cy="175" r="5" fill="#E63946"/>
                        <circle cx="325" cy="175" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                        <circle cx="325" cy="175" r="35" stroke="#E63946" stroke-width="1" fill="none"/>
                        <circle cx="325" cy="175" r="5" fill="#E63946"/>
                        <line x1="125" y1="175" x2="170" y2="110" stroke="#E63946" stroke-width="4"/>
                        <line x1="170" y1="110" x2="255" y2="110" stroke="#E63946" stroke-width="4"/>
                        <line x1="255" y1="110" x2="325" y2="175" stroke="#E63946" stroke-width="4"/>
                        <line x1="255" y1="110" x2="225" y2="175" stroke="#E63946" stroke-width="4"/>
                        <line x1="225" y1="175" x2="125" y2="175" stroke="#E63946" stroke-width="4"/>
                        <line x1="170" y1="150" x2="170" y2="110" stroke="#E63946" stroke-width="4"/>
                        <circle cx="170" cy="150" r="10" fill="#E63946"/>
                        <path d="M165,95 L175,95 L175,115 L165,115 Z" fill="#E63946"/>
                        <path d="M195,140 L215,140 L215,160 L195,160 Z" fill="#E63946" transform="rotate(-45 205 150)"/>
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2">
                <div class="scroll-down text-center">
                    <p class="mb-2 opacity-75">Scroll Down</p>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19M12 19L19 12M12 19L5 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Marquee Section -->
    <div class="py-8 bg-red-600 overflow-hidden">
        <div class="marquee">
            <div class="marquee-content heading text-2xl font-bold tracking-wider">
                SPEED • PERFORMANCE • DESIGN • ENGINEERING • PRECISION • CRAFTSMANSHIP • INNOVATION • SPEED • PERFORMANCE • DESIGN • ENGINEERING • PRECISION • CRAFTSMANSHIP • INNOVATION • 
            </div>
        </div>
    </div>
    
    <!-- Featured Bike -->
    <section class="py-24 relative">
        <div class="container mx-auto px-6">
            <div class="mb-16 text-center">
                <h2 class="heading text-3xl md:text-5xl font-bold mb-4" id="featured-title">THE CRIMSON STREAK</h2>
                <p class="max-w-2xl mx-auto opacity-75">Our flagship model combines cutting-edge aerodynamics with race-proven performance.</p>
            </div>
            
            <div class="flex flex-col md:flex-row items-center" id="featured-bike">
                <div class="md:w-3/5 mb-12 md:mb-0 bike-container">
                    <svg width="600" height="350" viewBox="0 0 600 350" class="bike-image">
                        <path d="M133,126 L181,126 L181,115 C181,112.790861 182.790861,111 185,111 L217,111 C219.209139,111 221,112.790861 221,115 L221,126 L229,126" stroke="#E63946" stroke-width="6" fill="none"/>
                        <path d="M229,126 L263,126 C265.209139,126 267,127.790861 267,130 L267,150 C267,152.209139 265.209139,154 263,154 L183,154 C180.790861,154 179,152.209139 179,150 L179,130 C179,127.790861 180.790861,126 183,126 L191,126" stroke="#E63946" stroke-width="6" fill="none"/>
                        <circle cx="145" cy="205" r="50" stroke="#E63946" stroke-width="6" fill="none"/>
                        <circle cx="145" cy="205" r="44" stroke="#E63946" stroke-width="2" fill="none"/>
                        <circle cx="145" cy="205" r="6" fill="#E63946"/>
                        <circle cx="415" cy="205" r="50" stroke="#E63946" stroke-width="6" fill="none"/>
                        <circle cx="415" cy="205" r="44" stroke="#E63946" stroke-width="2" fill="none"/>
                        <circle cx="415" cy="205" r="6" fill="#E63946"/>
                        <line x1="145" y1="205" x2="215" y2="130" stroke="#E63946" stroke-width="6"/>
                        <line x1="215" y1="130" x2="330" y2="130" stroke="#E63946" stroke-width="6"/>
                        <line x1="330" y1="130" x2="415" y2="205" stroke="#E63946" stroke-width="6"/>
                        <line x1="330" y1="130" x2="275" y2="205" stroke="#E63946" stroke-width="6"/>
                        <line x1="275" y1="205" x2="145" y2="205" stroke="#E63946" stroke-width="6"/>
                        <line x1="215" y1="180" x2="215" y2="130" stroke="#E63946" stroke-width="6"/>
                        <circle cx="215" cy="180" r="12" fill="#E63946"/>
                        <path d="M210,110 L220,110 L220,135 L210,135 Z" fill="#E63946"/>
                        <path d="M235,165 L265,165 L265,185 L235,185 Z" fill="#E63946" transform="rotate(-45 250 175)"/>
                        
                        <!-- Spokes for front wheel -->
                        <line x1="145" y1="205" x2="145" y2="155" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="145" y2="255" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="95" y2="205" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="195" y2="205" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="110" y2="170" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="180" y2="170" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="110" y2="240" stroke="#E63946" stroke-width="1"/>
                        <line x1="145" y1="205" x2="180" y2="240" stroke="#E63946" stroke-width="1"/>
                        
                        <!-- Spokes for rear wheel -->
                        <line x1="415" y1="205" x2="415" y2="155" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="415" y2="255" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="365" y2="205" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="465" y2="205" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="380" y2="170" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="450" y2="170" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="380" y2="240" stroke="#E63946" stroke-width="1"/>
                        <line x1="415" y1="205" x2="450" y2="240" stroke="#E63946" stroke-width="1"/>
                    </svg>
                </div>
                <div class="md:w-2/5">
                    <div class="bike-specs p-8 bg-black/30 backdrop-blur-sm rounded-xl">
                        <h3 class="heading text-2xl font-bold mb-6 text-red-600">TECHNICAL SPECIFICATIONS</h3>
                        <div class="space-y-6">
                            <div class="spec-item">
                                <h4 class="text-lg font-semibold opacity-75">FRAME</h4>
                                <p>Full Carbon Monocoque | Aerodynamic Design</p>
                            </div>
                            <div class="spec-item">
                                <h4 class="text-lg font-semibold opacity-75">WEIGHT</h4>
                                <p>6.8kg (UCI legal minimum)</p>
                            </div>
                            <div class="spec-item">
                                <h4 class="text-lg font-semibold opacity-75">GROUPSET</h4>
                                <p>Shimano Dura-Ace Di2 | Electronic Shifting</p>
                            </div>
                            <div class="spec-item">
                                <h4 class="text-lg font-semibold opacity-75">WHEELS</h4>
                                <p>Carbon Deep-Section | Tubeless-Ready</p>
                            </div>
                        </div>
                        <div class="mt-8">
                            <button class="w-full py-3 bg-red-600 hover:bg-red-700 transition-colors heading text-white rounded">
                                DISCOVER MORE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Gallery Section -->
    <section class="py-24 bg-black">
        <div class="container mx-auto px-6">
            <h2 class="heading text-3xl md:text-5xl font-bold mb-16 text-center" id="gallery-title">GALLERY</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                        <svg width="200" height="120" viewBox="0 0 400 240" class="gallery-image">
                            <path d="M93,86 L121,86 L121,80 C121,77.790861 122.790861,76 125,76 L147,76 C149.209139,76 151,77.790861 151,80 L151,86 L159,86" stroke="#E63946" stroke-width="4" fill="none"/>
                            <path d="M159,86 L183,86 C185.209139,86 187,87.790861 187,90 L187,105 C187,107.209139 185.209139,109 183,109 L123,109 C120.790861,109 119,107.209139 119,105 L119,90 C119,87.790861 120.790861,86 123,86 L131,86" stroke="#E63946" stroke-width="4" fill="none"/>
                            <circle cx="105" cy="155" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                            <circle cx="305" cy="155" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                            <line x1="105" y1="155" x2="155" y2="90" stroke="#E63946" stroke-width="4"/>
                            <line x1="155" y1="90" x2="235" y2="90" stroke="#E63946" stroke-width="4"/>
                            <line x1="235" y1="90" x2="305" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="235" y1="90" x2="205" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="205" y1="155" x2="105" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="155" y1="130" x2="155" y2="90" stroke="#E63946" stroke-width="4"/>
                            <circle cx="155" cy="130" r="10" fill="#E63946"/>
                        </svg>
                    </div>
                </div>
                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                        <svg width="200" height="120" viewBox="0 0 400 240" class="gallery-image">
                            <circle cx="105" cy="155" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                            <circle cx="305" cy="155" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                            <path d="M80,100 C120,80 180,70 230,80 C280,90 320,130 330,150" stroke="#E63946" stroke-width="4" fill="none"/>
                            <line x1="105" y1="155" x2="155" y2="90" stroke="#E63946" stroke-width="4"/>
                            <line x1="155" y1="90" x2="235" y2="90" stroke="#E63946" stroke-width="4"/>
                            <line x1="235" y1="90" x2="305" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="235" y1="90" x2="205" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="205" y1="155" x2="105" y2="155" stroke="#E63946" stroke-width="4"/>
                        </svg>
                    </div>
                </div>
                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                        <svg width="200" height="120" viewBox="0 0 400 240" class="gallery-image" transform="rotate(15)">
                            <path d="M93,86 L121,86 L121,80 C121,77.790861 122.790861,76 125,76 L147,76 C149.209139,76 151,77.790861 151,80 L151,86 L159,86" stroke="#E63946" stroke-width="4" fill="none"/>
                            <path d="M159,86 L183,86 C185.209139,86 187,87.790861 187,90 L187,105 C187,107.209139 185.209139,109 183,109 L123,109 C120.790861,109 119,107.209139 119,105 L119,90 C119,87.790861 120.790861,86 123,86 L131,86" stroke="#E63946" stroke-width="4" fill="none"/>
                            <circle cx="105" cy="155" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                            <circle cx="305" cy="155" r="40" stroke="#E63946" stroke-width="4" fill="none"/>
                            <line x1="105" y1="155" x2="155" y2="90" stroke="#E63946" stroke-width="4"/>
                            <line x1="155" y1="90" x2="235" y2="90" stroke="#E63946" stroke-width="4"/>
                            <line x1="235" y1="90" x2="305" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="235" y1="90" x2="205" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="205" y1="155" x2="105" y2="155" stroke="#E63946" stroke-width="4"/>
                            <line x1="155" y1="130" x2="155" y2="90" stroke="#E63946" stroke-width="4"/>
                            <circle cx="155" cy="130" r="10" fill="#E63946"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section class="py-24 relative">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-t from-red-900/30 to-black/50 z-0"></div>
        <div class="container mx-auto px-6 z-10 relative">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="heading text-3xl md:text-5xl font-bold mb-6" id="contact-title">EXPERIENCE THE RIDE</h2>
                <p class="opacity-75">Ready to feel the power? Schedule a test ride or inquire about our premium red bikes.</p>
            </div>
            
            <form class="max-w-xl mx-auto bg-black/30 backdrop-blur-sm p-8 rounded-xl">
                <div class="mb-6">
                    <label class="block mb-2 heading">NAME</label>
                    <input type="text" class="w-full bg-white/10 border border-white/20 rounded p-3 text-white focus:border-red-600 focus:outline-none transition-colors">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 heading">EMAIL</label>
                    <input type="email" class="w-full bg-white/10 border border-white/20 rounded p-3 text-white focus:border-red-600 focus:outline-none transition-colors">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 heading">MESSAGE</label>
                    <textarea rows="4" class="w-full bg-white/10 border border-white/20 rounded p-3 text-white focus:border-red-600 focus:outline-none transition-colors"></textarea>
                </div>
                <button class="w-full py-3 bg-red-600 hover:bg-red-700 transition-colors heading text-white rounded">
                    SEND MESSAGE
                </button>
            </form>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-black py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div class="heading text-2xl font-bold mb-6 md:mb-0">CRIMSON CYCLES</div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-red-600 transition-colors">Instagram</a>
                    <a href="#" class="hover:text-red-600 transition-colors">Facebook</a>
                    <a href="#" class="hover:text-red-600 transition-colors">Twitter</a>
                    <a href="#" class="hover:text-red-600 transition-colors">YouTube</a>
                </div>
            </div>
            <div class="border-t border-white/10 pt-6 text-center text-sm opacity-50">
                © 2025 Crimson Cycles. All rights reserved.
            </div>
        </div>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize GSAP
            gsap.registerPlugin(ScrollTrigger);
            
            // Custom cursor
            const cursor = document.querySelector('.custom-cursor');
            
            document.addEventListener('mousemove', (e) => {
                gsap.to(cursor, {
                    x: e.clientX,
                    y: e.clientY,
                    duration: 0.3
                });
            });
            
            // Loader animation
            const loader = document.querySelector('.loader');
            gsap.to(loader, {
                opacity: 0,
                duration: 1,
                delay: 1.5,
                onComplete: () => {
                    loader.style.display = 'none';
                }
            });
            
            // Hero animations
            gsap.from('#hero-title', {
                y: 50,
                opacity: 0,
                duration: 1,
                delay: 2,
                ease: 'power3.out'
            });
            
            // Featured bike section animations
            gsap.from('#featured-title', {
                scrollTrigger: {
                    trigger: '#featured-title',
                    start: 'top 80%',
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
            
            gsap.from('#featured-bike', {
                scrollTrigger: {
                    trigger: '#featured-bike',
                    start: 'top 70%',
                },
                x: -100,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
            
            // Gallery animations
            gsap.from('#gallery-title', {
                scrollTrigger: {
                    trigger: '#gallery-title',
                    start: 'top 80%',
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
            
            gsap.from('.gallery-item', {
                scrollTrigger: {
                    trigger: '.gallery-item',
                    start: 'top 70%',
                },
                y: 100,
                opacity: 0,
                duration: 1,
                stagger: 0.2,
                ease: 'power3.out'
            });
            
            // Contact section animations
            gsap.from('#contact-title', {
                scrollTrigger: {
                    trigger: '#contact-title',
                    start: 'top 80%',
                },
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
            
            // Bike animation on scroll
            gsap.to('.bike-image', {
                scrollTrigger: {
                    trigger: '.bike-image',
                    start: 'top 70%',
                    end: 'bottom 30%',
                    scrub: true
                },
                rotation: 10,
                ease: 'none'
            });
        });
    </script>
</body>
</html>
