<?php 
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="../bootstrap/css/admin2.css"><!-- comment -->
    </head>
    <body>
       
        <div class="title_them">
            <br>
        <h2>Thêm tài khoản</h2>
    </div>
        <?php
       
        include '../connectdb/connect.php';
      
        ?>
<div class="them">
    <form method="POST" enctype="multipart/form-data" action="../xuly/xulythem.php">
        <div class="themsp">
       
            <input  style="display: none;" type="text" name="user_id"  class="form-controll" ><br>
         <label >email</label><br>
        <input type="text" name="email" class="form-controll" required="true">  <br>
        <label >password</label><br>
        <input type="password" name="pass" class="form-controll" required="true"> <br><br>
        <label >Nhập lại password</label><br>
        <input type="password" name="pass2" class="form-controll"required="true" > <br><br>
         <label >SDT</label><br>
         <input type="text" name="sdt" class="form-controll"required="true" > <br>
         <label >Role</label><br>
         <select name='role' class='form-controll'>
       <option>admin</option> 
       <option>kho</option>
         </select><br>   <br>  
         <button type="submit" class="sub" name="sub2">Thêm</button>
         </div>
       
    </form>
</div>
    
</body>
</html>
