<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

if (isset($_POST['btn'])) {
    $course = isset($_POST['course']) ? trim($_POST['course']) : '';
    if ($course === '') {
        header("Location: add_course.php?act=wrong");
        exit;
    }

    $c_esc = db_escape($course);
    $chk = db_query("SELECT id FROM ee_course WHERE LOWER(course)=LOWER('$c_esc')");
    if (db_num_rows($chk) > 0) {
        header("Location: add_course.php?act=wrong");
        exit;
    }

    $max_qry = db_query("SELECT MAX(id) AS maxid FROM ee_course");
    $max_row = db_fetch_array($max_qry);
    $id = ($max_row && $max_row['maxid']) ? ((int)$max_row['maxid'] + 1) : 1;

    $q2 = db_query("INSERT INTO ee_course (id, course) VALUES ($id, '$c_esc')");
    if ($q2) {
        header("Location: add_course.php?act=success");
    } else {
        header("Location: add_course.php?act=wrong");
    }
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
    if (f.course.value.trim() === "") {
        alert("Enter the Course Name");
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
<h2 align="center">Welcome Admin</h2>
<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <?php if ($act === "success") { ?>
    <div class="alert alert-success">
      <strong>Added Success!</strong>
    </div>
    <?php } elseif ($act === "wrong") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Course already exists or could not be added!
    </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Course</h2>
      </div>
      <div class="card-block">
        <form name="form1" method="post" onsubmit="return validate()">
          <div class="form-group">
            <label>Course Name</label>
            <input type="text" name="course" placeholder="Course" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Add" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<p></p>
<table width="70%" border="1" align="center">
  <tr>
    <th width="8%">Sno</th>
    <th width="69%">Course</th>
    <th width="23%">Tutorials</th>
  </tr>
  <?php
  $i = 0;
  $q2 = db_query("SELECT * FROM ee_course ORDER BY id ASC");
  while ($r2 = db_fetch_array($q2)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo h($r2['course']); ?></td>
    <td>
      <a href="add_tutorial.php?cid=<?php echo (int)$r2['id']; ?>">Add</a> |
      <a href="view_tutorial.php?cid=<?php echo (int)$r2['id']; ?>">View</a>
    </td>
  </tr>
  <?php } ?>
</table>
<p>&nbsp;</p>
</body>
</html>
