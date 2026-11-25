<?php
session_start();
include("include/dbconnect.php");
extract($_REQUEST);
$uname=$_SESSION['uname'];	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php include("include/title.php"); ?></title>
<link rel="shortcut icon" href="img/icon.ico">

<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="shortcut icon" href="favicon.ico">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Style -->
	<link rel="stylesheet" href="css/style.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->

</head>

<body>
   <?php include("include/link_user.php"); ?>
 <div class="panel panel-default">
  <div class="panel-heading" align="center"><!--<img src="img/header.jpg" width="1060" height="276" />--></div>
  <div class="panel-body">
   <h3 align="center"></h3>
  </div>
</div>
 <!--start content area-->
		
<h2 align="center">Welcome <?php echo $uname; ?></h2>
<div class="row">
			<div class="col-lg-4">
				
				<!-- A grey horizontal navbar that becomes vertical on small screens -->
			</div>
			
			 <?php
				if($_REQUEST['act']=="success")
				{
				?>
				<div class="alert alert-success">
				  <strong>Added Success!</strong>
				</div>
				<?php
				}
				if($_REQUEST['act']=="wrong")
				{
				?>
				
				<div class="alert alert-warning">
				  <strong>Warning!</strong> This Student already exist!
				</div>
				<?php
				}
				?>
			
           
</div>			

 
 
<div class="row">
			<div class="col-lg-4">
				
				<!-- A grey horizontal navbar that becomes vertical on small screens -->
			</div>
			
			
			
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display display">
                    <h2>Feedback</h2>
                  </h2>
                </div>
                <div class="card-block">
                  <p></p>
                  <form name="form1" method="post">
                    
					<div class="form-group">
                      <label>Your Feedback</label>
                      <textarea name="feedback" class="form-control"></textarea>
                    </div>
                   
					
				
					
                        
                    <div class="form-group">       
                      <input type="submit" name="btn" value="Send Feedback" class="btn btn-primary" onclick="return validate()">
                    </div>
                  </form>
                </div>
              </div>

</div>

</div>

  <!-- row end -->
  
  
  <?php
 $msg="";
$rdate=date("d-m-Y");
	 if(isset($btn))
	 {
                                                      
$max_qry = mysql_query("select max(id) maxid from ee_feedback");
$max_row = mysql_fetch_array($max_qry);
	$id=$max_row['maxid']+1;
	
	
	
		$q1="insert into ee_feedback(id,uname,feedback,rdate) values($id,'$uname','$feedback','$rdate')";
		$q2=mysql_query($q1);
 		if($q2)
		{
			
	 ?>
  <script language="javascript">
	 window.location.href="add_feed.php?act=success";
	 </script>
  <?php
	 	}
		else
		{
		 ?>
  <script language="javascript">
	 window.location.href="add_feed.php?act=wrong";
	 </script>
  <?php
		}
	
	
	 
	 
}
?>
<p></p>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>