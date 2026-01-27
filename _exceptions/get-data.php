<?php
header('Content-Type: application/json');
require_once("../includes/config.php"); // DB connection

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$data   = [];

if ($search !== '') {

    $searchEsc = mysqli_real_escape_string($link1, $search);
    $result    = false;


    if (ctype_digit($searchEsc)) {
        $id=(int)$searchEsc;
        $sql = "SELECT * FROM admin_users WHERE id = $id LIMIT 10";
        $result = mysqli_query($link1, $sql);
    }


    if (!$result || mysqli_num_rows($result) === 0) {
        $sql = "SELECT * FROM admin_users WHERE username LIKE '%$searchEsc%' LIMIT 10";
        $result = mysqli_query($link1, $sql);
    }

    if (mysqli_num_rows($result) === 0) {
        $sql = "SELECT * FROM admin_users WHERE emailid LIKE '%$searchEsc%' LIMIT 10";
        $result = mysqli_query($link1, $sql);
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
else{
    $sql="SELECT * FROM admin_users";
    $result=mysqli_query($link1,$sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode([
    "success" => true,
    "query"   => $search,
    "count"   => count($data),
    "data"    => $data
]);
