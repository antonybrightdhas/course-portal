<div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
  <a href="login.php">Admin</a>
  <a href="login1.php">Staff</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onClick="myFunction()">&#9776;</a>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
