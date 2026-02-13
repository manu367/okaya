<?php
http_response_code(404); // Optional: sets HTTP status
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

<div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full text-center">

    <h1 class="text-6xl font-bold text-red-500 mb-4">404</h1>

    <h2 class="text-2xl font-semibold text-gray-800 mb-2">
        Oops! Page Not Found
    </h2>

    <p class="text-gray-500 mb-6">
        The page you are looking for might have been removed or is temporarily unavailable.
    </p>

    <a href="index.php"
       class="inline-block bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
        Go Back Home
    </a>

</div>

</body>
</html>
