<?php
require_once("../includes/config.php");
require_once "Addinvoice.php";
$access_product = getAccessProduct($_SESSION['asc_code'],$link1);
$billingUi=new BillingUI($link1);
if (isset($_POST['brand'], $_POST['productid'])) {

    $options = $billingUi->getModal(
            (int)$_POST['brand'],
            (int)$_POST['productid']
    );

    echo json_encode([
            "status"  => true,
            "options" => $options
    ]);
    exit;
}
if(isset($_POST['modelid'],$_POST['asc_code'])) {
    $options=$billingUi->getPartCodeOptions($_POST['modelid'],$_POST['asc_code']);
    echo json_encode([
            "status"  => true,
           "options" => $options
    ]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= siteTitle ?></title>
    <script src="../js/jquery.js"></script>
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/abc.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/abc2.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/frmvalidate.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../js/common_js.js"></script>
    <!-- Include Date Picker -->
    <link rel="stylesheet" href="../css/datepicker.css">
    <script src="../js/bootstrap-datepicker.js"></script>
    <link href="../css/global.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <?php include("../includes/leftnavemp2.php"); ?>

        <div class="<?=$screenwidth?>">
            <h2 class="text-center mb-4">
                <i class="fa fa-user"></i> Retail Invoice
            </h2>
<!--            complete form group-->
            <div class="form-group" id="page-wrap" style="margin-left:10px;">

                <form id="frm1" name="frm1" class="form-horizontal" action="" method="post">

<!--                    billing from-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-3 control-label">
                                Billing  From<span style="color:#F00">*</span>
                            </label>
                            <div class="col-md-6">
                                <select name="billingform" id="billingform"
                                        required

                                        class="form-control required"
                                        data-live-search="true">
                                    <option value="#">---Select Value---</option>
                                    <?php echo $billingUi->getBillingForm($_SESSION['asc_code'], $_GET['po_from'] ?:'')?>
                                </select>
                            </div>
                        </div>
                    </div>

<!--                    customer name-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-3 control-label">
                                Customer Name<span style="color:#F00">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" id="customerName" name="customerName"
                                       class="form-control required"
                                       required placeholder="Customer Name">
                            </div>

                        </div>
                    </div>

<!--                    state and gstn number -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-3 control-label">
                                State<span style="color:#F00">*</span>
                            </label>
                            <div class="col-md-3">
                                <select name="state" id="state"
                                        required class="form-control required"
                                        data-live-search="true"
                                >
                                    <option value="" selected="selected">-- Select State -- </option>
                                    <?= $billingUi->getAllState($_GET['state'] ?: '');?>
                                </select>
                            </div>

                            <label class="col-md-1 control-label">GSTN</label>
                            <div class="col-md-3">
                                <input type="text"
                                       class="form-control"
                                       name="customergstn"
                                       id="customergstn"
                                       placeholder="GSTN Number"
                                       style="width:150px;">
                            </div>
                        </div>
                    </div>
<!--                    contact no and Email-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-3 control-label">
                                Contact No<span style="color:#F00">*</span>
                            </label>
                            <div class="col-md-3">
                                <input type="text"
                                       id="customercontactno"
                                       name="customercontactno"
                                       placeholder="Phone"
                                       class="form-control"
                                       maxlength="10"
                                       oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>

                            <label class="col-md-1 control-label">Email</label>
                            <div class="col-md-3">
                                <input type="email"
                                       class="form-control"
                                       name="customeremail"
                                       id="customeremail"
                                       placeholder="Email"
                                       style="width:150px;">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align: center">
                <button onclick="handleAddInvoice()" class="btn btn-primary">Add Invoice</button>
            </div>

        </div>
    </div>
</div>
<!--error modal-->
<div class="invoice-modal" id="errorModal">
    <div class="custom-modal error-modal">
        <button class="modal-close" onclick="closeErrorModal()">×</button>

        <div class="error-header">
            <span class="error-icon">⚠️</span>
            <h2>Form Error</h2>
        </div>

        <div class="modal-body">
            <p id="errorMessage" class="error-text"></p>
        </div>

        <div class="error-footer">
            <button class="btn btn-danger" onclick="closeErrorModal()">Okay, Fix It</button>
        </div>
    </div>
</div>

<div class="invoice-modal" id="invoiceModal">
    <div class="custom-modal">
        <button class="modal-close" onclick="closeModal()">×</button>
        <h2>Retail Invoice</h2>

        <div class="modal-body invoice-ui">

            <!-- Invoice Table -->
            <div class="table-responsive">
                <table class="table table-bordered invoice-table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Part</th>
                        <th>Serial No</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Cost</th>
                        <th>Discount</th>
                        <th>Value After Discount</th>
                        <th>IGST(%)</th>
                        <th>IGST Amt</th>
                        <th>Total</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr>
                        <!--product-->
                        <td><select class="form-control" id="product_master" onchange="product()">
                                <option>--Select--</option>
                                <?=$billingUi->getAllProducts($access_product,$_GET['product'] ? :'');?>
                            </select>
                        </td>
<!--                        brand-->
                        <td>
                            <select disabled class="form-control" style="width: 50px" id="brand_master" onchange="brand()">
                                <option value="0">Select</option>
                                <?= $billingUi->getBrand($_GET['brand'] ?: '');?>
                            </select>
                        </td>
<!--                        modal-->
                        <td>
                            <select disabled
                                    class="form-control"
                                    id="model_master"
                                    onchange="model('<?= $_SESSION['asc_code']; ?>')">
                                <option>Select</option>
                            </select>
                        </td>

                        <!--                        part code -->
                        <td><select disabled class="form-control" id="part_master" onchange="partcode()"><option>Select</option></select></td>
<!--                        serial no-->
                        <td><input placeholder="000-000-00"  type="text" class="form-control" id="serial_no"></td>
                        <script>

                            const se = document.getElementById("serial_no");
                            se.addEventListener("input", function (e) {
                                let value = e.target.value.replace(/[^0-9]/g, '');
                                if (value.length > 10) {
                                    value = value.slice(0, 10);
                                }
                                se.value = value;
                                if (/^[0-9]{10}$/.test(value)) {
                                    console.log("Valid Serial No:", value);
                                }
                                serialNoCheck(se.value);
                            });
                        </script>
<!--                        qty-->
                        <td><input disabled type="number" class="form-control" id="qty_modal" ></td>
<!--                        price-->
                        <td><input disabled type="number" class="form-control" id="price_modal"></td>
<!--                        cost-->
                        <td><input disabled type="number" class="form-control" id="cost_modal"></td>
                        <td><input disabled type="number" class="form-control" id="discount_modal"></td>
                        <td><input disabled type="number" class="form-control" value="0" id="value_after_discount"></td>
                        <td><input disabled type="number" class="form-control" value="0" id="igst_per"></td>
                        <td><input disabled type="number" class="form-control" value="0" id="igst_amt"></td>
                        <td><input disabled type="number" class="form-control" id="total"></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add Row -->
            <div class="add-row">
                <button class="btn btn-link">
                    <span class="add-icon">＋</span> Add Row
                </button>
            </div>

            <!-- Totals Section -->
            <div class="row totals-section">
                <div class="col-md-6"></div>

                <div class="col-md-6">
                    <div class="total-line">
                        <label>Total Price</label>
                        <input disabled type="text" class="form-control" value="0.00" readonly>
                    </div>
                    <div class="total-line">
                        <label>Discount</label>
                        <input disabled type="text" class="form-control" value="0.00">
                    </div>
                    <div class="total-line">
                        <label>Sub Total</label>
                        <input disabled type="text" class="form-control" value="0.00" readonly>
                    </div>
                    <div class="total-line">
                        <label>Round Off</label>
                        <input disabled type="text" class="form-control" value="0.00">
                    </div>
                    <div class="total-line grand-total">
                        <label>Grand Total</label>
                        <input disabled  type="text" class="form-control" value="0" readonly>
                    </div>
                </div>
            </div>

            <!-- Address & Remark -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <label>Delivery Address <span class="text-danger">*</span></label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Remark</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>
            <!-- Process Button -->
            <div class="text-center mt-4">
                <button class="btn btn-primary btn-lg">Process</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/invoice-manage.js"></script>
</body>
</html>