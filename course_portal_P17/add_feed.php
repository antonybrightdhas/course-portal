<?php
include("include/protect.php");
require_login('student');
include("include/dbconnect.php");

$uname = $_SESSION['uname'];
$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

if (isset($_POST['btn'])) {
    $feedback = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';
    if ($feedback === '') {
        header("Location: add_feed.php?act=wrong");
        exit;
    }

    $rdate = date("d-m-Y");
    $max_qry = db_query("SELECT MAX(id) AS maxid FROM ee_feedback");
    $max_row = db_fetch_array($max_qry);
    $id = ($max_row && $max_row['maxid']) ? ((int)$max_row['maxid'] + 1) : 1;

    $q1 = sprintf(
        "INSERT INTO ee_feedback (id, uname, feedback, rdate) VALUES (%d, '%s', '%s', '%s')",
        $id,
        db_escape($uname),
        db_escape($feedback),
        db_escape($rdate)
    );
    $q2 = db_query($q1);
    if ($q2) {
        header("Location: add_feed.php?act=success");
    } else {
        header("Location: add_feed.php?act=wrong");
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
    if (f.feedback.value.trim() === "") {
        alert("Enter your Feedback");
        f.feedback.focus();
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
<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <?php if ($act === "success") { ?>
    <div class="alert alert-success">
      <strong>Feedback Submitted!</strong>
    </div>
    <?php } elseif ($act === "wrong") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Could not submit feedback. Please enter valid text.
    </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Feedback</h2>
      </div>
      <div class="card-block">
        <form name="form1" method="post" onsubmit="return validate()">
          <div class="form-group">
            <label>Your Feedback</label>
            <textarea name="feedback" class="form-control" rows="4" required></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Send Feedback" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<p>&nbsp;</p>
</body>
</html>
