<?php
session_start();

// Catalog images
$imageDir = 'Images/About Us/Sahitya Sangam Catalog (2025-2026)/';
$images = [];
for ($i = 1; $i <= 87; $i++) {
    $num = str_pad($i, 3, '0', STR_PAD_LEFT);
    $images[] = "Sahitya Sangam Catalog (2025-2026)_{$num}.jpg";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sahitya Sangam — Catalog</title>

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

.btn-outline {
  border: 2px solid #d97706;
  background: transparent;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn-outline::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
  transition: width 0.3s ease;
  z-index: -1;
}

.btn-outline:hover::before {
  width: 100%;
}

.btn-outline:hover {
  color: white !important;
  border-color: #f59e0b;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px -1px rgba(217, 119, 6, 0.3);
}

.btn-logout {
  background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
  box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.3);
  transition: all 0.3s ease;
}

.btn-logout:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px -2px rgba(220, 38, 38, 0.4);
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

/* Genre Card Styles */
.genre-card {
  position: relative;
  overflow: hidden;
  border-radius: 1rem;
  transition: all 0.4s ease;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  cursor: pointer;
  border: 2px solid #fde68a;
}

.genre-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
  border-color: #f59e0b;
}

.genre-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.genre-card:hover img {
  transform: scale(1.1);
}

.genre-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.2) 100%);
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 1.5rem;
  transition: all 0.4s ease;
}

.genre-card:hover .genre-overlay {
  background: linear-gradient(to top, rgba(217, 119, 6, 0.95) 0%, rgba(245, 158, 11, 0.7) 50%, rgba(251, 191, 36, 0.4) 100%);
}

.genre-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: white;
  margin-bottom: 0.5rem;
  transform: translateY(0);
  transition: transform 0.4s ease;
}

.genre-card:hover .genre-title {
  transform: translateY(-10px);
}

.genre-description {
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.875rem;
  line-height: 1.5;
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.4s ease;
}

.genre-card:hover .genre-description {
  opacity: 1;
  transform: translateY(0);
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
}

.footer-link:hover {
  color: white;
  transform: translateX(5px);
}

.social-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  backdrop-filter: blur(4px);
}

