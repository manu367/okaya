<?php
require_once("../includes/config.php");

/////////////////////// Fetch Vendor / Bill From / Bill To /////////////////////
$vendor_addrs  = getAnyDetails($_REQUEST['vendor'],"address","id","vendor_master",$link1);
$from  = getAnyDetails($_REQUEST['bill_from'],"locationaddress","location_code","location_master",$link1);
$to  = getAnyDetails($_REQUEST['bill_to'],"locationaddress","location_code","location_master",$link1);

/////////////////////// Get Access Products & Brands ////////////////////////
$access_product = getAccessProduct($_SESSION['asc_code'],$link1);
$access_brand   = getAccessBrand($_SESSION['asc_code'],$link1);

/////////////////////////// Handle PO Submission ////////////////////////////
@extract($_POST);

if(isset($_POST['add']) && $_POST['add']=='ADD' && $_SESSION['asc_code']!=''){
    mysqli_autocommit($link1, false);
    $flag = true;

    $len = count($_POST['partcode']);
    if($len>0){
        // Generate PO Number
        $res_po = mysqli_query($link1,"SELECT MAX(ch_temp) AS no FROM supplier_po_master WHERE location_code='".$_SESSION['asc_code']."'");
        $row_po = mysqli_fetch_array($res_po);
        $c_nos = $row_po['no']+1;
        $po_no = $_SESSION['asc_code']."V".$c_nos;

        // Insert Master
        $po_add = "INSERT INTO supplier_po_master SET 
                    system_ref_no = '".$po_no."', 
                    entry_date = '".$today."', 
                    location_code = '".$_SESSION['asc_code']."', 
                    ship_address2 = '".$to_add1."', 
                    party_name = '".$supplier."', 
                    bill_to = '".$billto."', 
                    ch_temp='".$c_nos."', 
                    bill_address ='".$fromadd."', 
                    status='7', 
                    po_type = 'PTV', 
                    comp_code = '".$billto."', 
                    user_code = '".$supplier."', 
                    remark = '".$remark."'";
        $result = mysqli_query($link1,$po_add);
        if (!$result) {
            $flag = false;
            $error_msg = "Error Master: ".mysqli_error($link1);
        }

        // Insert PO Data
        for($i=0; $i<$len; $i++){
            $prod_info = $_POST['prod_code'][$i];
            $brand_info = $_POST['brand'][$i];
            $model_info = $_POST['model'][$i];
            $part_info = $_POST['partcode'][$i];
            $req_qty_info = $_POST['req_qty'][$i];
            $price_info = $_POST['price'][$i];
            $total_info = $_POST['rowsubtotal'][$i];

            if($part_info && $prod_info && $brand_info){
                if($req_qty_info > 0){
                    $po_data_add = "INSERT INTO supplier_po_data SET
                                    location_code ='".$_SESSION['asc_code']."',
                                    system_ref_no='".$po_no."',
                                    product_id ='".$prod_info."',
                                    brand_id ='".$brand_info."',
                                    model_id='".$model_info."',
                                    partcode ='".$part_info."',
                                    qty='".$req_qty_info."',
                                    req_qty='".$req_qty_info."',
                                    price = '".$price_info."',
                                    cost='".$total_info."',
                                    total_cost='".$total_info."',
                                    entry_date = '".$today."',
                                    status='7',
                                    flag='1'";
                    $result1 = mysqli_query($link1,$po_data_add);
                    if (!$result1) {
                        $flag = false;
                        $error_msg = "Error Data: ".mysqli_error($link1);
                    }
                } else {
                    $flag = false;
                    $error_msg = "QTY is Zero for Partcode: ".$part_info;
                }
            } else {
                $flag = false;
                $error_msg = "Part Details missing";
            }
        }
    } else {
        $flag = false;
        $error_msg = "At least one Item Select";
    }

    // Commit or Rollback
    if($flag){
        mysqli_commit($link1);
        $cflag = "success";
        $cmsg = "Success";
        $msg = "PO placed successfully with ref no: ".$po_no;
    } else {
        mysqli_rollback($link1);
        $cflag = "danger";
        $cmsg = "Failed";
        $msg = "Request failed. ".$error_msg;
    }

    mysqli_close($link1);
    header("location:grn_vendor.php?msg=".$msg."&chkflag=".$cflag."&chkmsg=".$cmsg);
    exit;
}

/////////////////////////// Fetch Brand & Product Options ///////////////////////
$brandOptions = '';
$dept_query="SELECT * FROM brand_master WHERE status = '1' AND brand_id IN ($access_brand) ORDER BY brand";
$check_dept=mysqli_query($link1,$dept_query);
while($br_dept = mysqli_fetch_array($check_dept)){
    $brandOptions .= '<option value="'.$br_dept['brand_id'].'">'.$br_dept['brand'].'</option>';
}

