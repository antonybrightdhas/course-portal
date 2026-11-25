<?php
session_start();
include("include/dbconnect.php");

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

if (isset($_POST['btn'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $dob = isset($_POST['dob']) ? trim($_POST['dob']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $uname = isset($_POST['uname']) ? trim($_POST['uname']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    if ($name === '' || $gender === '' || $uname === '' || $pass === '') {
        header("Location: register.php?act=invalid");
        exit;
    }

    $u_esc = db_escape($uname);
    $chk = db_query("SELECT id FROM ee_register WHERE uname='$u_esc'");
    if (db_num_rows($chk) > 0) {
        header("Location: register.php?act=wrong");
        exit;
    }

    $max_qry = db_query("SELECT MAX(id) AS maxid FROM ee_register");
    $max_row = db_fetch_array($max_qry);
    $id = ($max_row && $max_row['maxid']) ? ((int)$max_row['maxid'] + 1) : 1;

    $dob1 = $dob;
    if ($dob !== '' && strpos($dob, '-') !== false) {
        $idt = explode('-', $dob);
        if (count($idt) === 3 && strlen($idt[0]) === 4) {
            $dob1 = $idt[2] . '-' . $idt[1] . '-' . $idt[0];
        }
    }

    $q1 = sprintf(
        "INSERT INTO ee_register (id, name, gender, dob, address, contact, email, course, fees, paid_st, learn1, learn2, learn3, learn4, learn5, utype, uname, pass) VALUES (%d, '%s', '%s', '%s', '%s', '%s', '%s', 0, 0, 0, 0, 0, 0, 0, 0, '', '%s', '%s')",
        $id,
        db_escape($name),
        db_escape($gender),
        db_escape($dob1),
        db_escape($address),
        db_escape($contact),
        db_escape($email),
        $u_esc,
        db_escape($pass)
    );
    $q2 = db_query($q1);
    if ($q2) {
        header("Location: register.php?act=success");
    } else {
        header("Location: register.php?act=wrong");
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
    if (f.name.value.trim() === "") {
        alert("Enter the Name");
        f.name.focus();
        return false;
    }
    if (f.gender[0].checked === false && f.gender[1].checked === false) {
        alert("Select the Gender");
        return false;
    }
    if (f.dob.value === "") {
        alert("Enter the Date of Birth");
        f.dob.focus();
        return false;
    }
    if (f.address.value.trim() === "") {
        alert("Enter the Address");
        f.address.focus();
        return false;
    }
    if (f.contact.value.trim() === "") {
        alert("Enter the Mobile Number");
        f.contact.focus();
        return false;
    }
    if (isNaN(f.contact.value) || f.contact.value.trim().length !== 10) {
        alert("Mobile Number must be 10 digits");
        f.contact.select();
        return false;
    }
    if (f.email.value.trim() === "") {
        alert("Enter the E-mail");
        f.email.focus();
        return false;
    }
    var reEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!reEmail.test(f.email.value.trim())) {
        alert("E-Mail Invalid");
        f.email.focus();
        return false;
    }
    if (f.uname.value.trim() === "") {
        alert("Enter the Username");
        f.uname.focus();
        return false;
    }
    if (f.pass.value === "") {
        alert("Enter the Password");
        f.pass.focus();
        return false;
    }
    if (f.repass.value === "") {
        alert("Enter the Re-type Password");
        f.repass.focus();
        return false;
    }
    if (f.repass.value !== f.pass.value) {
        alert("Password & Re-type password do not match!");
        f.repass.select();
        return false;
    }
    return true;
}
</script>
</head>
<body>
<?php include("include/link_home.php"); ?>
<div class="panel panel-default">
  <div class="panel-heading" align="center"><span class="t1"><?php include("include/title.php"); ?></span></div>
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
      <strong>Register Success!</strong> <a href="index.php">Login</a>
    </div>
    <?php } elseif ($act === "wrong") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> This Student username already exists!
    </div>
    <?php } elseif ($act === "invalid") { ?>
    <div class="alert alert-warning">
      <strong>Warning!</strong> Please fill all required fields!
    </div>
    <?php } ?>
  </div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display">Registration</h2>
      </div>
      <div class="card-block">
        <form name="form1" method="post" onsubmit="return validate()">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Gender</label><br />
            <input name="gender" type="radio" value="Male" /> Male
            <input name="gender" type="radio" value="Female" /> Female
          </div>
          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" placeholder="D.O.B" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" placeholder="Address" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Mobile No.</label>
            <input name="contact" type="text" maxlength="10" placeholder="10-digit Mobile No." class="form-control" required />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email Address" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="uname" placeholder="Username" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" placeholder="Password" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Re-type Password</label>
            <input type="password" name="repass" placeholder="Re-type Password" class="form-control" required />
          </div>
          <div class="form-group">
            <input type="submit" name="btn" value="Register" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin-top: 10px;">
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-block" align="center">
        Have an account? <a href="index.php">Login</a>
      </div>
    </div>
  </div>
</div>
<p>&nbsp;</p>
</body>
</html>
