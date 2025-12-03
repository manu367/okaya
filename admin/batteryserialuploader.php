<?php
require_once("../includes/config.php");
require_once ("../ExcelExportAPI/Classes/PHPExcel.php");
require_once ("../ExcelExportAPI/Classes/PHPExcel/IOFactory.php");


@extract($_POST);

if($_POST['Submit']=="Upload"){


    // validation arrays
    $modal_master = array();
    $series_master = array();
    $modal_code = mysqli_query($link1, "SELECT model_id,modelcode FROM model_master");
    if (mysqli_num_rows($modal_code) > 0) {
        while ($row = mysqli_fetch_assoc($modal_code)) {
            $modal_master[] = $row['modelcode'];
        }
    }

    // seris number fetch
    $serial_number = mysqli_query($link1, "SELECT serial_no FROM warranty_data");
    if (mysqli_num_rows($serial_number) > 0) {
        while ($row = mysqli_fetch_assoc($serial_number)) {
            //  echo $row['serial_no']."<br/>";
            $series_master[] = $row['serial_no'];
        }
    }



    mysqli_autocommit($link1, false);
    $flag = true;

    if ($_FILES["file"]["error"] == 0){
        move_uploaded_file($_FILES["file"]["tmp_name"],
                "../ExcelExportAPI/upload/".$today.$_FILES["file"]["name"]);

        $file="../ExcelExportAPI/upload/".$today.$_FILES["file"]["name"];
        chmod ($file, 0755);
    }

    $filename=$file;

    // LOAD EXCEL
    $identityType = PHPExcel_IOFactory::identify($filename);
    $object = PHPExcel_IOFactory::createReader($identityType);
    $object->setReadDataOnly(true);
    $objPHPExcel = $object->load($filename);

    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();

    // Arrays to store errors
    $missingModels = [];
    $duplicateSerials = [];

    /* ***************************************
     * STEP–1 VALIDATION (Model + Serial)
     **************************************** */
//    for($row = 2; $row <= $highestRow; $row++)
//    {
//        $model_code = trim($sheet->getCellByColumnAndRow(0,$row)->getValue());
//        $serial_no  = trim($sheet->getCellByColumnAndRow(1,$row)->getValue());
//
//
//        // MODEL CHECK
//        $m = mysqli_query($link1,"SELECT model_id FROM model_master WHERE modelcode='$model_code'");
//        if(mysqli_num_rows($m) == 0){
//            $missingModels[] = $model_code;
//        }
//
//        // DUPLICATE SERIAL CHECK
//        $s = mysqli_query($link1,"SELECT serial_no FROM warranty_data
//                                  WHERE serial_no='$serial_no'
//                                  AND model_code='$model_code'");
//        if(mysqli_num_rows($s) > 0){
//            $duplicateSerials[] = $serial_no;
//        }
//    }
//
//    /* ***************************************
//     * IF MODEL MISSING → STOP + TABLE SHOW
//     **************************************** */
//    if(count($missingModels) > 0){
//        mysqli_rollback($link1);
//
//        $_SESSION['missing_model_list'] = array_unique($missingModels);
//
//        header("location: batteryserialuploader.php?chkflag=danger&chkmsg=Failed&msg=Missing Model Codes Found");
//        exit;
//    }
//    if(count($duplicateSerials) > 0){
//        mysqli_rollback($link1);
//        $_SESSION['duplocate_serial_list'] = array_unique($duplicateSerials);
//        header("location: batteryserialuploader.php?chkflag=danger&chkmsg=Failed&msg=Missing Model Codes Found");
//        exit;
//    }


    /* ***************************************
     * STEP–2 INSERT (Skip duplicate serials)
     **************************************** */
    for($row = 2; $row <= $highestRow; $row++)
    {
        $model_code = trim($sheet->getCellByColumnAndRow(0,$row)->getValue());
        $serial_no  = trim($sheet->getCellByColumnAndRow(1,$row)->getValue());
        $start_date = excelDateToDate($sheet->getCellByColumnAndRow(2,$row)->getValue());
        var_dump(count($modal_master));exit();
        $end_date   = excelDateToDate($sheet->getCellByColumnAndRow(3,$row)->getValue());
        $dist_code  = trim($sheet->getCellByColumnAndRow(4,$row)->getValue());

        // SKIP IF DUPLICATE
        if(in_array($serial_no, $duplicateSerials)) continue;

        $res = mysqli_query($link1,"SELECT * FROM model_master WHERE modelcode='$model_code'");
        $mdata = mysqli_fetch_assoc($res);

        $data = [
                'serial_no'  => $serial_no,
                'start_date' => $start_date,
                'end_date'   => $end_date,
                'brand_id'   => $mdata['brand_id'],
                'product_id' => $mdata['product_id'],
                'model_id'   => $mdata['model_id'],
                'model_code' => $mdata['modelcode'],
                'dist_code'  => $dist_code,
                'entry_by'   => 'User'
        ];

        if(!insertWarrantyData($link1,$data)){
            $flag = false;
        }
    }

    /* ***************************************
     * Commit / Rollback
     **************************************** */
    if ($flag) {
        mysqli_commit($link1);
        $cflag="success"; $cmsg="Success"; $msg="Successfully Uploaded";
    } else {
        mysqli_rollback($link1);
        $cflag="danger"; $cmsg="Failed"; $msg="Something Went Wrong";
    }

    mysqli_close($link1);

    /* ***************************************
     * SAVE DUPLICATES FOR SHOWING IN TABLE
     **************************************** */

    header("location: batteryserialuploader.php?chkflag=".$cflag."&chkmsg=".$cmsg."&msg=".$msg);
    exit;
}


