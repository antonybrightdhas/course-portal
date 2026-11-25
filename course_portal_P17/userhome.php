<?php
include("include/protect.php");
require_login('student');
include("include/dbconnect.php");

$uname = $_SESSION['uname'];
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

$q1 = db_query("SELECT * FROM ee_register WHERE uname='" . db_escape($uname) . "'");
$r1 = db_fetch_array($q1);
if (!$r1) {
    header("Location: logout.php");
    exit;
}

$course_name = 'Not Assigned';
if ((int)$r1['course'] > 0) {
    $q2 = db_query("SELECT * FROM ee_course WHERE id=" . (int)$r1['course']);
    $r2 = db_fetch_array($q2);
    if ($r2 && isset($r2['course'])) {
        $course_name = $r2['course'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
</head>
<body>
<?php include("include/link_user.php"); ?>
<div class="panel panel-default">
  <div class="panel-heading" align="center"></div>
  <div class="panel-body">
    <h3 align="center"></h3>
  </div>
</div>
<!--start content area-->
<h2 align="center">Welcome <?php echo h($uname); ?></h2>
<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <?php if ($act === "success") { ?>
    <div class="alert alert-success">
      <strong>Success!</strong> Operation completed.
    </div>
    <?php } ?>
  </div>
</div>

<table width="360" border="1" align="center">
  <tr>
    <td width="140">Name</td>
    <td width="204"><?php echo h($r1['name']); ?></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td><?php echo h($r1['gender']); ?></td>
  </tr>
  <tr>
    <td>D.O.B</td>
    <td><?php echo h($r1['dob']); ?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo h($r1['address']); ?></td>
  </tr>
  <tr>
    <td>Mobile No.</td>
    <td><?php echo h($r1['contact']); ?></td>
  </tr>
  <tr>
    <td>E-mail</td>
    <td><?php echo h($r1['email']); ?></td>
  </tr>
  <tr>
    <td>Course</td>
    <td><?php echo h($course_name); ?></td>
  </tr>
  <tr>
    <td>Fees</td>
    <td><?php echo ((int)$r1['fees'] > 0) ? 'Rs.' . h($r1['fees']) : '-'; ?></td>
  </tr>
  <tr>
    <td>Paid</td>
    <td>
      <?php
      if ((int)$r1['paid_st'] === 1) {
          echo "Fees Paid";
      } elseif ((int)$r1['fees'] > 0) {
          echo '<a href="pay.php">Pay Fees</a>';
      } else {
          echo "Not Assigned";
      }
      ?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
