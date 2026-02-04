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
 $(document).ready(function(){
	$('input[name="daterange"]').daterangepicker({
		locale: {
			format: 'YYYY-MM-DD'
		}
	});
});
 
 $(document).ready(function() {
	var dataTable = $('#party-ledger-grid').DataTable( {
		"processing": true,
		"serverSide": true,
		//"order": [[ 3, "asc" ]],
		"ajax":{
			url :"../pagination/party-ledgerasp-grid-data.php", // json datasource
			data: { "pid": "<?=$_REQUEST['pid']?>", "hid": "<?=$_REQUEST['hid']?>" ,"daterange": "<?=$_REQUEST['daterange']?>", "location": "<?=$_SESSION['asc_code']?>"},
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".party-ledger-grid-error").html("");
				$("#party-ledger-grid").append('<tbody class="party-ledger-grid-error"><tr><th colspan="11">No data found in the server</th></tr></tbody>');
				$("#party-ledger-grid_processing").css("display","none");
				
			}
		}
	} );
} );


</script>
<!-- Include Date Range Picker -->
 <script type="text/javascript" src="../js/daterangepicker.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/daterangepicker.css"/>
 <!-- Include Date Picker -->
<link rel="stylesheet" href="../css/datepicker.css">
<script src="../js/bootstrap-datepicker.js"></script>
<title><?=siteTitle?></title>
    <style>

        .my-model{
            position: fixed;
            inset: 0;
            z-index: 999;

            display: flex;
            justify-content: center;
            align-items: center;

            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(12px);

            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }


        .my-model.active{
            opacity: 1;
            pointer-events: auto;
        }

        .inner-model{
            width: min(60%, 900px);
            height: 80%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow:
                    0 20px 40px rgba(0,0,0,0.25),
                    0 0 0 6px whitesmoke;
            transform: translateY(120px) scale(0.96);
            opacity: 0;
            will-change: transform, opacity;
        }

        /* Open state */
        .inner-model.open{
            animation: modalOpen 0.4s cubic-bezier(.22,.61,.36,1) forwards;
        }

        /* Close state */
        .inner-model.closed{
            animation: modalClose 0.3s ease-in forwards;
        }
        .inner-model{
            animation: outline 0.4s cubic-bezier(.22,.61,.36,1) forwards;
        }

        /* Animations */
        @keyframes modalOpen {
            from {
                transform: translateY(120px) scale(0.96);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        @keyframes modalClose {
            from {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            to {
                transform: translateY(120px) scale(0.96);
                opacity: 0;
            }
        }
        @keyframes outline {
            0%{
                border-top: 1px solid red;
            }
            25%{
                border-right: 1px solid #99334e;
            }
            50%{
                border-bottom: 1px solid #096ef3;
            }
            75%{
                border-left: 1px solid #07f61a;
            }
            100%{
                border-top: 1px solid #051149;
            }
        }

    </style>
</head>
<body>
<div class="my-model">
    <div class="inner-model">
    </div>
</div>
<button>click</button>
<script>
    /* Grab elements */
    const modal = document.querySelector(".my-model");
    const box   = document.querySelector(".inner-model");
    const btn   = document.querySelector("button");

    function openmodal() {
        modal.classList.add("active");

        box.classList.remove("closed");
        box.classList.add("open");

        // body scroll lock (classic UX rule)
        document.body.style.overflow = "hidden";
    }


    function closemodal() {
        box.classList.remove("open");
        box.classList.add("closed");

        // wait for close animation to finish
        setTimeout(() => {
            modal.classList.remove("active");
            document.body.style.overflow = "";
        }, 300); // match CSS close animation time
    }
    btn.addEventListener("click", openmodal);

    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            closemodal();
        }
    });
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal.classList.contains("active")) {
            closemodal();
        }
    });
</script>

<div class="container-fluid">
  <div class="row content">
	<?php 
    include("../includes/leftnavemp2.php");
    ?>
    <div class="<?=$screenwidth?> tab-pane fade in active" id="home">
      <h2 align="center"><i class="fa fa-check"></i> Party Ledger</h2>
      <?php if($_REQUEST['msg']){?><br>
      <h4 align="center" style="color:#FF0000"><?=$_REQUEST['msg']?></h4>
      <?php }?>
	  <br></br>
	  <form class="form-horizontal" role="form" name="form1" action="" method="get">
	  <div class="form-group">
         <div id= "dt_range" class="col-md-6"><label class="col-md-5 control-label">Date Range</label>	  
			<div class="col-md-6 input-append date" align="left">
			 <input type="text" name="daterange" id="date_rng" class="form-control" value="<?=$_REQUEST['daterange']?>" />
            </div>
          </div>
		  <div class="col-md-6"><label class="col-md-5 control-label"></label>	  
			<div class="col-md-5" align="left">
			<input name="pid" id="pid" type="hidden" value="<?=$_REQUEST['pid']?>"/>
               <input name="hid" id="hid" type="hidden" value="<?=$_REQUEST['hid']?>"/>
               <input name="Submit" type="submit" class="btn<?=$btncolor?>" value="GO"  title="Go!">  
            </div>
          </div>
	    </div><!--close form group-->

	  </form>
        <?php if ($_REQUEST['Submit']){
		   ?>
           <div class="form-group">
		  <div class="col-md-6"><label class="col-md-5 control-label"></label>	  
			<div class="col-md-5" align="left">
               <?php
			   ?>
               <a href="../excelReports/partyledgerasp_excel.php?location=<?=$_SESSION['asc_code']?>&daterange=<?=$_REQUEST['daterange']?>" title="Export Party Ledger details in excel"><i class="fa fa-file-excel-o fa-2x faicon" title="Export Party Ledger details in excel"></i></a>
               <?php
				//}
				?>
            </div>
          </div>
	    </div><!--close form group-->
		 <?php }?>
	  
      <form class="form-horizontal" role="form">
        <div class="form-group"  id="page-wrap" style="margin-left:10px;"><br/><br/>
      <!--<div class="form-group table-responsive"  id="page-wrap" style="margin-left:10px;"><br/><br/>-->
       <table  width="100%" id="party-ledger-grid" class="display" align="center" cellpadding="4" cellspacing="0" border="1">
          <thead>
            <tr class="<?=$tableheadcolor?>">
              <th>S.No</th>
              <th>Trasaction Details</th>
			  <th>Trsacation Type</th>
			  <th>Trasaction Date</th>         
               <th>Amount Cr</th>
              <th>Amount Dr</th>
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
</body>
</html>