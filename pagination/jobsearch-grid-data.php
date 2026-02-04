<?php
require_once("../includes/config.php");

/* =========================
   REQUEST DATA
========================= */
$requestData = $_REQUEST;
$arrstatus = getJobStatus($link1);

/* =========================
   WHERE CONDITIONS
========================= */
$where = [];
$where[] = "1=1";

/* DATE RANGE */
if (!empty($requestData['daterange'])) {
    $date_range = explode(" - ", $requestData['daterange']);
    if (count($date_range) == 2) {
        $from = mysqli_real_escape_string($link1, $date_range[0]);
        $to   = mysqli_real_escape_string($link1, $date_range[1]);
        $where[] = "open_date BETWEEN '$from' AND '$to'";
    }
}

/* PRODUCT */
if (!empty($requestData['product_name'])) {
    $where[] = "product_id = " . intval($requestData['product_name']);
}

/* BRAND */
if (!empty($requestData['brand'])) {
    $where[] = "brand_id = " . intval($requestData['brand']);
}

/* MODEL */
if (!empty($requestData['modelid'])) {
    $where[] = "model_id = " . intval($requestData['modelid']);
}

/* STATUS (MULTI) */
if (!empty($requestData['info']) && is_array($requestData['info'])) {
    $statusArr = array_map(function ($s) use ($link1) {
        return "'" . mysqli_real_escape_string($link1, $s) . "'";
    }, $requestData['info']);

    $where[] = "status IN (" . implode(",", $statusArr) . ")";
}

/* =========================
   BASE SQL
========================= */
$whereSql = implode(" AND ", $where);

/* =========================
   TOTAL RECORDS (NO SEARCH)
========================= */
$sqlTotal = "SELECT COUNT(*) AS total FROM jobsheet_data WHERE $whereSql";
$resTotal = mysqli_query($link1, $sqlTotal);
$totalData = mysqli_fetch_assoc($resTotal)['total'];
$totalFiltered = $totalData;

/* =========================
   SEARCH
========================= */
$searchSql = "";
if (!empty($requestData['search']['value'])) {
    $search = mysqli_real_escape_string($link1, $requestData['search']['value']);
    $searchSql = "
        AND (
            job_no LIKE '$search%'
            OR imei LIKE '$search%'
            OR customer_name LIKE '$search%'
            OR contact_no LIKE '$search%'
            OR b_cust_id LIKE '$search%'
            OR ticket_no LIKE '$search%'
            OR customer_id LIKE '$search%'
        )
    ";
}

/* =========================
   FILTERED COUNT
========================= */
if ($searchSql != "") {
    $sqlFiltered = "SELECT COUNT(*) AS total FROM jobsheet_data WHERE $whereSql $searchSql";
    $resFiltered = mysqli_query($link1, $sqlFiltered);
    $totalFiltered = mysqli_fetch_assoc($resFiltered)['total'];
}

/* =========================
   DATA QUERY
========================= */
$columns = [
    0 => 'job_id',
    1 => 'job_no',
    2 => 'imei',
    3 => 'product_id',
    4 => 'brand_id',
    5 => 'model',
    6 => 'open_date',
    7 => 'close_date',
    8 => 'customer_name',
    9 => 'status'
];

$orderCol = $columns[$requestData['order'][0]['column']];
$orderDir = $requestData['order'][0]['dir'];
$start    = intval($requestData['start']);
$length   = intval($requestData['length']);

$sql = "
    SELECT *
    FROM jobsheet_data
    WHERE $whereSql
    $searchSql
    ORDER BY $orderCol $orderDir
    LIMIT $start, $length
";

$query = mysqli_query($link1, $sql) or die(mysqli_error($link1));

/* =========================
   DATA FORMAT
========================= */
$data = [];
$j = $start + 1;

while ($row = mysqli_fetch_assoc($query)) {

    $nestedData = [];

    $nestedData[] = $j++;
    $nestedData[] = $row["job_no"];
    $nestedData[] = $row["customer_id"];
    $nestedData[] = $row["customer_name"];
    $nestedData[] = $row["contact_no"];

    $nestedData[] = getAnyDetails($row["brand_id"], "brand", "brand_id", "brand_master", $link1);
    $nestedData[] = getAnyDetails($row["product_id"], "product_name", "product_id", "product_master", $link1);
    $nestedData[] = getAnyDetails($row["model_id"], "model", "model_id", "model_master", $link1);

    $nestedData[] = $row["area_type"];
    $nestedData[] = $row["imei"];
    $nestedData[] = $row["call_for"];
    $nestedData[] = dt_format($row["open_date"]);
    $nestedData[] = dt_format($row["close_date"]);

    $nestedData[] = $arrstatus[$row["sub_status"]][$row["status"]]
        ?? getAnyDetails($row["status"], "display_status", "status_id", "jobstatus_master", $link1);

    $nestedData[] = getAnyDetails($row["current_location"], "locationname", "location_code", "location_master", $link1);

    $nestedData[] = "<div align='center'>
        <a href='job_view.php?refid=" . base64_encode($row['job_no']) . "'>
            <i class='fa fa-eye fa-lg faicon'></i>
        </a>
    </div>";

    $data[] = $nestedData;
}

/* =========================
   JSON RESPONSE
========================= */
echo json_encode([
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
]);
