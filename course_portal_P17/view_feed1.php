<?php
include("include/protect.php");
require_login('staff');
include("include/dbconnect.php");

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$did = isset($_REQUEST['did']) ? (int)$_REQUEST['did'] : 0;

if ($act === "del" && $did > 0) {
    db_query("DELETE FROM ee_feedback WHERE id=$did");
    header("Location: view_feed1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
</head>
<body>
<?php include("include/link_staff.php"); ?>
<div class="panel panel-default">
  <div class="panel-heading" align="center"></div>
  <div class="panel-body">
    <h3 align="center"></h3>
  </div>
</div>
<!--start content area-->
<h2 align="center">Welcome Staff</h2>
<h3 align="center">Feedback</h3>
<table width="70%" border="1" align="center">
  <tr>
    <th width="8%">Sno</th>
    <th width="20%">User</th>
    <th width="42%">Feedback</th>
    <th width="15%">Date</th>
    <th width="15%">Action</th>
  </tr>
  <?php
  $i = 0;
  $q2 = db_query("SELECT * FROM ee_feedback ORDER BY id DESC");
  while ($r2 = db_fetch_array($q2)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo h($r2['uname']); ?></td>
    <td><?php echo h($r2['feedback']); ?></td>
    <td><?php echo h($r2['rdate']); ?></td>
    <td><a href="view_feed1.php?act=del&amp;did=<?php echo (int)$r2['id']; ?>">Delete</a></td>
  </tr>
  <?php } ?>
</table>
<p>&nbsp;</p>
</body>
</html>
