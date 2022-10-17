<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else
{
// Code for restore
if($_GET['appid'])
{
	$id=intval($_GET['appid']);
	$query=mysqli_query($con,"update tblteacher set Is_Active='1' where id='$id'");
	if($query)
    {
        $delmsg="teacher Restored";
    }
    else{
        $delmsg="teacher Not Restored";
    }
}

// Code for deletion
if($_GET['action']=='del' && $_GET['rid'])
{
	$id=intval($_GET['rid']);
	$query=mysqli_query($con,"delete from  tblteacher  where id='$id'");

    if($query)
    {
        $delmsg="teacher deleted forever";
    }
    else{
        $delmsg="teacher Not deleted";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Novel-Design and Construction LTD</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="../plugins/morris/morris.css">

        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
           <?php include('includes/topheader.php');?>

            <!-- ========== Left Sidebar Start ========== -->
           <?php include('includes/leftsidebar.php');?>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Deleted Teachers </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Teachers</a>
                                        </li>
                                        <li class="active">
                                          Deleted Teachers 
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


<div class="row">
<div class="col-sm-6">  
 


<?php if($delmsg){ ?>
<div class="alert alert-danger" role="alert">
<strong></strong> <?php echo htmlentities($delmsg);?></div>
<?php } ?>


</div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                         

                                    <div class="table-responsive">
<table class="table table-colored table-centered table-inverse m-0">
<thead>
<tr>                    <th>#</th>
                        <th>Names</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Post</th>
                        <th>Action</th>
                        </tr>
</tr>
</thead>
<tbody>

<?php
$query=mysqli_query($con,"select id, name,phone, email, details, post from tblteacher where Is_Active = 0");
$rowcount=mysqli_num_rows($query);
if($rowcount==0)
{
?>
<tr>

<td colspan="6" align="center"><h3 style="color:red">No record found</h3></td>
<tr>
<?php 
} else {
    $cnt = 1;
while($row=mysqli_fetch_array($query))
{
?>
 <tr>
 <th scope="row"><?php echo htmlentities($cnt);?></th>
 <td><b><?php echo htmlentities($row['name']);?></b></td>
 <td><b><?php echo htmlentities($row['phone']);?></b></td>
 <td><?php echo htmlentities($row['email'])?></td>
 <td><?php echo ($row['details'])?></td>
 <td><?php echo htmlentities($row['post'])?></td>

<td>

  <a href="deleted-teacher.php?appid=<?php echo htmlentities($row['id']);?>" title="Restore this teacher"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a> 


	&nbsp;<a href="deleted-teacher.php?rid=<?php echo htmlentities($row['id']);?>&&action=del" title="Delete Permanently"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
</tr>
<?php 
 $cnt ++;
} }?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div> <!-- container -->

                </div> <!-- content -->

       <?php include('includes/footer.php');?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- CounterUp  -->
        <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!--Morris Chart-->
		<script src="../plugins/morris/morris.min.js"></script>
		<script src="../plugins/raphael/raphael-min.js"></script>

        <!-- Load page level scripts-->
        <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../plugins/jvectormap/gdp-data.js"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


        <!-- Dashboard Init js -->
		<script src="assets/pages/jquery.blog-dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>