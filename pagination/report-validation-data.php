<?php
require_once("../includes/config.php");
require_once ("../ExcelExportAPI/Classes/PHPExcel.php");
require_once ("../ExcelExportAPI/Classes/PHPExcel/IOFactory.php");

if (isset($_GET['q']) && $_GET['q'] === 'changes') {
    header('Content-Type: application/json');
    echo json_encode([
        "status" => "success",
        "message" => [1,2,3,45],
    ]);
    exit;
}

if (!isset($_FILES['file'])) {
    exit("<span style='color:red'>No file received</span>");
}

//function processData(Validation $valida,$data)
//{
//    return $valida->processData($data);
//}

$fileTmp = $_FILES['file']['tmp_name'];

$objPHPExcel = PHPExcel_IOFactory::load($fileTmp);
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

echo "<table class='table table-bordered' id='editableTable'>";
echo "<thead>
        <tr>
            <th>#</th>
            <th>Model No</th>
            <th>Battery Type</th>
            <th>Status</th>
        </tr>
      </thead>
      <tbody>";

$i = 1;
foreach ($sheetData as $row) {

    if ($i == 1) { $i++; continue; } // header skip

    $model  = trim($row['A']);
    $type   = trim($row['B']);

    if ($model == "") continue;

    echo "<tr>
        <td>{$i}</td>

        <td contenteditable='true' class='editable model' "
        . (($model === 'M02951') ? "style='background-color:red;color:white;border:1px solid black;border-radius:5px;'" : "") .
        ">
            {$model}
        </td>

        <td contenteditable='true' class='editable type'>{$type}</td>

        <td class='status text-danger'>failed</td>
      </tr>";

    $i++;
}

echo "</tbody></table>";

echo "<div style='text-align:right;margin-top:10px'>
        <button class='btn btn-success' onclick='collectTableData()'>
            Save Changes
        </button>
      </div>";


