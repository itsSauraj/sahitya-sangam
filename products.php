<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sahitya Sangam — Books</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

<style>
body { font-family: 'Inter', sans-serif; }
h1,h2,h3 { font-family: 'Playfair Display', serif; }

/* Enhanced Navbar */
.enhanced-nav {
  background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(254,243,199,0.9) 100%);
  backdrop-filter: blur(12px);
  border-bottom: 2px solid transparent;
  border-image: linear-gradient(90deg, #f59e0b, #d97706, #f59e0b) 1;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Logo Enhancement */
.logo {
  background: linear-gradient(135deg, #d97706 0%, #f59e0b 50%, #fbbf24 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.2));
  transition: transform 0.3s ease, filter 0.3s ease;
}

.logo:hover {
  transform: scale(1.05);
  filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.4));
}

/* Hover underline effect */
.nav-link {
  position: relative;
  display: inline-block;
  font-weight: 500;
  letter-spacing: 0.3px;
  transition: all 0.3s ease;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, #d97706, #f59e0b);
  opacity: 0;
  transform: scaleX(0);
  transform-origin: center;
  transition: opacity 0.3s ease, transform 0.3s ease;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.nav-link:hover::after {
  opacity: 1;
  transform: scaleX(1);
}

/* Enhanced Buttons */
.btn-primary {
  background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
  box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.3);
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px -2px rgba(217, 119, 6, 0.4);
}

.user-badge {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  padding: 0.5rem 1rem;
  border-radius: 9999px;
  border: 2px solid #fbbf24;
  box-shadow: 0 2px 4px rgba(217, 119, 6, 0.2);
  transition: all 0.3s ease;
}

.user-badge:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(217, 119, 6, 0.3);
}

/* Enhanced Footer */
.enhanced-footer {
  background: linear-gradient(135deg, #d97706 0%, #f59e0b 50%, #fbbf24 100%);
  position: relative;
  overflow: hidden;
}

.enhanced-footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, #fbbf24, #ffffff, #fbbf24);
  opacity: 0.6;
}

.footer-heading {
  font-size: 1.125rem;
  font-weight: 600;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
}

.footer-heading::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 40px;
  height: 2px;
  background: white;
  border-radius: 2px;
}

.footer-link {
  transition: all 0.3s ease;
  display: inline-block;
  position: relative;
  padding-left: 0;
}

