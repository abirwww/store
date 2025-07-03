<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasnin's Clothes Store</title>
    <link rel="icon" href="{{ asset('images/tasnins.jpg') }}" type="images/tasnins.jpg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f8f8;
        }
        /* Custom styles for hero section background pattern */
        .hero-section {
            background-image: url('https://placehold.co/1920x600/F0F8FF/333333?text=Fashion+Collection'); /* Placeholder image for hero */
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 1;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4); /* Dark overlay */
            z-index: -1;
        }
        .product-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        /* Simple modal for messages */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            position: relative;
        }
        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 20px;
        }
        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Styles for Off-Canvas Menu */
        .off-canvas-menu {
            position: fixed;
            top: 0;
            left: -300px; /* Hidden by default */
            width: 250px;
            height: 100%;
            background-color: #333;
            color: white;
            z-index: 1100;
            transition: left 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            padding-top: 60px; /* Space for close button */
        }
        .off-canvas-menu.open {
            left: 0; /* Slide in */
        }
        .off-canvas-menu .close-menu {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
            color: white;
        }
        .off-canvas-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .off-canvas-menu ul li a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid #444;
            transition: background-color 0.3s ease;
        }
        .off-canvas-menu ul li a:hover {
            background-color: #555;
        }
        .off-canvas-overlay {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            z-index: 1050;
        }
        .off-canvas-overlay.open {
            display: block;
        }
    </style>
</head>
<body>

    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <p id="modalMessage"></p>
            <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Close</button>
        </div>
    </div>

    <div id="offCanvasMenu" class="off-canvas-menu">
        <span class="close-menu" onclick="toggleMenu()">&times;</span>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#"><i class="fas fa-shopping-cart"></i> Cart <span class="ml-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center inline-flex">0</span></a></li>
            <li><a href="#"><i class="fas fa-user"></i> Account</a></li>
        </ul>
    </div>

    <div id="offCanvasOverlay" class="off-canvas-overlay" onclick="toggleMenu()"></div>

    <header class="bg-white shadow-sm py-4">
        <div class="container mx-auto flex items-center justify-between px-4 relative"> <a href="#" class="flex items-center overflow-hidden flex-grow md:flex-grow-0 min-w-0 pr-12"> <img src="images/tasnins.jpg" alt="Tasnin's Clothes Store Logo" class="h-16 w-16 rounded-full mr-3 flex-shrink-0">
                <span class="text-xl sm:text-2xl md:text-2xl font-bold text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">Tasnin's Clothes Store</span>
            </a>

            <button id="hamburgerBtn" class="md:hidden text-gray-700 focus:outline-none absolute right-4 top-1/2 -translate-y-1/2" onclick="toggleMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <nav class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300">Dashboard</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300">Shop</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300">Categories</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300">Contact</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300 relative">
                    <i class="fas fa-shopping-cart"></i> Cart
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </a>
                <!-- Account Dropdown (Tailwind CSS) -->
<div class="relative group inline-block">
  <!-- Account Button -->
  <a href="#" class="text-gray-700 hover:text-blue-600 transition duration-300 flex items-center">
    <i class="fas fa-user mr-1"></i> Account
    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.08 1.04l-4.24 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
  </a>

  <!-- Dropdown Menu -->
  <div class="absolute right-0 mt-2 w-44 bg-white rounded-md shadow-lg py-2 z-50 hidden group-hover:block">
    <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">
      <i class="fas fa-user-cog mr-2"></i> Profile
    </a>
    <a href="/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">
      <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
    </a>
    <form method="POST" action="/logout">
      @csrf
      <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </form>
  </div>
