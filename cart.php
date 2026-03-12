<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart — Sahitya Sangam</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', sans-serif; }
    h1,h2,h3 { font-family: 'Playfair Display', serif; }
  </style>
</head>

<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-rose-50">

  <!-- Navbar -->
  <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-amber-700">Sahitya Sangam</h1>
      <a href="products.php" class="text-amber-600">← Continue Shopping</a>
    </div>
  </nav>

  <!-- Header -->
  <section class="max-w-5xl mx-auto text-center px-6 py-16">
    <h1 class="text-5xl font-bold text-gray-800">Your Cart</h1>
  </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <!-- Cart Container -->
  <section class="max-w-4xl mx-auto px-6 pb-20">

    <div id="cart-items" class="space-y-4"></div>

    <!-- Subtotal & Total -->
    <div class="mt-8 bg-white p-6 rounded-2xl shadow-sm border-2 border-amber-200 space-y-4">
      <div class="flex justify-between items-center border-b pb-4">
        <h2 class="text-lg font-semibold">Subtotal</h2>
        <span id="subtotal-price" class="text-lg font-bold text-gray-700">₹0</span>
      </div>
      <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">Total</h2>
        <span id="total-price" class="text-3xl font-bold text-amber-600">₹0</span>
      </div>
    </div>

    <button id="checkoutBtn" class="w-full mt-6 bg-amber-600 text-white py-3 rounded-xl hover:bg-amber-700 font-semibold">
      Proceed to Checkout
    </button>

  </section>

  <!-- JS -->
  <script>
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartContainer = document.getElementById("cart-items");
    const totalPriceEl = document.getElementById("total-price");
    const subtotalPriceEl = document.getElementById("subtotal-price");
    const checkoutBtn = document.getElementById("checkoutBtn");

    function renderCart(){
      cartContainer.innerHTML = "";
      let total = 0;

      if(cart.length === 0){
        cartContainer.innerHTML = "<p class='text-center text-gray-500 py-8'>Your cart is empty</p>";
        totalPriceEl.innerText = "₹0";
        subtotalPriceEl.innerText = "₹0";
        return;
      }

      cart.forEach((item, index) => {
        const quantity = item.quantity || 1;
        const amount = item.price * quantity;
        total += amount;

        cartContainer.innerHTML += `
          <div class="bg-white p-6 rounded-xl shadow-sm border-2 border-amber-200">
            <div class="flex justify-between items-start mb-4">
              <div>
                <h3 class="font-semibold text-lg">${item.name}</h3>
                <p class="text-gray-600 text-sm">Price: ₹${item.price}</p>
              </div>
              <button onclick="removeItem(${index})" class="text-red-500 hover:text-red-700 font-semibold">
                ✕ Remove
              </button>
            </div>
            
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <button onclick="decreaseQty(${index})" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100 font-bold">−</button>
                <span class="w-12 text-center font-semibold">${quantity}</span>
                <button onclick="increaseQty(${index})" class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100 font-bold">+</button>
              </div>
              <div class="text-right">
                <p class="text-sm text-gray-600">Amount</p>
                <p class="text-xl font-bold text-amber-600">₹${amount}</p>
              </div>
            </div>
          </div>
        `;
      });

      subtotalPriceEl.innerText = "₹" + total;
      totalPriceEl.innerText = "₹" + total;
    }

    function removeItem(index){
      cart.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
    }

    function increaseQty(index){
      cart[index].quantity = (cart[index].quantity || 1) + 1;
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
    }

    function decreaseQty(index){
      if((cart[index].quantity || 1) > 1){
        cart[index].quantity = (cart[index].quantity || 1) - 1;
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
      }
    }

    // Generate PDF Receipt
    function generateReceipt() {
      if(cart.length === 0) {
        alert("Your cart is empty!");
        return;
      }

      const jsPDFConstructor = (window.jspdf && window.jspdf.jsPDF) ? window.jspdf.jsPDF : (window.jsPDF ? window.jsPDF : null);
      if(!jsPDFConstructor) {
        alert('PDF library not loaded. Please check network or try again.');
        return;
      }
      const doc = new jsPDFConstructor({ orientation: 'portrait', unit: 'mm', format: 'a4' });

      const today = new Date();
      const invoiceDate = today.toLocaleDateString('en-IN');
      const invoiceNo = 'RECEIPT-' + Math.floor(Math.random() * 1000000);

      let yPos = 12;
      const pageHeight = doc.internal.pageSize.getHeight();
      const pageWidth = doc.internal.pageSize.getWidth();
      const margin = 18;
      const maxWidth = pageWidth - (2 * margin);

      // Professional Color Palette
      const brandOrange = [217, 119, 6];
      const brandAmber = [245, 158, 11];
      const brandLight = [251, 191, 36];
      const darkBrown = [120, 53, 15];
      const lightBg = [254, 252, 232];
      const accentBg = [254, 243, 199];
      const white = [255, 255, 255];
      const textDark = [55, 65, 81];
      const borderGray = [229, 231, 235];

      // Elegant Double Border
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(1.2);
      doc.roundedRect(8, 8, pageWidth - 16, pageHeight - 16, 4, 4, 'S');
      
      doc.setDrawColor(...brandLight);
      doc.setLineWidth(0.4);
      doc.roundedRect(11, 11, pageWidth - 22, pageHeight - 22, 3, 3, 'S');

      // Header Section with Premium Design
      yPos = 22;
      
      // Top Accent Bar
      doc.setFillColor(...brandOrange);
      doc.rect(margin, yPos, maxWidth, 2.5, 'F');
      
      yPos += 10;
      
      // Company Name - Bold and Prominent
      doc.setFont('Helvetica', 'bold');
      doc.setFontSize(22);
      doc.setTextColor(...brandOrange);
      doc.text('Sahitya Sangam', margin + 3, yPos);

      // Decorative Corner Element (positioned to avoid overlap)
      doc.setFillColor(...brandLight);
      doc.circle(pageWidth - margin - 8, yPos, 7, 'F');
      doc.setFillColor(...brandOrange);
      doc.circle(pageWidth - margin - 8, yPos, 5, 'F');

      yPos += 7;
      doc.setFontSize(10);
      doc.setTextColor(...darkBrown);
      doc.setFont('Helvetica', 'italic');
      doc.text('Celebrating the Rich Heritage of Literature', margin + 3, yPos);

      yPos += 6;
      doc.setFontSize(8);
      doc.setFont('Helvetica', 'normal');
      doc.setTextColor(...textDark);
      doc.text('Location: Surat, Gujarat  |  Phone: +91 261 1234567  |  Email: info@sahityasangam.com', margin + 3, yPos);

      yPos += 10;
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(0.5);
      doc.line(margin, yPos, pageWidth - margin, yPos);

      // RECEIPT Banner
      yPos += 10;
      const bannerHeight = 14;
      
      // Gradient effect simulation with multiple rectangles
      doc.setFillColor(217, 119, 6);
      doc.roundedRect(margin, yPos, maxWidth, bannerHeight, 3, 3, 'F');
      
      doc.setFillColor(245, 158, 11);
      doc.rect(margin + 2, yPos + 2, maxWidth - 4, bannerHeight - 4, 'F');
      
      doc.setFillColor(217, 119, 6);
      doc.roundedRect(margin + 1, yPos + 1, maxWidth - 2, bannerHeight - 2, 2, 2, 'F');
      
      doc.setFontSize(18);
      doc.setTextColor(...white);
      doc.setFont('Helvetica', 'bold');
      doc.text('PURCHASE RECEIPT', pageWidth / 2, yPos + 9, { align: 'center' });

      // Information Boxes Section
      yPos += 20;
      const boxWidth = (maxWidth - 8) / 3;
      const boxHeight = 18;
      
      // Box 1 - Receipt Number
      doc.setFillColor(...lightBg);
      doc.roundedRect(margin, yPos, boxWidth, boxHeight, 3, 3, 'F');
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(0.8);
      doc.roundedRect(margin, yPos, boxWidth, boxHeight, 3, 3, 'S');
      
      doc.setFontSize(8);
      doc.setTextColor(...darkBrown);
      doc.setFont('Helvetica', 'bold');
      doc.text('RECEIPT NO.', margin + 4, yPos + 6);
      
      doc.setFontSize(11);
      doc.setTextColor(...brandOrange);
      doc.setFont('Helvetica', 'bold');
      doc.text(invoiceNo, margin + 4, yPos + 13);

      // Box 2 - Date
      const box2X = margin + boxWidth + 4;
      doc.setFillColor(...lightBg);
      doc.roundedRect(box2X, yPos, boxWidth, boxHeight, 3, 3, 'F');
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(0.8);
      doc.roundedRect(box2X, yPos, boxWidth, boxHeight, 3, 3, 'S');
      
      doc.setFontSize(8);
      doc.setTextColor(...darkBrown);
      doc.setFont('Helvetica', 'bold');
      doc.text('DATE', box2X + 4, yPos + 6);
      
      doc.setFontSize(11);
      doc.setTextColor(...brandOrange);
      doc.setFont('Helvetica', 'bold');
      doc.text(invoiceDate, box2X + 4, yPos + 13);

      // Box 3 - Status
      const box3X = margin + (boxWidth * 2) + 8;
      doc.setFillColor(...accentBg);
      doc.roundedRect(box3X, yPos, boxWidth, boxHeight, 3, 3, 'F');
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(0.8);
      doc.roundedRect(box3X, yPos, boxWidth, boxHeight, 3, 3, 'S');
      
      doc.setFontSize(8);
      doc.setTextColor(...darkBrown);
      doc.setFont('Helvetica', 'bold');
      doc.text('STATUS', box3X + 4, yPos + 6);
      
      doc.setFontSize(10);
      doc.setTextColor(...brandOrange);
      doc.setFont('Helvetica', 'bold');
      doc.text('* Payment Received', box3X + 4, yPos + 13);

      // Products Table
      yPos += 24;
      
      // Table Header with Professional Styling
      doc.setFillColor(180, 83, 9);
      doc.roundedRect(margin, yPos, maxWidth, 10, 2, 2, 'F');

      doc.setFontSize(9.5);
      doc.setTextColor(...white);
      doc.setFont('Helvetica', 'bold');
      
      // Define column positions for proper alignment
      const colProductName = margin + 5;
      const colUnitPrice = margin + 110;
      const colQty = margin + 140;
      const colAmount = pageWidth - margin - 5;
      
      doc.text('Product Name', colProductName, yPos + 6.5);
      doc.text('Unit Price', colUnitPrice, yPos + 6.5, { align: 'right' });
      doc.text('Qty', colQty, yPos + 6.5, { align: 'center' });
      doc.text('Amount', colAmount, yPos + 6.5, { align: 'right' });

      yPos += 12;
      let totalAmount = 0;

      // Product Rows with Enhanced Design
      cart.forEach((item, index) => {
        const quantity = item.quantity || 1;
        const amount = item.price * quantity;
        totalAmount += amount;

        // Alternating row colors with rounded corners
        if (index % 2 === 0) {
          doc.setFillColor(...lightBg);
          doc.roundedRect(margin, yPos - 4, maxWidth, 10, 1, 1, 'F');
        }

        doc.setFontSize(9.5);
        doc.setTextColor(...textDark);
        doc.setFont('Helvetica', 'normal');

        const productName = item.name.length > 48 ? item.name.substring(0, 45) + '...' : item.name;
        doc.text(productName, colProductName, yPos);
        
        doc.setFont('Helvetica', 'bold');
        doc.setTextColor(...brandOrange);
        doc.text('Rs. ' + item.price.toLocaleString('en-IN'), colUnitPrice, yPos, { align: 'right' });
        
        doc.setFont('Helvetica', 'normal');
        doc.setTextColor(...textDark);
        doc.text(quantity.toString(), colQty, yPos, { align: 'center' });
        
        doc.setFont('Helvetica', 'bold');
        doc.setFontSize(10);
        doc.setTextColor(...brandOrange);
        doc.text('Rs. ' + amount.toLocaleString('en-IN'), colAmount, yPos, { align: 'right' });

        // Subtle row divider
        doc.setDrawColor(...borderGray);
        doc.setLineWidth(0.2);
        doc.line(margin + 3, yPos + 4, pageWidth - margin - 3, yPos + 4);

        yPos += 11;
      });

      // Totals Section with Premium Styling
      yPos += 8;
      const totalsBoxWidth = maxWidth;
      const totalsX = margin;
      
      // Subtotal
      doc.setFillColor(...accentBg);
      doc.roundedRect(totalsX, yPos, totalsBoxWidth, 10, 2, 2, 'F');
      
      doc.setFontSize(10);
      doc.setTextColor(...darkBrown);
      doc.setFont('Helvetica', 'bold');
      doc.text('Subtotal:', totalsX + totalsBoxWidth - 75, yPos + 6.5);
      
      doc.setTextColor(...brandOrange);
      doc.text('Rs. ' + totalAmount.toLocaleString('en-IN'), pageWidth - margin - 5, yPos + 6.5, { align: 'right' });

      // Grand Total with Emphasis
      yPos += 12;
      doc.setFillColor(...brandOrange);
      doc.roundedRect(totalsX, yPos, totalsBoxWidth, 13, 2, 2, 'F');
      
      doc.setFontSize(11);
      doc.setTextColor(...white);
      doc.setFont('Helvetica', 'bold');
      doc.text('TOTAL AMOUNT:', totalsX + totalsBoxWidth - 75, yPos + 8.5);
      
      doc.setFontSize(13);
      doc.text('Rs. ' + totalAmount.toLocaleString('en-IN'), pageWidth - margin - 5, yPos + 8.5, { align: 'right' });

      // Appreciation Section
      yPos += 22;
      doc.setFillColor(...lightBg);
      doc.roundedRect(margin, yPos, maxWidth, 20, 4, 4, 'F');
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(0.6);
      doc.roundedRect(margin, yPos, maxWidth, 20, 4, 4, 'S');
      
      doc.setFontSize(12);
      doc.setTextColor(...brandOrange);
      doc.setFont('Helvetica', 'bold');
      doc.text('Thank You for Your Purchase!', pageWidth / 2, yPos + 8, { align: 'center' });
      
      doc.setFontSize(9);
      doc.setTextColor(...textDark);
      doc.setFont('Helvetica', 'normal');
      doc.text('Your support helps us preserve and promote the rich heritage of literature.', pageWidth / 2, yPos + 14, { align: 'center' });

      // Professional Footer
      yPos = pageHeight - 28;
      
      // Top border of footer
      doc.setDrawColor(...brandAmber);
      doc.setLineWidth(0.6);
      doc.line(margin, yPos, pageWidth - margin, yPos);

      yPos += 6;
      
      // Footer content with structured layout
      doc.setFontSize(9);
      doc.setTextColor(...darkBrown);
      doc.setFont('Helvetica', 'bold');
      doc.text('Sahitya Sangam', pageWidth / 2, yPos, { align: 'center' });
      
      yPos += 5;
      doc.setFont('Helvetica', 'normal');
      doc.setTextColor(...textDark);
      doc.setFontSize(8);
      doc.text('Surat, Gujarat | Phone: +91 261 1234567', pageWidth / 2, yPos, { align: 'center' });
      
      yPos += 4;
      doc.text('Website: www.sahityasangam.com | Email: support@sahityasangam.com', pageWidth / 2, yPos, { align: 'center' });
      
      yPos += 4;
      doc.setFontSize(7.5);
      doc.text('Connect with us: Facebook | Twitter | Instagram | YouTube', pageWidth / 2, yPos, { align: 'center' });
      
      yPos += 5;
      doc.setTextColor(...brandOrange);
      doc.setFont('Helvetica', 'italic');
      doc.setFontSize(7);
      doc.text('Copyright 2026 Sahitya Sangam. All rights reserved. | This is a computer-generated receipt and requires no signature.', pageWidth / 2, yPos, { align: 'center' });

      // Save PDF
      doc.save('Sahitya_Sangam_Receipt_' + invoiceNo + '.pdf');
    }

    checkoutBtn.addEventListener('click', generateReceipt);

    renderCart();
  </script>

  <!-- Footer -->
  <footer class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-6 py-6 text-center text-gray-500 text-sm">
      © 2026 Sahitya Sangam. All rights reserved.
    </div>
  </footer>

</body>
</html>