<?php
require_once("../includes/config.php");
require_once ("../ExcelExportAPI/Classes/PHPExcel.php");
require_once ("../ExcelExportAPI/Classes/PHPExcel/IOFactory.php");

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
    <script src="../js/frmvalidate.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../js/common_js.js"></script>
    <style>
        /* Loader */
        #loaderOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 9999;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #ddd;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loader-text {
            margin-top: 15px;
            color: #fff;
            font-size: 16px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Error Popup */
        #errorPopup {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .error-box {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .error-box h4 {
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .error-box button {
            margin-top: 15px;
            padding: 8px 20px;
            border: none;
            background: #e74c3c;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        /* Modal Background */
        #resultArea {
            overflow-y: auto;           /* 👈 scroll yahin aayega */
            max-height: 60vh;           /* 👈 table yahin fit hogi */
        }
        .custom-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        /* Default Open */
        .custom-modal.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Modal Box */
        .modal-content {
            background: #fff;
            width: 90%;
            max-width: 900px;
            max-height: 85vh;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            transform: scale(0.8) translateY(30px);
            animation: popUp 0.45s ease forwards;
            display: flex;
            flex-direction: column;
        }

        /* Animation */
        @keyframes popUp {
            to {
                transform: scale(1) translateY(0);
            }
        }

        /* Heading */
        .modal-content h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f3f4f6;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        th {
            color: #555;
            font-weight: 600;
        }

        td {
            color: #444;
        }
        .close-btn {
            position: absolute;
            top: 15px;
            right: 18px;
            font-size: 28px;
            color: #666;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: #ff4d4d;
            transform: rotate(90deg);
        }

        .modal-content {
            position: relative;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row content">
        <?php
        include("../includes/leftnav2.php");
        ?>
        <div class="<?=$screenwidth?> tab-pane fade in active" id="home">
            <h2 align="center"><i class="fa fa-upload"></i>Upload Inverted Serial</h2><div style="display:inline-block;float:right">
                <a href="../templates/batterySerieluploader.xlsx" title="Download Excel Template"><img src="../images/template.png" title="Download Excel Template"/></a></div>	<br></br>

            <div class="form-group"  id="page-wrap" style="margin-left:10px;">
                <form  name="frm1"  id="frm1" class="form-horizontal" action="" method="post"  enctype="multipart/form-data">


                    <div class="form-group">
                        <div class="col-md-12"><label class="col-md-4 control-label">Attach File<span class="red_small">*</span></label>
                            <div class="col-md-4">
                                <div>
                                    <label >
                       <span>
                        <input id="file" type="file"  name="file"  required class="form-control"   accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/ >
                    </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4" align="right"><span class="red_small">NOTE: Attach only <strong>.xlsx (Excel Workbook)</strong> file</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12" align="center">
                            <input type="button" class="btn<?=$btncolor?>" id="uploadBtn" value="Upload">
                            &nbsp;&nbsp;&nbsp;

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<div id="customModal" class="custom-modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">×</span>
        <h2>📊 Data Preview</h2>
        <div id="resultArea">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>101</td>
                    <td>Manu</td>
                    <td>Active</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id="loaderOverlay">
    <div class="spinner"></div>
    <div class="loader-text">Processing Excel…</div>
</div>
<div id="errorPopup">
    <div class="error-box">
        <h4>⚠️ Error</h4>
        <p id="errorMsg"></p>
        <button onclick="closeError()">OK</button>
    </div>
</div>
<?php
include("../includes/footer.php");
include("../includes/connection_close.php");
?>
<script>
    function closeModal() {
        document.getElementById("customModal").classList.remove("active");
    }
    function ShowModal() {
        document.getElementById("customModal").classList.add("active");
    }
    function showLoader() {
        document.getElementById("loaderOverlay").style.display = "flex";
    }

    function hideLoader() {
        document.getElementById("loaderOverlay").style.display = "none";
    }

    function showError(msg) {
        document.getElementById("errorMsg").innerText = msg;
        document.getElementById("errorPopup").style.display = "flex";
    }

    function closeError() {
        document.getElementById("errorPopup").style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function () {

        const uploadBtn = document.getElementById("uploadBtn");
        const fileInput = document.getElementById("file");
        const resultArea = document.getElementById("resultArea");
        uploadBtn.addEventListener("click",async ()=>{
            if (!fileInput.files.length) {
                showError("Please select an Excel file first");
                return;
            }
            let formData = new FormData();
            formData.append("file", fileInput.files[0]);
            showLoader();
            //resultArea.innerHTML = "Uploading & processing... ⏳";
            try {
                const response = await fetch("../pagination/report-validation-data.php", {
                    method: "POST",
                    body: formData
                });

                const html = await response.text(); // 👈 HTML expected
                resultArea.innerHTML = html;
                ShowModal();

            } catch (err) {
                showError(err.message || "Upload failed");
                resultArea.innerHTML = "<span style='color:red'>Upload failed</span>";
            }finally {
                hideLoader();
            }
        });
    });
    function collectTableData() {
        let data = [];

        document.querySelectorAll("#editableTable tbody tr").forEach(row => {
            let obj = {
                model: row.querySelector(".model").innerText.trim(),
                type: row.querySelector(".type").innerText.trim(),
                status: row.querySelector(".status").innerText.trim()
            };
            data.push(obj);
        });

        console.log(data); // 👈 yahin se PHP ko bhej sakta hai
        let confirm1=confirm("Data collected. Console check kar.")
        if(confirm1) closeModal();

    }
</script>
</body>
</html>