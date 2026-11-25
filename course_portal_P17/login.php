<?php
session_start();
include("include/dbconnect.php");

$msg = "";
if (isset($_POST['btn'])) {
    $uname = isset($_POST['uname']) ? trim($_POST['uname']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    $u_esc = db_escape($uname);
    $p_esc = db_escape($pass);

    $qry = "SELECT * FROM ee_admin WHERE username='$u_esc' AND password='$p_esc' AND username='admin'";
    $exe = db_query($qry);
    $num = db_num_rows($exe);
    if ($num == 1) {
        $_SESSION['uname'] = $uname;
        $_SESSION['role'] = 'admin';
        header("Location: admin.php");
        exit;
    } else {
        $msg = "Username or Password wrong!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/head.php"); ?>
</head>
<body>
<?php include("include/link_home.php"); ?>
<div class="panel panel-default">
  <div class="panel-heading" align="center"></div>
  <div class="panel-body">
    <h3 align="center"></h3>
  </div>
</div>
<!--start content area-->
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Admin</h2>
      </div>
      <div class="card-block">
        <form name="name" method="post">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="uname" placeholder="Username" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" placeholder="Password" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Sign In" class="btn btn-primary" />
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
<!--end content area-->
<p>&nbsp;</p>
</body>
</html>
