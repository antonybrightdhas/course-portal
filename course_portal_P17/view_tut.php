<?php
include("include/protect.php");
require_login('student');
include("include/dbconnect.php");

$uname = $_SESSION['uname'];
$q1 = db_query("SELECT * FROM ee_register WHERE uname='" . db_escape($uname) . "'");
$r1 = db_fetch_array($q1);
$course = $r1 ? (int)$r1['course'] : 0;

$course_name = 'Not Assigned';
if ($course > 0) {
    $q2 = db_query("SELECT * FROM ee_course WHERE id=$course");
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
<h2 align="center">Tutorial : <?php echo h($course_name); ?></h2>
<?php
if ($course > 0) {
    $q_tut = db_query("SELECT * FROM ee_tutorial WHERE cid=$course");
    if (db_num_rows($q_tut) > 0) {
?>
<table width="80%" border="1" align="center">
  <tr>
    <th width="6%">Sno</th>
    <th width="14%">Type</th>
    <th width="22%">Title</th>
    <th width="34%">Description</th>
    <th width="24%">File</th>
  </tr>
  <?php
  $i = 0;
  while ($row = db_fetch_array($q_tut)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo h($row['ttype']); ?></td>
    <td><?php echo h($row['title']); ?></td>
    <td>
      <?php
      $details = $row['details'];
      if (preg_match('/^https?:\/\//i', $details)) {
          echo '<a href="' . h($details) . '" target="_blank" rel="noopener noreferrer">' . h($details) . '</a>';
      } else {
          echo h($details);
      }
      ?>
    </td>
    <td>
      <?php if ($row['filename'] !== "") { ?>
      <a href="upload/<?php echo rawurlencode($row['filename']); ?>" target="_blank"><?php echo h($row['filename']); ?></a>
      <?php } else { echo '-'; } ?>
    </td>
  </tr>
  <?php } ?>
</table>
<?php
    } else {
        echo '<p align="center">No tutorials available for this course yet.</p>';
    }
} else {
    echo '<p align="center">No course assigned yet. Please contact Admin/Staff.</p>';
}
?>
<p>&nbsp;</p>
</body>
</html>
