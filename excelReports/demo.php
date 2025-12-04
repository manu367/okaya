<?php
print("\n");
print("\n");
require_once("../includes/config.php");
require_once("../includes/common_function.php");

$startdate = $_GET['startdate'];
$enddate   = $_GET['enddate'];
$model_id  = $_GET['model_id']; // "M00002,M00005,M00007"
$brandId   = $_GET['brandId'];



if($startdate=='' && $enddate==''){
    $startdate = "2004-10-12";
    $enddate = "2024-10-12";
}
if($model_id==''){
    $model_id='M00002';
}
if($brandId==''){
    $brandId=1;
}

$model_id = str_replace(' ', '', $model_id);
$model_array = explode(',', $model_id);
$model_str = "'" . implode("','", $model_array) . "'";

//var_dump($model_str); exit();
//////End filters value/////
$query="SELECT wd.sno, wd.serial_no, wd.dealer_code, wd.pcb, wd.transformer,wd.start_date,wd.end_date, mm.model_id, mm.product_id, mm.brand_id, mm.model,mm.modelcode,
 bm.brand, pm.product_name FROM warranty_data wd LEFT JOIN model_master mm ON wd.model_id = mm.model_id LEFT JOIN brand_master bm ON mm.brand_id=bm.brand_id
 LEFT JOIN product_master pm ON pm.mapped_brand=bm.brand_id WHERE wd.start_date >= '$startdate' AND (wd.end_date IS NULL OR wd.end_date <= '$enddate') AND 
bm.brand_id=$brandId AND mm.model_id IN ($model_str)";
//echo $query;exit();
$sql=mysqli_query($link1,$query)or die("er1".mysqli_error($link1));
?>

<table width="100%" border="1" cellpadding="2" cellspacing="1" bordercolor="#000000">
    <tr align="left" style="background-color:#396; color:#FFFFFF;font-size:13px;font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;vertical-align:central">
        <td height="25"><strong>S.No.</strong></td>
        <td><strong>Serial No</strong></td>
        <td><strong>Dealer Code</strong></td>
        <td><strong>PCB</strong></td>
        <td><strong>Transformer</strong></td>
        <td><strong>Model</strong></td>
        <td><strong>ModelCode</strong></td>
        <td><strong>Brand</strong></td>
        <td><strong>ProductName</strong></td>
        <td><strong>start-date</strong></td>
        <td><strong>end-date</strong></td>

    </tr>
    <?php
    $i=1;
    while($row_loc = mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td align="left"><?=$i?></td>
            <td align="left"><?= isset($row_loc['serial_no']) && $row_loc['serial_no'] !== null ? $row_loc['serial_no'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['dealer_code']) && $row_loc['dealer_code'] !== null ? $row_loc['dealer_code'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['pcb']) && $row_loc['pcb'] !== '' ? $row_loc['pcb'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['transformer']) && $row_loc['transformer'] !== '' ? $row_loc['transformer'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['model']) && $row_loc['model'] !== null ? $row_loc['model'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['modelcode']) && $row_loc['modelcode'] !== null ? $row_loc['modelcode'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['brand']) && $row_loc['brand'] !== null ? $row_loc['brand'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['product_name']) && $row_loc['product_name'] !== null ? $row_loc['product_name'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['start_date']) && $row_loc['start_date'] !== null ? $row_loc['start_date'] : 'NaN' ?></td>
            <td align="left"><?= isset($row_loc['end_date']) && $row_loc['end_date'] !== null ? $row_loc['end_date'] : 'NaN' ?></td>
        </tr>
        <?php
        $i+=1;
    }
    ?>
</table>