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
   <?php include("include/link_admin.php"); ?>
 <div class="panel panel-default">
  <div class="panel-heading" align="center"><!--<img src="img/header.jpg" width="1060" height="276" />--></div>
  <div class="panel-body">
   <h3 align="center"></h3>
  </div>
</div>
 <!--start content area-->
		
<h2 align="center">Welcome Admin</h2>

<h4 align="center">Students</h4>
<table width="90%" border="1" align="center">
  <tr>
    <th width="4%">Sno</th>
    <th width="10%">Name</th>
    <th width="8%">Gender</th>
    <th width="10%">Date of Birth </th>
    <th width="11%">Address</th>
    <th width="17%">Mobile No. </th>
    <th width="17%">E-mail</th>
    <th width="23%">Course</th>
  </tr>
  <?php
  $i=0;
  $q2=mysql_query("select * from ee_register");
  while($r2=mysql_fetch_array($q2))
  {
  $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $r2['name']; ?></td>
    <td><?php echo $r2['gender']; ?></td>
    <td><?php echo $r2['dob']; ?></td>
    <td><?php echo $r2['address']; ?></td>
    <td><?php echo $r2['contact']; ?></td>
    <td><?php echo $r2['email']; ?></td>
    <td>
	<?php
	
	if($r2['course']>0) 
	{ 
	$q3=mysql_query("select * from ee_course where id='".$r2['course']."'");
	$r3=mysql_fetch_array($q3);
	echo "Course: ".$r3['course']."<br>"; 
	}
	if($r2['fees']>0) 
	{ 
	echo "Fees: Rs.".$r2['fees']."<br>"; 
		if($r2['paid_st']>0) 
		{ 
		echo "Paid: Yes<br>"; 
		}	
		else
		{
		echo "Paid: No<br>"; 
		}
	}		
	
		
		
	echo '<a href="select.php?un='.$r2['uname'].'">Select Course</a>';
	
	?>
	</td>
  </tr>
  <?php
  }
  ?>
</table>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>