<br>
<br>

<?php
 session_start();
 ?>

<?php

if(isset($_SESSION['userid'])) {
 
  echo "<p>You are logged in</p>";
  echo'<a href="userlist.php">UserList</a>';
 
}
else{

  echo "<p>You are Loggout </p>";
 echo' <form action="includes/logindata.php" method="POST">
      <label for="username">Username</label>
      <input type="text" name="username" ><br><br>
      <label for="passw">Password </label>
      <input type="password" name="passw"><br><br>
      <button type="submit" name="login-submit">Log In</button>
</form>
</div>';
 
}
?>
<?php
require"header.php";
?>