$productOptions = '';
$model_query="SELECT product_id, product_name FROM product_master WHERE status='1' AND product_id IN ($access_product) ORDER BY product_name";
$check1=mysqli_query($link1,$model_query);
while($br = mysqli_fetch_array($check1)){
    $productOptions .= '<option value="'.$br['product_id'].'">'.$br['product_name'].' | '.$br['product_id'].'</option>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=siteTitle?></title>
    <link rel="shortcut icon" href="../images/titleimg.png" type="image/png">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/abc.css" rel="stylesheet">
    <link href="../css/abc2.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="../js/jquery.validate.js"></script>

    <style>
        .custom_label {
            text-align:left;
            vertical-align:middle;
        }
    </style>
</head>
<body>
<form method="post" id="frm1">
    <input type="hidden" id="rowno" value="1">

    <button type="button" id="add_row">Add Row</button>

    <table id="itemsTable1" class="table table-bordered">
        <thead>
        <tr>
            <th>Brand</th>
            <th>Product</th>
            <th>Division</th>
            <th>Model</th>
            <th>Partcode</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <!-- Initial rows can go here -->
        </tbody>
    </table>

    <input type="submit" name="add" value="ADD" id="add">
</form>

<script>
    var brandOptions = `<?= $brandOptions ?>`;
    var productOptions = `<?= $productOptions ?>`;

    function makeDropdown(){
        $('.selectpicker').selectpicker('refresh');
    }

    function fun_remove(num){
        $('#adrw'+num).remove();
        var rowno = parseInt($('#rowno').val()) - 1;
        $('#rowno').val(rowno);
    }

    function get_tot(indx){
        var qty = parseFloat($('#req_qty\\['+indx+'\\]').val()) || 0;
        var price = parseFloat($('#price\\['+indx+'\\]').val()) || 0;
        $('#rowsubtotal\\['+indx+'\\]').val(qty * price);
        get_cal();
    }

    function get_cal(){
        var rowno = parseInt($('#rowno').val());
        var grandtotal = 0, qtytotal = 0;
        for(var i=0;i<=rowno;i++){
            grandtotal += parseFloat($('#rowsubtotal\\['+i+'\\]').val()) || 0;
            qtytotal += parseFloat($('#req_qty\\['+i+'\\]').val()) || 0;
        }
        $('#grand_total').val(grandtotal);
        $('#total_qty').val(qtytotal);
    }

    function checkDuplicate(fldIndx1, enteredsno) {
        if(!enteredsno) return true;
        for(var i=0;i<=fldIndx1;i++){
            if(fldIndx1 != i && $('#partcode\\['+fldIndx1+'\\]').val() == $('#partcode\\['+i+'\\]').val()){
                alert("Duplicate Partcode Selection.");
                $('#partcode\\['+fldIndx1+'\\]').val('').css('background','#F66');
                return false;
            }
        }
        $('#partcode\\['+fldIndx1+'\\]').css('background','#FFF');
        return true;
    }

    $(document).ready(function(){
        makeDropdown();

        $("#add_row").click(function(){
            var num = parseInt($('#rowno').val()) + 1;
            $('#rowno').val(num);

            var r = `<tr id="adrw${num}">
            <td><select name="brand[${num}]" id="brand[${num}]" class="form-control selectpicker required" data-live-search="true" required>
                <option value="">--Select Brand--</option>${brandOptions}
            </select></td>
            <td><select name="prod_code[${num}]" id="prod_code[${num}]" class="form-control selectpicker required" data-live-search="true" required>
                <option value="">Select Product</option>${productOptions}
            </select></td>
            <td><select name="division[${num}]" id="division[${num}]" class="form-control selectpicker required" data-live-search="true">
                <option value="">Select Division</option>
                <option value="DOMESTIC">DOMESTIC</option>
                <option value="EXPORT">EXPORT</option>
            </select></td>
            <td><select name="model[${num}]" id="model[${num}]" class="form-control required" onChange="getpartcode(${num})">
                <option value="">Select Model</option>
            </select></td>
            <td><select name="partcode[${num}]" id="partcode[${num}]" class="form-control required" onChange="getAvlStk(${num}); checkDuplicate(${num},this.value);">
                <option value="">Select Partcode</option>
            </select></td>
            <td><input type="text" class="form-control digits" name="req_qty[${num}]" id="req_qty[${num}]" onKeyUp="get_tot(${num})" style="text-align:right"></td>
            <td><input type="text" class="form-control" name="price[${num}]" id="price[${num}]" readonly style="text-align:right"></td>
            <td>
                <input type="text" class="form-control" name="rowsubtotal[${num}]" id="rowsubtotal[${num}]" value="0" readonly style="text-align:right">
                <i class="fa fa-close fa-lg" onClick="fun_remove(${num});"></i>
            </td>
        </tr>`;
            $('#itemsTable1 tbody').append(r);
            makeDropdown();
        });
    });
</script>
</body>
</html>
