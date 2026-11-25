<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$did = isset($_REQUEST['did']) ? (int)$_REQUEST['did'] : 0;
$course = 0;
if (isset($_REQUEST['course']) && $_REQUEST['course'] !== '') {
    $course = (int)$_REQUEST['course'];
} elseif (isset($_REQUEST['cid']) && $_REQUEST['cid'] !== '') {
    $course = (int)$_REQUEST['cid'];
}

if ($act === "del" && $did > 0) {
    db_query("DELETE FROM ee_tutorial WHERE id=$did");
    header("Location: view_tutorial.php" . ($course > 0 ? "?course=$course" : ""));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
<script type="text/javascript">
function validate() {
    var f = document.form1;
    if (f.course.value === "") {
        alert("Select a Course");
        f.course.focus();
        return false;
    }
    return true;
}
</script>
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
<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Tutorial</h2>
      </div>
      <div class="card-block">
        <form name="form1" method="post" onsubmit="return validate()">
          <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" required>
              <option value="">-Select Course-</option>
              <?php
              $cq = db_query("SELECT * FROM ee_course ORDER BY id ASC");
              while ($cr = db_fetch_array($cq)) {
              ?>
              <option value="<?php echo (int)$cr['id']; ?>" <?php if ($course === (int)$cr['id']) echo "selected"; ?>><?php echo h($cr['course']); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Submit" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<p align="center">&nbsp;</p>
<?php
if ($course > 0) {
    $q2 = db_query("SELECT * FROM ee_tutorial WHERE cid=$course");
    $q3 = db_query("SELECT * FROM ee_course WHERE id=$course");
    $r3 = db_fetch_array($q3);
    $course_name = $r3 ? $r3['course'] : '';
    if (db_num_rows($q2) > 0) {
?>
<table width="80%" border="1" align="center">
  <tr>
    <th width="5%">Sno</th>
    <th width="14%">Course</th>
    <th width="20%">Title</th>
    <th width="26%">Description</th>
    <th width="20%">File</th>
    <th width="15%">Action</th>
  </tr>
  <?php
  $i = 0;
  while ($r2 = db_fetch_array($q2)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo h($course_name); ?></td>
    <td><?php echo h($r2['title']); ?></td>
    <td>
      <?php
      $details = $r2['details'];
      if (preg_match('/^https?:\/\//i', $details)) {
          echo '<a href="' . h($details) . '" target="_blank" rel="noopener noreferrer">' . h($details) . '</a>';
      } else {
          echo h($details);
      }
      ?>
    </td>
    <td>
      <?php if ($r2['filename'] !== "") { ?>
      <a href="upload/<?php echo rawurlencode($r2['filename']); ?>" target="_blank"><?php echo h($r2['filename']); ?></a>
      <?php } else { echo '-'; } ?>
    </td>
    <td><a href="view_tutorial.php?act=del&amp;did=<?php echo (int)$r2['id']; ?>&amp;course=<?php echo $course; ?>">Delete</a></td>
  </tr>
  <?php } ?>
</table>
<?php
    } else {
        echo '<p align="center">No tutorials found for this course.</p>';
    }
}
?>
<p>&nbsp;</p>
</body>
</html>
