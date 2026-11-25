<?php
session_start();
include("include/dbconnect.php");
extract($_REQUEST);
$uname=$_SESSION['uname'];	

if($act=="del")
{
mysql_query("delete from ee_tutorial where id=$did");
?>
<script language="javascript">
window.location.href="view_tutorial.php";
</script>
<?php
}
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
 
<div class="row">
			<div class="col-lg-4">
				
				<!-- A grey horizontal navbar that becomes vertical on small screens -->
			</div>
			
			
			
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h2 class="h5 display display">
                    <h2>Tutorial</h2>
                  </h2>
                </div>
                <div class="card-block">
                  <p></p>
                  <form name="form1" method="post">
                    
					<div class="form-group">
                      <label>Course</label>
                      <select name="course" class="form-control">
					  <option value="">-Select Course-</option>
					  <?php
					  $cq=mysql_query("select * from ee_course");
					  while($cr=mysql_fetch_array($cq))
					  {
					  ?>
					  <option value="<?php echo $cr['id']; ?>" <?php if($course==$cr['id']) echo "selected"; ?>><?php echo $cr['course']; ?></option>
					  <?php
					  }
					  ?>
					  </select>
                    </div>
                   
					
				
					
                        
                    <div class="form-group">       
                      <input type="submit" name="btn" value="Submit" class="btn btn-primary" onclick="return validate()">
                    </div>
                  </form>
                </div>
              </div>

</div>

</div>
 
 

<p align="center">&nbsp;</p>
<!-- row end -->
  <?php
  if($course!="")
  {
  $q2=mysql_query("select * from ee_tutorial where cid=$course");
  ?>
<table width="80%" border="1" align="center">
  <tr>
    <th width="4%">Sno</th>
    <th width="14%">Course</th>
    <th width="21%">Title</th>
    <th width="26%">Description</th>
    <th width="18%">File</th>
    <th width="17%">Action</th>
  </tr>
  <?php
  $i=0;
  
  while($r2=mysql_fetch_array($q2))
  {
  $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php 
	$q3=mysql_query("select * from ee_course where id='$course'");
	$r3=mysql_fetch_array($q3);
	echo $r3['course'];
	?></td>
    <td><?php echo $r2['title']; ?></td>
    <td><?php echo $r2['details']; ?></td>
    <td>
	<?php
	if($r2['filename']!="")
	{
	?>
	<a href="upload/<?php echo $r2['filename']; ?>" target="_blank"><?php echo $r2['filename']; ?></a>
	<?php
	}
	else
	{
	echo '-';
	}
	?>
	</td>
    <td><a href="view_tutorial.php?act=del&did=<?php echo $r2['id']; ?>">Delete</a></td>
  </tr>
  <?php
  }
  ?>
</table>
<?php
}
?>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>