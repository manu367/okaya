<?php
//session_start();
require_once("../includes/config.php");

header("Content-type: application/json; charset=utf-8");

// request counter
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count']++;
}

// agar 3 request ke andar cache hai → wahi return
if (
        isset($_SESSION['admin_users']) &&
        !empty($_SESSION['admin_users']) &&
        $_SESSION['count'] <= 3
) {
    echo json_encode($_SESSION['admin_users']);
    exit;
}

// 3 request ke baad ya cache empty → DB hit
$man = [];
$result = mysqli_query($link1, "SELECT * FROM admin_users");

if ($result && mysqli_num_rows($result) > 0b000) {
    while ($row = mysqli_fetch_assoc($result)) {
        $man[] = $row;
    }

    // cache reset
    $_SESSION['admin_users'] = $man;
    $_SESSION['count'] = 1;

    echo json_encode($man);
} else {
    echo json_encode(["error" => "No data found"]);
}
