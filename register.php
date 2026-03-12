<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register — Sahitya Sangam</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', sans-serif; }
    h1,h2 { font-family: 'Playfair Display', serif; }
  </style>
</head>

<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-rose-50 min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">

    <h1 class="text-3xl font-bold text-center text-gray-800">Create Account</h1>
    <p class="text-center text-gray-500 mt-2">Join the literary community</p>

<form action="includes/auth/registerprocess.php" method="POST" class="mt-6 space-y-4">

  <input type="text" name="name" placeholder="Full Name"
    class="w-full border rounded-lg px-4 py-2">

  <input type="email" name="email" placeholder="Email Address"
    class="w-full border rounded-lg px-4 py-2">

  <input type="password" name="password" placeholder="Password"
    class="w-full border rounded-lg px-4 py-2">

  <input type="password" name="confirm_password" placeholder="Confirm Password"
    class="w-full border rounded-lg px-4 py-2">

  <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-lg">
    Register
  </button>

</form>

    <p class="text-center text-sm text-gray-600 mt-6">
      Already have an account?
      <a href="login.php" class="text-amber-600 hover:underline">Login</a>
    </p>

  </div>

</body>
</html>