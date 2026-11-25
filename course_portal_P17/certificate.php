<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

if (isset($_POST['btn'])) {
    $student_uname = isset($_POST['uname']) ? trim($_POST['uname']) : '';
    $course = isset($_POST['course']) ? trim($_POST['course']) : '';
    $duration = isset($_POST['duration']) ? trim($_POST['duration']) : '';

    if ($student_uname === '' || $course === '' || $duration === '') {
        header("Location: certificate.php?act=wrong");
        exit;
    }

    $mq = db_query("SELECT MAX(id) AS maxid FROM ee_certificate");
    $mr = db_fetch_array($mq);
    $id = ($mr && $mr['maxid']) ? ((int)$mr['maxid'] + 1) : 1;

    $fn = "";
    if (isset($_FILES['file']) && isset($_FILES['file']['error']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && $_FILES['file']['name'] !== "") {
        $safe_name = basename($_FILES['file']['name']);
        $fn = "M" . $id . $safe_name;
        move_uploaded_file($_FILES['file']['tmp_name'], "upload/" . $fn);
    }

    $ins = db_query(sprintf(
        "INSERT INTO ee_certificate (id, uname, course, duration, filename) VALUES (%d, '%s', '%s', '%s', '%s')",
        $id,
        db_escape($student_uname),
        db_escape($course),
        db_escape($duration),
        db_escape($fn)
    ));
    if ($ins) {
        header("Location: certificate.php?act=success");
    } else {
        header("Location: certificate.php?act=wrong");
    }
    exit;
}
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
<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <?php if ($act === "success") { ?>
    <div class="alert alert-success">
      <strong>Certificate Issued!</strong>
    </div>
    <?php } elseif ($act === "wrong") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Please fill all required fields.
    </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Certificate</h2>
      </div>
      <div class="card-block">
        <form name="name" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="uname" placeholder="Student Username" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Course</label>
            <input type="text" name="course" placeholder="Course" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" placeholder="Duration" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Certificate</label>
            <input name="file" type="file" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Send" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4"></div>
</div>

<p></p>
<h4 align="center">Issued Certificates</h4>
<table width="80%" border="1" align="center">
  <tr>
    <th>Sno</th>
    <th>Username</th>
    <th>Course</th>
    <th>Duration</th>
    <th>Certificate</th>
  </tr>
  <?php
  $i = 0;
  $cq = db_query("SELECT * FROM ee_certificate ORDER BY id DESC");
  while ($cr = db_fetch_array($cq)) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo h($cr['uname']); ?></td>
    <td><?php echo h($cr['course']); ?></td>
    <td><?php echo h($cr['duration']); ?></td>
    <td>
      <?php if ($cr['filename'] !== "") { ?>
      <a href="upload/<?php echo rawurlencode($cr['filename']); ?>" target="_blank"><?php echo h($cr['filename']); ?></a>
      <?php } else { echo '-'; } ?>
    </td>
  </tr>
  <?php } ?>
</table>
<p>&nbsp;</p>
</body>
</html>
