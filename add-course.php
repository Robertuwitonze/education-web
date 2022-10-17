<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

// For adding post  
if(isset($_POST['submit']))
{
$name=$_POST['Name'];
$category=$_POST['Category'];
$level=$_POST['Level'];
$teacher=$_POST['Teacher'];
$details=$_POST['Description'];
$duration=$_POST['Duration'];
// $arr = explode(" ",$posttitle);
// $url=implode("-",$arr);
$c_image=$_FILES['Image']['name'];
$tn = $_FILES['Image']['tmp_name'];
$upload_dir = "courseimages/";
// get the image extension
$extension = substr($c_image,strlen($c_image)-4,strlen($c_image));
// allowed extensions
$allowed_extensions = array(".jpg",".JPG",".jpeg",".png",".gif",".mp4");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif /.mp4 format allowed');</script>";
}
else
{
//rename the image file
$imgnewfile=md5($c_image).$extension;
$location = 'courseiamges'.'/'.$imgnewfile;
// Code for move image into directory
if(move_uploaded_file($_FILES['Image']['tmp_name'],'courseimages/'.$imgnewfile))
{

$status=1;
$query=mysqli_query($con,"insert into tblcourse(Name,Category,Level,Teacher,Description,Duration,Image) values('$name','$category','$level','$teacher','$details','$duration','$imgnewfile')");
if($query)
{
$msg="Course successfully added ";
}
else{
$error="Something went wrong . Please try again.";    
} 

}

//$msg="you submitted".$imgfile;

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

        <!-- Summernote css -->
        <link href="plugins/summernote/summernote.css" rel="stylesheet" />

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
 <script>
function getSubCat(val) {
  $.ajax({
  type: "POST",
  url: "get_subcategory.php",
  data:'catid='+val,
  success: function(data){
    $("#subcategory").html(data);
  }
  });
  }
  </script>
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
           <?php include('includes/topheader.php');?>
            <!-- ========== Left Sidebar Start ========== -->
             <?php include('includes/leftsidebar.php');?>
            <!-- Left Sidebar End -->



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
                                    <h4 class="page-title">Add Course </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Course</a>
                                        </li>
                                        <li>
                                            <a href="#">Add Course </a>
                                        </li>
                                        <li class="active">
                                            Add Course
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

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
<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
<form name="addpost" method="post" enctype="multipart/form-data">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Course Name</label>
<input type="text" class="form-control" id="posttitle" name="Name" placeholder="Enter Course Name" required>
</div>



<div class="form-group m-b-20">
<label for="exampleInputEmail1">Course Category</label>
<select class="form-control" name="Category" id="category" onChange="getSubCat(this.value);" required>
<option value="">Select Category </option>
<?php
// Feching active categories
$ret=mysqli_query($con,"select id,CategoryName from  tblcategory where Is_Active=1");
while($result=mysqli_fetch_array($ret))
{    
?>
<option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
<?php } ?>

</select> 
</div>
    
<div class="form-group m-b-20">
<label for="exampleInputEmail1">Course level</label>
<select class="form-control" name="Level" id="#" >
<option value="#">Select Level</option>
<?php
// Feching active levels
$ret=mysqli_query($con,"select id,levelname from  tbllevel where Is_Active=1");
while($result=mysqli_fetch_array($ret))
{    
?>
<option value="<?php echo htmlentities($result['levelname']);?>"><?php echo htmlentities($result['levelname']);?></option>
<?php } ?>
</select> 
</div>
         

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Teacher</label>
<select class="form-control" name="Teacher" id="#" >
<option value="#">Select Teacher</option>
<?php
// Feching active levels
$ret=mysqli_query($con,"select id,name from  tblteacher where Is_Active=1");
while($result=mysqli_fetch_array($ret))
{    
?>
<option value="<?php echo htmlentities($result['name']);?>"><?php echo htmlentities($result['name']);?></option>
<?php } ?>
</select> 
</div>

<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Course Details</b></h4>
<textarea class="summernote" cols="1000" rows="1000" name="Description" required></textarea>
</div>
</div>
</div>

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Course Duration</label>
<input type="text" class="form-control" id="posttitle" name="Duration" placeholder="Enter Course Duration" required>
</div>


<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Course Image(W:450 x H:350)</b></h4>
<input type="file" class="form-control" id="postimage" name="Image"  required>
</div>
</div>
</div>


<button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save Course</button>
 <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                        </form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



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

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>

            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 240,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
  <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>

    


    </body>
</html>
<?php } ?>