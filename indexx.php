<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goodland - Finding Local Solutions to Global Problems</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-900 overflow-x-hidden">

    <!-- Top Header Bar -->
    <div id="top-header" class="bg-gray-900 text-white text-SM py-2 fixed w-full z-50 top-0 transition-transform duration-300">
        <div class="max-w-[85rem] mx-auto flex justify-between px-0">
            <span>Email: goodland.philippines@gmail.com </span>
            <span>Contact: +123 456 7890</span>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav id="navbar" class="fixed w-full z-50 top-8 transition-all duration-300 bg-white/90 backdrop-blur-md shadow-lg border-b border-gray-200">
        <div class="max-w-[90rem] mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <img class="h-52 w-auto" src="img/GOODLand__1_-removebg-preview.png" alt="Goodland Logo">

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-5">
                    <a href="#hero" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">HOME</a>
                    <a href="#about" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">About Us</a>
                    <a href="#methodology" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">Methodology</a>
                    <a href="#projects" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">Projects</a>
                    <a href="#gallery" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">Stories</a>
                    <a href="#team" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">E-Sawod</a>
                    <a href="#events" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">Events</a>
                    <a href="#gallery" class="text-gray-700 hover:text-[#0097b2] px-3 py-2 text-md uppercase font-medium">Archives</a>
                    <a href="#contact" class="bg-[#0097b2] hover:bg-[#007a8e] text-white px-5 py-2 text-MD font-medium uppercase rounded shadow-md">Contact Us</a>
                </div>
                <!-- Mobile Menu Button -->
                <button id="menu-button" class="md:hidden p-3 text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

