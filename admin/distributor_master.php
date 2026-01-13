<?php
class DistributorMaster{
    private $result;
    private $link1;
    public function __construct($conn){
        $this->link1=$conn;
    }
    public function loadData($query="Select * from distributor_master"){
       $this->result =mysqli_query($query);
    }
    public function addDistributor(){
        $this->result=$this->loadData();
    }
    public function getResult():array{
        return $this->result;
    }
}
?>

<?php
require_once("../includes/config.php");
$sql = "SELECT * FROM distributor_master ORDER BY distributorid DESC";
$q   = mysqli_query($link1,$sql);
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="shortcut icon" href="../images/titleimg.png" type="image/png">
 <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
 <link href="../css/abc.css" rel="stylesheet">
 <script src="../js/jquery.js"></script>
 <script src="../js/bootstrap.min.js"></script>
 <link href="../css/abc2.css" rel="stylesheet">
 <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<title><?=siteTitle?></title>
</head>
<body>
<div class="container-fluid">
  <div class="row content">
	<?php 
    include("../includes/leftnav2.php");
    ?>
    <div class="<?=$screenwidth?>">
      <h2 align="center"><i class="fa  fa-shopping-basket "></i> Distributer Master</h2>
     <?php if($_REQUEST['msg']){?><br>
      <div class="alert alert-<?=$_REQUEST['chkflag']?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            <strong><?=$_REQUEST['chkmsg']?>!</strong>&nbsp;&nbsp;<?=$_REQUEST['msg']?>.
        </div>
      <?php }?>   
	    <div class="form-group">
		  <div class="col-md-6">  
			<div class="col-md-5" align="left">
			 
            </div>
          </div>
	    </div><!--close form group-->
      <form class="form-horizontal" role="form">
        <div style="display:inline-block;float:right"><button title="Add Distributer" type="button" class="btn<?=$btncolor?>" style="float:right;" onClick="window.location.href='op_distributor.php?op=Add<?=$pagenav?>'"><span>Add Distriupter Supplier</span></button>&nbsp;&nbsp;</div>
        <div class="form-group"  id="page-wrap" style="margin-left:10px;"><br/><br/>
      <!--<div class="form-group table-responsive"  id="page-wrap" style="margin-left:10px;"><br/><br/>-->
       <table  width="100%" id="example" class="display" align="center" cellpadding="4" cellspacing="0" border="1">
          <thead>
          <tr class="<?=$tableheadcolor?>">
              <th>S.No</th>
              <th>Name</th>
              <th>Code</th>
              <th>SAP Code</th>
              <th>User</th>
              <th>Type</th>
              <th>Brand</th>
              <th>Email</th>
              <th>Address</th>
              <th>City</th>
              <th>State</th>
              <th>Country</th>
              <th>Pincode</th>
              <th>Company</th>
              <th>Phone</th>
              <th>Mobile</th>
              <th>GST</th>
              <th>Status</th>
              <th>Updated By</th>
              <th>Updated On</th>
              <th>Sale Segment</th>
              <th>Edit</th>
          </thead>
           <tbody>
           <?php $sn=1; while($r=mysqli_fetch_assoc($q)){ ?>
               <tr>
                   <td><?=$sn++?></td>
                   <td><?=$r['distributorname']?></td>
                   <td><?=$r['distributorcode']?></td>
                   <td><?=$r['sap_hanacode']?></td>
                   <td><?=$r['userid']?></td>
                   <td><?=$r['type']?></td>
                   <td><?=$r['brand']?></td>
                   <td><?=$r['email']?></td>
                   <td><?=$r['address1']?> <?=$r['address2']?> <?=$r['landmark']?></td>
                   <td><?=$r['cityid']?></td>
                   <td><?=$r['stateid']?></td>
                   <td><?=$r['countryid']?></td>
                   <td><?=$r['pincode']?></td>
                   <td><?=$r['companyid']?></td>
                   <td><?=$r['phone']?></td>
                   <td><?=$r['mobile']?></td>
                   <td><?=$r['gst_no']?></td>
                   <td>
                       <?= $r['status']=="active" ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Deactive</span>" ?>
                   </td>
                   <td><?=$r['updateby']?></td>
                   <td><?=$r['update_date']?></td>
                   <td><?=$r['sale_segment']?></td>
                   <td align="center">
                       <a href="op_distributor.php?op=Edit&id=<?=$r['distributorid']?>" class="btn btn-xs btn-info">
                           <i class="fa fa-pencil"></i> Edit
                       </a>
                   </td>
               </tr>
           <?php } ?>
           </tbody>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            // Paging is true by default, but can be explicitly set
            "paging": true,
            // Optional: set the initial number of records per page
            "pageLength": 10
        });
    });
</script>
</body>
</html>