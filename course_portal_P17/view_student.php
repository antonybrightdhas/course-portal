<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");
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
<h2 align="center">Welcome Admin</h2>
<h4 align="center">Students</h4>
<table width="90%" border="1" align="center">
  <tr>
    <th width="4%">Sno</th>
    <th width="10%">Name</th>
    <th width="8%">Gender</th>
    <th width="10%">Date of Birth</th>
    <th width="11%">Address</th>
    <th width="15%">Mobile No.</th>
    <th width="17%">E-mail</th>
    <th width="25%">Course</th>
  </tr>
  <?php
  $i = 0;
  $q2 = db_query("SELECT * FROM ee_register ORDER BY id ASC");
  while ($r2 = db_fetch_array($q2)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo h($r2['name']); ?></td>
    <td><?php echo h($r2['gender']); ?></td>
    <td><?php echo h($r2['dob']); ?></td>
    <td><?php echo h($r2['address']); ?></td>
    <td><?php echo h($r2['contact']); ?></td>
    <td><?php echo h($r2['email']); ?></td>
    <td>
      <?php
      if ((int)$r2['course'] > 0) {
          $q3 = db_query("SELECT * FROM ee_course WHERE id=" . (int)$r2['course']);
          $r3 = db_fetch_array($q3);
          if ($r3) {
              echo "Course: " . h($r3['course']) . "<br />";
          }
      }
      if ((int)$r2['fees'] > 0) {
          echo "Fees: Rs." . h($r2['fees']) . "<br />";
          echo ((int)$r2['paid_st'] > 0) ? "Paid: Yes<br />" : "Paid: No<br />";
      }
      echo '<a href="select.php?un=' . rawurlencode($r2['uname']) . '">Select Course</a>';
      ?>
    </td>
  </tr>
  <?php } ?>
</table>
<p>&nbsp;</p>
</body>
</html>