<!-- Hero Section -->
<section id="hero" class="relative min-h-screen flex items-center justify-center bg-gray-900 pt-20 bg-fixed bg-cover bg-center"
    style="background-image: url('img/ss.png');">
    
    <div class="relative z-10 px-6 sm:px-8 lg:px-12 max-w-[90rem] mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center py-16">

        <!-- Left Column: Text Content -->
        <div class="text-center md:text-left">
            <!-- Hero Title -->
            <h1 id="hero-title"
                class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white mb-6 uppercase bg-gradient-to-r from-[#00c6ff] to-[#0072ff] 
                    inline-block text-transparent bg-clip-text drop-shadow-lg animate-fade-in">
                <span class="text-[#E4A11B]">FINDING</span> Local Solutions to Global Problems.
            </h1>

            <!-- Hero Description -->
            <p id="hero-desc"
                class="text-base sm:text-lg md:text-xl lg:text-2xl text-white/80 mb-8 max-w-2xl leading-relaxed animate-fade-in">
                Our mission is to facilitate the realization of an empowered, self-sufficient, and resilient community by 
                using art and collaborations to address the social, economic, and environmental issues on Bantayan Island.
            </p>

            <!-- CTA Buttons -->
            <div id="hero-buttons" class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 items-center md:items-start mt-6">
                <a href="#about"
                    class="group bg-[#0097b2] hover:bg-[#007a8e] text-white text-lg font-medium py-4 px-8 rounded-lg transition-all 
                    shadow-xl hover:shadow-[#0097b2]/20 transform hover:-translate-y-1 flex items-center justify-center">
                    <span>Learn More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 transform group-hover:translate-x-1 transition-transform" 
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                <a href="https://youtube.com" target="_blank"
                    class="group bg-transparent hover:bg-white/10 text-white text-lg border-2 border-white font-medium py-4 px-8 rounded-lg transition-all 
                    shadow-lg hover:shadow-white/20 transform hover:-translate-y-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Watch Video</span>
                </a>
            </div>
        </div>

        <!-- Right Column: Image -->
        <div class="relative h-full flex items-center justify-center">
            <div class="relative rounded-lg overflow-hidden shadow-2xl border-4 border-white/20 transform md:translate-y-0 animate-fade-in">
                <img src="img/untitled-design-2_orig.jpg" alt="Bantayan Island" class="w-full h-[250px] sm:h-[300px] md:h-[350px] lg:h-[490px] object-cover">
                
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                <!-- Text Overlay -->
                <div class="absolute bottom-4 right-4 text-white bg-black/40 px-3 py-1 rounded-lg">
                    <p class="text-lg font-medium">Bantayan Island, Philippines</p>
                </div>
            </div>
        </div>
    </div>
  <!-- Social Media Links -->
  <div class="absolute bottom-10 right-10 z-20 flex flex-col space-y-4" id="social-links">
    <a href="#" class="text-white hover:text-[#0097b2] transition-colors duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
        </svg>
    </a>
    <a href="#" class="text-white hover:text-[#0097b2] transition-colors duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
        </svg>
    </a>
    <a href="#" class="text-white hover:text-[#0097b2] transition-colors duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
        </svg>
    </a>
</div>
</section>

<!-- About Section with Parallax Background -->
<section id="about" class="py-24 relative bg-fixed bg-center bg-cover bg-no-repeat" 
    style="background-image: url('img/1983557070.png');">
    
    <!-- Dark Overlay for Better Readability -->
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-12">

            <!-- Image Section -->
            <div class="md:w-1/2 border-4 border-[#0097b2] shadow-lg rounded-2xl overflow-hidden relative group" 
                data-animate>
                
                <img src="img/untitled-design-2_orig.jpg" 
                    alt="About Goodland Community" 
                    class="w-full h-auto object-cover transform transition-transform duration-500 group-hover:scale-105">
                
                <!-- Dark Overlay on Hover -->
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>

            <!-- Text Content -->
            <div class="md:w-1/2 text-center md:text-left text-white animate-fade-in-up delay-200" data-animate>
                
                <!-- Section Label -->
                <p class="text-yellow-400 text-xl font-semibold mb-2 uppercase tracking-wide">Kinsa Kami</p>

                <!-- Section Title -->
                <h2 class="text-4xl sm:text-5xl font-bold mb-6">
                    Who We Are
                </h2>

                <!-- Description -->
                <p class="text-gray-300 text-lg sm:text-xl mb-6 leading-relaxed">
                    <strong>Goodland</strong> is a **community-driven initiative** focused on **empowering local communities** 
                    through sustainability, education, and the arts. We strive to foster **resilience and self-sufficiency** 
                    while addressing social, economic, and environmental challenges.
                </p>

                <p class="text-gray-300 text-lg sm:text-xl mb-8 leading-relaxed">
                    Through **collaboration** and **innovative solutions**, we aim to make a lasting impact on **Bantayan Island and beyond**.
                </p>

                <!-- Call to Action Button -->
                <a href="#"
                    class="bg-[#0097b2] hover:bg-[#007a8e] text-white font-semibold py-4 px-10 rounded-lg inline-block 
                    transition-all shadow-lg transform hover:-translate-y-1 text-lg hover:shadow-lg hover:ring-4 hover:ring-[#0097b2]/50">
                    Read More
                </a>

            </div>
        </div>
    </div>
</section>

    <section id="core-values" class="relative py-24 bg-gray-900 w-full bg-fixed bg-[url('img/ss.png')] bg-cover bg-center">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-white/5"></div>
    <div class="max-w-[100rem] mx-auto px-12">
            <div class="text-center mb-12">
                <p class="text-yellow-500 text-xl font-semibold mb-2 uppercase tracking-wide">Upat Ka Kinauyukan</p>
                <h2 class="text-white text-5xl font-bold mb-6">Core of Goodland</h2>
            </div>

            <div class="text-center">
                <div class="mb-8">
                    <p class="text-gray-100 text-3xl font-semibold mb-2"><span class="text-[#34a853]">Food</span></p>
                    <p class="text-gray-300 text-xl mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
                <!-- Left Content (Food & Water) -->
                <div class="text-left">
                    <div class="mb-4">
                        <p class="text-gray-100 text-3xl font-semibold mb-2 text-center"><span class="text-[#fbbc05]">Culture</span></p>
                        <p class="text-gray-300 text-xl mb-4 px-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.</p>
                    </div>
                </div>

                <!-- Center: Visual Core Representation -->
                <div class="flex justify-center">
                    <div class="relative flex items-center justify-center w-[560px] h-[560px]">
                        <!-- Circular Pattern -->
                        <div class="absolute w-full h-full flex items-center justify-center">
                            <div class="absolute w-[520px] h-[520px] border border-red-500 rounded-full"></div>
                            <div class="absolute w-[440px] h-[440px] border border-orange-500 rounded-full"></div>
                            <div class="absolute w-[360px] h-[360px] border border-yellow-500 rounded-full"></div>
                            <div class="absolute w-[280px] h-[280px] border border-green-500 rounded-full"></div>
                            <div class="absolute w-[200px] h-[200px] border border-blue-500 rounded-full"></div>
                        </div>
                        <!-- Center Circle -->
                        <div class="absolute uppercase w-64 h-64 bg-transparent text-white flex items-center justify-center rounded-full 
                        shadow-lg text-xl font-semibold z-10">
                            Core
                        </div>
                        <!-- Food (Top) -->
                        <div class="absolute uppercase top-8 left-1/2 transform -translate-x-1/2 w-48 h-48 bg-[#34a853] text-white flex flex-col items-center justify-center rounded-full shadow-md hover:scale-110 transition z-10 text-center p-4 text-sm leading-tight">
                            <p class="font-bold">Food</p>
                            <p class="text-white text-xs italic">(Pagkaon)</p>
                        </div>
                        <!-- Water (Right) -->
                        <div class="absolute uppercase right-[-2rem] top-1/2 transform -translate-y-1/2 w-48 h-48 bg-[#0097b2] text-white flex flex-col items-center justify-center rounded-full shadow-md hover:scale-110 transition z-10 text-center p-4 text-sm leading-tight">
                            <p class="font-bold">Water</p>
                            <p class="text-white text-xs italic">(Tubig)</p>
                        </div>
                        <!-- Self-Development (Bottom) -->
                        <div class="absolute uppercase bottom-8 left-1/2 transform -translate-x-1/2 w-48 h-48 bg-[#ea4335] text-white flex flex-col items-center justify-center rounded-full shadow-md hover:scale-110 transition z-10 text-center p-4 text-sm leading-tight">
                            <p class="font-bold">Self-Development</p>
                            <p class="text-white text-xs italic">(Pagpalambo sa Kaugalingon)</p>
                        </div>
                        <!-- Culture (Left) -->
                        <div class="absolute uppercase left-[-2rem] top-1/2 transform -translate-y-1/2 w-48 h-48 bg-[#fbbc05] text-white flex flex-col items-center justify-center rounded-full shadow-md hover:scale-110 transition z-10 text-center p-4 text-sm leading-tight">
                            <p class="font-bold">Culture</p>
                            <p class="text-white text-xs italic">(Kultura)</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Self-Development & Culture) -->
                <div class="text-left">
                    <div class="mb-8">
                        <p class="text-gray-100 text-3xl font-semibold mb-2 text-center"><span class="text-[#0097b2]">Water</span></p>
                        <p class="text-gray-300 text-xl mb-4 px-10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <div class="mb-8">
                    <p class="text-gray-100 text-3xl font-semibold mb-2"><span class="text-[#ea4335]">Self-Development</span></p>
                    <p class="text-gray-300 text-xl mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="projects" class="py-12 relative bg-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

        <div class="max-w-[90rem] mx-auto px-6 sm:px-12 lg:px-12 relative z-10">
            
            <!-- Section Title -->
            <div class="text-center mb-16">
                <p class="text-yellow-300 font-bold text-xl font-semibold mb-2 uppercase tracking-wide">Kinsa Kami</p>
                <h2 class="text-5xl font-extrabold text-gray-900 relative inline-block">
                    Our Projects
                    <span class="block w-32 h-1 bg-[#0097b2] rounded-md absolute left-1/2 transform -translate-x-1/2 bottom-[-10px]"></span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mt-4 leading-relaxed">
                    Discover how Goodland is driving impactful change through sustainable initiatives.
                </p>
            </div>

        

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                
                <!-- Bantayan Battery Solution -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="img/1862743834.png" alt="Bantayan Battery Solution" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Bantayan Battery Solution</h3>
                        <p class="text-gray-600">
                            Over 700 compressor-diving fishermen in Bantayan discard half a million batteries into the ocean yearly. We've engineered a powerful solar solution to protect our planet and ease the financial burden on fishermen.
                        </p>
                        <a href="#" class="mt-4 inline-block bg-[#0097b2] hover:bg-[#007a8e] text-white font-medium py-2 px-6 rounded-lg transition-all">Learn More</a>
                    </div>
                </div>

                <!-- Marine Protected Area: Mambacayao Daku -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="img/1862743834.png" alt="Marine Protected Area: Mambacayao Daku" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Marine Protected Area: Mambacayao Daku</h3>
                        <p class="text-gray-600">
                            Residents of Mambacayao Daku have united to protect their island’s future. Two new GOODland branches, for adults and youth, are working together to preserve their environment for generations to come.
                        </p>
                        <a href="#" class="mt-4 inline-block bg-[#0097b2] hover:bg-[#007a8e] text-white font-medium py-2 px-6 rounded-lg transition-all">Learn More</a>
                    </div>
                </div>

                <!-- Watershed Protected Area: Bihiya, Atop-Atop -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="img/1862743834.png" alt="Watershed Protected Area: Bihiya, Atop-Atop" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Watershed Protected Area: Bihiya, Atop-Atop</h3>
                        <p class="text-gray-600">
                            The Bihiya Warriors, a group of young locals, are taking action to protect Bantayan Island’s oldest and deepest watershed through awareness campaigns and conservation efforts.
                        </p>
                        <a href="#" class="mt-4 inline-block bg-[#0097b2] hover:bg-[#007a8e] text-white font-medium py-2 px-6 rounded-lg transition-all">Learn More</a>
                    </div>
                </div>

            </div>

            <!-- View All Projects Button -->
            <div class="text-center mt-16">
                <a href="#" class="bg-[#0097b2] hover:bg-[#007a8e] text-white font-medium py-4 px-10 rounded-lg transition-all shadow-lg transform hover:-translate-y-1">
                    View All Projects
                </a>
            </div>

        </div>
    </section>

    <!-- Recent Events Section -->
    <section id="events" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16">
            <div class="flex flex-col md:flex-row items-center gap-12">
                
                <!-- Featured Event -->
                <div class="md:w-1/2 text-center md:text-left" data-animate>
                    <h2 class="text-gray-700 text-5xl font-bold mb-6">Recent Events</h2>
                    <p class="text-gray-600 text-xl mb-6 leading-relaxed">
                        Discover our latest community activities and initiatives that are making a difference.
                    </p>

                    <div class="space-y-6 text-gray-700">
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-calendar-alt text-2xl text-gray-500"></i>
                            <div>
                                <h4 class="text-lg font-semibold">February 20, 2025</h4>
                                <p class="text-gray-600">Youth Leadership Summit – Inspiring young leaders to drive change.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-calendar-alt text-2xl text-gray-500"></i>
                            <div>
                                <h4 class="text-lg font-semibold">February 5, 2025</h4>
                                <p class="text-gray-600">Art for Change Workshop – Creativity meets social impact.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-calendar-alt text-2xl text-gray-500"></i>
                            <div>
                                <h4 class="text-lg font-semibold">January 15, 2025</h4>
                                <p class="text-gray-600">Beach Cleanup Drive – Protecting our coastal environment.</p>
                            </div>
                        </div>

                        <div class="pt-6">
                            <a href="#" class="bg-[#0097b2] hover:bg-[#007a8e] text-white font-medium py-4 px-8 rounded-full transition-all shadow-lg transform hover:-translate-y-1">
                                View All Events
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Events Gallery -->
                <div class="md:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-6" data-animate>
                    <!-- Event 1 -->
                    <div class="border-2 p-6 rounded-lg shadow-lg bg-white hover:shadow-xl transition-all">
                        <img src="images/1862743834.png"  alt="Beach Cleanup" class="w-full h-48 object-cover rounded-md mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Beach Cleanup Drive</h3>
                        <p class="text-gray-600">Volunteers gathered to clean and restore our beautiful shores.</p>
                        <a href="#" class="text-[#0097b2] hover:text-[#007a8e] font-medium inline-flex items-center mt-3 transition-all">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Event 2 -->
                    <div class="border-2 p-6 rounded-lg shadow-lg bg-white hover:shadow-xl transition-all">
                        <img src="images/1862743834.png"  alt="Art for Change" class="w-full h-48 object-cover rounded-md mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Art for Change Workshop</h3>
                        <p class="text-gray-600">Using art to spread awareness about social and environmental issues.</p>
                        <a href="#" class="text-[#0097b2] hover:text-[#007a8e] font-medium inline-flex items-center mt-3 transition-all">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shared Experience Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16">
            <div class="text-center mb-16">
                <h2 class="text-gray-700 text-5xl font-bold mb-6">Shared Experience</h2>
                <p class="text-gray-600 text-xl max-w-3xl mx-auto">
                    Discover the voices of our community and partners as they share their experiences with Goodland.
                </p>
            </div>

            <!-- Testimonial Grid -->
            <div class="grid md:grid-cols-3 gap-10">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border-l-4 border-[#0097b2] hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <img src="images/1862743834.png"  alt="Maria Santos" class="w-16 h-16 rounded-full border">
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Maria Santos</h4>
                            <p class="text-gray-600">Local Artist</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">
                        "Goodland has transformed how our community connects with nature. Their dedication to sustainability is truly inspiring!"
                    </p>
                    <div class="text-yellow-400">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border-l-4 border-[#0097b2] hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <img src="images/1862743834.png"  alt="Carlos Reyes" class="w-16 h-16 rounded-full border">
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Carlos Reyes</h4>
                            <p class="text-gray-600">Community Leader</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">
                        "The initiatives led by Goodland have made a lasting impact on our local economy and environment. A true game-changer!"
                    </p>
                    <div class="text-yellow-400">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border-l-4 border-[#0097b2] hover:shadow-xl transition-all">
                    <div class="flex items-center mb-4">
                        <img src="images/1862743834.png"  alt="Anna Kim" class="w-16 h-16 rounded-full border">
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Anna Kim</h4>
                            <p class="text-gray-600">International Partner</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-4">
                        "Collaborating with Goodland has been a rewarding experience. Their work in sustainability is setting a global example."
                    </p>
                    <div class="text-yellow-400">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-16">
            <div class="flex flex-col md:flex-row items-center gap-12">
                
                <!-- Contact Info -->
                <div class="md:w-1/2 text-center md:text-left" data-animate>
                    <h2 class="text-gray-700 text-5xl font-bold mb-6">Get in Touch</h2>
                    <p class="text-gray-600 text-xl mb-6 leading-relaxed">
                        Have questions or want to get involved? Reach out to us today!
                    </p>

                    <div class="space-y-6 text-gray-700">
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-map-marker-alt text-2xl text-gray-500"></i>
                            <div>
                                <h4 class="text-lg font-semibold">Address</h4>
                                <p class="text-gray-600">Bantayan Island, Cebu, Philippines</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-phone text-2xl text-gray-500"></i>
                            <div>
                                <h4 class="text-lg font-semibold">Phone</h4>
                                <p class="text-gray-600">+63 (123) 456-7890</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-envelope text-2xl text-gray-500"></i>
                            <div>
                                <h4 class="text-lg font-semibold">Email</h4>
                                <p class="text-gray-600">info@goodland.org</p>
                            </div>
                        </div>

                        <!-- Social Media Icons -->
                        <div class="pt-6 flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-200 text-gray-600 flex items-center justify-center rounded-full hover:bg-gray-300 transition-all shadow-md">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-200 text-gray-600 flex items-center justify-center rounded-full hover:bg-gray-300 transition-all shadow-md">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-200 text-gray-600 flex items-center justify-center rounded-full hover:bg-gray-300 transition-all shadow-md">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-200 text-gray-600 flex items-center justify-center rounded-full hover:bg-gray-300 transition-all shadow-md">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="md:w-1/2 border-2 p-8 rounded-lg shadow-lg bg-white" data-animate>
                    <form>
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-[#0097b2] transition-all placeholder-gray-500 text-gray-800" placeholder="Enter your name">
                        </div>
                        
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-[#0097b2] transition-all placeholder-gray-500 text-gray-800" placeholder="Enter your email">
                        </div>
                        
                        <div class="mb-6">
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-[#0097b2] transition-all placeholder-gray-500 text-gray-800" placeholder="Enter subject">
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0097b2] focus:border-[#0097b2] transition-all placeholder-gray-500 text-gray-800" placeholder="Enter your message"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-[#0097b2] hover:bg-[#007a8e] text-white font-medium py-4 px-10 rounded-full transition-all shadow-lg transform hover:-translate-y-1">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative bg-gray-900 text-white pt-24 pb-12 bg-[url('img/ss.png')] bg-cover bg-center bg-fixed backdrop-brightness-75">
        <div class="max-w-[90rem] mx-auto px-6 sm:px-12 lg:px-16">
            
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-1">
                
                <!-- Logo and Description -->
                <div>
                    <img class="h-36 w-auto mb-6 shadow-white" src="img/GOODLand__1_-removebg-preview.png" alt="Goodland Logo">
                    <p class="text-gray-300 mb-6 text-lg leading-relaxed">
                        Finding local solutions to global problems through community empowerment, sustainable initiatives, and art-based programs.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all">Home</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-white transition-all">About Us</a></li>
                        <li><a href="#methodology" class="text-gray-300 hover:text-white transition-all">Methodology</a></li>
                        <li><a href="#projects" class="text-gray-300 hover:text-white transition-all">Projects</a></li>
                        <li><a href="#contact" class="text-gray-300 hover:text-white transition-all">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Programs -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Programs</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all">Environmental Conservation</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all">Art for Change</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all">Youth Education</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all">Community Development</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-all">Volunteer Programs</a></li>
                    </ul>
                </div>
                
                <!-- Newsletter Section -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Newsletter</h4>
                    <p class="text-gray-300 mb-4 text-lg leading-relaxed">
                        Subscribe to our newsletter to stay updated with our latest news and events.
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#0097b2] focus:border-[#0097b2] flex-grow text-gray-200">
                        <button type="submit" class="bg-[#0097b2] hover:bg-[#007a8e] px-4 py-2 rounded-r-lg transition-all text-white">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer Bottom Section -->
            <div class="border-t border-gray-800 pt-8 text-center text-gray-300">
                <p>&copy; 2025 Goodland. All rights reserved.</p>
            </div>
        </div>
    </footer>


    <script>
        let lastScroll = 0;
        const topHeader = document.getElementById('top-header');
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            let currentScroll = window.pageYOffset;
            if (currentScroll > lastScroll) {
                topHeader.style.transform = 'translateY(-100%)';
                navbar.style.top = '0';
            } else {
                topHeader.style.transform = 'translateY(0)';
                navbar.style.top = '2rem'; // Adjust to match header height
            }
            lastScroll = currentScroll;
        });
    </script>
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-white/90', 'backdrop-blur-md');
                navbar.classList.add('bg-white', 'shadow-lg');
            } else {
                navbar.classList.add('bg-white/90', 'backdrop-blur-md');
                navbar.classList.remove('bg-white', 'shadow-lg');
            }
        });
    </script>

    
    <!-- Parallax Effect Script -->
<script>
    document.addEventListener("scroll", function () {
        let parallaxImages = document.querySelectorAll(".parallax");
        parallaxImages.forEach(img => {
            let speed = -2; // Adjust speed for effect
            let yPos = window.scrollY / speed;
            img.style.transform = `translateY(${yPos}px)`;
        });
    });
</script>
<script>
 document.addEventListener("DOMContentLoaded", function () {
    const menuButton = document.getElementById("menu-button");
    const closeButton = document.getElementById("close-menu");
    const mobileMenu = document.getElementById("mobile-menu");

    // Open Menu
    menuButton.addEventListener("click", () => {
        mobileMenu.classList.remove("opacity-0", "translate-x-full");
        mobileMenu.classList.add("opacity-100", "translate-x-0");
    });

    // Close Menu
    closeButton.addEventListener("click", () => {
        mobileMenu.classList.remove("opacity-100", "translate-x-0");
        mobileMenu.classList.add("opacity-0", "translate-x-full");
    });
});

</script>
</body>
</html>