/* **********************************************
 * Helper Functions
 ********************************************** */
function insertWarrantyData($link1, $arr) {
    foreach ($arr as $k=>$v){
        $arr[$k] = mysqli_real_escape_string($link1,$v);
    }

    $sql = "INSERT INTO warranty_data
            (serial_no, start_date, end_date, brand_id, product_id, model_id, model_code, dealer_code, remark, dist_channel, division_code, update_date, status, pcb, transformer, entry_by, entry_date)
            VALUES
            ('{$arr['serial_no']}', '{$arr['start_date']}', '{$arr['end_date']}',
             '{$arr['brand_id']}', '{$arr['product_id']}', '{$arr['model_id']}',
             '{$arr['model_code']}', '{$arr['dist_code']}', '', '', '',
             NOW(), '1', '', '', '{$arr['entry_by']}', NOW())";

    return mysqli_query($link1,$sql);
}

function excelDateToDate($v)
{
    if(is_numeric($v)){
        return gmdate("Y-m-d", ($v - 25569) * 86400);
    }
    return date("Y-m-d", strtotime($v));
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=siteTitle?></title>
    <script src="../js/jquery.min.js"></script>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/abc.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/abc2.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <script src="../js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script>
        //////////////////////// function to get model on basis of model dropdown selection///////////////////////////
        function getmodel(){
            var brand=$('#brand').val();
            var product=$('#prod_code').val();
            $.ajax({
                type:'post',
                url:'../includes/getAzaxFields.php',
                data:{brandinfo:brand,productinfo:product},
                success:function(data){
                    $('#modeldiv').html(data);
                }
            });
        }

    </script>
    <script src="../js/frmvalidate.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../js/common_js.js"></script>
    <link rel="stylesheet" href="../css/datepicker.css">
    <script src="../js/jquery-1.10.1.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/fileupload.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row content">
        <?php
        include("../includes/leftnav2.php");
        ?>
        <div class="<?=$screenwidth?> tab-pane fade in active" id="home">
            <h2 align="center"><i class="fa fa-upload"></i>Upload SALE IMEI</h2><div style="display:inline-block;float:right">
                <a href="../templates/batterySerieluploader.xlsx" title="Download Excel Template"><img src="../images/template.png" title="Download Excel Template"/></a></div>	<br></br>

            <div class="form-group"  id="page-wrap" style="margin-left:10px;">
                <?php if($_REQUEST['msg']){?><br>
                    <div class="alert alert-<?=$_REQUEST['chkflag']?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?=$_REQUEST['chkmsg']?>!</strong>&nbsp;&nbsp;<?=$_REQUEST['msg']?>.
                    </div>
                <?php }?>
                <form  name="frm1"  id="frm1" class="form-horizontal" action="" method="post"  enctype="multipart/form-data">


                    <div class="form-group">
                        <div class="col-md-12"><label class="col-md-4 control-label">Attach File<span class="red_small">*</span></label>
                            <div class="col-md-4">
                                <div>
                                    <label >
                       <span>
                        <input type="file"  name="file"  required class="form-control"   accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/ >
                    </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4" align="right"><span class="red_small">NOTE: Attach only <strong>.xlsx (Excel Workbook)</strong> file</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" align="center">
                            <input type="submit" class="btn<?=$btncolor?>" name="Submit" id="save" value="Upload" title="" <?php if($_POST['Submit']=='Update'){?>disabled<?php }?>>
                            &nbsp;&nbsp;&nbsp;

                        </div>
                    </div>
                </form>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="container mt-5">
                            <!-- Danger Alert Table -->
                            <?php
                            // MODEL ERROR TABLE
                            if( isset($_SESSION['missing_model_list']) && count($_SESSION['missing_model_list']) > 0){ ?>

                                <table class="table bg-danger mx-auto w-auto text-center" id="table">
                                    <tbody>
                                    <?php foreach($_SESSION['missing_model_list'] as $m){ ?>
                                        <tr><td><span>Missing Model : <?= $m ?></span></td></tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <?php unset($_SESSION['missing_model_list']); } ?>



                            <?php
                            // DUPLICATE SERIAL TABLE
                            if(isset($_SESSION['duplocate_serial_list'])&& count($_SESSION['duplocate_serial_list']) > 0){ ?>

                                <table class="table bg-warning mx-auto w-auto text-center" id="table">
                                    <tbody>
                                    <?php foreach($_SESSION['duplocate_serial_list'] as $d){ ?>
                                        <tr><td><span>Duplicate Serial : <?= $d ?></span></td></tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <?php unset($_SESSION['duplocate_serial_list']); } ?>

                        </div>

                        <style>
                            /* Fade out animation */
                            #table {
                                transition: opacity 1s ease, transform 1s ease; /* opacity + slide up */
                                opacity: 1;
                                transform: translateY(0);
                                border:none;
                            }

                            #table.hide {
                                opacity: 0;
                                transform: translateY(-20px); /* thoda upar slide hote hue fade out */
                            }
                        </style>

                        <script>
                            // 3 second baad fade out
                            setTimeout(() => {
                                const table = document.getElementById("table");
                                table.classList.add("hide");
                            }, 3000);
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
include("../includes/footer.php");
include("../includes/connection_close.php");
?>
</body>
</html>