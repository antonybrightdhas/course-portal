<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");

$uname = $_SESSION['uname'];
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
</head>
<body>
<?php include("include/link_admin.php"); ?>
<div class="panel panel-default">
  <div class="panel-heading" align="center"></div>
  <div class="panel-body">
    <h3 align="center"></h3>
  </div>
</div>
<!--start content area-->
<?php if ($act === "wrong") { ?>
<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="alert alert-warning">
      <strong>Warning!</strong> Username or Password Incorrect!
    </div>
  </div>
</div>
<?php } ?>
<h2 align="center">Welcome Admin</h2>
<p align="center">&nbsp;</p>
<table width="420" border="1" align="center">
  <tr>
    <td colspan="2" align="center" class="btn-primary">Dashboard</td>
  </tr>
  <tr>
    <td><a href="add_course.php">Courses</a></td>
    <td><a href="view_student.php">Student Details</a></td>
  </tr>
  <tr>
    <td><a href="view_feed.php">Feedback</a></td>
    <td><a href="view_tutorial.php">Tutorial</a></td>
  </tr>
  <tr>
    <td><a href="certificate.php">Certificate</a></td>
    <td><a href="contact.php">Contact</a></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
