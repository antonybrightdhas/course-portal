<?php
include("include/protect.php");
require_login('student');
include("include/dbconnect.php");

$uname = $_SESSION['uname'];
$q2 = db_query("SELECT * FROM ee_certificate WHERE uname='" . db_escape($uname) . "'");
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
<h2 align="center">Download Certificate</h2>
<?php if (db_num_rows($q2) > 0) { ?>
<table width="80%" border="1" align="center">
  <tr>
    <th width="20%">Course</th>
    <th width="20%">Duration</th>
    <th width="25%">Username</th>
    <th width="35%">Certificate</th>
  </tr>
  <?php while ($r2 = db_fetch_array($q2)) { ?>
  <tr>
    <td><?php echo h($r2['course']); ?></td>
    <td><?php echo h($r2['duration']); ?></td>
    <td><?php echo h($r2['uname']); ?></td>
    <td>
      <?php if ($r2['filename'] !== "") { ?>
      <a href="upload/<?php echo rawurlencode($r2['filename']); ?>" target="_blank"><?php echo h($r2['filename']); ?></a>
      <?php } else { echo '-'; } ?>
    </td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
<p align="center">No certificates issued yet.</p>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>