</div>

            </nav>
        </div>
    </header>

    <section class="hero-section text-white py-24 md:py-32 rounded-lg m-4">
        <div class="container mx-auto text-center px-4">
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6 animate-pulse">
                Discover Your Perfect Style
            </h1>
            <p class="text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                Explore our exclusive collection of trendy and comfortable clothes for every occasion.
            </p>
            <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transform transition duration-300 hover:scale-105">
                Shop Now
            </a>
        </div>
    </section>

    <section class="py-16 bg-white mx-4 rounded-lg shadow-sm">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Popular Categories</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div class="bg-gray-100 rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                    <img src="images/mens/mensimage.jfif" alt="Men's Wear" class="w-full h-48 object-cover">
                    <div class="p-5 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Men's Wear</h3>
                        <p class="text-gray-600 text-sm">Stylish outfits for men.</p>
                        <a href="#" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">View Collection <i class="fas fa-arrow-right text-sm ml-1"></i></a>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                    <img src="https://placehold.co/400x300/FFE4E1/333333?text=Women's+Fashion" alt="Women's Fashion" class="w-full h-48 object-cover">
                    <div class="p-5 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Women's Fashion</h3>
                        <p class="text-gray-600 text-sm">Trendy and elegant attire for women.</p>
                        <a href="#" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">View Collection <i class="fas fa-arrow-right text-sm ml-1"></i></a>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                    <img src="https://placehold.co/400x300/F5FFFA/333333?text=Kids+Collection" alt="Kids Collection" class="w-full h-48 object-cover">
                    <div class="p-5 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Kids Collection</h3>
                        <p class="text-gray-600 text-sm">Fun and comfortable clothes for kids.</p>
                        <a href="#" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">View Collection <i class="fas fa-arrow-right text-sm ml-1"></i></a>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                    <img src="https://placehold.co/400x300/F0F8FF/333333?text=Accessories" alt="Accessories" class="w-full h-48 object-cover">
                    <div class="p-5 text-center">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Accessories</h3>
                        <p class="text-gray-600 text-sm">Complete your look with our accessories.</p>
                        <a href="#" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">View Collection <i class="fas fa-arrow-right text-sm ml-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-8 rounded-full shadow-md transform transition duration-300 hover:scale-105">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 text-white py-16 mx-4 rounded-lg shadow-md flex items-center justify-center flex-col text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Join Our Newsletter</h2>
        <p class="text-lg mb-8 max-w-xl">Stay updated with our latest collections, exclusive offers, and fashion tips.</p>
        <div class="flex flex-col sm:flex-row gap-4 w-full justify-center px-4">
            <input type="email" placeholder="Enter your email" class="w-full sm:w-80 px-5 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button onclick="showMessage('Thank you for subscribing!')" class="bg-white text-blue-600 hover:bg-gray-100 font-semibold py-3 px-8 rounded-full shadow-lg transition duration-300">
                Subscribe Now
            </button>
        </div>
    </section>

    <footer class="bg-gray-800 text-gray-300 py-12 mt-8 rounded-lg m-4">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-4">
            <div>
                <h3 class="text-white text-xl font-semibold mb-4">Tasnin's Clothes Store</h3>
                <p class="text-sm">Your one-stop shop for trendy and quality clothing. We bring you the latest fashion at unbeatable prices.</p>
            </div>
            <div>
                <h3 class="text-white text-xl font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">About Us</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">Shop</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">FAQ</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-xl font-semibold mb-4">Customer Service</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">Contact Us</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">Returns & Refunds</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">Shipping Information</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition duration-300">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-xl font-semibold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-facebook-f text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-twitter text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-pinterest text-2xl"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center text-gray-500 text-sm mt-10 border-t border-gray-700 pt-8">
            &copy; 2025 Tasnin's Clothes Store. All rights reserved.
        </div>
    </footer>

    <script>
        // JavaScript for message modal
        function showMessage(message) {
            const modal = document.getElementById('messageModal');
            const modalMessage = document.getElementById('modalMessage');
            modalMessage.textContent = message;
            modal.style.display = 'flex'; // Use flex to center
        }

        function closeModal() {
            const modal = document.getElementById('messageModal');
            modal.style.display = 'none';
        }

        // Close modal if user clicks outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('messageModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // JavaScript for Off-Canvas Menu
        function toggleMenu() {
            const menu = document.getElementById('offCanvasMenu');
            const overlay = document.getElementById('offCanvasOverlay');
            menu.classList.toggle('open');
            overlay.classList.toggle('open');
            // Prevent scrolling when menu is open
            document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : '';
        }
    </script>
</body>
</html>