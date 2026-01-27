<?php
require_once("../includes/config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../images/titleimg.png" type="image/png">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/abc.css" rel="stylesheet">
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/abc2.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">

    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script>
        let table;

        document.addEventListener("DOMContentLoaded", function () {
            table = $("#admin-grid").DataTable({
                paging: true,
                searching: false, // hum custom search use kar rahe
                ordering: true
            });

            DataFetch();

            const searchBox = document.getElementById("searchBox");
            let timer;

            searchBox.addEventListener("input", function () {
                clearTimeout(timer);
                const val = this.value;
                timer = setTimeout(() => DataFetch(val), 400);
            });
        });


        async function DataFetch(data = "") {
            const response = await fetch(`get-data.php?q=${encodeURIComponent(data)}`);
            const json = await response.json();
            loadData(json.data);   // ✅ ONLY ARRAY
        }

        function loadData(rows) {

            table.clear();

            if (!rows || rows.length === 0) {
                table.draw();
                return;
            }

            rows.forEach((row, index) => {

                let statusText =
                    row.status == "1" ? "Active" :
                        row.status == "2" ? "Deactive" : "On Hold";

                table.row.add([
                    index + 1,
                    row.username,
                    row.name,
                    row.utype,
                    row.phone,
                    row.emailid,
                    statusText,
                    `<a href="addAdminUser.php?id=${row.id}">
                <i class="fa fa-eye"></i>
             </a>`
                ]);
            });

            table.draw();
        }





    </script>

    <title><?=siteTitle?></title>
</head>
<body>
<div class="container-fluid">
    <div class="row content">
        <?php
        include("../includes/leftnav2.php");
        ?>
        <div class="<?=$screenwidth?> tab-pane fade in active" id="home">
            <h2 align="center" style="border-bottom:1px solid #aaa8a8;padding:25px 0px;margin:0px;"><i class="fa fa-users"></i> Admin Users Master</h2>

            <?php if($_REQUEST['msg']){?><br>
                <h4 align="center" style="color:#FF0000"><?=$_REQUEST['msg']?></h4>
            <?php }?>
            <form class="form-horizontal" role="form" name="form1" action="" method="get">
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-md-4">
                        <input type="text" id="searchBox" class="form-control"
                               placeholder="Search by ID / Username / Email">
                    </div>
                </div>
            </form>


            <form class="form-horizontal" role="form">
                <div class="form-group tab-area" id="page-wrap">
                    <div class="col-md-12">
                        <table  width="100%" id="admin-grid" class="display" align="center" cellpadding="4" cellspacing="0" border="1">
                            <thead>
                            <tr class="<?=$tableheadcolor?>">
                                <th>ID</th>
                                <th>Login Id</th>
                                <th>User Name</th>
                                <th>User Type</th>
                                <th>Phone No.</th>
                                <th>Email-id</th>
                                <th>Status</th>
                                <th>View/Edit</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
include("../includes/footer.php");
include("../includes/connection_close.php");
?>
</body>
</html>