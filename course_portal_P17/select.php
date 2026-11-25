<?php
include("include/protect.php");
require_login(array('admin', 'staff'));
include("include/dbconnect.php");

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'admin';
$redirect_page = ($role === 'staff') ? 'view_student1.php' : 'view_student.php';
$un = isset($_REQUEST['un']) ? trim($_REQUEST['un']) : '';

if ($un === '') {
    header("Location: $redirect_page");
    exit;
}

$un_esc = db_escape($un);
$stu_q = db_query("SELECT * FROM ee_register WHERE uname='$un_esc'");
$stu = db_fetch_array($stu_q);
if (!$stu) {
    header("Location: $redirect_page");
    exit;
}

$course = (int)$stu['course'];
$fees = (int)$stu['fees'];
$msg = "";

if (isset($_POST['btn'])) {
    $course = isset($_POST['course']) ? (int)$_POST['course'] : 0;
    $fees = isset($_POST['fees']) && $_POST['fees'] !== '' ? (int)$_POST['fees'] : -1;

    if ($course <= 0 || $fees < 0) {
        $msg = "Please select a valid course and enter fees.";
    } else {
        db_query("UPDATE ee_register SET course=$course, fees=$fees WHERE uname='$un_esc'");
        ?>
        <script type="text/javascript">
        alert("Course Selected..");
        window.location.href = "<?php echo $redirect_page; ?>";
        </script>
        <?php
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
</head>
<body>
<?php
if ($role === 'staff') {
    include("include/link_staff.php");
} else {
    include("include/link_admin.php");
}
?>
<div class="panel panel-default">
  <div class="panel-heading" align="center"></div>
  <div class="panel-body">
    <h3 align="center"></h3>
  </div>
</div>
<!--start content area-->
<h2 align="center">Welcome <?php echo ($role === 'staff') ? 'Staff' : 'Admin'; ?></h2>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Select Course for <?php echo h($stu['name']); ?> (<?php echo h($un); ?>)</h2>
      </div>
      <div class="card-block">
        <form name="name" method="post">
          <input type="hidden" name="un" value="<?php echo h($un); ?>" />
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
            <label>Fees</label>
            <input type="number" min="0" name="fees" value="<?php echo $fees > 0 ? $fees : ''; ?>" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Submit" class="btn btn-primary" />
          </div>
          <?php if ($msg !== "") { ?>
          <div class="msg"><?php echo h($msg); ?></div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4"></div>
</div>
<p>&nbsp;</p>
</body>
</html>
