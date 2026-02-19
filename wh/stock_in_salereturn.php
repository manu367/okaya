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
 <script type="text/javascript" src="../js/moment.js"></script>
 <link href="../css/abc2.css" rel="stylesheet">
 <link rel="stylesheet" href="../css/bootstrap.min.css">
 <!-- datatable plugin-->
 <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
 <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
 <!--  -->
 <script type="text/javascript" language="javascript" >
$(document).ready(function() {
    async function addStyle(){
        const style=`<style>
        .skeleton-row td{
            padding:10px;
        }
        .skeleton{
            height:14px;
            border-radius:4px;
            background:#e0e0e0;
            position:relative;
            overflow:hidden;
        }
        .skeleton:after{
            content:"";
            position:absolute;
            top:0;
            left:-150px;
            height:100%;
            width:150px;
            background:linear-gradient(90deg,transparent,rgba(255,255,255,.7),transparent);
            animation:shimmer 1.2s infinite;
        }
        @keyframes shimmer{
            100%{ left:100%; }
        }
    </style>`;
        document.head.innerHTML+=style;
    }
    async function showSkeleton(rows=8){
        await addStyle();
        const tbody=document.querySelector("#receive-salereturn-grid tbody");
        if(!tbody) return;
        let html="";
        for(let i=0;i<rows;i++){
            html+=`<tr class="skeleton-row">
        ${"<td><div class='skeleton'></div></td>".repeat(10)}
        </tr>`;
        }
        tbody.innerHTML=html;
    }
    showSkeleton();
    var table = $('#receive-salereturn-grid');
    table.on('preXhr.dt', function () {
        showSkeleton();
    });

    var dataTable = table.DataTable( {
		"processing": false,
		"serverSide": true,
		//"order": [[ 4, "desc" ]],
		"ajax":{
			url :"../pagination/receive-salereturn-grid-data.php", // json datasource
			data: { "pid": "<?=$_REQUEST['pid']?>", "hid": "<?=$_REQUEST['hid']?>", "daterange": "<?=$_REQUEST['daterange']?>", "status": "<?=$_REQUEST['status']?>"},
			type: "post",  // method  , by default
			error: function(){  // error handling
				$(".receive-salereturn-grid-error").html("");
				$("#receive-salereturn-grid").append('<tbody class="receive-salereturn-grid-error"><tr><th colspan="10">No data found in the server</th></tr></tbody>');
				$("#receive-salereturn-grid_processing").css("display","none");

			}
		}
	} );


} );
</script>
<title><?=siteTitle?></title>


</head>
<body>
<my-greeting message="this is manu pathak" style="background-color: red;border: 1px solid red; border-radius: 10px;"></my-greeting>
<div class="container-fluid">
  <div class="row content">
	<?php 
    include("../includes/leftnavemp2.php");
    ?>
    <div class="<?=$screenwidth?> tab-pane fade in active" id="home">
      <h2 align="center"><i class="fa fa-reply-all"></i> Receive Purchase Return</h2>
      <?php if($_REQUEST['msg']){?>
        <div class="alert alert-<?=$_REQUEST['chkflag']?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            <strong><?=$_REQUEST['chkmsg']?>!</strong>&nbsp;&nbsp;<?=$_REQUEST['msg']?>.
        </div>
        <?php }?>  
      <form class="form-horizontal" role="form">
        <div class="form-group"  id="page-wrap" style="margin-left:10px;"><br/><br/>
      <!--<div class="form-group table-responsive"  id="page-wrap" style="margin-left:10px;"><br/><br/>-->
       <table  width="100%" id="receive-salereturn-grid" class="display" align="center" cellpadding="4" cellspacing="0" border="1">
          <thead>
            <tr class="<?=$tableheadcolor?>">
              <th>S.No</th>
              <th>From Location Name</th>
			 <th>To Location Name</th>
			  <th>Challan No.</th>
			  <th>Entry Date</th>
			  <th>Status</th> 
                <th>Type</th> 
                <th>Print</th>   
                 <th>Action</th> 
			
			  <th>View</th>
            </tr>
          </thead>
          </table>
          </div>
      <!--</div>-->
      </form>
    </div>
    
  </div>
</div>
<?php
include("../includes/footer.php");
include("../includes/connection_close.php");
?>
<script>
    const URL="../pagination/receive-salereturn-grid-data.php";
    async function getAllData() {
        const formdata = new FormData();

        // Your existing variables
        formdata.append("pid", "<?=$_REQUEST['pid']?>");
        formdata.append("hid", "<?=$_REQUEST['hid']?>");
        formdata.append("datarange", "<?=$_REQUEST['daterange']?>");
        formdata.append("status", "<?=$_REQUEST['status']?>");

        // // DataTables columns
        // for (let i = 0; i <= 9; i++) {
        //     formdata.append(`columns[${i}][data]`, i);
        //     formdata.append(`columns[${i}][name]`, "");
        //     formdata.append(`columns[${i}][searchable]`, "true");
        //     formdata.append(`columns[${i}][orderable]`, "true");
        //     formdata.append(`columns[${i}][search][value]`, "");
        //     formdata.append(`columns[${i}][search][regex]`, "false");
        // }
        //
        // Order
        formdata.append("order[0][column]", "0");
        formdata.append("order[0][dir]", "asc");

        // Pagination
        formdata.append("start", "0");
        formdata.append("length", "10");

        // Global search
        // formdata.append("search[value]", "");
        // formdata.append("search[regex]", "false");

        const response = await fetch(URL, {
            method: "POST",
            body: formdata
        });

        const data = await response.json();
        return data;
    }
    function testing(data){
        if(data.length >0){
            throw new Error("No Data Found");
        }
        return data;
    }
    getAllData()
    .then(res=>{
        if (!res.data || res.data.length === 0) {
            throw new Error("Something is wrong, no data received");
        }
        return res.data;
    })
        .then(res=>{
            const data=testing(res);
            return data;
        })
    .then(data => console.log(data))
    .catch(err => console.log(err.message));
</script>
</body>
</html>