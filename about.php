<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About — Sahitya Sangam</title>

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

    /* Founder Card Hover Effects */
    .founder-card {
      transition: all 0.3s ease;
      border: 2px solid #f59e0b;
    }

    .founder-card:hover {
      border-color: #d97706 !important;
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(217, 119, 6, 0.4);
    }

    .founder-card img {
      transition: all 0.3s ease;
    }

    .founder-card:hover img {
      transform: scale(1.08);
      filter: brightness(1.05);
    }

    /* Vision Box Hover Effect */
    .vision-box {
      transition: all 0.3s ease;
    }

    .vision-box:hover {
      border-color: #d97706 !important;
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(217, 119, 6, 0.3);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-rose-50">

  <!-- Navbar -->
<nav class="enhanced-nav sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="logo text-3xl font-bold cursor-pointer">Sahitya Sangam</h1>

  <div class="hidden md:flex space-x-5 absolute left-1/2 transform -translate-x-1/2">
    <a href="index.php" class="nav-link text-gray-700 hover:text-amber-600">Home</a>
    <a href="about.php" class="nav-link text-amber-600 font-medium">About Us</a>
    <a href="authors.php" class="nav-link text-gray-700 hover:text-amber-600">Authors</a>
    <a href="products.php" class="nav-link text-gray-700 hover:text-amber-600">Books</a>
    <a href="catalog.php" class="nav-link text-gray-700 hover:text-amber-600">Catalog</a>
    <a href="contact.php" class="nav-link text-gray-700 hover:text-amber-600">Contact</a>
  </div>
  <div class="flex items-center space-x-3">

<?php if(isset($_SESSION['user_name'])): ?>

  <!-- User -->
  <div class="user-badge flex items-center gap-2 text-gray-800 font-semibold">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 21V18.5C4 15.4624 6.46243 13 9.5 13H12.8513C15.307 13 17.4651 11.3721 18.1397 9.01097L18.7454 6.89097C18.8961 6.3636 19.3781 6 19.9266 6C20.7258 6 21.3122 6.75106 21.1184 7.5264L19.3638 14.5448C19.15 15.4 18.3816 16 17.5 16M8 21V18M16 6.5C16 8.70914 14.2091 10.5 12 10.5C9.79086 10.5 8 8.70914 8 6.5C8 4.29086 9.79086 2.5 12 2.5C14.2091 2.5 16 4.29086 16 6.5Z" stroke="#d97706" stroke-linecap="round" stroke-width="1.4"/></svg>
    <span><?php echo $_SESSION['user_name']; ?></span>
  </div>

  <!-- Logout -->
<a href="Auth/logout.php"
   class="btn-logout px-5 py-2 text-sm text-white rounded-lg font-medium">
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

</div>
</div>
</nav>


  <!-- Hero -->
  <!-- HERO / PAGE HEADER -->
<section class="bg-[#e6d3a3] py-8 text-center">
  <h1 class="text-3xl font-semibold text-orange-600">About Us</h1>
  <p class="text-sm text-gray-700 mt-2 max-w-xl mx-auto">
    The story of Sahitya Sangam, a journey of literary excellence and cultural preservation.
  </p>
</section>


<!-- INTRO + HISTORY WITH IMAGE -->
<section class="px-12 py-10">
  
  <!-- CENTERED IMAGE -->
  <div class="flex justify-center mb-8">
    <img src="Images/Three Pillars of Sahitya Sangam/Bapa with Janakbhai Kiritbhai Group Photo to enlarge (EDT).jpg" 
         alt="Sahitya Sangam Team" 
         class="rounded-xl shadow-lg border-4 border-amber-600 max-w-2xl w-full object-cover">
  </div>

  <!-- TWO BOXES GRID -->
  <div class="grid grid-cols-2 gap-8 items-stretch">
    <!-- LEFT TEXT -->
    <div class="vision-box bg-[#efe4c8] border-2 border-amber-600 rounded-lg p-6 space-y-4 h-full flex flex-col">
      <div class="flex-1">
        <h2 class="text-orange-600 font-semibold mb-2">Introduction</h2>
        <p class="text-sm text-gray-700 leading-relaxed">
          Sahitya Sangam has been a beacon of literature in Gujarat for over five decades.
          Established with the sole purpose of promoting reading culture, we have grown
          from a small bookshop to a premier publishing house and distributor of fine literature.
          Our shelves house thousands of titles ranging from classical Gujarati literature
          to modern world masterpieces.
        </p>
      </div>

      <hr>

      <div class="flex-1">
        <h2 class="text-orange-600 font-semibold mb-2">History</h2>
        <p class="text-sm text-gray-700 leading-relaxed">
          Founded in the bustling streets of Surat, Sahitya Sangam began its journey in 1970.
          Despite challenges, our commitment to quality and affordable literature helped us
          gain the trust of readers and authors alike. Over the years, we have published
          over 500 titles and organized countless literary events to foster a community of readers.
        </p>
      </div>
    </div>

    <!-- RIGHT VISION MISSION OBJECTIVE -->
    <div class="vision-box bg-[#efe4c8] border-2 border-amber-600 rounded-lg p-6 space-y-4 h-full flex flex-col">
      <div class="flex-1">
        <h3 class="text-orange-600 font-semibold">Vision</h3>
        <p class="text-sm text-gray-700">
          To be the most trusted bridge between authors and readers,
          preserving our cultural heritage through the written word.
        </p>
      </div>

      <hr>

      <div class="flex-1">
        <h3 class="text-orange-600 font-semibold">Mission</h3>
        <p class="text-sm text-gray-700">
          To publish high-quality literature, encourage new authors,
          and make books accessible to every household.
        </p>
      </div>

      <hr>

      <div class="flex-1">
        <h3 class="text-orange-600 font-semibold">Objective</h3>
        <p class="text-sm text-gray-700">
          Cultivate a reading habit in the younger generation and ensure
          the longevity of regional languages.
        </p>
      </div>
    </div>
  </div>

</section>


<!-- TEAM / PILLARS -->
<section class="px-12 pb-12">
  <h2 class="text-center text-xl font-semibold mb-8">
    The Three Pillars of Sahitya Sangam
  </h2>

  <div class="grid grid-cols-3 gap-6">

    <!-- CARD 1 -->
    <div class="founder-card bg-[#efe4c8] rounded shadow overflow-hidden text-center border-4 border-amber-700">
      <div class="w-full h-96 overflow-hidden">
        <img src="Images/Three Pillars of Sahitya Sangam/Nanubhai Naik.jpg" class="w-full h-full object-cover object-center">
      </div>
      <div class="p-4">
        <h3 class="text-orange-600 font-semibold">Nanubhai Naik</h3>
        <p class="text-xs text-gray-500 uppercase">Founder</p>
        <p class="text-xs text-gray-600 mt-2">
          The visionary who laid the foundation of Sahitya Sangam with a dream to spread knowledge.
        </p>
      </div>
    </div>

    <!-- CARD 2 -->
    <div class="founder-card bg-[#efe4c8] rounded shadow overflow-hidden text-center border-4 border-amber-700">
      <div class="w-full h-96 overflow-hidden">
        <img src="Images/Three Pillars of Sahitya Sangam/Janakbhai Naik.jpg" class="w-full h-full object-cover object-center">
      </div>
      <div class="p-4">
        <h3 class="text-orange-600 font-semibold">Janakbhai Naik</h3>
        <p class="text-xs text-gray-500 uppercase">Director</p>
        <p class="text-xs text-gray-600 mt-2">
          Took the legacy forward by expanding our reach and introducing modern publishing standards.
        </p>
      </div>
    </div>

    <!-- CARD 3 -->
    <div class="founder-card bg-[#efe4c8] rounded shadow overflow-hidden text-center border-4 border-amber-700">
      <div class="w-full h-96 overflow-hidden">
        <img src="Images/Three Pillars of Sahitya Sangam/Kirtibhai_Naik.jpeg" class="w-full h-full object-cover object-center">
      </div>
      <div class="p-4">
        <h3 class="text-orange-600 font-semibold">Kirtibhai Naik</h3>
        <p class="text-xs text-gray-500 uppercase">Managing Director</p>
        <p class="text-xs text-gray-600 mt-2">
          The modern face of Sahitya Sangam, blending tradition with technology.
        </p>
      </div>
    </div>

  </div>
</section>

<section class="px-12 pb-12">
  <h2 class="text-center text-xl font-semibold mb-8">
    Achievements and Awards
  </h2>

  <div class="flex justify-center gap-10">

    <!-- CARD 1 -->
    <div class="founder-card bg-[#efe4c8] rounded shadow overflow-hidden text-center border-4 border-amber-700">
      <div class="w-[350px] h-96 overflow-hidden">
        <img src="Images/About Us/Achievement & Award/Achievement & Award-1.jpg"
             class="w-full h-full object-cover object-center">
      </div>
    </div>

    <!-- CARD 2 -->
    <div class="founder-card bg-[#efe4c8] rounded shadow overflow-hidden text-center border-4 border-amber-700">
      <div class="w-[350px] h-96 overflow-hidden">
        <img src="Images/About Us/Achievement & Award/Achievement & Award-2.jpg"
             class="w-full h-full object-cover object-center">
      </div>
    </div>

  </div>
</section>

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
</body>
</html>