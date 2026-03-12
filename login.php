<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Sahitya Sangam</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', sans-serif; }
    h1,h2 { font-family: 'Playfair Display', serif; }
  </style>
</head>

<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-rose-50 min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">

    <h1 class="text-3xl font-bold text-center text-gray-800">Welcome Back</h1>
    <p class="text-center text-gray-500 mt-2">Login to your account</p>

<form action="includes/auth/loginprocess.php" method="POST" class="mt-6 space-y-4">

  <input type="email" name="email" placeholder="Email Address"
    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">

  <input type="password" name="password" placeholder="Password"
    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">

  <div class="flex justify-between items-center text-sm">
    <label class="flex items-center space-x-2">
      <input type="checkbox" name="remember">
      <span>Remember me</span>
    </label>
    <a href="#" class="text-amber-600 hover:underline">Forgot password?</a>
  </div>

  <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700">
    Login
  </button>

</form>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">
      Don’t have an account?
      <a href="register.php" class="text-amber-600 hover:underline">Register</a>
    </p>

  </div>

</body>
</html>