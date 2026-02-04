<?php
$page_type = "insecure";
require_once("security/backend.php");
$arr_browsers = ["Firefox", "Chrome", "Safari", "Opera", "MSIE", "Trident", "Edge"];

$agent = $_SERVER['HTTP_USER_AGENT'];
 
$user_browser = '';
foreach ($arr_browsers as $browser) {
    if (strpos($agent, $browser) !== false) {
        $user_browser = $browser;
        break;
    }   
}
switch ($user_browser) {
    case 'MSIE':
        $user_browser = 'Internet Explorer';
        break;
 
    case 'Trident':
        $user_browser = 'Internet Explorer';
        break;
 
    case 'Edge':
        $user_browser = 'Internet Explorer';
        break;
}


require_once("includes/common_function.php");
session_start();
/// check if session is already there then same account should be open
if($_SESSION['userid']){
   if($_SESSION['id_type']=="admin"){
      header("Location:admin/home2.php");
      exit;
   }else if($_SESSION['id_type']=="WH"){
      header("Location:wh/home2.php");
      exit;
   }else{
      header("Location:asp/home2.php");
      exit;
   }
}	
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CRM :: Support System</title>
        <link rel="shortcut icon" href="images/titleimg.png" type="image/png">

        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>

        <script>
            function chk_data() {
                const user = document.getElementById("userid");
                const pwd = document.getElementById("pwd");

                if (user.value.trim() === "") {
                    alert("Please enter your User Id.");
                    user.focus();
                    return false;
                }
                if (pwd.value.trim() === "") {
                    alert("Please enter your Password.");
                    pwd.focus();
                    return false;
                }
                return true;
            }

            function validateEmail(el) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const error = document.getElementById("emailError");

                if (!emailRegex.test(el.value)) {
                    error.classList.remove("hidden");
                    el.classList.add("border-red-500");
                } else {
                    error.classList.add("hidden");
                    el.classList.remove("border-red-500");
                }
            }
        </script>
    </head>

    <body class="min-h-screen bg-white flex items-center justify-center font-sans text-gray-800">

    <!-- Login Card -->
    <div
            class="w-full max-w-md bg-white border border-gray-200 rounded-xl
           shadow-lg hover:shadow-2xl
           transition-all duration-300 ease-out
           transform hover:-translate-y-1
           p-8">

        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="images/canent.png" class="mx-auto w-48">
        </div>

        <!-- PHP MESSAGE (UNCHANGED) -->
        <?php
        if(isset($_SESSION["logres"]["msg"])) {
            $t_color = (isset($_SESSION["logres"]["status"]) && $_SESSION["logres"]["status"] == "success")
                    ? 'text-green-700' : 'text-red-600';

            echo '<div class="mb-4 p-3 rounded-lg bg-gray-100 '.$t_color.' text-sm text-center">'
                    .$_SESSION["logres"]["msg"].'</div>';

            unset($_SESSION["logres"]["msg"]);
        }
        unset($_SESSION["logres"], $_SESSION["otp"]);
        ?>

        <!-- Form -->
        <form id="login_form" name="login_form" method="post"
              action="verify.php" onsubmit="return chk_data()" class="space-y-5">

            <!-- Email -->
            <div>
                <input type="text"
                       name="userid"
                       id="userid"
                       placeholder="Email Address"
                       onchange=""
                       class="w-full px-4 py-3 rounded-md border border-gray-300
                      focus:outline-none focus:ring-1 focus:ring-gray-400
                      transition">
                <p id="emailError" class="hidden text-red-500 text-xs mt-1">
                    Invalid email format
                </p>
            </div>

            <!-- Password -->
            <div>
                <input type="password"
                       name="pwd"
                       id="pwd"
                       placeholder="Password"
                       class="w-full px-4 py-3 rounded-md border border-gray-300
                      focus:outline-none focus:ring-1 focus:ring-gray-400
                      transition">
            </div>

            <!-- Button -->
            <button type="submit"
                    class="w-full bg-gray-900 text-white py-3 rounded-md
                     hover:bg-gray-800
                     transition duration-200">
                Sign In
            </button>
            <!-- Google Sign In -->
            <div class="mt-4">
                <a href="#" onclick="Event.prototype.preventDefault()"
                   class="w-full flex items-center justify-center gap-3
              border border-gray-300 rounded-md py-3
              hover:bg-gray-100 transition">

                    <img src="https://developers.google.com/identity/images/g-logo.png"
                         alt="Google"
                         class="w-5 h-5">

                    <span class="text-sm font-medium text-gray-700">
            Sign in with Google
        </span>
                </a>
            </div>


            <!-- Error -->
            <div class="text-center text-red-600 text-sm">
                <?php echo errorMsg($_REQUEST['msg']); ?>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="absolute bottom-4 text-gray-500 text-xs text-center w-full">
        © Okaya 2025 · Powered by
        <a href="http://www.candoursoft.com/" target="_blank"
           class="text-gray-700 hover:underline">
            Candour Software
        </a>
    </div>

    </body>
    </html>

<?php //}?>