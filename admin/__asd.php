<?php
require_once("../includes/config.php");
if (empty($_SESSION['navigation_a'])) {
    $tab=[];
    $sql="select maintabname , maintabicon from tab_master where status = '1' and tabfor='admin' group by maintabname order by maintabseq";
    $result=mysqli_query($link1,$sql);
    if($result && mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $subtab=[];
            $sql2="select tabid , subtabname , subtabicon , filename from tab_master where status = '1' and tabfor='admin' and  maintabname = '".$row['maintabname']."' order by subtabseq";
            $result2=mysqli_query($link1,$sql2);
            if($result2 && mysqli_num_rows($result2)>0){
                while($row2=mysqli_fetch_assoc($result2)){
                    $subtab[]=[
                        "tabid"=>$row2['tabid'],
                        "subtabname"=>$row2['subtabname'],
                        "subtabicon"=>$row2['subtabicon'],
                        "filename"=>$row2['filename'],
                    ];
                }
            }
            $tab[]=["icon"=>$row['maintabicon'],"tab"=>$row['maintabname'],"sub_tab"=>$subtab];
        }
    }
    $tab[]=["icon"=>'fa-power-off',"tab"=>'logout'];
    $_SESSION['navigation_a']= $tab;
}
$navigation = $_SESSION['navigation_a'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= siteTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Hide Scrollbar but Allow Scroll */
        #sidebar {
            scrollbar-width: none;        /* Firefox */
            -ms-overflow-style: none;     /* IE 10+ */
        }

        #sidebar::-webkit-scrollbar {
            width: 0px;                   /* Chrome, Safari */
            height: 0px;
        }

        /* ---------------- Sidebar Base ---------------- */

        #sidebar button {
            width: 100%;
            text-align: left;
            transition: all 0.25s ease;
            border-left: 4px solid transparent;
        }

        /* Main Menu Hover */
        #sidebar button:hover {
            background-color: rgba(255, 255, 255, 0.34);  /* dark gray */
            border-left: 6px solid green;
            opacity: 0.9;
        }

        /* Main Menu Active */
        #sidebar button.active {
            background-color: #16a34a;
            opacity: 0.9;
            border-left: 4px solid #16a34a;
            color: #fff;
        }


        /* ---------------- Nested Menu ---------------- */

        .menu_nested a {
            display: block;
            padding: 8px 10px;
            border-left: 4px solid transparent;
            transition: all 0.25s ease;
            border-radius: 6px;
        }

        /* Nested Hover */
        .menu_nested a:hover {
            background-color: rgba(255, 255, 255, 0.34);  /* dark gray */
            border-left: 6px solid green;
            opacity: 0.9;
        }

        /* Nested Active */
        .menu_nested a.active {
            background-color: #dc2626;   /* RED */
            border-left: 4px solid #dc2626;
            color: #fff;
        }


    </style>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex h-screen">
    <div id="overlay"
         class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 md:hidden"
         onclick="toggleSidebar()"></div>
    <!-- Sidebar -->
    <aside id="sidebar"
           class="fixed md:static z-40 inset-y-0 left-0 w-64 bg-gray-900
              transform -translate-x-full md:translate-x-0
              transition-transform duration-300 ease-in-out overflow-y-auto">

        <!-- Logo -->
        <div class="flex items-center justify-center py-6 border border-gray-700" style="background-color: white">
            <img src="http://localhost/Okaya/images/blogo.png"
                 alt="Logo"
                 class="h-12 object-contain">
        </div>
        <div class="text-xs leading-5" style="text-align: center;color: whitesmoke">
            <p class="font-semibold">
                Welcome Candour (Admin) (test)
            </p>

            <p class="">
                <?php
                echo date("l, F jS Y");
                ?>
            </p>
        </div>

        <nav class="mt-4 text-sm text-white">

            <?php foreach ($navigation as $index => $menu): ?>

                <?php if (!empty($menu['sub_tab'])): ?>

                    <!-- Main Menu with Submenu -->
                    <div>
                        <button onclick="toggleMenu('menu<?= $index ?>')"
                                class="w-full flex items-center justify-between px-6 py-2 hover:bg-gray-800 transition">

                            <div class="flex items-center gap-3">
                                <i class="fa <?= $menu['icon'] ?> w-4"></i>
                                <span><?= $menu['tab'] ?></span>
                            </div>

                            <i id="menu<?= $index ?>Arrow"
                               class="fa fa-angle-left transition-transform duration-300"></i>
                        </button>

                        <div id="menu<?= $index ?>" class="menu_nested hidden pl-5 mt-1 space-y-1 text-sm">


                        <?php foreach ($menu['sub_tab'] as $sub): ?>
