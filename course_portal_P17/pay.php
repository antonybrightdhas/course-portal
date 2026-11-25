<?php
include("include/protect.php");
require_login('student');
include("include/dbconnect.php");

$uname = $_SESSION['uname'];
$u_esc = db_escape($uname);
$q1 = db_query("SELECT * FROM ee_register WHERE uname='$u_esc'");
$r1 = db_fetch_array($q1);
if (!$r1) {
    header("Location: logout.php");
    exit;
}

$msg = "";
if (isset($_POST['btn'])) {
    $account = isset($_POST['account']) ? trim($_POST['account']) : '';
    if ($account === '') {
        $msg = "Please enter an account number.";
    } else {
        db_query("UPDATE ee_register SET paid_st=1 WHERE uname='$u_esc'");
        ?>
        <script type="text/javascript">
        alert("Fees Paid..");
        window.location.href = "userhome.php";
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
<script type="text/javascript">
function validate() {
    var f = document.name;
    if (f.account.value.trim() === "") {
        alert("Enter the Account Number");
        f.account.focus();
        return false;
    }
    return true;
}
</script>
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
<h2 align="center">Welcome <?php echo h($uname); ?></h2>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Fees Payment</h2>
      </div>
      <div class="card-block">
        <?php if ((int)$r1['paid_st'] === 1) { ?>
        <div class="alert alert-success">Fees already paid. <a href="userhome.php">Back to Home</a></div>
        <?php } elseif ((int)$r1['fees'] <= 0) { ?>
        <div class="alert alert-warning">No course fees assigned yet. <a href="userhome.php">Back to Home</a></div>
        <?php } else { ?>
        <p><strong>Fees Amount:</strong> Rs.<?php echo h($r1['fees']); ?></p>
        <form name="name" method="post" onsubmit="return validate()">
          <div class="form-group">
            <label>Bank</label>
            <select name="bank" class="form-control">
              <option>SBI</option>
              <option>Indian Bank</option>
              <option>Canara</option>
              <option>IOB</option>
              <option>KVB</option>
              <option>LVB</option>
            </select>
          </div>
          <div class="form-group">
            <label>Account No.</label>
            <input type="text" name="account" placeholder="Account Number" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Payment" class="btn btn-primary" />
          </div>
          <?php if ($msg !== "") { ?>
          <div class="msg"><?php echo h($msg); ?></div>
          <?php } ?>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="col-lg-4"></div>
</div>
<p>&nbsp;</p>
</body>
</html>
