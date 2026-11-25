<?php
session_start();
include("include/dbconnect.php");
extract($_REQUEST);
$uname=$_SESSION['uname'];	
$q1=mysql_query("select * from ee_register where uname='$uname'");
$r1=mysql_fetch_array($q1);
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

 
   <table width="314" border="1" align="center">
                  <tr>
                    <td width="135">Name</td>
                    <td width="163"><?php echo $r1['name']; ?></td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td><?php echo $r1['gender']; ?></td>
                  </tr>
                  <tr>
                    <td>D.O.B</td>
                    <td><?php echo $r1['dob']; ?></td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td><?php echo $r1['address']; ?></td>
                  </tr>
                  <tr>
                    <td>Mobile No. </td>
                    <td><?php echo $r1['mobile']; ?></td>
                  </tr>
                  <tr>
                    <td>E-mail</td>
                    <td><?php echo $r1['email']; ?></td>
                  </tr>
                  <tr>
                    <td>Course</td>
                    <td><?php 
					$q2=mysql_query("select * from ee_course where id='".$r1['course']."'");
					$r2=mysql_fetch_array($q2);
					echo $r2['course']; ?></td>
                  </tr>
                  <tr>
                    <td>Fees</td>
                    <td><?php echo $r2['fees']; ?></td>
                  </tr>
                  <tr>
                    <td>Paid</td>
                    <td>
					<?php
					if($r2['paid_st']=="1")
					{
					echo "Fees Paid";
					}
					else
					{
					echo '<a href="pay.php?uname='.$uname.'">Pay Fees</a>';
					}
					?>
					</td>
                  </tr>
                </table>

  <p>
    <!-- row end -->
</p>
  <p>&nbsp;</p>
  <p>&nbsp;    </p>
  <p align="center">&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>