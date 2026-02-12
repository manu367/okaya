<?php
require_once("../includes/config.php");

$edit_data = [];
$is_edit = false;
$op="";
$selected_bsi = [];
$selected_rm  = [];

/* =========================
   EDIT MODE LOAD
========================= */
if (isset($_GET['op']) && $_GET['op'] == 'edit' && isset($_GET['id'])) {
    $op=$_GET['op'];
    $is_edit = true;
    $loginid = $_GET['id'];

    $stmt = $link1->prepare("SELECT * FROM locationuser_master WHERE userloginid=?");
    $stmt->bind_param("s", $loginid);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
}

/* =========================
   FORM SUBMIT (ADD / UPDATE)
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id   = $_POST['user_id'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $contact   = $_POST['contact_no'];
    $email     = $_POST['email'];
    $address   = $_POST['address'];
    $pincode   = $_POST['pincode'];
    $state     = $_POST['state'];
    $city      = $_POST['city'];
    $status    = $_POST['status'];

    $mapped_bsi=$_POST['mapped_bsi'];
    $mapped_rm=$_POST['mapped_rm'];



    /* ===== UPDATE MODE ===== */
    if (isset($_POST['is_edit']) && $_POST['is_edit'] == 1) {

        $stmt = $link1->prepare("
            UPDATE locationuser_master 
            SET pwd=?, contactmo=?, emailid=?, address=?, 
                pincode=?, stateid=?, cityid=?, 
                mapped_bsi=?, mapped_rm=?, statusid=?, 
                updatedate=NOW()
            WHERE userloginid=?
        ");

        $stmt->bind_param(
                "ssssiiissis",
                $password,
                $contact,
                $email,
                $address,
                $pincode,
                $state,
                $city,
                $mapped_bsi,
                $mapped_rm,
                $status,
                $user_id
        );

        $stmt->execute();

        echo "<script>alert('User Updated Successfully');window.location='enginner_master.php';</script>";
        exit;
    }

    /* ===== ADD MODE ===== */
    else {
        $address=trim($address);
        $sql = "INSERT INTO locationuser_master (spare_location_code,
card_code,userloginid,locusername,pwd,emailid,type,contactmo,mapped_bsi,mapped_rm,cityid,stateid,address,
pincode,date_of_birth,date_of_joining,statusid, createdate)
VALUES ('','','$user_id','$username','$password','$email','','$contact','$mapped_bsi','$mapped_rm',$city,$state,'$address',$pincode,'','',$status,NOW())";

        if (mysqli_query($link1, $sql)) {
            echo "<script>alert('Added Successfully');window.location='enginner_master.php';</script>";
            exit;
        } else {
            echo "<script>alert('Somethings Wrong');window.location='enginner_master.php';</script>";
            exit;
        }
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
            $("#frm1").validate();
        });
        $(document).ready(function () {
            $('#dob').datepicker({
                format: "yyyy-mm-dd",
                endDate: "<?=$today?>",
                todayHighlight: true,
                autoclose: true
            });
            $('#doj').datepicker({
                format: "yyyy-mm-dd",
                //endDate: "<?//=$today?>",
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <!-- Include Date Picker -->
    <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="../css/bootstrap-multiselect.css" type="text/css"/>
    <style>
        .custom-error-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.2s ease;
        }

        .custom-error-modal {
            background: #fff;
            padding: 25px 30px;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
            animation: slideUp 0.25s ease;
            font-family: Arial, sans-serif;
        }

        .custom-error-modal h3 {
            color: #e63946;
            margin-bottom: 10px;
        }

        .custom-error-modal p {
            margin-bottom: 20px;
            color: #333;
        }

        .custom-error-modal button {
            padding: 8px 18px;
            border: none;
            background: #e63946;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .custom-error-modal button:hover {
            background: #c1121f;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
<body>
<div class="container-fluid">
    <div class="row content">
        <?php
        include("../includes/leftnav2.php");
        ?>
        <div class="<?=$screenwidth?>">
            <h2 align="center"><i class="fa fa-users"></i> <?=$op==='edit'?'Update':'Add'?> New User</h2><br/><br/>
            <div class="form-group"  id="page-wrap" style="margin-left:10px;" >
                <form  name="frm1" id="frm1" class="form-horizontal" action="" method="post">
<!--                    userid and username -> read only -->
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">
                                User ID<span class="red_small">*</span>
                            </label>
                            <div class="col-md-6">
                                <input name="user_id" type="text"
                                       value="<?= $is_edit ? $edit_data['userloginid'] : '' ?>"
                                       class="form-control"
                                        <?= $is_edit ? 'readonly' : '' ?>>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">User Name<span class="red_small">*</span></label>
                            <div class="col-md-6">
                                <input name="username" type="text"
                                       value="<?= $is_edit ? $edit_data['locusername'] : '' ?>"
                                       class="form-control"
                                        <?= $is_edit ? 'readonly' : '' ?>>

                            </div>
                        </div>
                    </div>
<!--                    password id and mobile no-->
                    <div class="form-group">
                        <div class="col-md-6"><label class="col-md-6 control-label">Password</label>
                            <div class="col-md-6">
                                <input name="password" type="text"
                                       value="<?= $is_edit ? $edit_data['pwd'] : '' ?>"
                                       class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6"><label class="col-md-6 control-label">Contact No.<span class="red_small">*</span></label>
                            <div class="col-md-6">
                                <input name="contact_no"
                                       type="text"
                                       class="digits form-control"
                                       id="contact_no"
                                       maxlength="10"
                                       minlength="10"
                                       value="<?= $is_edit ? $edit_data['contactmo'] : '' ?>"
                                       placeholder="+91XXXXXXX"
                                       required>
                            </div>
                        </div>
                    </div>
<!--                    email id , address-->
                    <div class="form-group">
                        <div class="col-md-6"><label class="col-md-6 control-label">Email</label>
                            <div class="col-md-6">
                                <input name="email"
                                       value="<?= $is_edit ? $edit_data['emailid'] : '' ?>"
                                       type="email" class="form-control"  id="email" placeholder="demo@gmail.com">
                            </div>
                        </div>
                        <div class="col-md-6"><label class="col-md-6 control-label">Address<span class="red_small">*</span></label>
                            <div class="col-md-6">
                                <textarea name="address"
                                          class="form-control">
                                    <?= $is_edit ? $edit_data['address'] : '' ?>
                                </textarea>

                            </div>
                        </div>
                    </div>
<!--                    pincode , state , -->
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Pin code</label>
                            <div class="col-md-6">
                                <input name="pincode"
                                       type="text"
                                       class="form-control"
                                       id="pincode"
                                       value="<?= $is_edit ? $edit_data['pincode'] : '' ?>"
                                       maxlength="6">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">State</label>
                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control select-search">
                                    <option value="">--Select State--</option>
                                </select>
                            </div>
                        </div>
                    </div>
<!--                    city , mapped bsdi [checkboxes]-->
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">City</label>
                            <div class="col-md-6">
                                <select name="city" id="city" class="form-control select-search">
                                    <option value="">--Select City--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Mapped BSI</label>
                            <div class="col-md-6">
                                <select name="mapped_bsi" id="prod_code" class="form-control">
                                    <option value="">--Select BSI--</option>
                                    <?php
                                    $sql="SELECT * FROM admin_users where designation_id=45";
                                    $result=mysqli_query($link1,$sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $isSelected=$edit_data['mapped_bsi']===$row['sapid']?"selected":"";
                                            echo '<option value="' . htmlspecialchars($row['sapid']) . '" '.$isSelected.'>'
                                                    . htmlspecialchars($row['name']) .
                                                    '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
<!--                    mapped rm [multiple checkbox= ek row me  2] and status-->
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Status</label>
                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control select-search">
                                    <option value="">--Select Status--</option>
                                    <option value="1" <?=$edit_data['statusid']==1?'selected':''?>>Active</option>
                                    <option value="0" <?=$edit_data['statusid']==0?'selected':''?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-6 control-label">Mapped RSI</label>
                            <div class="col-md-6">
                                <select name="mapped_rm" id="mapped_rm" class="form-control select-multiple" required>
                                    <option value="">--Select BSI--</option>
                                    <?php
                                    $sql="SELECT * FROM admin_users where designation_id=2";
                                    $result=mysqli_query($link1, $sql);
                                    if($result&&mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_assoc($result)){
                                            $isSelected=$edit_data['mapped_rm']===$row['sapid']?"selected":"";
                                            echo '<option value="' . htmlspecialchars($row['sapid']) . '" '.$isSelected.'>'
                                                    . htmlspecialchars($row['name']) .
                                                    '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="is_edit" value="<?= $is_edit ? 1 : 0 ?>">
                    <div class="text-center mt-5">
                        <button class="btn btn-primary">
                            <span id="operation_name"><?=$op==='edit'?'Update':'Add'?></span>
                        </button>
                        <span class="btn btn-primary" onclick="window.location.href='enginner_master.php'">
                            <span id="operation_name">Cancel</span>
                        </span>
                    </div>
                </form>
            </div><!--End form group-->
        </div><!--End col-sm-9-->
    </div><!--End row content-->
</div><!--End container fluid-->
<?php
include("../includes/footer.php");
include("../includes/connection_close.php");
?>
<script>
    const BASE_URL="../pagination/fetch_state_city.php";
    const state=document.getElementById("state");
    const city=document.getElementById("city");
    const pincode=document.getElementById("pincode");
    loadStates();
    state.addEventListener("change", function(){
        console.log(state.value);
        loadCities(state.value);
    })
    async function loadStates(selectedId=null){
        try{
            const response = await fetch(`${BASE_URL}?state`);
            if(!response.ok){
                throw new Error("Failed to fetch states");
            }
            const data = await response.text();
            state.innerHTML = data;
            if(selectedId){
                state.value = selectedId;
            }
        }catch(error){
            console.error("State Error:", error);
        }
    }
    async function loadCities(stateId,selectedCityId=null){
        try{
            const response = await fetch(`${BASE_URL}?state_id=${stateId}`);

            if(!response.ok){
                throw new Error("Failed to fetch cities");
            }
            const data = await response.text();
            city.innerHTML = data;
            if(selectedCityId){
                city.value = selectedCityId;
            }
        }catch(error){
            console.error("City Error:", error);
        }
    }

    pincode.addEventListener("input", async function(){
        this.value = this.value.replace(/\D/g, '');
        if(this.value.length === 6){
            try{
                const response = await fetch(`${BASE_URL}?pincode=${this.value}`);
                const data = await response.json();
                if(data.stateid){
                    await loadStates(data.stateid);
                    await loadCities(data.stateid, data.cityid);
                }
            }catch(err){
                console.error("Pincode error:", err);
            }
        }
    });

    city.addEventListener("change", async function(){
        const cityId = this.value;
        if(cityId){
            try{
                const response = await fetch(`${BASE_URL}?city_id=${cityId}`);
                const data = await response.text();
                pincode.value = data;
            }catch(err){
                console.error("City to Pincode error:", err);
            }
        }
    });

    window.addEventListener("load", async function () {
        const existingPincode = pincode.value;
        if (existingPincode && existingPincode.length === 6) {
            try {
                const response = await fetch(`${BASE_URL}?pincode=${existingPincode}`);
                const data = await response.json();
                if (data && data.stateid) {
                    await loadStates(data.stateid);
                    await loadCities(data.stateid, data.cityid);

                }
            } catch (error) {
                console.error("Edit Mode Pincode Error:", error);
            }
        }
    });

    async function loadAll(){
        try{
            const response = await fetch(`${BASE_URL}?state`);
            const data=await response.text();
            console.log(data);
        }catch (error){
            console.log("erro in pincode")
        }
    }

    function EError(message) {
        const overlay = document.createElement("div");
        overlay.className = "custom-error-overlay";
        overlay.innerHTML = `
      <div class="custom-error-modal">
        <h3>Error</h3>
        <p>${message}</p>
        <button id="closeErrorBtn">Close</button>
      </div>
    `;
        document.body.appendChild(overlay);
        document.getElementById("closeErrorBtn").onclick = function() {
            overlay.remove();
        };
        overlay.onclick = function(e) {
            if (e.target === overlay) {
                overlay.remove();
            }
        };
    }
    EError("This is wrong");

</script>


</body>
</html>