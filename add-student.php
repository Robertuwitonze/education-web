<?php
$msg="";
$error="";
include('includes/config.php');

  if (isset($_POST['submit'])) {
    $names=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $course=$_POST['course']; 
 
    $checkuid="SELECT * FROM tblstudents ORDER BY id DESC LIMIT 1";
    $checkresult=mysqli_query($con, $checkuid);
    if (mysqli_num_rows($checkresult)>0) 
    {
       if ($row=mysqli_fetch_assoc($checkresult)) {
          $uid=$row['Enroll_id'];
          $get_numbers=str_replace("NST", "", $uid);
          $id_increase=$get_numbers+1;
          $get_string=str_pad($id_increase, 5,0, STR_PAD_LEFT);
          $id="NST".$get_string;

          $insert_qry="INSERT INTO tblstudents (Enroll_id,names,email,phone,course,Is_Active) VALUES ('$id','$names','$email','$phone','$course','$status')";
          $result=mysqli_query($con, $insert_qry);
          if ($result) {
             $msg="Registered successfully! this is your ID number".'  '.$id;
          }else{
            $error= "oops! something went wrong";
          }
        } 
    }else{
      $id="NST00001";
      $insert_qry="INSERT INTO tblstudents (Enroll_id,names,email,phone,course) VALUES ('$id','$names','$email','$phone','$course')";
      $result=mysqli_query($con, $insert_qry);
      if ($result) {
             $msg = "Registered .$id successfully!";
          }else{
            $error =  "oops! something went wrong";
          }
    }
  }

// $sql="select * from tblstudents order by names asc";
// $res=mysqli_query($con,$sql);

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
                                    <h4 class="page-title">Add Student </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Student</a>
                                        </li>
                                        <li>
                                            <a href="#">Add Student </a>
                                        </li>
                                        <li class="active">
                                            Add Student
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
<label for="exampleInputEmail1">Student Names</label>
<input type="text" class="form-control" id="posttitle" name="name" placeholder="Enter student Names" required>
</div>

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Student Email</label>
<input type="text" class="form-control" id="posttitle" name="email" placeholder="Enter student email" required>
</div>

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Student Phone</label>
<input type="text" class="form-control" id="posttitle" name="phone" placeholder="Enter student phone" required>
</div>

<div class="form-group m-b-20">
<label for="exampleInputEmail1">Course</label>
<select class="form-control" name="course" id="#" >
<option value="#">Select Course</option>
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

<button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save</button>
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
