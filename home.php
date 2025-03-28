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
            text-align: center;
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

<img src="images/MTBSport.webp" class="bike-image" srcset=""  alt="Red Mountain Bike">

                
                </div>
            </div>
            <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 flex flex-col items-center">
                <div class="scroll-down text-center">
                    <p class="mb-2 opacity-75 text-white">Scroll Down</p>
                    <svg width="86" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5V19M12 19L19 12M12 19L5 12"
                        stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
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
                   
<img src="images/MTBSport.webp" class="bike-image" srcset=""  alt="Red Mountain Bike">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                       
<img src="images/58-1.webp" class="bike-image" srcset=""  alt="Red Mountain Bike">
                    </div>
                </div>
                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                       
<img src="images/59-1.webp" class="bike-image" srcset=""  alt="Red Mountain Bike">
                    </div>
                </div>
                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                        
<img src="images/60-2.webp" class="bike-image" srcset=""  alt="Red Mountain Bike">
                    </div>
                </div>

                <div class="gallery-item rounded-lg overflow-hidden h-80 bg-red-900/20">
                    <div class="w-full h-full flex items-center justify-center">
                       
<img src="images/62-1.webp" class="bike-image" srcset=""  alt="Red Mountain Bike">
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
