<?php
require_once("../includes/config.php");

$docid = base64_decode($_REQUEST['refid']);
$job_row = mysqli_fetch_assoc(mysqli_query($link1,"SELECT * FROM jobsheet_data WHERE job_no='$docid'"));
$location_info = getLocationDispAddress($job_row['current_location'],$link1);
$image = getAnyDetails($row["brand_id"],"brand_logo","brand_id","brand_master",$link1);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Print Jobsheet</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Barcode -->
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-barcode.js"></script>

    <script>
        $(document).ready(function(){
            $("#barcodeprint").barcode("<?=$docid?>", "code128");
        });
    </script>

    <style>
        @media print {
            .no-print { display:none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>

<body class="bg-gray-50 p-6 text-sm">

<!-- =============== CUSTOMER COPY =============== -->
<div class="max-w-4xl mx-auto bg-white shadow p-6 mb-10 border rounded-lg">

    <!-- Header -->
    <div class="grid grid-cols-4 items-center pb-4 border-b mb-4">
        <div><img src="../images/blogo.png" class="h-16"></div>

        <div class="text-center">
            <div id="barcodeprint"></div>
        </div>

        <div class="text-right text-xs leading-tight col-span-1">
            <?=$location_info?><br>
            <span class="font-semibold">Working Time:</span> 10:00 AM – 7:00 PM
        </div>

        <div class="text-right">
            <img src="<?=$image?>" class="h-16 mx-auto">
        </div>
    </div>

    <h2 class="text-center text-lg font-bold underline mb-4">CUSTOMER COPY</h2>

    <!-- Job Details -->
    <table class="w-full border text-sm">
        <tr class="bg-gray-100">
            <td class="p-2 font-semibold w-1/4">Job No.</td>
            <td class="p-2 w-1/4"><?=$docid?></td>
            <td class="p-2 font-semibold w-1/4">Create Date</td>
            <td class="p-2 w-1/4"><?=dt_format($job_row['open_date'])." ".$job_row['open_time']?></td>
        </tr>

        <!-- CUSTOMER DETAILS -->
        <tr><td colspan="4" class="p-2 font-bold bg-gray-200"><i class="fa fa-id-card"></i> CUSTOMER DETAIL</td></tr>
        <tr>
            <td class="p-2 font-semibold">Customer Name</td><td class="p-2"><?=$job_row['customer_name']?></td>
            <td class="p-2 font-semibold">Contact No.</td><td class="p-2"><?=$job_row['contact_no']?></td>
        </tr>

        <tr>
            <td class="p-2 font-semibold">Alternate No.</td><td class="p-2"><?=$job_row['alternate_no']?></td>
            <td class="p-2 font-semibold">Email</td><td class="p-2"><?=$job_row['email']?></td>
        </tr>

        <tr>
            <td class="p-2 font-semibold">Address</td><td class="p-2"><?=$job_row['address']?></td>
            <td class="p-2 font-semibold">Pincode</td><td class="p-2"><?=$job_row['pincode']?></td>
        </tr>

        <!-- PRODUCT DETAILS -->
        <tr><td colspan="4" class="p-2 font-bold bg-gray-200"><i class="fa fa-desktop"></i> PRODUCT DETAIL</td></tr>

        <tr>
            <td class="p-2 font-semibold">Product</td>
            <td class="p-2"><?php echo getAnyDetails($job_row["product_id"],"product_name","product_id","product_master",$link1);?></td>
            <td class="p-2 font-semibold">Brand</td>
            <td class="p-2"><?php echo getAnyDetails($job_row["brand_id"],"brand","brand_id","brand_master",$link1);?></td>
        </tr>

        <tr>
            <td class="p-2 font-semibold">Model</td><td class="p-2"><?=$job_row['model']?></td>
            <td class="p-2 font-semibold">Accessory</td><td class="p-2"><?=$job_row['acc_rec']?></td>
        </tr>

        <tr>
            <td class="p-2 font-semibold"><?=SERIALNO?></td><td class="p-2"><?=$job_row['imei']?></td>
            <td class="p-2 font-semibold"></td><td class="p-2"></td>
        </tr>

        <tr>
            <td class="p-2 font-semibold">Job Type</td><td class="p-2"><?=$job_row['call_type']?></td>
            <td class="p-2 font-semibold">Job For</td><td class="p-2"><?=$job_row['call_for']?></td>
        </tr>

        <tr>
            <td class="p-2 font-semibold">Purchase Date</td><td class="p-2"><?=$job_row['dop']?></td>
            <td class="p-2 font-semibold">Warranty Status</td><td class="p-2"><?=$job_row['warranty_status']?></td>
        </tr>

        <!-- PROBLEM DETAILS -->
        <tr><td colspan="4" class="p-2 font-bold bg-gray-200"><i class="fa fa-pencil"></i> PROBLEM REPORTED</td></tr>

        <tr>
            <td class="p-2 font-semibold">Defect Reported</td>
            <td colspan="3" class="p-2">
                <?php
                $voc_name1 = explode("~",getAnyDetails($job_row['cust_problem'],"voc_desc","voc_code","voc_master",$link1));
                $voc_name2 = explode("~",getAnyDetails($job_row['cust_problem2'],"voc_desc","voc_code","voc_master",$link1));
                $voc_name3 = explode("~",getAnyDetails($job_row['cust_problem3'],"voc_desc","voc_code","voc_master",$link1));
                ?>
                <?=$voc_name1[0]." / ".$voc_name2[0]." / ".$voc_name3[0]?>
            </td>
        </tr>

        <tr><td class="p-2 font-semibold">Remark</td><td colspan="3" class="p-2"><?=$job_row['remark']?></td></tr>

        <!-- TERMS -->
        <tr>
            <td colspan="4" class="p-3 text-xs leading-tight">
                <strong>Terms & Conditions:</strong><br>
                1. The repair estimate will be provided on requestand the charges will be 25% of labour charge,If the estimate is not approved. <br/>
                2.  An advance of 50% of the approved estimate shall be collected before undertaking the repairs.
                <br/>
                3.All repairs (except for imported, tampered, mishandled products) are guaranteed for labor for one month from date of delivery.
                <br/>
                4.Imported products are accepted for repairs subject to availability of spare parts. <br/>
                5. Defective components for out warranty jobs shall be returned along with the repaired equipment.
                <br/>
                6.Reasonable care will be taken to the equipment given for repairs. However, we are not liable for any loss or damage arising from accident, fire, theft or any other cause beyond our control.
                <br/>
                7.  Equipment's remaining uncollected for more than 30 days from the date of intimation for collection shall be disposed at the customer's risk.
                <br/>
                8.Equipment will be delivered only against this receipt. 9.I agree to receive SMS notifications on my mobile related to the given Equipment.
                <br/>
            </td>
        </tr>

    </table>

</div>

<!-- ================== SERVICE CENTRE COPY (Design same as above – will format if you want) ================== -->

</body>
</html>
