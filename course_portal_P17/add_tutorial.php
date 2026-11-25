<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");

$cid = isset($_REQUEST['cid']) ? (int)$_REQUEST['cid'] : 0;
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

if (isset($_POST['btn'])) {
    $cid = isset($_POST['cid']) ? (int)$_POST['cid'] : 0;
    $ttype = isset($_POST['ttype']) ? trim($_POST['ttype']) : '';
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $details = isset($_POST['details']) ? trim($_POST['details']) : '';

    if ($cid <= 0 || $title === '') {
        header("Location: add_tutorial.php?cid=$cid&act=wrong");
        exit;
    }

    $rdate = date("d-m-Y");
    $max_qry = db_query("SELECT MAX(id) AS maxid FROM ee_tutorial");
    $max_row = db_fetch_array($max_qry);
    $id = ($max_row && $max_row['maxid']) ? ((int)$max_row['maxid'] + 1) : 1;

    $fn = "";
    if (isset($_FILES['file']) && isset($_FILES['file']['error']) && $_FILES['file']['error'] === UPLOAD_ERR_OK && $_FILES['file']['name'] !== "") {
        $safe_name = basename($_FILES['file']['name']);
        $fn = "F" . $id . $safe_name;
        move_uploaded_file($_FILES['file']['tmp_name'], "upload/" . $fn);
    }

    $q1 = sprintf(
        "INSERT INTO ee_tutorial (id, cid, subid, ttype, title, filename, details, rdate) VALUES (%d, %d, 0, '%s', '%s', '%s', '%s', '%s')",
        $id,
        $cid,
        db_escape($ttype),
        db_escape($title),
        db_escape($fn),
        db_escape($details),
        db_escape($rdate)
    );
    $q2 = db_query($q1);
    if ($q2) {
        header("Location: add_tutorial.php?cid=$cid&act=success");
    } else {
        header("Location: add_tutorial.php?cid=$cid&act=wrong");
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
    if (f.cid.value === "") {
        alert("Select a Course");
        f.cid.focus();
        return false;
    }
    if (f.title.value.trim() === "") {
        alert("Enter the Title");
        f.title.focus();
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
      <strong>Warning!</strong> Please select a course and enter a valid title.
    </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Add Tutorial</h2>
      </div>
      <div class="card-block">
        <form name="form1" method="post" enctype="multipart/form-data" onsubmit="return validate()">
          <div class="form-group">
            <label>Course</label>
            <select name="cid" class="form-control" required>
              <option value="">-Select Course-</option>
              <?php
              $cq = db_query("SELECT * FROM ee_course ORDER BY id ASC");
              while ($cr = db_fetch_array($cq)) {
              ?>
              <option value="<?php echo (int)$cr['id']; ?>" <?php if ($cid === (int)$cr['id']) echo "selected"; ?>><?php echo h($cr['course']); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Type</label>
            <select name="ttype" class="form-control">
              <option value="Link">Link</option>
              <option value="Book">Book</option>
              <option value="Image">Image</option>
              <option value="Audio">Audio</option>
              <option value="Video">Video</option>
            </select>
          </div>
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" placeholder="Title" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Description / Web Link</label>
            <input type="text" name="details" placeholder="Description / Web Link" class="form-control" />
          </div>
          <div class="form-group">
            <label>File</label>
            <input type="file" name="file" class="form-control" />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Add" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<p>&nbsp;</p>
</body>
</html>
