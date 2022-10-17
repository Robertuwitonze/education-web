<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
$catid=intval($_GET['pid']);
$names=$_POST['names'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$course=$_POST['course']; 
$details=$_POST['details'];
$post=$_POST['post'];

$query=mysqli_query($con,"Update tblteacher set name='$names',phone='$phone',email='$email',course='$course',details='$details',
                          post='$post' where id='$catid'");
if($query)
{
$msg="Teacher Updated successfully ";
}
else{
$error="Something went wrong . Please try again.";    
} 
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Novel-Design and Construction LTD</title>
        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- Select2 -->
        <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- Jquery filer css -->
        <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
        <script src="assets/js/modernizr.min.js"></script>
       

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

<!-- Top Bar Start -->
 <?php include('includes/topheader.php');?>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->
           <?php include('includes/leftsidebar.php');?>
 <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Edit Teacher</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Teachers </a>
                                        </li>
                                        <li class="active">
                                            Edit Teacher
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Edit Teacher </b></h4>
                                    <hr />
                        		


<div class="row">
<div class="col-sm-6">  
<!---Success Message--->  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong>Well done!</strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong></strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>

<?php 
include ('includes/config.php');
$catid=intval($_GET['pid']);
$teacher_query=mysqli_query($con,"SELECT tblteacher.id as id, tblteacher.name as name, tblteacher.phone as phone, tblteacher.email as email, 
                           tblteacher.details as details,  tblteacher.post as post,  tblteacher.image as image
                           from tblteacher where tblteacher.Is_Active = 1 and tblteacher.id='$catid' ");
$cnt=1;
while($row=mysqli_fetch_array($teacher_query))
{
?>



                        			<div class="row">
                                        <div class="col-md-6">
                                            <form class="form-horizontal" name="category" method="post">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Names</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($row['name']);?>" name="names" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Email</label>
                                                    <div class="col-md-10">
                                                        <input type="email" class="form-control" value="<?php echo htmlentities($row['email']);?>" name="email" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Phone</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($row['phone']);?>" name="phone" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                <label class="col-md-2 control-label">Course</label>
                                                <div class="col-md-10">
                                                <select class="form-control" name="course" id="#" >
                                                <option value="<?php echo htmlentities($row['courseid']);?>"><?php echo htmlentities($row['course']);?></option>
                                                <?php
                                                // Feching active levels
                                                $ret=mysqli_query($con,"select id,Name from  tblcourse where Is_Active=1");
                                                while($result=mysqli_fetch_array($ret))
                                                {    
                                                ?>
                                                <option value="<?php echo htmlentities($result['Name']);?>"><?php echo htmlentities($result['Name']);?></option>
                                                <?php } ?>
                                                </select> 
                                                </div>
                                                </div>
                                                
                                                <div class="row">
                                                  <div class="col-sm-12">
                                                     <div class="card-box">
                                                       <h4 class="m-b-30 m-t-0 header-title"><b>Details</b></h4>
                                                        <textarea class="summernote" name="details" required><?php echo ($row['details']);?></textarea>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Post</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" value="<?php echo htmlentities($row['post']);?>" name="post" required>
                                                    </div>
                                                </div>

                                                    <div class="row">
                                                      <div class="col-sm-12">
                                                        <div class="card-box">
                                                        <h4 class="m-b-30 m-t-0 header-title"><b>Teacher Image</b></h4>
                                                        <img src="teacherimages/<?php echo htmlentities($row['image']);?>" width="300"/>
                                                        <br />
                                                        <a href="change-teacher-image.php?pid=<?php echo htmlentities($catid);?>">Update Image</a>
                                                        </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                               <div class="form-group ">
                                                    <label class="col-md-30 control-label">&nbsp;</label>
                                                    <div class="col-md-10">
                                                  
                                                <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                    Update
                                                </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>


                                    </div>


                        			




           
                       


                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

<?php include('includes/footer.php');?>

            </div>


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
        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>