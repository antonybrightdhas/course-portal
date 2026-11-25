<?php
session_start();
include("include/dbconnect.php");

$msg = "";
if (isset($_POST['btn'])) {
    $uname = isset($_POST['uname']) ? trim($_POST['uname']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    $u_esc = db_escape($uname);
    $p_esc = db_escape($pass);

    $qq1 = "SELECT * FROM ee_register WHERE uname='$u_esc' AND pass='$p_esc'";
    $qq2 = db_query($qq1);
    $num = db_num_rows($qq2);
    if ($num == 1) {
        $_SESSION['uname'] = $uname;
        $_SESSION['role'] = 'student';
        header("Location: userhome.php");
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
<h3 align="center"><?php include("include/title.php"); ?></h3>
<div class="container-fluid" style="margin-top: 20px;">
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-5" style="text-align: center; margin-bottom: 20px;">
      <img src="img/E-Learning-1.jpg" alt="E-Learning" class="img-fluid" style="max-width: 100%; height: auto;" />
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <h2 class="h5 display">Student Login</h2>
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
            <a href="register.php">Sign Up</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end content area-->
<p>&nbsp;</p>
</body>
</html>