<!--                                <a href="--><?php //= $sub['filename'] ?><!--.php"-->
                            <a href="#"
                                   class="block py-1 hover:text-gray-300 text-xs <?php if($_REQUEST['hid'] == $row_maintab['maintabname']){ echo "active";} ?> ">
                                    <i class="fa <?= $sub['subtabicon'] ?>"></i>
                                    <?= $sub['subtabname'] ?>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </div>

                <?php else: ?>

                    <!-- Single Menu -->
                    <?php if ($menu['tab'] == "logout"): ?>
                        <a href="logout.php"
                           class="flex items-center gap-3 px-6 py-2 hover:bg-gray-800 transition">
                            <i class="fa <?= $menu['icon'] ?> w-4"></i>
                            <span><?= $menu['tab'] ?></span>
                        </a>
                    <?php else: ?>
                        <a href="#"
                           class="flex items-center gap-3 px-6 py-2 hover:bg-gray-800 transition">
                            <i class="fa <?= $menu['icon'] ?> w-4"></i>
                            <span><?= $menu['tab'] ?></span>
                        </a>
                    <?php endif; ?>

                <?php endif; ?>

            <?php endforeach; ?>

        </nav>


    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow px-4 md:px-6 py-4 flex justify-between items-center">

            <!-- Left: Hamburger + Page Title -->
            <div class="flex items-center gap-4">

                <!-- Hamburger (Mobile Only) -->
                <button onclick="toggleSidebar()" class="md:hidden text-gray-700 text-xl">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Page Title -->
                <h1 class="text-lg md:text-xl font-semibold text-gray-800">
                    Users Management
                </h1>
            </div>

            <!-- Right: Notification Icon -->
            <<!-- Right: Notification -->
            <div class="relative">

                <button onclick="toggleNotification()"
                        class="relative text-gray-600 hover:text-blue-600 transition text-xl focus:outline-none">
                    <i class="fa fa-bell"></i>

                    <!-- Badge -->
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs
                     w-5 h-5 flex items-center justify-center rounded-full">
            3
        </span>
                </button>

                <!-- Dropdown -->
                <div id="notificationDropdown"
                     class="hidden absolute right-0 mt-3 w-80 bg-white rounded-lg shadow-lg border z-50">

                    <div class="p-4 border-b font-semibold text-gray-700">
                        Notifications
                    </div>

                    <div class="max-h-64 overflow-y-auto">

                        <!-- Notification Item -->
                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b">
                            <p class="text-sm font-medium text-gray-800">
                                New User Registered
                            </p>
                            <p class="text-xs text-gray-500">
                                2 minutes ago
                            </p>
                        </a>

                        <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b">
                            <p class="text-sm font-medium text-gray-800">
                                Password Changed
                            </p>
                            <p class="text-xs text-gray-500">
                                10 minutes ago
                            </p>
                        </a>

                        <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm font-medium text-gray-800">
                                New Support Ticket
                            </p>
                            <p class="text-xs text-gray-500">
                                1 hour ago
                            </p>
                        </a>

                    </div>

                    <div class="p-3 text-center border-t">
                        <a href="#" class="text-sm text-blue-600 hover:underline">
                            View All Notifications
                        </a>
                    </div>

                </div>

            </div>


        </header>

        <main class="p-6 overflow-y-auto">

            <!-- Table Card -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4 border-b font-semibold text-gray-600">
                    All Users
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">S.No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Login ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                        <!-- Example Static Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">1</td>
                            <td class="px-6 py-4 text-sm">admin01</td>
                            <td class="px-6 py-4 text-sm">admin</td>
                            <td class="px-6 py-4 text-sm">Admin User</td>
                            <td class="px-6 py-4 text-sm">admin@mail.com</td>
                            <td class="px-6 py-4 text-sm">9876543210</td>
                            <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                        Active
                                    </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <button class="text-blue-600 hover:underline">Edit</button>
                                <button class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");
    }

    function toggleMenu(menuId) {
        const menu = document.getElementById(menuId);
        const arrow = document.getElementById(menuId + "Arrow");

        menu.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180");
    }
</script>
<script>
    function toggleNotification() {
        const dropdown = document.getElementById("notificationDropdown");
        dropdown.classList.toggle("hidden");
    }

    // Close when clicking outside
    document.addEventListener("click", function(event) {
        const dropdown = document.getElementById("notificationDropdown");
        const bell = event.target.closest(".fa-bell");

        if (!event.target.closest("#notificationDropdown") && !bell) {
            dropdown.classList.add("hidden");
        }
    });
</script>
<script>
    const navmenu=document.querySelectorAll(".menu_nested a");
    navmenu.forEach((menu) => {
        menu.addEventListener("mouseenter",(e)=>{
            e.preventDefault();
            console.log(e.target);
        });
    })
</script>

</body>
</html>

