<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sahitya Sangam — Contact</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

<style>
body { font-family: 'Inter', sans-serif; }
h1,h2,h3 { font-family: 'Playfair Display', serif; }

/* Enhanced Navbar */
.enhanced-nav {
  background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(243,244,246,0.9) 100%);
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

/* Contact Cards Enhancement */
.contact-card {
  background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%);
  border: 2px solid #fbbf24;
  border-radius: 12px;
  padding: 1.5rem;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.contact-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(217, 119, 6, 0.2);
  border-color: #f59e0b;
}

.contact-icon {
  width: 48px;
  height: 48px;
  background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.25rem;
  font-weight: bold;
  box-shadow: 0 2px 8px rgba(217, 119, 6, 0.3);
  transition: all 0.3s ease;
}

.contact-card:hover .contact-icon {
  transform: rotate(360deg);
  box-shadow: 0 4px 12px rgba(217, 119, 6, 0.5);
}

.info-highlight {
  background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
  border-left: 4px solid #f59e0b;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.map-container {
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
  border: 3px solid #fbbf24;
  transition: all 0.3s ease;
}

.map-container:hover {
  box-shadow: 0 12px 32px rgba(217, 119, 6, 0.25);
  border-color: #f59e0b;
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

  <!-- Navbar -->
<nav class="enhanced-nav sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="logo text-3xl font-bold cursor-pointer">Sahitya Sangam</h1>

  <div class="hidden md:flex space-x-5 absolute left-1/2 transform -translate-x-1/2">
  <a href="index.php" class="nav-link text-gray-700 hover:text-amber-600">Home</a>
  <a href="about.php" class="nav-link text-gray-700 hover:text-amber-600">About Us</a>
  <a href="authors.php" class="nav-link text-gray-700 hover:text-amber-600">Authors</a>
  <a href="products.php" class="nav-link text-gray-700 hover:text-amber-600">Books</a>
  <a href="catalog.php" class="nav-link text-gray-700 hover:text-amber-600">Catalog</a>
  <a href="contact.php" class="nav-link text-amber-600 font-medium">Contact</a>
  </div>

<div class="space-x-3 flex items-center">

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


<!-- TITLE BAR -->
<div class="bg-[#e6d3a3] text-center py-8">
  <h1 class="text-3xl text-orange-600 font-semibold">Contact Us</h1>
  <p class="text-sm text-gray-700 mt-2">
    We’d love to hear from you. Reach out to us for any queries.
  </p>
</div>


<!-- CONTENT -->
<div class="max-w-7xl mx-auto px-6 pt-12 pb-4">

  <!-- Header Section -->
  <div class="info-highlight mb-8">
    <h2 class="text-3xl font-bold text-orange-600 mb-2">Sahitya Sangam</h2>
    <p class="text-gray-700 text-lg">
      Bringing the world of literature to your doorstep.
    </p>
  </div>

  <?php if(isset($_SESSION['success'])): ?>
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
      <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <?php if(isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
      <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <div class="grid md:grid-cols-2 gap-8 mb-0">

  <!-- LEFT INFO - Contact Cards -->
  <div class="space-y-6">

    <!-- Address Card -->
    <div class="contact-card">
      <div class="flex items-start gap-4">
        <div class="contact-icon">
          📍
        </div>
        <div class="flex-1">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Address</h3>
          <p class="text-gray-700 leading-relaxed">
            123 Literature Lane, Book City,<br>
            Gujarat, India - 380001
          </p>
        </div>
      </div>
    </div>

    <!-- Phone Card -->
    <div class="contact-card">
      <div class="flex items-start gap-4">
        <div class="contact-icon">
          📞
        </div>
        <div class="flex-1">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Phone</h3>
          <p class="text-gray-700">
            <span class="font-medium">Landline:</span> 079-12345678<br>
            <span class="font-medium">Mobile:</span> +91 98765 43210
          </p>
        </div>
      </div>
    </div>

    <!-- WhatsApp Card -->
    <div class="contact-card">
      <div class="flex items-start gap-4">
        <div class="contact-icon">
          💬
        </div>
        <div class="flex-1">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">WhatsApp</h3>
          <p class="text-gray-700">
            +91 98765 43210
          </p>
        </div>
      </div>
    </div>

    <!-- Email Card -->
    <div class="contact-card">
      <div class="flex items-start gap-4">
        <div class="contact-icon">
          ✉️
        </div>
        <div class="flex-1">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Email</h3>
          <p class="text-gray-700">
            info@sahityasangam.com
          </p>
        </div>
      </div>
    </div>

  </div>


  <!-- FORM -->
  <div class="bg-[#efe4c8] px-6 pt-6 pb-4 rounded shadow-sm border border-gray-300 flex flex-col justify-center h-full">

    <form method="post" action="includes/process/contact_process.php">
      <h3 class="text-lg font-semibold mb-4">Send us a Message</h3>

      <div class="grid grid-cols-2 gap-4">
        <input type="text" name="first_name" placeholder="First Name" class="border p-2 rounded w-full" required>
        <input type="text" name="last_name" placeholder="Last Name" class="border p-2 rounded w-full" required>
      </div>

      <input type="email" name="email" placeholder="Email Address" class="border p-2 rounded w-full mt-4" required>
      <input type="text" name="contact_number" placeholder="Contact Number" class="border p-2 rounded w-full mt-4" required>
      <input type="text" name="subject" placeholder="Subject" class="border p-2 rounded w-full mt-4" required>

      <textarea name="message" placeholder="Type your message here..." class="border p-2 rounded w-full mt-4 h-32" required></textarea>

      <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 mt-4 rounded w-full">
        Send Message
      </button>
    </form>

  </div>

</div>

</div>


<!-- MAP SECTION -->
<div class="max-w-7xl mx-auto px-6 pb-12 pt-4">
  <div class="text-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Find Us Here</h2>
    <p class="text-gray-600 mt-2">Visit our bookstore at Books For You, Gujarat</p>
  </div>
  <div class="map-container">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.15728255282!2d72.8244283!3d21.1921161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e66e4524aa3%3A0x7921d1dc63cefd30!2sSahitya%20Sangam!5e1!3m2!1sen!2sin!4v1773147737119!5m2!1sen!2sin"  
      width="100%" 
      height="450" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
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
          <span class="text-sm font-bold">insta</span>
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

</footer>

<script>
  // Auto-hide success message after 10 seconds
  setTimeout(function() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
      successMessage.style.transition = 'opacity 1s';
      successMessage.style.opacity = '0';
      setTimeout(() => successMessage.remove(), 1000);
    }
  }, 10000);
</script>

</body>
</html>