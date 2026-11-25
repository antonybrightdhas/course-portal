<div class="topnav" id="myTopnav">
  <a href="admin.php" class="active">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Courses 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="add_course.php">Add New</a>
	  <a href="view_tutorial.php">Tutorial</a>
	  <a href="contact.php">Contact</a>
    </div>
  </div>
  <a href="view_student.php">Students</a>
   <a href="certificate.php">Certificate</a>
  <a href="view_feed.php">Feedback</a>
  <a href="logout.php">Logout</a>
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
