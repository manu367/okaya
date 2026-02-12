<?php
require_once("../includes/config.php");

$draw = $_GET['draw'];
$start = $_GET['start'];
$length = $_GET['length'];
$searchValue = $_GET['search']['value'];

$columns = [
    0 => 'userloginid',
    1 => 'userloginid',
    2 => 'locusername',
    3 => 'emailid',
    4 => 'contactmo',
    5 => 'statusid',
    6 => 'mapped_bsi',
    7 => 'mapped_rm',
    8 => 'spare_location_code'
];

$orderColumn = $columns[$_GET['order'][0]['column']];
$orderDir = $_GET['order'][0]['dir'];

$where = "";

if(!empty($searchValue)){
    $where = " WHERE 
        userloginid LIKE '%$searchValue%' OR
        locusername LIKE '%$searchValue%' OR
        emailid LIKE '%$searchValue%' OR
        contactmo LIKE '%$searchValue%'
    ";
}

$totalQuery = mysqli_query($link1, "SELECT COUNT(*) as total FROM locationuser_master");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];

$filteredQuery = mysqli_query($link1, "SELECT COUNT(*) as total FROM locationuser_master $where");
$totalFiltered = mysqli_fetch_assoc($filteredQuery)['total'];

$query = "
    SELECT userloginid, locusername, contactmo, emailid, statusid, mapped_bsi, mapped_rm, spare_location_code
    FROM locationuser_master
    $where
    ORDER BY $orderColumn $orderDir
    LIMIT $start, $length
";

$result = mysqli_query($link1, $query);

$data = [];
$serial = $start + 1;

while($row = mysqli_fetch_assoc($result)){

    $nestedData = [];
    $nestedData['id'] = $serial++;
    $nestedData['login_id'] = $row['userloginid'];
    $nestedData['username'] = $row['locusername'];
    $nestedData['email'] = $row['emailid'];
    $nestedData['contact_no'] = $row['contactmo'];
    if($row['statusid'] == 1){
        $statusBadge = '<span class="badge badge-success" style="background-color: green;!important;">Active</span>';
    } else {
        $statusBadge = '<span class="badge badge-danger">Inactive</span>';
    }

    $nestedData['status'] = $statusBadge;

    $nestedData['mapped_bsi'] = $row['mapped_bsi'];
    $nestedData['mapped_rm'] = $row['mapped_rm'];
    $nestedData['spare_location_code'] = $row['spare_location_code'];

    $nestedData['action'] = '<a href="enginner_master_op.php?op=edit&id='.$row['userloginid'].'" class="btn btn-sm btn-primary">Edit</a>';

    $data[] = $nestedData;
}


$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
];

echo json_encode($response);
exit;
