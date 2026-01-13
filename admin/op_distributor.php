<?php
require_once("../includes/config.php");
@extract($_POST);

/* ================= LOAD EDIT ================= */
if($_REQUEST['op']=="Edit"){
    $id=$_REQUEST['id'];
    $q=mysqli_query($link1,"SELECT * FROM distributor_master WHERE distributorid='$id'");
    $sel_result=mysqli_fetch_assoc($q);
}

/* ================= AUTO CODE ================= */
function newDisCode($link){
    $r=mysqli_query($link,"SELECT MAX(distributorid) id FROM distributor_master");
    $d=mysqli_fetch_assoc($r);
    return "DST".str_pad($d['id']+1,4,"0",STR_PAD_LEFT);
}

/* ================= ADD ================= */
if($_POST['add']=="ADD"){
    mysqli_autocommit($link1,false);
    $code=newDisCode($link1);

    $sql="INSERT INTO distributor_master SET
  distributorname='$name',
  distributorcode='$code',
  email='$email',
  address1='$bill_address',
  address2='$ship_address',
  landmark='$remark',
  cityid='$city',
  stateid='$state',
  countryid='$country',
  phone='$phone',
  mobile='$phone',
  gst_no='$gst_no',
  status='1',
  updateby='".$_SESSION['userid']."'
 ";

    $res=mysqli_query($link1,$sql);
    if($res){
        mysqli_commit($link1);
        header("location:supplier_master.php?msg=Distributor Added&chkflag=success");
        exit;
    }else{
        mysqli_rollback($link1);
        die(mysqli_error($link1));
    }
}

/* ================= UPDATE ================= */
if($_POST['upd']=="Update"){
    mysqli_autocommit($link1,false);
    $id=$_POST['refid'];

    $sql="UPDATE distributor_master SET
  distributorname='$name',
  email='$email',
  address1='$bill_address',
  address2='$ship_address',
  landmark='$remark',
  cityid='$city',
  stateid='$state',
  countryid='$country',
  phone='$phone',
  mobile='$phone',
  gst_no='$gst_no',
  status='$status',
  updateby='".$_SESSION['userid']."'
 WHERE distributorid='$id'";

    $res=mysqli_query($link1,$sql);
    if($res){
        mysqli_commit($link1);
        header("location:distributor_master.php?msg=Distributor Updated&chkflag=success");
        exit;
    }else{
        mysqli_rollback($link1);
        die(mysqli_error($link1));
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=siteTitle?></title>
    <link rel="shortcut icon" href="../images/titleimg.png" type="image/png">
    <script src="../js/jquery.js"></script>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/abc.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/abc2.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script>
        $(document).ready(function(){
            $("#form1").validate();
        });
    </script>
    <script src="../js/frmvalidate.js"></script>
    <script src="../js/jquery.validate.js"></script>
</head>

<body>
<div class="container-fluid">
    <div class="row content">
        <?php include("../includes/leftnav2.php"); ?>

        <div class="<?=$screenwidth?>">
            <h2 align="center"><i class="fa fa-shopping-basket"></i> <?=$_REQUEST['op']?> Distributer</h2><br><br>

            <div class="form-group" id="page-wrap" style="margin-left:10px;">
                <form name="form1" id="form1" class="form-horizontal" method="post">

                    <!-- ========== UI EXACTLY SAME ========== -->

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-5 control-label">Vendor Name*</label>
                            <div class="col-md-5">
                                <input name="name" class="form-control" value="<?=$sel_result['distributorname']?>" required>
                            </div></div>

                        <div class="col-md-6">
                            <label class="col-md-5 control-label">Contact No*</label>
                            <div class="col-md-5">
                                <input name="phone" class="form-control" value="<?=$sel_result['phone']?>" required>
                            </div></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-5 control-label">Email*</label>
                            <div class="col-md-5">
                                <input name="email" class="form-control" value="<?=$sel_result['email']?>" required>
                            </div></div>

                        <div class="col-md-6">
                            <label class="col-md-5 control-label">City*</label>
                            <div class="col-md-5">
                                <input name="city" class="form-control" value="<?=$sel_result['cityid']?>" required>
                            </div></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-5 control-label">State*</label>
                            <div class="col-md-5">
                                <input name="state" class="form-control" value="<?=$sel_result['stateid']?>" required>
                            </div></div>

                        <div class="col-md-6">
                            <label class="col-md-5 control-label">Country*</label>
                            <div class="col-md-5">
                                <input name="country" class="form-control" value="<?=$sel_result['countryid']?>" required>
                            </div></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-5 control-label">Billing Address*</label>
                            <div class="col-md-5">
                                <textarea name="bill_address" class="form-control"><?=$sel_result['address1']?></textarea>
                            </div></div>

                        <div class="col-md-6">
                            <label class="col-md-5 control-label">Shipping Address</label>
                            <div class="col-md-5">
                                <textarea name="ship_address" class="form-control"><?=$sel_result['address2']?></textarea>
                            </div></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-5 control-label">GST</label>
                            <div class="col-md-5">
                                <input name="gst_no" class="form-control" value="<?=$sel_result['gst_no']?>">
                            </div></div>
                    </div>

                    <?php if($_REQUEST['op']=="Edit"){ ?>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-5 control-label">Status</label>
                                <div class="col-md-5">
                                    <select name="status" class="form-control">
                                        <option value="active" <?=$sel_result['status']=="active"?"selected":""?>>Active</option>
                                        <option value="deactive" <?=$sel_result['status']=="deactive"?"selected":""?>>Deactive</option>
                                    </select>
                                </div></div>
                        </div>
                    <?php } ?>

                    <div class="form-group text-center">
                        <?php if($_REQUEST['op']=="Add"){ ?>
                            <input type="submit" name="add" value="ADD" class="btn<?=$btncolor?>">
                        <?php } else { ?>
                            <input type="submit" name="upd" value="Update" class="btn<?=$btncolor?>">
                        <?php } ?>
                        <input type="hidden" name="refid" value="<?=$sel_result['distributorid']?>">
                        <button type="button" onclick="window.location.href='distributor_master.php'" class="btn btn-danger">Back</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