.footer-link:hover {
  color: white !important;
  transform: translateX(5px);
  text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.footer-link::before {
  content: '→';
  position: absolute;
  left: -20px;
  opacity: 0;
  transition: all 0.3s ease;
}

.footer-link:hover::before {
  opacity: 1;
  left: -15px;
}

.social-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.social-icon:hover {
  background: white;
  transform: translateY(-3px) rotate(5deg);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  border-color: white;
}

.social-icon span {
  color: white;
  font-weight: 700;
  transition: color 0.3s ease;
}

.social-icon:hover span {
  color: #000000;
}

/* Enhanced Sidebar Filters */
.filter-section {
  background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%);
  border: 2px solid #fbbf24;
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

.filter-section:hover {
  box-shadow: 0 6px 16px rgba(217, 119, 6, 0.15);
  border-color: #f59e0b;
}

.filter-heading {
  font-size: 1.125rem;
  font-weight: 700;
  color: #d97706;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.filter-heading::before {
  content: '';
  width: 4px;
  height: 1.5rem;
  background: linear-gradient(180deg, #f59e0b, #fbbf24);
  border-radius: 2px;
}

/* Custom Checkbox */
.filter-checkbox {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.5rem;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
}

.filter-checkbox:hover {
  background: rgba(251, 191, 36, 0.1);
  transform: translateX(5px);
}

.filter-checkbox input[type="checkbox"] {
  appearance: none;
  width: 20px;
  height: 20px;
  border: 2px solid #d97706;
  border-radius: 4px;
  cursor: pointer;
  position: relative;
  transition: all 0.3s ease;
}

.filter-checkbox input[type="checkbox"]:checked {
  background: linear-gradient(135deg, #d97706, #f59e0b);
  border-color: #d97706;
}

.filter-checkbox input[type="checkbox"]:checked::after {
  content: '✓';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-size: 14px;
  font-weight: bold;
}

.filter-checkbox label {
  cursor: pointer;
  color: #374151;
  font-weight: 500;
  transition: color 0.3s ease;
}

.filter-checkbox:hover label {
  color: #d97706;
}

/* Price Range Slider */
.price-slider {
  width: 100%;
  height: 8px;
  border-radius: 4px;
  background: linear-gradient(90deg, #fef3c7 0%, #fbbf24 50%, #f59e0b 100%);
  outline: none;
  -webkit-appearance: none;
  margin: 1rem 0;
}

.price-slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: linear-gradient(135deg, #d97706, #f59e0b);
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(217, 119, 6, 0.4);
  transition: all 0.3s ease;
}

.price-slider::-webkit-slider-thumb:hover {
  transform: scale(1.2);
  box-shadow: 0 4px 12px rgba(217, 119, 6, 0.6);
}

.price-slider::-moz-range-thumb {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: linear-gradient(135deg, #d97706, #f59e0b);
  cursor: pointer;
  border: none;
  box-shadow: 0 2px 8px rgba(217, 119, 6, 0.4);
  transition: all 0.3s ease;
}

.price-slider::-moz-range-thumb:hover {
  transform: scale(1.2);
  box-shadow: 0 4px 12px rgba(217, 119, 6, 0.6);
}

.price-display {
  display: flex;
  justify-content: space-between;
  font-size: 0.875rem;
  color: #6b7280;
  margin-top: 0.5rem;
}

.price-value {
  font-weight: 600;
  color: #d97706;
}

/* Logout Button */
.btn-logout {
  background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
  box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
  transition: all 0.3s ease;
}

.btn-logout:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px -2px rgba(220, 38, 38, 0.4);
}

/* User Badge */
.user-badge {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  padding: 0.5rem 1rem;
  border-radius: 9999px;
  border: 2px solid #fbbf24;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.user-badge:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Login Button */
.btn-outline {
  border: 2px solid #d97706;
  background: transparent;
  transition: all 0.3s ease;
}

.btn-outline:hover {
  background: #d97706;
  color: white !important;
}

/* Register Button */
.btn-primary {
  background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
  box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.3);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn-primary::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  transition: left 0.5s ease;
}

.btn-primary:hover::before {
  left: 100%;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px -2px rgba(217, 119, 6, 0.4);
}
</style>
</head>



<body class="bg-[#f5efe2]">

<!-- ✅ NAVBAR -->
<nav class="enhanced-nav sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    <!-- LOGO -->
    <h1 class="logo text-3xl font-bold cursor-pointer">Sahitya Sangam</h1>

    <!-- MENU CENTER -->
    <div class="hidden md:flex space-x-5">
      <a href="index.php" class="nav-link text-gray-700 hover:text-amber-600">Home</a>
      <a href="about.php" class="nav-link text-gray-700 hover:text-amber-600">About Us</a>
      <a href="authors.php" class="nav-link text-gray-700 hover:text-amber-600">Authors</a>
      <a href="products.php" class="nav-link text-amber-600 font-medium">Books</a>
      <a href="catalog.php" class="nav-link text-gray-700 hover:text-amber-600">Catalog</a>
      <a href="contact.php" class="nav-link text-gray-700 hover:text-amber-600">Contact</a>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center space-x-3">

<?php if(isset($_SESSION['user_name'])): ?>

  <!-- User -->
  <div class="user-badge flex items-center gap-2 text-gray-800 font-semibold">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 21V18.5C4 15.4624 6.46243 13 9.5 13H12.8513C15.307 13 17.4651 11.3721 18.1397 9.01097L18.7454 6.89097C18.8961 6.3636 19.3781 6 19.9266 6C20.7258 6 21.3122 6.75106 21.1184 7.5264L19.3638 14.5448C19.15 15.4 18.3816 16 17.5 16M8 21V18M16 6.5C16 8.70914 14.2091 10.5 12 10.5C9.79086 10.5 8 8.70914 8 6.5C8 4.29086 9.79086 2.5 12 2.5C14.2091 2.5 16 4.29086 16 6.5Z" stroke="#d97706" stroke-linecap="round" stroke-width="1.4"/></svg>
    <span><?php echo $_SESSION['user_name']; ?></span>
  </div>

  <!-- Logout -->
<a href="Auth/logout.php"
   class="btn-logout px-4 py-2 text-sm text-white rounded-lg font-medium">
   Logout
</a>

<?php else: ?>

  <a href="login.php"
     class="btn-outline px-5 py-2 text-sm text-amber-700 rounded-lg font-medium relative z-10">
     Login
  </a>

  <a href="register.php"
     class="btn-primary px-5 py-2 text-sm text-white rounded-lg font-medium relative">
     Register
  </a>

<?php endif; ?>

      <!-- SEARCH -->
      <div class="hidden md:flex items-center bg-[#f3e7c8] px-4 py-2 rounded-full shadow-sm relative">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2 text-gray-500">
          <path d="M21 21L16.5 16.5M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <input type="text" id="search-input"
               placeholder="Search the archives..."
               class="bg-transparent outline-none text-sm w-48">
        <div id="suggestions" class="absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg mt-1 z-50 hidden max-h-60 overflow-y-auto"></div>
      </div>

      <!-- CART ICON -->
      <div class="relative">
        <a href="cart.php" class="text-2xl cursor-pointer hover:scale-110 transition-transform duration-300">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block">
            <path d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001M9 8H21M16.25 22C15.9542 22 15.7708 21.8166 15.7708 21.5208C15.7708 21.225 15.9542 21.0416 16.25 21.0416C16.5458 21.0416 16.7292 21.225 16.7292 21.5208C16.7292 21.8166 16.5458 22 16.25 22ZM8.25 22C7.95425 22 7.77083 21.8166 7.77083 21.5208C7.77083 21.225 7.95425 21.0416 8.25 21.0416C8.54575 21.0416 8.72917 21.225 8.72917 21.5208C8.72917 21.8166 8.54575 22 8.25 22Z" stroke="#d97706" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>

        <!-- CART BADGE -->
        <span id="cart-badge" class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs px-1.5 rounded-full font-bold shadow-md">
          0
        </span>
      </div>

    </div>

  </div>
</nav>

<!-- QUANTITY MODAL -->
<div id="quantityModal" class="hidden fixed inset-0 bg-black/30 z-50 flex items-center justify-center">
  <div class="bg-white rounded-xl shadow-2xl p-8 w-80">
    <h2 class="text-xl font-semibold mb-4" id="modalTitle">Select Quantity</h2>
    
    <div class="border rounded-lg p-4 mb-6 bg-gray-50">
      <p class="text-sm text-gray-600 mb-2">Product Price</p>
      <p id="modalPrice" class="text-2xl font-bold text-amber-600">₹0</p>
    </div>
    
    <div class="flex items-center justify-center space-x-4 mb-6">
      <button id="decreaseQty" class="w-12 h-12 border-2 border-amber-600 text-amber-600 rounded-lg font-bold text-lg hover:bg-amber-100">−</button>
      <input id="quantityInput" type="number" value="1" min="1" class="w-20 text-center border-2 border-amber-600 rounded-lg py-2 font-semibold text-lg" readonly>
      <button id="increaseQty" class="w-12 h-12 border-2 border-amber-600 text-amber-600 rounded-lg font-bold text-lg hover:bg-amber-100">+</button>
    </div>
    
    <button id="confirmAddBtn" class="w-full bg-amber-600 text-white py-3 rounded-lg font-semibold hover:bg-amber-700 mb-2">Add to Cart</button>
    <button id="cancelBtn" class="w-full bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-400">Cancel</button>
  </div>
</div>



<!-- PAGE TITLE BAR -->
<div class="bg-[#e6d3a3] py-8 text-center">
  <h1 class="text-3xl font-semibold text-orange-600">Browse Collection</h1>
</div>



<!-- MAIN CONTENT -->
<div class="px-10 py-8 grid grid-cols-12 gap-8">

  <!-- SIDEBAR -->
  <aside class="col-span-3">

    <!-- Categories Section -->
    <div class="filter-section">
      <h3 class="filter-heading">
        📚 Categories
      </h3>
      <div class="space-y-2">
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-novel">
          <span>Novel</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-fiction">
          <span>Fiction</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-historical">
          <span>Historical Fiction</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-romance">
          <span>Romance</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-poetry">
          <span>Poetry</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-biography">
          <span>Biography</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox" id="cat-drama">
          <span>Drama</span>
        </label>
      </div>
    </div>

    <!-- Price Range Section -->
    <div class="filter-section">
      <h3 class="filter-heading">
        💰 Price Range
      </h3>
      <input type="range" id="priceRange" class="price-slider" min="0" max="1000" value="500">
      <div class="price-display">
        <span>₹0</span>
        <span class="price-value" id="priceValue">₹500</span>
        <span>₹1000</span>
      </div>
    </div>

    <!-- Languages Section
    <div class="filter-section">
      <h3 class="filter-heading">
         Languages
      </h3>
      <div class="space-y-2">
        <label class="filter-checkbox">
          <input type="checkbox">
          <span>Gujarati</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox">
          <span>Hindi</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox">
          <span>English</span>
        </label>
        <label class="filter-checkbox">
          <input type="checkbox">
          <span>Sanskrit</span>
        </label>
      </div>
    </div> -->

  </aside>



  <!-- PRODUCTS -->
  <section class="col-span-9">

    <!-- Filter Indicator -->
    <div id="filter-indicator" class="mb-4 hidden">
      <div class="bg-amber-100 border-l-4 border-amber-600 p-4 rounded-r-lg shadow-md">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <span class="text-2xl" id="filter-icon"></span>
            <div>
              <h3 class="font-bold text-amber-900 text-lg" id="filter-title"></h3>
              <p class="text-sm text-amber-700" id="filter-description"></p>
            </div>
          </div>
          <a href="products.php" class="text-xs bg-amber-600 hover:bg-amber-700 text-white px-3 py-2 rounded-lg transition-all shadow hover:shadow-lg">
            Clear Filter
          </a>
        </div>
      </div>
    </div>

    <div class="flex justify-between items-center mb-6">
      <p class="text-base text-gray-700 font-medium">Showing 6 results</p>

      <select id="sort-select" class="border-2 border-amber-300 bg-amber-50 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 cursor-pointer hover:border-amber-400 hover:bg-amber-100 transition-all">
        <option value="featured">Featured</option>
        <option value="price-low">Price Low to High</option>
        <option value="price-high">Price High to Low</option>
        <option value="newest">Newest First</option>
        <option value="best-selling">Best Selling</option>
      </select>
    </div>


    <div id="products-grid" class="grid grid-cols-3 gap-6">

      <!-- BOOK CARD -->
      <div class="book-card bg-[#efe4c8] rounded overflow-hidden shadow-sm border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 hover:shadow-xl" data-category="NOVEL" data-price="450" data-bestseller="true" data-author="Govardhanram Tripathi">
        <img src="book1.jpg" class="h-60 w-full object-cover">
        <div class="p-3 text-sm">
          <p class="text-xs text-gray-500">NOVEL</p>
          <h3 class="font-semibold">Saraswatichandra Part 1</h3>
          <p class="text-xs text-gray-600">by Govardhanram Tripathi</p>
          <div class="flex justify-between items-center mt-2">
            <span class="text-orange-600 font-semibold">₹450</span>
            <button class="text-xs border px-2 py-1 rounded add-to-cart" data-name="Saraswatichandra Part 1" data-price="450">🛒 Buy</button>
          </div>
        </div>
      </div>

      <!-- BOOK -->
<div class="book-card bg-[#efe4c8] rounded overflow-hidden shadow-sm border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 hover:shadow-xl" data-category="POETRY" data-price="280" data-bestseller="false" data-author="Umashankar Joshi" data-topauthor="true">
  <img src="book7.jpg" class="h-60 w-full object-cover">
  <div class="p-3 text-sm">
    <p class="text-xs text-gray-500">POETRY</p>
    <h3 class="font-semibold">Chandrakant</h3>
    <p class="text-xs text-gray-600">by Umashankar Joshi</p>
    <div class="flex justify-between items-center mt-2">
      <span class="text-orange-600 font-semibold">₹280</span>
        <button class="text-xs border px-2 py-1 rounded add-to-cart" data-name="Chandrakant" data-price="280">🛒 Buy</button>
    </div>
  </div>
</div>

<!-- BOOK -->
<div class="book-card bg-[#efe4c8] rounded overflow-hidden shadow-sm border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 hover:shadow-xl" data-category="BIOGRAPHY" data-price="520" data-bestseller="true" data-author="Rajmohan Gandhi" data-topauthor="true">
  <img src="book8.jpg" class="h-60 w-full object-cover">
  <div class="p-3 text-sm">
    <p class="text-xs text-gray-500">BIOGRAPHY</p>
    <h3 class="font-semibold">Sardar Patel Life</h3>
    <p class="text-xs text-gray-600">by Rajmohan Gandhi</p>
    <div class="flex justify-between items-center mt-2">
      <span class="text-orange-600 font-semibold">₹520</span>
        <button class="text-xs border px-2 py-1 rounded add-to-cart" data-name="Sardar Patel Life" data-price="520">🛒 Buy</button>
    </div>
  </div>
</div>

<!-- BOOK -->
<div class="book-card bg-[#efe4c8] rounded overflow-hidden shadow-sm border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 hover:shadow-xl" data-category="FICTION" data-price="310" data-bestseller="false" data-author="Suresh Joshi" data-topauthor="true">
  <img src="book9.jpg" class="h-60 w-full object-cover">
  <div class="p-3 text-sm">
    <p class="text-xs text-gray-500">FICTION</p>
    <h3 class="font-semibold">Antar Naad</h3>
    <p class="text-xs text-gray-600">by Suresh Joshi</p>
    <div class="flex justify-between items-center mt-2">
      <span class="text-orange-600 font-semibold">₹310</span>
        <button class="text-xs border px-2 py-1 rounded add-to-cart" data-name="Antar Naad" data-price="310">🛒 Buy</button>
    </div>
  </div>
</div>

<!-- BOOK -->
<div class="book-card bg-[#efe4c8] rounded overflow-hidden shadow-sm border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 hover:shadow-xl" data-category="DRAMA" data-price="260" data-bestseller="true" data-author="Chandravadan Mehta">
  <img src="book10.jpg" class="h-60 w-full object-cover">
  <div class="p-3 text-sm">
    <p class="text-xs text-gray-500">DRAMA</p>
    <h3 class="font-semibold">Agnikanya</h3>
    <p class="text-xs text-gray-600">by Chandravadan Mehta</p>
    <div class="flex justify-between items-center mt-2">
      <span class="text-orange-600 font-semibold">₹260</span>
        <button class="text-xs border px-2 py-1 rounded add-to-cart" data-name="Agnikanya" data-price="260">🛒 Buy</button>
    </div>
  </div>
</div>

<!-- BOOK -->
<div class="book-card bg-[#efe4c8] rounded overflow-hidden shadow-sm border-2 border-amber-200 hover:border-amber-400 transition-all duration-300 hover:shadow-xl" data-category="HISTORICAL" data-price="340" data-bestseller="false" data-author="K.M. Munshi" data-topauthor="true">
  <img src="book11.jpg" class="h-60 w-full object-cover">
  <div class="p-3 text-sm">
    <p class="text-xs text-gray-500">HISTORICAL</p>
    <h3 class="font-semibold">Somnath</h3>
    <p class="text-xs text-gray-600">by K.M. Munshi</p>
    <div class="flex justify-between items-center mt-2">
      <span class="text-orange-600 font-semibold">₹340</span>
        <button class="text-xs border px-2 py-1 rounded add-to-cart" data-name="Somnath" data-price="340">🛒 Buy</button>
    </div>
  </div>
</div>

      <!-- duplicate cards as needed -->

    </div>

  </section>

</div>
<footer class="enhanced-footer text-white mt-16">

  <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-4 gap-12 text-sm">

    <!-- About -->
    <div>
      <h3 class="footer-heading">Sahitya Sangam</h3>
      <p class="mt-4 text-amber-50 leading-relaxed">
        Celebrating the rich heritage of literature. We are dedicated to bringing 
        the finest works to readers everywhere.
      </p>
      
      <!-- Social Media -->
      <div class="flex gap-3 mt-6">
        <a href="#" class="social-icon" title="Facebook">
          <span class="text-sm font-bold">f</span>
        </a>
        <a href="#" class="social-icon" title="Twitter">
          <span class="text-sm font-bold">𝕏</span>
        </a>
        <a href="#" class="social-icon" title="Instagram">
          <span class="text-sm font-bold">in</span>
        </a>
        <a href="#" class="social-icon" title="YouTube">
          <span class="text-sm font-bold">▶</span>
        </a>
        <a href="#" class="social-icon" title="WhatsApp">
          <span class="text-sm font-bold">W</span>
        </a>
      </div>
    </div>

    <!-- Quick Links -->
    <div>
      <h4 class="footer-heading">Quick Links</h4>
      <ul class="space-y-3 text-amber-50 mt-4">
        <li><a href="index.php" class="footer-link">Home</a></li>
        <li><a href="about.php" class="footer-link">About Us</a></li>
        <li><a href="products.php" class="footer-link">Books</a></li>
        <li><a href="authors.php" class="footer-link">Authors</a></li>
        <li><a href="catalog.php" class="footer-link">Catalog</a></li>
        <li><a href="contact.php" class="footer-link">Contact</a></li>
      </ul>
    </div>

    <!-- Categories -->
    <div>
      <h4 class="footer-heading">Categories</h4>
      <ul class="space-y-3 text-amber-50 mt-4">
        <li class="hover:text-white transition-colors cursor-pointer">• Novels</li>
        <li class="hover:text-white transition-colors cursor-pointer">• History</li>
        <li class="hover:text-white transition-colors cursor-pointer">• Poetry</li>
        <li class="hover:text-white transition-colors cursor-pointer">• Drama</li>
        <li class="hover:text-white transition-colors cursor-pointer">• Biography</li>
      </ul>
    </div>

    <!-- Contact -->
    <div>
      <h4 class="footer-heading">Contact Us</h4>
      <div class="text-amber-50 space-y-3 mt-4">
        <p class="flex items-start gap-2">
          <span class="text-sm font-bold">■</span>
          <span>123 Literary Lane<br>Book City, BC 12345</span>
        </p>
        <p class="flex items-center gap-2">
          <span class="text-sm font-bold">☎</span>
          <span>+1 (555) 123-4567</span>
        </p>
        <p class="flex items-center gap-2">
          <span class="text-sm font-bold">✉</span>
          <span>info@sahityasangam.com</span>
        </p>
      </div>
    </div>

  </div>

  <!-- Bottom bar -->
  <div class="text-center text-amber-50 text-sm py-6 border-t border-amber-400/30 bg-black/10">
    <p>© 2026 Sahitya Sangam. All rights reserved.</p>
    <p class="mt-2 text-xs">Made with ♥ for book lovers</p>
  </div>

  <!-- Filtering and Sorting Script -->
  <script>
    const bookElements = Array.from(document.querySelectorAll('.book-card'));
    const searchInput = document.getElementById('search-input');
    const suggestions = document.getElementById('suggestions');
    const sortSelect = document.getElementById('sort-select');
    const priceRange = document.getElementById('priceRange');
    const categoryCheckboxes = {
      'NOVEL': document.getElementById('cat-novel'),
      'FICTION': document.getElementById('cat-fiction'),
      'HISTORICAL': document.getElementById('cat-historical'),
      'ROMANCE': document.getElementById('cat-romance'),
      'POETRY': document.getElementById('cat-poetry'),
      'BIOGRAPHY': document.getElementById('cat-biography'),
      'DRAMA': document.getElementById('cat-drama')
    };

    let currentFilters = {
      categories: [],
      maxPrice: 500,
      search: '',
      specialFilter: null // 'bestsellers' or 'topauthors'
    };
    let sortBy = 'featured';

    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const filterParam = urlParams.get('filter');
    
    // Set special filter from URL
    if (filterParam === 'bestsellers') {
      currentFilters.specialFilter = 'bestsellers';
      // Update filter indicator
      document.getElementById('filter-indicator').classList.remove('hidden');
      document.getElementById('filter-icon').textContent = '⭐';
      document.getElementById('filter-title').textContent = 'Bestsellers';
      document.getElementById('filter-description').textContent = 'Showing our most popular and best-selling books';
    } else if (filterParam === 'topauthors') {
      currentFilters.specialFilter = 'topauthors';
      // Update filter indicator
      document.getElementById('filter-indicator').classList.remove('hidden');
      document.getElementById('filter-icon').textContent = '✍️';
      document.getElementById('filter-title').textContent = 'Top Authors';
      document.getElementById('filter-description').textContent = 'Books from our most celebrated and renowned authors';
    }

    function getBookData(element) {
      return {
        element,
        name: element.querySelector('h3').textContent,
        price: parseInt(element.dataset.price),
        category: element.dataset.category,
        bestseller: element.dataset.bestseller === 'true',
        topauthor: element.dataset.topauthor === 'true',
        author: element.dataset.author || ''
      };
    }

    function filterBooks() {
      return bookElements.map(getBookData).filter(book => {
        // Apply special filter first
        if (currentFilters.specialFilter === 'bestsellers' && !book.bestseller) return false;
        if (currentFilters.specialFilter === 'topauthors' && !book.topauthor) return false;
        
        // Then apply regular filters
        if (currentFilters.categories.length > 0 && !currentFilters.categories.includes(book.category)) return false;
        if (book.price > currentFilters.maxPrice) return false;
        if (currentFilters.search && !book.name.toLowerCase().includes(currentFilters.search.toLowerCase())) return false;
        return true;
      });
    }

    function sortBooks(books) {
      switch (sortBy) {
        case 'price-low':
          return books.sort((a, b) => a.price - b.price);
        case 'price-high':
          return books.sort((a, b) => b.price - a.price);
        case 'newest':
          return books.sort((a, b) => b.name.localeCompare(a.name)); // Assuming newer books have higher names or something
        case 'best-selling':
          return books.sort(() => Math.random() - 0.5); // Random for demo
        default:
          return books;
      }
    }

    function renderBooks() {
      const filtered = filterBooks();
      const sorted = sortBooks(filtered);
      const grid = document.getElementById('products-grid');
      grid.innerHTML = '';
      sorted.forEach(book => {
        grid.appendChild(book.element);
      });
      // Update showing count
      document.querySelector('.text-base.text-gray-700').textContent = `Showing ${sorted.length} results`;
    }

    // Category filters
    Object.keys(categoryCheckboxes).forEach(cat => {
      categoryCheckboxes[cat].addEventListener('change', () => {
        currentFilters.categories = Object.keys(categoryCheckboxes).filter(c => categoryCheckboxes[c].checked);
        renderBooks();
      });
    });

    // Price range
    priceRange.addEventListener('input', (e) => {
      currentFilters.maxPrice = parseInt(e.target.value);
      document.getElementById('priceValue').textContent = `₹${currentFilters.maxPrice}`;
      renderBooks();
    });

    // Sort
    sortSelect.addEventListener('change', (e) => {
      sortBy = e.target.value;
      renderBooks();
    });

    // Search
    searchInput.addEventListener('input', (e) => {
      currentFilters.search = e.target.value;
      renderBooks();
      showSuggestions();
    });

    function showSuggestions() {
      const query = currentFilters.search.toLowerCase();
      if (!query) {
        suggestions.classList.add('hidden');
        return;
      }
      const matches = bookElements.map(getBookData).filter(book => book.name.toLowerCase().includes(query)).slice(0, 5);
      suggestions.innerHTML = matches.map(book => `<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer">${book.name}</div>`).join('');
      suggestions.classList.remove('hidden');
      suggestions.querySelectorAll('div').forEach((div, i) => {
        div.addEventListener('click', () => {
          searchInput.value = matches[i].name;
          currentFilters.search = matches[i].name;
          renderBooks();
          suggestions.classList.add('hidden');
        });
      });
    }

    // Hide suggestions on outside click
    document.addEventListener('click', (e) => {
      if (!searchInput.contains(e.target) && !suggestions.contains(e.target)) {
        suggestions.classList.add('hidden');
      }
    });

    // Initial render
    renderBooks();
  </script>

  <!-- Add to Cart Script -->
  <script>
    // Check if user is logged in
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    const shouldLoadFromDB = <?php echo isset($_SESSION['cart_loaded']) ? 'true' : 'false'; ?>;

    // Initialize cart from localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Load cart from database if user just logged in
    if (isLoggedIn && shouldLoadFromDB) {
      loadCartFromDB();
      <?php unset($_SESSION['cart_loaded']); ?>
    } else if (isLoggedIn) {
      // Sync local cart to database on page load
      saveCartToDB();
    }

    // Function to load cart from database
    async function loadCartFromDB() {
      try {
        const response = await fetch('Cart/cart_api.php?action=load');
        const data = await response.json();
        
        if (data.success && data.cart) {
          cart = data.cart;
          localStorage.setItem("cart", JSON.stringify(cart));
          updateCartBadge();
        }
      } catch (error) {
        console.error('Error loading cart from database:', error);
      }
    }

    // Function to save cart to database
    async function saveCartToDB() {
      if (!isLoggedIn) return;
      
      try {
        await fetch('Cart/cart_api.php?action=save', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(cart)
        });
      } catch (error) {
        console.error('Error saving cart to database:', error);
      }
    }

    // Modal elements
    const modal = document.getElementById("quantityModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalPrice = document.getElementById("modalPrice");
    const quantityInput = document.getElementById("quantityInput");
    const decreaseBtn = document.getElementById("decreaseQty");
    const increaseBtn = document.getElementById("increaseQty");
    const confirmBtn = document.getElementById("confirmAddBtn");
    const cancelBtn = document.getElementById("cancelBtn");

    let currentProduct = null;

    // Update cart badge count
    function updateCartBadge() {
      const badge = document.getElementById("cart-badge");
      let totalItems = 0;
      cart.forEach(item => {
        totalItems += item.quantity || 1;
      });
      badge.textContent = totalItems;
    }

    // Show notification
    function showNotification(message) {
      const notification = document.createElement("div");
      notification.className = "fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50";
      notification.textContent = message;
      document.body.appendChild(notification);
      
      setTimeout(() => {
        notification.remove();
      }, 3000);
    }

    // Initialize page
    updateCartBadge();

    // Open quantity modal
    document.querySelectorAll(".add-to-cart").forEach(button => {
      button.addEventListener("click", function(e) {
        e.preventDefault();
        
        currentProduct = {
          name: this.getAttribute("data-name"),
          price: parseInt(this.getAttribute("data-price"))
        };

        modalTitle.textContent = currentProduct.name;
        modalPrice.textContent = "₹" + currentProduct.price;
        quantityInput.value = "1";
        modal.classList.remove("hidden");
      });
    });

    // Increase quantity
    increaseBtn.addEventListener("click", () => {
      quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    // Decrease quantity
    decreaseBtn.addEventListener("click", () => {
      if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    });

    // Confirm add to cart
    confirmBtn.addEventListener("click", () => {
      if (currentProduct) {
        const quantity = parseInt(quantityInput.value);
        
        // Check if product already in cart
        const existingItem = cart.find(item => item.name === currentProduct.name);
        
        if (existingItem) {
          existingItem.quantity += quantity;
        } else {
          cart.push({
            name: currentProduct.name,
            price: currentProduct.price,
            quantity: quantity
          });
        }
        
        // Save to localStorage
        localStorage.setItem("cart", JSON.stringify(cart));
        
        // Save to database if logged in
        saveCartToDB();
        
        // Update badge
        updateCartBadge();
        
        // Close modal
        modal.classList.add("hidden");
        
        // Show confirmation
        showNotification(`${quantity} × ${currentProduct.name} added to cart!`);
      }
    });

    // Cancel button
    cancelBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
    });

    // Close modal when clicking outside
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.classList.add("hidden");
      }
    });

    // Price Range Slider - removed, now in filtering script
  </script>

</body>
</html>