.social-icon:hover {
  background: white;
  transform: translateY(-3px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.social-icon:hover span {
  color: #d97706;
}
</style>
</head>

<body class="bg-[#f3ead7] text-gray-800">

  <!-- NAVBAR -->
  <nav class="enhanced-nav sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center gap-4">

      <h1 class="logo text-3xl font-bold cursor-pointer flex-shrink-0">Sahitya Sangam</h1>

      <div class="space-x-5 hidden lg:flex">
        <a href="index.php" class="nav-link text-gray-700 hover:text-amber-600">Home</a>
        <a href="about.php" class="nav-link text-gray-700 hover:text-amber-600">About Us</a>
        <a href="authors.php" class="nav-link text-gray-700 hover:text-amber-600">Authors</a>
        <a href="products.php" class="nav-link text-gray-700 hover:text-amber-600">Books</a>
        <a href="catalog.php" class="nav-link text-gray-700 hover:text-amber-600">Catalog</a>
        <a href="contact.php" class="nav-link text-gray-700 hover:text-amber-600">Contact</a>
      </div>

      <div class="space-x-2 flex items-center flex-shrink-0">

        <?php if(isset($_SESSION['user_name'])): ?>

          <!-- User -->
          <div class="user-badge flex items-center gap-2 text-gray-800 font-semibold">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 21V18.5C4 15.4624 6.46243 13 9.5 13H12.8513C15.307 13 17.4651 11.3721 18.1397 9.01097L18.7454 6.89097C18.8961 6.3636 19.3781 6 19.9266 6C20.7258 6 21.3122 6.75106 21.1184 7.5264L19.3638 14.5448C19.15 15.4 18.3816 16 17.5 16M8 21V18M16 6.5C16 8.70914 14.2091 10.5 12 10.5C9.79086 10.5 8 8.70914 8 6.5C8 4.29086 9.79086 2.5 12 2.5C14.2091 2.5 16 4.29086 16 6.5Z" stroke="#d97706" stroke-linecap="round" stroke-width="1.4"/></svg>
            <span><?php echo $_SESSION['user_name']; ?></span>
          </div>

          <!-- Logout -->
          <a href="Auth/logout.php" class="btn-logout px-5 py-2 text-sm text-white rounded-lg font-medium">
            Logout
          </a>

        <?php else: ?>

          <a href="login.php" class="btn-outline px-5 py-2 text-sm text-amber-700 rounded-lg font-medium relative z-10">
            Login
          </a>

          <a href="register.php" class="btn-primary px-5 py-2 text-sm text-white rounded-lg font-medium relative">
            Register
          </a>

        <?php endif; ?>

      </div>

    </div>
  </nav>

  <!-- HERO / PAGE HEADER -->
  <section class="bg-[#e6d3a3] py-8 text-center">
    <h1 class="text-3xl font-semibold text-orange-600">Explore Our Book Catalog</h1>
    <p class="text-sm text-gray-700 mt-2 max-w-xl mx-auto">
      Discover the perfect genre for your next literary adventure. From timeless classics to modern masterpieces, we have something for every reader.
    </p>
  </section>

  <!-- GENRES GRID -->
  <section class="max-w-7xl mx-auto px-6 py-16">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="genreGrid">
      <?php foreach ($images as $index => $image): ?>
      <div class="genre-card h-80 cursor-pointer" onclick="openModal('<?php echo $imageDir . $image; ?>', 'Catalog Page <?php echo $index + 1; ?>')">
        <img src="<?php echo $imageDir . $image; ?>" alt="Catalog Page <?php echo $index + 1; ?>">
      </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-12">
      <h2 class="text-4xl font-bold text-gray-800 mb-3">Browse Our Catalog</h2>
      <p class="text-gray-600 text-lg mb-6">Explore our comprehensive 2025-2026 catalog featuring a wide selection of literary works</p>
      
      <!-- Download Button -->
      <a href="Images/About Us/Sahitya Sangam Catalog (2025-2026)/Sahitya Sangam Catalog (2025-2026).pdf" download="Sahitya Sangam Catalog (2025-2026).pdf" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-500 text-white px-6 py-3 rounded-lg font-semibold hover:from-amber-700 hover:to-amber-600 transition-all shadow-lg hover:shadow-xl hover:scale-105">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M7 10L12 15M12 15L17 10M12 15V3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Download Genre Catalog PDF
      </a>
      
      <!-- Download Status -->
      <div id="downloadStatus" class="mt-4 text-sm font-medium hidden"></div>
    </div>

  </section>

  <!-- FOOTER -->
  <footer class="enhanced-footer text-white">

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

  </footer>

  <!-- jsPDF library for PDF generation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script>
    function openModal(src, alt) {
      document.getElementById('modalImage').src = src;
      document.getElementById('modalImage').alt = alt;
      document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('imageModal').classList.add('hidden');
    }

    async function downloadAllImages() {
      const button = event.target.closest('button');
      const statusDiv = document.getElementById('downloadStatus');
      const genreCards = document.querySelectorAll('.genre-card img');
      
      // Disable button and show status
      button.disabled = true;
      button.classList.add('opacity-50', 'cursor-not-allowed');
      statusDiv.classList.remove('hidden');
      statusDiv.className = 'mt-4 text-sm font-medium text-blue-600';
      statusDiv.textContent = `Preparing to create PDF with ${genreCards.length} images...`;
      
      try {
        // Initialize jsPDF
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF({
          orientation: 'portrait',
          unit: 'mm',
          format: 'a4'
        });
        
        let addedCount = 0;
        
        for (let i = 0; i < genreCards.length; i++) {
          const img = genreCards[i];
          const imgUrl = img.src;
          const altText = img.alt || `Genre ${i + 1}`;
          
          statusDiv.textContent = `Processing ${i + 1} of ${genreCards.length}: ${altText}...`;
          
          try {
            // Fetch the image
            const response = await fetch(imgUrl);
            const blob = await response.blob();
            
            // Convert blob to base64
            const base64 = await new Promise((resolve) => {
              const reader = new FileReader();
              reader.onloadend = () => resolve(reader.result);
              reader.readAsDataURL(blob);
            });
            
            // Add new page for each image (except the first one)
            if (i > 0) {
              pdf.addPage();
            }
            
            // Add title for each genre
            pdf.setFontSize(20);
            pdf.setTextColor(217, 119, 6); // amber-600 color
            pdf.text(altText, 105, 20, { align: 'center' });
            
            // Add image to PDF (centered, with proper aspect ratio)
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            const imgWidth = 160; // width in mm
            const imgHeight = 120; // height in mm
            const x = (pageWidth - imgWidth) / 2;
            const y = 35; // position below title
            
            pdf.addImage(base64, 'JPEG', x, y, imgWidth, imgHeight);
            
            addedCount++;
            
          } catch (error) {
            console.error(`Failed to add ${altText} to PDF:`, error);
          }
        }
        
        // Show completion message
        statusDiv.className = 'mt-4 text-sm font-medium text-green-600';
        statusDiv.textContent = `Creating PDF with ${addedCount} images...`;
        
        // Save the PDF
        pdf.save('Sahitya_Sangam_Genre_Catalog.pdf');
        
        statusDiv.textContent = `✓ Successfully created PDF with ${addedCount} genre images!`;
        
      } catch (error) {
        console.error('Failed to create PDF:', error);
        statusDiv.className = 'mt-4 text-sm font-medium text-red-600';
        statusDiv.textContent = `✗ Error creating PDF. Please try again.`;
      }
      
      // Re-enable button
      button.disabled = false;
      button.classList.remove('opacity-50', 'cursor-not-allowed');
      
      // Hide status after 5 seconds
      setTimeout(() => {
        statusDiv.classList.add('hidden');
      }, 5000);
    }
  </script>

  <!-- Image Modal -->
  <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden" onclick="closeModal()">
    <div class="relative max-w-4xl max-h-full p-4" onclick="event.stopPropagation()">
      <img id="modalImage" src="" alt="" class="max-w-full max-h-full">
      <button onclick="closeModal()" class="absolute top-2 right-2 text-white text-2xl bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center hover:bg-opacity-75 transition">&times;</button>
    </div>
  </div>

</body>
</html>

