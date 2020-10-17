<?php
  
  include "includes/dbconnect.php";

  ?>
<br>
<br>


  <?php  

   $sql = "SELECT * FROM users;";
   $result = mysqli_query($conn,$sql);
   $resultCheck = mysqli_num_rows($result);
   if($resultCheck > 0 ){
      while ($row = mysqli_fetch_assoc($result)){
          echo '<p>UserName  | Email | Phone Number </p>';
          echo $row['username']  ."  " ;
    
          echo $row['email']  ."  " ;
         
          echo $row['phoneno']  ."  " ;
      }

   }
   ?>