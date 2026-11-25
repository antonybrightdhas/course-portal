<?php
include("include/protect.php");
require_login('admin');
include("include/dbconnect.php");

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

if (isset($_POST['btn'])) {
    $mobile1 = isset($_POST['mobile1']) ? trim($_POST['mobile1']) : '';
    if ($mobile1 === '' || !ctype_digit($mobile1)) {
        header("Location: contact.php?act=wrong");
        exit;
    }

    $q2 = db_query("UPDATE ee_admin SET mobile='" . db_escape($mobile1) . "' WHERE username='admin'");
    if ($q2) {
        header("Location: contact.php?act=success");
    } else {
        header("Location: contact.php?act=wrong");
    }
    exit;
}

$q1 = db_query("SELECT * FROM ee_admin WHERE username='admin'");
$r1 = db_fetch_array($q1);
$current_mobile = $r1 ? $r1['mobile'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
<script type="text/javascript">
function validate() {
    var f = document.form1;
    var val = f.mobile1.value.trim();
    if (val === "" || isNaN(val) || val.length < 10) {
        alert("Enter a valid Contact Number (at least 10 digits)");
        f.mobile1.focus();
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
      <strong>Updated Success!</strong>
    </div>
    <?php } elseif ($act === "wrong") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Enter a valid numeric contact number!
    </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Contact No.</h2>
      </div>
      <div class="card-block">
        <form name="form1" method="post" onsubmit="return validate()">
          <div class="form-group">
            <label>Contact No.</label>
            <input type="text" name="mobile1" value="<?php echo h($current_mobile); ?>" maxlength="15" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Update" class="btn btn-primary" />
          </div>
          <div>Current Mobile No: <?php echo h($current_mobile); ?></div>
        </form>
      </div>
    </div>
  </div>
</div>
<p>&nbsp;</p>
</body>
</html>
